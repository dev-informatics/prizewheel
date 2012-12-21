<?php

namespace Application\Controller;

use Application\Model\PrizeWheelCategoryEntry;

use Application\Model\AdvertisementImpression;

use Application\Model\PrizeWheelCategoryEntryTable;
use Application\Model\PrizeWheelEntry;
use Application\Model\AdvertisementTable;
use Application\Model\AdvertisementPlacementType;
use Zend\View\Model\ViewModel;
use Application\Model\PrizeWheelTable;
use Application\Model\PrizeWheelEntryTable;
use Application\Model\AdvertisementImpressionTable;
use Application\Form\PrizeWheelInputFilter;
use Application\Model\PrizeWheel;
use Zend\View\Model\JsonModel;
use Application\Form\PrizeWheelInstallerInputFilter;
use Application\Model\AffiliateTable;
use Application\Form\PrizeWheelEntryInputFilter;
use Application\Model\PrizeWheelEntryCategoryEntryTable;
use Application\Model\PrizeWheelImpressionTable;
use Application\Model\AdvertisementCategoryTable;

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
	protected $affiliateTable = null;
	protected $advertisementTable = null;
	protected $prizeWheelEntryCategoryEntryTable = null;
	protected $prizeWheelCategoryEntryTable = null;
	protected $prizeWheelImpressionTable = null;
	protected $advertisementCategoryTable = null;
	
	public function __construct(PrizeWheelTable $prizeWheelTable, 
			PrizeWheelEntryTable $prizeWheelEntryTable, 
			AdvertisementImpressionTable $advertisementImpressionTable, 
			AffiliateTable $affiliateTable,
			AdvertisementTable $advertisementTable,
			PrizeWheelEntryCategoryEntryTable $prizeWheelEntryCategoryEntryTable,
			PrizeWheelCategoryEntryTable $prizeWheelCategoryEntryTable,
			PrizeWheelImpressionTable $prizeWheelImpressionTable,
			AdvertisementCategoryTable $advertisementCategoryTable,
			\Facebook $facebook)
	{
		$this->prizeWheelTable = $prizeWheelTable;
		$this->prizeWheelEntryTable = $prizeWheelEntryTable;
		$this->advertisementImpressionTable = $advertisementImpressionTable;
		$this->affiliateTable = $affiliateTable;
		$this->advertisementTable = $advertisementTable;
		$this->prizeWheelEntryCategoryEntryTable = $prizeWheelEntryCategoryEntryTable;
		$this->prizeWheelCategoryEntryTable = $prizeWheelCategoryEntryTable;
		$this->prizeWheelImpressionTable = $prizeWheelImpressionTable;
		$this->advertisementCategoryTable = $advertisementCategoryTable;
		$this->facebook = $facebook;
	} // ctor
	
	/**
	 * The default action - show the home page
	 */
	public function indexAction() 
	{
		$pageid = "158447550966525";

		$prizeWheel = $this->prizeWheelTable->getPrizeWheelByPageId($pageid);
		
		$pageInformation = array(
			'name' => 'unknown'	
		);
		
		try{
			$pageInformation = $this->getApiResult("/" . $pageid);
		} // try
		catch(\Exception $e){
			error_log("Prize Wheel Exception: " . $e->getMessage());
		} // catch
		
		$prizeWheelImpression = new \Application\Model\PrizeWheelImpression();
		$prizeWheelImpression->facebookUserId($this->getFacebookUserId());
		$prizeWheelImpression->prizeWheelId($prizeWheel->id());
		
		try{
			$this->prizeWheelImpressionTable->save($prizeWheelImpression);
		} // try
		catch(\Exception $e){
			error_log("Prize Wheel Exception: " . $e->getMessage());
		} // catch
		
		$viewModel = new ViewModel(
			array(
				"prizewheel" => $prizeWheel,
				"facebookappid" => $this->getFacebookAppId(),
				"facebookpagename" => $pageInformation['name']	
			)		
		);
		$viewModel->setTerminal(true);
		
		return $viewModel;
	} // indexAction
	
	public function settingsAction()
	{
		$id = (int)$this->params()->fromRoute('id', 0);

		if($id > 0){
			$prizeWheel = $this->prizeWheelTable->getPrizeWheel($id);
		
			$options = array();
			
			if($prizeWheel){
				
				$prizeWheelCategories = array();
				
				foreach($this->prizeWheelCategoryEntryTable->fetchAllByPrizeWheelId($prizeWheel->id()) as $category){
					$prizeWheelCategories[] = $category->advertisementCategoryId();
				} // foreach
				
				switch($prizeWheel->prizeWheelTypeId()){
					case \Application\Model\PrizeWheelType::Personalized:
						
						$advertisement = $this->advertisementTable->getRandomOfPlacementType(
							AdvertisementPlacementType::Sponser, $prizeWheelCategories
						);
			
						$options[] = $advertisement;
						break;
					case \Application\Model\PrizeWheelType::AdDriven:
					
						$advertisement = $this->advertisementTable->getRandomOfPlacementType(
							AdvertisementPlacementType::Sponser, $prizeWheelCategories
						);
			
						$options[] = $advertisement;
						
						for($i = 0; $i < 12; $i++){
							$options[] = $this->advertisementTable->getRandomOfPlacementType(
								AdvertisementPlacementType::PrizeWheel, $prizeWheelCategories
							);
						} // for					
						break;
					default:
						throw new \Exception("Prize Wheel Type not recognized.");
				} // switch
				
				foreach($options as $advertisement){
						
					$advertisementImpression = new AdvertisementImpression();
					$advertisementImpression->advertisementId($advertisement->id());
					$advertisementImpression->facebookUserId($this->getFacebookUserId());
					$advertisementImpression->prizeWheelId($prizeWheel->id());

					try{
						$this->advertisementImpressionTable->save($advertisementImpression);
					} // try
					catch(\Exception $e){
						error_log('Prize Wheel Exception: ' . $e->getMessage());
					} // catch
				} // foreach
				
				$options = $prizeWheel->parseAdvertisements($options);
				
				$settingsXml = $prizeWheel->getSettingsXml($options);
				
				return $this->response->setContent($settingsXml);
			} // if
		} // if
		
		return $this->response;
	} // settingsAction
	
	public function submitAction()
	{
		$id = (int)$this->params()->fromRoute('id', 0);
		
		if($id <= 0){
			return $this->response->setContent("result=error&text=InvalidPrizeWheelId");
		} // if
		
		$prizeWheel = $this->prizeWheelTable->getPrizeWheel($id);
		
		if(!$prizeWheel){
			return $this->response->setContent("result=error&text=InvalidPrizeWheelId");
		} // if
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$filter = new PrizeWheelEntryInputFilter();
			
			$filter->setData($request->getPost());	
			
			if($filter->isValid()){			
				
				if($prizeWheel->emailFilter()){
					$results = $this->prizeWheelEntryTable->fetch(array(
						'emailaddress' => array(
							'value' => $filter->get('email_txt')
						)		
					), 1, 1);
					
					if(count($results) > 0){
						return $this->response->setContent("result=Already");
					} // if
				} // if
				
				if($prizeWheel->ipAddressFilter()){
					
					$results = $this->prizeWheelEntryTable->fetch(array(
							'emailaddress' => array(
									'value' => $filter->get('email_txt')
							)
					), 1, 1);
					
					if(count($results) > 0){
						return $this->response->setContent("result=Already");
					} // if
				} // if
				
				if($prizeWheel->phoneFilter()){
					
					$results = $this->prizeWheelEntryTable->fetch(array(
							'emailaddress' => array(
									'value' => $filter->get('email_txt')
							)
					), 1, 1);
					
					if(count($results) > 0){
						return $this->response->setContent("result=Already");
					} // if
				} // if
				
				$hasId = isset($request->getPost()['id']);
				
				$prizeWheelEntry = null;
				
				if($hasId){
					
					$prizeWheelEntry = $this->prizeWheelEntryTable->getPrizeWheelEntry((int)$filter->getValue('id'));
					
					if(!$prizeWheelEntry){
						return $this->response->setContent("result=error&text=NotLocated");
					} // if
					
					$prizeWheelEntry->id($filter->getValue('id'));
					$prizeWheelEntry->prize($filter->getValue('code'));
				} // if
				else{
					$prizeWheelEntry = new PrizeWheelEntry();
					$prizeWheelEntry->prizeWheelId($prizeWheel->id());
					$prizeWheelEntry->facebookUserId($this->getFacebookUserId());
					$prizeWheelEntry->emailAddress($filter->getValue("email_txt"));
					$prizeWheelEntry->firstName($filter->getValue("fname_txt"));
					$prizeWheelEntry->ipAddress($request->getServer('REMOTE_ADDR'));
					$prizeWheelEntry->lastName($filter->getValue('lname_txt'));
					$prizeWheelEntry->telephone($filter->getValue('phone_txt'));
				} // else
				
				try{					
					$this->prizeWheelEntryTable->savePrizeWheelEntry($prizeWheelEntry);
					
					if(!$hasId){
						
						foreach($this->prizeWheelCategoryEntryTable->fetchAllByPrizeWheelId($prizeWheel->id()) as $category){
							
							$entryCategoryEntry = new \Application\Model\PrizeWheelEntryCategoryEntry();
							$entryCategoryEntry->prizeWheelEntryId($prizeWheelEntry->id());
							$entryCategoryEntry->advertisementCategoryId($category->id());
							
							try{
								$this->prizeWheelEntryCategoryEntryTable->save($entryCategoryEntry);
							} // try
							catch(\Exception $e){
								error_log("Prize Wheel Exception: " . $e->getMessage());
							} // catch
						} // foreach
					} // if
					
					if($prizeWheelEntry->id() > 0){
						return $this->response->setContent('result=ok&id='.$prizeWheelEntry->id());
					} // if
					else{
						return $this->response->setContent("result=error&text=ErrorInsert");
					} // else
				} // try
				catch(\Exception $e){
					error_log('Prize Wheel Exception: ' . $e->getMessage());
					$this->response->setContent("result=error&text=ErrorInsert");
				} // catch
			} // if
			else{
				$invalidInputs = $filter->getInvalidInput();
				
				if(isset($invalidInputs['email_txt'])){
					return $this->response->setContent("result=mail");
				} // if
				
				return $this->response->setContent("result=error&text=ValidationFailure");
			} // else
		} // if
		
		return $this->response->setContent("result=error&text=SubmissionFailure");
	} // submitAction
	
	public function installerAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return new JsonModel(array(
				"status" => "error",
				"messages" => array(
					"error" => array(
						"Not Authenticated"
					)
				)	
			));
		} // if
		
		$affiliate = $this->affiliateTable->getAffiliateByFacebookId($this->getFacebookUserId());
		
		if(!$affiliate){
			return new JsonModel(array(
				"status" => "error",
				"messages" => array(
					"error" => array(
						"Not Authorized"
					)
				)	
			));
		} // if
		
		$prizeWheelInstallerInputFilter = new PrizeWheelInstallerInputFilter();
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			$prizeWheelInstallerInputFilter->setData($request->getPost());
			
			if($prizeWheelInstallerInputFilter->isValid()){				
		
				$prizeWheel = new PrizeWheel();				
				$prizeWheel->exchangeArray($prizeWheelInstallerInputFilter->getValues());
				$prizeWheel->affiliateId($affiliate->id());
				$prizeWheel->enabled(true);
	
				try{
					$this->prizeWheelTable->save($prizeWheel);
					
					$postCategories = $prizeWheelInstallerInputFilter->getValue('categories');
					
					$categories = explode('|', $postCategories);
					
					foreach($categories as $category){
						$prizeWheelCategoryEntry = new PrizeWheelCategoryEntry();
						$prizeWheelCategoryEntry->advertisementCategoryId((int)$category);
						$prizeWheelCategoryEntry->prizeWheelId((int)$prizeWheel->id());
						
						try{
							$this->prizeWheelCategoryEntryTable->save($prizeWheelCategoryEntry);
						} // try
						catch(\Exception $e){
							error_log("Prize Wheel Exception: " . $e->getMessage());
						} // catch
					} // foreach
					
					return new JsonModel(array(
						"status" => "success",
						"messages" => array(
							"success" => array(
								"Prize Wheel successfully created" 
							)
						),
						"id" => $prizeWheel->id()							
					));
				} // try
				catch(\Exception $e){
					error_log("Prize Wheel Exception: " . $e->getMessage() . " Stack Trace: " .$e->getTraceAsString() . " Previous:" . $e->getPrevious()->getMessage());
					return new JsonModel(array(
						"status" => "error",
						"messages" => array(
							"error" => array(
								"There was an error while attempting to create a Prize Wheel."
							)
						)	
					)); 
				} // catch
			} // if
		} // if
		
		return $this->getResponse();	
	} // installerAction
	
	public function createAction()
	{
		$filter = new PrizeWheelInputFilter();
		$request = $this->getRequest();
		
		$prizeWheel = new PrizeWheel();
		
		if($request->isPost()){
			
			$filter->setData($request->getPost());
			
			if($filter->isValid()){
				$prizeWheel->exchangeArray($filter->getValues());
			} // if
			else{
				$prizeWheel->exchangeArray($filter->getRawValues());
			} // else
		} // if
		
		return new ViewModel(array(
			'prizewheel' => $prizeWheel	
		));
	} // createAction
	
	public function manageAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			 return $this->redirect()->toRoute('affiliate');
		} // if
		
		$id = (int)$this->params()->fromRoute('id', 0);
		
		if($id < 0){
			return $this->redirect()->toRoute('prize-wheel', array('action' => 'create'));
		} // if
		
		$prizeWheel = $this->prizeWheelTable->getPrizeWheel($id);
		
		if(!$prizeWheel){
			return $this->redirect()->toRoute('prize-wheel', array('action' => 'create'));
		} // if
		
		$facebookPage = "";
		
		try{
			$result = $this->getApiResult("/" . $prizeWheel->pageId());
		
			if(isset($result['name'])){
				$facebookPage = $result['name'];
			} // if
		} // try
		catch(\Exception $e){
			error_log("Prize Wheel Exception: " . $e->getMessage());
		} // catch
		
		$viewModel = new ViewModel();
		$viewModel->setVariables(array(
			'prizewheel' => $prizeWheel,
			'facebookpage' => $facebookPage
		));		 
		
		$request = $this->getRequest();

		$prizeWheelCategories = $this->prizeWheelCategoryEntryTable->fetchAllByPrizeWheelId($prizeWheel->id());
		
		$categories = array();
		foreach($prizeWheelCategories as $category){
			$categories[] = $category->advertisementCategoryId();
		} // foreach
		
		$prizeWheel->categories($categories);
		
		if($prizeWheel->prizeWheelTypeId() == \Application\Model\PrizeWheelType::AdDriven){		

			$form = new \Application\Form\ManageAdDrivenPrizeWheelForm("", $this->advertisementCategoryTable->fetchAll());
			
			if($request->isPost()){
				
				$form->setData($request->getPost());
				
				if($form->isValid()){
					
					$this->prizeWheelCategoryEntryTable->deleteAllByPrizeWheelId($prizeWheel->id());
					
					$categories = $form->getInputFilter()->getValue("categories");
					
					foreach($categories as $category){
						
						$prizeWheelCategoryEntry = new PrizeWheelCategoryEntry();
						$prizeWheelCategoryEntry->advertisementCategoryId($category);
						$prizeWheelCategoryEntry->prizeWheelId($prizeWheel->id());
						
						try{
							$this->prizeWheelCategoryEntryTable->save($prizeWheelCategoryEntry);
						} // try
						catch(\Exception $e){
							error_log("Prize Wheel Exception: " .$e->getMessage());
						} // catch
					} // foreach
					
					return $this->redirect()->toRoute('affiliate');
				} // if
			} // if
			else{				
				$form->setData(array("categories" => $prizeWheel->categories()));
				
				$viewModel->setVariable('form', $form);
				
				$viewModel->setTemplate('application/prize-wheel/manage-ad-driven.phtml');
			} // else		
		} // if
		else if($prizeWheel->prizeWheelTypeId() == \Application\Model\PrizeWheelType::Personalized){
			
			$form = new \Application\Form\ManagePersonalizedPrizeWheelForm("", $this->advertisementCategoryTable->fetchAll());		
			$form->bind($prizeWheel);
			
			if($request->isPost()){
				
				$form->setData($request->getPost());
				
				if($form->isValid()){
					
				} // if
			} // if
			
			$viewModel->setVariable('form', $form);
			$viewModel->setVariable("prizenumberstrings", $this->getPrizeNameNumericalStrings());
			
			$viewModel->setTemplate('application/prize-wheel/manage.phtml');
		} // else
		else{
			return $this->redirect()->toRoute('affiliate');
		} // else
		
		return $viewModel;
		
		/*
		$validationErrors = array();
		
		$filter = new PrizeWheelInputFilter();
		$request = $this->getRequest();
		if($request->isPost()){
			
			$filter->setData($request->getPost());
			
			if($filter->isValid()){
				$prizeWheel->exchangeArray($filter->getValues());
			} // if
			else{
				$prizeWheel->exchangeArray($filter->getRawValues());
				foreach($filter->getInvalidInput() as $error){
					//$error->getMessages();
				} // foreach
			} // else
		} // if
		
		return new ViewModel(array(
			'validationerrors' => $validationErrors,
			'prizewheel' => $prizeWheel		
		));
		*/
	} // manageAction
	
	public function disableAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return $this->redirect()->toRoute('affiliate');
		} // if
		
		$affiliate = $this->affiliateTable->getAffiliateByFacebookId($this->getFacebookUserId());
		
		if(!$affiliate){
			return $this->redirect()->toRoute("affiliate");
		} // if
		
		$id = (int)$this->params()->fromRoute("id", 0);
		
		$prizeWheel = $this->prizeWheelTable->getPrizeWheel($id);
	
		if($prizeWheel->affiliateId() != $affiliate->id()){
			return $this->redirect()->toRoute('affiliate');
		} // if
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			if($request->getPost('del') == "yes"){
			
				$this->prizeWheelTable->disable($id);
			
				return $this->redirect()->toRoute('affiliate');
			} // if
			else{
				return $this->redirect()->toRoute('affiliate');
			} // else
		} // if
		
		return new ViewModel(array(
			'prizewheel' => $prizeWheel	
		));
	} // disableAction
	
	private function getPrizeNameNumericalStrings()
	{
		return array(
			"one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve"
		);
	}
}