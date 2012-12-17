<?php

namespace Application\Model;

class AdvertisementType
{
	private $id;
	private $name;
	private $description;
	
	public function id($id=0)
	{
		if(!empty($id) && is_int($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function name($name='')
	{
		if(!empty($name)){
			$this->name = $name;
		}
		return $this->name;
	}
	
	public function description($description='')
	{
		if(!empty($description)){
			$this->description = $description;
		} // if
		return $this->description;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->name = (isset($data['name'])) ? $data['name'] : null;
		$this->description = (isset($data['description'])) ? $data['description'] : null;
	}
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'name' => $this->name,
			'description' => $this->description
		);
	}
}