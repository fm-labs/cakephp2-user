<?php
App::uses('FormAuthenticate', 'Controller/Component/Auth');

/**
 * Class UserFormAuthenticate
 *
 * A wrapper for FormAuthenticate optimized
 * to work smoothly with the User plugin.
 * Enables easy integration with the AuthComponent.
 *
 * Usage:
 * In Controller:
 *
 * public $components = array('Auth' => array('authenticate' => 'User.UserForm'));
 *
 */
class UserFormAuthenticate extends FormAuthenticate {

	public function __construct(ComponentCollection $collection, $settings) {
		$userModel = (Configure::read('User.Auth.userModel'))
			? Configure::read('User.Auth.userModel')
			: 'User.User';

		$settings = Hash::merge(array(
			'fields' => array(
				'username' => 'email',
				'password' => 'password'
			),
			'userModel' => $userModel,
			'scope' => array(
				'allow_login' => true
			)
		), $settings);

		parent::__construct($collection, $settings);
	}
}