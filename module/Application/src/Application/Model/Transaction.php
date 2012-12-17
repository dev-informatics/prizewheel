<?php

namespace Application\Model;

class Transaction
{
	protected $id;
	protected $advertiserId;
	protected $firstName;
	protected $lastName;
	protected $emailAddress;
	protected $address1;
	protected $address2;
	protected $city;
	protected $state;
	protected $country;
	protected $postal;
	protected $cardFirstFour;
	protected $cardLastFour;
	protected $cardExpMonth;
	protected $cardExpYear;
	protected $processor;
	protected $amount;
	protected $paymentId;
	protected $status;
	protected $memo;
	protected $ipAddress;
	protected $createDateTime;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function advertiserId($advertiserid=0)
	{
		if(!empty($advertiserid)){
			$this->advertiserId = $advertiserid;
		} // if
		return $this->advertiserId;		
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
	
	public function cardFirstFour($cardfirstfour='')
	{
		if(!empty($cardfirstfour)){
			$this->cardFirstFour = $cardfirstfour;
		} // if
		return $this->cardFirstFour;
	}
	
	public function cardLastFour($cardlastfour='')
	{
		if(!empty($cardlastfour)){
			 $this->cardLastFour = $cardlastfour;
		} // if
		return $this->cardLastFour;
	}
	
	public function cardExpMonth($cardexpmonth='')
	{
		if(!empty($cardexpmonth)){
			$this->cardExpMonth = $cardexpmonth;
		} // if
		return $this->cardExpMonth;
	}
	
	public function cardExpYear($cardexpyear='')
	{
		if(!empty($cardexpyear)){
			$this->cardExpYear = $cardexpyear;
		} // if
		return $this->cardExpYear;
	}
	
	public function processor($processor='')
	{
		if(!empty($processor)){
			$this->processor = $processor;
		} // if
		return $this->processor;
	}
	
	public function amount($amount=null)
	{
		if(!empty($amount)){
			$this->amount = $amount;
		} // if
		return $this->amount;
 	}
 	
 	public function paymentId($paymentid='')
 	{
 		if(!empty($paymentid)){
 			$this->paymentId = $paymentid;
 		} // if
 		return $this->paymentId;
 	}
 	
 	public function status($status='')
 	{
 		if(!empty($status)){
 			$this->status = $status;
 		} // if
 		return $this->status;
 	}
 	
 	public function memo($memo='')
 	{
 		if(!empty($memo)){
 			$this->memo = $memo;
 		} // if
 		return $this->memo;
 	}
 	
 	public function ipAddress($ipaddress='')
 	{
 		if(!empty($ipaddress)){
 			$this->ipAddress = $ipaddress;
 		} // if
 		return $this->ipAddress;
 	}
 	
 	public function createDateTime($createdatetime='')
 	{
 		if(!empty($createdatetime)){
 			$this->createDateTime = $createdatetime;
 		} // if
 		return $this->createDateTime;
 	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->advertiserId = (isset($data['advertiserid'])) ? $data['advertiserid'] : 0;
		$this->firstName = (isset($data['firstname'])) ? $data['firstname'] : null;
		$this->lastName = (isset($data['lastname'])) ? $data['lastname'] : null;
		$this->address1 = (isset($data['address1'])) ? $data['address1'] : null;
		$this->address2 = (isset($data['address2'])) ? $data['address2'] : null;
		$this->city = (isset($data['city'])) ? $data['city'] : null;
		$this->state = (isset($data['state'])) ? $data['state'] : null;
		$this->country = (isset($data['country'])) ? $data['country'] : null;
		$this->postal = (isset($data['postal'])) ? $data['postal'] : null;
		$this->cardFirstFour = (isset($data['cardfirstfour'])) ? $data['cardfirstfour'] : null;
		$this->cardLastFour = (isset($data['cardlastfour'])) ? $data['cardlastfour'] : null;
		$this->cardExpMonth = (isset($data['cardexpmonth'])) ? $data['cardexpmonth'] : null;
		$this->cardExpYear = (isset($data['cardexpyear'])) ? $data['cardexpyear'] : null;
		$this->processor = (isset($data['processor'])) ? $data['processor'] : null;
		$this->amount = (isset($data['amount'])) ? $data['amount'] : null;
		$this->paymentId = (isset($data['paymentid'])) ? $data['paymentid'] : null;
		$this->status = (isset($data['status'])) ? $data['status'] : null;
		$this->memo = (isset($data['memo'])) ? $data['memo'] : null;
		$this->createDateTime = (isset($data['createdatetime'])) ? $data['createdatetime'] : null;
 	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'advertiserid' => $this->advertiserId,
			'firstname' => $this->firstName,
			'lastname' => $this->lastName,
			'address1' => $this->address1,
			'address2' => $this->address2,
			'city' => $this->city,
			'state' => $this->state,
			'country' => $this->country,
			'postal' => $this->postal,
			'cardfirstfour' => $this->cardFirstFour,
			'cardlastfour' => $this->cardLastFour,
			'cardexpmonth' => $this->cardExpMonth,
			'cardexpyear' => $this->cardExpYear,
			'processor' => $this->processor,
			'amount' => $this->amount,
			'paymentid' => $this->paymentId,
			'status' => $this->status,
			'memo' => $this->memo,
			'createdatetime' => $this->createDateTime	
		);
	}
}