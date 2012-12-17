<?php

namespace Application\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class FacebookServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('Config');
		$facebook = new \Facebook($config['facebook']);
		
		return $facebook;
	}
}