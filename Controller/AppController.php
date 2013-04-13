<?php

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
   public $components = array(
   		'Cookie',
   		'Session', // Important to be first for users/login
   		//'Acl',
        'Auth' => array(
        	'authorize' => array(
        		'Actions' => array('actionPath' => 'controllers') // Uses ACL
       		),      		
        	'loginAction' => array('admin' => false, 'plugin' => false, 'controller' => 'users', 'action' => 'login'),
            'loginRedirect' => array('admin' => false, 'plugin' => false, 'controller' => 'pages', 'action' => 'display', 'home'),
            'logoutRedirect' => array('admin' => false, 'plugin' => false, 'controller' => 'pages', 'action' => 'display', 'home'),
        	/* Bcrypt auth since 2.3 recomended */
			'authenticate'  => array('Blowfish' => array('scope' => array('User.active' => true))),
        	/* tradicional Auth login form */
        	//'authenticate'  => array('all' => array('scope' => array('User.active' => true)), 'Form'),        
    ));
	   
	public $helpers = array('Html', 'Js' => array('Jquery'));
	
	/**
	 * @var boolean
	 */
	public $isAdmin = false;
	
	/**
	 * @var boolean
	 */
	public $isManager = false;
	
	/**
	 * default path from Files
	 * @var string
	 */
	public $files_path = '';
	
	
	/**
	 * Relative default path from Files
	 * @var string
	 */
	public $files_path_relative = '';
	
	/**
	 * Configure main vars in before filter callback
	 */
	function beforeFilter() {
		parent::beforeFilter();
		
		// Allow home access
		//$this->Auth->allowedActions = array('display');			
		
		// Allow all access to create first admin users	
		$this->Auth->allowedActions = array();
		$this->Auth->allow();
		
		// Cambiar de idioma
		$this->_setLanguage();
		
		// isAdmin and isManager for Controllers and Views
		$this->isAdmin = $this->Auth->user('role_id') == 1;
		$this->isManager = $this->Auth->user('role_id') == 2;				
		
		// Files dir and permissions
		$this->files_path = ROOT. DS . APP_DIR . DS . 'Files' . DS;
		$this->files_path_relative = 'Files' . DS;
	}

	/**
	 *
	 * Cambiar el idioma a partir de sessión y url
	 */
	private function _setLanguage() {
		if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
			$this->Session->write('Config.language', $this->Cookie->read('lang'));
	
		}elseif ( isset($this->params['named']['language']) ) {
			$this->Session->write('Config.language', $this->params['named']['language']);
			$this->Cookie->write('lang', $this->params['named']['language'], false, '20 days');
	
		}elseif(!$this->Session->check('Config.language')){
			// Idioma por defecto
			$this->Session->write('Config.language', 'eng');
		}
	
		Configure::write('Config.language', $this->Session->read('Config.language'));
	}
	
	
	/**
	 * Create array conditions according $type
	 * @param string $alias
	 * @param string $column
	 * @param string $value
	 * @param string $type
	 * @return array $array search conditions
	 */
	private function _addCondition($alias, $column, $value, $type = 'integer')
	{
		$array = array();
	
		if(	$value == '' )
		{
			return $array;
		}
		
		$column = $alias . "." . $column;
	
		switch ($type) {
			case "integer":case "boolean":
				$array = array($column => $value);
				break;
			case "text":
				$array = array($column . " LIKE" => "%".$value."%");
				break;
			case "datetime":
				$array = array($column . " LIKE" => date('Y-m-d', strtotime($value))."%");
				break;
		}
	
		return $array;
	}	

	/**
	 *
	 * Search parameters values ​​given by an url and adds them to the redirect
	 * @param array $url url to redirect
	 * @param boolean $admin redirect to admin if true
	 *
	 */
	protected function _redirectPassedArgs($url = array(), $admin = false){
		
		if( !isset($url['action']) )
		{
			$url['action'] = 'index';
		}
		
		if($admin)
		{
			$url['admin'] = true;
		}
	
		if(isset($this->params['named'])){
			foreach($this->params['named'] as $key => $val)
				$url = array_merge(array($key => $val), $url);
		}
	
		return $url;
	}
	
	/**
	 * Add search conditions in a array from passedArgs
	 * @param Model $model
	 * @param string $formAlias Name from form alias input
	 * @return array $array conditions
	 */
	protected function _searchConditions(Model $model, $formAlias = 'Search' )
	{
		$array = array();	
		
		$len = strlen($formAlias)+1;
	
		foreach($this->passedArgs as $k => $v)
		{		
			// get column name
			$column = substr($k, $len);	
			
			if(
					($v != '') && 							// Not empty but accepts zero					
					!strncmp($k, $formAlias.".", $len) &&	// Started with $formAlias."."
					($type = $model->getColumnType($column))// Exists attibute in model
			){
				
				// set data in input form
				if( ($pos=strpos($column, ".")) !==FALSE )
				{
					$alias = substr($column, 0, $pos);
					$column = substr($column, $pos+1);
					
					$this->request->data[$formAlias][$alias][$column] = $v;
				}else{
					$alias = $model->alias;
					 
					$this->request->data[$formAlias][$column] = $v;
				}				
				
				// add condition
				$array = array_merge($array,
						$this->_addCondition($alias, $column, $v, $type)
				);						
			}
		}
		
		return $array;
	}

}
