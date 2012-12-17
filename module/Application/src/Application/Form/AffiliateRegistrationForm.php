<?php

namespace Application\Form;

class AffiliateRegistrationForm extends AccountRegistrationForm
{
	protected $inputFilter;
	
	public function __construct($name='')
	{
		parent::__construct('affiliate-registration-form');
	}
}