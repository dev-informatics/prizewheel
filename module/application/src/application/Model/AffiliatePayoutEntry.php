<?php

namespace Application\Model;

class AffiliatePayoutEntry
{
	protected $id = 0;
	protected $affiliateId = 0;
	protected $amount = 0.00;
	protected $payoutMethod = "";
	protected $messages = "";
	protected $claimedStatus = "";
	protected $transactionId = "";
	protected $uniqueId = "";
	protected $createDateTime = "";
	
	protected $affiliateName = "";
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function affiliateId($affiliateid=0)
	{
		if(!empty($affiliateid)){
			$this->affiliateId = $affiliateid;
		} // if
		return $this->affiliateId;
	}
	
	public function amount($amount=null)
	{
		if(!empty($amount)){
			$this->amount = $amount;
		} // if
		return $this->amount;
	}
	
	public function payoutMethod($payoutmethod="")
	{
		if(!empty($payoutmethod)){
			$this->payoutMethod = $payoutmethod;
 		} // if
 		return $this->payoutMethod;
	}
	
	public function messages($messages="")
	{
		if(!empty($messages)){
			$this->messages = $messages;
		} // if
		return $this->messages;
	}
	
	public function claimedStatus($claimedstatus="")
	{
		if(!empty($claimedstatus)){
			$this->claimedStatus = $claimedstatus;
		} // if
		return $this->claimedStatus;
	}
	
	public function transactionId($transactionid="")
	{
		if(!empty($transactionid)){
			$this->transactionId = $transactionid;
		} // if
		return $this->transactionId;
	}
	
	public function uniqueId($uniqueid="")
	{
		if(!empty($uniqueid)){
			$this->uniqueId = $uniqueid;
		} // if
		return $this->uniqueId;		
	}
	
	public function createDateTime($createdatetime="")
	{
		if(!empty($createdatetime)){
			$this->createDateTime = $createdatetime;
		} // if
		return $this->createDateTime;
	}
	
	public function affiliateName()
	{
		return $this->affiliateName;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		 $this->id = (isset($data['id'])) ? $data['id'] : $this->id;
		 $this->affiliateId = (isset($data['affiliateid'])) ? $data['affiliateid'] : $this->affiliateId;
		 $this->amount = (isset($data['amount'])) ? $data['amount'] : $this->amount;
		 $this->payoutMethod = (isset($data['payoutmethod'])) ? $data['payoutmethod'] : $this->payoutMethod;
		 $this->messages = (isset($data['messages'])) ? $data['messages'] : $this->messages;
		 $this->claimedStatus = (isset($data['claimedstatus'])) ? $data['claimedstatus'] : $this->claimedStatus;
		 $this->transactionId = (isset($data['transactionid'])) ? $data['transactionid'] : $this->transactionId;
		 $this->uniqueId = (isset($data['uniqueid'])) ? $data['uniqueid'] : $this->uniqueId;
		 $this->createDateTime = (isset($data['createdatetime'])) ? $data['createdatetime'] : $this->createDateTime;
		 $this->affiliateName = (isset($data['affiliatefirstname']) && isset($data['affiliatelastname'])) ?
		 	$data['affiliatefirstname'] . " " . $data['affiliatelastname'] : $this->affiliateName;
	} 
	
	public function getArrayCopy()
	{
		return array(
			"id" => $this->id,
			"affiliateid" => $this->affiliateId,
			"amount" => $this->amount,
			"payoutmethod" => $this->payoutMethod,
			"messages" => $this->messages,
			"claimedstatus" => $this->claimedStatus,
			"transactionid" => $this->transactionId,
			"uniqueid" => $this->uniqueId,
			"createdatetime" => $this->createDateTime,
			"affiliatename" => $this->affiliateName
		);
	}
}