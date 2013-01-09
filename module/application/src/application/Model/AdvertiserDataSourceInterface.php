<?php

namespace Application\Model;

interface AdvertiserDataSourceInterface
{
	function fetchAll($page=1, $take=25, &$count);
	
	function getCount();
	
	function getAdvertiser($id);
	
	/**
	 *
	 * @param unknown $facebookuserid
	 * @return NULL|Application\Model\Advertiser
	 */
	function getAdvertiserByFacebookUserId($facebookuserid);
	
	function save(Advertiser $advertiser);
}