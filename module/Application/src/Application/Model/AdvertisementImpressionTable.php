<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\AdvertisementImpression;

class AdvertisementImpressionTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $advertisementTableGateway)
	{
		$this->tableGateway = $advertisementTableGateway;
	}
	
	public function fetchCountByAdvertisementId($id)
	{
		$id = (int)$id;
		
		$stmt = $this->tableGateway->getAdapter()->createStatement("SELECT count(id) as `count` FROM advertisement_impressions WHERE advertisementid = ?", array($id));
		
		$results = $stmt->execute();
		
		$count = $results->current()['count'];

		return $count;
	}
	
	public function getAdvertisementImpression($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $result->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function getAdvertisementImpressionByFacebookUserId($facebookuserid, $advertisementid)
	{
		$advertisementid = (int)$advertisementid;
		$fid = (string)$facebookuserid;
		
		$results = $this->tableGateway->select(array('advertisementid' => $advertisementid, 'facebookuserid' => $fid));
		$result = $results->current();
	
		if(!$result){
			return null;
		} // if
	
		return $result;
	}
	
	public function save(AdvertisementImpression $advertisementImpression)
	{
		$fid = (string)$advertisementImpression->facebookUserId();
		$pid = (int)$advertisementImpression->prizeWheelId();
		$aid = (int)$advertisementImpression->advertisementId();
	
		$data = array(
			'prizewheelid' => $advertisementImpression->prizeWheelId(),
			'facebookuserid' => $advertisementImpression->facebookUserId(),
			'advertisementid' => $advertisementImpression->advertisementId()
		);

		if(!empty($fid) && $pid > 0){
			if(!$this->getAdvertisementImpressionByFacebookUserId($fid, $aid)){
				$this->tableGateway->insert($data);
			} // if
		} // if
		else{
			
			if(empty($fid)){
				throw new \Exception("Advertisement Impression must have a Facebook User ID.");
			} // if
			else{
				throw new \Exception("Advertisement Impression must have a PrizeWheel ID.");
			} //else
		} // else
	}
}