<?php
App::uses('AppModel','Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

	class User extends AppModel {
		
		public $validate = array(
			'username' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
				),
			),
			'email' => array(
				'email' => array(
					'rule' => array('email'),
				),
				'notEmpty' => array(
					'rule' => array('notEmpty'),
				),
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
				),
				'minLength' => array(
					'rule' => array('minLength','8'),
					'message' => 'Password must be at least 8 characters long',
				),
			),
		);
		public $hasMany = array(
			'Profile' => array(
				'className' => 'Profile',
				'foreignKey' => 'user_id',
				'dependent' => FALSE
				),
			);

	/** Hashes passwords **/
	public function beforeSave($options = array()) {
		if (!empty($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}	
	}
}
