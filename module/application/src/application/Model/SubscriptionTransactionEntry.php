<?php

namespace Application\Model;

class SubscriptionTransactionEntry
{
	protected $id;
	protected $subscriptionId;
	protected $prizeWheelId;
	protected $prizeWheelPageId;
	protected $affiliateName;
	protected $transactionStatusId;
	protected $firstName;
	protected $lastName;
	protected $emailAddress;
	protected $telephone;
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
	protected $affiliateId;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function subscriptionId($subscriptionid='')
	{
		if(!empty($subscriptionid)){
			$this->subscriptionId = $subscriptionid;
		} // if
		return $this->subscriptionId;
	}
	
	public function prizeWheelPageId()
	{
		return $this->prizeWheelPageId;
	}
	
	public function affiliateName()
	{
		return $this->affiliateName;
	}
	
	public function prizeWheelId($prizewheelid=0)
	{
		if(!empty($prizewheelid)){
			$this->prizeWheelId = $prizewheelid;
		} // if
		return $this->prizeWheelId;
	}
	
	public function transactionStatusId($transactionstatusid=0)
	{
		if(!empty($transactionstatusid)){
			$this->transactionStatusId = $transactionstatusid;
		} // if
		return $this->transactionStatusId;
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
	
	public function affiliateId()
	{
		return $this->affiliateId;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : $this->id;
		$this->subscriptionId = (isset($data['subscriptionid'])) ? $data['subscriptionid'] : $this->subscriptionId;
 		$this->prizeWheelId = (isset($data['prizewheelid'])) ? $data['prizewheelid'] : $this->prizeWheelId;
		$this->prizeWheelPageId = (isset($data['prizewheelpageid'])) ? $data['prizewheelpageid'] : $this->prizeWheelPageId;
		$this->affiliateName = (isset($data['affiliatefirstname']) && isset($data['affiliatelastname'])) ? 
			$data['affiliatefirstname'] . ' ' . $data['affiliatelastname'] : $this->affiliatename;
		$this->transactionStatusId = (isset($data['transactionstatusid'])) ? $data['transactionstatusid'] : $this->transactionStatusId;
		$this->firstName = (isset($data['firstname'])) ? $data['firstname'] : $this->firstName;
		$this->lastName = (isset($data['lastname'])) ? $data['lastname'] : $this->lastName;
		$this->address1 = (isset($data['address1'])) ? $data['address1'] : $this->address1;
		$this->address2 = (isset($data['address2'])) ? $data['address2'] : $this->address2;
		$this->city = (isset($data['city'])) ? $data['city'] : $this->city;
		$this->state = (isset($data['state'])) ? $data['state'] : $this->state;
		$this->country = (isset($data['country'])) ? $data['country'] : $this->country;
		$this->postal = (isset($data['postal'])) ? $data['postal'] : $this->postal;
		$this->cardFirstFour = (isset($data['cardfirstfour'])) ? $data['cardfirstfour'] : $this->cardFirstFour;
		$this->cardLastFour = (isset($data['cardlastfour'])) ? $data['cardlastfour'] : $this->cardLastFour;
		$this->cardExpMonth = (isset($data['cardexpmonth'])) ? $data['cardexpmonth'] : $this->cardExpMonth;
		$this->cardExpYear = (isset($data['cardexpyear'])) ? $data['cardexpyear'] : $this->cardExpYear;
		$this->processor = (isset($data['processor'])) ? $data['processor'] : $this->processor;
		$this->amount = (isset($data['amount'])) ? $data['amount'] : $this->amount;
		$this->paymentId = (isset($data['paymentid'])) ? $data['paymentid'] : $this->paymentId;
		$this->status = (isset($data['status'])) ? $data['status'] : $this->status;
		$this->memo = (isset($data['memo'])) ? $data['memo'] : $this->memo;
		$this->createDateTime = (isset($data['createdatetime'])) ? $data['createdatetime'] : $this->createDateTime;
		$this->emailAddress = (isset($data['emailaddress'])) ? $data['emailaddress'] : $this->emailAddress;
		$this->telephone = (isset($data['telephone'])) ? $data['telephone'] : $this->telephone;
		$this->ipAddress = (isset($data['ipaddress'])) ? $data['ipaddress'] : $this->ipAddress;
		$this->affiliateId =  (isset($data['affiliateid'])) ? $data['affiliateid'] : $this->affiliateId;
	}
	
	public function getArrayCopy()
	{
		return array(
				'id' => $this->id,
				'prizewheelid' => $this->prizeWheelId,
				'prizewheelpageid' => $this->prizeWheelPageId,
				'affiliatename' => $this->affiliateName,
				'transactionstatusid' => $this->transactionStatusId,
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
				'emailaddress' => $this->emailAddress,
				'telephone' => $this->telephone,
				'createdatetime' => $this->createDateTime,
				'ipaddress' => $this->ipAddress,
				'affiliateid' => $this->advertiserId
			);
	}
}