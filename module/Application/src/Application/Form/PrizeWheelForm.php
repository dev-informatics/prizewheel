<?php

namespace Application\Form;

use Zend\Form\Form;

class PrizeWheelForm extends Form 
{
	protected $inputFilter = null;
	
	public function __construct($name='')
	{
		parent::__construct("prizewheel-form");
		
		$this->inputFilter = $this->getDefaultInputFilter();
		
		$this->add(array(
			'name' => 'firsttext',
			'required' => true,
			'filters' => array(
			
			),
			'validators' => array(
			
			)	
		));
	}
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new \Zend\InputFilter\InputFilter();
		$factory = new \Zend\InputFilter\Factory();
		
		$inputFilter->add($factory->createInput(array(
				
		)));

		return $inputFilter;
	}
	
	public function setInputFilter(\Zend\InputFilter\InputFilterInterface $inputFilter)
	{
		$this->inputFilter = $inputFilter;
	}
	
	public function getInputFilter()
	{
		if(!$this->inputFilter){
			$this->inputFilter = $this->getDefaultInputFilter();
		} // if
		return $this->inputFilter;
	}
}