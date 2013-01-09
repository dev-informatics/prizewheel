<?php

namespace Application\Model;

class UserTable implements UserDataSourceInterface
{
	protected $tableGateway;
	
	public function __construct(\Zend\Db\TableGateway\TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	} // ctor
	
	public function getUserByUserName($username)
	{
		$results = $this->tableGateway->select(array('username' => $username));
		
		$result = $results->current();
		
		if(!$results){
			return null;
		} // if
		
		return $result;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Application\Model\UserDataSourceInterface::updatePassword()
	 */
	public function updatePassword($userid, $password)
	{
		$userid = (int)$userid;
		$password = (string)$password;
		
		try{
			return $this->tableGateway->update(array('password' => $password), array('id' => $userid));
		} // try
		catch(\Exception $e){
			throw new \Exception("There was an error while attempting to update the password for User ID: $userid", null, $e);
		} // catch
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Application\Model\UserDataSourceInterface::updateUserNamePassword()
	 */
	public function updateUserNamePassword($username, $password)
	{
		$username = (string)$username;
		$password = (string)$password;
		
		try{
			return $this->tableGateway->update(array('password' => $password), array('username' => $username));
		} // try
		catch(\Exception $e){
			throw new \Exception("There was an error while attempting to update the password for User Name: $username", null, $e);
		} // catch
	}
}