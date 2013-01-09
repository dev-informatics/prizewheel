<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class ConfigurationEntryTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll()
	{
		$results = $this->tableGateway->select();
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getConfigurationEntry($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array('id' => $id));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function getConfigurationEntryByName($name)
	{
		$name = (string)$name;
		
		$results = $this->tableGateway->select(array('name' => $name));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function save(\Application\Model\ConfigurationEntry $entry)
	{
		$id = (int)$entry->id();
		
		$data = array(
			'name' => $entry->name(),
			'value' => $entry->value()	
		);

		if($id > 0){
			if(!$this->getConfigurationEntry($id)){
				throw new \Exception("Configuration Value with id $id does not exist!");
			} // 
			
			$this->tableGateway->update($data, array('id' => $id));
		} // if
		else{
			$this->tableGateway->insert($data);
			$entry->id((int)$this->tableGateway->lastInsertValue);
		} // else
	}
}