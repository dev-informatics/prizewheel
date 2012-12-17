<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\PrizeWheel;

class PrizeWheelTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	} // ctor
	
	public function fetchAll()
	{
		$results = $this->tableGateway->select();
		
		return $results;
	}
	
	public function fetchAllByAffiliateId($affiliateid, $skip=0, $take=25)
	{
		$affiliateid = (int)$affiliateid;
		
		$select = new \Zend\Db\Sql\Select("prizewheels");
		
		$select->where(array('affiliateid' => $affiliateid));
		$select->offset($skip);
		$select->limit($take);
	
		$results = $this->tableGateway->selectWith($select);
		
		return $results;
	}
	
	public function getPrizeWheel($prizewheelid)
	{
		$prizewheelid = (int)$prizewheelid;
		$results = $this->tableGateway->select(array('id' => $prizewheelid));
		$result = $results->current();
		
		if(!result){
			return null;
		} // if
		
		return $result;
	}
	
	public function savePrizeWheel(PrizeWheel $prizeWheel)
	{
		$id = (int)$prizeWheel->id();
		
		$data = $prizeWheel->getArrayCopy();
		unset($data['id']);
		
		if($id > 0){
			if(!$this->getPrizeWheel($id)){
				throw new \Exception("Could not locate PrizeWheel with the id $id");
			} // if
			else{
				$this->tableGateway->update($data, array('id' => $id));
 			} // else
 		} // if
		else{
			$this->tableGateway->insert($data);
			$prizeWheel->id((int)$this->tableGateway->lastInsertValue);
		} // else
	}
}