<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public $components = array('Cookie');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'custom';

        // ユーザー自身による登録とログアウトを許可する
        $this->Auth->allow('add', 'logout');

    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                echo "Invalid username or password, try again";
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->User->recsursive = 0;
        if ($this->Cookie->check('status')) {
            $this->set('status', $this->Cookie->read('status'));
            $this->Cookie->delete('status');
            $this->set('users', $this->paginate());
        } else {
            $this->set('users', $this->paginate());
        }
        // $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->recsursive = 0;
        $this->set('users', $this->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Cookie->write('status', 'The user has been saved');
                // return $this->redirect(array('action' => 'index'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Cookie->write('status', 'The user could not be saved. Please, try again.');
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Cookie->write('status', 'The user has been saved');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Cookie->write('status', 'The user could not be saved. Please, try again.');
        } else {
            $this->request->data = $this->User->findByid($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Cookie->write('status', 'User deleted');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Cookie->write('status', 'User was not deleted');
        return $this->redirect(array('action' => 'index'));
    }
}
