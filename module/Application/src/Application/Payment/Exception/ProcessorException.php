<?php

namespace Application\Payment\Exception;

use \Exception;

class ProcessorException extends Exception
{
	public function __construct($message=null, $code=null, $previous=null)
	{
		parent::__construct($message, $code, $previous);
	} // ctor
}