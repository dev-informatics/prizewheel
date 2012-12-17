<?php

namespace Application\Form;

class AdvertiserRegistrationForm extends AccountRegistrationForm
{
	public function __construct($name='')
	{
		parent::__construct('advertiser-registration-form');
	}
}