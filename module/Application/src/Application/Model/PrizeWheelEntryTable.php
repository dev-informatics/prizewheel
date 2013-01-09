<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Application\Model\PrizeWheelEntry;

class PrizeWheelEntryTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll($page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$select = new Select();
		
		$select->from($this->tableGateway->getTable())
		       ->offset((int)($page - 1) * (int)$size)
		       ->limit((int)$size);

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
		$stmt = $this->tableGateway->getAdapter()->createStatement("SELECT count(id) as count FROM prizewheel_entries");
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function fetchAllWithId(array $idlist)
	{
		$where = new \Zend\Db\Sql\Where();
		$where->in('id', $idlist);

		$results = $this->tableGateway->select($where);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function fetchAllByPrizeWheelId($prizewheelid, $page=1, $size=25, &$count)
	{
		if($page < 1){
			$page = 1;
		} // if
		
		$prizewheelid = (int)$prizewheelid;
		
		$select = new Select();
		
		$select->from($this->tableGateway->getTable())
	 		   ->where(array('prizewheelid' => $prizewheelid))
		       ->offset((int)($page - 1) * (int)$size)
		       ->limit((int)$size);
		
		$results = $this->tableGateway->selectWith($select);
		
		$count = $this->getCountByPrizeWheelId($prizewheelid);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;			
		} // foreach
		
		return $list;
	}
	
	public function getLastPrizeWheelEntryByFacebookUserId($prizewheelid, $facebookuserid)
	{
		$prizewheelid = (int)$prizewheelid;
		$facebookuserid = (string)$facebookuserid;
		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable())
		       ->where(array('prizewheelid' => $prizewheelid, 'facebookuserid' => $facebookuserid))
		       ->order('id DESC');
		
		$results = $this->tableGateway->selectWith($select);
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result; 
	}
	
	public function fetch($options=array(), $prizewheelid, $page=1, $take=25)
	{
		$select = new \Zend\Db\Sql\Select();
		
		$select->from($this->tableGateway->getTable());
		
		$where = new \Zend\Db\Sql\Where();
		
		if(isset($options['emailaddress'])){
			
			if(isset($options['emailaddress']['comparison'])){
				switch($options['emailaddress']['comparison']){
					case "equalto":
						$where = $where->equalTo('emailaddress', $options['emailaddress']['value']);
						break;
					case "like":
						$where = $where->like('emailaddress', '%'.$options['emailaddress']['value'].'%');
						break;
					default:
						$where = $where->equalTo('emailaddress', $options['emailaddress']['value']);
						break;
				} // switch
			} // if
			else{
				$where = $where->equalTo('emailaddress', $options['emailaddress']['value']);
			} // else
		} // if
		
		if(isset($options['telephone'])){
			
			if(isset($options['telephone']['comparison'])){
				switch($options['telephone']['comparison']){
					case "equalto":
						$where = $where->equalTo('telephone', $options['telephone']['value']);
						break;
					case "like":
						$where = $where->like('telephone', $options['telephone']['value']);
						break;
					default:
						$where = $where->equalTo('telephone', $options['telephone']['value']);
						break;
				} // switch
			} // if
			else{
				$where = $where->equalTo('telephone', $options['telephone']['value']);
			} // else		
		} // if
		
		if(isset($options['ipaddress'])){
			
			if(isset($options['ipaddress']['comparison'])){
				switch($options['ipaddress']['comparison']){
					case "equalto":
						$where = $where->equalTo('ipaddress', $options['ipaddress']['value']);
						break;
					case "like":
						$where = $where->like('ipaddress', $options['ipaddress']['value']);
						break;
					default:
						$where = $where->equalTo('ipaddress', $options['ipaddress']['value']);
						break;
				} // switch
			} // if
			else{
				$where = $where->equalTo('ipaddress', $options['ipaddress']['value']);
			} // else
		} // if
		
		$prizewheelid = (int)$prizewheelid;
		
		$where = $where->equalTo('prizewheelid', $prizewheelid);
		
		$select->where($where)
		       ->offset(($page - 1) * $take)
		       ->limit($take);

		$results = $this->tableGateway->selectWith($select);
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;
	}
	
	public function getExportedCountByPrizeWheelId($prizewheelid)
	{
		$id = (int)$prizewheelid;
		
		$stmt =  $this->tableGateway->getAdapter()->createStatement(
					"SELECT count(id) as count FROM " . $this->tableGateway->getTable() . ' WHERE prizewheelid = ? AND exported = 1',
					array($id)
				);
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getCountByPrizeWheelId($prizewheelid)
	{
		$prizewheelid = (int)$prizewheelid;
		
		$stmt = $this->tableGateway->getAdapter()->createStatement(
				"SELECT count(id) as count FROM prizewheel_entries WHERE prizewheelid = ?", array($prizewheelid));
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getPrizeWheelEntry($id)
	{
		$id = (int)$id;
		
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function updateAsExported(array $prizeWheelEntryIdList)
	{
		$update = new \Zend\Db\Sql\Update();
		$where = new \Zend\Db\Sql\Where();	
	
		$where->in('id', $prizeWheelEntryIdList);
		
		$update->table($this->tableGateway->getTable())
		       ->set(array('exported' => 1))
			   ->where($where);
		
		$this->tableGateway->updateWith($update);
	}
	
	public function savePrizeWheelEntry(PrizeWheelEntry $prizeWheelEntry)
	{
		$id = (int)$prizeWheelEntry->id();
		
		$data = array(
			'prizewheelid' => $prizeWheelEntry->prizeWheelId(),
			'facebookuserid' => $prizeWheelEntry->facebookUserId(),
			'firstname' => $prizeWheelEntry->firstName(),
			'lastname' => $prizeWheelEntry->lastName(),
			'emailaddress' => $prizeWheelEntry->emailAddress(),
			'telephone' => $prizeWheelEntry->telephone(),
			'ipaddress' => $prizeWheelEntry->ipAddress(),
			'prize' => $prizeWheelEntry->prize(),
			'exported' => $prizeWheelEntry->exported() ? 1 : 0
		);
		
		if($id > 0){
			if(!$this->getPrizeWheelEntry($id)){
				throw new \Exception("A Prize Wheel Entry with id $id cannot be found.");
			} // if
			else{
				$this->tableGateway->update($data, array('id' => $id));
			} // else
		} // if
		else{
			$this->tableGateway->insert($data);
			$prizeWheelEntry->id((int)$this->tableGateway->lastInsertValue);
		}
	}
}