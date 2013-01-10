<?php

namespace Application\Controller;

use Application\Model\AffiliatePayoutEntryTable;
use Zend\View\Model\JsonModel;
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
	protected $affiliatePayoutEntryTable = null;
	
	public function __construct(AffiliateTable $affiliateTable, 
			PrizeWheelTypeTable $prizeWheelTypeTable, 
			PrizeWheelTable $prizeWheelTable, 
			AdvertisementCategoryTable $advertisementCategoryTable, 
			PrizeWheelEntryTable $prizeWheelEntryTable,
			PrizeWheelImpressionTable $prizeWheelImpressionTable,
			AdvertisementClickTable $advertisementClickTable,
			AffiliatePayoutEntryTable $affiliatePayoutEntryTable,
			\Facebook $facebook)
	{
		parent::__construct();
		$this->affiliateTable = $affiliateTable;
		$this->prizeWheelTypeTable = $prizeWheelTypeTable;
		$this->prizeWheelTable = $prizeWheelTable;
		$this->advertisementCategoryTable = $advertisementCategoryTable;
		$this->prizeWheelEntryTable = $prizeWheelEntryTable;
		$this->prizeWheelImpressionTable = $prizeWheelImpressionTable;
		$this->advertisementClickTable = $advertisementClickTable;
		$this->affiliatePayoutEntryTable = $affiliatePayoutEntryTable;
		$this->facebook = $facebook;
	} // ctor
	
	/**
	 * The default action - show the home page
	 */
	public function indexAction() 
	{	
		// Check if we are logged into facebook, if not
		// redirect to login and await return.
		if(!$this->isLoggedIntoFacebook() || !$this->getUserInformation()){
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
		$categories = $this->advertisementCategoryTable->fetchAllEnabled();
		
		$totalClicks = 0;
		
		foreach($prizeWheels as $prizeWheel){
			$prizeWheel->plays($this->prizeWheelEntryTable->getCountByPrizeWheelId($prizeWheel->id()));
			$prizeWheel->views($this->prizeWheelImpressionTable->getCountByPrizeWheelId($prizeWheel->id()));
			$prizeWheel->advertisementClicks($this->advertisementClickTable->getCountByPrizeWheelId($prizeWheel->id()));
			
			$totalClicks += $prizeWheel->advertisementClicks();
			
			$pageData = $this->getFacebookPageName($prizeWheel->pageId());
			
			if(!$pageData){
				$pageData = array(
							'name' => ''
						);
			} // if
			
			$prizeWheel->facebookPageName($pageData['name']);
		} // foreach
		
		$cpcRate = (float)$this->getConfigValue('affiliate payout rate')->value();
		$totalRevenue = (float)($totalClicks * $cpcRate);
		$paidRewards = (float)$this->affiliatePayoutEntryTable->getAffiliatePayoutTotal($affiliate->id());
		
		// TODO Auto-generated AffiliateController::indexAction() default action
		return new ViewModel(array(
			'affiliate' => $affiliate,
			'fbappid' => $this->getFacebookAppId(),
			'prizewheeltypes' => $prizeWheelTypes,
			'prizewheels' => $prizeWheels,
			'categories' => $categories,
			'paidrewards' => $paidRewards,
			'unpaidrewards' => $totalRevenue - $paidRewards,
			'cpcreward' => $cpcRate
  		));
	}
	
	private function getFacebookPageName($pageid)
	{
		try{
			return $this->getApiResult('/' . $pageid . '?access_token=' . $this->getFacebookAccessToken());
		} // try
		catch(\Exception $e){
			error_log('Prize Wheel Exception: ' . $e->getMessage() . ' ' . $e->getTraceAsString());
		} // catch
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
				$affiliate->enabled(true);
				
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
	
	public function manageAction()
	{
		$affiliate = null;
		$form = null;
		$layout = 'layout/layout';
		
		// We need to determine if we are accessing this page as an
		// Admin or an Affiliate and act accordingly.
		if($this->authenticationService->hasIdentity()){
			$id = $this->params()->fromRoute('id', 0);
			
			$affiliate = $this->affiliateTable->getAffiliate($id);
			
			if(!$affiliate){
				return $this->redirect()->toRoute('affiliate', array('action' => 'list'));
			} // if
			
			$form = new \Application\Form\ManageAffiliateForm("", true);
			$layout = 'layout/admin_layout';
		} // if
		else{
			
			if(!$this->isLoggedIntoFacebook()){
				return $this->redirect()->toRoute('affiliate');
			} // if
			
			$affiliate = $this->affiliateTable->getAffiliateByFacebookId($this->getFacebookUserId());
			
			if(!$affiliate){
				return $this->redirect()->toRoute('affiliate');
			} // if
			
			$form = new \Application\Form\ManageAffiliateForm();
		} // else
		
		$form->bind($affiliate);
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$form->setData($request->getPost());
			
			if($form->isValid()){
				
				try{
					$this->affiliateTable->save($form->getData());
				} // try
				catch(\Exception $e){
					error_log('Prize Wheel Exception: ' . $e->getMessage());
				} // catch
			} //if
		} // if
 		
		return new ViewModel(array(
			'affiliatename' => $affiliate->name(),
			'id' => $affiliate->id(),
			'form' => $form,
			'layoutpath' => $layout,
			'isadmin' => $this->authenticationService->hasIdentity()			
		));
	}
	
	public function listAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			$page = $this->params()->fromPost('page', 1);

			$count = 0;
			
			$affiliates = $this->affiliateTable->fetchAll($page, 25, $count);
		
			$list = array();
			
			foreach($affiliates as $affiliate){
				$list[] = $affiliate->getArrayCopy();
			} // foreach
			
			return new JsonModel(array(
				'status' => 'success',
				'count' => $count,
				'affiliates' => $list
			));
		} // if
		
		$count = 0;
		
		$affiliates = $this->affiliateTable->fetchAll(1, 25, $count);
		
		return new ViewModel(array(
			'affiliates' => $affiliates,
			'count' => $count
		));
	}
}