<?php

namespace Application\Model;

interface UserDataSourceInterface
{
	/**
	 * 
	 * @param unknown $username
	 * @return User|null The user or null pointer.
	 */
	function getUserByUserName($username);
	
	/**
	 * 
	 * @param unknown $userid
	 * @param unknown $password
	 * @return boolean Whether or not the update was successful.
	 */
	function updatePassword($userid, $password);
	
	/**
	 * 
	 * @param unknown $username
	 * @param unknown $password
	 * @return boolean Whether or not the update was successful.
	 */
	function updateUserNamePassword($username, $password);
}