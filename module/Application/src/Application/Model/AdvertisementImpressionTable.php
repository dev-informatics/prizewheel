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
	
	public function getAdvertisementImpression($id)
	{
		
	}
	
	public function getAdvertisementImpressionByFacebookUserId($prizewheelid, $facebookuserid)
	{
		$pid = (int)$prizewheelid;
		$fid = (string)$facebookuserid;
		
		$results = $this->tableGateway->select(array('prizewheelid' => $pid, 'facebookuserid' => $fid));
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
		
		$data = $advertisementImpression->getArrayCopy();
		unset($data['id']);
		
		if(!empty($fid) && $pid > 0){
			if(!$this->getAdvertisementImpressionByFacebookUserId($pid, $fid)){
				$this->tableGateway->insert($data);
			} // if
			else{
				throw new \Exception("Advertisement Impression already exists for this Facebook User ID and PrizeWheel ID");
			} // else
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