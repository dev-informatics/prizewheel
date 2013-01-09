<?php

namespace Application\Form;

use Zend\InputFilter\InputFilterInterface;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class ManageUserForm extends Form
{
	protected $inputFilter = null;
	
	public function __construct()
	{
		parent::__construct('manage-user-form');
		$this->setAttribute('method', 'post');
		
		$password = new \Zend\Form\Element\Password('password');
		$password->setAttributes(array(
					'id' => 'password'
				));
		$password->setOptions(array(
					'label' => 'Password'
				));
		$this->add($password);
		
		$confirm = new \Zend\Form\Element\Password('confirm');
		$confirm->setAttributes(array(
					'id' => 'confirm'
				));
		$confirm->setOptions(array(
					'label' => 'Confirm Password'
				));
		$this->add($confirm);
		
		$this->inputFilter = $this->getInputFilter();
	}
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new InputFilter();
		$factory = new InputFactory();
		
		$inputFilter->add($factory->createInput(array(
					'name' => 'password',
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
								'max' => 16
							)		
						)
					)
				)));
		
		$compare = new \Zend\Validator\Identical('password', $this);
		$compare->setMessage("Password and Confirm Password must be identical");
		
		$inputFilter->add($factory->createInput(array(
					'name' => 'confirm',
					'required' => true,
					'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim')
					),
					'validators' => array(
						$compare,							
						array('name' => 'NotEmpty'),
						array(
							'name' => 'StringLength',
							'options' => array(
								'encoding' => 'UTF-8',
								'min' => 1,
								'max' => 16
							)
						)
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