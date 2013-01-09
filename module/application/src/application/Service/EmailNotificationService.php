<?php

namespace Application\Service;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class PrizeWheelEmailNotificationService implements EmailNotificationInterface
{
	protected $smtpTransport = null;
	protected $recipients = array();
	protected $senderAddress = "";
	protected $senderName = "";
	protected $subject = "";
	protected $htmlBody = "";
	protected $ccList = array();
	protected $bccList = array();
	
	public function __construct()
	{
		
	}
	
	public function setServerSettings(array $options)
	{
		$smtpTransport = new SmtpTransport();
		$options = new SmtpOptions($options);
		$smtpTransport->setOptions($options);
		$this->smtpTransport = $smtpTransport;
	}
	
	public function setRecipients(array $recipients)
	{
		$this->recipients = $recipients;
	}
	
	public function setSender($sender, $name='')
	{
		$this->senderAddress = $sender;
		$this->senderName = $name;
	}
	
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
	
	public function setHtmlBody($htmlBody)
	{
		$this->htmlBody = $htmlBody;
	}
	
	public function setCCList(array $ccList)
	{
		$this->ccList = $ccList;
	}
	
	public function setBCCList(array $bccList)
	{
		$this->bccList = $bccList;
	}
	
	public function send()
	{
		$message = new Message();
		
		$message->addFrom($this->senderAddress, $this->senderName)
				->addTo($this->recipients)
				->addBcc($this->bccList)
				->addCC($this->ccList)
				->setSubject($this->subject)
				->setBody($this->htmlBody);
		
		try{
			$this->smtpTransport->send($message);
		} // try
		catch(\Exception $e){
			throw new \Exception("There was an error sending the E-Mail", null, $e);
		} // catch
	}
}