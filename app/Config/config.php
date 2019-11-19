<?php
/**
 * 機能種別
 * @var int
 */
define ('TASK', 1);

/**
 * 表示レイアウト初期値
 * @var int
 */
define ('TASKLAYOUT', 3);

/**
 * タスク表示レイアウト種別
 * ※bootstrap4でカラム設定を行っているため以下の値
 * @var int
 */
define ('ONE_COLUMN'   , 'col-12');
define ('TWO_COLUMNS'  , 'col-6' );
define ('THREE_COLUMNS', 'col-4' );
define ('FOUR_COLUMNS' , 'col-3' );
define ('SIX_COLUMNS'  , 'col-2' );

/**
 * 表示メモ数
 * ※0からの値を設定すること。(例：5つ表示したい場合、4となる。)
 * @var int
 */
define ('NOTES_NUMBER', 6);
