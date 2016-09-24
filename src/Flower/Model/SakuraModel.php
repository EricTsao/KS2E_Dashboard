<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/7/30
 * Time: 下午 12:05
 */

namespace Flower\Model;


use Windwalker\Core\Model\ModelRepository;

class SakuraModel extends ModelRepository
{
    public function getSakuras()
    {
        return [1,2,3,4];
    }
}