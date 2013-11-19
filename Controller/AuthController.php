<?php
App::uses('UserAppController', 'User.Controller');
 
/**
 * @property AuthComponent $Auth
 */
class AuthController extends UserAppController {
	
	public $uses = array('User');
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allow('login','register');
	}
	
	public function register() {
		
		if ($this->request->is('post')) {
			if ($this->User->saveAll($this->request->data,array('atomic'=>true))) {
				$this->Session->setFlash(__('Registered'));
				$this->redirect(array('action'=>'login'));
			} else {
				$this->Session->setFlash(__('Failed to register'));
				debug($this->User->validationErrors);
			}
		}
	}
	
	public function login() {
		
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Login successful'));
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Login failed'));
			}
		}
		elseif ($this->Auth->user()) {
			$this->redirect($this->Auth->redirectUrl());
		}
	}
	
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}