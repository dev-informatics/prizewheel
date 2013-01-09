<?php

namespace Application\Model;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class PrizeWheelAuthenticationAdapter implements AdapterInterface
{
	protected $userDataSourceInterface = null;
	protected $blockCipher = null;
	protected $username = "";
	protected $password = "";
	
	public function userName($username='')
	{
		if(!empty($username)){
			$this->username = $username;
		} // if
		return $this->username;
	}
	
	public function password($password='')
	{
		if(!empty($password)){
			$this->password = $password;
		} // if
		return $this->password;
	}
	
	public function __construct(\Application\Model\UserDataSourceInterface $userDataSourceInterface, \Zend\Crypt\BlockCipher $blockCipher, $username='', $password='')
	{
		$this->userDataSourceInterface = $userDataSourceInterface;
		$this->blockCipher = $blockCipher;
		$this->username = $username;
		$this->password = $password;
	}
	
	public function authenticate()
	{
		 $user = $this->userDataSourceInterface->getUserByUserName($this->username);	 
		 
		 if(!$user){
		 	$result = new Result(Result::FAILURE_IDENTITY_NOT_FOUND, $this->username, array(
		 				"User Name and or Password not valid"
		 			));
		 	return $result;
		 } // if
		 
		 $dbPasswordValue = $this->blockCipher->decrypt($user->password());
		 
		 if($dbPasswordValue != $this->password){
		 	$result = new Result(Result::FAILURE_CREDENTIAL_INVALID, $this->username, array(
		 			"User Name and or Password not valid"
		 	));
		 	return $result;
		 } // if
		 
		 $result = new Result(Result::SUCCESS, $this->username);
		 return $result;
	}
}