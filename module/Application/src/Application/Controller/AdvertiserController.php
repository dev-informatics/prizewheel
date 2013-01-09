<?php

namespace Application\Controller;

use Application\Model\AdvertiserDataSourceInterface;
use Application\Model\AdvertisementDataSourceInterface;
use Zend\View\Model\JsonModel;
use Application\Model\AdvertisementImpressionTable;
use Application\Model\AdvertisementClickTable;
use Application\Form\AdvertiserRegistrationForm;
use Zend\View\Model\ViewModel;
use Application\Model\Advertiser;

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
	protected $authenticationService = null;
	
	public function __construct(AdvertiserDataSourceInterface $advertiserTable, AdvertisementDataSourceInterface $advertisementTable,
			AdvertisementClickTable $advertisementClickTable, AdvertisementImpressionTable $advertisementImpressionTable, \Facebook $facebook)
	{
		parent::__construct();
		$this->advertiserTable = $advertiserTable;
		$this->advertisementTable = $advertisementTable;
		$this->advertisementClickTable = $advertisementClickTable;
		$this->advertisementImpressionTable = $advertisementImpressionTable;
		$this->facebook = $facebook;
		$this->authenticationService = new \Zend\Authentication\AuthenticationService();
	} // ctor
	
	public function indexAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return new ViewModel(array(
				'loginredirect' => 	$this->fetchLoginUrl('/advertiser')
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
	} // indexAction
	
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
				$advertiser->enabled(true);
				
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
	} // registerAction
	
	public function manageAction()
	{
		$advertiser = null;
		$form = null;
		$layout = 'layout/layout';
		
		if($this->authenticationService->hasIdentity()){
			$id = $this->params()->fromRoute('id', 0);
			
			$advertiser = $this->advertiserTable->getAdvertiser($id);
			
			if(!$advertiser){
				return $this->redirect()->toRoute('advertiser', array('action' => 'list'));
			} // if
			
			$form = new \Application\Form\ManageAdvertiserForm("manage-advertiser", true);
			$layout = 'layout/admin_layout';
 		} // if
		else{
			
			if(!$this->isLoggedIntoFacebook()){
				return $this->redirect()->toRoute('advertiser');
			} // if
			
			$advertiser = $this->advertiserTable->getAdvertiserByFacebookUserId($this->getFacebookUserId());
			
			if(!$advertiser){
				return $this->redirect()->toRoute('advertiser');
			} // if
			
			$form = new \Application\Form\ManageAdvertiserForm();
		} // else
			
		$form->bind($advertiser);
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$form->setData($request->getPost());
			
			if($form->isValid()){
				
				try{
					$this->advertiserTable->save($form->getData());
				} // try
				catch(\Exception $e){
					error_log('Prize Wheel Exception: ' . $e->getMessage());
				} // catch
			} // if
		} // if
		
		return new ViewModel(array(
				'advertisername' => $advertiser->name(),
				'id' => $advertiser->id(),
				'form' => $form,
				'layoutpath' => $layout,
				'isadmin' => ($this->authenticationService->hasIdentity() && $this->authenticationService->getIdentity() == "admin")	
			));
	} // manageAction
	
	public function listAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$page = $this->params()->fromPost('page', 1);
			$count = 0;
			
			$advertisers = $this->advertiserTable->fetchAll($page, 25, $count);
			
			$list = array();
			
			foreach($advertisers as $advertiser){
				$list = $advertiser->toArrayCopy();
			} // foreach
			
			return new JsonModel(array(
					'status' => 'success',
					'count' => $count,
					'advertisers' => $list
				));
		} // if
		
		$count = 0;
		
		$advertisers = $this->advertiserTable->fetchAll(1, 25, $count);
		
		return new ViewModel(array(
				'advertisers' => $advertisers,
				'count' => $count	
			));
	} // listAction
}