<?php

namespace Application\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class PrizeWheelEntryInputFilter extends InputFilter
{	
	public function __construct()
	{
		$factory = new InputFactory();
		
		$this->add($factory->createInput(array(
			'name' => 'fname_txt',
			'required' => false,
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
						'max' => 150
					)		
				)
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'lname_txt',
			'required' => false,
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
						'max' => 150
					)		
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'email_txt',
			'required' => false,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim')
			),
			'validators' => array(
				array('name' => 'NotEmpty'),
				array('name' => 'EmailAddress'),
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' => 300
					)	
				)	
			)	
 		)));
		$this->add($factory->createInput(array(
			'name' => 'phone_txt',
			'required' => false,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			),
			'validators' => array(
				array('name' => 'NotEmpty'),
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' => 150
					)		
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'id',
			'required' => false,
			'filters' => array(
				array('name' => 'Int')
			),
			'validators' => array(
				array('name' => 'NotEmpty'),
				array('name' => 'Digits')
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'code',
			'required' => false,
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
						'max' => 50
					)		
				)
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'prizeText',
			'required' => false,
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
						'max' => 50
					)
				)
			)	
		)));
	}
}