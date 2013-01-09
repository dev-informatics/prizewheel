<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class AffiliatePayoutEntryTable
{
	protected $tableGateway = null;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll($page=1, $size=25, &$count)
	{
		$page = (int)$page;
		
		if($page < 1){
			$page = 1;
		} // if
		
		$size = (int)$size;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
			   ->join(array('a' => 'affiliates'), 'a.id = ' . $this->tableGateway->getTable() . '.affiliateid', array('affiliatefirstname' => 'firstname', 'affiliatelastname' => 'lastname'))
		       ->offset(($page - 1) * $size)
		       ->order('id DESC')
		       ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCount();
		
		$list = array();
		
		foreach($results as $result){
		 	$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function search(array $criteria=null, $page=1, $size=25, &$count)
	{
		$page = (int)$page;
		
		if($page < 1){
			$page = 1;
		} // if
		
		$size = (int)$size;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
			   ->join(array('a' => 'affiliates'), 'a.id = ' . $this->tableGateway->getTable() . '.affiliateid', array('affiliatefirstname' => 'firstname', 'affiliatelastname' => 'lastname'))
		       ->offset(($page - 1) * $size)
		       ->order('id DESC')
		       ->limit($size);
		
		if($criteria){
			
			$where = new \Zend\Db\Sql\Where();
			
			if(!empty($criteria['affiliatefirstname'])){
				$where = $where->like('a.firstname', '%'.$criteria['affiliatefirstname'].'%');
			} // if
			
			if(!empty($criteria['affiliatelastname'])){
				$where = $where->like('a.lastname', '%'.$criteria['affiliatelastname'].'%');
			} // if
			
			$select->where($where);
		} // if
		
		$results = $this->tableGateway->selectWith($select);
		
		return $results->toArray();
	}
	
	public function getCount()
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement('SELECT count(id) as count FROM affiliate_payout_entries');
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function fetchAllByAffiliateId($affiliateid, $page=1, $size=25, &$count)
	{
		$page = (int)$page;
		
		if($page < 1){
			$page = 1;
		} // if
	
		$size = (int)$size;
		
		$id = (int)$affiliateid;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
		       ->join(array('a' => 'affiliates'), 
		       		'a.id = ' . $this->tableGateway->getTable() . '.affiliateid', 
		       		array('affiliatefirstname' => 'firstname', 'affiliatelastname' => 'lastname')
		       	)
		       ->where(array('affiliateid' => $id))
		       ->order('id DESC')
		       ->offset(($page - 1) * $size)
		       ->limit($size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCountByAffiliateId($id);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getCountByAffiliateId($affiliateid)
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement(
					'SELECT count(id) as count FROM affiliate_payout_entries WHERE affiliateid = ?', 
					array($affiliateid)
				);
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getAffiliatePayoutEntry($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array("id" => $id));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function getAffiliatePayoutEntryByTransactionId($transactionid)
	{
		$transid = (string)$transactionid;
		
		$results = $this->tableGateway->select(array('transactionid' => $transid));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function getAffiliatePayoutEntryByUniqueId($uniqueid)
	{
		$uid = (string)$uniqueid;
		
		$results = $this->tableGateway->select(array('uniqueid' => $uid));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function getAffiliatePayoutTotal($affiliateid)
	{
		$id = (int)$affiliateid;
		
		$stmt = $this->tableGateway->getAdapter()->createStatement(
				"SELECT sum(amount) as total FROM affiliate_payout_entries WHERE affiliateid = ?", array($id));
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['total'])){
			return 0.00;
		} // if
		
		return $result['total'];
	}
	
	public function save(\Application\Model\AffiliatePayoutEntry $entry)
	{
		$id = (int)$entry->id();
		
		$data = array(
			'affiliateid' => $entry->affiliateId(),
			'amount' => $entry->amount(),
			'payoutmethod' => $entry->payoutMethod(),
			'claimedstatus' => $entry->claimedStatus(),
			'transactionid' => $entry->transactionId(),
			'uniqueid' => $entry->uniqueId(),
			'messages' => $entry->messages()
		);
		
		if($id > 0){
			if(!$this->getAffiliatePayoutEntry($id)){
				throw new \Exception("Could not located an Affiliate Payout Entry with the ID $id");
			} // if
			
			$this->tableGateway->update($data, array('id' => $id));
		} // if
		else{
			$this->tableGateway->insert($data);
			$entry->id((int)$this->tableGateway->lastInsertValue);
		} // if
	}
}