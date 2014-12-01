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
					'message' => 'La contraseña debe tener al menos 8 caracteres',
				),
			),
		);
		public $hasMany = array(
			'Resquest' => array(
				'className' => 'Request',
				'foreignKey' => 'user_id',
				'dependent' => FALSE
				),
			'Profile' => array(
				'className' => 'Profile',
				'foreignKey' => 'user_id',
				'dependent' => FALSE
				),
			);
	}
?>