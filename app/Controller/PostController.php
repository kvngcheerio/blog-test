<?php

// App::uses('AppController', 'Controller');

class PostController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Blog updated'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Post could not be saved. Please, try again.')
            );
        }
    }
}