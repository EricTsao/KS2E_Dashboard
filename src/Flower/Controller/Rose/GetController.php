<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/7/30
 * Time: 上午 11:34
 */

namespace Flower\Controller\Rose;

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
        return 'Hello World!Rose';
    }
}