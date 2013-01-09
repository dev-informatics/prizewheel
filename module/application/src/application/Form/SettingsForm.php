<?php

namespace Application\Form;

use Zend\InputFilter\InputFilterInterface;
use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class SettingsForm extends Form
{
	protected $inputFilter = null;
	
	public function __construct($name='')
	{
		parent::__construct('admin-settings-form');
		$this->setAttribute('method', 'post');
		
		$this->add(array(
			'name' => 'affiliate-payout-rate',
			'attributes' => array(
				'type' => 'text',
				'id' => 'affiliate-payout-rate',
				'maxlength' => 10
			),
			'options' => array(
				'label' => 'Affiliate Payout Rate (per click)'
			)	
		));
		
		$payPalButtonCode = new \Zend\Form\Element\Textarea("paypal-button-code");
		$payPalButtonCode->setAttributes(array(
			'id' => 'paypal-button-code',
			'style' => 'width: 500px; height: 250px;'
		));
		$payPalButtonCode->setOptions(array(
			'label' => 'PayPal Button Code'	
		));
		$this->add($payPalButtonCode);		
		
		$this->inputFilter = $this->getDefaultInputFilter();
	}
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new InputFilter();
		$factory = new InputFactory();
		
		$currencyFilter = new \Zend\I18n\Filter\NumberFormat("en_US", \NumberFormatter::DECIMAL);
		$floatValidator = new \Zend\I18n\Validator\Float();
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'affiliate-payout-rate',
			'required' => true,
			'filters' => array(
				$currencyFilter
			),
			'validators' => array(
				$floatValidator
			)
		))); 
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'paypal-button-code',
			'required' => false,
			'filters' => array(
				array('name' => 'StringTrim')
			),
			'validators' => array(
				array('name' => 'NotEmpty')
			)	
		)));		
		
		return $inputFilter;
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		$this->inputFilter = $inputFilter;
	}
	
	public function getInputFilter()
	{
		if(!$this->inputFilter){
			$this->inputFilter = $this->getInputFilter();
		} // if
		return $this->inputFilter;
	}
}