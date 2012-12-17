<?php

namespace Application\Model;

abstract class PrizeWheelHit
{
	protected $id;
	protected $prizeWheelId;
	protected $facebookUserId;
	protected $createDateTime;
	
	public function id($id=0)
	{
		if(is_int($id) && $id > 0){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function prizeWheelId($prizewheelid=0)
	{
		if(is_int($prizewheelid) && $prizewheelid > 0){
			$this->prizeWheelId = $prizewheelid;
		} // if
		return $this->prizeWheelId;
	}
	
	public function facebookUserId($facebookuserid='')
	{
		if(!empty($facebookuserid)){
			$this->facebookUserId = $facebookuserid;
		} // if
		return $this->facebookUserId;
	}
	
	public function createDateTime($createdatetime='')
	{
		if(!empty($createdatetime)){
			$this->createDateTime = $createdatetime;
		} // if
		return $this->createDateTime;
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->prizeWheelId = (isset($data['prizewheelid'])) ? $data['prizewheelid'] : 0;
		$this->facebookUserId = (isset($data['facebookuserid'])) ? $data['facebookuserid'] : null;
		$this->createDateTime = (isset($data['createdatetime'])) ? $data['createdatetime'] : null;
 	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'prizewheelid' => $this->prizeWheelId,
			'facebookuserid' => $this->facebookUserId,
			'createdatetime' => $this->createDateTime	
		);
	}
}