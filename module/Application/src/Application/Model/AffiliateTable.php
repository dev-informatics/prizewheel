<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Affiliate;

class AffiliateTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll($page=1, $take=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new \Zend\Db\Sql\Select();
		$select->from($this->tableGateway->getTable());
		$select->order('lastname ASC');
		$select->offset(($page - 1) * $take);
		$select->limit($take);
	
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCount();
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getCount()
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement("SELECT count(id) as count FROM affiliates");
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getAffiliate($id)
	{
		$id = (int)$id;
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function getAffiliateByFacebookId($fbid)
	{
		$fbid = (string)$fbid;
		$results = $this->tableGateway->select(array('facebookuserid' => $fbid));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function save(Affiliate $affiliate)
	{
		$id = (int)$affiliate->id();
		$fid = (string)$affiliate->facebookUserId();
		
		$data = array(
			'facebookuserid' => $affiliate->facebookUserId(),
			'firstname' => $affiliate->firstName(),
			'lastname' => $affiliate->lastName(),
			'address1' => $affiliate->address1(),
			'address2' => $affiliate->address2(),
			'city' => $affiliate->city(),
			'state' => $affiliate->state(),
			'country' => $affiliate->country(),
			'postal' => $affiliate->postal(),
			'telephone' => $affiliate->telephone(),
			'emailaddress' => $affiliate->emailAddress(),
			'enabled' => $affiliate->enabled()	? 1 : 0
		);
		
		if($id > 0 && !empty($fid)){
			if($this->getAffiliate($id)){
				$this->tableGateway->update($data, array('id' => $id));
			} // if
			else{
				throw new \Exception("Could not locate Affiliate with id: $id");
			} // else
		} // if
		else{
			
			if(empty($fid)){
				throw new \Exception("An Affiliate must have a Facebook User ID.");
			} // if			
			$this->tableGateway->insert($data);
			$affiliate->id((int)$this->tableGateway->lastInsertValue);
		} // else
	}
}