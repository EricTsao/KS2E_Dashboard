<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/7/30
 * Time: 上午 11:34
 */

namespace Flower\Controller\Sakura;

use Flower\Model\SakuraModel;
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
        //return 'Hello World!ListView';

        $model = new SakuraModel();

        //$view = $this->getView('sakura','html','edge');
        //$view['title'] = 'Eric2';
        //$view['sakuras'] = $model->getSakuras();


        //return $view;

        return $this->renderView('sakura','default','edge',[
            'title' => 'Eric',
            'sakuras' => $model->getSakuras()
        ]);

    }
}