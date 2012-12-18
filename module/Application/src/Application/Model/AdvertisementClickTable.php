<?php

namespace Application\Model;

use Application\Exception\AdvertisementClickSaveException;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\AdvertisementClick;

class AdvertisementClickTable
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
	
	public function fetchCountByAdvertisementId($id)
	{
		$id = (int)$id;
		
		$query = "SELECT count(`id`) as `count` FROM `advertisement_clicks` WHERE `advertisementid` = ?";
		
		$stmt = $this->tableGateway->getAdapter()->createStatement($query, array($id));
		
		$results = $stmt->execute();
		
		$count = $results->current()['count'];
		
		return $count;
	}
	
	public function getAdvertisementClick($id)
	{
		$id = (int)$id;
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!$result){
			throw new \Exception("An Advertisement Click with the id $id could not be found.");
		} // if
		
		return $result;
	}
	
	public function getAdvertisementClickByFacebookUserId($id, $facebookuserid)
	{
		$fid = (string)$facebookuserid;
		$id = (int)$id;
		$results = $this->tableGateway->select(array('id' => $id, 'facebookuserid' => $fid));
		$result = $results->current();
		
		if(!$result){
			throw new \Exception("Could not locate an Advertisement Click with the id of $id and Facebook User ID of $fid");
		} // if
		
		return $result;
	}
	
	public function save(AdvertisementClick $advertisementClick)
	{
		$id = (int)$advertisementClick->id();
		
		$data = array(
			'advertisementid' => $advertisementClick->advertisementId(),
			'facebookuserid' => $advertisementClick->facebookUserId(),
			'prizewheelid' => $advertisementClick->prizeWheelId()	
		);	
		
		if($id <= 0){
			if($this->getAdvertisementClickByFacebookUserId($advertisementClick->facebookUserId())){
				throw new AdvertisementClickSaveException("A Facebook User has already executed a Click for this Advertisement");
			} // if
			else{
				$this->tableGateway->insert($data);
				$advertisementClick->id((int)$this->tableGateway->lastInsertValue);
			}
		} // if
	}
}