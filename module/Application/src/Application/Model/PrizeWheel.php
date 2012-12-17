<?php

namespace Application\Model;

class PrizeWheel
{
	protected $id;
	protected $pageId;
	protected $affiliateId;
	protected $forceLike = false;
	protected $forceLikeImage;
	protected $firstText = "Spin the wheel for your chance to win a prize today!";
	protected $validEmail = "Please enter a valid E-Mail.";
	protected $alreadyPlayed = "You have already played!";
	protected $errorSubmit = "There has been a submission error!";
	protected $errorPrize = "There has been an error calculating the Prize!";
	protected $accessError = "There has been an Access error!";
	protected $accessLimit = "You have reached your Access Limit!";
	protected $textRules = "You must agree to the terms and conditions to play.";
	protected $prizeOneName;
	protected $prizeOneCode;
	protected $prizeOneText;
	protected $prizeOneTextSize = 10;
	protected $prizeOneImage;
	protected $prizeOneUrl;
	protected $prizeOneWeight = 0;
	protected $prizeTwoName = "Try Again";
	protected $prizeTwoCode = "Try Again";
	protected $prizeTwoText = "Try Again";
	protected $prizeTwoTextSize = 10;
	protected $prizeTwoImage;
	protected $prizeTwoUrl;
	protected $prizeTwoWeight = 0;
	protected $prizeThreeName;
	protected $prizeThreeCode;
	protected $prizeThreeText;
	protected $prizeThreeTextSize = 10;
	protected $prizeThreeImage;
	protected $prizeThreeUrl;
	protected $prizeThreeWeight = 0;
	protected $prizeFourName = "Try Again";
	protected $prizeFourCode = "Try Again";
	protected $prizeFourText = "Try Again";
	protected $prizeFourTextSize = 10;
	protected $prizeFourImage;
	protected $prizeFourUrl;
	protected $prizeFourWeight = 0;
	protected $prizeFiveName;
	protected $prizeFiveCode;
	protected $prizeFiveText;
	protected $prizeFiveTextSize = 10;
	protected $prizeFiveImage;
	protected $prizeFiveUrl;
	protected $prizeFiveWeight = 0;
	protected $prizeSixName = "Try Again";
	protected $prizeSixCode = "Try Again";
	protected $prizeSixText = "Try Again";
	protected $prizeSixTextSize = 10;
	protected $prizeSixImage;
	protected $prizeSixUrl;
	protected $prizeSixWeight = 0;
	protected $prizeSevenName;
	protected $prizeSevenCode;
	protected $prizeSevenText;
	protected $prizeSevenTextSize = 10;
	protected $prizeSevenImage;
	protected $prizeSevenUrl;
	protected $prizeSevenWeight = 0;
	protected $prizeEightName = "Try Again";
	protected $prizeEightCode = "Try Again";
	protected $prizeEightText = "Try Again";
	protected $prizeEightTextSize = 10;
	protected $prizeEightImage;
	protected $prizeEightUrl;
	protected $prizeEightWeight = 0;
	protected $prizeNineName;
	protected $prizeNineCode;
	protected $prizeNineText;
	protected $prizeNineTextSize = 10;
	protected $prizeNineImage;
	protected $prizeNineUrl;
	protected $prizeNineWeight = 0;
	protected $prizeTenName = "Try Again";
	protected $prizeTenCode = "Try Again";
	protected $prizeTenText = "Try Again";
	protected $prizeTenTextSize = 10;
	protected $prizeTenImage;
	protected $prizeTenUrl;
	protected $prizeTenWeight = 0;
	protected $prizeElevenName;
	protected $prizeElevenCode;
	protected $prizeElevenText;
	protected $prizeElevenTextSize = 10;
	protected $prizeElevenImage;
	protected $prizeElevenUrl;
	protected $prizeElevenWeight = 0;
	protected $prizeTwelveName = "Try Again";
	protected $prizeTwelveCode = "Try Again";
	protected $prizeTwelveText = "Try Again";
	protected $prizeTwelveTextSize = 10;
	protected $prizeTwelveImage;
	protected $prizeTwelveUrl;
	protected $prizeTwelveWeight = 0;
	protected $sponserImage;
	protected $sponserLink;
	protected $backImage;
	protected $topImage;
	protected $buttonImage;
	protected $sendEmailNotifications = 0;
	protected $notificationEmailAddress;
	protected $smtpServer;
	protected $smtpUserName;
	protected $smtpPassword;
	protected $smtpPort = 25;
	protected $smtpFromAddress;
	protected $smtpEncryption = "none";
	protected $smtpAuthMethod = "plain";
	protected $notificationEmailSubject = "Thank you for playing the Prize Wheel";
	protected $notificationEmailBody = "Congratulations,<br/><br/>Here is your Prize Wheel spin results: @prize<br/>";
	protected $ipAddressFilter = false;
	protected $phoneFilter = false;
	protected $emailFilter = false;
	protected $enabled = true;
	protected $createDateTime;
	
	public function id($id=0)
	{
		if(is_int($id) && $id > 0){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function pageId($pageid='')
	{
		if(!empty($pageid)){
			$this->pageId = $pageid;
		} // if
		return $this->pageId;
	}
	
	public function forceLike($forcelike=null)
	{
		if(is_bool($forcelike)){
			$this->forceLike = $forcelike;
		} // if
		return $this->forceLike;
	}
	
	public function forceLikeImage($forcelikeimage)
	{
		if(!empty($forcelikeimage)){
			$this->forceLikeImage = $forcelikeimage;
		} // if
		return $this->forceLikeImage;
	}
	
	public function firstText($firsttext='')
	{
		if(!empty($firsttext)){
			$this->firstText = $firsttext;
		} // if
		return $this->firstText;
	}
	
	public function validEmail($validemail='')
	{
		if(!empty($validemail)){
			$this->validEmail = $validemail;	
		} // if
		return $this->validEmail;		
	}
	
	public function alreadyPlayed($alreadyplayed='')
	{
		if(!empty($alreadyplayed)){
			$this->alreadyPlayed = $alreadyplayed;
		} // if
		return $this->alreadyPlayed;		
	}
	
	public function errorSubmit($errorsubmit='')
	{
		if(!empty($errorsubmit)){
			$this->errorSubmit = $errorsubmit;
		} // if
		return $this->errorSubmit;
	}
	
	public function errorPrize($errorprize='')
	{
		if(!empty($errorprize)){
			$this->errorPrize = $errorprize;
		} // if
		return $this->errorPrize;
	}
	
	public function accessError($accesserror='')
	{
		if(!empty($accesserror)){
			$this->accessError = $accesserror;
		} // if
		return $this->accessError;
	}
	
	public function accessLimit($accesslimit='')
	{
		if(!empty($accesslimit)){
			$this->accessLimit = $accesslimit;
		} // if
		return $this->accessLimit;		
	}
	
	public function textRules($textrules='')
	{
		if(!empty($textrules)){
			$this->textRules = $textrules;
		} // if
		return $this->textRules;
	}
	
	public function prizeOneName($name='')
	{
		if(!empty($name)){
			$this->prizeOneName = $name;
		} // if
		return $this->prizeOneName;
	}
	
	public function prizeOneCode($code='')
	{
		if(!empty($code)){
			$this->prizeOneCode = $code;
		} // if
		return $this->prizeOneCode;
	}
	
	public function prizeOneText($text='')
	{
		if(!empty($text)){
			$this->prizeOneText = $text;
		} // if
		return $this->prizeOneText;
	}
	
	public function prizeOneTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeOneTextSize = $textsize;
		} // if
		return $this->prizeOneTextSize;
	}
	
	public function prizeOneImage($image='')
	{
		if(!empty($image)){
			$this->prizeOneImage = $image;
		} // if
		return $this->prizeOneImage;
	}
	
	public function prizeOneUrl($url='')
	{
		if(!empty($url)){
			$this->prizeOneUrl = $url;
		} // if
		return $this->prizeOneUrl;
	}
	
	public function prizeOneWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeOneWeight = weight;
		} // if
		return $this->prizeOneWeight;
	}
	
	public function prizeTwoName($name='')
	{
		if(!empty($name)){
			$this->prizeTwoName = $name;
		} // if
		return $this->prizeTwoName;
	}
	
	public function prizeTwoCode($code='')
	{
		if(!empty($code)){
			$this->prizeTwoCode = $code;
		} // if
		return $this->prizeTwoCode;
	}
	
	public function prizeTwoText($text='')
	{
		if(!empty($text)){
			$this->prizeTwoText = $text;
		} // if
		return $this->prizeTwoText;
	}
	
	public function prizeTwoTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeTwoTextSize = $textsize;
		} // if
		return $this->prizeTwoTextSize;
	}
	
	public function prizeTwoImage($image='')
	{
		if(!empty($image)){
			$this->prizeTwoImage = $image;
		} // if
		return $this->prizeTwoImage;
	}
	
	public function prizeTwoUrl($url='')
	{
		if(!empty($url)){
			$this->prizeTwoUrl = $url;
		} // if
		return $this->prizeTwoUrl;
	}
	
	public function prizeTwoWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeTwoWeight = weight;
		} // if
		return $this->prizeTwoWeight;
	}
	
	public function prizeThreeName($name='')
	{
		if(!empty($name)){
			$this->prizeThreeName = $name;
		} // if
		return $this->prizeThreeName;
	}
	
	public function prizeThreeCode($code='')
	{
		if(!empty($code)){
			$this->prizeThreeCode = $code;
		} // if
		return $this->prizeThreeCode;
	}
	
	public function prizeThreeText($text='')
	{
		if(!empty($text)){
			$this->prizeThreeText = $text;
		} // if
		return $this->prizeThreeText;
	}
	
	public function prizeThreeTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeThreeTextSize = $textsize;
		} // if
		return $this->prizeThreeTextSize;
	}
	
	public function prizeThreeImage($image='')
	{
		if(!empty($image)){
			$this->prizeThreeImage = $image;
		} // if
		return $this->prizeThreeImage;
	}
	
	public function prizeThreeUrl($url='')
	{
		if(!empty($url)){
			$this->prizeThreeUrl = $url;
		} // if
		return $this->prizeThreeUrl;
	}
	
	public function prizeThreeWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeThreeWeight = weight;
		} // if
		return $this->prizeThreeWeight;
	}
	
	public function prizeFourName($name='')
	{
		if(!empty($name)){
			$this->prizeFourName = $name;
		} // if
		return $this->prizeFourName;
	}
	
	public function prizeFourCode($code='')
	{
		if(!empty($code)){
			$this->prizeFourCode = $code;
		} // if
		return $this->prizeFourCode;
	}
	
	public function prizeFourText($text='')
	{
		if(!empty($text)){
			$this->prizeFourText = $text;
		} // if
		return $this->prizeFourText;
	}
	
	public function prizeFourTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeFourTextSize = $textsize;
		} // if
		return $this->prizeFourTextSize;
	}
	
	public function prizeFourImage($image='')
	{
		if(!empty($image)){
			$this->prizeFourImage = $image;
		} // if
		return $this->prizeFourImage;
	}
	
	public function prizeFourUrl($url='')
	{
		if(!empty($url)){
			$this->prizeFourUrl = $url;
		} // if
		return $this->prizeFourUrl;
	}
	
	public function prizeFourWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeFourWeight = weight;
		} // if
		return $this->prizeFourWeight;
	}
	
	public function prizeFiveName($name='')
	{
		if(!empty($name)){
			$this->prizeFiveName = $name;
		} // if
		return $this->prizeFiveName;
	}
	
	public function prizeFiveCode($code='')
	{
		if(!empty($code)){
			$this->prizeFiveCode = $code;
		} // if
		return $this->prizeFiveCode;
	}
	
	public function prizeFiveText($text='')
	{
		if(!empty($text)){
			$this->prizeFiveText = $text;
		} // if
		return $this->prizeFiveText;
	}
	
	public function prizeFiveTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeFiveTextSize = $textsize;
		} // if
		return $this->prizeFiveTextSize;
	}
	
	public function prizeFiveImage($image='')
	{
		if(!empty($image)){
			$this->prizeFiveImage = $image;
		} // if
		return $this->prizeFiveImage;
	}
	
	public function prizeFiveUrl($url='')
	{
		if(!empty($url)){
			$this->prizeFiveUrl = $url;
		} // if
		return $this->prizeFiveUrl;
	}
	
	public function prizeFiveWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeFiveWeight = weight;
		} // if
		return $this->prizeFiveWeight;
	}
	
	public function prizeSixName($name='')
	{
		if(!empty($name)){
			$this->prizeSixName = $name;
		} // if
		return $this->prizeSixName;
	}
	
	public function prizeSixCode($code='')
	{
		if(!empty($code)){
			$this->prizeSixCode = $code;
		} // if
		return $this->prizeSixCode;
	}
	
	public function prizeSixText($text='')
	{
		if(!empty($text)){
			$this->prizeSixText = $text;
		} // if
		return $this->prizeSixText;
	}
	
	public function prizeSixTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeSixTextSize = $textsize;
		} // if
		return $this->prizeSixTextSize;
	}
	
	public function prizeSixImage($image='')
	{
		if(!empty($image)){
			$this->prizeSixImage = $image;
		} // if
		return $this->prizeSixImage;
	}
	
	public function prizeSixUrl($url='')
	{
		if(!empty($url)){
			$this->prizeSixUrl = $url;
		} // if
		return $this->prizeSixUrl;
	}
	
	public function prizeSixWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeSixWeight = weight;
		} // if
		return $this->prizeSixWeight;
	}
	
	public function prizeSevenName($name='')
	{
		if(!empty($name)){
			$this->prizeSevenName = $name;
		} // if
		return $this->prizeSevenName;
	}
	
	public function prizeSevenCode($code='')
	{
		if(!empty($code)){
			$this->prizeSevenCode = $code;
		} // if
		return $this->prizeSevenCode;
	}
	
	public function prizeSevenText($text='')
	{
		if(!empty($text)){
			$this->prizeSevenText = $text;
		} // if
		return $this->prizeSevenText;
	}
	
	public function prizeSevenTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeSevenTextSize = $textsize;
		} // if
		return $this->prizeSevenTextSize;
	}
	
	public function prizeSevenImage($image='')
	{
		if(!empty($image)){
			$this->prizeSevenImage = $image;
		} // if
		return $this->prizeSevenImage;
	}
	
	public function prizeSevenUrl($url='')
	{
		if(!empty($url)){
			$this->prizeSevenUrl = $url;
		} // if
		return $this->prizeSevenUrl;
	}
	
	public function prizeSevenWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeSevenWeight = weight;
		} // if
		return $this->prizeSevenWeight;
	}
	
	public function prizeEightName($name='')
	{
		if(!empty($name)){
			$this->prizeEightName = $name;
		} // if
		return $this->prizeEightName;
	}
	
	public function prizeEightCode($code='')
	{
		if(!empty($code)){
			$this->prizeEightCode = $code;
		} // if
		return $this->prizeEightCode;
	}
	
	public function prizeEightText($text='')
	{
		if(!empty($text)){
			$this->prizeEightText = $text;
		} // if
		return $this->prizeEightText;
	}
	
	public function prizeEightTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeEightTextSize = $textsize;
		} // if
		return $this->prizeEightTextSize;
	}
	
	public function prizeEightImage($image='')
	{
		if(!empty($image)){
			$this->prizeEightImage = $image;
		} // if
		return $this->prizeEightImage;
	}
	
	public function prizeEightUrl($url='')
	{
		if(!empty($url)){
			$this->prizeEightUrl = $url;
		} // if
		return $this->prizeEightUrl;
	}
	
	public function prizeEightWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeEightWeight = weight;
		} // if
		return $this->prizeEightWeight;
	}
	
	public function prizeNineName($name='')
	{
		if(!empty($name)){
			$this->prizeNineName = $name;
		} // if
		return $this->prizeNineName;
	}
	
	public function prizeNineCode($code='')
	{
		if(!empty($code)){
			$this->prizeNineCode = $code;
		} // if
		return $this->prizeNineCode;
	}
	
	public function prizeNineText($text='')
	{
		if(!empty($text)){
			$this->prizeNineText = $text;
		} // if
		return $this->prizeNineText;
	}
	
	public function prizeNineTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeNineTextSize = $textsize;
		} // if
		return $this->prizeNineTextSize;
	}
	
	public function prizeNineImage($image='')
	{
		if(!empty($image)){
			$this->prizeNineImage = $image;
		} // if
		return $this->prizeNineImage;
	}
	
	public function prizeNineUrl($url='')
	{
		if(!empty($url)){
			$this->prizeNineUrl = $url;
		} // if
		return $this->prizeNineUrl;
	}
	
	public function prizeNineWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeNineWeight = weight;
		} // if
		return $this->prizeNineWeight;
	}
	
	public function prizeTenName($name='')
	{
		if(!empty($name)){
			$this->prizeTenName = $name;
		} // if
		return $this->prizeTenName;
	}
	
	public function prizeTenCode($code='')
	{
		if(!empty($code)){
			$this->prizeTenCode = $code;
		} // if
		return $this->prizeTenCode;
	}
	
	public function prizeTenText($text='')
	{
		if(!empty($text)){
			$this->prizeTenText = $text;
		} // if
		return $this->prizeTenText;
	}
	
	public function prizeTenTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeTenTextSize = $textsize;
		} // if
		return $this->prizeTenTextSize;
	}
	
	public function prizeTenImage($image='')
	{
		if(!empty($image)){
			$this->prizeTenImage = $image;
		} // if
		return $this->prizeTenImage;
	}
	
	public function prizeTenUrl($url='')
	{
		if(!empty($url)){
			$this->prizeTenUrl = $url;
		} // if
		return $this->prizeTenUrl;
	}
	
	public function prizeTenWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeTenWeight = weight;
		} // if
		return $this->prizeTenWeight;
	}
	
	public function prizeElevenName($name='')
	{
		if(!empty($name)){
			$this->prizeElevenName = $name;
		} // if
		return $this->prizeElevenName;
	}
	
	public function prizeElevenCode($code='')
	{
		if(!empty($code)){
			$this->prizeElevenCode = $code;
		} // if
		return $this->prizeElevenCode;
	}
	
	public function prizeElevenText($text='')
	{
		if(!empty($text)){
			$this->prizeElevenText = $text;
		} // if
		return $this->prizeElevenText;
	}
	
	public function prizeElevenTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeElevenTextSize = $textsize;
		} // if
		return $this->prizeElevenTextSize;
	}
	
	public function prizeElevenImage($image='')
	{
		if(!empty($image)){
			$this->prizeElevenImage = $image;
		} // if
		return $this->prizeElevenImage;
	}
	
	public function prizeElevenUrl($url='')
	{
		if(!empty($url)){
			$this->prizeElevenUrl = $url;
		} // if
		return $this->prizeElevenUrl;
	}
	
	public function prizeElevenWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeElevenWeight = weight;
		} // if
		return $this->prizeElevenWeight;
	}
	
	public function prizeTwelveName($name='')
	{
		if(!empty($name)){
			$this->prizeTwelveName = $name;
		} // if
		return $this->prizeTwelveName;
	}
	
	public function prizeTwelveCode($code='')
	{
		if(!empty($code)){
			$this->prizeTwelveCode = $code;
		} // if
		return $this->prizeTwelveCode;
	}
	
	public function prizeTwelveText($text='')
	{
		if(!empty($text)){
			$this->prizeTwelveText = $text;
		} // if
		return $this->prizeTwelveText;
	}
	
	public function prizeTwelveTextSize($textsize=0)
	{
		if(is_int($textsize) && $textsize > 0){
			$this->prizeTwelveTextSize = $textsize;
		} // if
		return $this->prizeTwelveTextSize;
	}
	
	public function prizeTwelveImage($image='')
	{
		if(!empty($image)){
			$this->prizeTwelveImage = $image;
		} // if
		return $this->prizeTwelveImage;
	}
	
	public function prizeTwelveUrl($url='')
	{
		if(!empty($url)){
			$this->prizeTwelveUrl = $url;
		} // if
		return $this->prizeTwelveUrl;
	}
	
	public function prizeTwelveWeight($weight=0)
	{
		if(is_int($weight) && $weight > 0){
			$this->prizeTwelveWeight = weight;
		} // if
		return $this->prizeTwelveWeight;
	}
	
	public function sponserImage($sponserimage='')
	{
		if(!empty($sponserimage)){
			$this->sponserImage = $sponserimage;
		} // if
		return $this->sponserImage;
	}
	
	public function sponserLink($sponserlink='')
	{
		if(!empty($sponserlink)){
			$this->sponserLink = $sponserlink;
		} // if
		return $this->sponserLink;
	}
	
	public function backImage($backimage='')
	{
		if(!empty($backimage)){
			$this->backImage = $backimage;
		} // if
		return $this->backImage;
	}
	
	public function topImage($topimage='')
	{
		if(!empty($topimage)){
			$this->topImage = $topimage;
		} // if
		return $this->topImage;
	}
	
	public function buttonImage($buttonimage='')
	{
		if(!empty($buttonimage)){
			$this->buttonImage = $buttonimage;
		} // if
		return $this->buttonImage;
	}	
	
	public function sendEmailNotifications($sendemailnotifications=null)
	{
		if(is_bool($sendemailnotifications)){
			$this->sendEmailNotifications = $sendemailnotifications;
		} // if
		return $this->sendEmailNotifications;
	}
	
	public function notificationEmailAddress($notificationemailaddress='')
	{
		if(!empty($notificationemailaddress)){
			$this->notificationEmailAddress = $notificationemailaddress;
		} // if
		return $this->notificationEmailAddress;
	}
	
	public function smtpServer($smtpserver='')
	{
		if(!empty($smtpserver)){
			$this->smtpServer = $smtpserver;
		} // if
		return $this->smtpServer;
	}
	
	public function smtpUserName($smtpusername='')
	{
		if(!empty($smtpusername)){
			$this->smtpUserName = $smtpusername;
		} // if	
		return $this->smtpUserName;
	}
	
	public function smtpPassword($smtppassword='')
	{
		if(!empty($smtppassword)){
			$this->smtpPassword = $smtppassword;
		} // if
		return $this->smtpPassword;
	}
	
	public function smtpPort($smtpport=0)
	{
		if(is_int($smtpport) && $smtpport > 0){
			$this->smtpPort = $smtpport;
		} // if
		return $this->smtpPort;
	}
	
	public function smtpEncryption($smtpencryption='')
	{
		if(!empty($smtpencryption)){
			$this->smtpEncryption = $smtpencryption;
		} // if
		return $this->smtpEncryption;
	}
	
	public function smptAuthMethod($smtpauthmethod='')
	{
		if(!empty($smtpauthmethod)){
			$this->smtpAuthMethod = $smtpauthmethod;
		} // if
		return $this->smtpAuthMethod;
	}
	
	public function notificationEmailSubject($notificationemailsubject='')
	{
		if(!empty($notificationemailsubject)){
			$this->notificationEmailSubject = $notificationemailsubject;
		} // if
		return $this->notificationEmailSubject;
	}
	
	public function notificationEmailBody($notificationemailbody='')
	{
		if(!empty($notificationemailbody)){
			$this->notificationEmailBody = $notificationemailbody;
		} // if
		return $this->notificationEmailBody;
	}
	
	public function ipAddressFilter($ipaddressfilter=null)
	{
		if(is_bool($ipaddressfilter)){
			$this->ipAddressFilter = $ipaddressfilter;
		} // if
		return $this->ipAddressFilter;
	}
	
	public function phoneFilter($phonefilter=null)
	{
		if(is_bool($phonefilter)){
			$this->phoneFilter = $phonefilter;
		} // if
		return $this->phoneFilter;
	}
	
	public function emailFilter($emailfilter=null)
	{
		if(is_bool($emailfilter)){
			$this->emailFilter = $emailfilter;
		} // if
		return $this->emailFilter;		
	}
	
	public function enabled($enabled=null)
	{
		if(is_bool($enabled)){
			$this->enabled = $enabled;
		} // if
		return $this->enabled;
	}
	
	public function createDateTime($createdatetime='')
	{
		if(!empty($createdatetime)){
			 $this->createDateTime = $createdatetime;
		} // if
		return $this->createDateTime;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->pageId = (isset($data['pageid'])) ? $data['pageid'] : 0;
		$this->affiliateid = (isset($data['affiliateid'])) ? $data['affiliateid'] : 0;
		$this->forceLike = (isset($data['forcelike'])) ? $data['forcelike'] : null;
		$this->forceLikeImage = (isset($data['forcelikeimage'])) ? $data['forcelikeimage'] : null;
		$this->firstText = (isset($data['firsttext'])) ? $data['firsttext'] : null;
		$this->validEmail = (isset($data['validemail'])) ? $data['validemail'] : null;
		$this->alreadyPlayed = (isset($data['alreadyplayed'])) ? $data['alreadyplayed'] : null;
		$this->errorSubmit = (isset($data['errorsubmit'])) ? $data['errorsubmit'] : null;
		$this->errorPrize = (isset($data['errorprize'])) ? $data['errorprize'] : null;
		$this->accessError = (isset($data['accesserror'])) ? $data['accesserror'] : null;
		$this->accessLimit = (isset($data['accesslimit'])) ? $data['accesslimit'] : null;
		$this->textRules = (isset($data['textrules'])) ? $data['textrules'] : null;
		$this->prizeOneName = (isset($data['prizeonename'])) ? $data['prizeonename'] : null;
		$this->prizeOneCode = (isset($data['prizeonecode'])) ? $data['prizeonecode'] : null;
		$this->prizeOneText = (isset($data['prizeonetext'])) ? $data['prizeonetext'] : null;
		$this->prizeOneTextSize = (isset($data['prizeonetextsize'])) ? $data['prizeonetextsize'] : null;
		$this->prizeOneImage = (isset($data['prizeoneimage'])) ? $data['prizeoneimage'] : null;
		$this->prizeOneUrl = (isset($data['prizeoneurl'])) ? $data['prizeoneurl'] : null;
		$this->prizeOneWeight = (isset($data['prizeoneweight'])) ? $data['prizeoneweight'] : null;		  
		$this->prizeTwoName = (isset($data['prizetwoname'])) ? $data['prizetwoname'] : null;
		$this->prizeTwoCode = (isset($data['prizetwocode'])) ? $data['prizetwocode'] : null;
		$this->prizeTwoText = (isset($data['prizetwotext'])) ? $data['prizetwotext'] : null;
		$this->prizeTwoTextSize = (isset($data['prizetwotextsize'])) ? $data['prizetwotextsize'] : null;
		$this->prizeTwoImage = (isset($data['prizetwoimage'])) ? $data['prizetwoimage'] : null;
		$this->prizeTwoUrl = (isset($data['prizetwourl'])) ? $data['prizetwourl'] : null;
		$this->prizeTwoWeight = (isset($data['prizetwoweight'])) ? $data['prizetwoweight'] : null;		
		$this->prizeThreeName = (isset($data['prizethreename'])) ? $data['prizethreename'] : null;
		$this->prizeThreeCode = (isset($data['prizethreecode'])) ? $data['prizethreecode'] : null;
		$this->prizeThreeText = (isset($data['prizethreetext'])) ? $data['prizethreetext'] : null;
		$this->prizeThreeTextSize = (isset($data['prizethreetextsize'])) ? $data['prizethreetextsize'] : null;
		$this->prizeThreeImage = (isset($data['prizethreeimage'])) ? $data['prizethreeimage'] : null;
		$this->prizeThreeUrl = (isset($data['prizethreeurl'])) ? $data['prizethreeurl'] : null;
		$this->prizeThreeWeight = (isset($data['prizethreeweight'])) ? $data['prizethreeweight'] : null;
		$this->prizeFourName = (isset($data['prizefourname'])) ? $data['prizefourname'] : null;
		$this->prizeFourCode = (isset($data['prizefourcode'])) ? $data['prizefourcode'] : null;
		$this->prizeFourText = (isset($data['prizefourtext'])) ? $data['prizefourtext'] : null;
		$this->prizeFourTextSize = (isset($data['prizefourtextsize'])) ? $data['prizefourtextsize'] : null;
		$this->prizeFourImage = (isset($data['prizefourimage'])) ? $data['prizefourimage'] : null;
		$this->prizeFourUrl = (isset($data['prizefoururl'])) ? $data['prizefoururl'] : null;
		$this->prizeFourWeight = (isset($data['prizefourweight'])) ? $data['prizefourweight'] : null;
		$this->prizeFiveName = (isset($data['prizefivename'])) ? $data['prizefivename'] : null;
		$this->prizeFiveCode = (isset($data['prizefivecode'])) ? $data['prizefivecode'] : null;
		$this->prizeFiveText = (isset($data['prizefivetext'])) ? $data['prizefivetext'] : null;
		$this->prizeFiveTextSize = (isset($data['prizefivetextsize'])) ? $data['prizefivetextsize'] : null;
		$this->prizeFiveImage = (isset($data['prizefiveimage'])) ? $data['prizefiveimage'] : null;
		$this->prizeFiveUrl = (isset($data['prizefiveurl'])) ? $data['prizefiveurl'] : null;
		$this->prizeFiveWeight = (isset($data['prizefiveweight'])) ? $data['prizefiveweight'] : null;
		$this->prizeSixName = (isset($data['prizesixname'])) ? $data['prizesixname'] : null;
		$this->prizeSixCode = (isset($data['prizesixcode'])) ? $data['prizesixcode'] : null;
		$this->prizeSixText = (isset($data['prizesixtext'])) ? $data['prizesixtext'] : null;
		$this->prizeSixTextSize = (isset($data['prizesixtextsize'])) ? $data['prizesixtextsize'] : null;
		$this->prizeSixImage = (isset($data['prizesiximage'])) ? $data['prizesiximage'] : null;
		$this->prizeSixUrl = (isset($data['prizesixurl'])) ? $data['prizesixurl'] : null;
		$this->prizeSixWeight = (isset($data['prizesixweight'])) ? $data['prizesixweight'] : null;
		$this->prizeSevenName = (isset($data['prizesevenname'])) ? $data['prizesevenname'] : null;
		$this->prizeSevenCode = (isset($data['prizesevencode'])) ? $data['prizesevencode'] : null;
		$this->prizeSevenText = (isset($data['prizeseventext'])) ? $data['prizeseventext'] : null;
		$this->prizeSevenTextSize = (isset($data['prizeseventextsize'])) ? $data['prizeseventextsize'] : null;
		$this->prizeSevenImage = (isset($data['prizesevenimage'])) ? $data['prizesevenimage'] : null;
		$this->prizeSevenUrl = (isset($data['prizesevenurl'])) ? $data['prizesevenurl'] : null;
		$this->prizeSevenWeight = (isset($data['prizesevenweight'])) ? $data['prizesevenweight'] : null;
		$this->prizeEightName = (isset($data['prizeeightname'])) ? $data['prizeeightname'] : null;
		$this->prizeEightCode = (isset($data['prizeeightcode'])) ? $data['prizeeightcode'] : null;
		$this->prizeEightText = (isset($data['prizeeighttext'])) ? $data['prizeeighttext'] : null;
		$this->prizeEightTextSize = (isset($data['prizeeighttextsize'])) ? $data['prizeeighttextsize'] : null;
		$this->prizeEightImage = (isset($data['prizeeightimage'])) ? $data['prizeeightimage'] : null;
		$this->prizeEightUrl = (isset($data['prizeeighturl'])) ? $data['prizeeighturl'] : null;
		$this->prizeEightWeight = (isset($data['prizeeightweight'])) ? $data['prizeeightweight'] : null;
		$this->prizeNineName = (isset($data['prizeninename'])) ? $data['prizeninename'] : null;
		$this->prizeNineCode = (isset($data['prizeninecode'])) ? $data['prizeninecode'] : null;
		$this->prizeNineText = (isset($data['prizeninetext'])) ? $data['prizeninetext'] : null;
		$this->prizeNineTextSize = (isset($data['prizeninetextsize'])) ? $data['prizeninetextsize'] : null;
		$this->prizeNineImage = (isset($data['prizenineimage'])) ? $data['prizenineimage'] : null;
		$this->prizeNineUrl = (isset($data['prizenineurl'])) ? $data['prizenineurl'] : null;
		$this->prizeNineWeight = (isset($data['prizenineweight'])) ? $data['prizenineweight'] : null;
		$this->prizeTenName = (isset($data['prizetenname'])) ? $data['prizetenname'] : null;
		$this->prizeTenCode = (isset($data['prizetencode'])) ? $data['prizetencode'] : null;
		$this->prizeTenText = (isset($data['prizetentext'])) ? $data['prizetentext'] : null;
		$this->prizeTenTextSize = (isset($data['prizetentextsize'])) ? $data['prizetentextsize'] : null;
		$this->prizeTenImage = (isset($data['prizetenimage'])) ? $data['prizetenimage'] : null;
		$this->prizeTenUrl = (isset($data['prizetenurl'])) ? $data['prizetenurl'] : null;
		$this->prizeTenWeight = (isset($data['prizetenweight'])) ? $data['prizetenweight'] : null;
		$this->prizeElevenName = (isset($data['prizeelevenname'])) ? $data['prizeelevenname'] : null;
		$this->prizeElevenCode = (isset($data['prizeelevencode'])) ? $data['prizeelevencode'] : null;
		$this->prizeElevenText = (isset($data['prizeeleventext'])) ? $data['prizeeleventext'] : null;
		$this->prizeElevenTextSize = (isset($data['prizeeleventextsize'])) ? $data['prizeeleventextsize'] : null;
		$this->prizeElevenImage = (isset($data['prizeelevenimage'])) ? $data['prizeelevenimage'] : null;
		$this->prizeElevenUrl = (isset($data['prizeelevenurl'])) ? $data['prizeelevenurl'] : null;
		$this->prizeElevenWeight = (isset($data['prizeelevenweight'])) ? $data['prizeelevenweight'] : null;		
		$this->prizeTwelveName = (isset($data['prizetwelvename'])) ? $data['prizetwelvename'] : null;
		$this->prizeTwelveCode = (isset($data['prizetwelvecode'])) ? $data['prizetwelvecode'] : null;
		$this->prizeTwelveText = (isset($data['prizetwelvetext'])) ? $data['prizetwelvetext'] : null;
		$this->prizeTwelveTextSize = (isset($data['prizetwelvetextsize'])) ? $data['prizetwelvetextsize'] : null;
		$this->prizeTwelveImage = (isset($data['prizetwelveimage'])) ? $data['prizetwelveimage'] : null;
		$this->prizeTwelveUrl = (isset($data['prizetwelveurl'])) ? $data['prizetwelveurl'] : null;
		$this->prizeTwelveWeight = (isset($data['prizetwelveweight'])) ? $data['prizetwelveweight'] : null;
		$this->sponserImage = (isset($data['sponserimage'])) ? $data['sponserimage'] : null;
		$this->sponserLink = (isset($data['sponserlink'])) ? $data['sponserlink'] : null;
		$this->backImage = (isset($data['backimage'])) ? $data['backimage'] : null;
		$this->topImage = (isset($data['topimage'])) ? $data['topimage'] : null;
		$this->buttonImage = (isset($data['buttonimage'])) ? $data['buttonimage'] : null;
		$this->sendEmailNotifications = (isset($data['sendemailnotifications'])) ? $data['sendemailnotifications'] : false;
		$this->notificationEmailAddress = (isset($data['notificationemailaddress'])) ? $data['notificationemailaddress'] : null;
		$this->smtpServer = (isset($data['smtpserver'])) ? $data['smtpserver'] : null;
		$this->smtpUserName = (isset($data['smtpusername'])) ? $data['smtpusername'] : null;
		$this->smtpPassword = (isset($data['smtppassword'])) ? $data['smtppassword'] : null;
		$this->smtpPort = (isset($data['smtpport'])) ? $data['smtpport'] : 25;
		$this->smtpFromAddress = (isset($data['smtpfromaddress'])) ? $data['smtpfromaddress'] : null;
		$this->smtpEncryption = (isset($data['smtpencryption'])) ? $data['smtpencryption'] : null;
		$this->smtpAuthMethod = (isset($data['smtpauthmethod'])) ? $data['smtpauthmethod'] : null;
		$this->notificationEmailSubject = (isset($data['notificationemailsubject'])) ? $data['notificationemailsubject'] : null;
		$this->notificationEmailBody = (isset($data['notificationemailbody'])) ? $data['notificationemailbody'] : null;
		$this->ipAddressFilter = (isset($data['ipaddressfilter'])) ? $data['ipaddressfilter'] : false;
		$this->phoneFilter = (isset($data['phonefilter'])) ? $data['phonefilter'] : false;
		$this->emailFilter = (isset($data['emailfilter'])) ? $data['emailfilter'] : false;
		$this->enabled = (isset($data['enabled'])) ? $data['enabled'] : true;
		$this->createDateTime (isset($data['createdatetime'])) ? $data['createdatetime'] : null;
  	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'pageid' => $this->pageId,
			'affiliateid' => $this->affiliateId,
			'forcelike' => $this->forceLike,
			'forcelikeimage' => $this->forceLikeImage,
			'firsttext' => $this->firstText,
			'validemail' => $this->validEmail,
			'alreadyplayed' => $this->alreadyPlayed,
			'errorsubmit' => $this->errorSubmit,
			'errorprize' => $this->errorPrize,
			'accesserror' => $this->accessError,
			'accesslimit' => $this->accessLimit,
			'textrules' => $this->textRules,
			'prizeonename' => $this->prizeOneName,
			'prizeonecode' => $this->prizeOneCode,
			'prizeonetext' => $this->prizeOneText,
			'prizeonetextsize' => $this->prizeOneTextSize,
			'prizeoneimage' => $this->prizeOneImage,
			'prizeoneurl' => $this->prizeOneUrl,
			'prizeoneweight' => $this->prizeOneWeight,
			'prizetwoname' => $this->prizeTwoName,
			'prizetwocode' => $this->prizeTwoCode,
			'prizetwotext' => $this->prizeTwoText,
			'prizetwotextsize' => $this->prizeTwoTextSize,
			'prizetwoimage' => $this->prizeTwoImage,
			'prizetwourl' => $this->prizeTwoUrl,
			'prizetwoweight' => $this->prizeTwoWeight,
			'prizethreename' => $this->prizeThreeName,
			'prizethreecode' => $this->prizeThreeCode,
			'prizethreetext' => $this->prizeThreeText,
			'prizethreetextsize' => $this->prizeThreeTextSize,
			'prizethreeimage' => $this->prizeThreeImage,
			'prizethreeurl' => $this->prizeThreeUrl,
			'prizethreeweight' => $this->prizeThreeWeight,
			'prizefourname' => $this->prizeFourName,
			'prizefourcode' => $this->prizeFourCode,
			'prizefourtext' => $this->prizeFourText,
			'prizefourtextsize' => $this->prizeFourTextSize,
			'prizefourimage' => $this->prizeFourImage,
			'prizefoururl' => $this->prizeFourUrl,
			'prizefourweight' => $this->prizeFourWeight,
			'prizefivename' => $this->prizeFiveName,
			'prizefivecode' => $this->prizeFiveCode,
			'prizefivetext' => $this->prizeFiveText,
			'prizefivetextsize' => $this->prizeFiveTextSize,
			'prizefiveimage' => $this->prizeFiveImage,
			'prizefiveurl' => $this->prizeFiveUrl,
			'prizefiveweight' => $this->prizeFiveWeight,
			'prizesixname' => $this->prizeSixName,
			'prizesixcode' => $this->prizeSixCode,
			'prizesixtext' => $this->prizeSixText,
			'prizesixtextsize' => $this->prizeSixTextSize,
			'prizesiximage' => $this->prizeSixImage,
			'prizesixurl' => $this->prizeSixUrl,
			'prizesixweight' => $this->prizeSixWeight,
			'prizesevenname' => $this->prizeSevenName,
			'prizesevencode' => $this->prizeSevenCode,
			'prizeseventext' => $this->prizeSevenText,
			'prizeseventextsize' => $this->prizeSevenTextSize,
			'prizesevenimage' => $this->prizeSevenImage,
			'prizesevenurl' => $this->prizeSevenUrl,
			'prizesevenweight' => $this->prizeSevenWeight,
			'prizeeightname' => $this->prizeEightName,
			'prizeeightcode' => $this->prizeEightCode,
			'prizeeighttext' => $this->prizeEightText,
			'prizeeighttextsize' => $this->prizeEightTextSize,
			'prizeeightimage' => $this->prizeEightImage,
			'prizeeighturl' => $this->prizeEightUrl,
			'prizeeightweight' => $this->prizeEightWeight,
			'prizeninename' => $this->prizeNineName,
			'prizeninecode' => $this->prizeNineCode,
			'prizeninetext' => $this->prizeNineText,
			'prizeninetextsize' => $this->prizeNineTextSize,
			'prizenineimage' => $this->prizeNineImage,
			'prizenineurl' => $this->prizeNineUrl,
			'prizenineweight' => $this->prizeNineWeight,
			'prizetenname' => $this->prizeTenName,
			'prizetencode' => $this->prizeTenCode,
			'prizetentext' => $this->prizeTenText,
			'prizetentextsize' => $this->prizeTenTextSize,
			'prizetenimage' => $this->prizeTenImage,
			'prizetenurl' => $this->prizeTenUrl,
			'prizetenweight' => $this->prizeTenWeight,
			'prizeelevenname' => $this->prizeElevenName,
			'prizeelevencode' => $this->prizeElevenCode,
			'prizeeleventext' => $this->prizeElevenText,
			'prizeeleventextsize' => $this->prizeElevenTextSize,
			'prizeelevenimage' => $this->prizeElevenImage,
			'prizeelevenurl' => $this->prizeElevenUrl,
			'prizeelevenweight' => $this->prizeElevenWeight,
			'prizetwelvename' => $this->prizeTwelveName,
			'prizetwelvecode' => $this->prizeTwelveCode,
			'prizetwelvetext' => $this->prizeTwelveText,
			'prizetwelvetextsize' => $this->prizeTwelveTextSize,
			'prizetwelveimage' => $this->prizeTwelveImage,
			'prizetwelveurl' => $this->prizeTwelveUrl,
			'prizetwelveweight' => $this->prizeTwelveWeight,
			'sponserimage' => $this->sponserImage,
			'sponserlink' => $this->sponserLink,
			'backimage' => $this->backImage,
			'topimage' => $this->topImage,
			'buttonimage' => $this->buttonImage,
			'sendemailnotifications' => $this->sendEmailNotifications,
			'notificationemailaddress' => $this->notificationEmailAddress,
			'smtpserver' => $this->smtpServer,
			'smtpusername' => $this->smtpUserName,
			'smtppassword' => $this->smtpPassword,
			'smtpport' => $this->smtpPort,
			'smtpfromaddress' => $this->smtpFromAddress,
			'smtpencryption' => $this->smtpEncryption,
			'smtpauthmethod' => $this->smtpAuthMethod,
			'notificationemailsubject' => $this->notificationEmailSubject,
			'notificationemailbody' => $this->notificationEmailBody,
			'ipaddressfilter' => $this->ipAddressFilter,
			'phonefilter' => $this->phoneFilter,
			'emailfilter' => $this->emailFilter,
			'enabled' => $this->enabled,
			'createdatetime' => $this->createDateTime
		);
 	}	
}