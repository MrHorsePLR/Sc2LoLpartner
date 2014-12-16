<?php
App::uses('AppController', 'Controller');
/**
 * Requests Controller
 *
 * @property Request $Request
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RequestsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Request->recursive = 0;
		$this->set('requests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
		$this->set('request', $this->Request->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Request->create();
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		}
		$profiles = $this->Request->Profile->find('list');
		$this->set(compact('profiles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
			$this->request->data = $this->Request->find('first', $options);
		}
		$profiles = $this->Request->Profile->find('list');
		$this->set(compact('profiles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Request->delete()) {
			$this->Session->setFlash(__('The request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The request could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Request->recursive = 0;
		$this->set('requests', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
		$this->set('request', $this->Request->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Request->create();
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		}
		$profiles = $this->Request->Profile->find('list');
		$this->set(compact('profiles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
			$this->request->data = $this->Request->find('first', $options);
		}
		$profiles = $this->Request->Profile->find('list');
		$this->set(compact('profiles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Request->delete()) {
			$this->Session->setFlash(__('The request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The request could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
