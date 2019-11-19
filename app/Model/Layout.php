<?php
App::uses('AppModel', 'Model');
/**
 * Layout Model
 *
 */
class Layout extends AppModel {

    /**
     * hasOne
     * @var array
     */
    public $hasOne = array(
        'TasksLayout' => array(
            'className'  => 'TasksLayout',
            'foreignKey' => 'layouts_id'
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
