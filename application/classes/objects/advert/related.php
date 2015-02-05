<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Advert_Related extends Model_Object {
	
	protected function _execute()
	{
		$adverts = DB::select('id', 'image', 'title', 'amount')
			->from('adverts')
			->where('id', '!=', $this->_params['advert']->id)
			->where('category_id', '=', $this->_params['advert']->category_id)
			->where('city_id', '=', $this->_params['advert']->city_id)
			->where('finished', '>=', DB::expr('NOW()'))
			//->where('image', '!=', '')
			->join('advert_parts', 'left')
				->on('advert_id', '=', 'adverts.id')
			->where('locale', '=', I18n::lang())
			//->where('status', '=', Model_Advert::STATUS_PUBLISHED)
			->order_by('published', 'DESC')
			->limit(6)
			->as_object('Model_Advert')
			->execute();
		
		$this->_data['adverts'] = $adverts;

		parent::_execute();
	}
}