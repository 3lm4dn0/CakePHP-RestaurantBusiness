<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public $paginate = array(
			'order' => 'last_login DESC',
	);
	
	/**
	* @see AppController::beforeFilter()
	*/
	function beforeFilter() {
		parent::beforeFilter();
//		$this->Auth->allowedActions = array('login', 'initDB', 'admin_index', 'admin_edit', 'admin_add');

		// We can remove initDB after we're finished
	}
	
	/**
	 * This method init ACLs	 
	 * 
	 * @see http://book.cakephp.org/2.0/en/tutorials-and-examples/simple-acl-controlled-application/part-two.html
	 */
	public function initDB() {
		$group = $this->User->Role;
		//Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');		
		

		//allow users to only add and edit on posts and widgets
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Users/login');
		$this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/Users/changePassword');
		
		$this->Acl->allow($group, 'controllers/Faqs/index');

		//we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;		
	}

	/**
	 * Login method
	 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				// Set last login
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login', date('Y-m-d H:i:s'));
				
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect.'));
				$this->request->data['User']['password'] = "";
			}
		}
				
		if($this->Auth->user('id'))
		{
				$this->redirect($this->Auth->redirectUrl());		
		}
	}	
	
	/**
	 * Logout method
	 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}	
	
	public function register(){
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				
				$this->data['User']['role_id'] = 3;
				
				$this->Session->setFlash(__('Congratulations. Your account have been register'));
				$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
			} else {
				$this->Session->setFlash(__('Your account could not be created. Please, try again.'));
			}
		}		
	}

/**
 * edit and change password method
 *
 * @throws NotFoundException
 * @return void
 */
	public function changePassword() {
		$this->User->id = $this->Auth->user('id');
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			
			$fieldList = array('password', 'old_password', 'repit_password');
			
			if ($this->User->save($this->request->data, true, $fieldList)) {
				$this->Session->setFlash(__('The user password has been changed'));
				$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				foreach($this->User->validationErrors as $v => $k){					
					if($v == 'password'){
						$this->request->data['User']['repit_password'] = "";
					}
					$this->request->data['User'][$v] = "";
				}				
			}
		} else {
			$options = array('fields' => 'id', 'conditions' => array('User.' . $this->User->primaryKey => $this->User->id));
			$this->request->data = $this->User->find('first', $options);			
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}			
			
		if ($this->request->is('post') || $this->request->is('put')) {

			$fieldList = array('role_id', 'active');
			
			if ($this->User->save($this->request->data, true, $fieldList)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('fields' => array('id', 'username', 'role_id', 'active'), 'conditions' => array('User.' . $this->User->primaryKey => $id));			
			$this->request->data = $this->User->find('first', $options);			
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}
	
	/**
	 * admin reset password method
	 *
	 * @throws NotFoundException
	 * @return void
	 */
	public function admin_changePassword($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
	
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$fieldList = array('password', 'repit_password');
			
			if ($this->User->save($this->request->data, true, $fieldList)) {
				$this->Session->setFlash(__('The user password has been changed'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				foreach($this->User->validationErrors as $v => $k){
					if($v == 'password'){
						$this->request->data['User']['repit_password'] = "";
					}
					$this->request->data['User'][$v] = "";
				}
			}
		} else {
			$options = array('fields' => array('id', 'username', 'role_id'), 'conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}	

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
