<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/7
 * Time: 下午 02:49
 */

namespace KS2E\Controller\Analysis;

use KS2E\Model\DashboardModel;
use Windwalker\Core\Controller\AbstractController;
use Windwalker\Core\DateTime\DateTime;

class GetController extends AbstractController
{
    protected function doExecute()
    {
        $queryTarget = $this->input->get->get('queryTarget');
        if($queryTarget == '') $queryTarget = 'Account';

        $queryAccount = $this->input->get->get('queryAccount');
        if($queryAccount == '') $queryAccount = '';

        $queryDeviceManager = $this->input->get->get('queryDeviceManager');
        if($queryDeviceManager == '') $queryDeviceManager = '';

        $queryDevice = $this->input->get->get('queryDevice');
        if($queryDevice == '') $queryDevice = '';

        $startDate = $this->input->get->get('startDate');
        if($startDate == '') $startDate = '2016/08/28';

        $endDate = $this->input->get->get('endDate');
        if($endDate == '') $endDate = '2016/08/29';

        $unitMins = $this->input->get->get('unitMins');
        if($unitMins == '') $unitMins = 60;


        $model = new DashboardModel();

        $analysisData = $model->getAnalysisItemList($queryTarget, $queryAccount, $queryDeviceManager, $queryDevice, $startDate, $endDate, $unitMins);
        $objectList = $model->getObjectList($queryTarget,$queryAccount,$queryDeviceManager);
        $ykeys = [];

        if(count($analysisData) > 0)
        {
            foreach($analysisData[0] as $k=>$v)
            {
                if($k == 'DurationStartTime' || $k == 'DurationEndTime'){
                    continue;
                }else{
                    array_push($ykeys,$k);
                }
            }
        }

        return $this->renderView('analysis','default','edge',[
            'objectList' => $objectList,
            'analysisData' => $analysisData,
            'ykeys' => $ykeys
        ]);
    }
}