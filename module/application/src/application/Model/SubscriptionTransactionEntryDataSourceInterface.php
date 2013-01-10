<?php

namespace Application\Model;

interface SubscriptionTransactionEntryDataSourceInterface
{
	function fetchAll($page=1, $size=25, &$count);
	function fetchAllByPrizeWheelId($prizewheelid=0, $page=1, $size=25, &$count);
	function getCount();
	function search(array $criteria=null, $page=1, $size=25, &$count);
	function getCountByCriteria(array $criteria=null);
	function getSubscriptionTransactionEntry($id);
	function getSubscriptionTransactionEntryByPaymentId($paymentid);
	function getSubscriptionsByPrizeWheelId($prizewheelid);
	function save(SubscriptionTransactionEntry $entry);
}