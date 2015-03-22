<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Packages extends Controller_System_Page
{

    public function action_pay()
    {
        $advert_id = Input::get('advert');
        $package_id = Input::get('package');


        /*               $advert = ORM::factory('advert', (int) $advert_id);
                       $package = Model_Package::$packages[$package_id];
                       $advert->add_package($package);
                       $this->go_back();
                       exit;*/

        $advert = ORM::factory('advert')->get_one($advert_id);
        $package = Model_Package::$packages[$package_id]->get_options();
        $key = array_keys($package);
        $this->template->content->advert = $advert;
        $this->template->content->package = $package[$key[0]];
        $user = ORM::factory('user')->where('id', '=', $this->ctx->user->id)->find();
        $this->template->content->amount = $user->amount;
    }

    public function action_index()
    {
        $adverts = ORM::factory('advert')
            ->where('user_id', '=', $this->ctx->user->id)
            ->with_part()
            ->order_by('finished', 'asc')
            ->find_all();
        $this->template->content->adverts = $adverts;
    }

    public function action_walletpay()
    {
        $advert_id = Input::post('advert');
        $package_id = Input::post('package');
        $package = Model_Package::$packages[$package_id];
        $package_options = $package->get_options();
        $keys = array_keys($package_options);
        $amount = $package_options[$keys[0]]->amount();

        $wallet = ORM::factory('user')
            ->where('id', '=', $this->ctx->user->id)
            ->find();
        if ($wallet->amount - $amount > 0) {
            $wallet->amount -= $amount;
            $advert = ORM::factory('advert', (int)$advert_id);
            $advert->add_package($package);
            $wallet->update();
            Messages::success(__('package.pay.success'));
            $this->request->initial()->redirect('profile');
        } else {
            Messages::errors(__('package.pay.error'));
            $this->go_back();
        }
    }
}