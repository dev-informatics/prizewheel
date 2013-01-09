<?php

namespace Application\Model;

class Advertisement
{	
	protected $id = 0;
	protected $advertisementPlacementTypeId = 0;
	protected $advertiserId = 0;
	protected $name = "";
	protected $description = "";
	protected $typeId = 0;
	protected $sponserImage = "";
	protected $bannerImage = "";
	protected $url = "";
	protected $bucket = 0;
	protected $enabled = true;
	protected $createDateTime = "";
	protected $typeName = "";
	protected $clicks = 0;
	protected $impressions = 0;	
	protected $categories = array();
	protected $placementTypeName = "";
	protected $advertiserName = "";
	protected $cost = 0.00;
	
	public function id($id=0)
	{
		if(!empty($id)){
			$this->id = $id;
		}
		return $this->id;
	}
	
	public function advertisementPlacementTypeId($advertisementplacementtypeid=0)
	{
		if(!empty($advertisementplacementtypeid)){
			$this->advertisementPlacementTypeId = $advertisementplacementtypeid;
		} // if
		return $this->advertisementPlacementTypeId;
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
	
	public function sponserImage($sponserimage='')
	{
		if(!empty($sponserimage)){
			$this->sponserImage = $sponserimage;
		} // if
		return $this->sponserImage;
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
		if(!empty($enabled)){
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
	
	public function categories($categories=array())
	{
		if(is_array($categories) && count($categories) > 0){
			$this->categories = $categories;
		} // if
		return $this->categories;
	} // categories
	
	public function advertiserName()
	{
		return $this->advertiserName;
	}
	
	public function placementTypeName()
	{
		return $this->placementTypeName;
	}
	
	public function cost()
	{
		return $this->cost;
	}
	
	public function __construct()
	{
		
	}
	
	public function addBucketCredits($amount=0.00)
	{
		$amount = (float)$amount;
		
		$this->bucket += $amount;
		
		return $this;
	}
	
	public function removeBucketCredits($amount=0.00)
	{
		$amount = (float)$amount;
		
		$this->bucket -= $amount;
		
		return $this;
	}
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : $this->id();
		$this->advertisementPlacementTypeId = (isset($data['advertisementplacementtypeid'])) ? $data['advertisementplacementtypeid'] : $this->advertisementPlacementTypeId();
		$this->advertiserId = (isset($data['advertiserid'])) ? $data['advertiserid'] : $this->advertiserId();
		$this->name = (isset($data['name'])) ? $data['name'] : $this->name();
		$this->description = (isset($data['description'])) ? $data['description'] : $this->description();
		$this->typeId = (isset($data['typeid'])) ? $data['typeid'] : $this->typeId();
		$this->sponserImage = (isset($data['sponserimage'])) ? $data['sponserimage'] : $this->sponserImage;
		$this->bannerImage = (isset($data['bannerimage'])) ? $data['bannerimage'] : $this->bannerImage();
		$this->url = (isset($data['url'])) ? $data['url'] : $this->url();
		$this->bucket = (isset($data['bucket'])) ? $data['bucket'] : $this->bucket();
		$this->enabled = (isset($data['enabled'])) ? $data['enabled'] : $this->enabled();
		$this->createDateTime = (isset($data['createdatetime'])) ? $data['createdatetime'] : $this->createDateTime();
		$this->typeName = (isset($data['typename'])) ? $data['typename'] : $this->typeName();
		$this->impressions = (isset($data['impressions'])) ? $data['impressions'] : $this->impressions();
		$this->clicks = (isset($data['clicks'])) ? $data['clicks'] : $this->clicks();
		$this->categories = (isset($data['categories'])) ? $data['categories'] : $this->categories();
		$this->placementTypeName = (isset($data['placementtypename'])) ? $data['placementtypename'] : $this->placementTypeName();
		$this->advertiserName = (isset($data['advertiserfirstname']) && isset($data['advertiserlastname'])) ? ($data['advertiserfirstname'] . " " . $data['advertiserlastname']) : $this->advertiserName();
		$this->cost = (isset($data['cost'])) ? $data['cost'] : $this->cost;
	} 
	
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id,
			'advertisementplacementtypeid' => $this->advertisementPlacementTypeId,
			'advertiserid' => $this->advertiserId,	
			'name' => $this->name,
			'description' => $this->description,
			'typeid' => $this->typeId,
			'sponserimage' => $this->sponserImage,
			'bannerimage' => $this->bannerImage,
			'url' => $this->url,
			'bucket' => $this->bucket,
			'enabled' => $this->enabled,
			'createdatetime' => $this->createDateTime,
			'typename' => $this->typeName,
			'clicks' => $this->clicks,
			'impressions' => $this->impressions,
			'categories' => $this->categories,
			'placementtypename' => $this->placementTypeName,
			'advertisername' => $this->advertiserName,
			'cost' => $this->cost	 
		);   
 	}
}