<?php
/**
 * TaskFixture
 *
 */
class TaskFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'utf8_general_ci', 'comment' => 'タスク名', 'charset' => 'utf8'),
		'memo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'メモ', 'charset' => 'utf8'),
		'done' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'unsigned' => false, 'comment' => '完了フラグ'),
		'due_date' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => '期限'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '登録日時'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '最終更新日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'name' => 'Lorem ipsum dolor sit amet',
			'memo' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'done' => 1,
			'due_date' => '2019-01-09',
			'created' => '2019-01-09 18:12:08',
			'modified' => '2019-01-09 18:12:08'
		),
	);

}
