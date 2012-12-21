<?php

namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element\Checkbox;

class ManagePersonalizedPrizeWheelForm extends Form
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
		
		$forceLike = new \Zend\Form\Element\Checkbox("forcelike");
		$forceLike->setAttributes(array(
			'id' => 'forcelike'	
		));
		$forceLike->setOptions(array(
			'label' => 'Force Like'	
		));
		$this->add($forceLike);
		
		$this->add(array(
			'name' => 'forcelikeimage',
			'attributes' => array(
				'id' => 'forcelikeimage',
				'type' => 'file'
			),
			'options' => array(
				'label' => 'Force Like Image'
			)		
		));
		
		$firstText = new \Zend\Form\Element\Textarea('firsttext');
		$firstText->setAttributes(array(
			'id' => 'firsttext',
			'style' => 'width: 400px; height: 150px;'	
		));
		$firstText->setOptions(array(
			'label' => 'First Text'		
		));		
		$this->add($firstText);
		
		$rulesText = new \Zend\Form\Element\Textarea("rulestext");
		$rulesText->setAttributes(array(
			'id' => 'rulestext',
			'style' => 'width: 400px; height: 150px;'	
		));
		$rulesText->setOptions(array(
			'label' => 'Rules Text'	
		)); 
		$this->add($rulesText);
		
		$ipAddressFilter = new Checkbox("ipaddressfilter");
		$ipAddressFilter->setAttributes(array(
			'id' => 'ipaddressfilter',	
		));
		$ipAddressFilter->setOptions(array(
			'label' => 'Filter by IP Address'	
		));
		$this->add($ipAddressFilter);
		
		$phoneFilter = new Checkbox("phonefilter");
		$phoneFilter->setAttributes(array(
			'id' => 'phonefilter'	
		));
		$phoneFilter->setOptions(array(
			'label' => 'Filter by Telephone'	
		));
		$this->add($phoneFilter);
		
		$emailFilter = new Checkbox("emailfilter");
		$emailFilter->setAttributes(array(
			'id' => 'emailfilter'	
		));
		$emailFilter->setOptions(array(
			'label' => 'Filter by E-Mail Address'	
		));
		$this->add($emailFilter);
		
		$this->add(array(
			'name' => 'validemail',
			'attributes' => array(
				'id' => 'validemail',
				'type' => 'text',
				'style' => 'width: 300px;'
			),
			'options' => array(
				'label' => 'Invalid E-Mail Address'
			)	 
		));
		
		$this->add(array(
			'name' => 'alreadyplayed',
			'attributes' => array(
				'id' => 'alreadyplayed',
				'type' => 'text',
				'style' => 'width: 300px;'
			),
			'options' => array(
				'label' => 'Already Played'
			)	
		));
		
		$this->add(array(
			'name' => 'errorsubmit',
			'attributes' => array(
				'id' => 'errorsubmit',
				'type' => 'text',
				'style' => 'width: 300px;'
			),
			'options' => array(
				'label' => 'Submission Error'
			)	
		));
		
		$this->add(array(
			'name' => 'errorprize',
			'attributes' => array(
				'id' => 'errorprize',
				'type' => 'text',
				'style' => 'width: 300px;'
			),
			'options' => array(
				'label' => 'Prize Calculation Failure'
			)
		));
		
		$this->add(array(
			'name' => 'accesserror',
			'attributes' => array(
				'id' => 'accesserror',
				'type' => 'text',
				'style' => 'width: 300px;'
			),
			'options' => array(
				'label' => 'Access Error'
			)
		));
		
		$this->add(array(
			'name' => 'accesslimit',
			'attributes' => array(
				'id' => 'accesslimit',
				'type' => 'text',
				'style' => 'width: 300px;'
			),
			'options' => array(
				'label' => 'Access Limit'
			)
		));
		
		foreach($this->getPrizeNameNumericalStrings() as $number){
			$this->add(array(
				"name" => "prize" . $number . "name",
				"attributes" => array(
					"id" => "prize" . $number . "name",
					"type" => 'text',
					"maxlength" => 50,
					"style" => "width: 175px;"
				),
				"options" => array(
					"label" => "Prize " . ucfirst($number) . " Name"
				)
			));
			
			$this->add(array(
				"name" => "prize" . $number . "code",
				"attributes" => array(
					"id" => "prize" . $number . "code",
					"type" => "text",
					"maxlength" => 50,
					"style" => "width: 175px"
				),
				"options" => array(
					"label" => "Prize " . ucfirst($number) . " Code"
				)	 
			));
			
			$this->add(array(
				"name" => "prize" . $number . "text",
				"attributes" => array(
					"id" => "prize" . $number . "text",
					"type" => "text",
					"maxlength" => 50,
					"style" => "width: 175px"
				),
				"options" => array(
					"label" => "Prize " . ucfirst($number) . " Text"
				)
			));
			
			$this->add(array(
				"name" => "prize" . $number . "image",
				"attributes" => array(
					"id" => "prize" . $number . "image",
					"type" => "file",
					"maxlength" => 300
				),
				"options" => array(
					"label" => "Prize " . ucfirst($number) . " Image"
				)
			));
			
			$this->add(array(
				"name" => "prize" . $number . "url",
				"attributes" => array(
					"id" => "prize" . $number . "url",
					"type" => "text",
					"maxlength" => 500,
					"style" => "width: 300px"
				),
				"options" => array(
					"label" => "Prize " . ucfirst($number) . " URL"
				)
			));
			
			$this->add(array(
				"name" => "prize" . $number . "weight",
				"attributes" => array(
					"id" => "prize" . $number . "weight",
					"type" => "text",
					"maxlength" => 3,
					"style" => "width: 120px"
				),
				"options" => array(
					"label" => "Prize " . ucfirst($number) . " Weight"
				)
			));
		}
		
		$this->add(array(
			'name' => 'backimage',
			'attributes' => array(
				'id' => 'backimage',
				'type' => 'file'
			),
			'options' => array(
				'label' => 'Back Image'
			)
		));
		
		$this->add(array(
			'name' => 'topimage',
			'attributes' => array(
				'id' => 'topimage',
				'type' => 'file'
			),
			'options' => array(
				'label' => 'Top Image'
			)
		));
		
		$this->add(array(
			'name' => 'buttonimage',
			'attributes' => array(
				'id' => 'buttonimage',
				'type' => 'file'
			),
			'options' => array(
				'label' => 'Button Image'
			)
		));
		
		$sendEmails = new Checkbox("sendemailnotifications");
		$sendEmails->setAttributes(array(
			"id" => "sendemailnotifications"	
		));
		$sendEmails->setOptions(array(
			"label" => "Send E-Mail Notifications"	
		));
		$this->add($sendEmails);
		
		$this->add(array(
			"name" => "notificationemailaddress",
			"attributes" => array(
				"id" => "notificationemailaddress",
				"type" => "text",
				"maxlength" => 300,
				"style" => "width: 400px"
			),
			"options" => array(
				"label" => "Notification E-Mail Address"
			)	
		));
		
		$this->add(array(
			"name" => "smtpserver",
			"attributes" => array(
				"id" => "smtpserver",
				"type" => "text",
				"maxlength" => 100,
				"style" => "width: 150px;"
			),
			"options" => array(
				"label" => "SMTP Server"
			)		
		));
		
		$this->add(array(
			"name" => "smtpusername",
			"attributes" => array(
				"id" => "smtpusername",
				"type" => "text",
				"maxlength" => 150,
				"style" => "width: 150px"
			),
			"options" => array(
				"label" => "SMTP User Name"
			)	
		));
		
		$this->add(array(
			"name" => "smtppassword",
			"attributes" => array(
				"id" => "smtppassword",
				"type" => "text",
				"maxlength" => 50,
				"style" => "width: 150px;"
			),
			"options" => array(
				"label" => "SMTP Password"
			)	
		));
		
		$this->add(array(
			"name" => "smtpport",
			"attributes" => array(
				"id" => "smtpport",
				"type" => "text",
				"maxlength" => 5,
				"style" => "width: 75px"
 			),
			"options" => array(
				"label" => "SMTP Port"
			)	
		));

		$this->add(array(
			"name" => "smtpfromaddress",
			"attributes" => array(
				"id" => "smtpfromaddress",
				"type" => "text",
				"maxlength" => 150,
				"style" => "width: 150px"
			),
			"options" => array(
				"label" => "SMTP From Address"
			)
		));
		
		$smtpEncryption = new \Zend\Form\Element\Select("smtpencryption");
		$smtpEncryption->setValueOptions(array(
			"none" => "NONE",
			"ssl" => "SSL",
			"tsl" => "TSL"	
		));
		$smtpEncryption->setAttributes(array(
			'id' => 'smtpencryption',
			'style' => "width: 100px;"	
		));
		$smtpEncryption->setOptions(array(
			"label" => "SMTP Encryption"	
		));
		$this->add($smtpEncryption);
		
		$smtpAuth = new \Zend\Form\Element\Select("smtpauthmethod");
		$smtpAuth->setValueOptions(array(
			"plain" => "PLAIN",
			"login" => "LOGIN",
			"crammd5" => "CRAMMD5"	
		));
		$smtpAuth->setAttributes(array(
			"id" => "smtpauthmethod",
			"style" => "width: 100px;"		
		));
		$smtpAuth->setOptions(array(
			"label" => "SMTP Auth Method"	
		));
		$this->add($smtpAuth);
		
		$this->add(array(
			"name" => "notificationemailsubject",
			"attributes" => array(
				"id" => "notificationemailsubject",
				"type" => "text",
				"style" => "width: 300px;",
				"maxlength" => 300
			),
			"options" => array(
				"label" => "Email Subject"
			)	
		));
		
		$emailBody = new \Zend\Form\Element\Textarea("notificationemailbody");
		$emailBody->setAttributes(array(
			"id" => "notificationemailbody",
			"style" => "width: 300px; height: 150px;"	
		));
		$emailBody->setOptions(array(
			"label" => "Email Body"	
		));
		$this->add($emailBody);
		
		$this->inputFilter = $this->getDefaultInputFilter();
	}
	
	public function getDefaultInputFilter()
	{
		$inputFilter = new InputFilter();
		$factory = new InputFactory();
		
		$inputFilter->add($factory->createInput(array(
			"name" => "categories",
			"required" => "false"	
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "forcelike",
			"required" => false	
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "forcelikeimage",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => 255
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "firsttext",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
					"encoding" => "UTF-8",
						"min" => 1,
						"max" => 500
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "rulestext",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
					"encoding" => "UTF-8",
						"min" => 1,
						"max" => 500
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "ipaddressfilter",
			"required" => true	
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "phonefilter",
			"required" => true	
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "emailfilter",
			"required" => true	
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "validemail",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => 500
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "alreadyplayed",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => 500
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "errorsubmit",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => 500
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "errorprize",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => 500
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "accesserror",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => 500
					)
				)
			)
		)));
		
		$inputFilter->add($factory->createInput(array(
			"name" => "accesslimit",
			"required" => false,
			"filters" => array(
				array("name" => "StringTrim"),
				array("name" => "StripTags")
			),
			"validators" => array(
				array("name" => "NotEmpty"),
				array(
					"name" => "StringLength",
					"options" => array(
						"encoding" => "UTF-8",
						"min" => 1,
						"max" => 500
					)
				)
			)
		)));
		
		foreach($this->getPrizeNameNumericalStrings() as $numerical){
			
			$inputFilter->add($factory->createInput(array(
				"name" => "prize".$numerical."name",
				"required" => false,
				"filters" => array(
					array("name" => "StringTrim"),
					array("name" => "StripTags")
				),
				"validators" => array(
					array("name" => "NotEmpty"),
					array(
						"name" => "StringLength",
						"options" => array(
							"encoding" => "UTF-8",
							"min" => 1,
							"max" => 50
						)
					)
				)
			)));
			
			$inputFilter->add($factory->createInput(array(
				"name" => "prize".$numerical."code",
				"required" => false,
				"filters" => array(
					array("name" => "StringTrim"),
					array("name" => "StripTags")
				),
				"validators" => array(
					array("name" => "NotEmpty"),
					array(
						"name" => "StringLength",
						"options" => array(
							"encoding" => "UTF-8",
							"min" => 1,
							"max" => 50
						)
					)
				)
			)));
			
			$inputFilter->add($factory->createInput(array(
				"name" => "prize".$numerical."text",
				"required" => false,
				"filters" => array(
					array("name" => "StringTrim"),
					array("name" => "StripTags")
				),
				"validators" => array(
					array("name" => "NotEmpty"),
					array(
						"name" => "StringLength",
						"options" => array(
							"encoding" => "UTF-8",
							"min" => 1,
							"max" => 50
						)
					)
				)
			)));
			
			$inputFilter->add($factory->createInput(array(
				"name" => "prize".$numerical."image",
				"required" => true,
				"filters" => array(
					array("name" => "StringTrim"),
					array("name" => "StripTags")
				),
				"validators" => array(
					array("name" => "NotEmpty"),
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
				"name" => "prize".$numerical."url",
				"required" => true,
				"filters" => array(
					array("name" => "StringTrim"),
					array("name" => "StripTags")
				),
				"validators" => array(
					array("name" => "Hostname"),
					array("name" => "NotEmpty"),
					array(
						"name" => "StringLength",
						"options" => array(
							"encoding" => "UTF-8",
							"min" => 1,
							"max" => 500
						)		 
					)
				)
			)));
			
			$inputFilter->add($factory->createInput(array(
				"name" => "prize".$numerical."weight",
				"required" => true,
				"filters" => array(
					array("name" => "Int")
				),
				"validators" => array(
					array("name" => "NotEmpty"),
					array("name" => "Digits")
				)
			)));
		} // foreach
		
		return $inputFilter;
	}
	
	private function getPrizeNameNumericalStrings()
	{
		return array(
			"one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve"	
		);
	}
}