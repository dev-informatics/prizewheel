<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class ManageAdDrivenPrizeWheelForm extends Form
{
	protected $inputFilter = null;
	
	public function __construct($name='', $advertisementCategories=array())
	{
		parent::__construct("manage-prize-wheel");
		$this->setAttribute("method", "post");
		
		$options = array();
		foreach($advertisementCategories as $category){
			$options[$category->id()] = $category->name();
		} // foreach
		$categories = new \Zend\Form\Element\Select("categories");
		$categories->setValueOptions($options);
		$categories->setAttributes(array(
			"id" => "categories",
			"style" => "width: 250px;",
			"multiple" => "multiple"
		));
		$categories->setOptions(array(
			"label" => "Target Categories"	
		));
		$this->add($categories);
		
		$this->inputFilter = $this->getDefaultInputFilter();
	}
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new InputFilter();
		$factory = new InputFactory();
		
		$inputFilter->add($factory->createInput(array(
			'name' => 'categories',
			'required' => false	
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