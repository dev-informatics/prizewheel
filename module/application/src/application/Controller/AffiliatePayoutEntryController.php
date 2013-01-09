<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Model\AffiliatePayoutEntryTable;
use Application\Model\AffiliateTable;

class AffiliatePayoutEntryController extends FacebookAwareController
{
	protected $affiliatePayoutEntryTable = null;
	protected $affiliateTable = null;
	protected $authenticationService = null;
	
	public function __construct(AffiliatePayoutEntryTable $affiliatePayoutEntryTable, AffiliateTable $affiliateTable, \Facebook $facebook)
	{
		$this->affiliatePayoutEntryTable = $affiliatePayoutEntryTable;
		$this->affiliateTable = $affiliateTable;
		$this->facebook = $facebook;
		$this->authenticationService = new \Zend\Authentication\AuthenticationService();
	} // ctor
	
	public function listAction()
	{
		$request = $this->getRequest();
		$layout = "layout/layout";
		$count = 0;
		$payouts = array();
		$page = $this->params()->fromPost('page', 1);		
		
		if($this->authenticationService->hasIdentity()){
			
			$layout = "layout/admin_layout";
			
			if($request->isPost()){
				
				$affiliatePayoutEntries = $this->affiliatePayoutEntryTable->fetchAll($page, 25, $count);
				
				$list = array();
				
				foreach($affiliatePayoutEntries as $affiliatePayoutEntry){
					$list[] = $affiliatePayoutEntry->getArrayCopy();
				} // foreach
				
				return new JsonModel(array(
					'status' => 'success',
					'count' => $count,
					'affiliatepayoutentries' => $list,
					'isadmin' => $this->authenticationService->hasIdentity()
				));
			} // if
			
			$payouts = $this->affiliatePayoutEntryTable->fetchAll($page, 25, $count);
		} // else
		else if($this->isLoggedIntoFacebook()){
				
			$affiliate = $this->affiliateTable->getAffiliateByFacebookId($this->getFacebookUserId());
				
			if(!$affiliate){
				return $this->redirect()->toRoute('affiliate');
			} // if
				
			if($request->isPost()){
		
				$affiliatePayoutEntries = $this->affiliatePayoutEntryTable->fetchAllByAffiliateId($affiliate->id(), $page, 25, $count);
		
				$list = array();
		
				foreach($affiliatePayoutEntries as $affiliatePayoutEntry){
					$list[] = $affiliatePayoutEntry->getArrayCopy();
				} // foreach
					
				return new JsonModel(array(
						'status' => 'success',
						'count' => $count,
						'affiliatepayoutentries' => $list,
						'isadmin' => $this->authenticationService->hasIdentity()
				));
			} // if
				
			$payouts = $this->affiliatePayoutEntryTable->fetchAllByAffiliateId($affiliate->id(), $page, 25, $count);
		} // if
		else{
			return $this->redirect()->toRoute('home');
		} // else
			
		return new ViewModel(array(
			'layoutpath' => $layout,
			'affiliatepayoutentries' => $payouts,
			'count' => $count,
			'isadmin' => $this->authenticationService->hasIdentity()
		));
 	}
}