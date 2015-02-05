<?php

defined('SYSPATH') or die('No direct script access.');

class Banners {
  
  protected $_banners_path = '/banners';
  
  public static function getPath($type = "image") {
    return $this->_banners_path."/".$type."/";
  }


  public function getPageBanners($page, $only_active = true) {
    $banners = DB::select()
			->from('banners')
      ->join('banners_to_pages', 'left')
      ->on('banners.id', '=', 'banners_to_pages.banner_id')
			->where('page', '=', $page);
		$cachename = "get_";
    if ($only_active) {
      $cachename .= "active_";
      $banners->where('avtive', '=', 1);
    }
    $cachename .= "banners_by_page";
    $banners->cached( 3600, FALSE, $cachename);
    return $banners->execute();
  }
  
  public function getBanner($page, $place) {
    $banners = DB::select()
			->from('banners')
      ->join('banners_to_pages', 'left')
      ->on('banners.id', '=', 'banners_to_pages.banner_id')
			->where('page', '=', $page)
      ->where('place', '=', $place)
      ->where('avtive', '=', 1)
      ->cached( 3600, FALSE, 'get_banner_by_position');

    return $banners->execute();
  }
  
}