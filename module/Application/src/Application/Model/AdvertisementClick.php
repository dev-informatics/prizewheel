<?php

namespace Application\Model;

class AdvertisementClick extends PrizeWheelHit
{
	protected $advertisementId;
	
	public function advertisementId($advertisementid=0)
	{
		if(!empty($advertisementid)){
			$this->advertisementId = $advertisementid;
		} // if
		return $this->advertisementId;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		parent::exchangeArray($data);
		$this->advertisementId = (isset($data['advertisementid'])) ? $data['advertisementid'] : 0;
	}
	
	public function getArrayCopy()
	{
		$data = parent::getArrayCopy();
		$data['advertisementid'] = $this->advertisementId;
		
		return $data;
	}
}