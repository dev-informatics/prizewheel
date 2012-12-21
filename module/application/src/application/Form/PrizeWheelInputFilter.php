<?php

namespace Application\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class PrizeWheelInputFilter extends InputFilter
{
	protected $factory = null;
	
	public function __construct()
	{
		$factory = new InputFactory();
		$this->factory = $factory;
			
		$this->add($factory->createInput(array(
			'name' => 'prizewheeltypeid',
			'required' => true,
			'filters' => array(
				array('name' => 'Int')
			),
			'validators' => array(
				array('name' => 'Digits')
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'forcelike',
			'required' => true,
			'filters' => array(
				array('name' => 'Boolean')
			)
		))); 
		$this->add($factory->createInput(array(
			'name' => 'forcelikeimage',
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
						'max' => 255
					)
				)
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'firsttext',
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
						'max' => 500
					)		
				)
			)	
		))); 
		$this->add($factory->createInput(array(
			'name' => 'validemail',
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
						'max' => 500
					)		
				)
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'alreadyplayed',
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
						'max' => 500
					)
				)
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'errorsubmit',
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
						'max' => 500
					)
				)
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'errorprize',
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
						'max' => 500
					)
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'accesserror',
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
						'max' => 500
					)
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'accesslimit',
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
						'max' => 500
					)
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'textrules',
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
						'max' => 500
					)
				)
			)
		)));
		
		$this->createPrizeInputs();
		
		$this->add($factory->createInput(array(
			'name' => 'sponserimage',
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
						'max' => 300
					)		
				)
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'sponserlink',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim')
			),
			'validators' => array(
				array('name' => 'Hostname'),
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' => 500
					)
				)
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'backimage',
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
						'max' => 300
					)		
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'topimage',
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
						'max' => 300
					)
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'buttonimage',
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
						'max' => 300
					)
				)
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'sendemailnotifications',
			'required' => true,
			'filters' => array(
				array('name' => 'Boolean')
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'notificationemailaddress',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim')
			),
			'validators' => array(
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
			'name' => 'smtpserver',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim')
			),
			'validators' => array(
				array('name' => 'Hostname'),
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
		$this->add($factory->createInput(array(
			'name' => 'smtpusername',
			'required' => false,
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
		$this->add($factory->createInput(array(
			'name' => 'smtppassword',
			'required' => false,
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
		$this->add($factory->createInput(array(
			'name' => 'smtpport',
			'required' => false,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'Int')
			),
			'validators' => array(
				array('name' => 'Digits')
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'smtpfromaddress',
			'required' => false,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim')
			),
			'validators' => array(
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
			'name' => 'smtpencryption',
			'required' => false,
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
		$this->add($factory->createInput(array(
			'name' => 'smtpauthmethod',
			'required' => false,
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
		$this->add($factory->createInput(array(
			'name' => 'notificationemailsubject',
			'required' => false,
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
		$this->add($factory->createInput(array(
			'name' => 'notificationemailbody',
			'required' => false,
			'filters' => array(
				array('name' => 'StringTrim')
			)
		)));
		$this->add($factory->createInput(array(
			'name' => 'ipaddressfilter',
			'required' => true,
			'filters' => array(
				array('name' => 'Boolean')
			)	
		)));
		$this->add($factory->createInput(array(
			'name' => 'emailfilter',
			'required' => true,
			'filters' => array(
				array('name' => 'Boolean')
			)
		)));
	}
	
	private function createPrizeInputs()
	{
		$factory = $this->factory;
		
		for($i = 1; $i <= 12; $i++){
			
			$text = $this->getNumericalTextRepresentation($i);
			
			$this->add($factory->createInput(array(
				'name' => 'prize'.$text.'name',
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
			$this->add($factory->createInput(array(
				'name' => 'prize'.$text.'code',
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
			$this->add($factory->createInput(array(
				'name' => 'prize'.$text.'text',
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
							'max' => 50
						)
					)
				)
			)));			
			$this->add($factory->createInput(array(
				'name' => 'prize'.$text.'textsize',
				'required' => true,
				'filters' => array(
					array('name' => 'Int')
				),
				'validators' => array(
					array('name' => 'Digits')
				)
			)));
			$this->add($factory->createInput(array(
				'name' => 'prize'.$text.'image',
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
							'max' => 500
						)
					)
				)
			)));			
			$this->add($factory->createInput(array(
				'name' => 'prize'.$text.'url',
				'required' => true,
				'filters' => array(
					array('name' => 'StringTrim')
				),
				'validators' => array(
					array('name' => 'Hostname'),
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 500
						)
					)
				)	
			)));
			$this->add($factory->createInput(array(
				'name' => 'prize'.$text.'weight',
				'required' => true,
				'filters' => array(
					array('name' => 'Int')
				),
				'validators' => array(
					array('name' => 'Digits')
				)
			)));			
		} // for
	}
	
	private function getNumericalTextRepresentation($number)
	{
		$number = (int)$number;
		
		switch($number){
			case 1:
				return "one";
			case 2:
				return "two";
			case 3:
				return "three";
			case 4:
				return "four";
			case 5:
				return "five";
			case 6:
				return "six";
			case 7:
				return "seven";
			case 8:
				return "eight";
			case 9:
				return "nine";
			case 10:
				return "ten";
			case 11:
				return "eleven";
			case 12:
				return "twelve";
		}
		
		return "";
	}
}