<?php

namespace Application\Controller;

use Application\Model\AdvertisementPlacementTypeTable;
use Application\Form\ManageAdvertisementForm;
use Application\Form\NewAdvertisementForm;
use Application\Model\Advertisement;
use Zend\View\Model\ViewModel;
use Application\Model\AdvertisementTable;
use Application\Model\AdvertisementClickTable;
use Application\Model\AdvertisementTypeTable;
use Application\Model\AdvertiserTable;
use Application\Model\AdvertisementClick;
use Application\Model\AdvertisementCategoryTable;
use Application\Model\AdvertisementCategoryEntry;
use Application\Model\AdvertisementCategoryEntryTable;

class AdvertisementController extends FacebookAwareController
{
	protected $advertisementTable = null;
	protected $advertiserTable = null;
	protected $advertisementClickTable = null;
	protected $advertisementTypeTable = null;
	protected $advertisementCategoryTable = null;
	protected $advertisementCategoryEntryTable = null;
	protected $advertisementPlacementTypeTable = null;
	
	public function __construct(AdvertisementTable $advertisementTable, AdvertiserTable $advertiserTable, 
			AdvertisementClickTable $advertisementClickTable, AdvertisementTypeTable $advertisementTypeTable, 
			AdvertisementCategoryTable $advertisementCategoryTable, 
			AdvertisementCategoryEntryTable $advertisementCategoryEntryTable, 
			AdvertisementPlacementTypeTable $advertisementPlacementTypeTable, \Facebook $facebook)
	{
		$this->advertisementTable = $advertisementTable;
		$this->advertiserTable = $advertiserTable;
		$this->advertisementClickTable = $advertisementClickTable;
		$this->advertisementTypeTable = $advertisementTypeTable;
		$this->advertisementCategoryTable = $advertisementCategoryTable;
		$this->advertisementCategoryEntryTable = $advertisementCategoryEntryTable;
		$this->advertisementPlacementTypeTable = $advertisementPlacementTypeTable;
		$this->facebook = $facebook;
	}
	
	public function clickAction()
	{
		$id = $this->params()->fromRoute('id', 0);
		$prizewheelid = $this->params()->fromRoute('prizewheelid', 0);
		
		if(!$this->isLoggedIntoFacebook()){
			return $this->response->setContent(
					'<script type="text/javascript">window.location = \''. 	
					$this->fetchLoginUrl("/advertisement/click/".$id) . '\';</script>');
		} // if
		
		// Check token here.
		
		// unset token here.
		
		$advertisement = $this->advertisementTable->getAdvertisement($id);
		
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
		
		// Redirect the caller to the advertisement url.
		return $this->redirect()->toUrl($advertisement->url());
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
			$this->advertisementCategoryTable->fetchAll(),
			$this->advertisementPlacementTypeTable->fetchAll()
		);	
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			$advertisement = new Advertisement();
			
			$nonFile = $request->getPost()->toArray();
			$file = $this->params()->fromFiles('bannerimage');			
			$data = array_merge(
				$nonFile,
				array('bannerimage' => $file['name'])	
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
						$form->setMessages(array('bannerimage' => $error));
					} // if
					else{		

						$uploadDir = dirname(__DIR__).'/../../../../public/images/advertisements/' . $advertisement->id();
				
						if(!file_exists($uploadDir)){
							mkdir($uploadDir);
						} // if
						$uploadAdapter->setDestination($uploadDir);
						if(!$uploadAdapter->receive($file['name'])){
							$this->advertisementTable->delete($advertisement->id());
							$form->setMessages(array("bannerimage" => array(
								"Could not upload file " . $file['name']
							)));
						} // if
						else{
							
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
		
		$form = new ManageAdvertisementForm(
			"", 
			$this->advertisementCategoryTable->fetchAll()
		);
		
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$nonFile = $request->getPost()->toArray();
	
			$file = $this->params()->fromFiles('bannerimage');
				
			$fileInfo = array('bannerimage' => ($file['error'] > 0 ?  "" : $file['name']));
	
			$data = array_merge($nonFile, $fileInfo);

			$form->setData($data);
			
			if($form->isValid()){

				$bannerImage = $advertisement->bannerImage();
				$enabled = $advertisement->enabled();
				$typeId = $advertisement->typeId();
				$advertisementPlacementTypeId = $advertisement->advertisementPlacementTypeId();
				
				$advertisement->exchangeArray($form->getData());
				$advertisement->id($id);
				$advertisement->advertiserId($advertiser->id());
				$advertisement->typeId($typeId);
				$advertisement->enabled($enabled);
				$advertisement->advertisementPlacementTypeId($advertisementPlacementTypeId);
			
				$advertisement->bannerImage(!empty($data['bannerimage']) ? $data['bannerimage'] : $bannerImage);
		
				try{
					$this->advertisementTable->save($advertisement);
					
					if(!empty($data['bannerimage'])){
						$adapter = new \Zend\File\Transfer\Adapter\Http();
						
						if(!$adapter->isValid()){
							 $dataError = $adapter->getMessages();
							 $error = array();
							 foreach($dataError as $key => $row){
							 	$error[] = $row;
							 } // foreach
							 $form->setMessages(array('bannerimage' => $error));
						} // if
						else{
							
							$uploadDir = dirname(__DIR__).'/../../../../public/images/advertisements/' . $advertisement->id();
							
							if(!file_exists($uploadDir)){
								mkdir($uploadDir);
							} // if
							$adapter->setDestination($uploadDir);
							if(!$adapter->receive($file['name'])){
								$this->advertisementTable->delete($advertisement->id());
								$form->setMessages(array("bannerimage" => array(
									"Could not upload file " . $file['name']
								)));
							} // if
							else{								
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
								
								return $this->redirect()->toRoute('advertisement', array('action' => 'manage', 'id' => $advertisement->id()));
							} // else
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
						
						return $this->redirect()->toRoute('advertisement', array('action' => 'manage', 'id' => $advertisement->id()));
					} // else
				} // try
				catch(\Exception $e){
					throw $e;
					//error_log("Prize Wheel Exception: " . $e->getMessage());
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
			'bucket' => $advertisement->bucket()
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
}