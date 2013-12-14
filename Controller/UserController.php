<?php
App::uses('UserAppController', 'User.Controller');
 
/**
 * @property AuthComponent $Auth
 * @property User $User
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

        if (!$this->Components->loaded('Auth'))
            throw new CakeException(__('Authentication is not enabled'));

        //$this->loadModel(Configure::read('User.Auth.userModel'));
		$this->User = ClassRegistry::init(Configure::read('User.Auth.userModel'));

		$this->Auth->allow('login','register');
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
                $this->Session->setFlash(__('Login successful'));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Login failed'));
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
			if ($this->User->register($this->request->data)) {
				$this->Session->setFlash(__('Registered'));
				$this->redirect(array('action'=>'login'));
			} else {
				$this->Session->setFlash(__('Failed to register'));
			}
		}
	}

}