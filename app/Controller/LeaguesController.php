<?php
App::uses('AppController', 'Controller');
/**
 * Leagues Controller
 *
 * @property League $League
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LeaguesController extends AppController {

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
		$this->League->recursive = 0;
		$this->set('leagues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->League->exists($id)) {
			throw new NotFoundException(__('Invalid league'));
		}
		$options = array('conditions' => array('League.' . $this->League->primaryKey => $id));
		$this->set('league', $this->League->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->League->create();
			if ($this->League->save($this->request->data)) {
				$this->Session->setFlash(__('The league has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The league could not be saved. Please, try again.'));
			}
		}
		$games = $this->League->Game->find('list');
		$this->set(compact('games'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->League->exists($id)) {
			throw new NotFoundException(__('Invalid league'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->League->save($this->request->data)) {
				$this->Session->setFlash(__('The league has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The league could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('League.' . $this->League->primaryKey => $id));
			$this->request->data = $this->League->find('first', $options);
		}
		$games = $this->League->Game->find('list');
		$this->set(compact('games'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->League->id = $id;
		if (!$this->League->exists()) {
			throw new NotFoundException(__('Invalid league'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->League->delete()) {
			$this->Session->setFlash(__('The league has been deleted.'));
		} else {
			$this->Session->setFlash(__('The league could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	// list

	public function lists() {
		if ($this->request->is('post')) {
			$game_id = $this->request->data['game_id'];
			
			$leagues = $this->League->find('list', array(
				'conditions' => array('League.game_id' => $game_id),
				'recursive' => -1));
				$this->set('leagues', $leagues);
				$this->layout = 'ajax';
				
		//	echo json_encode($res);
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->League->recursive = 0;
		$this->set('leagues', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->League->exists($id)) {
			throw new NotFoundException(__('Invalid league'));
		}
		$options = array('conditions' => array('League.' . $this->League->primaryKey => $id));
		$this->set('league', $this->League->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->League->create();
			if ($this->League->save($this->request->data)) {
				$this->Session->setFlash(__('The league has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The league could not be saved. Please, try again.'));
			}
		}
		$games = $this->League->Game->find('list');
		$this->set(compact('games'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->League->exists($id)) {
			throw new NotFoundException(__('Invalid league'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->League->save($this->request->data)) {
				$this->Session->setFlash(__('The league has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The league could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('League.' . $this->League->primaryKey => $id));
			$this->request->data = $this->League->find('first', $options);
		}
		$games = $this->League->Game->find('list');
		$this->set(compact('games'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->League->id = $id;
		if (!$this->League->exists()) {
			throw new NotFoundException(__('Invalid league'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->League->delete()) {
			$this->Session->setFlash(__('The league has been deleted.'));
		} else {
			$this->Session->setFlash(__('The league could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
