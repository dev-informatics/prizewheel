<?php

namespace Application\Form;

use Zend\InputFilter\InputFilterInterface;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class ManageAdvertiserForm extends Form
{
	protected $inputFilter = null;
	
	public function __construct($name='', $displayenabled=false)
	{
		parent::__construct('manage-advertiser');
		$this->setAttribute('method', 'post');
		
		$this->add(array(
			'name' => 'firstname',
			'attributes' => array(
				'type' => 'text',
				'id' => 'firstname',
				'maxlength' => 100
			),
			'options' => array(
				'label' => 'First Name'
 			)	
		));
		
		$this->add(array(
			'name' => 'lastname',
			'attributes' => array(
				'type' => 'text',
				'id' => 'lastname',
				'maxlength' => 100
			),
			'options' => array(
				'label' => 'Last Name'
 			)	
		));
		
		$this->add(array(
			'name' => 'address1',
			'attributes' => array(
				'type' => 'text',
				'id' => 'address1',
				'maxlength' => 150
			),
			'options' => array(
				'label' => 'Address1'
			)
		));
		
		$this->add(array(
			'name' => 'address2',
			'attributes' => array(
				'type' => 'text',
				'id' => 'address2',
				'maxlength' => 100
			),
			'options' => array(
				'label' => 'Address2'
			)
		));
		
		$this->add(array(
			'name' => 'city',
			'attributes' => array(
				'type' => 'text',
				'id' => 'city',
				'maxlength' => 150
			),
			'options' => array(
				'label' => 'City'
			)
		));
		
		$this->add(array(
			'name' => 'state',
			'attributes' => array(
				'type' => 'text',
				'id' => 'state',
				'maxlength' => 100
			),
			'options' => array(
				'label' => 'State'
			)
		));
		
		$this->add(array(
			'name' => 'country',
			'attributes' => array(
				'type' => 'text',
				'id' => 'country',
				'maxlength' => 200
			),
			'options' => array(
				'label' => 'Country'
			)
		));
		
		$this->add(array(
			'name' => 'postal',
			'attributes' => array(
				'type' => 'text',
				'id' => 'postal',
				'maxlength' => 50
			),
			'options' => array(
				'label' => 'Zip'
			)
		));
		
		$this->add(array(
			'name' => 'telephone',
			'attributes' => array(
				'type' => 'text',
				'id' => 'telephone',
				'maxlength' => 100
			),
			'options' => array(
				'label' => 'Telephone'
			)
		));
		
		$this->add(array(
			'name' => 'emailaddress',
			'attributes' => array(
				'type' => 'text',
				'id' => 'emailaddress',
				'maxlength' => 100
			),
			'options' => array(
				'label' => 'E-Mail Address'
			)
		));

		if($displayenabled){
			$checkbox = new \Zend\Form\Element\Checkbox('enabled');
			$checkbox->setAttributes(array(
				'id' => 'enabled'	
			));
			$checkbox->setOptions(array(
				'label' => 'Enabled'	
			));
			$this->add($checkbox);
		} // if
		
		$this->inputFilter = $this->getDefaultInputFilter();
	} // ctor
	
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
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'lastname',
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
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'address1',
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
						'max' => 150
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'address2',
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
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'state',
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
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'country',
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
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'telephone',
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
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'emailaddress',
			'required' => true,
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
						'max' => 100
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'enabled',
			'required' => false	
		)));
		
		return $inputFilter;
	}
	
	public function getInputFilter()
	{
		if(!$this->inputFilter){
			$this->inputFilter = $this->getDefaultInputFilter();
		} // if		
		return $this->inputFilter;
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		$this->inputFilter = $inputFilter;
	}
}