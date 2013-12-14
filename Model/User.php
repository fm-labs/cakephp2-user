<?php
App::uses('UserAppModel', 'User.Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Class User
 */
class User extends UserAppModel {

	public $actsAs = array('Containable');

	public $validate = array(
		'email' => array(
			'required' => array(
				'rule' => array('email'),
				'message' => 'Enter a valid email address',
				'required' => true,
				'last' => true,
				'on' => 'create',
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Enter a valid email address',
				'allowEmpty' => false,
				'last' => true,
				'on' => 'update',
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This email address is already taken',
			)
		),
		/*
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter a valid username',
				'required' => true,
				'last' => true,
				'on' => 'create'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This username is already taken',
				'allowEmpty' => false,
			),
		),
		*/
		'first_name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter your first name',
				'required' => true,
				'last' => true,
				'on' => 'create'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter your first name',
			)
		),
		'last_name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter your last name',
				'required' => true,
				'last' => true,
				'on' => 'create'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter your last name',
			)
		),
		'pass' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Password is required',
				'required' => true,
				'last' => true,
				'on' => 'create',
			),
			'minLength' => array(
				'rule' => array('minLength', '8'),
				'message' => 'Minimum 8 characters long',
				'allowEmpty' => false,
			)
		),
		'pass2' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Repeat the password',
				'last' => true
			),
			'repeat' => array(
				'rule' => array('validateRepeat', 'pass'),
				'message' => 'Passwords do not match!'
			)
		),
		/*
		'pass_old' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			)
		),
		*/
	);

	/*
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id, $table, $ds);
	}
	*/

/**
 * Validates that a field is an exact duplicate of another field
 *
 * @param array $check
 * @param string $field Name of 'master' field
 * @return boolean Returns TRUE, if value in master-field matches the check value
 */
	public function validateRepeat($check, $field) {
		if (count($check) > 1) {
			return false;
		}

		//$_field = key($check);
		$_check = current($check);

		return $_check === $this->data[$this->alias][$field];
	}

/**
 * (non-PHPdoc)
 * @see Model::beforeValidate()
 */
	public function beforeValidate($options = array()) {
		// make sure the password validation field (pass2) is present, if password field (pass) is set
		if (array_key_exists('pass', $this->data[$this->alias]) && !isset($this->data[$this->alias]['pass2'])) {
			$this->data[$this->alias]['pass2'] = '';
		}

		// reset password
		// TODO: re-evaluate usefulness or refactor
		if (isset($this->data[$this->alias]['pass_old'])) {
			$oldPass = AuthComponent::password($this->data[$this->alias]['pass_old']);
			#$this->id = $this->data[$this->alias]['id'];
			#$this->Behaviors->disable('*');
			if (!$this->find('first', array(
				'recursive' => -1,
				'conditions' => array(
					'id' => $this->data[$this->alias]['id'],
					'password' => $oldPass
				)
			))) {
				$this->invalidate('pass_old', __d('user', "The current password does not match"));
			}
		}

		return true;
	}

/**
 * (non-PHPdoc)
 * @see Model::beforeSave()
 */
	public function beforeSave($options = array()) {
		// disallow direct access to password field
		if (array_key_exists('password', $this->data[$this->alias])) {
			unset($this->data[$this->alias]['password']);
		}

		// generate password
		if (array_key_exists('pass', $this->data[$this->alias]) && !empty($this->data[$this->alias]['pass'])) {
			$this->data[$this->alias]['password'] = $this->_generatePassword($this->data[$this->alias]['pass']);
			unset($this->data[$this->alias]['pass']);
			unset($this->data[$this->alias]['pass2']);
		}
		return true;
	}

/**
 * Generate Password from plain-text password
 *
 * @param string $password
 * @return string
 */
	protected function _generatePassword($password) {
		return AuthComponent::password($password);
	}

/**
 * @param $data
 * @return bool|mixed
 */
	public function register($data) {
		if (!isset($data[$this->alias])) {
			return false;
		}

		if (isset($data[$this->alias]['id'])) {
			unset($data[$this->alias]['id']);
		}

		$this->create();
		return $this->saveAll($data, array('atomic' => true));
	}

/**
 * Wrapper for Model::save()
 *
 * @param array $data
 * @return mixed|boolean
 * @todo Refactor
 */
	public function saveAdd($data) {
		//$data[$this->alias]['published'] = false;

		$this->create();
		return $this->save($data, true);
	}

/**
 * Wrapper for Model::save()
 * Ignores password fields if not set
 *
 * @param array $data
 * @return mixed
 * @todo Refactor
 */
	public function saveEdit() {
		if (array_key_exists('pass', $data[$this->alias]) && empty($data[$this->alias]['pass'])) {
			unset($data[$this->alias]['pass']);
			unset($data[$this->alias]['pass2']);
			$this->validator()->remove('pass')->remove('pass2');
		}
		return $this->save($data);
	}
}