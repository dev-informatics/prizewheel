<?php

namespace Application\Model;

class AdvertisementCategory
{
	protected $id = 0;
	protected $name = "";
	protected $description = "";
	protected $clickRate = 0.00;
	protected $impressionRate = 0.00;
	protected $enabled = false;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		} // if
		return $this->id;
	}
	
	public function name($name='')
	{
		if(!empty($name)){
			$this->name = $name;
		} // if
		return $this->name;
	}
	
	public function description($description='')
	{
		if(!empty($description)){
			$this->description = $description;
		} // if
		return $this->description;
	}
	
	public function clickRate($clickrate=null)
	{
		if(!empty($clickrate)){
			$this->clickRate = $clickrate;
		} // if
		return $this->clickRate;
	}
	
	public function impressionRate($impressionrate=null)
	{
		if(!empty($impressionrate)){
			$this->impressionRate = $impressionrate;
		} // if
		return $this->impressionRate;
	}
	
	public function enabled($enabled=null)
	{
		if(!empty($enabled)){
			$this->enabled = $enabled;
		} // if
		return $this->enabled;
	}
	
	public function __construct()
	{
			
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : $this->id;
		$this->name = (isset($data['name'])) ? $data['name'] : $this->name;
		$this->description = (isset($data['description'])) ? $data['description'] : $this->description;
		$this->clickRate = (isset($data['clickrate'])) ? $data['clickrate'] : $this->clickRate;
		$this->impressionRate = (isset($data['impressionrate'])) ? $data['impressionrate'] : $this->impressionRate;
		$this->enabled = (isset($data['enabled'])) ? $data['enabled'] : $this->enabled;
	}

	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'name' => $this->name,
			'description' => $this->description,
			'clickrate' => $this->clickRate,
			'impressionrate' => $this->impressionRate,
			'enabled' => $this->enabled
		);
	}
}