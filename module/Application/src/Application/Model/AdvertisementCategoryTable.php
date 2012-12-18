<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class AdvertisementCategoryTable
{
	protected $tableGateway = null;
	
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
		}
		
		return $list;
	}
	
	public function getAdvertisementCategory($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
}