<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Advert_Breadcrumbs extends Model_Object {
	
	protected function _execute()
	{
		$path = $this->_params['advert']->category(NULL)->get_keys_path('id', 'title');
		
		$city = $this->_params['advert']->city();
		$city_id = $this->_params['advert']->city_id;
		
		$next_id = DB::select('id')
			->from('adverts')
			->where('published', '>', $this->_params['advert']->published)
			->where('category_id', '=', $this->_params['advert']->category_id)
			->where('city_id', '=', $this->_params['advert']->city_id)
			->where('finished', '>=', DB::expr('NOW()'))
			//->where('status', '=', Model_Advert::STATUS_PUBLISHED)
			->order_by('published', 'DESC')
			->limit(1)
			->execute()
			->get('id');
		
		$prev_id = DB::select('id')
			->from('adverts')
			->where('published', '<', $this->_params['advert']->published)
			->where('category_id', '=', $this->_params['advert']->category_id)
			->where('city_id', '=', $this->_params['advert']->city_id)
			->where('finished', '>=', DB::expr('NOW()'))
			//->where('status', '=', Model_Advert::STATUS_PUBLISHED)
			->order_by('published', 'DESC')
			->limit(1)
			->execute()
			->get('id');
		
		$this->_data['path'] = array_reverse($path,TRUE);
		$this->_data['city'] = $city;
		$this->_data['city_id'] = $city_id;
		$this->_data['next_id'] = $next_id;
		$this->_data['prev_id'] = $prev_id;
		parent::_execute();
	}
}