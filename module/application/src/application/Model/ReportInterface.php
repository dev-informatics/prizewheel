<?php

namespace Application\Model;

interface ReportInterface
{
	function execute(array $options=array());
}