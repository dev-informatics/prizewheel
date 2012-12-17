<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class PrizeWheelAdvertisementCategoryEntryTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	} // ctor
	
	public function fetchAllByPrizeWheelId($prizewheelid)
	{
		$id = (int)$prizewheelid;
		
		$results = $this->tableGateway->select(array('prizewheelid' => $id));
		return $results;
	}
	
	public function fetchAllByCategoryId($categoryid)
	{
		$id = (int)$categoryid;
		$results = $this->tableGateway->select(array('advertisementcategoryid' => $id));
		return $results;
	}
	
	public function getPrizeWheelAdvertisementCategoryEntry($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function save(PrizeWheelAdvertisementCategoryEntry $entry)
	{
		$id = (int)$entry->id();
		
		$data = array(
			'prizewheelid' => $entry->prizeWheelId(),
			'advertisementcategoryid' => $entry->advertisementCategoryId()	
		);
		
		if($id > 0){
			if(!$this->getPrizeWheelAdvertisementCategoryEntry($id)){
				throw new \Exception("Could not locate Prize Wheel Advertisement Category Entry by id $id");
			} // if
			else{
				$this->tableGateway->update($data, array('id' => $id));
			} // else
		} // if
		else{
			$this->tableGateway->insert($data);
			$entry->id((int)$this->tableGateway->lastInsertValue);
		} // else
 	}
 	
 	public function saveArray(array $entries)
 	{
 		foreach($entries as $entry){
 			if($entry instanceof PrizeWheelAdvertisementCategoryEntry){
 				$this->save($entry);
 			} // if
 		} // foreach
 	}
 	
 	public function deleteByPrizeWheelId($prizewheelid)
 	{
 		$id = (int)$prizewheelid;
 		$this->tableGateway->delete(array('prizewheelid' => $id));
 	}
 	
 	public function deleteByCategoryId($categoryid)
 	{
 		$id = (int)$categoryid;
 		$this->tableGateway->delete(array('advertisementcategoryid' => $categoryid));
 	}
}