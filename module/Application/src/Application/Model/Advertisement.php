<?php

namespace Application\Model;

class Advertisement
{
	protected $id;
	protected $advertiserId;
	protected $name;
	protected $description;
	protected $typeId;
	protected $bannerImage;
	protected $url;
	protected $bucket = 0;
	protected $enabled;
	protected $createDateTime;
	protected $typeName;
	protected $clicks;
	protected $impressions;	
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		}
		return $this->id;
	}
	
	public function advertiserId($advertiserid=0)
	{
		if(!empty($advertiserid)){
			$this->advertiserId = $advertiserid;
		} // if
		return $this->advertiserId;
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
		}
		return $this->description;
	}
	
	public function typeId($typeid=0)
	{
		if(!empty($typeid)){
			$this->typeId = $typeid;
		} // if
		return $this->typeId;
	}
	
	public function bannerImage($bannerimage='')
	{
		if(!empty($bannerimage)){
			$this->bannerImage = $bannerimage;
		} // if
		return $this->bannerImage;
	}
	
	public function url($url='')
	{
		if(!empty($url)){
			$this->url = $url;
		} // if
		return $this->url;
	}
	
	public function bucket($bucket=null)
	{
		if(!empty($bucket)){
			$this->bucket = $bucket;
		} // if
		return $this->bucket;
	}
	
	public function enabled($enabled=null)
	{
		if(!empty($enabled) && is_bool($enabled)){
			$this->enabled = $enabled;
		}  // if
		return $this->enabled;
	}
	
	public function createDateTime($createdatetime='')
	{
		if(!empty($createdatetime)){
			$this->createDateTime = $createdatetime;
		} // if
		return $this->createDateTime;
	}
	
	public function typeName()
	{
		return $this->typeName;
	}
	
	public function clicks($clicks=null)
	{
		if(!empty($clicks)){
			$this->clicks = $clicks;
		} // if
		return $this->clicks;
	}
	
	public function impressions($impressions=null)
	{
		if(!empty($impressions)){
			$this->impressions = $impressions;
		} // if
		return $this->impressions;
	}
	
	public function __construct()
	{
		
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : 0;
		$this->advertiserId = (isset($data['advertiserid'])) ? $data['advertiserid'] : 0;
		$this->name = (isset($data['name'])) ? $data['name'] : null;
		$this->description = (isset($data['description'])) ? $data['description'] : null;
		$this->typeId = (isset($data['typeid'])) ? $data['typeid'] : 0;
		$this->bannerImage = (isset($data['bannerimage'])) ? $data['bannerimage'] : null;
		$this->url = (isset($data['url'])) ? $data['url'] : null;
		$this->bucket = (isset($data['bucket'])) ? $data['bucket'] : (!$this->bucket ? 0 : $this->bucket);
		$this->enabled = (isset($data['enabled'])) ? $data['enabled'] : false;
		$this->createDateTime = (isset($data['createdatetime'])) ? $data['createdatetime'] : null;
		$this->typeName = (isset($data['typename'])) ? $data['typename'] : null;
		$this->impressions = (isset($data['impressions'])) ? $data['impressions'] : 0;
		$this->clicks = (isset($data['clicks'])) ? $data['clicks'] : 0;	
	} 
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'advertiserid' => $this->advertiserId,	
			'name' => $this->name,
			'description' => $this->description,
			'typeid' => $this->typeId,
			'bannerimage' => $this->bannerImage,
			'url' => $this->url,
			'bucket' => $this->bucket,
			'enabled' => $this->enabled,
			'createdatetime' => $this->createDateTime,
			'typename' => $this->typeName,
			'clicks' => $this->clicks,
			'impressions' => $this->impressions,	 
		);  
 	}
}