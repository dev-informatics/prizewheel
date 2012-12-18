<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class AdvertisementTypeTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	/**
	 * 
	 * @return array
	 */
	public function fetchAll()
	{
		$results = $this->tableGateway->select();
		
		$list = array();
		
		foreach($results as $result){
			$list[] = $result;
		} // foreach
		
		return $list;		
	}
	
	/**
	 * 
	 * @param int $id
	 * @throws \Exception
	 * @return \Application\Model\AdvertiserType
	 */
	public function getAdvertisementType($id)
	{
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();

		if(!results){
			throw new \Exception("Could not locate Advertisement Type with id: $id");
		} // if
		
		return $result;
	}
}