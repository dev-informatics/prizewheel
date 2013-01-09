<?php

namespace Application\Controller;

use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class TransactionController extends FacebookAwareController
{
	protected $authenticationService = null;
	protected $transactionTable = null;
	protected $advertiserDataSourceInterface = null;
	
	public function __construct(\Application\Model\TransactionTable $transactionTable,
			\Application\Model\AdvertiserDataSourceInterface $advertiserDataSourceInterface,
			\Facebook $facebook)
	{
		$this->facebook = $facebook;
		$this->authenticationService = new \Zend\Authentication\AuthenticationService();
		$this->transactionTable = $transactionTable;
		$this->advertiserDataSourceInterface = $advertiserDataSourceInterface;
	} // ctor
	
	public function listAction()
	{
		$isAdmin = false;
		
		if($this->authenticationService->hasIdentity() && $this->authenticationService->getIdentity() == "admin"){
			$isAdmin = true;
		} // if
		
		$request = $this->getRequest();	
		$count = 0;
		$transactions = array();
		$layout = "layout/admin_layout";	
		
		if($isAdmin){
			if($request->isPost()){
			
				$page = $this->params()->fromPost('page', 1);
				$firstname = $this->params()->fromPost('firstname', '');
				$lastname = $this->params()->fromPost('lastname', '');		
				$count = 0;
				
				$transactions = $this->transactionTable->search(array(
							'advertiserfirstname' => $firstname,
							'advertiserlastname' => $lastname
						), $page, 25, $count);
			
				$list = array();
			
				foreach($transactions as $transaction){
					$list[] = $transaction->getArrayCopy();
				} // foreach
			
				return new JsonModel(array(
					'status' => 'success',
					'count' => $count,
					'transactions' => $list,
					'isadmin' => true
				));
			} // if
			
			$transactions = $this->transactionTable->fetchAll(1, 25, $count);
		} // else
		else if($this->isLoggedIntoFacebook()){
			
			$layout = "layout/layout";
			
			if($request->isPost()){
			
				$page = $this->params()->fromPost('page', 1);		
			
				$advertiser = $this->advertiserDataSourceInterface->getAdvertiserByFacebookUserId($this->getFacebookUserId());
				
				if(!$advertiser){
					$this->redirect()->toRoute('advertiser');
				} // if
				
				$transactions = $this->transactionTable->fetchAllByAdvertiserId($advertiser->id(), $page, 25, $count);
			
				$list = array();
			
				foreach($transactions as $transaction){
					$list[] = $transaction->getArrayCopy();
				} // foreach
			
				return new JsonModel(array(
					'status' => 'success',
					'count' => $count,
					'transactions' => $list,
					'isadmin' => false				
				));
			} // if

			$advertiserid = $this->params()->fromRoute('id', 0);
			
			if($advertiserid < 1){
				return $this->redirect()->toRoute('advertiser');
			} // if
			
			$transactions = $this->transactionTable->fetchAllByAdvertiserId($advertiserid, 1, 25, $count);			
		} // if
		else{	
			return $this->response;	
		} // else
			
		return new ViewModel(array(
			'transactions' => $transactions,
			'count' => $count,
			'layoutpath' => $layout,
			'isadmin' => $isAdmin
		));
	}
	
	public function viewAction()
	{
		$layout = "layout/admin_layout";
		$transaction = null;
		
		$id = $this->params()->fromRoute('id', 0);
		
		$transaction = $this->transactionTable->getTransaction($id);
		
		if($this->authenticationService->hasIdentity()){
			if(!$transaction){
				return $this->redirect()->toRoute('transaction', array('action' => 'list'));
			} // if
		} // if		
		else if($this->isLoggedIntoFacebook()){
			$layout = "layout/layout";
			
			if(!$transaction){
				return $this->redirect()->toRoute('affiliate');
			} // if
			
			$advertiser = $this->advertiserDataSourceInterface->getAdvertiserByFacebookUserId($this->getFacebookUserId());
			
			if(!$advertiser){
				return $this->redirect()->toRoute('affiliate');
			} // if
			
			if($transaction->advertiserId() != $advertiser->id()){
				return $this->redirect()->toRoute('affiliate');
			} // if
		} // if
		else{
			return $this->redirect()->toRoute('affiliate');
		} // else	
		
		return new ViewModel(array(
					'transaction' => $transaction,
					'layoutpath' => $layout,
					'isadmin' => $this->authenticationService->hasIdentity()
				));
	}
}