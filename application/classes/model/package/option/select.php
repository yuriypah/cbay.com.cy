<?php defined('SYSPATH') or die('No direct script access.');

class Model_Package_Option_Select extends Model_Package_Option_Abstract {

	public $column = 'selected';

	public function __construct( $id, $duration, $amount = 0 )
	{
		$this->_type_id = Model_Package_Option::TYPE_SELECTED;

		parent::__construct( $id, $duration, $amount );
	}
}