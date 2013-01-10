<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

abstract class FacebookAwareController extends AbstractActionController
{
	protected $facebook = null;
	private $configurationEntryTable = null;
	private $eventManager = null;
	protected $authenticationService = null;
	
	public function __construct()
	{
		if($this->eventManager == null){
			$this->eventManager = new \Zend\EventManager\EventManager(array(__CLASS__, get_called_class()));
			$this->eventManager->setSharedManager(\Zend\EventManager\StaticEventManager::getInstance());
		} // if
		$this->authenticationService = new \Zend\Authentication\AuthenticationService();		
	}
	
	public function setConfigurationEntryTable(\Application\Model\ConfigurationEntryTable $configurationEntryTable)
	{
		$this->configurationEntryTable = $configurationEntryTable;
	}
	
	public function getConfigurationEntryTable()
	{
		if($this->configurationEntryTable == null){		
			$this->eventManager->trigger('getConfigurationEntryTable', $this);			
		} // if
		
		return $this->configurationEntryTable;
	}
	
	protected function fetchLoginUrl($route)
	{
		$config = $this->getServiceLocator()->get('Config');
	
		$params = array(
			'scope' => 'email, manage_pages',
			'redirect_uri' => $config['appconfig']['baseurl'] . $route
		);
	
		return $this->facebook->getLoginUrl($params);		
	}
	
	protected function getConfigValue($name)
	{		
		return $this->getConfigurationEntryTable()->getConfigurationEntryByName($name);
	}
	
	protected function setConfigValue($name, $value)
	{
		$configurationEntry = $this->getConfigValue($name);
		
		$configurationEntry->value($value);
		
		try{
			$this->getConfigurationEntryTable()->save($configurationEntry);
		} // try
		catch(\Exception $e){
			error_log("Prize Wheel Exception: " . $e->getMessage());
		} // catch
	}
	
	protected function isLoggedIntoFacebook()
	{
		$user = null;
		
		try{
			$user = $this->facebook->getUser();	
		} // try
		catch(\Exception $e){
			error_log('Prize Wheel Exception: ' . $e->getMessage() . ' Stack Trace: ' . $e->getTraceAsString());
		} // catch
				
		if(!$user){
			return false;
		} // if
		else{
			return true;
		} // else
	} // isLoggedIntoFacebook
	
	public function getFacebookAccessToken()
	{
		try{
			return $this->facebook->getAccessToken();
		} // try
		catch(\FacebookApiException $e){
			error_log('Prize Wheel Exception: ' . $e->getMessage() . ' Stack Trace: ' . $e->getTraceAsString());
		} // catch
		return null;
	} // getAccessToken
	
	protected function getFacebookUserId()
	{
		return $this->facebook->getUser();
	}
	
	protected function getUserInformation()
	{
		try{
			return $this->facebook->api("/me");
		} // try
		catch(\FacebookApiException $e){
			error_log("Prize Wheel Exception: " . $e->getMessage());
		} // catch
		
		return null;
	}
	
	protected function getFacebookAppId()
	{
		return $this->facebook->getAppId();
	}
	
	protected function getSignedRequest()
	{
		return $this->facebook->getSignedRequest();
	}
	
	protected function getApiResult($call)
	{
		try{
			return $this->facebook->api($call);
		} // try
		catch(\Exception $e){
			error_log("Prize Wheel Exception: " . $e->getMessage());
		} // catch
		
		return null;
	}
}