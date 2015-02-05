<?php defined('SYSPATH') or die('No direct script access.');

class Block {
	
	protected static $_blocks = array();
	
	public static function def($block_name)
	{
		if(Kohana::$profiling === TRUE)
		{
			$benchmark = Profiler::start('Loading def block', $block_name);
		}
		
		$object = self::load($block_name);
		
		if(isset($benchmark))
		{
			Profiler::stop($benchmark);
		}
		
		return $object;
	}

	public static function run($block_name)
	{
		if(Kohana::$profiling === TRUE)
		{
			$benchmark = Profiler::start('Loading run block', $block_name);
		}
		
		$object = self::load($block_name);
		$object->render();
		
		if(isset($benchmark))
		{
			Profiler::stop($benchmark);
		}
	}
	
	public static function load($block_name)
	{
		$object = self::loaded($block_name);

		if($object === FALSE)
		{
			$object = Object::create($block_name);
		}
		
		return $object;
	}

	public static function loaded($block_name)
	{
		if(Arr::get(self::$_blocks, $block_name) instanceof Object)
		{
			return self::$_blocks[$block_name];
		}
		
		return FALSE;
	}
}