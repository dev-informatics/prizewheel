<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Crypt\BlockCipher;

class CryptoServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
		$crypto = $config['crypto'];
		
		$blockCipher = BlockCipher::factory($crypto['extension'], array('algo' => $crypto['algo']));
		$blockCipher->setKey($crypto['key']);
		
		return $blockCipher;
	}
}