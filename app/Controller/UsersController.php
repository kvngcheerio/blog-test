<?php
App::uses('AppController', 'Controller');


class UsersController extends AppController {
    public $helpers = array('Html','Form');
    
    public $components = array('Paginator', 'Flash');
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.username' => 'asc' ) 
    );
    

    // public function beforeFilter() {
    //     parent::beforeFilter();
    //     $this->Auth->allow('login','add','register'); 
    // }
     
 
 
    // public function login() {
         
    //     //if already logged-in, redirect
    //     if($this->Session->check('Auth.User')){
    //         $this->redirect(array('action' => 'index'));      
    //     }
         
    //     // if we get the post information, try to authenticate
    //     if ($this->request->is('post')) {
    //         if ($this->Auth->login()) {
    //            $this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
    //             //$this->Flash->success(__('Welcome, '. $this->Auth->user('username')));
    //             $this->redirect($this->Auth->redirectUrl());
    //         } else {
    //             $this->Session->setFlash(__('Invalid password'));
    //         }
    //     } 
    // }

    public function login() {
        if ($this->request->is('post')) {
            // Important: Use login() without arguments! See warning below.
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
                // Prior to 2.3 use
                // `return $this->redirect($this->Auth->redirect());`
            }
            $this->Flash->error(
                __('Username or password is incorrect')
            );
            // Prior to 2.7 use
            // $this->Session->setFlash(__('Username or password is incorrect'));
        }
    }
 
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Registration Successful'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
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
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}