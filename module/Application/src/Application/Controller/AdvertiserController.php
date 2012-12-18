<?php

namespace Application\Controller;

use Application\Model\AdvertisementImpressionTable;
use Application\Model\AdvertisementClickTable;
use Application\Model\AdvertisementTable;
use Application\Form\AdvertiserRegistrationForm;
use Zend\View\Model\ViewModel;
use Application\Model\Advertiser;
use Application\Model\AdvertiserTable;

/**
 * AdvertiserController
 *
 * @author
 *
 * @version
 *
 */
class AdvertiserController extends FacebookAwareController
{
	protected $advertiserTable = null;
	protected $advertisementTable = null;
	protected $advertisementClickTable = null;
	protected $advertisementImpressionTable = null;
	
	public function __construct(AdvertiserTable $advertiserTable, AdvertisementTable $advertisementTable,
			AdvertisementClickTable $advertisementClickTable, AdvertisementImpressionTable $advertisementImpressionTable, \Facebook $facebook)
	{
		$this->advertiserTable = $advertiserTable;
		$this->advertisementTable = $advertisementTable;
		$this->advertisementClickTable = $advertisementClickTable;
		$this->advertisementImpressionTable = $advertisementImpressionTable;
		$this->facebook = $facebook;
	}
	
	public function indexAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return new ViewModel(array(
				'loginredirect' => 	$this->fetchLoginUrl('/affiliate')
			)); 
		} // if
		
		$advertiser = $this->advertiserTable->getAdvertiserByFacebookUserId($this->getFacebookUserId());
		
		if(!$advertiser){
			return $this->redirect()->toRoute('advertiser', array('action' => 'register'));
		} // if
		
		$advertisements = $this->advertisementTable->fetchAllEnabledByAdvertiserId($advertiser->id());
				
		foreach($advertisements as $advertisement){
			$advertisement->impressions($this->advertisementImpressionTable->fetchCountByAdvertisementId($advertisement->id()));
			$advertisement->clicks($this->advertisementClickTable->fetchCountByAdvertisementId($advertisement->id()));
		} // foreach
		
		return new ViewModel(array(
			'advertiser' => $advertiser,
			'advertisements' => $advertisements
		));
	}
	
	/**
	 * The default action - show the home page
	 */
	public function registerAction() 
	{	
		if(!$this->isLoggedIntoFacebook()){
			return $this->redirect()->toRoute("advertiser");
		} // if
		
		$registrationform = new AdvertiserRegistrationForm();
		$request = $this->getRequest();
		
		if($request->isPost()){
			$advertiser = new Advertiser();
			$registrationform->setData($request->getPost());
			
			if($registrationform->isValid()){
				$advertiser->exchangeArray($registrationform->getData());
				$advertiser->facebookUserId($this->getFacebookUserId());
				
				try{
					$this->advertiserTable->save($advertiser);
					return $this->redirect()->toRoute('advertiser');
				} // try
				catch(\Exception $e){
					
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