<?php defined('SYSPATH') or die('No direct script access.');

class Model_Bookmark_Cookie {
	
	public static $bookmarks = array();
	const COOKIE_KEY = 'bookmarks';

	public static function init()
	{
		$data = Cookie::get(self::COOKIE_KEY, 'a:0:{}');
		try {
			self::$bookmarks = unserialize($data);
		}
		catch (Exception $e)
		{
			self::$bookmarks = array();
		}
	}
		
	
	public function is_bookmark($object, $id)
	{
		return Arr::path(self::$bookmarks, $object. '.' . $id) !== NULL;
	}
	
	public function add_object($object, $id)
	{
		if(!$this->is_bookmark($object, $id))
		{
			self::$bookmarks[$object][$id] = $id;
			
			$this->update();
			return array(TRUE, __('bookmarks.text.'.$object.'.added'));
		}
		
		return $this->delete_object($object, $id);
	}
	
	public function delete_object($object, $id)
	{		
		if($this->is_bookmark($object, $id))
		{
			unset(self::$bookmarks[$object][$id]);
			
			$this->update();
			return array(FALSE, __('bookmarks.text.'.$object.'.deleted'));
		}
		
		return array(NULL, NULL);
	}
	
	public function update()
	{
		Cookie::set(self::COOKIE_KEY, serialize(self::$bookmarks));
	}
}