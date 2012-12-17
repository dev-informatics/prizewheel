<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Application\Model\AdvertisementTypeTable;

/**
 * AdvertisementTypeController
 *
 * @author
 *
 * @version
 *
 */
class AdvertisementTypeController extends AbstractActionController 
{
	private $advertisementTypeTable;
	
	public function __construct(AdvertisementTypeTable $advertisementTypeTable)
	{
		$this->advertisementTypeTable = $advertisementTypeTable;
	}	
	
	/**
	 * Lists the Advertisement Types via Json
	 * 
	 * @return \Zend\View\Model\JsonModel
	 */
	public function listAction()
	{
		$advertisementTypes = $this->advertisementTypeTable->fetchAll();
		$list = array();
		foreach($advertisementTypes as $type){
			$list[] = array(
				'id' => $type->id(),
				'name' => $type->name(),
				'description' => $type->description()	
			);
		} // foreach
		return new JsonModel($list);	
	}
}