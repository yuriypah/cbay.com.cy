<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Geo {

	
	public static function get_regions($id = NULL)
	{
		$data = DB::select()
			->from( 'map' );
		
		$data->where('region_id', '=', 0);
		
		return self::_prepare($data);
	}
	
	public static function get_cities($id = NULL)
	{
		$data = DB::select()
			->from( 'map' );
		
		if($id !== NULL)
			$data->where('region_id', '=', $id);

		return self::_prepare($data);
	}
	
	private static function _prepare($data)
	{
		return $data
			->order_by( 'id')
			->execute()
			->as_array('id', 'name');
	}
}