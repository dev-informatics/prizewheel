<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class NewAdvertisementForm extends Form
{
	protected $inputFilter = null;
	
	public function __construct($name='', $advertisementTypes=array(), $advertisementCategories=array())
	{
		parent::__construct("new-advertisement-form");
		$this->setAttribute("method", "post");
		$this->setAttribute("enctype", "multipart/form-data");
		
		$this->add(array(
			"name" => "name",
			"attributes" => array(
				"id" => "name",
				"maxlength" => 150,
				"type" => "text"
			),
			"options" => array(
				"label" => "Name"
			) 
		));		
		$this->add(array(
			"name" => "description",
			"type" => 'Zend\Form\Element\Textarea',
			"attributes" => array(
				"id" => "description",
				"style" => "height: 150px; width: 300px;",
			),
			"options" => array(
				"label" => "Description"
			)	
		));
		$this->add(array(
			"name" => "url",
			"attributes" => array(
				"id" => "url",
				"type" => "text",
				"maxlength" => 300
			),
			"options" => array(
				"label" => "Redirect URL"
			)	
		));
		
		$list = array();
		foreach($advertisementTypes	as $advertType){
			$list[$advertType->id()] = $advertType->name();
		} // foreach
		
		$types = new \Zend\Form\Element\Select("typeid");
		$types->setValueOptions($list);
		$types->setAttributes(array(
			"id" => "typeid",
			"style" => "width: 250px;"	
		));
		$types->setOptions(array(
			"label" => "Advertisement Type"	
		));
			
		$this->add($types);
		
		$cats = array();
		foreach($advertisementCategories as $category){
			$cats[$category->id()] = $category->name();
		} // foreach
		
		$categories = new \Zend\Form\Element\Select('categories');
		$categories->setValueOptions($cats);
		$categories->setAttributes(array(
			"id" => "categories",
			"style" => "width: 250px;",
			"multiple" => "multiple"
		));
		$categories->setOptions(array(
			"label" => "Target Categories"	
		));
		
		$this->add($categories);
		
		$upload = new \Zend\Form\Element\File();
		$upload->setName("bannerimage");
		$upload->setAttributes(array(
			"id" => "bannerimage"	
		));
		$upload->setOptions(array(
			"label"	=> "Banner Image"
		));
		
		$this->add($upload);	
	} // ctor
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new InputFilter();
		$factory = new InputFactory();

		$inputFilter->add($factory->createInput(array(
			'name' => 'name',
			'required' => true,
			'filters' => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => `150`
					)		
				)		
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "description",
			"required" => false	
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "url",
			"requred" => "true",
			"filters" => array(
				array("name" => "StringTrim")
			),
			"validtors" => array(
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => 300
					)
				)
			)	
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "typeid",
			"required" => true,
			"filters" => array(
				array("name" => "Int")
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "categories",
			"required" => true
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "bannerimage",
			"required" => true,
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