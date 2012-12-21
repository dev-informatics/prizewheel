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
	} // fetchAll
	
	public function fetchAllByAffiliateId($affiliateid, $page=1, $size=25)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$affiliateid = (int)$affiliateid;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
			   ->join(array("pt" => "prizewheel_types"),
			   		  "pt.id = prizewheel.prizewheeltypeid",
			   		  array("prizewheeltypename" => "pt.name")
			   	)
			   ->where(array('affiliateid' => $affiliateid))
		       ->offset(($page - 1) * $size)
		       ->limit($size);
	
		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	} // fetchAllByAffiliateId
	
	public function fetchAllEnabledByAffiliateId($affiliateid, $page=1, $size=25)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$id = (int)$affiliateid;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
				->join(array("pt" => "prizewheel_types"),
				       "pt.id = prizewheels.prizewheeltypeid",
				       array("prizewheeltypename" => "name")
				)
		       ->where(array('affiliateid' => $id, 'enabled' => 1))
		       ->offset(($page - 1) * $size)
		       ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	} // fetchAllEnabledByAffiliateId
	
	/**
	 * 
	 * @param unknown $prizewheelid
	 * @return \Application\Model\PrizeWheel
	 */
	public function getPrizeWheel($prizewheelid)
	{
		$prizewheelid = (int)$prizewheelid;
		$results = $this->tableGateway->select(array('id' => $prizewheelid));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	} // getPrizeWheel
	
	public function getPrizeWheelByPageId($pageid)
	{
		$pageid = (string)$pageid;
		$results = $this->tableGateway->select(array('pageid' => $pageid));
		$result = $results->current();
		
		if(!$results){
			return null;
		} // if
		
		return $result;
	} // getPrizeWheelByPageId
	
	public function save(PrizeWheel $prizeWheel)
	{
		$id = (int)$prizeWheel->id();
		$pageid = (string)$prizeWheel->pageId();
		
		$data = $prizeWheel->getArrayCopy();
		$data['forcelike'] = $data['forcelike'] ? 1 : 0;
		$data['sendemailnotifications'] = $data['sendemailnotifications'] ? 1 : 0;
		$data['ipaddressfilter'] = $data['ipaddressfilter'] ? 1 : 0;
		$data['emailfilter'] = $data['emailfilter'] ? 1 : 0;
		$data['phonefilter'] = $data['phonefilter'] ? 1 : 0;
		$data['enabled'] = $data['enabled'] ? 1 : 0;
		
		unset($data['id']);
		unset($data['createdatetime']);
		unset($data['prizewheeltypename']);
		unset($data['views']);
		unset($data['plays']);
		unset($data['advertisementclicks']);
		unset($data['categories']); 
		
		if($id > 0){
			if(!$this->getPrizeWheel($id)){
				throw new \Exception("Could not locate PrizeWheel with the id $id");
			} // if
			else{
				if($this->tableGateway->update($data, array('id' => $id)) <= 0){
					throw new \Exception("There was an error while attempting to update Prize Wheel $id in the data-store.");
				} // if
 			} // else
 		} // if
		else{
			
			$found = $this->getPrizeWheelByPageId($pageid);
			
			if(!$found){			
				if($this->tableGateway->insert($data) > 0){
					$prizeWheel->id((int)$this->tableGateway->lastInsertValue);
				} // if
				else{
					throw new \Exception("There was an error while attempting to insert a new Prize Wheel into the data-store.");
				} // else
			} // if
			else if($found->enabled() == false){
				$this->tableGateway->update(array('enabled' => 1), array('id' => $found->id()));
			} // else if
			else{
				throw new \Exception("A Prize Wheel has already been installed for that Facebook Page.");
			} // else
		} // else
	} // save
	
	public function delete($id)
	{
		$id = (int)$id;
		
		$this->tableGateway->delete(array('id' => $id));
	} // delete
	
	public function disable($id)
	{
		$id = (int)$id;
		
		$this->tableGateway->update(array('enabled' => 0), array('id' => $id));
	} // disable
} // PrizeWheelTable