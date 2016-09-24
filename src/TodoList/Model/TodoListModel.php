<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/1
 * Time: 上午 11:26
 */

namespace TodoList\Model;


use Windwalker\Core\Model\DatabaseModelRepository;

class TodoListModel extends DatabaseModelRepository
{
    public function getTodoItems()
    {
        /*
        mysql_connect("localhost","root","mysql");//連結伺服器
        mysql_select_db("TodoList");//選擇資料庫
        //mysql_query("set names utf8");//以utf8讀取資料，讓資料可以讀取中文
        $data=mysql_query("select * from tasks");//從contact資料庫中選擇所有的資料表
        */

        //return [1,2,3,4];

        $query = $this->db->getQuery(true);

        $query->select('*')
            ->from('Tasks')
            ->order('RecordId');
            //->where('RecordId = ' . $id);

        return $this->db->setQuery($query)->loadAll(null, 'array');
    }

    public function saveTodoItem($data)
    {
        return $this->db->getWriter()->insertOne('Tasks', $data, null);
    }

    public function deleteTodoItem($recordId)
    {
        return $this->db->getWriter()->delete('Tasks', array('RecordId' => $recordId));
    }
}