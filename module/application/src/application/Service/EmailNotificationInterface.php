<?php

namespace Application\Service;

interface EmailNotificationInterface
{
	function setServerSettings(array $options);
	function setRecipients(array $recipients);
	function setSender($sender, $name='');
	function setSubject($subject);
	function setHtmlBody($htmlBody);
	function setCCList(array $ccList);
	function setBCCList(array $bccList);
	function send();
}