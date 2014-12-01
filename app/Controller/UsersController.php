<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	
	public function generateActivationCode($data){
		return Security::hash(serialize($data).microtime().rand(1, 100), null, true);
	}
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index','register','activate');
	}
	
	public function register(){
		if($this->request->is('post')){
			if(!($this->data['User']['password1'] === $this->data['User']['password2'])){
				$this->Session->setFlash(__('Passwords do not match', TRUE));
				return;
			}
			if(strlen($this->data['User']['password1']) < 8 || strlen($this->data['User']['password2']) < 8){
				$this->Session->setFlash(__('Password must be at least 8 characters long.'));
				return;
			}
			$this->request->data['User']['password'] = $this->data['User']['password1'];
			$this->request->data['User']['validation'] = $this->generateActivationCode($this->data);
			
			$this->User->create();
			if($this->User->save($this->request->data)){
				
				$email = new CakeEmail('default');
				$email->viewVars(array('user' => $this->data['User'],'user_id' => $this->User->getLasInsertID()));
				$email->template('welcome')
					->emailFormat('html')
					->to($this->data['User']['email'])
					->subject('Welcome to Playermatch.com')
					->send();
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again'));
			}
		}
	}
}
?>