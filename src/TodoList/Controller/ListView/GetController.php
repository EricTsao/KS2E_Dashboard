<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/1
 * Time: 上午 11:04
 */

namespace TodoList\Controller\ListView;


use TodoList\Model\TodoListModel;
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
        $model = new TodoListModel();

        return $this->renderView('listview','default','edge',[
            'name' => 'Eric',
            'todoItems' => $model->getTodoItems()
        ]);
    }
}