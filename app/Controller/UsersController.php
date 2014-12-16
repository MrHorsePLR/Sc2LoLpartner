<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $components = array('Paginator');
	
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
				$this->Session->setFlash('Passwords do not match', TRUE);
				return;
			}
			if(strlen($this->data['User']['password1']) < 8 || strlen($this->data['User']['password2']) < 8){
				$this->Session->setFlash('Password must be at least 8 characters long.');
				return;
			}
			$this->request->data['User']['password'] = $this->data['User']['password1'];
			$this->request->data['User']['verification_code'] = $this->generateActivationCode($this->data);
			
			$this->User->create();
			if($this->User->save($this->request->data)){
				
				$email = new CakeEmail('default');
				$email->viewVars(array('user' => $this->data['User'],'user_id' => $this->User->getLasInsertID()));
				$email->template('welcome')
					->emailFormat('html')
					->to($this->data['User']['email'])
					->subject('Welcome to Playermatch.com')
					->send();
				$this->Session->setFlash('The user has been saved');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again');
			}
		}
	}
	Public function login() {
		if($this->request->is('post')) {
			if ($this->Auth->login()) {
				if ($this->Auth->user('is_active') != 0) {
					$this->redirect($this->Auth->redirect());	
				} else {
					$this->Session->setFlash('Your account is not active yet, please activate it before logging in.');
					$this->Auth->logout();
				}
				
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}
	public function logout(){
		return $this->redirect($this->Auth->logout());
	}
	public function index(){
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}
/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if (!($this->data['User']['password3'] === $this->data['User']['password4'])) {
				$this->Session->setFlash(__('Passwords do not match.', true));
				return;
			}
			if (strlen($this->data['User']['password3']) == 0) {
				
				$user = $this->User->read(null,$id);
				$this->data['User']['password'] = $user['User']['password'];
			} else {
				$this->data['User']['password'] = $this->data['User']['password3'];
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
	}	
}
?>