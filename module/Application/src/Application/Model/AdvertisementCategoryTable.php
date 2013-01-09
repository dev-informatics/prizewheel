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
	
	public function fetchAll($page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
		       ->order('name')
			   ->offset(($page - 1) * $size)
			   ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCount();
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function fetchAllEnabled()
	{
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
		       ->where(array('enabled' => 1))
		       ->order('name');
		
		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getCount()
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement('SELECT count(id) as count FROM advertisement_categories');
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
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
	
	public function save(AdvertisementCategory $advertisementCategory)
	{
		$id = (int)$advertisementCategory->id();

		$data = array(
			'name' => $advertisementCategory->name(),
			'description' => $advertisementCategory->description(),
			'clickrate' => $advertisementCategory->clickRate(),
			'impressionrate' => $advertisementCategory->impressionRate(),
			'enabled' => $advertisementCategory->enabled() ? 1 : 0	
		);
		
		if($id > 0){
			if(!$this->getAdvertisementCategory($id)){
				throw new \Exception("Could not locate an Advertisement Category with id $id");
			} // if
			else{
				$this->tableGateway->update($data, array('id' => $id));
			} // else
		} // if
		else{
			$this->tableGateway->insert($data);
			$advertisementCategory->id((int)$this->tableGateway->lastInsertValue);
		} // else
	}
}