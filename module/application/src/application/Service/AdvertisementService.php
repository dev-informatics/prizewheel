<?php

namespace Application\Service;

use Application\Model\Advertisement;
use Application\Model\AdvertisementTable;

class AdvertisementService
{
	protected $advertisementTable = null;
	
	public function __construct(AdvertisementTable $advertisementTable)
	{
		$this->advertisementTable = $advertisementTable;
	}
	
	public function fetchAllAdvertisements()
	{
		$advertisements = $this->advertisementTable->fetchAll();
	}
}