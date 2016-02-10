<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Help extends Controller_System_Page
{

    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        $local = I18n::lang();
        $this->left_sidebar = TRUE;
        $art = $this->request->param('article');
        if ($art == true) {
            $this->template->content = View::factory('help/' . $local . '/' . $art);
        } else {
            $this->template->content = View::factory('help/' . $local . '/index');
        }
        if ($art == 'feedbackmessage') {
            $header = 'Feedback message from ' .$this->request->post('feedback_name');
            $message = '<b>Messsage: </b> ' . $this->request->post('feedback_message') . '<br/>' .
                '<b>Email: </b>' . $this->request->post('feedback_email');
            try {
                $email = Email::factory($header, $message, 'text/html')
                    ->to('support@cbay.com.cy')
                    ->from('support@cbay.com.cy', 'CBAY.COM.CY')
                    ->send();
            } catch (Exception $e) {

            }

        }
    }
}
