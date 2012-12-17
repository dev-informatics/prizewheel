<?php

namespace Application\Payment;

use Application\Payment\Exception\ProcessorException;

class Processor
{
	private static $registeredProcessorServices = array();
	
	public function __construct()
	{		
		self::registerProcessorService(array(
			'name' => "PaymentXp",
			'class' => '\Application\Payment\Service\PaymentXp'
		));		
	}
	
	public static function registerProcessorService($options)
	{
		if(!isset($options['name'])){
			//
		} // if
		
		if(!self::$registeredProcessorServices[$options['name']]){
			self::$registeredProcessorServices[$options['name']] = $options['class'];
		} // if
	}
	
	/**
	 * 
	 * @param array $options
	 * @throws ProcessorException
	 */
	public function process(array $options)
	{
		if(!isset($options['method'])){
			throw new ProcessorException("method option not set: A charge method must be defined.");
		} // if
		
		$processorService = null;
		
		if(isset($options['processorservice'])){
			$processorService = new self::$registeredProcessorServices['processorservice']();
		} // if
		else{
			throw new ProcessorException("processorservice option not set: A processor service must be defined.");
		} // else
		
		switch($options['method']){
			case "charge":
				return $this->processorService->charge($options);
				break;
			case "void":
				return $this->processorService->void($options);
				break;
			case "refund":
				return $this->processorService->refund($options);
				break;
			case "authorize":
				return $this->processorService->authorize($options);
				break;
		} // switch
	}
}