<?php

defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML {

    protected static $_doctypes = array(
        'xhtml11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
        'xhtml1-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        'xhtml1-trans' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'xhtml1-frame' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        'html5' => '<!DOCTYPE html>',
        'html4-strict' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
        'html4-trans' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
        'html4-frame' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">'
    );

    public function declination($number, $array) { // склонения
        $cases = array(2, 0, 1, 1, 1, 2);
        return $array[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[($number % 10 < 5) ? $number % 10 : 5]];
    }
    public function getPacks() {
        $packs = json_decode(file_get_contents('resources/data/packages.json'));
        return $packs;
    }
    public static function doctype($type = 'html5') {
        if (isset(self::$_doctypes[$type])) {
            return self::$_doctypes[$type];
        }

        throw new Kohana_Exception('Doctype :type not fount', array(':type' => $type));
    }

    public static function icon($name, $color = NULL) {
        $class = array();

        $class[] = 'icon-' . HTML::chars($name);

        if ($color === TRUE) {
            $class[] = 'icon-white';
        } elseif (in_array($color, array('white', 'yellow'))) {
            $class[] = 'icon-' . $color;
        }

        $class[] = 'icon';
        return '<i class="' . implode(' ', $class) . '"></i>';
    }

    public static function popup($anchor = NULL, $name = NULL, array $attributes = NULL) {
        $_name = HTML::icon('plus-sign');
        if ($name !== NULL) {
            $_name .= ' ' . $name;
        }

        $class = ' fancybox.ajax popup';
        if (isset($attributes['class'])) {
            $attributes['class'] .= $class;
        } else {
            $attributes['class'] = $class;
        }

        return HTML::anchor($anchor, $_name, $attributes);
    }

    public static function label($text, $type = 'info') {
        return '<span class="label label-' . $type . '">' . $text . '</span>';
    }

    public static function message($text, $type = '', $icon = 'info-sign') {
        return '<p class="alert alert-' . $type . '">' . HTML::icon($icon) . ' ' . $text . '</p>';
    }

    public static function sort($uri, $query = array(), $text, $params) {
        $order = Arr::get($_GET, 'o', 'asc');

        if (in_array($order, array('asc', 'desc'))) {
            $order = $order == 'asc' ? 'desc' : 'asc';
        }

        $query['o'] = $order;

        $query = URL::query($query);

        return HTML::anchor($uri . $query, $text, $params);
    }

}