<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/3
 * Time: 上午 10:07
 */

namespace KS2E\Controller\Dashboard;


use KS2E\Model\DashboardModel;
use Windwalker\Core\Controller\AbstractController;

class GetController extends AbstractController
{
    protected function doExecute()
    {
        $queryTarget = $this->input->get->get('queryTarget');
        if($queryTarget == '') $queryTarget = 'Account';

        $queryAccount = $this->input->get->get('queryAccount');

        $queryDeviceManager = $this->input->get->get('queryDeviceManager');

        $model = new DashboardModel();

        $dashboardItemList = $model->getDashboardItemList($queryAccount);
        $dashboardAlertItemList = array_filter($dashboardItemList, function($v, $k) {
            $isPass = true;

            if($v['HealthRate'] == 100){
                $isPass = false;
            }

            return $isPass;
        }, ARRAY_FILTER_USE_BOTH);
        $dashboardNormalItemList = array_filter($dashboardItemList, function($v, $k) {
            $isPass = true;

            if($v['HealthRate'] < 100){
                $isPass = false;
            }

            return $isPass;
        }, ARRAY_FILTER_USE_BOTH);

        return $this->renderView('dashboard','default','edge',[
            'objectList' => $model->getObjectList($queryTarget, '', ''),
            'dashboardAlertItemList' => $dashboardAlertItemList,
            'dashboardNormalItemList' => $dashboardNormalItemList,
            'currentObjectId' => $queryAccount,
            'currentObjectName' => $model->getNameById($queryAccount),
        ]);
    }
}