<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );

class Googletranslate {
    
    const ENDPOINT = 'https://www.googleapis.com/language/translate/v2';
    
    public static function translate($data, $target, $source = ''){

            $apiKey = "AIzaSyCbrYokLR1FE9-Er0gj-J4CK2k0jiRAW7g";
            $values = array(
                'key'    => $apiKey,
                'target' => $target,
                'q'      => $data
            );
            if (strlen($source) > 0) {
                $values['source'] = $source;
            }
            $formData = http_build_query($values);
            $ch = curl_init(self::ENDPOINT);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: GET'));
            $json = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($json, true);
            return $data['data']['translations'];
    }
}