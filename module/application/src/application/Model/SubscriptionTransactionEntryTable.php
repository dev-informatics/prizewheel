<?php

namespace Application\Model;

class SubscriptionTransactionEntryTable implements SubscriptionTransactionEntryDataSourceInterface
{
	protected $tableGateway = null;
	private $tableName = "";
	
	public function __construct(\Zend\Db\TableGateway\TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
		$this->tableName = $this->tableGateway->getTable();
	}
	
	public function getCount()
	{
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
			   ->columns(array('count' => new \Zend\Db\Sql\Expression('count(*)')));
		
		$results = $this->tableGateway->selectWith($select);
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function fetchAll($page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
		       ->join(array('pw' => 'prizewheels'), 'pw.id = '.$this->tableName.'.prizewheelid', array('prizewheelpageid' => 'pageid'))
		       ->join(array('a' => 'affiliates'), 'a.id = pw.affiliateid', array('affiliatefirstname' => 'firstname', 'affiliatelastname' => 'lastname'))
		       ->order($this->tableName.'.id DESC')
		       ->offset(($page - 1) * $size)
		       ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCount();
		
		$list = array();
		
		foreach($results as $result){
			$ste = new SubscriptionTransactionEntry();
			$ste->exchangeArray($result);
			$list[] = $ste;
		} // foreach
		
		return $list;
	}
	
	public function fetchAllByPrizeWheelId($prizewheelid=0, $page=1, $size=25, &$count)
	{
		$prizewheelid = (int)$prizewheelid;
		
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableName)
				->join(array('pw' => 'prizewheels'), 'pw.id = '.$this->tableName.'.prizewheelid', array('prizewheelpageid' => 'pageid'))
				->join(array('a' => 'affiliates'), 'a.id = pw.affiliateid', array('affiliatefirstname' => 'firstname', 'affiliatelastname' => 'lastname'))
				->where(array('prizewheelid' => $prizewheelid))
				->order($this->tableName.'.id DESC')
				->offset(($page - 1) * $size)
				->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$ste = new SubscriptionTransactionEntry();
			$ste->exchangeArray($result);
			$list[] = $ste;
		} // foreach
		
		return $list;
	}
	
	public function getCountByCriteria(array $criteria=null)
	{
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableName)
		       ->columns(array('count' => new \Zend\Db\Sql\Expression('count(*)')))
			   ->join(array('pw' => 'prizewheels'), 'pw.id = '.$this->tableName.'.prizewheelid', array('prizewheelpageid' => 'pageid'))
		       ->join(array('a' => 'affiliates'), 'a.id = pw.affiliateid', array('affiliatefirstname' => 'firstname', 'affiliatelastname' => 'lastname'));
		
		$where = $this->constructWhereCriteria($criteria);
		
		if($where){
			$select->where($where);
		} // if
		
		$results = $this->tableGateway->selectWith($select);
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	private function constructWhereCriteria(array $criteria=null)
	{
		if(!empty($criteria)){
			
			$where = new \Zend\Db\Sql\Where();
			
			if(!empty($criteria['affiliatefirstname'])){
				$where = $where->like('a.firstname', '%'.$criteria['affiliatefirstname'].'%');
			} // if
			
			if(!empty($criteria['affiliatelastname'])){
				$where = $where->like('a.lastname', '%'.$criteria['affiliatelastname'].'%');
			} // if
			
			if(!empty($criteria['id']) && is_array($criteria['id'])){
				$where = $where->in($this->tableName.'.id', $criteria['id']);
			} // foreach
			
			return $where;
		} // if
		
		return null;
	}
	
	public function search(array $criteria=null, $page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableName)
			   ->join(array('pw' => 'prizewheels'), 'pw.id = '.$this->tableName.'.prizewheelid', array('prizewheelpageid' => 'pageid'))
		       ->join(array('a' => 'affiliates'), 'a.id = pw.affiliateid', array('affiliatefirstname' => 'firstname', 'affiliatelastname' => 'lastname'))
		       ->order($this->tableName.'.id DESC')
		       ->offset(($page - 1) * $size)
		       ->limit($size);
		
		$where = $this->constructWhereCriteria($criteria);
		
		if($where){
			$select->where($where);
		} // if
		
		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$ste = new SubscriptionTransactionEntry();
			$ste->exchangeArray($result);
			$list[] = $ste;
		} // foreach
		
		return $list;
	}
	
	public function getSubscriptionTransactionEntry($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array('id' => $id));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		$ste = new SubscriptionTransactionEntry();
		$ste->exchangeArray($result);
		
		return $ste;
	}
	
	public function getSubscriptionsByPrizeWheelId($prizewheelid)
	{
		$prizewheelid = (int)$prizewheelid;
		
		$results = $this->tableGateway->select(array('prizewheelid' => $prizewheelid));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		$ste = new SubscriptionTransactionEntry();
		$ste->exchangeArray($result);
		
		return $ste;
	}
	
	public function getSubscriptionTransactionEntryByPaymentId($paymentid)
	{
		$paymentid = (string)$paymentid;
		
		$results = $this->tableGateway->select(array('paymentid' => $paymentid));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		$ste = new SubscriptionTransactionEntry();
		$ste->exchangeArray($result);
		
		return $ste;
	}
	
	public function save(SubscriptionTransactionEntry $entry)
	{
		$id = (int)$entry->id();
		
		$data = array(
					'prizewheelid' => $entry->prizeWheelId(),
					'subscriptionid' => $entry->subscriptionId(),
					'transactionstatusid' => $entry->transactionStatusId(),
					'firstname' => $entry->firstName(),
					'lastname' => $entry->lastName(),
					'address1' => $entry->address1(),
					'address2' => $entry->address2(),
					'city' => $entry->city(),
					'state' => $entry->state(),
					'country' => $entry->country(),
					'postal' => $entry->postal(),
					'cardfirstfour' => $entry->cardFirstFour(),
					'cardlastfour' => $entry->cardLastFour(),
					'cardexpmonth' => $entry->cardExpMonth(),
					'cardexpyear' => $entry->cardExpYear(),
					'processor' => $entry->processor(),
					'amount' => $entry->amount(),
					'paymentid' => $entry->paymentId(),
					'status' => $entry->status(),
					'memo' => $entry->memo(),
					'emailaddress' => $entry->emailAddress(),
					'telephone' => $entry->telephone(),
					'ipaddress' => $entry->ipAddress()
				);
		
		if($id > 0){
			if($this->getSubscriptionTransactionEntry($id)){
				$this->tableGateway->update($data, array('id' => $id));
			} // if
			else{
				throw new \Exception("Prize Wheel Subscription with ID $id does not exist.");
			}
		} // if
		else{
			$this->tableGateway->insert($data);
			$entry->id((int)$this->tableGateway->lastInsertValue);
		} // else
	}
}