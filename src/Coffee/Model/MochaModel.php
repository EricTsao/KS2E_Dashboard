<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/8
 * Time: 上午 10:36
 */

namespace Coffee\Model;


use Windwalker\Core\Model\DatabaseModelRepository;
use Windwalker\DataMapper\DataMapper;

class MochaModel extends DatabaseModelRepository
{
    protected $table = 'mocha';

    public function getMochaList()
    {
        $mochaList = DataMapper::newRelation('main', 'mocha')
            ->innerJoin('l', 'locations', 'main.location_id = l.id')
            ->where('main.id < 10')
            ->order('main.id DESC')
            ->select(array('main.title as title','l.title as location','main.id as id'))
            ->find();

        //show($mochaList);die();

        return $mochaList;

        //return $this->getDataMapper()->findAll();
    }
}