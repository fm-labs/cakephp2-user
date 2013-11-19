<?php
App::uses('AuthComponent', 'Controller/Component');
 
class UserAuthComponent extends AuthComponent {

	public $loginAction = array(
		'plugin' => 'user',
		'controller' => 'auth',
		'action' => 'login'	
	);
	
	public $authenticate = array(
		'Form' => array(
			'userModel' => 'User.UserLogin',
			'contain' => array('User')
		)		
	);
}