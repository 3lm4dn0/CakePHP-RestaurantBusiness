<?php
App::uses('AppController', 'Controller');
/**
 * Services Controller
 *
 * @property Service $Service
 */
class ServicesController extends AppController {

	/**
	 * search method
	 * @param $admin if is true redirects to admin index page. Default false.
	 */
	public function search($admin = false)
	{
		$url = array();
	
		if(isset($this->passedArgs['redirect'])){
			$url['action'] = $this->passedArgs['redirect'];
		}
	
		// build a URL will all the search elements in it
		foreach ($this->data as $k => $v){
			foreach ($v as $k2 => $v2){
				$url[$k . "." .$k2] = $v2;
			}
		}
	
		// redirect the user to the url
		$this->redirect(
				$this->_redirectPassedArgs($url, $admin),
				null, true);
	}	
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Service->recursive = 0;
		
		$conditions = array_merge(
						array('Service.validated' => 1),
						$this->_searchConditions($this->Service)
						);
		
		if( isset($this->passedArgs['Search.service']) )
		{
			$conditions = array_merge(
					array('Service.validated' => 1),
					array('OR' => array( 
						'Service.name LIKE' => '%'.$this->passedArgs['Search.service'].'%',
						'Service.intro LIKE' => '%'.$this->passedArgs['Search.service'].'%',
						'Service.description LIKE' => '%'.$this->passedArgs['Search.service'].'%'),
					)
			);
			
			$this->request->data['Search']['service'] = $this->passedArgs['Search.service'];
		}
		
		$this->paginate = array(
				'conditions' => $conditions,
				'order' => 'Service.name'				
				);
		
		$services = $this->paginate();
		
		$sidebar_list = $this->Service->Category->find('list');
		
		$this->set(compact('services', 'sidebar_list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Service->exists($id)) {
			throw new NotFoundException(__('Invalid service'));
		}
		$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id,
				'Service.validated' => 1
				));
		
		$service = $this->Service->find('first', $options);
		
		if(empty($service)){
			throw new NotFoundException(__('Invalid service'));
		}
		
		$this->set('service', $service);
	}
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Service->recursive = 0;				
		
		$this->paginate = array(
				'conditions' => $this->_searchConditions($this->Service),
				'order' => 'Service.name'
		);		
		
		$services = $this->paginate();
		
		$this->set(compact('services'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Service->create();
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Service->Category->find('list');
		$this->set(compact('categories'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Service->exists($id)) {
			throw new NotFoundException(__('Invalid service'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
			$this->request->data = $this->Service->find('first', $options);
		}
		$categories = $this->Service->Category->find('list');
		$this->set(compact('categories'));
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
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Service->delete()) {
			$this->Session->setFlash(__('Service deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Service was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
