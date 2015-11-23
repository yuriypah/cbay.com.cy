<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_File extends Controller_Ajax_JSON
{

    public $auth_required = FALSE;

    public function before()
    {
    }

    public function action_upload()
    {
        $file = Upload::file($_FILES['file'], array('jpg', 'gif', 'png', 'jpeg'));

        list($status, $data) = $file;

        $this->json['status'] = $status;
        if ($status == TRUE) {
            $advert_data = Session::instance()->get('advert_place_data', array());
            $advert_data['images'][] = TMPURL . $data;
            Session::instance()->set('advert_place_data', $advert_data);

            $this->json['file'] = TMPURL . $data;
            $this->json['path'] = Encrypt::instance()->encode($this->json['file']);
            $this->json['message'] = __('File :file succefuly uploaded', array(
                ':file' => $_FILES['file']['name']
            ));
        } else {
            $this->json['file'] = NULL;
            $this->json['message'] = $data;
        }
    }

    public function action_rotate()
    {
        $data = $this->request->post();
        $advert_data = Session::instance()->get('advert_place_data', array());
        foreach ($advert_data['images'] as $key => $image) {
            if ($data['image'] == "/".$advert_data['images'][$key]) {
                $advert_data['image_rotation'][$key] = $data['rotate'];
            }
        }
        Session::instance()->set('advert_place_data', $advert_data);
    }

    public function action_delete()
    {
        $file = Encrypt::instance()->decode($this->request->post('path'));
        if (!$file) {
            return FALSE;
        }

        $path = DOCROOT . trim($file);
        $filename = pathinfo($path, PATHINFO_BASENAME);

        $new = FALSE;
        $db_exists = FALSE;

        if (strpos($path, TMPPATH) !== FALSE) {
            $new = TRUE;
        }

        if ($new === FALSE) {
            $db_exists = ORM::factory('advert')->find_image($filename);
        }

        if (!file_exists($path) AND !$db_exists) {
            $this->json['message'] = __('File :path not found', array(':path' => $filename));
            return;
        }

        if ($new === TRUE) {
            if (unlink($path)) {
                $advert_data = Session::instance()->get('advert_place_data', array());

                if (isset($advert_data['images'])) {
                    foreach ($advert_data['images'] as $id => $image) {
                        if ($image == trim($file, DIRECTORY_SEPARATOR)) {
                            unset($advert_data['images'][$id]);
                            $this->json['status'] = TRUE;
                            $this->json['message'] = __('File :path deleted', array(':path' => $file));
                        }
                    }
                }

                Session::instance()->set('advert_place_data', $advert_data);
            }
        } else {
            $advert_data = Session::instance()->get('advert_place_data', array());

            if (isset($advert_data['images'])) {
                foreach ($advert_data['images'] as $id => $image) {
                    if ($image == trim($file, DIRECTORY_SEPARATOR)) {
                        unset($advert_data['images'][$id]);
                        $this->json['status'] = TRUE;
                        $this->json['message'] = __('File :path deleted', array(':path' => $file));
                    }
                }
            }

            Session::instance()->set('advert_place_data', $advert_data);


            ORM::factory('advert')->delete_image($filename);

            $this->json['status'] = TRUE;
            $this->json['message'] = __('File :path deleted', array(':path' => $file));
        }
    }
}