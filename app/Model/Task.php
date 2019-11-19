<?php
App::uses('AppModel', 'Model');
/**
 * Task Model
 *
 */
class Task extends AppModel {

    /**
     * hasMany
     * @var array
     */
    public $hasMany = array(
        'TasksDetail' => array(
            'className'  => 'TasksDetail',
            'foreignKey' => 'tasks_id'
        ),
    );

    /**
     * validate
     * @var array
     */
    public $validate = array(
        // タスク名
        'name' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'message'  => 'タスク名を入力してください。',
                'required' => true,
            ),
            'length' => array(
                'rule'    => array('maxLength', 200),
                'message' => 'タスク名は200文字以内で入力してください。',
            ),
        ),
        // 期限
        'due_date' => array(
            'date' => array(
                'rule'       => array('date', 'ymd'),
                'message'    => '期限が不正なフォーマットで入力されています。',
                'allowEmpty' => true,
            ),
        ),
        // カラーコード
        'color_code' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'message'  => 'カラーコードを選択してください。',
                'required' => true,
            ),
        ),
    );

}
