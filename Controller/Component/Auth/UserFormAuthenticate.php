<?php
App::uses('FormAuthenticate', 'Controller/Component/Auth');

class UserFormAuthenticate extends FormAuthenticate {

	public function __construct(ComponentCollection $collection, $settings) {

		$settings = Hash::merge(array(
			'fields' => array(
				'username' => 'email',
				'password' => 'password'
			),
			'userModel' => Configure::read('User.Auth.userModel'),
			'scope' => array(
				'allow_login' => true
			)
		), $settings);

		parent::__construct($collection, $settings);
	}
}