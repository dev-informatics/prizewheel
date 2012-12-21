<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

abstract class FacebookAwareController extends AbstractActionController
{
	protected $facebook = null;
	
	protected function fetchLoginUrl($route)
	{
		$config = $this->getServiceLocator()->get('Config');
	
		$params = array(
			'scope' => 'email, manage_pages',
			'redirect_uri' => $config['appconfig']['baseurl'] . $route
		);
	
		return $this->facebook->getLoginUrl($params);
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
		return $this->facebook->api($call);
	}
}