<?php

namespace Application\Model;

interface PrizeWheelDataSourceInterface
{
	function fetchAll($page=1, $size=25, &$count);
	
	function getCount();
	
	function fetchAllByAffiliateId($affiliateid, $page=1, $size=25);
	
	function fetchAllEnabledByAffiliateId($affiliateid, $page=1, $size=25);
	
	/**
	 *
	 * @param unknown $prizewheelid
	 * @return \Application\Model\PrizeWheel
	 */
	function getPrizeWheel($prizewheelid);
	
	function getPrizeWheelByPageId($pageid);
	
	function save(PrizeWheel $prizeWheel);
	
	function delete($id);
	
	function disable($id);
}