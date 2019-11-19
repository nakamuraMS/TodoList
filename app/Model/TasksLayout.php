<?php
App::uses('AppModel', 'Model');
/**
 * TasksLayout Model
 *
 */
class TasksLayout extends AppModel {

    /**
     * belongsTo
     * @var array
     */
    public $belongsTo = array(
        'Layout' => array(
            'className'  => 'Layout',
            'foreignKey' => 'layouts_id',
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
