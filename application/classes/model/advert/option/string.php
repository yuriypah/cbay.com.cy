<?php defined('SYSPATH') or die('No direct script access.');

class Model_Advert_Option_String extends ORM
{
    public static function get_strings($advert_id)
    {
        $result = array();
        $sql = "SELECT s.option_id, s.option_value, v.title FROM advert_option_strings as s, lang_parts as v WHERE s.advert_id = " . $advert_id . " AND v.related_id = s.option_id AND v.related_table = 'advert_category_options' AND v.locale='" . I18n::lang() . "'";
        $options = DB::query(Database::SELECT, $sql)
            ->execute()
            ->as_array('option_id');
        foreach ($options as $k => $v) {
            $result[] = array('label' => $v['title'], 'value' => $v['option_value'], 'key' => $k);
        }
        return $result;
    }
}

?>