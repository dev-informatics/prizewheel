<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class IndexController extends FacebookAwareController
{
	public function __construct(\Facebook $facebook)
	{
		parent::__construct();
		$this->facebook = $facebook;
	}
	
    public function indexAction()
    {    	
        return new ViewModel();
    }
    
    public function aboutAction()
    {
    	return new ViewModel();
    }
    
    public function termsAction()
    {    	
    	return new ViewModel();
    }
    
    public function contactAction()
    {
    	return new ViewModel();
    }
    
    public function demoAction()
    {    	
    	echo $this->getConfigValue('affiliate payout rate');
    	
    	$events = \Zend\EventManager\StaticEventManager::getInstance();
    	
    	$foo = new \Application\Model\Foo();
    	
    	//$events = $foo->getEventManager()->getSharedManager();
    	/*$foo->getEventManager()->attach('bar', function($e){
    		$event = $e->getName();
    		$target = get_class($e->getTarget());
    		$params = json_encode($e->getParams());
    		
    		echo sprintf('%s called on %s, using params %s', $event, $target, $params);
    	});*/
    	
    	//$foo->bar('baz','bat');
    	
    	//$events = new \Zend\EventManager\EventManager();
    	
    	$events->attach('Application\\Model\\Foo', array('bar'), function(\Zend\EventManager\Event $e){
    		echo $e->getName();
    		echo $e->getTarget()->output();
    		echo '<br/>';
    		foreach($e->getParams() as $param){
    			echo $param.'<br/>';
    		} // foreach
      	}); 
    	
    	$foo->bar('baz','bat');
    	
    	return $this->response;
    }
}
