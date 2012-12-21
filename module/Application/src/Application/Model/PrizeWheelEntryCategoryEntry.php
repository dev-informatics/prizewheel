<?php

namespace Application\Model;

class PrizeWheelEntryCategoryEntry
{
	protected $id;
	protected $prizeWheelEntryId;
	protected $advertisementCategoryId;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function prizeWheelEntryId($prizewheelentryid=0)
	{
		if(!empty($prizewheelentryid)){
			$this->prizeWheelEntryId = $prizewheelentryid;
		} // if
		return $this->prizeWheelEntryId;
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
		$this->prizeWheelEntryId = (isset($data['prizewheelentryid'])) ? $data['prizewheelentryid'] : 0;
		$this->advertisementCategoryId = (isset($data['advertisementcategoryid'])) ? $data['advertisementcategoryid'] : 0;
	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'prizewheelentryid' => $this->prizeWheelEntryId,
			'advertisementcategoryid' => $this->advertisementCategoryId	
		);
	}
}