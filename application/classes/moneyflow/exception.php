<?php defined('SYSPATH') or die('No direct script access.');

class MoneyFlow_Exception extends Kohana_Exception {

	public function __construct($message = NULL, array $variables = NULL/*, Model_Moneyflow $flow*/)
	{
//		if(!$object->loaded())
//		{
//			$reason = empty($variables) ? $message : strtr($message, $variables);
//			$flow->cancel($reason);
//		}

		parent::__construct($message, $variables);
	}
	
}