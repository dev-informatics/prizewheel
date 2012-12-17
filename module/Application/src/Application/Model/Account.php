<?php

namespace Application\Model;

abstract class Account
{
	protected $id;
	protected $facebookUserId;
	protected $firstName;
	protected $lastName;
	protected $address1;
	protected $address2;
	protected $city;
	protected $state;
	protected $country;
	protected $postal;
	protected $telephone;
	protected $emailAddress;
	protected $enabled;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
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
	} // lastName
	
	public function address1($address1='')
	{
		if(!empty($address1)){
			$this->address1 = $address1;
		} // if
		return $this->address1;
	}
	
	public function address2($address2='')
	{
		if(!empty($address2)){
			$this->address2 = $address2;
		} // if
		return $this->address2;
	}
	
	public function city($city='')
	{
		if(!empty($city)){
			$this->city = $city;
		} // if
		return $this->city;
	}
	
	public function state($state='')
	{
		if(!empty($state)){
			$this->state = $state;
		} // if
		return $this->state;
	}
	
	public function country($country='')
	{
		if(!empty($country)){
			$this->country = $country;
		} // if
		return $this->country;
	}
	
	public function postal($postal='')
	{
		if(!empty($postal)){
			$this->postal = $postal;
		} // if
		return $this->postal;
	}
	
	public function telephone($telephone='')
	{
		if(!empty($telephone)){
			$this->telephone = $telephone;
		} // if
		return $this->telephone;
	}
	
	public function emailAddress($emailaddress='')
	{
		if(!empty($emailaddress)){
			$this->emailAddress = $emailaddress;
		} // if
		return $this->emailAddress;
	}
	
	public function __construct()
	{
	
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->facebookUserId = (isset($data['facebookuserid'])) ? $data['facebookuserid'] : null;
		$this->firstName = (isset($data['firstname'])) ? $data['firstname'] : null;
		$this->lastName = (isset($data['lastname'])) ? $data['lastname'] : null;
		$this->address1 = (isset($data['address1'])) ? $data['address1'] : null;
		$this->address2 = (isset($data['address2'])) ? $data['address2'] : null;
		$this->city = (isset($data['city'])) ? $data['city'] : null;
		$this->state (isset($data['state'])) ? $data['state'] : null;
		$this->country = (isset($data['country'])) ? $data['country'] : null;
		$this->postal = (isset($data['postal'])) ? $data['postal'] : null;
		$this->telephone = (isset($data['telephone'])) ? $data['telephone'] : null;
		$this->emailAddress = (isset($data['emailaddress'])) ? $data['emailaddress'] : null;
	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'facebookuserid' => $this->facebookUserId,
			'firstname' => $this->firstName,
			'lastname' => $this->lastName,
			'address1' => $this->address1,
			'address2' => $this->address2,
			'city' => $this->city,
			'state' => $this->state,
			'country' => $this->country,
			'postal' => $this->postal,
			'telephone' => $this->telephone,
			'emailaddress' => $this->emailaddress
		);
	}
}