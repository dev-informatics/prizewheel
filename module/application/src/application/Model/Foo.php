<?php

namespace Application\Model;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

class Foo implements EventManagerAwareInterface
{
	protected $events;
	
	public function setEventManager(EventManagerInterface $events)
	{	
		$events->setIdentifiers(array(
			__CLASS__,
			get_called_class()	
		));
		$this->events = $events;
		return $this;
	}
	
	public function getEventManager()
	{
		if(null == $this->events){
			$this->setEventManager(new EventManager());
		} // if
		return $this->events;
	}
	
	public function bar($baz, $bat = null)
	{
		$this->getEventManager()->trigger(__FUNCTION__, $this, array($baz, $bat));
	}
	
	public function output()
	{
		echo "this is from output.";
	}
}