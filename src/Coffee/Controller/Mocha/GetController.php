<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/8
 * Time: 上午 09:35
 */

namespace Coffee\Controller\Mocha;


use Coffee\Model\MochaModel;
use Windwalker\Core\Controller\AbstractController;

class GetController extends AbstractController
{

    /**
     * Do execute action.
     *
     * @return  mixed
     */
    protected function doExecute()
    {
        /** @var MochaModel $model */
        $model = $this->getModel();
        $mochaList = $model->getMochaList();

        show($mochaList);die();

        return $this->renderView('mocha','default','edge',[
            'mochaList' => $mochaList
        ]);
    }
}