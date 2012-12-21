<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\PrizeWheelImpression;

class PrizeWheelImpressionTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	} // ctor
	
	public function getCountByPrizeWheelId($prizewheelid)
	{
		$stmt = $this->tableGateway->getAdapter()->createStatement("SELECT count(id) as count FROM prizewheel_impressions WHERE prizewheelid = ?", array($prizewheelid));
		
		$results = $stmt->execute();
		
		$result = $results->current();
		
		if(!$result || !isset($result['count'])){
			return 0;
		} // if
		
		return $result['count'];
	}
	
	public function getPrizeWheelImpressionByFacebookUserId($id, $facebookuserid)
	{
		$id = (int)$id;
		$fid = (string)$facebookuserid;
		
		$results = $this->tableGateway->select(array('prizewheelid' => $id, 'facebookuserid' => $fid));
		
		$result = $results->current();
		
		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function save(PrizeWheelImpression $impression)
	{
		$id = (int)$impression->id();
		$fid = (string)$impression->facebookUserId();
		
		$data = array(
			'prizewheelid' => $impression->prizeWheelId(),
			'facebookuserid' => $impression->facebookUserId()	
		);
		
		if($id <= 0){
			if(!$this->getPrizeWheelImpressionByFacebookUserId($id, $fid)){
				$this->tableGateway->insert($data);
				$impression->id((int)$this->tableGateway->lastInsertValue);
			} // if
		} // if
	}
}