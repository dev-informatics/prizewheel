<?php

namespace Application\Controller;

use Application\Model\TransactionStatus;
use Application\Model\Transaction;
use Application\Model\IpnListener;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;

class AdminController extends AbstractActionController
{
	protected $configurationEntryTable = null;
	protected $authenticationService = null;
	protected $advertisementTable = null;
	protected $advertiserTable = null;
	protected $transactionTable = null;
	protected $affiliatePayoutEntryTable = null;
	
	public function __construct(
			\Application\Model\ConfigurationEntryTable $configurationEntryTable,
			\Application\Model\AdvertisementDataSourceInterface $advertisementTable,
			\Application\Model\AdvertiserDataSourceInterface $advertiserTable,
			\Application\Model\TransactionTable $transactionTable,
			\Application\Model\AffiliatePayoutEntryTable $affiliatePayoutEntryTable)
	{
		$this->configurationEntryTable = $configurationEntryTable;
		$this->authenticationService = new \Zend\Authentication\AuthenticationService();
		$this->advertisementTable = $advertisementTable;
		$this->advertiserTable = $advertiserTable;
		$this->transactionTable = $transactionTable;
		$this->affiliatePayoutEntryTable = $affiliatePayoutEntryTable;
	}
	
	public function revenueAndPayoutsReportAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		$results =  $this->transactionTable->getRevenueGroupedByDate('2012-12-10 00:00:00', '');
		
		print_r($results);
		
		return $this->response;
		
		/*
		$request = $this->getRequest();
		
		if($request->isPost()){

		
			
			
			
			return new JsonModel(array(
						''
					));
		} // if*/
	}
	
	public function indexAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		return new ViewModel(array());
	}
	
	public function settingsAction()
	{
		if(!$this->authenticationService->hasIdentity()){
			return $this->redirect()->toRoute('authentication');
		} // if
		
		$form = new \Application\Form\SettingsForm();
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$form->setData($request->getPost());
			if($form->isValid()){
							
				$messages = array();
				
				foreach($form->getData() as $key => $value){		
					
					try{
						$this->setConfigValue($key, $value);
					} // try
					catch(\Exception $e){
						$messages[$key] = $e->getMessage(); 
					} // catch
				} // foreach
				
				$form->setMessages($messages);
			} // if			
		} // if
		
		$form->setData($this->getConfigValues());
		
		return new ViewModel(array(
			'form' => $form	
		));
	}
	
	public function instantPaymentNotificationAction()
	{		
		$listener = new IpnListener();
		
		$listener->use_sandbox = true;
		
		try{
			$listener->requirePostMethod();
			$verified = $listener->processIpn();
			
			if($verified){
				
				$amount = (float)$this->params()->fromPost('payment_gross');
				$paymentId = (string)$this->params()->fromPost('txn_id');
				$transactionType = (string)$this->params()->fromPost('txn_type', '');
				$paymentStatus = (string)$this->params()->fromPost('payment_status', 'Denied');
				$memo = $this->params()->fromPost('item_name', '');
				$advertisementId = (int)$this->params()->fromPost('custom', 0);
				
				$firstname = $this->params()->fromPost('first_name', '');
				$lastname = $this->params()->fromPost('last_name', '');
				$address1 = $this->params()->fromPost('address_street', '');
				$city = $this->params()->fromPost('address_city', '');
				$state = $this->params()->fromPost('address_state', '');
				$country = $this->params()->fromPost('address_country_code', '');
				$postal = $this->params()->fromPost('address_zip', '');
				$email = $this->params()->fromPost('payer_email', '');
				$telephone = $this->params()->fromPost('contact_phone', '');
				
				switch($transactionType){
					case "web_accept":
						$advertisement = $this->advertisementTable->getAdvertisement($advertisementId);
						
						// @todo Email Error Notifications.
						if(!$advertisement){
							error_log('NULL advertisement for PayPal Transaction: ' . $paymentId);
								
							return $this->response;
						} // if
						
						$advertiser = $this->advertiserTable->getAdvertiser($advertisement->advertiserId());
						
						if(!$advertiser){
							error_log('NULL advertiser for PayPal Transaction: ' . $paymentId . ' and Advertisement: ' . $advertisement->id());
								
							return $this->response;
						} // if
						
						$transaction = $this->transactionTable->getTransactionByPaymentId($paymentId);
						
						if($transaction){
							return $this->response;
						} // if
						
						$transaction = new Transaction();
						$transaction->paymentId($paymentId);
						$transaction->processor('paypal');
						$transaction->memo($memo);
						$transaction->amount($amount);
						$transaction->status($paymentStatus);
						$transaction->advertisementId($advertisementId);
						$transaction->firstName($firstname);
						$transaction->lastName($lastname);
						$transaction->address1($address1);
						$transaction->city($city);
						$transaction->state($state);
						$transaction->country($country);
						$transaction->postal($postal);
						$transaction->emailAddress($email);
						$transaction->telephone($telephone);
						$transaction->ipAddress($this->getRequest()->getServer('REMOTE_ADDR'));
						
						switch($paymentStatus){
							case "Canceled_Reversal":
								$transaction->transactionStatusId(TransactionStatus::Success);
								$this->transactionTable->save($transaction);
								$advertisement->addBucketCredits($amount);
								$this->advertisementTable->updateBucket($advertisement->id(), $advertisement->bucket());
								if($advertiser->enabled() == false){
									$advertiser->enabled(true);
									$this->advertiserTable->save($advertiser);
								} // if
								break;
							case "Pending":
								$transaction->transactionStatusId(TransactionStatus::Pending);
								$this->transactionTable->save($transaction);
								break;
							case "Completed":
								$transaction->transactionStatusId(TransactionStatus::Success);
								$this->transactionTable->save($transaction);
								$advertisement->addBucketCredits($amount);
								$this->advertisementTable->updateBucket($advertisement->id(), $advertisement->bucket());
								if($advertisement->bucket() >= 0.00 && $advertiser->enabled() == false){
									$advertiser->enabled(true);
									$this->advertiserTable->save($advertiser);
								} // if
								break;
							case "Denied":
								$transaction->transactionStatusId(TransactionStatus::Failed);
								$this->transactionTable->save($transaction);
								break;
							case "Expired":
								$transaction->transactionStatusId(TransactionStatus::Failed);
								$this->transactionTable->save($transaction);
								break;
							case "Refunded":
								$transaction->transactionStatusId(TransactionStatus::Refund);
								$this->transactionTable->save($transaction);
								$advertisement->removeBucketCredits(abs($amount));
								$this->advertisementTable->updateBucket($advertisement->id(), $advertisement->bucket());
								if($advertisement->bucket() < 0.00){
									$advertiser->enabled(false);
									$this->advertiserTable->save($advertiser);
								} // if
								break;
							case "Reversed":
								$transaction->transactionStatusId(TransactionStatus::Chargeback);
								$this->transactionTable->save($transaction);
								$advertisement->removeBucketCredits(abs($amount));
								$this->advertisementTable->updateBucket($advertisement->id(), $advertisement->bucket());
								if($advertisement->bucket() < 0.00){
									$advertiser->enabled(false);
									$this->advertiserTable->save($advertiser);
								} // if
								break;
							case "Voided":
								$transaction->transactionStatusId(TransactionStatus::Void);
								$this->transactionTable->save($transaction);
								$advertisement->removeBucketCredits(abs($amount));
								$this->advertisementTable->updateBucket($advertisement->id(), $advertisement->bucket());
								if($advertisement->bucket() < 0.00){
									$advertiser->enabled(false);
									$this->advertiserTable->save($advertiser);
								} // if
								break;
							case "Processed":
								$transaction->transactionStatusId(TransactionStatus::Pending);
								$this->transactionTable->save($transaction);
								if($advertisement->bucket() < 0.00){
									$advertiser->enabled(false);
									$this->advertiserTable->save($advertiser);
								} // if
								break;
						} // switch
						break;
					case "masspay":
						
						$loop = true;
						$index = 1;
						
						while($loop){
							
							$txnId = $this->params()->fromPost('masspay_txn_id_'.$index, '');
							
							if(!empty($txnId)){
							
								$mcGross = $this->params()->fromPost('mc_gross_'.$index, 0.00);
								$uniqueId = $this->params()->fromPost('unique_id_'.$index, 0);
								$payerBusiness = $this->params()->fromPost('payer_business_name', '');
								$claimedStatus = $this->params()->fromPost('status_'.$index, 'Unknown');
								
								$affiliatePayoutEntry = $this->affiliatePayoutEntryTable->getAffiliatePayoutEntryByUniqueId($uniqueId);
								
								$identifiers = explode('|', $uniqueId);
								$affiliateId = $identifiers[0];
								
								if(!$affiliatePayoutEntry){
									$affiliatePayoutEntry = new \Application\Model\AffiliatePayoutEntry();
								} // if
								
								$affiliatePayoutEntry->affiliateId($affiliateId);
								$affiliatePayoutEntry->transactionId($txnId);
								$affiliatePayoutEntry->payoutMethod('paypal');
								$affiliatePayoutEntry->amount($mcGross);
								$affiliatePayoutEntry->messages($payerBusiness);
								$affiliatePayoutEntry->claimedStatus($claimedStatus);
								$affiliatePayoutEntry->uniqueId($uniqueId);

								try{
									$this->affiliatePayoutEntryTable->save($affiliatePayoutEntry);
								} // try
								catch(\Exception $e){
									error_log('Prize Wheel Exception: ' . $e->getMessage() . ' : ' . $e->getTraceAsString());
								} // catch
							} // if
							else{
								$loop = false;
							} // else		
							
							$index++;							
 						} // while						
						break;
					default:
						error_log('Invalid Transaction Type for Instant Payment Notification');
						break;
				} // switch				
			} // if
		} // try
		catch(\Exception $e){
			
			$previous = $e->getPrevious();
			
			if(!$previous){
				error_log('Prize Wheel Exception: ' . $e->getMessage());
			}
			else{
			
				$previous = $previous->getPrevious();
			
				error_log('Prize Wheel Exception: ' . $e->getMessage() . ' Previous Message: ' . $previous->getMessage() . ' Previous Stack Trace: ' . $previous->getTraceAsString());
			} // else
		} // catch
		
		return $this->response;
	}
	
	public function setConfigValue($name, $value)
	{
		$configEntry = $this->configurationEntryTable->getConfigurationEntryByName(str_replace('-', ' ', $name));
		
		if(!$configEntry){
			throw new \Exception("Config Entry could not be located or does not exist.");
		} // if
		
		$configEntry->value($value);
		
		try{
			$this->configurationEntryTable->save($configEntry);
		} // try
		catch(\Exception $e){
			throw new \Exception("Could not update Config Entry", null, $e);
		} // catch
	}
	
	public function getConfigValues()
	{
		$configEntryList = $this->configurationEntryTable->fetchAll();
		
		$list = array();
		
		foreach($configEntryList as $configEntry){
			$list[str_replace(' ', '-', $configEntry->name())] = $configEntry->value();
		} // foreach

		return $list;
	}
}