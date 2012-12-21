<?php

namespace Application\Model;

class PrizeWheel
{
	protected $id;
	protected $prizeWheelTypeId;
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
	
	protected $prizeWheelTypeName;
	protected $views;
	protected $plays;
	protected $advertisementClicks;
	protected $categories;
	
	public function id($id=0)
	{
		if(is_int($id) && $id > 0){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function prizeWheelTypeId($prizewheeltypeid=0)
	{
		if(!empty($prizewheeltypeid)){
			$this->prizeWheelTypeId = $prizewheeltypeid;
		} // if
		return $this->prizeWheelTypeId;
	}
	
	public function pageId($pageid='')
	{
		if(!empty($pageid)){
			$this->pageId = $pageid;
		} // if
		return $this->pageId;
	}
	
	public function affiliateId($affiliateid=0)
	{
		if(!empty($affiliateid)){
			$this->affiliateId = $affiliateid;
		} // if
		return $this->affiliateId;
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
	
	public function prizeWheelTypeName()
	{
		return $this->prizeWheelTypeName;
	}
	
	public function views($views=0)
	{
		if(!empty($views)){
			$this->views = $views;
		} // if
		return $this->views;
	}
	
	public function plays($plays=0)
	{
		if(!empty($plays)){
			$this->plays = $plays;
		} // if
		return $this->plays;
	}
	
	public function advertisementClicks($advertisementclicks=0)
	{
		if(!empty($advertisementclicks)){
			$this->advertisementClicks = $advertisementclicks;
		} // if
		return $this->advertisementClicks;
	}
	
	public function categories($categories=null)
	{
		if(is_array($categories)){
			$this->categories = $categories;
		} // if
		return $this->categories;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->prizeWheelTypeId = (isset($data['prizewheeltypeid'])) ? $data['prizewheeltypeid'] : 0;
		$this->pageId = (isset($data['pageid'])) ? $data['pageid'] : 0;
		$this->affiliateId = (isset($data['affiliateid'])) ? $data['affiliateid'] : 0;
		$this->forceLike = (isset($data['forcelike'])) ? $data['forcelike'] : false;
		$this->forceLikeImage = (isset($data['forcelikeimage'])) ? $data['forcelikeimage'] : "";
		$this->firstText = (isset($data['firsttext'])) ? $data['firsttext'] : $this->firstText;
		$this->validEmail = (isset($data['validemail'])) ? $data['validemail'] : $this->validEmail;
		$this->alreadyPlayed = (isset($data['alreadyplayed'])) ? $data['alreadyplayed'] : $this->alreadyPlayed;
		$this->errorSubmit = (isset($data['errorsubmit'])) ? $data['errorsubmit'] : $this->errorSubmit;
		$this->errorPrize = (isset($data['errorprize'])) ? $data['errorprize'] : $this->errorPrize;
		$this->accessError = (isset($data['accesserror'])) ? $data['accesserror'] : $this->accessError;
		$this->accessLimit = (isset($data['accesslimit'])) ? $data['accesslimit'] : $this->accessLimit;
		$this->textRules = (isset($data['textrules'])) ? $data['textrules'] : $this->textRules;
		$this->prizeOneName = (isset($data['prizeonename'])) ? $data['prizeonename'] : "";
		$this->prizeOneCode = (isset($data['prizeonecode'])) ? $data['prizeonecode'] : "";
		$this->prizeOneText = (isset($data['prizeonetext'])) ? $data['prizeonetext'] : "";
		$this->prizeOneTextSize = (isset($data['prizeonetextsize'])) ? $data['prizeonetextsize'] : 10;
		$this->prizeOneImage = (isset($data['prizeoneimage'])) ? $data['prizeoneimage'] : "";
		$this->prizeOneUrl = (isset($data['prizeoneurl'])) ? $data['prizeoneurl'] : "";
		$this->prizeOneWeight = (isset($data['prizeoneweight'])) ? $data['prizeoneweight'] : 0;		  
		$this->prizeTwoName = (isset($data['prizetwoname'])) ? $data['prizetwoname'] : "";
		$this->prizeTwoCode = (isset($data['prizetwocode'])) ? $data['prizetwocode'] : "";
		$this->prizeTwoText = (isset($data['prizetwotext'])) ? $data['prizetwotext'] : "";
		$this->prizeTwoTextSize = (isset($data['prizetwotextsize'])) ? $data['prizetwotextsize'] : 10;
		$this->prizeTwoImage = (isset($data['prizetwoimage'])) ? $data['prizetwoimage'] : "";
		$this->prizeTwoUrl = (isset($data['prizetwourl'])) ? $data['prizetwourl'] : "";
		$this->prizeTwoWeight = (isset($data['prizetwoweight'])) ? $data['prizetwoweight'] : 0;		
		$this->prizeThreeName = (isset($data['prizethreename'])) ? $data['prizethreename'] : "";
		$this->prizeThreeCode = (isset($data['prizethreecode'])) ? $data['prizethreecode'] : "";
		$this->prizeThreeText = (isset($data['prizethreetext'])) ? $data['prizethreetext'] : "";
		$this->prizeThreeTextSize = (isset($data['prizethreetextsize'])) ? $data['prizethreetextsize'] : 10;
		$this->prizeThreeImage = (isset($data['prizethreeimage'])) ? $data['prizethreeimage'] : "";
		$this->prizeThreeUrl = (isset($data['prizethreeurl'])) ? $data['prizethreeurl'] : "";
		$this->prizeThreeWeight = (isset($data['prizethreeweight'])) ? $data['prizethreeweight'] : 0;
		$this->prizeFourName = (isset($data['prizefourname'])) ? $data['prizefourname'] : "";
		$this->prizeFourCode = (isset($data['prizefourcode'])) ? $data['prizefourcode'] : "";
		$this->prizeFourText = (isset($data['prizefourtext'])) ? $data['prizefourtext'] : "";
		$this->prizeFourTextSize = (isset($data['prizefourtextsize'])) ? $data['prizefourtextsize'] : 10;
		$this->prizeFourImage = (isset($data['prizefourimage'])) ? $data['prizefourimage'] : "";
		$this->prizeFourUrl = (isset($data['prizefoururl'])) ? $data['prizefoururl'] : "";
		$this->prizeFourWeight = (isset($data['prizefourweight'])) ? $data['prizefourweight'] : 0;
		$this->prizeFiveName = (isset($data['prizefivename'])) ? $data['prizefivename'] : "";
		$this->prizeFiveCode = (isset($data['prizefivecode'])) ? $data['prizefivecode'] : "";
		$this->prizeFiveText = (isset($data['prizefivetext'])) ? $data['prizefivetext'] : "";
		$this->prizeFiveTextSize = (isset($data['prizefivetextsize'])) ? $data['prizefivetextsize'] : 10;
		$this->prizeFiveImage = (isset($data['prizefiveimage'])) ? $data['prizefiveimage'] : "";
		$this->prizeFiveUrl = (isset($data['prizefiveurl'])) ? $data['prizefiveurl'] : "";
		$this->prizeFiveWeight = (isset($data['prizefiveweight'])) ? $data['prizefiveweight'] : 0;
		$this->prizeSixName = (isset($data['prizesixname'])) ? $data['prizesixname'] : "";
		$this->prizeSixCode = (isset($data['prizesixcode'])) ? $data['prizesixcode'] : "";
		$this->prizeSixText = (isset($data['prizesixtext'])) ? $data['prizesixtext'] : "";
		$this->prizeSixTextSize = (isset($data['prizesixtextsize'])) ? $data['prizesixtextsize'] : 10;
		$this->prizeSixImage = (isset($data['prizesiximage'])) ? $data['prizesiximage'] : "";
		$this->prizeSixUrl = (isset($data['prizesixurl'])) ? $data['prizesixurl'] : "";
		$this->prizeSixWeight = (isset($data['prizesixweight'])) ? $data['prizesixweight'] : 0;
		$this->prizeSevenName = (isset($data['prizesevenname'])) ? $data['prizesevenname'] : "";
		$this->prizeSevenCode = (isset($data['prizesevencode'])) ? $data['prizesevencode'] : "";
		$this->prizeSevenText = (isset($data['prizeseventext'])) ? $data['prizeseventext'] : "";
		$this->prizeSevenTextSize = (isset($data['prizeseventextsize'])) ? $data['prizeseventextsize'] : 10;
		$this->prizeSevenImage = (isset($data['prizesevenimage'])) ? $data['prizesevenimage'] : "";
		$this->prizeSevenUrl = (isset($data['prizesevenurl'])) ? $data['prizesevenurl'] : "";
		$this->prizeSevenWeight = (isset($data['prizesevenweight'])) ? $data['prizesevenweight'] : 0;
		$this->prizeEightName = (isset($data['prizeeightname'])) ? $data['prizeeightname'] : "";
		$this->prizeEightCode = (isset($data['prizeeightcode'])) ? $data['prizeeightcode'] : "";
		$this->prizeEightText = (isset($data['prizeeighttext'])) ? $data['prizeeighttext'] : "";
		$this->prizeEightTextSize = (isset($data['prizeeighttextsize'])) ? $data['prizeeighttextsize'] : 10;
		$this->prizeEightImage = (isset($data['prizeeightimage'])) ? $data['prizeeightimage'] : "";
		$this->prizeEightUrl = (isset($data['prizeeighturl'])) ? $data['prizeeighturl'] : "";
		$this->prizeEightWeight = (isset($data['prizeeightweight'])) ? $data['prizeeightweight'] : 0;
		$this->prizeNineName = (isset($data['prizeninename'])) ? $data['prizeninename'] : "";
		$this->prizeNineCode = (isset($data['prizeninecode'])) ? $data['prizeninecode'] : "";
		$this->prizeNineText = (isset($data['prizeninetext'])) ? $data['prizeninetext'] : "";
		$this->prizeNineTextSize = (isset($data['prizeninetextsize'])) ? $data['prizeninetextsize'] : 10;
		$this->prizeNineImage = (isset($data['prizenineimage'])) ? $data['prizenineimage'] : "";
		$this->prizeNineUrl = (isset($data['prizenineurl'])) ? $data['prizenineurl'] : "";
		$this->prizeNineWeight = (isset($data['prizenineweight'])) ? $data['prizenineweight'] : 0;
		$this->prizeTenName = (isset($data['prizetenname'])) ? $data['prizetenname'] : "";
		$this->prizeTenCode = (isset($data['prizetencode'])) ? $data['prizetencode'] : "";
		$this->prizeTenText = (isset($data['prizetentext'])) ? $data['prizetentext'] : "";
		$this->prizeTenTextSize = (isset($data['prizetentextsize'])) ? $data['prizetentextsize'] : 10;
		$this->prizeTenImage = (isset($data['prizetenimage'])) ? $data['prizetenimage'] : "";
		$this->prizeTenUrl = (isset($data['prizetenurl'])) ? $data['prizetenurl'] : "";
		$this->prizeTenWeight = (isset($data['prizetenweight'])) ? $data['prizetenweight'] : 0;
		$this->prizeElevenName = (isset($data['prizeelevenname'])) ? $data['prizeelevenname'] : "";
		$this->prizeElevenCode = (isset($data['prizeelevencode'])) ? $data['prizeelevencode'] : "";
		$this->prizeElevenText = (isset($data['prizeeleventext'])) ? $data['prizeeleventext'] : "";
		$this->prizeElevenTextSize = (isset($data['prizeeleventextsize'])) ? $data['prizeeleventextsize'] : 10;
		$this->prizeElevenImage = (isset($data['prizeelevenimage'])) ? $data['prizeelevenimage'] : "";
		$this->prizeElevenUrl = (isset($data['prizeelevenurl'])) ? $data['prizeelevenurl'] : "";
		$this->prizeElevenWeight = (isset($data['prizeelevenweight'])) ? $data['prizeelevenweight'] : 0;		
		$this->prizeTwelveName = (isset($data['prizetwelvename'])) ? $data['prizetwelvename'] : "";
		$this->prizeTwelveCode = (isset($data['prizetwelvecode'])) ? $data['prizetwelvecode'] : "";
		$this->prizeTwelveText = (isset($data['prizetwelvetext'])) ? $data['prizetwelvetext'] : "";
		$this->prizeTwelveTextSize = (isset($data['prizetwelvetextsize'])) ? $data['prizetwelvetextsize'] : 10;
		$this->prizeTwelveImage = (isset($data['prizetwelveimage'])) ? $data['prizetwelveimage'] : "";
		$this->prizeTwelveUrl = (isset($data['prizetwelveurl'])) ? $data['prizetwelveurl'] : "";
		$this->prizeTwelveWeight = (isset($data['prizetwelveweight'])) ? $data['prizetwelveweight'] : 0;
		$this->sponserImage = (isset($data['sponserimage'])) ? $data['sponserimage'] : "";
		$this->sponserLink = (isset($data['sponserlink'])) ? $data['sponserlink'] : "";
		$this->backImage = (isset($data['backimage'])) ? $data['backimage'] : "";
		$this->topImage = (isset($data['topimage'])) ? $data['topimage'] : "";
		$this->buttonImage = (isset($data['buttonimage'])) ? $data['buttonimage'] : "";
		$this->sendEmailNotifications = (isset($data['sendemailnotifications'])) ? $data['sendemailnotifications'] : false;
		$this->notificationEmailAddress = (isset($data['notificationemailaddress'])) ? $data['notificationemailaddress'] : "";
		$this->smtpServer = (isset($data['smtpserver'])) ? $data['smtpserver'] : "";
		$this->smtpUserName = (isset($data['smtpusername'])) ? $data['smtpusername'] : "";
		$this->smtpPassword = (isset($data['smtppassword'])) ? $data['smtppassword'] : "";
		$this->smtpPort = (isset($data['smtpport'])) ? $data['smtpport'] : 25;
		$this->smtpFromAddress = (isset($data['smtpfromaddress'])) ? $data['smtpfromaddress'] : "";
		$this->smtpEncryption = (isset($data['smtpencryption'])) ? $data['smtpencryption'] : "none";
		$this->smtpAuthMethod = (isset($data['smtpauthmethod'])) ? $data['smtpauthmethod'] : "login";
		$this->notificationEmailSubject = (isset($data['notificationemailsubject'])) ? $data['notificationemailsubject'] : "";
		$this->notificationEmailBody = (isset($data['notificationemailbody'])) ? $data['notificationemailbody'] : "";
		$this->ipAddressFilter = (isset($data['ipaddressfilter'])) ? $data['ipaddressfilter'] : false;
		$this->phoneFilter = (isset($data['phonefilter'])) ? $data['phonefilter'] : false;
		$this->emailFilter = (isset($data['emailfilter'])) ? $data['emailfilter'] : false;
		$this->enabled = (isset($data['enabled'])) ? $data['enabled'] : true;
		$this->createDateTime = (isset($data['createdatetime'])) ? $data['createdatetime'] : null;
		$this->prizeWheelTypeName = (isset($data['prizewheeltypename'])) ? $data['prizewheeltypename'] : "";
		$this->views = (isset($data['views'])) ? $data['views'] : 0;
		$this->plays = (isset($data['plays'])) ? $data['plays'] : 0;
		$this->advertisementClicks = (isset($data['advertisementclicks'])) ? $data['advertisementclicks'] : 0;
		$this->categories = (isset($data['categories'])) ? $data['categories'] : array();
  	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'prizewheeltypeid' => $this->prizeWheelTypeId,
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
			'createdatetime' => $this->createDateTime,
			'prizewheeltypename' => $this->prizeWheelTypeName,
			'views' => $this->views,
			'plays' => $this->plays,
			'advertisementclicks' => $this->advertisementClicks,
			'categories' => $this->categories
		);
 	}

 	public function parseAdvertisements($advertisements=array())
 	{
 		if($this->prizeWheelTypeId == \Application\Model\PrizeWheelType::Personalized){
 			foreach($advertisements as $advertisement){
 				if($advertisement instanceof \Application\Model\Advertisement &&
 						$advertisement->advertisementPlacementTypeId() == \Application\Model\AdvertisementPlacementType::Sponser){
 					return array(
 						'sponserimage' => $advertisement->bannerImage(),
 						'sponserlink' => '/ads/click/' . $advertisement->id()	. '/' . $this->id()
 					);
 				} // if
 			} // foreach
 		} // if
 		else if($this->prizeWheelTypeId == \Application\Model\PrizeWheelType::AdDriven){ 			
 			$options = array();
 			
 			$prizeWheelOptions = array();
 			
 			foreach($advertisements as $advertisement){
 				if($advertisement instanceof \Application\Model\Advertisement){ 					
 					if($advertisement->advertisementPlacementTypeId() == \Application\Model\AdvertisementPlacementType::Sponser){
 						$options['sponserimage'] = $advertisement->id().'/'.$advertisement->bannerImage();
 						$options['sponserlink'] = '/ads/click/' . $advertisement->id() . '/' . $this->id();
 					} // if
 					else{
 						$prizeWheelOptions[] = array(
 							'image' => $advertisement->id().'/'. $advertisement->bannerImage(),
 							'name' => $advertisement->name(),
 							'code' => $advertisement->id(),
 							'url' => '/ads/click/' . $advertisement->id() . '/' . $this->id(),
 							'textsize' => 10,
 							'text' => $advertisement->name() 	
 						);
 					} // else
 				} // if
 			} // foreach
 			
 			$prizeWheelOptionCount = count($prizeWheelOptions);
 			
 			if($prizeWheelOptionCount < 12 && $prizeWheelOptionCount > 0){
 				$difference = 12 - $prizeWheelOptionCount;

 				for($i = 0; $i < $difference; $i++){
 					$element = rand(0, $prizeWheelOptionCount - 1);
 					$prizeWheelOptions[] = $prizeWheelOptions[$element];
 				} // for
 			} // if
 			
 			$counter = 1;
 			
 			foreach($prizeWheelOptions as $pzwo){
 				
 				$numerical = $this->getNumericalTextRepresentation($counter);
 				
 				$options['prize'.$numerical.'image'] = $pzwo['image'];
 				$options['prize'.$numerical.'name'] = $pzwo['name'];
 				$options['prize'.$numerical.'code'] = $pzwo['code'];
 				$options['prize'.$numerical.'url'] = $pzwo['url'];
 				$options['prize'.$numerical.'weight'] = ($counter % 3) > 0 ? 8 : 9;
 				$options['prize'.$numerical.'textsize'] = $pzwo['textsize'];
 				$options['prize'.$numerical.'text'] = $pzwo['text'];
 				
 				$counter++;
 			} // foreach

 			return $options;
 		} // else
 	} // parseAdvertisements
 	
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
 		} // switch
 	
 		return "";
 	} // getNumericalTextRepresentation
 	
 	public function getSettingsXml($options=array())
 	{
 		$adir = "/images/advertisements/";
 		$idir = "/images/prizewheels/".$this->pageId."/";
 		
 		$image1 = "";
 		if(!isset($options['prizeoneimage'])){
 			$image1 = strlen($this->prizeOneImage) > 0 ? $idir.$this->getPrizeOneImage() : '/images/green.png';
 		} // if
 		else{
 			$image1 = $adir.$options['prizeoneimage'];
 		} // else
 		
 		$image2 = "";
 		if(!isset($options['prizetwoimage'])){
 			$image2 = strlen($this->prizeTwoImage) > 0 ? $idir.$this->getPrizeTwoImage() : '/images/orange.png';
 		} // if
 		else{
 			$image2 = $adir.$options['prizetwoimage'];
 		} // else
 			
 		$image3 = "";
 		if(!isset($options['prizethreeimage'])){
 			$image3 = strlen($this->prizeThreeImage) > 0 ? $idir.$this->getPrizeThreeImage() : '/images/purple.png';
 		} // if
 		else{
 			$image3 = $adir.$options['prizethreeimage'];
 		} // else
 		
 		$image4 = "";
 		if(!isset($options['prizefourimage'])){
 			$image4 = strlen($this->prizeFourImage) > 0 ? $idir.$this->getPrizeFourImage() : '/images/yellow.png';
 		} // if
 		else{
 			$image4 = $adir.$options['prizefourimage'];
 		} // else
 		
 		$image5 = "";
 		if(!isset($options['prizefiveimage'])){
 			$image5 = strlen($this->prizeFiveImage) > 0 ? $idir.$this->getPrizeFiveImage() : '/images/blue.png';
 		} // if
 		else{
 			$image5 = $adir.$options['prizefiveimage'];
 		} // else
 		
 		$image6 = "";
 		if(!isset($options['prizesiximage'])){
 			$image6 = strlen($this->prizeSixImage) > 0 ? $idir.$this->getPrizeSixImage() : '/images/red.png';
 		} // if
 		else{
 			$image6 = $adir.$options['prizesiximage'];
 		} // else
 		
 		$image7 = "";
 		if(!isset($options['prizesevenimage'])){
 			$image7 = strlen($this->prizeSevenImage) > 0 ? $idir.$this->getPrizeSevenImage() : '/images/green.png';
 		} // if
 		else{
 			$image7 = $adir.$options['prizesevenimage'];
 		} // else
 			
 		$image8 = "";
 		if(!isset($options['prizeeightimage'])){
 			$image8 = strlen($this->prizeEightImage) > 0 ? $idir.$this->getPrizeEightImage() : '/images/red.png';
 		} // if
 		else{
 			$image8 = $adir.$options['prizeeightimage'];
 		} // else
 		
 		$image9 = "";
 		if(!isset($options['prizenineimage'])){
 			$image9 = strlen($this->prizeNineImage) > 0 ? $idir.$this->getPrizeNineImage() : '/images/yellow.png';
 		} // if
 		else{
 			$image9 = $adir.$options['prizenineimage'];
 		} // else
 		
 		$image10 = "";
 		if(!isset($options['prizetenimage'])){
 			$image10 = strlen($this->prizeTenImage) > 0 ? $idir.$this->getPrizeTenImage() : '/images/orange.png';
 		} // if
 		else{
 			$image10 = $adir.$options['prizetenimage'];
 		} // else
 		
 		$image11 = "";
 		if(!isset($options['prizeelevenimage'])){
 			$image11 = strlen($this->prizeElevenImage) > 0 ? $idir.$this->getPrizeElevenImage() : '/images/blue.png';
 		} // if
 		else{
 			$image11 = $adir.$options['prizeelevenimage'];
 		} // else
 		
 		$image12 = "";
 		if(!isset($options['prizetwelveimage'])){
 			$image12 = strlen($this->prizeTwelveImage) > 0 ? $idir.$this->getPrizeTwelveImage() : '/images/purple.png';
 		} // if
 		else{
 			$image12 = $adir.$options['prizetwelveimage'];
 		} // else
 		
 		$sponserLink = $this->sponserLink; 		
 		if(isset($options['sponserlink'])){
 			$sponserLink = $options['sponserlink'];
 		} // if
 		
 		$sponserImage = "";
 		if(!isset($options['sponserimage'])){
 			$sponserImage = strlen($this->sponserImage) > 0 ? $idir.$this->getPrizeTwelveImage() : '/images/test.jpg';
 		} // if
 		else{
 			$sponserImage = $adir.$options['sponserimage'];
 		} // else

 		$prizeonename = $this->prizeOneName;
 		if(isset($options['prizeonename'])){
 			$prizeonename = $options["prizeonename"];
 		} // if
 		
 		$prizeonecode = $this->prizeOneCode;
 		if(isset($options['prizeonecode'])){
 			$prizeonecode = $options['prizeonecode'];
 		}
 		
 		$prizeoneurl = $this->prizeOneUrl;
 		if(isset($options['prizeoneurl'])){
 			$prizeoneurl = $options['prizeoneurl'];
 		} // if
 		
 		$prizeoneweight = $this->prizeOneWeight;
 		if(isset($options['prizeoneweight'])){
 			$prizeoneweight = $options['prizeoneweight'];
 		} // if
 		
 		$prizeonetextsize = $this->prizeOneTextSize;
 		if(isset($options['prizeonetextsize'])){
 			$prizeonetextsize = $options['prizeonetextsize'];
 		} // if
 		
 		$prizeonetext = $this->prizeOneText;
 		if(isset($options['prizeonetext'])){
 			$prizeonetext = $options['prizeonetext'];
 		} // if
 		
 		$prizetwoname = $this->prizeTwoName;
 		if(isset($options['prizetwoname'])){
 			$prizetwoname = $options["prizetwoname"];
 		} // if
 		
 		$prizetwocode = $this->prizeTwoCode;
 		if(isset($options['prizetwocode'])){
 			$prizetwocode = $options['prizetwocode'];
 		} // if
 		
 		$prizetwourl = $this->prizeTwoUrl;
 		if(isset($options['prizetwourl'])){
 			$prizetwourl = $options['prizetwourl'];
 		} // if
 			
 		$prizetwoweight = $this->prizeTwoWeight;
 		if(isset($options['prizetwoweight'])){
 			$prizetwoweight = $options['prizetwoweight'];
 		} // if
 			
 		$prizetwotextsize = $this->prizeTwoTextSize;
 		if(isset($options['prizetwotextsize'])){
 			$prizetwotextsize = $options['prizetwotextsize'];
 		} // if
 			
 		$prizetwotext = $this->prizeTwoText;
 		if(isset($options['prizetwotext'])){
 			$prizetwotext = $options['prizetwotext'];
 		} // if
 		
 		$prizethreename = $this->prizeThreeName;
 		if(isset($options['prizethreename'])){
 			$prizetwoname = $options["prizethreename"];
 		} // if
 		
 		$prizethreecode = $this->prizeThreeCode;
 		if(isset($options['prizethreecode'])){
 			$prizethreecode = $options['prizethreecode'];
 		} // if
 		
 		$prizethreeurl = $this->prizeThreeUrl;
 		if(isset($options['prizethreeurl'])){
 			$prizethreeurl = $options['prizethreeurl'];
 		} // if
 			
 		$prizethreeweight = $this->prizeThreeWeight;
 		if(isset($options['prizethreeweight'])){
 			$prizethreeweight = $options['prizethreeweight'];
 		} // if
 			
 		$prizethreetextsize = $this->prizeThreeTextSize;
 		if(isset($options['prizethreetextsize'])){
 			$prizethreetextsize = $options['prizethreetextsize'];
 		} // if
 			
 		$prizethreetext = $this->prizeThreeText;
 		if(isset($options['prizethreetext'])){
 			$prizethreetext = $options['prizethreetext'];
 		} // if
 		
 		$prizefourname = $this->prizeFourName;
 		if(isset($options['prizefourname'])){
 			$prizefourname = $options['prizefourname'];
 		} // if
 		
 		$prizefourcode = $this->prizeFourCode;
 		if(isset($options['prizefourcode'])){
 			$prizefourcode = $options['prizefourcode'];
 		}
 		
 		$prizefoururl = $this->prizeFourUrl;
 		if(isset($options['prizefoururl'])){
 			$prizefoururl = $options['prizefoururl'];
 		} // if
 			
 		$prizefourweight = $this->prizeFourWeight;
 		if(isset($options['prizefourweight'])){
 			$prizefourweight = $options['prizefourweight'];
 		} // if
 			
 		$prizefourtextsize = $this->prizeFourTextSize;
 		if(isset($options['prizefourtextsize'])){
 			$prizefourtextsize = $options['prizefourtextsize'];
 		} // if
 			
 		$prizefourtext = $this->prizeFourText;
 		if(isset($options['prizefourtext'])){
 			$prizefourtext = $options['prizefourtext'];
 		} // if
 		
 		$prizefivename = $this->prizeFiveName;
 		if(isset($options['prizefivename'])){
 			$prizefivename = $options['prizefivename'];
 		} // if
 		
 		$prizefivecode = $this->prizeFiveCode;
 		if(isset($options['prizefivecode'])){
 			$prizefivecode = $options['prizefivecode'];
 		} // if
 		
 		$prizefiveurl = $this->prizeFiveUrl;
 		if(isset($options['prizefiveurl'])){
 			$prizefiveurl = $options['prizefiveurl'];
 		} // if
 			
 		$prizefiveweight = $this->prizeFiveWeight;
 		if(isset($options['prizefiveweight'])){
 			$prizefiveweight = $options['prizefiveweight'];
 		} // if
 			
 		$prizefivetextsize = $this->prizeFiveTextSize;
 		if(isset($options['prizefivetextsize'])){
 			$prizefivetextsize = $options['prizefivetextsize'];
 		} // if
 			
 		$prizefivetext = $this->prizeFiveText;
 		if(isset($options['prizefivetext'])){
 			$prizefivetext = $options['prizefivetext'];
 		} // if
 		
 		$prizesixname = $this->prizeSixName;
 		if(isset($options['prizesixname'])){
 			$prizesixname = $options['prizesixname'];
 		} // if
 		
 		$prizesixcode = $this->prizeSixCode;
 		if(isset($options['prizesixcode'])){
 			$prizesixcode = $options['prizesixcode'];
 		} // if
 		
 		$prizesixurl = $this->prizeSixUrl;
 		if(isset($options['prizesixurl'])){
 			$prizesixurl = $options['prizesixurl'];
 		} // if
 			
 		$prizesixweight = $this->prizeSixWeight;
 		if(isset($options['prizesixweight'])){
 			$prizesixweight = $options['prizesixweight'];
 		} // if
 			
 		$prizesixtextsize = $this->prizeSixTextSize;
 		if(isset($options['prizesixtextsize'])){
 			$prizesixtextsize = $options['prizesixtextsize'];
 		} // if
 			
 		$prizesixtext = $this->prizeSixText;
 		if(isset($options['prizesixtext'])){
 			$prizesixtext = $options['prizesixtext'];
 		} // if
 		
 		$prizesevenname = $this->prizeSevenName;
 		if(isset($options['prizesevenname'])){
 			$prizesevenname = $options['prizesevenname'];
 		} // if
 		
 		$prizesevencode = $this->prizeSevenCode;
 		if(isset($options['prizesevencode'])){
 			$prizesevencode = $options['prizesevencode'];
 		} // if
 		
 		$prizesevenurl = $this->prizeSevenUrl;
 		if(isset($options['prizesevenurl'])){
 			$prizesevenurl = $options['prizesevenurl'];
 		} // if
 			
 		$prizesevenweight = $this->prizeSevenWeight;
 		if(isset($options['prizesevenweight'])){
 			$prizesevenweight = $options['prizesevenweight'];
 		} // if
 			
 		$prizeseventextsize = $this->prizeSevenTextSize;
 		if(isset($options['prizeseventextsize'])){
 			$prizeseventextsize = $options['prizeseventextsize'];
 		} // if
 			
 		$prizeseventext = $this->prizeSevenText;
 		if(isset($options['prizeseventext'])){
 			$prizeseventext = $options['prizeseventext'];
 		} // if
 		
 		$prizeeightname = $this->prizeEightName;
 		if(isset($options['prizeeightname'])){
 			$prizeeightname = $options['prizeeightname'];
 		} // if
 		
 		$prizeeightcode = $this->prizeEightCode;
 		if(isset($options['prizeeightcode'])){
 			$prizeeightcode = $options['prizeeightcode'];	
 		} // if
 		
 		$prizeeighturl = $this->prizeEightUrl;
 		if(isset($options['prizeeighturl'])){
 			$prizeeighturl = $options['prizeeighturl'];
 		} // if
 			
 		$prizeeightweight = $this->prizeEightWeight;
 		if(isset($options['prizeeightweight'])){
 			$prizeeightweight = $options['prizeeightweight'];
 		} // if
 			
 		$prizeeighttextsize = $this->prizeEightTextSize;
 		if(isset($options['prizeeighttextsize'])){
 			$prizeeighttextsize = $options['prizeeighttextsize'];
 		} // if
 			
 		$prizeeighttext = $this->prizeEightText;
 		if(isset($options['prizeeighttext'])){
 			$prizeeighttext = $options['prizeeighttext'];
 		} // if
 		
 		$prizeninename = $this->prizeNineName;
 		if(isset($options['prizeninename'])){
 			$prizeninename = $options['prizeninename'];
 		} // if
 		
 		$prizeninecode = $this->prizeNineCode;
 		if(isset($options['prizeninecode'])){
 			$prizeninecode = $options['prizeninecode'];
 		} // if
 		
 		$prizenineurl = $this->prizeNineUrl;
 		if(isset($options['prizenineurl'])){
 			$prizenineurl = $options['prizenineurl'];
 		} // if
 			
 		$prizenineweight = $this->prizeNineWeight;
 		if(isset($options['prizenineweight'])){
 			$prizenineweight = $options['prizenineweight'];
 		} // if
 			
 		$prizeninetextsize = $this->prizeNineTextSize;
 		if(isset($options['prizeninetextsize'])){
 			$prizeninetextsize = $options['prizeninetextsize'];
 		} // if
 			
 		$prizeninetext = $this->prizeNineText;
 		if(isset($options['prizeninetext'])){
 			$prizeninetext = $options['prizeninetext'];
 		} // if
 		
 		$prizetenname = $this->prizeTenName;
 		if(isset($options['prizetenname'])){
 			$prizetenname = $options['prizetenname'];
 		} // if
 		
 		$prizetencode = $this->prizeTenCode;
 		if(isset($options['prizetencode'])){
 			$prizetencode = $options['prizetencode'];
 		} // if
 		
 		$prizetenurl = $this->prizeTenUrl;
 		if(isset($options['prizetenurl'])){
 			$prizetenurl = $options['prizetenurl'];
 		} // if
 			
 		$prizetenweight = $this->prizeTenWeight;
 		if(isset($options['prizetenweight'])){
 			$prizetenweight = $options['prizetenweight'];
 		} // if
 			
 		$prizetentextsize = $this->prizeTenTextSize;
 		if(isset($options['prizetentextsize'])){
 			$prizetentextsize = $options['prizetentextsize'];
 		} // if
 			
 		$prizetentext = $this->prizeTenText;
 		if(isset($options['prizetentext'])){
 			$prizetentext = $options['prizetentext'];
 		} // if
 		
 		$prizeelevenname = $this->prizeElevenName;
 		if(isset($options['prizeelevenname'])){
 			$prizeelevenname = $options['prizeelevenname'];
 		} // if
 		
 		$prizeelevencode = $this->prizeElevenCode;
 		if(isset($options['prizeelevencode'])){
 			$prizeelevencode = $options['prizeelevencode'];
 		} // if
 		
 		$prizeelevenurl = $this->prizeElevenUrl;
 		if(isset($options['prizeelevenurl'])){
 			$prizeelevenurl = $options['prizeelevenurl'];
 		} // if
 			
 		$prizeelevenweight = $this->prizeElevenWeight;
 		if(isset($options['prizeelevenweight'])){
 			$prizeelevenweight = $options['prizeelevenweight'];
 		} // if
 			
 		$prizeeleventextsize = $this->prizeElevenTextSize;
 		if(isset($options['prizeeleventextsize'])){
 			$prizeeleventextsize = $options['prizeeleventextsize'];
 		} // if
 			
 		$prizeeleventext = $this->prizeElevenText;
 		if(isset($options['prizeeleventext'])){
 			$prizeeleventext = $options['prizeeleventext'];
 		} // if
 		
 		$prizetwelvename = $this->prizeTwelveName;
 		if(isset($options['prizetwelvename'])){
 			$prizetwelvename = $options['prizetwelvename'];
 		} // if
 		
 		$prizetwelvecode = $this->prizeTwelveCode;
 		if(isset($options['prizetwelvecode'])){
 			$prizetwelvecode = $options['prizetwelvecode'];
 		} // if
 		
 		$prizetwelveurl = $this->prizeTwelveUrl;
 		if(isset($options['prizetwelveurl'])){
 			$prizetwelveurl = $options['prizetwelveurl'];
 		} // if
 			
 		$prizetwelveweight = $this->prizeTwelveWeight;
 		if(isset($options['prizetwelveweight'])){
 			$prizetwelveweight = $options['prizetwelveweight'];
 		} // if
 			
 		$prizetwelvetextsize = $this->prizeTwelveTextSize;
 		if(isset($options['prizetwelvetextsize'])){
 			$prizetwelvetextsize = $options['prizetwelvetextsize'];
 		} // if
 			
 		$prizetwelvetext = $this->prizeTwelveText;
 		if(isset($options['prizetwelvetext'])){
 			$prizetwelvetext = $options['prizetwelvetext'];
 		} // if
 		
 		$backImage = strlen($this->backImage) > 0 ? $this->backImage : '/images/back.png';
		$topImage = strlen($this->topImage) > 0 ? $this->topImage : '/images/top.png';
		$buttonImage = strlen($this->buttonImage) > 0 ? $this->buttonImage : '/images/spinit.png';
		
		$xmloutput = '<spinwheel>
						<warning>
							<validemail>'.$this->validEmail.'</validemail>
							<alreadyplayed>'.$this->alreadyPlayed().'</alreadyplayed>
							<errorsubmit>'.$this->errorSubmit.'</errorsubmit>
							<errorprize>'.$this->errorPrize.'</errorprize>
							<accesserror>'.$this->accessError.'</accesserror>
							<accesslimit>'.$this->accessLimit.'</accesslimit>
						</warning>
						<firsttext>'.$this->firstText.'</firsttext>
						<textrule>'.$this->textRules.'</textrule>
						<formlink value="/prize-wheel/submit/'.$this->id.'"/>
						<settings>
							<data text="'.$prizeonename.'" code="'.$prizeonecode.'" link="'.$prizeoneurl.'" prob="'.$prizeoneweight.'" color="'.$image1.'"><font size="'.$prizeonetextsize.'"><span>'.$prizeonetext.'</span></font></data>
							<data text="'.$prizetwoname.'" code="'.$prizetwocode.'" link="'.$prizetwourl.'" prob="'.$prizetwoweight.'" color="'.$image2.'"><font size="'.$prizetwotextsize.'"><span>'.$prizetwotext.'</span></font></data>
							<data text="'.$prizethreename.'"  code="'.$prizethreecode.'" link="'.$prizethreeurl.'" prob="'.$prizethreeweight.'" color="'.$image3.'"><font size="'.$prizethreetextsize.'"><span>'.$prizethreetext.'</span></font></data>
							<data text="'.$prizefourname.'"  code="'.$prizefourcode.'" link="'.$prizefoururl.'" prob="'.$prizefourweight.'" color="'.$image4.'"><font size="'.$prizefourtextsize.'"><span>'.$prizefourtext.'</span></font></data>
							<data text="'.$prizefivename.'" code="'.$prizefivecode.'" link="'.$prizefiveurl.'" prob="'.$prizefiveweight.'" color="'.$image5.'"><font size="'.$prizefivetextsize.'"><span>'.$prizefivetext.'</span></font></data>
							<data text="'.$prizesixname.'" code="'.$prizesixcode.'" link="'.$prizesixurl.'" prob="'.$prizesixweight.'" color="'.$image6.'"><font size="'.$prizesixtextsize.'"><span>'.$prizesixtext.'</span></font></data>
							<data text="'.$prizesevenname.'"  code="'.$prizesevencode.'" link="'.$prizesevenurl.'" prob="'.$prizesevenweight.'" color="'.$image7.'"><font size="'.$prizeseventextsize.'"><span>'.$prizeseventext.'</span></font></data>
							<data text="'.$prizeeightname.'"  code="'.$prizeeightcode.'" link="'.$prizeeighturl.'" prob="'.$prizeeightweight.'" color="'.$image8.'"><font size="'.$prizeeighttextsize.'"><span>'.$prizeeighttext.'</span></font></data>
							<data text="'.$prizeninename.'"  code="'.$prizeninecode.'" link="'.$prizenineurl.'" prob="'.$prizenineweight.'" color="'.$image9.'"><font size="'.$prizeninetextsize.'"><span>'.$prizeninetext.'</span></font></data>
							<data text="'.$prizetenname.'"  code="'.$prizetencode.'" link="'.$prizetenurl.'" prob="'.$prizetenweight.'" color="'.$image10.'"><font size="'.$prizetentextsize.'"><span>'.$prizetentext.'</span></font></data>
							<data text="'.$prizeelevenname.'"  code="'.$prizeelevencode.'" link="'.$prizeelevenurl.'" prob="'.$prizeelevenweight.'" color="'.$image11.'"><font size="'.$prizeeleventextsize.'"><span>'.$prizeeleventext.'</span></font></data>
							<data text="'.$prizetwelvename.'"  code="'.$prizetwelvecode.'" link="'.$prizetwelveurl.'" prob="'.$prizetwelveweight.'" color="'.$image12.'"><font size="'.$prizetwelvetextsize.'"><span>'.$prizetwelvetext.'</span></font></data>
							<nostop value="0"/> <!-- If 0 then all permit stop there -->
						</settings>
						<sponsor>
							<image value="'.$sponserImage.'" link="'.$sponserLink.'"></image>
						</sponsor>
						<back>
							<image value="'.$backImage.'"></image>
						</back>
						<top>
							<image value="'.$topImage.'"></image>
						</top>
						<button>
							<image value="'.$buttonImage.'"></image>
						</button>
					</spinwheel>';
				
 		return $xmloutput;
 	}
}