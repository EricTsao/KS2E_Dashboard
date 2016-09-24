<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/1
 * Time: 下午 02:12
 */

namespace TodoList\Controller\ListView;


use TodoList\Model\TodoListModel;
use Windwalker\Core\Controller\AbstractController;

class SaveController extends AbstractController
{
    /**
     * Do execute action.
     *
     * @return  mixed
     */
    protected function doExecute()
    {
        $model = new TodoListModel();

        $task = $this->input->post->get('task');

        $data =  array(
            'TaskId' => uniqid(),
            'Task' => $task,
            'CreateBy' => 'Eric.Tsao',
            'CreateTime' => date('Y-m-d H:i:s'),
            'UpdateBy' => 'Eric.Tsao',
            'UpdateTime' => date('Y-m-d H:i:s'),
        );

        $model->saveTodoItem($data);

        return $this->renderView('listview','default','edge',[
            'name' => 'Eric',
            'todoItems' => $model->getTodoItems()
        ]);
    }
}