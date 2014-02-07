<?php
App::uses('UserAppController', 'User.Controller');

/**
 * @property AuthComponent $Auth
 * @property UserUser $User
 */
class UserController extends UserAppController {

	public $uses = array();

/**
 * @var
 */
	public $User;

/**
 * @see Controller::beforeFilter()
 * @throws CakeException
 */
	public function beforeFilter() {
		parent::beforeFilter();

		if (!$this->Components->loaded('Auth')) {
			throw new CakeException(__('Authentication is not enabled. Please enable the Auth component in your AppController'));
		}

		if (!Configure::read('User.Auth')) {
			throw new CakeException(__('User plugin is not configured correctly. Configuration missing.'));
		}

		$this->User = ClassRegistry::init(Configure::read('User.Auth.userModel'));

		$this->Auth->allow('login', 'register');
	}

/**
 * Login method
 */
	public function login() {
		if ($this->Auth->user()) {
			$this->redirect($this->Auth->redirectUrl());
			return;
		}

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Login successful'), 'User.flash/login_success');
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Login failed'), 'User.flash/login_failure');
				return;
			}
		}
	}

/**
 * Logout method
 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

/**
 * Register method
 */
	public function register() {
		if ($this->request->is('post')) {
			debug($this->request->data);
			if ($this->User->register($this->request->data)) {
				$this->Session->setFlash(__('Registered'));
				$this->redirect(array('action' => 'login'));
			} else {
				debug($this->User->validationErrors);
				$this->Session->setFlash(__('Failed to register'));
			}
		}

		$this->set('modelName', $this->User->alias);
	}

/**
 * User Account overview
 */
	public function view() {
		$this->set('user', $this->Auth->user());
	}
}