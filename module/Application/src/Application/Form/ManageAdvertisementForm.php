<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class ManageAdvertisementForm extends Form
{
	protected $inputFilter = null;
	
	public function __construct($name='', $advertisementcategories=array())
	{
		parent::__construct("manage-advertisement-form");
		$this->setAttribute("method", "post");
		
		$this->add(array(
			"name" => "name",
			"attributes" => array(
				"id" => "name",
				"type" => "text",
				"maxlength" => 150
			),
			"options" => array(
				"label" => "Name"
			)	
		));		
		$this->add(array(
			"type" => 'Zend\Form\Element\Textarea',
			"name" => "description",
			"attributes" => array(
				"id" => "description",
				"style" => "height: 150px; width: 300px;"
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
		
		$categoryOptions = array();
		foreach($advertisementcategories as $category){
			$categoryOptions[$category->id()] = $category->name();
		}		
		
		$select = new \Zend\Form\Element\Select("categories");
		$select->setValueOptions($categoryOptions);
		
		$select->setAttributes(array(
			'id' => "categories",
			"style" => "width: 250px;",
			"multiple" => "multiple"	
		));
		$select->setOptions(array(
			"label" => "Target Categories"	
		));
		
		$this->add($select);	
		
		$upload = new \Zend\Form\Element\File();
		$upload->setName("bannerimage");
		$upload->setAttributes(array(
				"id" => "bannerimage"
		));
		$upload->setOptions(array(
				"label"	=> "Banner Image"
		));
		
		$this->add($upload);
		
		$sponserUpload = new \Zend\Form\Element\File();
		$sponserUpload->setName("sponserimage");
		$sponserUpload->setAttributes(array(
				"id" => "sponserimage"
		));
		$sponserUpload->setOptions(array(
				"label"	=> "Sponser Image"
		));
		
		$this->add($sponserUpload);
		
		$enabled = new \Zend\Form\Element\Checkbox("enabled");
		$enabled->setAttributes(array(
			'id' => "enabled"	
		));
		$enabled->setOptions(array(
			"label" => "Enabled"	
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
 			'name' => 'description',
 			'required' => false,
 			'filters' => array(
 				array('name' => 'StripTags')
 			)	
 		)));
 		$inputFilter->add($factory->createInput(array(
 			'name' => 'url',
 			'required' => true,
 			'filters' => array(
 				array('name' => 'StringTrim')
 			),
 			'validators' => array(
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
 		$inputFilter->add($factory->createInput(array(
 			'name' => 'categories',
 			'required' => false	
 		)));
 		$inputFilter->add($factory->createInput(array(
 			"name" => "bannerimage",
 			"required" => false 
 		))); 	
 		$inputFilter->add($factory->createInput(array(
 			"name" => "sponserimage",
 			"required" => false,
 			"filters" => array(
 				array("name" => "StringTrim"),
 				array("name" => "StripTags")
 			),
 			"validators" => array(
 				array(
 					"name" => "StringLength",
 					"options" => array(
 						"encoding" => "UTF-8",
 						"min" => 1,
 						"max" => 150
 					)
 				)
 			)
 		)));
 		$inputFilter->add($factory->createInput(array(
 			"name" => "enabled",
 			"required" => false	
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