<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Model_Advert_Show extends ORM {
    
        public function add_shows($adv_id){
            $res = ORM::factory('advert_show')
                    ->where('ip', '=', ip2long(Request::$client_ip))
                    ->and_where('advert_id', '=', $adv_id)
                    ->find();
            if(!$res->loaded()){
                $res->advert_id = $adv_id;
                $res->ip = ip2long(Request::$client_ip);
                $res->date = time();
                $res->save();
            }
        }
        
        public function get_shows($adv_id){
            $res = ORM::factory('advert_show')
                    ->where('advert_id', '=', $adv_id)
                    ->find();
            if($res->loaded()){
                $data = array();
                $data['all'] = $res->where('advert_id', '=', $adv_id)->count_all();
                $today = mktime(0,0,0,date("m"),date("d"),date("Y"));
                $data['today'] = $res->where('advert_id', '=', $adv_id)->where('date', '>=', $today)->count_all();
                return $data;
            }
        }
}