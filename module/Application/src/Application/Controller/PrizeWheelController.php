<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Model\PrizeWheelTable;
use Application\Model\PrizeWheelEntryTable;
use Application\Model\AdvertisementImpressionTable;

/**
 * PrizeWheelController
 *
 * @author
 *
 * @version
 *
 */
class PrizeWheelController extends FacebookAwareController 
{
	protected $prizeWheelTable = null;
	protected $prizeWheelEntryTable = null;
	protected $advertisementImpressionTable = null;
	
	public function __construct(PrizeWheelTable $prizeWheelTable, 
			PrizeWheelEntryTable $prizeWheelEntryTable, AdvertisementImpressionTable $advertisementImpressionTable, \Facebook $facebook)
	{
		$this->prizeWheelTable = $prizeWheelTable;
		$this->prizeWheelEntryTable = $prizeWheelEntryTable;
		$this->advertisementImpressionTable = $advertisementImpressionTable;
		$this->facebook = $facebook;
	}
	
	/**
	 * The default action - show the home page
	 */
	public function indexAction() 
	{
		// TODO Auto-generated PrizeWheelController::indexAction() default
		// action
		return new ViewModel ();
	}
	
	public function settingsAction()
	{
		
	}
	
	public function submitAction()
	{
		
	}
	
	public function createAction()
	{
		
	}
	
	public function manageAction()
	{
		
	}
}