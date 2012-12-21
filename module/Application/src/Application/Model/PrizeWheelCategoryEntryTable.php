<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\PrizeWheelCategoryEntry;

class PrizeWheelCategoryEntryTable
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
	
	public function fetchAllByPrizeWheelId($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array('prizewheelid' => $id));
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getPrizeWheelCategoryEntry($id)
	{
		$id = (int) $id;
		
		if($id > 0){
			$results = $this->tableGateway->select(array('id' => $id));
			
			$result = $results->current();
			
			if(!$result){
				return null;
			} // if
			
			return $result;
		} // if
		else{
			throw new \Exception("ID must be greater than 0");
		} // else
 	}
 	
 	public function save(PrizeWheelCategoryEntry $prizeWheelCategoryEntry)
 	{
 		$id = (int)$prizeWheelCategoryEntry->id();
 		
 		$data = array(
 			'prizewheelid' => $prizeWheelCategoryEntry->prizeWheelId(),
 			'advertisementcategoryid' => $prizeWheelCategoryEntry->advertisementCategoryId()	
 		);
 		
 		if($id > 0){
 			if(!$this->getPrizeWheelCategoryEntry($id)){
 				throw new \Exception("Cannot locate Prize Wheel Category Entry with ID $id");
 			} // if
 			else{
 				$this->tableGateway->update($data, array('id' => $id));
 			} // else
 		} // if
 		else{
 			$this->tableGateway->insert($data);
 			$prizeWheelCategoryEntry->id((int)$this->tableGateway->lastInsertValue);
 		} // else
 	}
 	
 	public function delete($id)
 	{
 		$id = (int)$id;
 		
 		$this->tableGateway->delete(array('id' => $id));
 	}
 	
 	public function deleteAllByPrizeWheelId($id)
 	{
 		$id = (int)$id;
 		
 		$this->tableGateway->delete(array('prizewheelid' => $id));
 	}
 	
 	public function deleteAllByCategoryId($id)
 	{
 		$id = (int)$id;
 		
 		$this->tableGateway->delete(array('advertisementcategoryid' => $id));
 	}
}