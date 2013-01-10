<?php

namespace Application\Model;

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
	
	public function fetchCountByAdvertiserId($advertiserid)
	{
		$advertiserid = (int)$advertiserid;
		
		$stmt = $this->tableGateway->getAdapter()->createStatement(
					"SELECT count(id) as count FROM advertisement_clicks INNER JOIN advertisements a ON 
						advertisement_clicks.advertisementid = a.id WHERE a.advertiserid = ?", 
					array($advertiserid)
				);
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function fetchCountByAffiliateId($affiliateid)
	{
		$affiliateid = (int)$affiliateid;
		
		$stmt = $this->tableGateway->getAdapter()->createStatement(
					"SELECT count(advertisement_clicks.id) as count FROM advertisement_clicks 
					 INNER JOIN prizewheels p ON p.id = advertisement_clicks.prizewheelid 
					 WHERE p.affiliateid = ?", 
					array($affiliateid)
				);
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function fetchCountByAdvertisementId($id)
	{
		$id = (int)$id;
		
		$query = "SELECT count(`id`) as `count` FROM `advertisement_clicks` WHERE `advertisementid` = ?";
		
		$stmt = $this->tableGateway->getAdapter()->createStatement($query, array($id));
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getCountByPrizeWheelId($prizewheelid)
	{
		$prizewheelid = (int)$prizewheelid;
		
		$stmt = $this->tableGateway->getAdapter()->createStatement(
				"SELECT count(id) as count FROM advertisement_clicks WHERE prizewheelid = ?", array($prizewheelid));
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getAffiliateRevenue($affiliateid, $clickrate=0.00)
	{
		$id = (int)$affiliateid;
		
		$stmt = $this->tableGateway->getAdapter()->createStatement(
				"SELECT count(ac.id) as count FROM advertisement_clicks AS ac INNER JOIN prizewheels pw ON pw.id = ac.prizewheelid WHERE pw.affiliateid = ?",
				array($id));
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0.00;
		} // if
		
		return ($result['count'] * clickrate);
	}
	
	public function getPrizeWheelRevenue($prizewheelid, $clickrate=0.00)
	{
		$id = (int)$prizewheelid;
		
		$stmt = $this->tableGateway->getAdapter()->createStatement(
			"SELECT count(id) as count FROM advertisement_clicks WHERE prizewheelid = ?",
			array($id)	
		);
		
		$results = $stmt->execute();
		
		$result = $results->current();
			
		if(!$result || !isset($result['count'])){
			return 0.00;
		} // if
		
		return ($result['count'] * clickrate);
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
	
	public function getAdvertisementClickByFacebookUserId($facebookuserid, $advertisementid)
	{
		$fid = (string)$facebookuserid;
		$id = (int)$advertisementid;
		
		$results = $this->tableGateway->select(array('advertisementid' => $id, 'facebookuserid' => $fid));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function save(AdvertisementClick $advertisementClick)
	{
		$id = (int)$advertisementClick->id();
		$aid = (int)$advertisementClick->advertisementId();
		$fid = (string)$advertisementClick->facebookUserId();		
		
		$data = array(
			'advertisementid' => $advertisementClick->advertisementId(),
			'facebookuserid' => $advertisementClick->facebookUserId(),
			'prizewheelid' => $advertisementClick->prizeWheelId()	
		);	
		
		if($id <= 0){
			if(!$this->getAdvertisementClickByFacebookUserId($fid, $aid)){
				$this->tableGateway->insert($data);
				$advertisementClick->id((int)$this->tableGateway->lastInsertValue);
			} // if
		} // if
	}
}