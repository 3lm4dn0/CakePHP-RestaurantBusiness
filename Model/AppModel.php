<?php

App::uses('Model', 'Model');

class AppModel extends Model {
	
	/**
	 * Check isUnique for one or more fields
	 * 
	 * @param array $ignoredData
	 * @param array $fields
	 * @param boolean $or if true check is unique for one field from $fields
	 * @link http://stackoverflow.com/questions/2461267/cakephp-isunique-for-2-fields
	 */
	public function checkUnique($ignoredData, $fields, $or = false)
	{
		return $this->isUnique($fields, $or);
	}
	
	/**
	 * Check if name value is equals to new_name
	 * @param array $data
	 */
	public function isSame($data)
	{
		if( isset($this->data[$this->name]['name']) )
		{
			$keyword = $this->data;
		}else{
			$keyword = $this->find('first', array('conditions' => array(
					$this->name . '.' . $this->primaryKey => $this->data[$this->name][$this->primaryKey]
			)));
		}
	
		return $data['new_name'] != $keyword[$this->name]['name'];
	}	
}