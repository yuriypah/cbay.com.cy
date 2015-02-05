<?php defined('SYSPATH') or die('No direct script access.');

class Model_Advert_Option extends ORM
{

    public static function delete_options($advert_id)
    {

        DB::delete('advert_options')->where('advert_id', '=', (int)$advert_id)->execute();
        DB::delete('advert_option_strings')->where('advert_id', '=', (int)$advert_id)->execute();

        return true;
    }

    public static function get_options_for_view($advert_id)
    {

        if (is_numeric($advert_id))
            $options = self::get_options($advert_id);

        elseif (is_array($advert_id))
            $options = $advert_id;
        else return array();
        $options = array_filter($options);
        if (empty($options))
            return array();
        $sql = "SELECT title, related_id FROM lang_parts WHERE related_id IN (" . implode(", ", array_keys($options)) . ") AND related_table = 'advert_category_options' AND `locale`='".I18n::lang()."'";
        $res = DB::query(Database::SELECT, $sql)
            ->execute()
            ->as_array('related_id');

        $sql = "SELECT id FROM advert_category_options WHERE id IN (" . implode(", ", array_keys($options)) . ") AND type_id IN (5,9)";
        $inputs = DB::query(Database::SELECT, $sql)
            ->execute()
            ->as_array(NULL, 'id');

        $ar = array_diff_key($options, array_flip($inputs));
        $sql = "SELECT title, related_id FROM lang_parts WHERE related_id IN ('" . implode("', '", array_values($ar)) . "') AND related_table = 'advert_category_option_values' AND `locale`='".I18n::lang()."'";
        $res2 = DB::query(Database::SELECT, $sql)
            ->execute()
            ->as_array('related_id', 'title');

        foreach ($options as $k => $v) {
            if (isset($res2[$v])) $v = $res2[$v];
            $result[] = array('label' => $res[$k]['title'], 'value' => $v, 'key' => $k);
        }
        return $result;
    }

    /**
     * Get all options for current advert
     * @param int $advert_id
     * @return array
     */
    public static function get_options($advert_id)
    {
        $options = array();
        $sql = "SELECT option_id,value_id FROM advert_options WHERE advert_id=" . $advert_id;
        foreach (DB::query(Database::SELECT, $sql)->execute() as $v) {
            $options[$v['option_id']] = $v['value_id'];
        }
        return $options;
    }

    /**
     * Insert all options for current advert
     * @param int $advert_id
     * @return array
     */
    public static function put_options($advert_id, $options)
    {
        $string = array();
        self::delete_options($advert_id);
        $option_values = DB::select('id')
            ->from('advert_category_option_values')
            ->execute();
        $option_values_ids = array();
        foreach ($option_values as $item) {
            $option_values_ids[] = $item['id'];
        }

        if ($options) {
            $query = DB::insert('advert_options', array('advert_id', 'value_id', 'option_id'));

            foreach ($options as $option_id => $value) {
                if (!is_numeric($value) || (int)$value != $value)
                    $string[] = "(" . $advert_id . ",'" . $value . "'," . $option_id . ")";
                else {
                    if (in_array($value, $option_values_ids)) {
                        $query->values(array($advert_id, $value, $option_id));
                    } else {
                        $string[] = "(" . $advert_id . ",'" . $value . "'," . $option_id . ")";
                    }
                }
            }

            $query->execute();
        }


        if (!empty($string)) {
            $sql = "INSERT INTO advert_option_strings (advert_id, option_value, option_id) VALUES " . implode(', ', $string);
            DB::query(Database::INSERT, $sql)->execute();
        }

        return true;
    }
}