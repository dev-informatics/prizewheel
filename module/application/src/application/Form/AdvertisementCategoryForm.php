<?php

namespace Application\Form;

use Zend\InputFilter\InputFilterInterface;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class AdvertisementCategoryForm extends Form
{
	protected $inputFilter = null;
	
	public function __construct($name='')
	{
		parent::__construct('advertisement-category-form');
		$this->setAttribute('method', 'post');
		
		$this->add(array(
			'name' => 'name',
			'attributes' => array(
				'type' => 'text',
				'id' => 'name',
				'maxlength' => 150
			),
			'options' => array(
				'label' => 'Name'
			)	
		));
		
		$description = new \Zend\Form\Element\Textarea('description');
		$description->setAttributes(array(
			'id' => 'description',
			'style' => 'width: 300px; height: 150px;'	
		));
		$description->setOptions(array(
			'label' => 'Description'	
		));		
		$this->add($description);
		
		$this->add(array(
			'name' => 'clickrate',
			'attributes' => array(
				'id' => 'clickrate',
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Click Rate'
			)	
		));
		
		$this->add(array(
			'name' => 'impressionrate',
			'attributes' => array(
				'id' => 'impressionrate',
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Impression Rate'
			)	
		));

		$enabled = new \Zend\Form\Element\Checkbox("enabled");
		$enabled->setAttributes(array(
			'id' => 'enabled'	
		));
		$enabled->setOptions(array(
			'label' => 'Enabled'	
		));
		$this->add($enabled);		
		
		$this->inputFilter = $this->getDefaultInputFilter();
	}
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new InputFilter();
		$factory = new InputFactory();
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'name',
			'required' => true,
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
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'description',
			'required' => false,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		)));
		
		//$currencyFilter = new \Zend\I18n\Filter\NumberFormat("en_US", \NumberFormatter::DECIMAL);
		$floatValidator = new \Zend\I18n\Validator\Float();
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'clickrate',
			'required' => true,
			'filters' => array(
				//$currencyFilter
			),
			'validators' => array(
				$floatValidator
			) 	
		)));
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'impressionrate',
			'required' => true,
			'filters' => array(
				//$currencyFilter
			),
			'validators' => array(
				$floatValidator
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'enabled',
			'required' => true	
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