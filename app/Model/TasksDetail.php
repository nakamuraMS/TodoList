<?php
App::uses('AppModel', 'Model');
/**
 * TasksDetail Model
 *
 */
class TasksDetail extends AppModel {

    /**
     * belongsTo
     * @var array
     */
    public $belongsTo = array(
        'Task' => array(
            'className'  => 'Task',
            'foreignKey' => 'tasks_id',
        ),
    );

    /**
     * validate
     * @var array
     */
    public $validate = array(
        // 必要の際に追加
    );

}
