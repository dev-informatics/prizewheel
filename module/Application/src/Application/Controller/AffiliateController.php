<?php

namespace Application\Controller;

use Application\Model\Affiliate;
use Application\Form\AffiliateRegistrationForm;
use Zend\View\Model\ViewModel;
use Application\Model\AffiliateTable;
use Application\Model\PrizeWheelTypeTable;
use Application\Model\PrizeWheelTable;
use Application\Model\AdvertisementCategoryTable;
use Application\Model\PrizeWheelEntryTable;
use Application\Model\PrizeWheelImpressionTable;
use Application\Model\AdvertisementClickTable;

/**
 * AffiliateController
 *
 * @author
 *
 * @version
 *
 */
class AffiliateController extends FacebookAwareController 
{
	protected $affiliateTable = null;
	protected $prizeWheelTypeTable = null;
	protected $prizeWheelTable = null;
	protected $advertisementCategoryTable = null;
	protected $prizeWheelEntryTable = null;
	protected $prizeWheelImpressionTable = null;
	protected $advertisementClickTable = null;
	
	public function __construct(AffiliateTable $affiliateTable, 
			PrizeWheelTypeTable $prizeWheelTypeTable, 
			PrizeWheelTable $prizeWheelTable, 
			AdvertisementCategoryTable $advertisementCategoryTable, 
			PrizeWheelEntryTable $prizeWheelEntryTable,
			PrizeWheelImpressionTable $prizeWheelImpressionTable,
			AdvertisementClickTable $advertisementClickTable, \Facebook $facebook)
	{
		$this->affiliateTable = $affiliateTable;
		$this->prizeWheelTypeTable = $prizeWheelTypeTable;
		$this->prizeWheelTable = $prizeWheelTable;
		$this->advertisementCategoryTable = $advertisementCategoryTable;
		$this->prizeWheelEntryTable = $prizeWheelEntryTable;
		$this->prizeWheelImpressionTable = $prizeWheelImpressionTable;
		$this->advertisementClickTable = $advertisementClickTable;
		$this->facebook = $facebook;
	}
	
	/**
	 * The default action - show the home page
	 */
	public function indexAction() 
	{	
		// Check if we are logged into facebook, if not
		// redirect to login and await return.
		if(!$this->isLoggedIntoFacebook()){
			return new ViewModel(array(
				'loginredirect' => 	$this->fetchLoginUrl('/affiliate')
			)); 
		} // if
		
		$affiliate = $this->affiliateTable->getAffiliateByFacebookId($this->getFacebookUserId());
		
		if(!$affiliate){
			return $this->redirect()->toRoute('affiliate', array('action' => 'register'));
		} // if
		
		// Ok, we should be logged into Facebook now.
		// Attempt to locate the Affiliate by the Facebook ID, if
		// we cannot locate them, redirect to register action.
		
		$prizeWheelTypes = $this->prizeWheelTypeTable->fetchAll();
		
		$prizeWheels = $this->prizeWheelTable->fetchAllEnabledByAffiliateId($affiliate->id(), 1, 100);
		$categories = $this->advertisementCategoryTable->fetchAll();
		
		foreach($prizeWheels as $prizeWheel){
			$prizeWheel->plays($this->prizeWheelEntryTable->getCountByPrizeWheelId($prizeWheel->id()));
			$prizeWheel->views($this->prizeWheelImpressionTable->getCountByPrizeWheelId($prizeWheel->id()));
			$prizeWheel->advertisementClicks($this->advertisementClickTable->getCountByPrizeWheelId($prizeWheel->id()));
		} // foreach
		
		// TODO Auto-generated AffiliateController::indexAction() default action
		return new ViewModel(array(
			'affiliate' => $affiliate,
			'fbappid' => $this->getFacebookAppId(),
			'prizewheeltypes' => $prizeWheelTypes,
			'prizewheels' => $prizeWheels,
			'categories' => $categories
		));
	}
	
	public function registerAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return $this->redirect()->toRoute("affiliate");
		} // if
		
		$registrationform = new AffiliateRegistrationForm();
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			$affiliate = new Affiliate();
			$registrationform->setData($request->getPost());

			if($registrationform->isValid()){				
				$affiliate->exchangeArray($registrationform->getData());
				$affiliate->facebookUserId($this->getFacebookUserId());
				
				try{
					$this->affiliateTable->save($affiliate);
					
					// Redirect to the Index (Dashboard) view.
					return $this->redirect()->toRoute('affiliate');
				} // try
				catch(\Exception $e){
					// Need to notify user of Facebook Issue.
				} // catch			
			} // if
		} // if
		
		$fbuser = $this->getUserInformation();
		
		if(strlen($registrationform->get("firstname")->getValue()) <= 0 && isset($fbuser['first_name'])){
			$registrationform->get("firstname")->setValue($fbuser['first_name']);
		} // if
		
		if(strlen($registrationform->get("lastname")->getValue()) <= 0 && isset($fbuser['last_name'])){
			$registrationform->get("lastname")->setValue($fbuser['last_name']);
		} // if
		
		return new ViewModel(array(
			'registrationform' => $registrationform
		));
	}	
}