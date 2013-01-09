<?php

namespace Application\Controller;

use Application\Model\AdvertiserDataSourceInterface;
use Application\Model\AdvertisementDataSourceInterface;
use Application\Model\AdvertisementType;
use Application\Model\TransactionTable;
use Application\Model\AdvertisementPlacementTypeTable;
use Application\Form\ManageAdvertisementForm;
use Application\Form\NewAdvertisementForm;
use Application\Model\Advertisement;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Model\AdvertisementClickTable;
use Application\Model\AdvertisementTypeTable;
use Application\Model\AdvertisementClick;
use Application\Model\AdvertisementCategoryTable;
use Application\Model\AdvertisementCategoryEntry;
use Application\Model\AdvertisementCategoryEntryTable;
use Application\Model\SimpleImage;

class AdvertisementController extends FacebookAwareController
{
	protected $advertisementTable = null;
	protected $advertiserTable = null;
	protected $advertisementClickTable = null;
	protected $advertisementTypeTable = null;
	protected $advertisementCategoryTable = null;
	protected $advertisementCategoryEntryTable = null;
	protected $advertisementPlacementTypeTable = null;
	protected $advertisementService = null;
	
	public function __construct(AdvertisementDataSourceInterface $advertisementTable, AdvertiserDataSourceInterface $advertiserTable, 
			AdvertisementClickTable $advertisementClickTable, AdvertisementTypeTable $advertisementTypeTable, 
			AdvertisementCategoryTable $advertisementCategoryTable, 
			AdvertisementCategoryEntryTable $advertisementCategoryEntryTable, 
			AdvertisementPlacementTypeTable $advertisementPlacementTypeTable, TransactionTable $transactionTable,
			\Facebook $facebook)
	{
		parent::__construct();
		$this->advertisementTable = $advertisementTable;
		$this->advertiserTable = $advertiserTable;
		$this->advertisementClickTable = $advertisementClickTable;
		$this->advertisementTypeTable = $advertisementTypeTable;
		$this->advertisementCategoryTable = $advertisementCategoryTable;
		$this->advertisementCategoryEntryTable = $advertisementCategoryEntryTable;
		$this->advertisementPlacementTypeTable = $advertisementPlacementTypeTable;
		$this->transactionTable = $transactionTable;	
		$this->facebook = $facebook;
		$this->advertisementService = new \Zend\Authentication\AuthenticationService();
	}
	
	public function clickAction()
	{
		$id = $this->params()->fromRoute('id', 0);
		$prizewheelid = $this->params()->fromRoute('prizewheelid', 0);
		$bannerClick = $this->params()->fromQuery('bannerclick', false);
		
		if(!$this->isLoggedIntoFacebook()){
			return $this->response->setContent(
					'<script type="text/javascript">window.location = \''. 	
					$this->fetchLoginUrl("/advertisement/click/".$id) . '\';</script>');
		} // if
		
		// Check token here.
		
		// unset token here.
		
		$advertisement = $this->advertisementTable->getAdvertisement($id);
		
		if($advertisement->typeId() == AdvertisementType::Click){
			$clickFee = 0.00;
			
			foreach($this->advertisementCategoryEntryTable->fetchAllByAdvertisementId($advertisement->id()) as $categoryEntry){
				
				$category = $this->advertisementCategoryTable->getAdvertisementCategory($categoryEntry->advertisementCategoryId());
				
				if($category){
					$clickFee += (float)$category->clickRate();
				} // if
			} // foreach
			
			$advertisement->removeBucketCredits($clickFee);
			$this->advertisementTable->updateBucket($advertisement->id(), $advertisement->bucket());
		} // if
		
		if(!$advertisement){
			return $this->redirect()->toUrl("/");
		} // if
		
		$advertisementClick = new AdvertisementClick();
		
		$advertisementClick->advertisementId($advertisement->id());
		$advertisementClick->facebookUserId($this->getFacebookUserId());
		$advertisementClick->prizeWheelId($prizewheelid);
		
		try{
			$this->advertisementClickTable->save($advertisementClick);
		} // try
		catch(\Exception $e){
			error_log("Prize Wheel Exception: " . $e->getMessage());
		} // catch
		
		$url = $this->url()->fromRoute('prize-wheel', array('action' => 'prize-redirect', 'id' => $prizewheelid));
		$url .= '?redirect=' . $advertisement->url() . '&ad=true';		
		
		if(!$bannerClick){
			return $this->redirect()->toUrl($url);
		} // if
		else{
			// Redirect the caller to the advertisement url.
			return $this->redirect()->toUrl($advertisement->url());
		} // else
	}
	
	public function createAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return $this->redirect()->toUrl($this->fetchLoginUrl("/advertisement/create"));
		} // if
		
		$advertiser = $this->advertiserTable->getAdvertiserByFacebookUserId($this->getFacebookUserId());
		
		if(!$advertiser){
			return $this->redirect()->toRoute("advertiser", array("action" => "register"));
		} // if
		
		$form = new NewAdvertisementForm("", 
			$this->advertisementTypeTable->fetchAll(), 
			$this->advertisementCategoryTable->fetchAllEnabled(),
			$this->advertisementPlacementTypeTable->fetchAll()
		);	
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			$advertisement = new Advertisement();
			
			$nonFile = $request->getPost()->toArray();
			$file = $this->params()->fromFiles('bannerimage');			
			$sponserFile = $this->params()->fromFiles('sponserimage');
				
			$fileInfo = array(
					'bannerimage' => ($file['error'] > 0 ?  "" : $file['name']),
					'sponserimage' => ($sponserFile['error'] > 0 ?  "" : $sponserFile['name'])
				);

			$data = array_merge(
					$nonFile,
					$fileInfo
				);
			
			$form->setData($data);
			
			if($form->isValid()){
		
				$advertisement->exchangeArray($form->getData());
				$advertisement->enabled(true);
				$advertisement->advertiserId($advertiser->id());
				
				try{
					$this->advertisementTable->save($advertisement);										
					
					$uploadAdapter = new \Zend\File\Transfer\Adapter\Http();
					
					if(!$uploadAdapter->isValid()){
						$dataError = $uploadAdapter->getMessages();
						$error = array();
						foreach($dataError as $key => $row){
							$error[] = $row;
						} // foreach
						$messages = $error;
					} // if
					else{		

						$uploadDir = dirname(__DIR__).'/../../../../public/images/advertisements/' . $advertisement->id();
				
						if(!file_exists($uploadDir)){
							mkdir($uploadDir);
						} // if
						$uploadAdapter->setDestination($uploadDir);
						if(!$uploadAdapter->receive(array($file['name'], $sponserFile['name']))){
							
							// @todo I need to think this over. I am not sure
							// I want to delete the advertisement if the file doesn't
							// upload on the initial creation.
							$this->advertisementTable->delete($advertisement->id());
							$messages[] = "Could not upload files";
						} // if
						else{
							
							$simpleImage = new SimpleImage();
							$simpleImage->load($uploadDir.'/'.$sponserFile['name']);
							$simpleImage->resize(144, 453);
							$simpleImage->save($uploadDir.'/'.$sponserFile['name']);
							
							foreach($form->getData()['categories'] as $categoryid){
								
								$entry = new AdvertisementCategoryEntry();
								
								$entry->advertisementCategoryId($categoryid);
								$entry->advertisementId($advertisement->id());
								
								try{
									$this->advertisementCategoryEntryTable->save($entry);
								} // try
								catch(\Exception $e){
									error_log("Prize Wheel Exception: " . $e->getMessage());
								} // catch
							} // foreach
							
							// We have successfully created an Advertisement.
							return $this->redirect()->toRoute('advertisement', array('action' => 'manage', 'id' => $advertisement->id()));
						} // else
					} // else				
				} // try
				catch(\Exception $e){
					error_log("Prize Wheel Exception: ".$e->getMessage());
				}  // catch
			} // if
		} // if
		
		return new ViewModel(array(
			'createform' => $form	
		));
	}
	
	public function manageAction()
	{
		$advertiser = null;
		$advertisement = null;
		$form = null;
		$layout = "layout/layout";
		
		if($this->authenticationService->hasIdentity()){
			
			$id = (int)$this->params()->fromRoute('id', 0);
	
			$advertisement = $this->advertisementTable->getAdvertisement($id);
			
			if(!$advertisement){
				return $this->redirect()->toRoute('advertisement', array('action' => 'list'));
			} // if
			
			$affiliate = $this->advertiserTable->getAdvertiser($advertisement->advertiserId());	

			$layout = "layout/admin_layout";
		} // if
		else{
			
			if(!$this->isLoggedIntoFacebook()){
				return $this->redirect()->toUrl($this->fetchLoginUrl("/advertisement/create"));
			} // if
			
			$advertiser = $this->advertiserTable->getAdvertiserByFacebookUserId($this->getFacebookUserId());
			
			if(!$advertiser){
				return $this->redirect()->toRoute("advertiser", array("action" => "register"));
			} // if
			
			$id = (int)$this->params()->fromRoute('id', 0);
			
			$advertisement = $this->advertisementTable->getAdvertisement($id);
			
			if(!$advertisement || ($advertisement->advertiserId() != $advertiser->id())){
				return $this->redirect()->toRoute('advertisement', array("action" => "create"));
			} // if
		} // else	
			
		$form = new ManageAdvertisementForm(
			"",
			$this->advertisementCategoryTable->fetchAllEnabled()
		);
		
		$messages = array();
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$nonFile = $request->getPost()->toArray();
	
			$file = $this->params()->fromFiles('bannerimage');
			$sponserFile = $this->params()->fromFiles('sponserimage');
				
			$fileInfo = array(
					'bannerimage' => ($file['error'] > 0 ?  "" : $file['name']),
					'sponserimage' => ($sponserFile['error'] > 0 ?  "" : $sponserFile['name'])
				);
	
			$data = array_merge($nonFile, $fileInfo);

			$form->setData($data);
			
			if($form->isValid()){

				$bannerImage = $advertisement->bannerImage();
				$sponserImage = $advertisement->sponserImage();
				$enabled = $advertisement->enabled();
				$typeId = $advertisement->typeId();
				$advertisementPlacementTypeId = $advertisement->advertisementPlacementTypeId();
				
				$advertisement->exchangeArray($form->getData());			
			
				$advertisement->bannerImage(!empty($data['bannerimage']) ? $data['bannerimage'] : $bannerImage);
				$advertisement->sponserImage(!empty($data['sponserimage']) ? $data['sponserimage'] : $sponserImage);
		
				try{
					$this->advertisementTable->save($advertisement);
					
					if(!empty($data['bannerimage']) || !empty($data['sponserimage'])){
						$adapter = new \Zend\File\Transfer\Adapter\Http();
						
						$uploadDir = dirname(__DIR__).'/../../../../public/images/advertisements/' . $advertisement->id();
							
						if(!file_exists($uploadDir)){
							mkdir($uploadDir);
						} // if
						$adapter->setDestination($uploadDir);

						$uploadFiles = array();
						
						if(!empty($file['name'])){
							$uploadFiles[] = $file['name'];
						} // if
						if(!empty($sponserFile['name'])){
							$uploadFiles[] = $sponserFile['name'];
						} // if
							
						if(count($uploadFiles) > 0){
							if(!$adapter->receive($uploadFiles)){
								$messages[] = "Error uploading files.";
							} // if
							else{
							
								if(!empty($sponserFile['name'])){
									$simpleImage = new SimpleImage();
									$simpleImage->load($uploadDir.'/'.$sponserFile['name']);
									$simpleImage->resize(144, 453);
									$simpleImage->save($uploadDir.'/'.$sponserFile['name']);
								} // if
							} // else
						} // if
					
						$this->advertisementCategoryEntryTable->deleteByAdvertisementId($advertisement->id());
							
						foreach($form->getData()['categories'] as $categoryid){
								
							$entry = new AdvertisementCategoryEntry();
							
							$entry->advertisementCategoryId($categoryid);
							$entry->advertisementId($advertisement->id());
						
							try{
								$this->advertisementCategoryEntryTable->save($entry);
							} // try
							catch(\Exception $e){
								error_log("Prize Wheel Exception: " . $e->getMessage());
							} // catch
						} // foreach
							
						if($this->authenticationService->hasIdentity()){
							return $this->redirect()->toRoute('advertisement', array('action' => 'list'));
						} // if
						else{
							return $this->redirect()->toRoute('advertisement', array('action' => 'manage', 'id' => $advertisement->id()));
						} // else
					} // if
					else {
						$this->advertisementCategoryEntryTable->deleteByAdvertisementId($advertisement->id());
						
						$formData = $form->getData();
						
						if(isset($formData['categories'])){
							foreach($formData['categories'] as $categoryid){
							
								$entry = new AdvertisementCategoryEntry();
							
								$entry->advertisementCategoryId($categoryid);
								$entry->advertisementId($advertisement->id());
							
								try{
									$this->advertisementCategoryEntryTable->save($entry);
								} // try
								catch(\Exception $e){
									error_log("Prize Wheel Exception: " . $e->getMessage());
								} // catch
							} // foreach
						} // if
						
						if($this->authenticationService->hasIdentity()){
							return $this->redirect()->toRoute('advertisement', array('action' => 'list'));
						} // if
						else{
							return $this->redirect()->toRoute('advertisement', array('action' => 'manage', 'id' => $advertisement->id()));
						} // else
					} // else
				} // try
				catch(\Exception $e){					
					error_log("Prize Wheel Exception: " . $e->getMessage());
				} // catch
			} // if
		} // if
		else{
			
			$categoryEntries = $this->advertisementCategoryEntryTable->fetchAllByAdvertisementId($advertisement->id());
			
			$categoryData = array();
			foreach($categoryEntries as $entry){
				$categoryData[] = $entry->advertisementCategoryId();
			} // foreach
			
			$data = array_merge($advertisement->getArrayCopy(), array("categories" => $categoryData));
			
			$form->setData($data);
		} // else
		
		return new ViewModel(array(
			'manageform' => $form,
			'id' => $advertisement->id(),
			'bannerimage' => $this->getServiceLocator()->get('Config')['appconfig']['baseurl'].
				'/images/advertisements/'.$advertisement->id().'/'.$advertisement->bannerImage(),
			'sponserimage' => $this->getServiceLocator()->get('Config')['appconfig']['baseurl'].
				'/images/advertisements/'.$advertisement->id().'/'.$advertisement->sponserImage(),
			'bucket' => $advertisement->bucket(),
			'isadmin' => ($this->authenticationService->hasIdentity() && $this->authenticationService->getIdentity() == "admin"),
			'layoutpath' => $layout,
			'paypalbutton' => $this->getConfigValue('paypal button code')->value(),
			'baseurl' => $this->getServiceLocator()->get('Config')['appconfig']['baseurl']
		)); 
	}
	
	public function disableAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return $this->redirect()->toUrl($this->fetchLoginUrl("/advertisement/create"));
		} // if
		
		$advertiser = $this->advertiserTable->getAdvertiserByFacebookUserId($this->getFacebookUserId());
		
		$id = (int)$this->params()->fromRoute('id', 0);
		
		$advertisement = $this->advertisementTable->getAdvertisement($id);
		
		if(!$advertisement || ($advertisement->advertiserId() != $advertiser->id())){
			return $this->redirect()->toRoute('advertiser');
		} // if
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$del = $request->getPost('del', 'no');
			
			if($del == "yes"){
				$this->advertisementTable->disable($id);
			} // if
			
			return $this->redirect()->toRoute('advertiser');
		} // if
		
		return new ViewModel(array(
			'advertisement' => $advertisement	
		));
	}
	
	public function deleteAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return $this->redirect()->toUrl($this->fetchLoginUrl("/advertisement/create"));
		} // if
	
		$advertiser = $this->advertiserTable->getAdvertiserByFacebookUserId($this->getFacebookUserId());
	
		$id = (int)$this->params()->fromRoute('id', 0);
	
		$advertisement = $this->advertisementTable->getAdvertisement($id);
	
		if(!$advertisement || ($advertisement->advertiserId() != $advertiser->id())){
			return $this->redirect()->toRoute('advertiser');
		} // if
	
		$request = $this->getRequest();
	
		if($request->isPost()){
				
			$del = $request->getPost('del', 'no');
				
			if($del == "yes"){
				$this->advertisementTable->delete($id);
			} // if
				
			return $this->redirect()->toRoute('advertiser');
		} // if
	
		return new ViewModel(array(
			'advertisement' => $advertisement
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
				
			$advertisements = $this->advertisementTable->fetchAll(1, 25, $count);
				
			$list = array();
				
			foreach($advertisements as $advertisement){
				$list[] = $advertisement->toArrayCopy();
			} // foreach
				
			return new JsonModel(array(
				'status' => 'success',
				'count' => $count,
				'advertisements' => $list
			));
		} // if
		
		$count = 0;
		
		$advertisements = $this->advertisementTable->fetchAll(1, 25, $count);
		
		return new ViewModel(array(
			'advertisements' => $advertisements,
			'count' => $count
		));
	} // listAction
	
	public function successAction()
	{
		$transactionId = $this->params()->fromQuery('tx', '');
		$status = $this->params()->fromQuery('st', 'error');
		$amount = $this->params()->fromQuery('amt', 0.00);
		$itemNumber = $this->params()->fromQuery('item_number', '');
		$advertisementId = $this->params()->fromRoute('id', 0);
		
		$advertisement = $this->advertisementTable->getAdvertisement($advertisementId);
		
		$advertiser = $this->advertiserTable->getAdvertiser($advertisement->advertiserId());
				
		return new ViewModel(array(
			'status' => 'success',
			'messages' => array(),
			'advertisement' => $advertisement,
			'advertiser' => $advertiser,
			'transactionid' => $transactionId,
			'amount' => $amount,
 			'processor' => 'paypal'
		));
	} // successAction
	
	public function cancelAction()
	{
		foreach($this->params()->fromPost() as $key => $value){
			echo $key . ' => ' . $value . '<br/>';
		} // foreach
		
		return $this->response;
	} // failedAction
}