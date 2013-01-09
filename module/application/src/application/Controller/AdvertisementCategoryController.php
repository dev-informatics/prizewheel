<?php

namespace Application\Controller;

use Application\Model\AdvertisementCategoryTable;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\ConfigurationEntryTable;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Form\AdvertisementCategoryForm;
use Application\Model\AdvertisementCategory;

class AdvertisementCategoryController extends AbstractActionController
{
	protected $authenticationService = null;
	protected $configurationEntryTable = null;
	protected $advertisementCategoryTable = null;
	
	public function __construct(ConfigurationEntryTable $configurationEntryTable, AdvertisementCategoryTable $advertisementCategoryTable)
	{
		$this->authenticationService = new \Zend\Authentication\AuthenticationService();
		$this->configurationEntryTable = $configurationEntryTable;
		$this->advertisementCategoryTable = $advertisementCategoryTable;
	} // ctor
	
	public function listAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		$request = $this->getRequest();
		
		if($request->isPost()){
		
			$page = $this->params()->fromPost('page', 1);
			$count = 0;
		
			$advertisements = $this->advertisementCategoryTable->fetchAll(1, 25, $count);
		
			$list = array();
		
			foreach($advertisements as $advertisement){
				$list = $advertisement->toArrayCopy();
			} // foreach
		
			return new JsonModel(array(
				'status' => 'success',
				'count' => $count,
				'advertisementcategories' => $list
			));
		} // if
		
		$count = 0;
		
		$advertisements = $this->advertisementCategoryTable->fetchAll(1, 25, $count);
		
		return new ViewModel(array(
			'advertisementcategories' => $advertisements,
			'count' => $count
		));
	}
	
	public function createAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		$form = new AdvertisementCategoryForm();
		$request = $this->getRequest();
		
		$messages = array();
		
		if($request->isPost()){
			
			$form->setData($request->getPost());
			
			if($form->isValid()){
				
				$advertisementCategory = new AdvertisementCategory();
				$advertisementCategory->exchangeArray($form->getData());
				
				try{
					$this->advertisementCategoryTable->save($advertisementCategory);
					
					return $this->redirect()->toRoute('advertisement-category');
				} // try
				catch(\Exception $e){
					error_log('Prize Wheel Exception: ' . $e->getMessage());
					
					$messages[] = $e->getMessage();
				} // catch
			} // if
		} // if
		
		return new ViewModel(array(
			'form' => $form,
			'messages' => $messages	
		));
	}
	
	public function manageAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		$id = $this->params()->fromRoute('id', 0);
		
		$advertisementCategory = $this->advertisementCategoryTable->getAdvertisementCategory($id);
		
		if(!$advertisementCategory){
			return $this->redirect()->toRoute('advertisement-category');
		} // if
		
		$messages = array();
		
		$form = new AdvertisementCategoryForm();
		$request = $this->getRequest();
		
		$form->bind($advertisementCategory);
		
		if($request->isPost()){
			
			$form->setData($request->getPost());
			
			if($form->isValid()){
				
				try{
					$this->advertisementCategoryTable->save($form->getData());
					
					return $this->redirect()->toRoute('advertisement-category');
				} // try
				catch(\Exception $e){
					error_log('Prize Wheel Exception: ' . $e->getMessage());
					$messages[] = $e->getMessage();
				} // catch
			} // if
		} // if
		
		return new ViewModel(array(
			'form' => $form,
			'id' => $advertisementCategory->id(),
			'name' => $advertisementCategory->name(),
			'messages' => $messages	
		));	
	}
	
	public function disableAction()
	{
		
	}
}