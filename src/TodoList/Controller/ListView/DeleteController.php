<?php
/**
 * Created by PhpStorm.
 * User: Eric Tsao
 * Date: 2016/8/1
 * Time: 下午 04:53
 */

namespace TodoList\Controller\ListView;


use TodoList\Model\TodoListModel;
use Windwalker\Core\Controller\AbstractController;

class DeleteController extends AbstractController
{

    /**
     * Do execute action.
     *
     * @return  mixed
     */
    protected function doExecute()
    {
        $model = new TodoListModel();

        $recordId = $this->input->post->get('RecordId');

        $model->deleteTodoItem($recordId);

        return $this->renderView('listview','default','edge',[
            'name' => 'Eric',
            'todoItems' => $model->getTodoItems()
        ]);
    }
}