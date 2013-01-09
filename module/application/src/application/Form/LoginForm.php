<?php

namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class LoginForm extends \Zend\Form\Form
{
	protected $inputFilter = null;	
	
	public function __construct($name='')
	{
		parent::__construct('login-form');
		$this->setAttribute('method', 'post');
		
		$this->add(array(
			'name' => 'username',
			'attributes' => array(
				'id' => 'username',
				'type' => 'text'
			),
			'options' => array(
				'label' => 'User Name'
			)	
		));
		
		$password = new \Zend\Form\Element\Password("password");
		$password->setAttributes(array(
			'id' => 'password'
		));
		$password->setOptions(array(
			'label' => 'Password'	
		));
		
		$this->add($password);
		
		$this->inputFilter = $this->getDefaultInputFilter();
	}
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new InputFilter();
		$factory = new InputFactory();
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'username',
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