<?php

namespace Application\Model;

class ConfigurationEntry
{
	protected $id = 0;
	protected $name = "";
	protected $value = "";
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function name($name="")
	{
		if(!empty($name)){
			$this->name = $name;
		} // if
		return $this->name;
	}
	
	public function value($value="")
	{
		if(!empty($value)){
			$this->value = $value;
		} // if
		return $this->value;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : $this->id;
		$this->name = (isset($data['name'])) ? $data['name'] : $this->name;
		$this->value = (isset($data['value'])) ? $data['value'] : $this->value;	
	}
	
	public function getArrayCopy()
	{
		return array(
			"id" => $this->id,
			"name" => $this->name,
			"value" => $this->value		
		);
	}
}