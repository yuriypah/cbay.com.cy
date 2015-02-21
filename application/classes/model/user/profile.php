<?php defined('SYSPATH') or die('No direct script access.');

class Model_User_Profile extends ORM
{

    const TYPE_PRIVATE = 1;
    const TYPE_COMPANY = 2;

    const PHONE_LENGTH = 8;

    public static $types = array(
        self::TYPE_PRIVATE => 'profile_page.settings.label.type.private',
        self::TYPE_COMPANY => 'profile_page.settings.label.type.сompany'
    );

    protected $_created_column = array(
        'column' => 'created',
        'format' => 'Y-m-d H:i:s'
    );

    protected $_updated_column = array(
        'column' => 'updated',
        'format' => 'Y-m-d H:i:s'
    );

    protected $_has_one = array(
        'user' => array('model' => 'user', 'foreign_key' => 'id'),
    );

    protected $_belongs_to = array(
        'map' => array('model' => 'map', 'foreign_key' => 'id')
    );

    // Validation rules
    public function rules()
    {
        return array(
            'name' => array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 32))
            ),
            'phone' => array(
                array('phone', array(':value', self::PHONE_LENGTH))
            ),
        );
    }

    public function filters()
    {
        return array(
            'phone' => array(
                array('Model_User_Profile::format_phone')
            )
        );
    }

    public function type()
    {
        return ARR::get(self::$types, $this->type);
    }

    public static function format_phone($number)
    {
        // Remove all non-digit characters from the number
        $number = preg_replace('/\D+/', '', $number);

        $length = strlen($number);

        switch ($length) {
            case 8:
                $number = preg_replace('/([\d]{2})([\d]{3})([\d]{3})/', '$1 $2-$3', $number);
            default:
                $number = preg_replace('/([\d]{2})([\d]{3})([\d]+)/', '$1 $2-$3', $number);
        }

        return $number;
    }
}