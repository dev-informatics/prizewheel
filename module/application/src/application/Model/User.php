<?php

namespace Application\Model;

class User
{
	protected $id;
	protected $userName;
	protected $password;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function userName($username='')
	{
		if(!empty($username)){
			 $this->userName = $username;
		} // if
		return $this->userName;
	}
	
	public function password($password='')
	{
		if(!empty($password)){
			$this->password = $password;
		} // if
		return $this->password;
	}
	
	public function __construct($username='', $password='')
	{
		$this->userName = $username;
		$this->password = $password;
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->userName = (isset($data['username'])) ? $data['username'] : "";
		$this->password = (isset($data['password'])) ? $data['password'] : "";
	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'username' => $this->userName,
			'password' => $this->password	
		);
	}
}