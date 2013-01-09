<?php

namespace Application\Model;

interface AdvertisementDataSourceInterface
{
	function fetchAll($page=1, $size=25, &$count);
	
	function getCount();
	
	function fetchAllByAdvertiserId($id);
	
	/**
	 *
	 * @param int $id
	 * @return array:unknown
	 */
	function fetchAllEnabledByAdvertiserId($id);
	
	/**
	 *
	 * @param unknown $id
	 * @return NULL|/Application/Model/Advertisement
	 */
	function getAdvertisement($id);
	
	function getCountOfPlacementType($placementTypeId, $categories=array());
	
	function getRandomOfPlacementType($placementTypeId, $categories=array());
	
	function save(Advertisement $advertisement);
	
	function updateBucket($id, $bucketAmount);
	
	function disable($id);
	
	function delete($id);
}