<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Advertiser;

class AdvertiserTable implements AdvertiserDataSourceInterface
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll($page=1, $take=25, &$count)
	{
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
			   ->order('lastname ASC')
			   ->offset(($page - 1) * $take)
			   ->limit($take);		

		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCount();
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getCount()
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement("SELECT count(id) as count FROM advertisers");
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getAdvertiser($id)
	{
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!$result){
			throw new \Exception("Could not locate Advertiser by id $id");
		} // if
		
		return $result;
	}
	
	/**
	 * 
	 * @param unknown $facebookuserid
	 * @return NULL|Application\Model\Advertiser
	 */
	public function getAdvertiserByFacebookUserId($facebookuserid)
	{
		$fid = (string)$facebookuserid;
		
		$results = $this->tableGateway->select(array('facebookuserid' => $fid));
		$result = $results->current();
		
		if(!$result){
			 return null;
		} // if
		
		return $result;
	}
	
	public function save(Advertiser $advertiser)
	{
		$id = (int)$advertiser->id();
		$fid = (string)$advertiser->facebookUserId();
		
		$data = array(
			'facebookuserid' => $advertiser->facebookUserId(),
			'firstname' => $advertiser->firstName(),
			'lastname' => $advertiser->lastName(),
			'address1' => $advertiser->address1(),
			'address2' => $advertiser->address2(),
			'city' => $advertiser->city(),
			'state' => $advertiser->state(),
			'country' => $advertiser->country(),
			'postal' => $advertiser->postal(),
			'telephone' => $advertiser->telephone(),
			'emailaddress' => $advertiser->emailAddress(),
			'enabled' => $advertiser->enabled() ? 1 : 0	
		); 
		
		if($id > 0 && !empty($fid)){
			if($this->getAdvertiser($id)){
				$this->tableGateway->update($data, array('id' => $id));				
			} // if
			else{
				throw new \Exception("Could not locate Advertiser by id $id");
			}
		} // if
		else{
			
			if(empty($fid)){
				throw new \Exception("An Advertiser must have a Facebook User ID.");
			} // if
			
			$this->tableGateway->insert($data);
			$advertiser->id($this->tableGateway->lastInsertValue);
		} // else
	}
}