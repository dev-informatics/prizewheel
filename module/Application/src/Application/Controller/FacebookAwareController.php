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
		if($this->facebook->getUser()){
			return true;
		} // if
		return false;
	}
	
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