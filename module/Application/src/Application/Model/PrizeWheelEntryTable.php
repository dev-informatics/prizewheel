<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Application\Model\PrizeWheelEntry;

class PrizeWheelEntryTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll()
	{
		$results = $this->tableGateway->select();
		return $results;
	}
	
	public function fetchAllByPrizeWheelId($prizewheelid, $skip=0, $take=25)
	{
		$prizewheelid = (int)$prizewheelid;
		
		$select = new Select();
		$select->where(array('prizewheelid' => $prizewheelid));
		$select->limit($take);
		$select->offset($skip);
		
		$results = $this->tableGateway->selectWith($select);
		
		return $results;
	}
	
	public function getPrizeWheelEntry($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!result){
			return null;
		} // if
		
		return $result;
	}
	
	public function savePrizeWheelEntry(PrizeWheelEntry $prizeWheelEntry)
	{
		$id = (int)$prizeWheelEntry->id();
		
		$data = $prizeWheelEntry->getArrayCopy();
		unset($data['id']);
		
		if($id > 0){
			if(!$this->getPrizeWheelEntry($id)){
				throw new \Exception("A Prize Wheel Entry with id $id cannot be found.");
			} // if
			else{
				$this->tableGateway->update($data, array('id' => $id));
			} // else
		} // if
		else{
			$this->tableGateway->insert($data);
			$prizeWheelEntry->id((int)$this->tableGateway->lastInsertValue);
		}
	}
}