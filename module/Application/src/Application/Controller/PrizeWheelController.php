<?php

namespace Application\Controller;

use Application\Model\AdvertisementDataSourceInterface;

use Application\Model\PrizeWheelDataSourceInterface;
use Application\Model\AdvertisementCategoryEntryTable;
use Application\Model\AdvertisementType;
use Application\Model\PrizeWheelCategoryEntry;
use Application\Model\AdvertisementImpression;
use Application\Model\PrizeWheelCategoryEntryTable;
use Application\Model\PrizeWheelEntry;
use Application\Model\AdvertisementPlacementType;
use Zend\View\Model\ViewModel;
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
use Application\Model\SimpleImage;

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
	protected $authenticationService = null;
	protected $advertisementCategoryEntryTable = null;
	
	public function __construct(PrizeWheelDataSourceInterface $prizeWheelTable, 
			PrizeWheelEntryTable $prizeWheelEntryTable, 
			AdvertisementImpressionTable $advertisementImpressionTable, 
			AffiliateTable $affiliateTable,
			AdvertisementDataSourceInterface $advertisementTable,
			PrizeWheelEntryCategoryEntryTable $prizeWheelEntryCategoryEntryTable,
			PrizeWheelCategoryEntryTable $prizeWheelCategoryEntryTable,
			PrizeWheelImpressionTable $prizeWheelImpressionTable,
			AdvertisementCategoryTable $advertisementCategoryTable,
			AdvertisementCategoryEntryTable $advertisementCategoryEntryTable,
			\Facebook $facebook)
	{
		parent::__construct();
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
		$this->authenticationService = new \Zend\Authentication\AuthenticationService();
		$this->advertisementCategoryEntryTable = $advertisementCategoryEntryTable;
	} // ctor
	
	/**
	 * The default action - show the home page
	 */
	public function indexAction() 
	{
		$facebookRequest = $this->getSignedRequest();
		
		$pageid = $facebookRequest['page']['id'];
		
		//$pageid = "158447550966525";

		$prizeWheel = $this->prizeWheelTable->getPrizeWheelByPageId($pageid);	
		
		$pageInformation = array(
			'name' => 'unknown'	
		);
		
		$pageInformation = $this->getApiResult("/" . $pageid);
		if(!$pageInformation){
			$pageInformation = array(
				"name" => ""	
			);
		} // if
		
		// If we are forcing the like and the page has not been liked.
		if($prizeWheel->forceLike() && $facebookRequest['page']['liked'] != 1){
			$viewModel = new ViewModel(array(
				"prizewheel" => $prizeWheel,
				"facebookappid" => $this->getFacebookAppId(),
				"facebookpagename" => $pageInformation['name']
			));
			$viewModel->setTemplate('prize-wheel/non-fan');
			$viewModel->setTerminal(true);
				
			return $viewModel;
		} // if
		
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
	
	public function previewAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return $this->redirect()->toRoute('affiliate');
		} // if
		
		$affiliate = $this->affiliateTable->getAffiliateByFacebookId($this->getFacebookUserId());
		
		if(!$affiliate){
			return $this->redirect()->toRoute('affiliate');
		} // if
		
		$id = $this->params()->fromRoute("id", 0);
		
		$prizeWheel = $this->prizeWheelTable->getPrizeWheel($id);
		
		if($prizeWheel->affiliateId() != $affiliate->id()){
			return $this->redirect()->toRoute('affiliate');
		} // if
		
		$pageInformation = array(
			'name' => 'unknown'
		);
		
		$pageInformation = "";
		if(!$pageInformation){
			$pageInformation = array(
					"name" => ""
			);
		} // if	
		
		$viewModel = new ViewModel(
			array(
				"prizewheel" => $prizeWheel,
				"facebookappid" => $this->getFacebookAppId(),
				"facebookpagename" => $pageInformation['name']
			)
		);
		$viewModel->setTemplate('prize-wheel/index');
		$viewModel->setTerminal(true);
		
		return $viewModel;
	}
	
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
						if($advertisement->typeId() == AdvertisementType::Impression){
						
							$impressionRate = 0.00;
								
							foreach($this->advertisementCategoryEntryTable->fetchAllByAdvertisementId($advertisement->id()) as $categoryEntry){
						
								$category = $this->advertisementCategoryTable->getAdvertisementCategory($categoryEntry->advertisementCategoryId());
						
								if($category->enabled()){
									$impressionRate += (float)$category->impressionRate();
								} // if
							} // foreach
								
							$advertisement->removeBucketCredits($impressionRate);
							$this->advertisementTable->updateBucket($advertisement->id(), $advertisement->bucket());
						} // if
						
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
	
	public function prizeRedirectAction()
	{
		$id = (int)$this->params()->fromRoute('id', 0);
		$redirect = $this->params()->fromQuery('redirect', '');
		$isAd = $this->params()->fromQuery('ad', false);
			
		$prizeWheel = $this->prizeWheelTable->getPrizeWheel($id);
		
		$prizeWheelCategories = array();
		
		foreach($this->prizeWheelCategoryEntryTable->fetchAllByPrizeWheelId($prizeWheel->id()) as $category){
			$prizeWheelCategories[] = $category->advertisementCategoryId();
		} // foreach
		
		$prizeWheelEntry = $this->prizeWheelEntryTable->getLastPrizeWheelEntryByFacebookUserId($prizeWheel->id(), $this->getFacebookUserId());
		
		$advertisement = $this->advertisementTable->getRandomOfPlacementType(
			AdvertisementPlacementType::Any, $prizeWheelCategories
		);
		
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
				
		$viewModel = new ViewModel(array(
						'redirecturl' => $redirect,
						'prize' => $isAd ? $this->advertisementTable->getAdvertisement((int)$prizeWheelEntry->prize())->name() : $prizeWheelEntry->prize(),
						'advertisementimage' => '/images/advertisements/' . $advertisement->id()	. '/' . $advertisement->bannerImage(),
						'advertisementid' => $advertisement->id()
					));
		$viewModel->setTerminal(true);
		
		return $viewModel;
	}
	
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
				
				if($filter->getValue("id") <= 0){
					if($prizeWheel->emailFilter()){
						$results = $this->prizeWheelEntryTable->fetch(array(
							'emailaddress' => array(
								'value' => $filter->getValue('email_txt')
							)		
						), $prizeWheel->id(), 1, 1);
						
						if(count($results) > 0){
							return $this->response->setContent("result=Already");
						} // if
					} // if
					
					if($prizeWheel->ipAddressFilter()){
						
						$results = $this->prizeWheelEntryTable->fetch(array(
							'ipaddress' => array(
								'value' => $request->getServer('REMOTE_ADDR')
							)
						), $prizeWheel->id(), 1, 1);
						
						if(count($results) > 0){
							return $this->response->setContent("result=Already");
						} // if
					} // if
					
					if($prizeWheel->phoneFilter()){
						
						$results = $this->prizeWheelEntryTable->fetch(array(
								'telephone' => array(
									'value' => $filter->getValue('phone_txt')
								)
						), $prizeWheel->id(), 1, 1);
						
						if(count($results) > 0){
							return $this->response->setContent("result=Already");
						} // if
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
					
					if($prizeWheel->sendEmailNotifications()){
						$this->sendEmailNotification($prizeWheelEntry, $prizeWheel);
					} // if
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
		$affiliate = null;
		$layout = 'layout/layout';
		
		if(!$this->authenticationService->hasIdentity()){
			
			if(!$this->isLoggedIntoFacebook()){
				return $this->redirect()->toRoute('affiliate');
			} // if
			
			$affiliate = $this->affiliateTable->getAffiliateByFacebookId($this->getFacebookUserId());
			
			if(!$affiliate){
				return $this->redirect()->toRoute('affiliate');
			} // if
		} // if
		else{
			$layout = "layout/admin_layout";
		} // else
		
		$id = (int)$this->params()->fromRoute('id', 0);
		
		if($id < 0){
			
			if($this->authenticationService->hasIdentity()){
				return $this->redirect()->toRoute('prize-wheel', array('action' => 'list'));
			} // if
			else{
				return $this->redirect()->toRoute('prize-wheel', array('action' => 'create'));
			} // else
		} // if
		
		$prizeWheel = $this->prizeWheelTable->getPrizeWheel($id);
		
		if(!$prizeWheel){
			
			if($this->authenticationService->hasIdentity()){
				return $this->redirect()->toRoute('prize-wheel', array('action' => 'list'));
			} // if
			else{
				return $this->redirect()->toRoute('prize-wheel', array('action' => 'create'));
			} // else
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
		
		$exportedSubmissions = $this->prizeWheelEntryTable->getExportedCountByPrizeWheelId($prizeWheel->id());
		$totalSubmissions = $this->prizeWheelEntryTable->getCountByPrizeWheelId($prizeWheel->id());
		$newSubmissions = $totalSubmissions - $exportedSubmissions;
		
		$viewModel = new ViewModel();
		$viewModel->setVariables(array(
			'prizewheel' => $prizeWheel,
			'facebookpage' => $facebookPage,
			'isadmin' => $this->authenticationService->hasIdentity(),
			'layoutpath' => $layout,
			'newsubmissions' => $newSubmissions,
			'exportedsubmissions' => $exportedSubmissions,
			'totalsubmissions' => $totalSubmissions				
		));		 
		
		$request = $this->getRequest();

		$prizeWheelCategories = $this->prizeWheelCategoryEntryTable->fetchAllByPrizeWheelId($prizeWheel->id());
		
		$categories = array();
		foreach($prizeWheelCategories as $category){
			$categories[] = $category->advertisementCategoryId();
		} // foreach
		
		$prizeWheel->categories($categories);
		
		if($prizeWheel->prizeWheelTypeId() == \Application\Model\PrizeWheelType::AdDriven){		

			$form = new \Application\Form\ManageAdDrivenPrizeWheelForm("", $this->advertisementCategoryTable->fetchAllEnabled(), $this->authenticationService->hasIdentity());
			
			if($request->isPost()){
				
				$form->setData($request->getPost());
				
				if($form->isValid()){
					
					$data = $form->getData();
					
					if(isset($data['enabled'])){
						$prizeWheel->enabled($data['enabled']);
						
						try{
							$this->prizeWheelTable->save($prizeWheel);
						} // try
						catch(\Exception $e){
							error_log('Prize Wheel Exception: ' . $e->getMessage());
						} // catch
					} // if
 					
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
					
					if($this->authenticationService->hasIdentity()){
						return $this->redirect()->toRoute('prize-wheel', array('action' => 'list'));
					} // if
					else{
						return $this->redirect()->toRoute('prize-wheel', array('action' => 'manage', 'id' => $prizeWheel->id()));
					} // else
				} // if
			} // if
			else{				
				$form->setData(array("categories" => $prizeWheel->categories(), "enabled" => $prizeWheel->enabled()));
				
				$viewModel->setVariable('form', $form);
				
				$viewModel->setTemplate('application/prize-wheel/manage-ad-driven.phtml');
			} // else		
		} // if
		else if($prizeWheel->prizeWheelTypeId() == \Application\Model\PrizeWheelType::Personalized){
			
			$form = new \Application\Form\ManagePersonalizedPrizeWheelForm("", $this->advertisementCategoryTable->fetchAllEnabled(), $this->authenticationService->hasIdentity());		
			$form->bind($prizeWheel);
			
			if($request->isPost()){
				
				$form->setData($request->getPost());
				
				if($form->isValid()){
					
					try{
						
						$prizeWheel = $form->getData();
						
						if($this->params()->fromPost('resetbackimage', false)){
							$prizeWheel->backImage("");
						} // if
						
						if($this->params()->fromPost('resettopimage', false)){
							$prizeWheel->topImage("");
						} // if
						
						if($this->params()->fromPost('resetbuttonimage', false)){
							$prizeWheel->buttonImage("");
						} // if
						
						$files = array();
						
						foreach($this->getPrizeNameNumericalStrings() as $numerical){
							$file = $this->params()->fromFiles("prize".$numerical."image");
							$method = "prize".ucfirst($numerical)."Image";
								
							if($file['error'] <= 0){
								$files[] = $file;
								$prizeWheel->$method($file['name']);
							} // if
						} // foreach
						
						$forcelikeimage = $this->params()->fromFiles("forcelikeimage");
						if($forcelikeimage['error'] <= 0){
							$files[] = $forcelikeimage;
							$prizeWheel->forceLikeImage($forcelikeimage['name']);
						} // if
						
						$topImage = $this->params()->fromFiles('topimage');
						if($topImage['error'] <= 0){
							$files[] = $topImage;
							$prizeWheel->topImage($topImage['name']);
						} // if
						
						$backimage = $this->params()->fromFiles("backimage");
						if($backimage['error'] <= 0){
							$files[] = $backimage;
							$prizeWheel->backImage($backimage['name']);
 						} // if
 						
 						$buttonimage = $this->params()->fromFiles("buttonimage");
 						if($buttonimage['error'] <= 0){
 							$files[] = $buttonimage;
 							$prizeWheel->buttonImage($buttonimage['name']);
 						} // if
						
						$this->prizeWheelTable->save($prizeWheel);
						
						$this->prizeWheelCategoryEntryTable->deleteAllByPrizeWheelId($prizeWheel->id());
						
						foreach($prizeWheel->categories() as $category){
							$prizeWheelCategoryEntry = new PrizeWheelCategoryEntry();
							$prizeWheelCategoryEntry->advertisementCategoryId($category);
							$prizeWheelCategoryEntry->prizeWheelId($prizeWheel->id());
							
							$this->prizeWheelCategoryEntryTable->save($prizeWheelCategoryEntry);
						} // foreach
						
						$adapter = new \Zend\File\Transfer\Adapter\Http();
						
						$uploadDir = dirname(__DIR__).'/../../../../public/images/prizewheels/'.$prizeWheel->id();
				
						if(!file_exists($uploadDir)){
							mkdir($uploadDir);
						} // if
						
						$adapter->setDestination($uploadDir);
						
						foreach($files as $file){
							if(!$adapter->receive($file['name'])){
								error_log("Prize Wheel Warning: Could not upload file " . $file["name"] . " to " . $uploadDir);
							} // if						
						} // foreach
						
						if($forcelikeimage['error'] <= 0){							
							$simpleImage = new SimpleImage();
							$simpleImage->load($uploadDir.'/'.$forcelikeimage['name']);
							$width = $simpleImage->getWidth();
							$height = $simpleImage->getHeight();
							
							if($width > 800 && $height > 764){
								$simpleImage->resize(800, 764);
							} // if
							else{
								if($width > 800 && $height <= 764){
									$simpleImage->resizeToWidth(800);	
								} // if
							
								if($height > 764 && $width <= 800){
									$simpleImage->resizeToHeight(764);
								} // if
							} // else
							$simpleImage->save($uploadDir.'/'.$forcelikeimage['name']);
						} // if
						
						if($topImage['error'] <= 0){	
							$simpleImage = new SimpleImage();
							$simpleImage->load($uploadDir.'/'.$topImage['name']);
							$simpleImage->resize(359, 365);
							$simpleImage->save($uploadDir.'/'.$topImage['name']);
						} // if
						
						if($backimage['error'] <= 0){	
							$simpleImage = new SimpleImage();
							$simpleImage->load($uploadDir.'/'.$backimage['name']);
							$simpleImage->resize(795, 497);
							$simpleImage->save($uploadDir.'/'.$backimage['name']);							
 						} // if
 						
 						if($buttonimage['error'] <= 0){ 
 							$simpleImage = new SimpleImage();
 							$simpleImage->load($uploadDir.'/'.$buttonimage['name']);
 							$simpleImage->resize(123, 64);
 							$simpleImage->save($uploadDir.'/'.$buttonimage['name']); 							
 						} // if
						
						if($this->authenticationService->hasIdentity()){
							return $this->redirect()->toRoute('prize-wheel', array('action' => 'list'));
						} // if
						else{
							return $this->redirect()->toRoute('prize-wheel', array('action' => 'manage', 'id' => $prizeWheel->id()));
						} // else
					} // try
					catch(\Exception $e){
						throw $e;
						error_log("Prize Wheel Exception: ". $e->getMessage());
					} // catch
				} // if
			} // if
			
			$viewModel->setVariable('form', $form);
			$viewModel->setVariable("prizenumberstrings", $this->getPrizeNameNumericalStrings());
			
			$viewModel->setTemplate('application/prize-wheel/manage.phtml');
		} // else
		else{
			
			if($this->authenticationService->hasIdentity()){
				return $this->redirect()->toRoute('prize-wheel', array('action' => 'list'));
			} // if
			else{
				return $this->redirect()->toRoute('affiliate');
			} // else
		} // else
		
		return $viewModel;	
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
	
	public function listAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$page = $this->params()->fromPost('page', 1);
			
			$count = 0;
			
			$prizeWheels = $this->prizeWheelTable->fetchAll($page, 25, $count);
			
			$list = array();
			
			foreach($prizeWheels as $prizeWheel){
				$list[] = $prizeWheel->getArrayCopy();
			} // foreach
			
			return new JsonModel(array(
				'status' => 'success',
				'count' => $count,
				'prizewheels' => $list
			));
		} // if
		
		$count = 0;
		
		$prizeWheels = $this->prizeWheelTable->fetchAll(1, 25, $count);
		
		return new ViewModel(array(
			'prizewheels' => $prizeWheels,
			'count' => $count
		));
	}
	
	private function getPrizeNameNumericalStrings()
	{
		return array(
			"one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve"
		);
	}
	
	protected function sendEmailNotification(PrizeWheelEntry $prizeWheelEntry, PrizeWheel $prizeWheel)
	{
		/*$transport = new \Zend\Mail\Transport\File();
		$options = new \Zend\Mail\Transport\FileOptions(array(
					'path' => dirname(__DIR__).'/../../../../data/mail/',
					'callback' => function(\Zend\Mail\Transport\File $transport) use($prizeWheelEntry){
						return 'prizewheelentry='. $prizeWheelEntry->id() . '&messagestamp=' . microtime(true) . '_' . mt_rand() . '.txt';
					}
				));
		$transport->setOptions($options);*/
		
		$transport = new \Zend\Mail\Transport\Smtp();
		$options = new \Zend\Mail\Transport\SmtpOptions();
		$options->setName($prizeWheel->smtpServer());
		$options->setHost($prizeWheel->smtpServer());
		$options->setPort($prizeWheel->smtpPort());
		$options->setConnectionClass($prizeWheel->smtpAuthMethod());		
		if($prizeWheel->smtpEncryption() != "none"){
			$options->setConnectionConfig(array(
						'username' => $prizeWheel->smtpUserName(),
						'password' => $prizeWheel->smtpPassword(),
						'ssl' => $prizeWheel->smtpEncryption()
					));		
		} // if
		else{
			$options->setConnectionConfig(array(
						'username' => $prizeWheel->smtpUserName(),
						'password' => $prizeWheel->smtpPassword()
					));
		} // else
			
		$transport->setOptions($options);
		
		$subject = $prizeWheel->notificationEmailSubject();
		$body = $prizeWheel->notificationEmailBody();
		
		$message = new \Zend\Mail\Message();
		
		$message->addTo($prizeWheelEntry->emailAddress())
				->addFrom($prizeWheel->smtpFromAddress())
				->addBcc($prizeWheel->notificationEmailAddress())
				->setSubject($subject)
				->setBody($body);
		
		try{
			$transport->send($message);
		} // try
		catch(\Exception $e){
			
			error_log('Prize Wheel Exception: Prize Wheel ID ' . $prizeWheel->id(). ' ' . $e->getMessage() . ' ' . $e->getTraceAsString());
		} // catch
	}
}