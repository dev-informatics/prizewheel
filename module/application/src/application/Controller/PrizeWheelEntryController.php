<?php

namespace Application\Controller;

use Application\Model\AffiliateTable;

use Zend\View\Model\JsonModel;

use Application\Model\PrizeWheelEntryTable;

class PrizeWheelEntryController extends FacebookAwareController
{
	protected $prizeWheelEntryTable = null;
	protected $affiliateTable = null;
	
	public function __construct(PrizeWheelEntryTable $prizeWheelEntryTable, AffiliateTable $affiliateTable, \Facebook $facebook)
	{
		parent::__construct();
		$this->prizeWheelEntryTable = $prizeWheelEntryTable;
		$this->affiliateTable = $affiliateTable;
		$this->facebook = $facebook;
	}
	
	public function listAction()
	{		
		$page = $this->params()->fromPost('page', 1);
		$prizeWheelId = $this->params()->fromPost('prizewheelid', 0);
		
		if($this->authenticationService->hasIdentity()){
			
			$count = 0;
			
			$prizeWheelEntries = $this->prizeWheelEntryTable->fetchAllByPrizeWheelId($prizeWheelId, $page, 25, $count);
			
			$list = array();
			
			foreach($prizeWheelEntries as $prizeWheelEntry){
				$list[] = $prizeWheelEntry->getArrayCopy();
			} // foreach
			
			return new JsonModel(array(
				'status' => 'success',
				'count' => $count,
				'prizewheelentries' => $list	
			));
		} // if
		else if($this->isLoggedIntoFacebook()){
			
			$affiliateId = $this->params()->fromPost('affiliateid', 0);			
			
			$affiliate = $this->affiliateTable->getAffiliateByFacebookId($this->getFacebookUserId());
			
			if($affiliate->id() != $affiliateId){
				return new JsonModel(array(
					'status' => 'error',
					'count' => 0,
					'prizewheelentries' => array()	
				));
 			} // if
			
			$count = 0;
			
			$prizeWheelEntries = $this->prizeWheelEntryTable->fetchAllByPrizeWheelId($prizeWheelId, $page, 25, $count);

			$list = array();
				
			foreach($prizeWheelEntries as $prizeWheelEntry){
				$list[] = $prizeWheelEntry->getArrayCopy();
			} // foreach
				
			return new JsonModel(array(
				'status' => 'success',
				'count' => $count,
				'prizewheelentries' => $list
			));
		} // else
			
		return $this->response->setContent("Error");
	}
	
	public function exportAction()
	{
		if(!$this->isLoggedIntoFacebook()){
			return $this->redirect()->toRoute('affiliate');
		} // if
		
		$affiliateId = $this->params()->fromPost('affiliateid', 0);
		
		$affiliate = $this->affiliateTable->getAffiliate($affiliateId);
		
		if(!$affiliate){
			return $this->redirect()->toRoute('affiliate');
		} // if
		
		$prizeWheelId = $this->params()->fromPost('prizewheelid', 0);
		
		if($prizeWheelId < 1){
			return $this->redirect()->toRoute('affiliate');
		} // if
		
		$prizeWheelEntrySelections = $this->params()->fromPost('entries', array());

		$prizeWheelEntries = array();
		
		if(count($prizeWheelEntrySelections) > 0){
			
			$prizeWheelEntries = $this->prizeWheelEntryTable->fetchAllWithId($prizeWheelEntrySelections);
		} // if
		else{
			
			$totalCount = $this->prizeWheelEntryTable->getCountByPrizeWheelId($prizeWheelId);
			$count = 0;
		
			$prizeWheelEntries = $this->prizeWheelEntryTable->fetchAllByPrizeWheelId($prizeWheelId, 1, $totalCount, $count);		
		} // else
			
		$list = array();
		
		foreach($prizeWheelEntries as $prizeWheelEntry){
			$list[] = $prizeWheelEntry->id();
		} // foreach
		
		$this->prizeWheelEntryTable->updateAsExported($list);
		
		$output = $this->prepareCsvDownload($prizeWheelEntries);
		
		$filename = "Exported-Prizes-" . date("Y-m-d_H-i", time()) . ".csv";
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename=' . $filename);
		echo $output;
		
		return $this->response;
	}
	
	private function prepareCsvDownload($prizeWheelEntries=array())
	{
		$csv = "Id,FacebookUserId,FirstName,LastName,Email,Phone,IP,PlayTime,Prize,Exported\n";
		
		$escape_csv_string = function($string){
			return str_replace(',','',$string);
		};
		
		foreach($prizeWheelEntries as $pwe){
			$csv .= $escape_csv_string($pwe->id()).",";
			$csv .= $escape_csv_string($pwe->facebookUserId()).",";
			$csv .= $escape_csv_string($pwe->firstName()).",";
			$csv .= $escape_csv_string($pwe->lastName()).",";
			$csv .= $escape_csv_string($pwe->emailAddress()).",";
			$csv .= $escape_csv_string($pwe->telephone()).",";
			$csv .= $escape_csv_string($pwe->ipAddress()).",";
			$csv .= $escape_csv_string($pwe->playTime()).",";
			$csv .= $escape_csv_string($pwe->prize()).",";
			$csv .= $escape_csv_string($pwe->exported()).",";
			$csv .= "\n";				
		} // foreach
		
		return $csv;
	}
}