<?php

namespace Application\Form;

use Zend\InputFilter\InputFilterInterface;
use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class AccountRegistrationForm extends Form
{
	protected $inputFilter;
	
	public function __construct($name='')
	{
		parent::__construct($name);
		$this->setAttribute('method', 'post');		
		$this->add(array(
			'name' => 'firstname',
			'attributes' => array(
				'id' => 'firstname',
				'maxlength' => 100,
				'type' => 'text' 
			),
			'options' => array(
				'label' => 'First Name'
			)
		));
		$this->add(array(
			'name' => 'lastname',
			'attributes' => array(
				'id' => 'lastname',
				'maxlength' => 100,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Last Name'
			)	 
		));
		$this->add(array(
			'name' => 'address1',
			'attributes' => array(
				'id' => 'address1',
				'maxlength' => 150,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Address1'
			)	
		));
		$this->add(array(
			'name' => 'address2',
			'attributes' => array(
				'id' => 'address2',
				'maxlength' => 100,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Address2'
			)	
		));
		$this->add(array(
			'name' => 'city',
			'attributes' => array(
				'id' => 'city',
				'maxlength' => 150,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'City'
			)	
		));
		$this->add(array(
			'name' => 'state',
			'attributes' => array(
				'id' => 'state',
				'maxlength' => 100,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'State'	
			)		
		));
		$this->add(array(
			'name' => 'country',
			'attributes' => array(
				'id' => 'country',
				'maxlength' => 200,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Country'
			)	
		));
		$this->add(array(
			'name' => 'postal',
			'attributes' => array(
				'id' => 'postal',
				'maxlength' => 50,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Zip Code'
			)
		));
		$this->add(array(
			'name' => 'telephone',
			'attributes' => array(
				'id' => 'telephone',
				'maxlength' => 100,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Telephone'
			)
		));
		$this->add(array(
			'name' => 'emailaddress',
			'attributes' => array(
				'id' => 'emailaddress',
				'maxlength' => 255,
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Email Address'
			)
		));
		$this->inputFilter = $this->getDefaultInputFilter();
	}
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new InputFilter();
		$factory = new InputFactory();
			
		$inputFilter->add($factory->createInput(array(
				'name' => 'firstname',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
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
		$inputFilter->add($factory->createInput(array(
				'name' => 'lastname',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
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
		$inputFilter->add($factory->createInput(array(
				'name' => 'address1',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
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
		$inputFilter->add($factory->createInput(array(
				'name' => 'address2',
				'required' => false,
				'filter' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
						array(
								'name' => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min' => 0,
										'max' => 100
								)
						)
				)
		)));
		$inputFilter->add($factory->createInput(array(
				'name' => 'city',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
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
		$inputFilter->add($factory->createInput(array(
				'name' => 'state',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim' )
				),
				'validators' => array(
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
		$inputFilter->add($factory->createInput(array(
				'name' => 'country',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
						array(
								'name' => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min' => 1,
										'max' => 200
								)
						)
				)
		)));
		$inputFilter->add($factory->createInput(array(
				'name' => 'postal',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
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
		$inputFilter->add($factory->createInput(array(
				'name' => 'telephone',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
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
		$inputFilter->add($factory->createInput(array(
				'name' => 'emailaddress',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
				),
				'validators' => array(
						array(
								'name' => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min' => 1,
										'max' => 100
								)
						),
						new \Zend\Validator\EmailAddress()
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
			$this->inputFilter = $this->getDefaultInputFilter();			
		} // if
		
		return $this->inputFilter;
	}
}