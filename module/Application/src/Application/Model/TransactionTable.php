<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Transaction;

class TransactionTable
{
	protected $tableGateway;
	protected $rawGateway;
	
	/**
	 * 
	 * @param TableGateway $tableGateway This should be a Gateway with a Transaction ResultSet Prototype.
	 * @param TableGateway $rawGateway This should be a Gateway with no associated ResultSet Prototype.
	 */
	public function __construct(TableGateway $tableGateway, TableGateway $rawGateway)
	{
		$this->tableGateway = $tableGateway;
		$this->rawGateway = $rawGateway;
	} // ctor
	
	public function fetchAll($page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
		       ->join(array('ad' => 'advertisements'), 'ad.id = ' . $this->tableGateway->getTable() . '.advertisementid', array('advertisementname' => 'name'))
		       ->join(array('a' => 'advertisers'), 'a.id = ad.advertiserid', array('advertiserid' => 'id', 'advertiserfirstname' => 'firstname', 'advertiserlastname' => 'lastname'))
		       ->order('id DESC')
		       ->offset(($page - 1) * $size)
		       ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCount();
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	} // fetchAll
	
	public function search(array $criteria=null, $page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
		       ->join(array('ad' => 'advertisements'), 'ad.id = '.$this->tableGateway->getTable().'.advertisementid', array('advertisementname' => 'name'))
		       ->join(array('advertiser' => 'advertisers'), 'advertiser.id = ad.advertiserid', array('advertiserfirstname' => 'firstname', 'advertiserlastname' => 'lastname'));
				
		if($criteria){
			$where = new \Zend\Db\Sql\Where();
			
			if(!empty($criteria['advertiserfirstname'])){
				$where = $where->like('advertiser.firstname', '%'.$criteria['advertiserfirstname'].'%');
			} // if
			
			if(!empty($criteria['advertiserlastname'])){
				$where = $where->like('advertiser.lastname', '%'.$criteria['advertiserlastname'].'%');
			} //  if
			
			if(!empty($criteria['datefrom'])){
				$where = $where->greaterThanOrEqualTo($this->tableGateway->getTable().'.createdatetime', $criteria['datefrom']);
			} // if
			
			if(!empty($criteria['dateto'])){
				$where = $where->lessThanOrEqualTo($this->tableGateway->getTable().'.createdatetime', $criteria['dateto']);
			} // if
			
			$select->where($where);
		} // if
		
		$select->order('transactions.id DESC')
		       ->offset(($page - 1) * $size)
		       ->limit($size);
	
		$count = $this->getCountByCriteria($criteria);
		
		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getRevenueGroupedByDate($datefrom='', $dateto='')
	{
		if(empty($datefrom)){
			$datefrom = date('Y-m-d').' 00:00:00';
		} // if
		
		if(empty($dateto)){
			$dateto = date('Y-m-d H:i:s');
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->rawGateway->getTable())
			   ->columns(array('date' => new \Zend\Db\Sql\Expression('DATE('.$this->rawGateway->getTable().'.createdatetime)'), 'revenue' => new \Zend\Db\Sql\Expression('SUM('.$this->rawGateway->getTable().'.amount)')))
               ->group(new \Zend\Db\Sql\Expression('DATE('.$this->rawGateway->getTable().'.createdatetime)'));

		$where = new \Zend\Db\Sql\Where();
		
		$where->greaterThanOrEqualTo($this->rawGateway->getTable().'.createdatetime', $datefrom);
		$where->lessThanOrEqualTo($this->rawGateway->getTable().'.createdatetime', $dateto);
		
		$select->where($where);
	
		$results = $this->rawGateway->selectWith($select);
		
		return $results->toArray();
	}
	
	public function getCountByCriteria(array $criteria=null)
	{		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->rawGateway->getTable())
		       ->columns(array('count' => new \Zend\Db\Sql\Expression('count(transactions.id)')))
			   ->join(array('ad' => 'advertisements'), 'ad.id = '.$this->rawGateway->getTable().'.advertisementid')
		       ->join(array('advertiser' => 'advertisers'), 'advertiser.id = ad.advertiserid', array('advertiserfirstname' => 'firstname', 'advertiserlastname' => 'lastname'));
		
		if($criteria){
			$where = new \Zend\Db\Sql\Where();
				
			if(!empty($criteria['advertiserfirstname'])){
				$where = $where->like('advertiser.firstname', '%'.$criteria['advertiserfirstname'].'%');
			} // if
				
			if(!empty($criteria['advertiserlastname'])){
				$where = $where->like('advertiser.lastname', '%'.$criteria['advertiserlastname'].'%');
			} //  if
				
			$select->where($where);
		} // if

		$results = $this->rawGateway->selectWith($select);
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getCount()
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement('SELECT count(id) as count FROM transactions');
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	} // getCount
	
	public function fetchAllByAdvertiserId($advertiserid, $page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
			   ->join(array('ad' => 'advertisements'), 'ad.id = ' . $this->tableGateway->getTable() . '.advertisementid', array('advertisementname' => 'name', 'advertiserid'))
		       ->join(array('a' => 'advertisers'), 'a.id = ad.advertiserid', array('advertiserid' => 'id', 'advertiserfirstname' => 'firstname', 'advertiserlastname' => 'lastname'))
		       ->where(array('advertiserid' => $advertiserid))
		       ->order('id DESC')
		       ->offset((($page - 1) * $size))
		       ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCountByAdvertiserId($advertiserid);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	} // fetchAllByAdvertiserId
	
	public function getCountByAdvertiserId($advertiserid)
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement(
					'SELECT COUNT(transactions.id) AS count FROM transactions INNER JOIN advertisements a ON a.id = transactions.advertisementid WHERE a.advertiserid = ?',
					array((int)$advertiserid)
				);
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	} // getCountByAdvertiserId
	
	public function getTransaction($id)
	{
		$id = (int)$id;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
			   ->join(array('ad' => 'advertisements'), 'ad.id = ' . $this->tableGateway->getTable() . '.advertisementid', array('advertisementname' => 'name'))
		       ->join(array('a' => 'advertisers'), 'a.id = ad.advertiserid', array('advertiserid' => 'id', 'advertiserfirstname' => 'firstname', 'advertiserlastname' => 'lastname'))
		       ->where(array($this->tableGateway->getTable() . '.id' => $id));
		
		$results = $this->tableGateway->selectWith($select);
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		 
		return $result;
	} // getTransaction
	
	public function getTransactionByPaymentId($paymentid)
	{
		$paymentid = (string)$paymentid;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
		       ->join(array('ad' => 'advertisements'), 'ad.id = ' . $this->tableGateway->getTable() . '.advertisementid', array('advertisementname' => 'name'))
		       ->join(array('a' => 'advertisers'), 'a.id = ad.advertiserid', array('advertiserid' => 'id', 'advertiserfirstname' => 'firstname', 'advertiserlastname' => 'lastname'))
		       ->where(array($this->tableGateway->getTable() . '.paymentid' => $paymentid));
		
		$results = $this->tableGateway->selectWith($select);
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function save(Transaction $transaction)
	{
		$id = (int)$transaction->id();
		
		$data = array(
			'advertisementid' => $transaction->advertisementId(),
			'transactionstatusid' => $transaction->transactionStatusId(),
			'firstname' => $transaction->firstName(),
			'lastname' => $transaction->lastName(),
			'emailaddress' => $transaction->emailAddress(),
			'telephone' => $transaction->telephone(),
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
			'amount' => (float)$transaction->amount(),
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
			try{	
		
				$trans = $this->getTransactionByPaymentId($transaction->paymentId());
				
				if(!$trans){
					$this->tableGateway->insert($data);
					$transaction->id((int)$this->tableGateway->lastInsertValue);
				} // if
				else{
					$transaction = $trans;
				} // else
			} // try
			catch(\Exception $e){
				throw new \Exception('There has been an error inserting the Transaction', null, $e);
			} // catch
		} // else
	} // saveTransaction
}