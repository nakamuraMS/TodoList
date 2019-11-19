<?php
App::uses('AppController', 'Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property TasksDetail $TasksDetail
 * @property Layout $Layout
 * @property TasksLayout $TasksLayout
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TasksController extends AppController {

    public $components = array('Paginator', 'Session');

    /**
     * uses
     * @var array
     */
    public $uses = array('Task','TasksDetail','Layout','TasksLayout');

    public function beforeFilter() {
        $this->layout = 'custom';

        // セッションリセット
        $this->Session->delete("search");
    }

    public function index() {
        $conditions  = array();
        if ($this->request->is('post')) {
            // 登録期間(From)
            if (isset($this->request->data['due_date_from']) && !empty($this->request->data['due_date_from'])) {
                $this->Session->write("search.due_date_from", $this->request->data['due_date_from']);
            }
            // 登録期間(To)
            if (isset($this->request->data['due_date_to']) && !empty($this->request->data['due_date_to'])) {
                $this->Session->write("search.due_date_to", $this->request->data['due_date_to']);
            }
            // タスク名
            if (isset($this->request->data['name']) && !empty($this->request->data['name'])) {
                $this->Session->write("search.name", $this->request->data['name']);
            }
            // メモ
            if (isset($this->request->data['memo']) && !empty($this->request->data['memo'])) {
                $this->Session->write("search.memo", $this->request->data['memo']);
            }

            // セッションから検索条件の生成
            if ($this->Session->check('search.due_date_from')) {
                $due_date_from  = $this->Session->read('search.due_date_from');
                $conditions    += array('Task.due_date >=' => $due_date_from);
            }
            if ($this->Session->check('search.due_date_to')) {
                $due_date_to    = $this->Session->read('search.due_date_to');
                $conditions    += array('Task.due_date <=' => $due_date_to);
            }
            if ($this->Session->check('search.name')) {
                $name           = $this->Session->read('search.name');
                $conditions    += array('Task.name LIKE' => "%$name%");
            }
            if ($this->Session->check('search.memo')) {
                $memo           = $this->Session->read('search.memo');
                $conditions    += array('Task.search_memo LIKE' => "%$memo%");
            }
            $tasks = $this->Task->find('all', array('conditions' => $conditions, 'order' => array('pin_flag DESC', 'created')));

        } else {
            $tasks = $this->Task->find('all', array('conditions' => $conditions, 'order' => array('pin_flag DESC', 'created')));
        }
        // 未完了タスクの通知
        $incomplete   = $this->incompleteTask($tasks);
        // 期限付きタスクの通知
        $this->duedateTask($tasks);
        // 表示カラム設定取得
        $columnConfig = $this->columnSetting();

        $this->set(compact('tasks','incomplete','columnConfig'));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Task->create();
            $this->Task->set(array(
                'name'       => $this->request->data['name'],
                'due_date'   => $this->request->data['due_date'],
                'color_code' => $this->request->data['color_code'],
                'pin_flag'   => $this->request->data('pin_flag'),
            ));
            if ($this->Task->save()) {
                if(!empty($this->request->data["TasksDetail"])) {
                    $last_id     = $this->Task->getLastInsertID();
                    $search_memo = "";
                    // タスクに紐づくメモを登録
                    foreach($this->request->data["TasksDetail"] as $detail) {
                        if(!empty($detail['memo'])) {
                            $this->TasksDetail->create();
                            $this->TasksDetail->set(array(
                                'tasks_id' => $last_id,
                                'memo'     => $detail['memo'],
                            ));
                            $this->TasksDetail->save();
                            $search_memo .= $detail['memo'];
                            $search_memo .= " ";
                        }
                    }
                    // メモ検索用カラム
                    $this->Task->read(null, $last_id);
                    $this->Task->set(array('search_memo' => $search_memo));
                    $this->Task->save();
                }

                $this->Session->setFlash(__('タスクを登録しました。'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->Task->validationErrors;
                $this->set(compact(NOTES_NUMBER,'errors'));
                $this->set('data', $this->request->data);
                $this->Session->setFlash(__('タスクを登録できませんでした。処理をやり直してください。'));
            }
        }
        $this->set('notes_number', NOTES_NUMBER);
    }

    public function edit($id = null) {
        if (!$this->Task->exists($id)) {
            throw new NotFoundException(__('Invalid task'));
        }
        $options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
        $data = $this->Task->find('first', $options);

        if ($this->request->is(array('post', 'put'))) {
            $pin_flag = 0;
            // チェックONの場合
            if($this->request->data('pin_flag')) {
                $pin_flag = 1;
            }
            $this->Task->create();
            $this->Task->set(array(
                'id'         => $id,
                'name'       => $this->request->data['name'],
                'due_date'   => $this->request->data['due_date'],
                'color_code' => $this->request->data['color_code'],
                'pin_flag'   => $pin_flag,
            ));
            if ($this->Task->save()) {
                $search_memo = "";
                // タスクに紐づくメモを登録
                foreach($this->request->data["TasksDetail"] as $detail) {
                    if(!empty($detail['memo'])) {
                        $this->TasksDetail->create();
                        $this->TasksDetail->set(array(
                            'id'       => $detail['id'],
                            'tasks_id' => $id,
                            'memo'     => $detail['memo'],
                            'done_flg' => $detail['done_flg'],
                        ));
                        $this->TasksDetail->save();
                        $search_memo .= $detail['memo'];
                        $search_memo .= " ";
                    } else {
                        // IDが存在しメモが空白の場合にデータを削除
                        if(!empty($detail['id'])) {
                            $this->TasksDetail->delete($detail['id']);
                        }
                    }
                }
                // メモ検索用カラム
                $this->Task->read(null, $id);
                $this->Task->set(array('search_memo' => $search_memo));
                $this->Task->save();

                $this->Session->setFlash(__('タスクを更新しました。'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('タスクを更新できませんでした。処理をやり直してください。'));
                $errors = $this->Task->validationErrors;
                $this->set(compact(NOTES_NUMBER,'errors'));
                $this->set('data', $this->request->data);
            }
        } else {
            $this->set('notes_number', NOTES_NUMBER);
            $this->set(compact('data'));
        }
    }

    public function delete($id = null) {
        $this->Task->id = $id;
        if (!$this->Task->exists()) {
            throw new NotFoundException(__('Invalid task'));
        }
        if ($this->Task->delete()) {
            $this->Session->setFlash(__('タスクを削除しました。'));
        } else {
            $this->Session->setFlash(__('タスクを削除できませんでした。処理をやり直してください。'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function exe($detail_id) {
        $this->TasksDetail->recursive = -1;
        $data = $this->TasksDetail->find('first', array('conditions' => array('TasksDetail.id' => $detail_id)));

        // 完了フラグを更新
        if($data['TasksDetail']['done_flg'] == 0) {
            $this->TasksDetail->set(array('id' => $detail_id, 'done_flg' => 1));
            $this->TasksDetail->save();
        } else {
            $this->TasksDetail->set(array('id' => $detail_id, 'done_flg' => 0));
            $this->TasksDetail->save();
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function layout() {
        $tasksLayout = $this->TasksLayout->find('first', array('recursive' => -1));
        // レイアウト情報の初期値を設定
        $default = (empty($tasksLayout)) ? TASKLAYOUT : $tasksLayout['TasksLayout']['layouts_id'];

        if ($this->request->is(array('post','put'))) {
            $this->TasksLayout->create();
            // データが新規登録か更新か判定
            if(empty($tasksLayout)) {
                $this->TasksLayout->set(array(
                    'layouts_id' => $this->request->data['id'],
                ));
            } else {
                $this->TasksLayout->set(array(
                    'id'         => $tasksLayout['TasksLayout']['id'],
                    'layouts_id' => $this->request->data['id'],
                ));
            }

            if ($this->TasksLayout->save()) {
                $this->Session->setFlash(__('表示レイアウトを変更しました。'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('表示レイアウトを変更できませんでした。処理をやり直してください。'));
                $this->set('data', $this->request->data);
            }
        }
        $layouts = $this->Layout->find('all', array('conditions' => array('function_type' => TASK), 'recursive' => -1));
        $this->set(compact('layouts','default'));
    }

    private function incompleteTask($tasks) {
        $incomplete = array();
        foreach($tasks as $task) {
            if(!empty($task['TasksDetail'])) {
                foreach($task['TasksDetail'] as $detail) {
                    // 未完了のものがある場合
                    if($detail['done_flg'] == 0) {
                        array_push($incomplete, '【'.$task['Task']['name'].'】' .$detail['memo']);
                    }
                }
            }
        }
        return $incomplete;
    }

    private function duedateTask($tasks) {
        $message        = '';
        $duedate_before = array();
        $duedate_today  = array();
        $duedate_after  = array();

        foreach($tasks as $task) {
            if(empty($task['Task']['due_date'])) continue;
            // 期限と現在日付の差分日数を取得
            $diff_day = (strtotime(date($task['Task']['due_date'])) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
            foreach($task['TasksDetail'] as $detail) {
                if($detail['done_flg'] == 0) {
                    // 期限が今日から3日前のもの
                    if(1 <= $diff_day && $diff_day <= 3) {
                        array_push($duedate_before, '【'.$task['Task']['name'].'】' .$detail['memo']);
                    // 期限が今日のもの
                    } elseif($diff_day == 0) {
                        array_push($duedate_today, '【'.$task['Task']['name'].'】' .$detail['memo']);
                    // 期限が今日から過ぎているもの
                    } elseif($diff_day < 0) {
                        array_push($duedate_after, '【'.$task['Task']['name'].'】' .$detail['memo']);
                    }
                }
            }
        }
        $this->set(compact('duedate_before','duedate_today','duedate_after'));
    }

    private function columnSetting() {
        $tasksLayout = $this->TasksLayout->find('first', array('recursive' => -1));

        // カラムの設定値を取得
        $columnValue = (empty($tasksLayout)) ? TASKLAYOUT : $tasksLayout['TasksLayout']['layouts_id'];
        // カラムの設定値から実際のカラム設定を取得
        switch ($columnValue) {
            case 1:
                $columnConfig = ONE_COLUMN;
                break;
            case 2:
                $columnConfig = TWO_COLUMNS;
                break;
            case 3:
                $columnConfig = THREE_COLUMNS;
                break;
            case 4:
                $columnConfig = FOUR_COLUMNS;
                break;
            case 6:
                $columnConfig = SIX_COLUMNS;
                break;
            default:
                // 不正な値が登録されている場合
                $columnConfig = TASKLAYOUT;
        }
        return $columnConfig;
    }
}
