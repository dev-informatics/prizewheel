<?php

namespace Application\Model;

class AdvertisementCategoryEntry
{
	protected $id;
	protected $advertisementCategoryId;
	protected $advertisementId;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function advertisementCategoryId($advertisementcategoryid=0)
	{
		if(!empty($advertisementcategoryid)){
			$this->advertisementCategoryId = $advertisementcategoryid;
		} // if
		return $this->advertisementCategoryId;
	}
	
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
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->advertisementCategoryId = (isset($data['advertisementcategoryid'])) ? $data['advertisementcategoryid'] : 0;
		$this->advertisementId = (isset($data['advertisementid'])) ? $data['advertisementid'] : 0;
	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'advertisementcategoryid' => $this->advertisementCategoryId,
			'advertisementid' => $this->advertisementId	
		);
	}
}