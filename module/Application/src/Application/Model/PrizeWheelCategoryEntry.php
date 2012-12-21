<?php

namespace Application\Model;

class PrizeWheelCategoryEntry
{
	protected $id;
	protected $prizeWheelId;
	protected $advertisementCategoryId;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function prizeWheelId($prizewheelid=0)
	{
		if(!empty($prizewheelid)){
			$this->prizeWheelId = $prizewheelid;
		} // if
		return $this->prizeWheelId;
	}
	
	public function advertisementCategoryId($advertisementcategoryid=0)
	{
		if(!empty($advertisementcategoryid)){
			$this->advertisementCategoryId = $advertisementcategoryid;
		} // if
		return $this->advertisementCategoryId;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->prizeWheelId = (isset($data['prizewheelid'])) ? $data['prizewheelid'] : 0;
		$this->advertisementCategoryId = (isset($data['advertisementcategoryid'])) ? $data['advertisementcategoryid'] : 0;
	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'prizewheelid' => $this->prizeWheelId,
			'advertisementcategoryid' => $this->advertisementCategoryId	
		);
	}
}