<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\PrizeWheelEntryCategoryEntry;

class PrizeWheelEntryCategoryEntryTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function save(PrizeWheelEntryCategoryEntry $entry)
	{
		$id = (int) $entry->id();
		
		$data = array(
			'prizewheelentryid' => $entry->prizeWheelEntryId(),
			'advertisementcategoryid' => $entry->advertisementCategoryId()
		);
		
		if($id <= 0){
			$this->tableGateway->insert($data);
			$entry->id((int)$this->tableGateway->lastInsertValue);
		} // 
	}
}