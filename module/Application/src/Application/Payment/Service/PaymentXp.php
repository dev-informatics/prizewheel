<?php

namespace Application\Payment\Service;

use Application\Payment\ProcessorService;
use Application\Payment\Exception\ProcessorException;

class PaymentXp extends ProcessorService
{
	public function __construct()
	{
		
	}	
	
	public function charge($options)
	{
		if(!isset($options['amount'])){
			throw new ProcessorException("amount option not set: An amount must be defined.");
		} // if
	}
	
	public function void($options)
	{
		if(!isset($options['amount'])){
			throw new ProcessorException("amount option not set: An amount must be defined.");
		} // if
	}
	
	public function refund($options)
	{
		if(!isset($options['amount'])){
			throw new ProcessorException("amount option not set: An amount must be defined.");
		} // if
	}
	
	public function authorize($options)
	{
		if(!isset($options['amount'])){
			throw new ProcessorException("amount option not set: An amount must be defined.");
		} // if
	}
}