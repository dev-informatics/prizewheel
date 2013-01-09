<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\AdvertisementCategoryEntry;

class AdvertisementCategoryEntryTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAllByAdvertisementId($advertisementid)
	{
		$advertisementid = (int)$advertisementid;
		$results = $this->tableGateway->select(array('advertisementid' => $advertisementid));
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function fetchAllByCategoryId($categoryid)
	{
		$categoryid = (int)$categoryid;
		$results = $this->tableGateway->select(array('advertisementcategoryid' => $categoryid));
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getAdvertisementCategoryEntry($id)
	{
		$id = (int)$id;
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!result){
			return null;
		} // if
		
		return $result;
	}
	
	public function save(AdvertisementCategoryEntry $advertisementCategoryEntry)
	{
		$id = (int)$advertisementCategoryEntry->id();
		
		$data = array(
			'advertisementcategoryid' => $advertisementCategoryEntry->advertisementCategoryId(),
			'advertisementid' => $advertisementCategoryEntry->advertisementId()	
		);
		
		if($id > 0){
			if(!$this->getAdvertisementCategoryEntry($id)){
				throw new \Exception("Could not locate an Advertisement Category Entry with the id $id");
			} // if
			else{
				$this->tableGateway->update($data, array('id' => $id));
			} // else
		} // if
		else{
			$this->tableGateway->insert($data);
			$advertisementCategoryEntry->id((int)$this->tableGateway->lastInsertValue);
		} // else
	}
	
	/**
	 * 
	 * @param array $categories
	 */
	public function saveArray(array $categories)
	{
		foreach($categories as $category){
			if($category instanceof \Application\Model\AdvertisementCategoryEntry){
				$this->save($category);
			} // if
		} // foreach
	}
	
	public function delete($id)
	{
		$id = (int)$id;
		$this->tableGateway->delete(array('id' => $id));
	}
	
	public function deleteByAdvertisementId($advertisementid)
	{
		$advertisementid = (int)$advertisementid;
		$this->tableGateway->delete(array('advertisementid' => $advertisementid));
	}
	
	public function deleteByCategoryId($categoryid)
	{
		$categoryid = (int)$categoryid;
		$this->tableGateway->delete(array('advertisementcategoryid' => $categoryid));
	}
}