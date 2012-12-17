<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Advertiser;

class AdvertiserTable
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
			'emailaddress' => $advertiser->emailAddress()	
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