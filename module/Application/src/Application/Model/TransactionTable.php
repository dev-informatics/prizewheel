<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Transaction;

class TransactionTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAllByAdvertiserId($advertiserid, $page=1, $take=25)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from('transactions')
		       ->where(array('advertiserid' => $advertiserid))
		       ->offset((($page - 1) * $take))
		       ->limit($take);
		
		$results = $this->tableGateway->selectWith($select);
		return $results;
	}
	
	public function getTransaction($id)
	{
		$id = (int)$id;
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		 
		return $result;
	} // getTransaction
	
	public function save(Transaction $transaction)
	{
		$id = (int)$transaction->id();
		
		$data = array(
			'advertiserid' => $transaction->advertiserId(),
			'firstname' => $transaction->firstName(),
			'lastname' => $transaction->lastName(),
			'emailaddress' => $transaction->emailAddress(),
			'address1' => $transaction->address1(),
			'address2' => $transaction->address2(),
			'city' => $transaction->city(),
			'state' => $transaction->state(),
			'country' => $transaction->country(),
			'postal' => $transaction->postal(),
			'cardfirstfour' => $transaction->cardFirstFour(),
			'cardlastfour' => $transaction->cardLastFour(),
			'cardexpmonth' => $transaction->cardExpMonth(),
			'cardexpyear' => $transaction->cardExpYear(),
			'processor' => $transaction->processor(),
			'amount' => $transaction->amount(),
			'paymentid' => $transaction->paymentId(),
			'status' => $transaction->status(),
			'memo' => $transaction->memo(),
			'ipaddress' => $transaction->ipAddress()	
		);
		
		if($id > 0){
			if(!$this->getTransaction($id)){
				throw new \Exception("Could not locate a Transaction with the id $id");
			} // if
			else{
				$this->tableGateway->update($data, array('id' => $id));
			} // else
		} // if
		else{
			$this->tableGateway->insert($data);
			$transaction->id((int)$this->tableGateway->lastInsertValue);
		} // else
	} // saveTransaction
}