<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/3
 * Time: 下午 01:18
 */

namespace KS2E\Model;

use Windwalker\Core\Model\DatabaseModelRepository;

class DashboardModel extends DatabaseModelRepository
{
    /**
     * @param $queryTarget
     * @return array
     */
    public function getObjectList($queryTarget, $queryAccount, $queryDeviceManager)
    {
        $serverName = "localhost";
        $connectionInfo = array( "Database"=>"KS2E_ControlCenter", "UID"=>"sa", "PWD"=>"@12qwaszx@", "CharacterSet" => "UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn ) {
            //echo "Connection established.<br />";
        }else{
            //echo "Connection could not be established.<br />";
            die( print_r( sqlsrv_errors(), true));
        }

        $sqlQueryAccount = '';
        if($queryAccount != '') $sqlQueryAccount = "AND AccountId = '".$queryAccount."'";

        $sqlQueryDeviceManager = '';
        if($queryDeviceManager != '') $sqlQueryDeviceManager = "AND DeviceManagerId = '".$queryDeviceManager."'";

        $sql = "
        SELECT Total.ObjectName, Total.ObjectId, (CONVERT(float,Online.Count) / Total.Count)*100 AS HealthRate FROM (
            SELECT DISTINCT ".$queryTarget." AS ObjectName, ".$queryTarget."Id AS ObjectId, COUNT(1) AS Count
            FROM V_DeviceFunctionCurrentStatus
            WHERE 1 = 1
            ".$sqlQueryAccount."
            ".$sqlQueryDeviceManager."
            GROUP BY ".$queryTarget.", ".$queryTarget."Id
        ) AS Total
        LEFT JOIN (
            SELECT DISTINCT ".$queryTarget." AS ObjectName, ".$queryTarget."Id AS ObjectId, COUNT(1) AS Count
            FROM V_DeviceFunctionCurrentStatus
            WHERE 1 = 1
            AND FunctionStatus = 'On'
            ".$sqlQueryAccount."
            ".$sqlQueryDeviceManager."
            GROUP BY ".$queryTarget.", ".$queryTarget."Id
        ) AS Online
        ON Total.ObjectId = Online.ObjectId
        ";

        $result = sqlsrv_query($conn, $sql);

        switch ($queryTarget) {
            case 'Account':
                $nextLevel = 'DeviceManager';
                break;
            case 'DeviceManager':
                $nextLevel = 'Device';
                break;
            case 'Device':
                $nextLevel = 'Device';
                break;
            default :
                $nextLevel = '';
        }

        $ObjList = array();

        if($result === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        else{
            while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) ) {
                array_push($ObjList, array(
                    'CurrentLevel'=>$queryTarget,
                    'NextLevel'=>$nextLevel,
                    'DeviceManagerId'=>$queryDeviceManager,
                    'ObjectName'=>$row['ObjectName'],
                    'ObjectId'=>$row['ObjectId'],
                    'HealthRate'=>number_format($row['HealthRate'], 2, '.', ''),
                ));
            }
        }

        // Close the connection.
        sqlsrv_close($conn);

        return $ObjList;
    }

    public function getAnalysisItemList($queryTarget, $queryAccount, $queryDeviceManager, $queryDevice, $startDate, $endDate, $unitMins)
    {
        $serverName = "localhost";
        $connectionInfo = array( "Database"=>"KS2E_ControlCenter", "UID"=>"sa", "PWD"=>"@12qwaszx@", "CharacterSet" => "UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn ) {
            //echo "Connection established.<br />";
        }else{
            //echo "Connection could not be established.<br />";
            die( print_r( sqlsrv_errors(), true));
        }

        $result = sqlsrv_query($conn, "
        EXEC	[dbo].[GetAnalysisData]
		@startDate = N'".$startDate."',
		@endDate = N'".$endDate."',
		@unitMins = ".$unitMins.",
		@queryTarget = N'".$queryTarget."',
		@queryAccount = N'".$queryAccount."',
		@queryDeviceManager = N'".$queryDeviceManager."',
		@queryDevice = N'".$queryDevice."'
		");

        $analysisData = array();

        if($result === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        else{
            while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) ) {

                $item = [];

                foreach($row as $k=>$v)
                {
                    if($k == 'DurationStartTime' || $k == 'DurationEndTime' ){
                        $item[$k] = date_format($v,"Y-m-d H:i:s");
                    }else{
                        $item[$this->getNameById($k)] = number_format($v, 2, '.', '');
                    }
                }

                array_push($analysisData, $item);
            }
        }

        // Close the connection.
        sqlsrv_close($conn);

        return $analysisData;
    }

    public function getDashboardItemList($queryAccount)
    {
        $serverName = "localhost";
        $connectionInfo = array( "Database"=>"KS2E_ControlCenter", "UID"=>"sa", "PWD"=>"@12qwaszx@", "CharacterSet" => "UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn ) {
            //echo "Connection established.<br />";
        }else{
            //echo "Connection could not be established.<br />";
            die( print_r( sqlsrv_errors(), true));
        }

        $sqlQueryAccount = '';
        if($queryAccount != '') $sqlQueryAccount = "AND AccountId = '".$queryAccount."'";

        $result = sqlsrv_query($conn, "
SELECT 
Main.Account, 
Main.AccountId,
Main.DeviceManager, 
Main.DeviceManagerId,
ISNULL(Main.WorkingFunctionCount,0.0) / CONVERT(float,Main.FullFunctionCount) * 100 AS HealthRate
FROM (
	SELECT 
	SA.Account,
	SA.AccountId,
	SDM.DeviceManager,
	SDM.DeviceManagerId,
	(
		SELECT COUNT(1) FROM V_DeviceFunctionCurrentStatus V 
		WHERE V.DeviceManagerId = SDM.DeviceManagerId
		GROUP BY V.DeviceManagerId, V.DeviceManagerId
	) AS FullFunctionCount,
	(
		SELECT COUNT(1) FROM V_DeviceFunctionCurrentStatus V 
		WHERE V.DeviceManagerId = SDM.DeviceManagerId AND V.FunctionStatus = 'On'
		GROUP BY V.DeviceManagerId, V.DeviceManagerId
	) AS WorkingFunctionCount
	FROM Setting_Account SA
	LEFT JOIN Setting_DeviceManager SDM ON SDM.AccountId = SA.AccountId
) Main
WHERE 1 = 1 
AND Main.DeviceManagerId IS NOT NULL
".$sqlQueryAccount."
ORDER BY HealthRate, Account, DeviceManager
");

        $dashboardItemList = array();

        if($result === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        else{
            while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) ) {
                array_push($dashboardItemList, array(
                    'Account'=>$row['Account'],
                    'AccountId'=>$row['AccountId'],
                    'DeviceManager'=>$row['DeviceManager'],
                    'DeviceManagerId'=>$row['DeviceManagerId'],
                    'HealthRate'=>number_format($row['HealthRate'], 2, '.', ''),
                ));
            }
        }

        // Close the connection.
        sqlsrv_close($conn);

        return $dashboardItemList;
    }

    public function getNameById($id)
    {
        $name = '';

        $serverName = "localhost";
        $connectionInfo = array( "Database"=>"KS2E_ControlCenter", "UID"=>"sa", "PWD"=>"@12qwaszx@", "CharacterSet" => "UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn ) {
            //echo "Connection established.<br />";
        }else{
            //echo "Connection could not be established.<br />";
            die( print_r( sqlsrv_errors(), true));
        }

        $result = sqlsrv_query($conn, "
            SELECT dbo.GetResultById('". $id . "') AS Name
        ");

        if($result === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        else{
            while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) ) {
                $name = $row['Name'];
                break;
            }
        }

        // Close the connection.
        sqlsrv_close($conn);

        return $name;
    }
}