<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class PrizeWheelTypeTable
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
	
	public function getPrizeWheelType($id)
	{
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
}