<?php

namespace Application\Model;

class TransactionStatus
{
	const Success = 1;
	const Pending = 2;
	const Failed = 3;
	const Error = 4;
	const Void = 5;
	const Refund = 6;
	const Chargeback = 7;
}