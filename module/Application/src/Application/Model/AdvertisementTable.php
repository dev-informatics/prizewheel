<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Advertisement;

class AdvertisementTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAllByAdvertiserId($id)
	{		
		$select = new \Zend\Db\Sql\Select();
		
		$select->from('advertisements')
		       ->join(array("adt" => "advertisement_types"),
			     	'advertisements.typeid = adt.id',
					array("typename" => "name"))
			   ->where(array('advertiserid' => $id));

		$results = $this->tableGateway->selectWith($select);
	
		return $results;
	}
	
	public function fetchAllEnabledByAdvertiserId($id)
	{
		$select = new \Zend\Db\Sql\Select();
		
		$select->from('advertisements')
		       ->join(array("adt" => "advertisement_types"),
			     	'advertisements.typeid = adt.id',
					array("typename" => "name"))
			   ->where(array('advertiserid' => $id, 'advertisements.enabled' => 1));	       

		$results = $this->tableGateway->selectWith($select);

		return $results;
	}
	
	public function getAdvertisement($id)
	{
		$results = $this->tableGateway->select(array('id' => $id));
		$result = $results->current();

		if(!$result){
			return null;
		} // if
		
		return $result;
	}
	
	public function save(Advertisement $advertisement)
	{
		$id = (int) $advertisement->id();

		$data = array(
			'advertiserid' => $advertisement->advertiserId(),
			'name' => $advertisement->name(),
			'description' => $advertisement->description(),
			'typeid' => $advertisement->typeId(),
			'bannerimage' => $advertisement->bannerImage(),
			'url' => $advertisement->url(),
			'bucket' => $advertisement->bucket(),
			'enabled' => $advertisement->enabled()	
		);
	
		if($id > 0){
			if($this->getAdvertisement($id)){
				$this->tableGateway->update($data, array('id' => $id));
			} // if
			else{
				throw new \Exception("Could not load Advertisement by id: $id");
			}
		} // if
		else{
			$this->tableGateway->insert($data);
			$advertisement->id((int)$this->tableGateway->lastInsertValue);
		} // else
	}
	
	public function disable($id)
	{
		$id = (int)$id;
		$this->tableGateway->update(array('enabled' => 0), array('id' => $id));
	}
	
	public function delete($id)
	{
		$id = (int)$id;
		$this->tableGateway->delete(array('id' => $id));
	}
}