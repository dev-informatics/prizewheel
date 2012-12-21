<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Advertisement;

class AdvertisementTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAllByAdvertiserId($id)
	{		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from('advertisements')
		       ->join(array('adt' => 'advertisement_types'), 'advertisements.typeid = adt.id', array('typename' => 'name'))
			   ->join(array('apt' => 'advertisement_placement_types'), 'apt.id = advertisements.advertisementplacementtypeid', array('placementtypename' => 'name'))
			   ->where(array('advertiserid' => $id));

		$results = $this->tableGateway->selectWith($select);
	
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	/**
	 * 
	 * @param int $id
	 * @return array:unknown
	 */
	public function fetchAllEnabledByAdvertiserId($id)
	{
		$select = new \Zend\Db\Sql\Select();
		
		$select->from('advertisements')
		       ->join(array('adt' => 'advertisement_types'), 'advertisements.typeid = adt.id', array('typename' => 'name'))
			   ->join(array('apt' => 'advertisement_placement_types'), 'apt.id = advertisements.advertisementplacementtypeid', array('placementtypename' => 'name'))
			   ->where(array('advertiserid' => $id, 'advertisements.enabled' => 1));	       

		$results = $this->tableGateway->selectWith($select);
		
		// Creating a list to return back to the caller
		// as an array of Advertisement objects. This is contrary
		// to the ArrayObject ResultSet, which I am not convinced
		// is the best way to return data to callers because you cannot
		// rewind the ResultSet once iterated through. Plus I've never
		// liked returning DB layer instances out of the layer.
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getAdvertisement($id)
	{
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();

		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function getCountOfPlacementType($placementTypeId, $categories=array())
	{
		$id = (int)$placementTypeId;
		
		$query = "";
		
		if(count($categories) > 0){
			$query = "SELECT count(advertisements.id) as `count` FROM `advertisements` INNER JOIN `advertisement_category_entries` ace ON ace.advertisementid = advertisements.id WHERE advertisementplacementtypeid = ? AND ace.advertisementcategoryid IN (";
			
			foreach($categories as $category){
				$query .= $category . ",";
			} // foreach
			
			$query = rtrim($query, ',');
			
			$query .= ")";
		} // if
		else{
			$query = "SELECT count(id) as `count` FROM `advertisements` WHERE advertisementplacementtypeid = ?";
		} // else
		
		$stmt = $this->tableGateway->getAdapter()->createStatement($query, array($id));
		
		$results = $stmt->execute();
		
		$count = $results->current()['count'];

		return $count;
	}
	
	public function getRandomOfPlacementType($placementTypeId, $categories=array())
	{
		$count = $this->getCountOfPlacementType($placementTypeId, $categories);

		$offset = rand(0, $count - 1);
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable());
		
		$where = new \Zend\Db\Sql\Where();
		
		$where = $where->equalTo('advertisementplacementtypeid', $placementTypeId);

		if(count($categories) > 0){
			
			$select->join(array('ace' => 'advertisement_category_entries'), 'ace.advertisementid = advertisements.id', array());
			
			$categorylist = array();
			
			foreach($categories as $category){
				$categorylist[] = $category;				
			} // foreach		
			
			$where = $where->in('ace.advertisementcategoryid', $categorylist);
		} // if
	
		$select->where($where)
			   ->offset($offset)
			   ->limit(1);

		$results = $this->tableGateway->selectWith($select);
			
		$result = $results->current();
		
		return $result;
	}
	
	public function save(Advertisement $advertisement)
	{
		$id = (int) $advertisement->id();

		$data = array(
			'advertisementplacementtypeid' => $advertisement->advertisementPlacementTypeId(),
			'advertiserid' => $advertisement->advertiserId(),
			'name' => $advertisement->name(),
			'description' => $advertisement->description(),
			'typeid' => $advertisement->typeId(),
			'bannerimage' => $advertisement->bannerImage(),
			'url' => $advertisement->url(),
			'enabled' => $advertisement->enabled() ? 1 : 0	
		);
	
		if($id > 0){
			if($this->getAdvertisement($id)){				
				$this->tableGateway->update($data, array('id' => $id));
			} // if
			else{
				throw new \Exception("Could not load Advertisement by id: $id");
			} // else
		} // if
		else{
			$data['bucket'] = 0;
			$this->tableGateway->insert($data);
			$advertisement->id((int)$this->tableGateway->lastInsertValue);
		} // else
	}
	
	public function updateBucket($id, $bucketAmount)
	{
		$id = (int)$id;
		
		$data = array('bucket' => $bucketAmount);
		
		if($id > 0){
			if($this->getAdvertisement($id)){
				$this->tableGateway->update($data, array('id' => $id));
			} // if
			else{
				throw new \Exception("An Advertisement with the id $id could not be located");
			} // else
		} // if
		else{
			throw new \Exception("An Advertisement must have a non-negative greater than 0 value.");
		} // else
	}
	
	public function disable($id)
	{
		$id = (int)$id;
		$this->tableGateway->update(array('enabled' => 0), array('id' => $id));
	}
	
	public function delete($id)
	{
		$id = (int)$id;
		$this->tableGateway->delete(array('id' => $id));
	}
}