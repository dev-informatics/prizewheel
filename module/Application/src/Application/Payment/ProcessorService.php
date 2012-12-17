<?php

namespace Application\Payment;

abstract class ProcessorService
{
	public abstract function charge(array $options);
	public abstract function void(array $options);
	public abstract function refund(array $options);
	public abstract function authorize(array $options);
}