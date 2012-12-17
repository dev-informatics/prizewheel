<?php

namespace Application\Model;

class PrizeWheelEntry
{
	protected $id;
	protected $prizeWheelId;
	protected $facebookUserId;
	protected $firstName;
	protected $lastName;
	protected $emailAddress;
	protected $telephone;
	protected $ipAddress;
	protected $playTime;
	protected $prize;	
	protected $exported;
	
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
	
	public function firstName($firstname='')
	{
		if(!empty($firstname)){
			$this->firstName = $firstname;
		} // if
		return $this->firstName;
	}
	
	public function lastName($lastname='')
	{
		if(!empty($lastname)){
			$this->lastName = $lastname;
		} // if
		return $this->lastName;
	}
	
	public function emailAddress($emailaddress='')
	{
		if(!empty($emailaddress)){
			$this->emailAddress = $emailaddress;
		} // if
		return $this->emailAddress;
	}
	
	public function telephone($telephone='')
	{
		if(!empty($telephone)){
			$this->telephone = $telephone;
		} // if
		return $this->telephone;		
	}
	
	public function ipAddress($ipaddress='')
	{
		if(!empty($ipaddress)){
			$this->ipAddress = $ipaddress;
		} // if
		return $this->ipAddress;
	}
	
	public function playTime($playtime='')
	{
		if(!empty($playtime)){
			$this->playTime = $playtime;
		} // if
		return $this->playTime;
	}
	
	public function prize($prize='')
	{
		if(!empty($prize)){
			$this->prize = $prize;
		} // if
		return $this->prize;
	}
	
	public function exported($exported=null)
	{
		if(!empty($exported)){
			$this->exported = $exported;
		} // if
		return $this->exported;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->prizeWheelid = (isset($data['prizewheelid'])) ? $data['prizewheelid'] : 0;
		$this->facebookUserId = (isset($data['facebookuserid'])) ? $data['facebookuserid'] : null;
		$this->firstName = (isset($data['firstname'])) ? $data['firstname'] : null;
		$this->lastName = (isset($data['lastname'])) ? $data['lastname'] : null;
		$this->emailAddress = (isset($data['emailaddress'])) ? $data['emailaddress'] : null;
		$this->telephone = (isset($data['telephone'])) ? $data['telephone'] : null;
		$this->ipAddress = (isset($data['ipaddress'])) ? $data['ipaddress'] : null;
		$this->playTime = (isset($data['playtime'])) ? $data['playtime'] : null;
		$this->prize = (isset($data['prize'])) ? $data['prize'] : null;
		$this->exported = (isset($data['exported'])) ? $data['exported'] : null;
	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'prizewheelid' => $this->prizeWheelId,
			'facebookuserid' => $this->facebookUserId,
			'firstname' => $this->firstName,
			'lastname' => $this->lastName,
			'emailaddress' => $this->emailAddress,
			'telephone' => $this->telephone,
			'ipaddress' => $this->ipAddress,
			'playtime' => $this->playTime,
			'prize' => $this->prize,
			'exported' => $this->exported
		);	
	}
}