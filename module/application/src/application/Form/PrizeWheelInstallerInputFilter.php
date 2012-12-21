<?php

namespace Application\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class PrizeWheelInstallerInputFilter extends InputFilter
{
	protected $inputFactory = null;
	
	public function __construct()
	{
		$factory = new InputFactory();
		$this->inputFactory = $factory;
		
		$this->add($factory->createInput(array(
			'name' => 'prizewheeltypeid',
			'required' => true,
			'filters' => array(
				array('name' => "Int")
			),
			'validators' => array(
				array("name" => 'Digits')
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'pageid',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim')
			),
			'validators' => array(
				array('name' => 'NotEmpty'),
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' => 100
					)		
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'categories',
			'required' => false		
		)));				
	}
}