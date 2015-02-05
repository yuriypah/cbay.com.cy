<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Paypal extends Kohana_Controller {
    
    public function action_success(){
        $get = '';
        foreach($_GET as $key=>$value){
            $get .= $key."=".urlencode($value)."&";
        }
        $post = '';
        foreach ($_POST as $key=>$value){
            $post .= $key."=".urlencode($value)."&";
        }
        DB::insert('paypaltest',array('action','get','post','controller'))
                ->values(array(time(), $get, $post, 'success'))
                ->execute();
        Messages::success(__('package.pay.success'));
        $this->request->initial()->redirect('profile');
    }

    public function action_notify(){
        
        $paypalemail = 'gosup3@gmail.com';
 
        $get = '';
        foreach($_GET as $key=>$value){
            $get .= $key."=".urlencode($value)."&";
        }
        $post = '';
        foreach ($_POST as $key=>$value){
            $post .= $key."=".urlencode($value)."&";
        }
        DB::insert('paypaltest',array('action','get','post','controller'))
                ->values(array(time(), $get, $post, 'notify'))
                ->execute();

        //$postdata="mc_gross=0.99&protection_eligibility=Ineligible&payer_id=FJ79TRKKKSA3C&tax=0.00&payment_date=05%3A53%3A30+Jun+19%2C+2013+PDT&payment_status=Completed&charset=KOI8-R&first_name=KIRILL&mc_fee=0.33&notify_version=3.7&custom=66&payer_status=unverified&business=gosup3%40gmail.com&quantity=1&verify_sign=A.CSYz4u5IILQm5wM0J0JbJiIcEuAAMt.k9VvYnaj3DeJ2M-AF.kK19F&payer_email=p3-%40mail.ru&txn_id=54D9414622517682E&payment_type=instant&btn_id=62372543&last_name=AKHANTYEV&receiver_email=gosup3%40gmail.com&payment_fee=0.33&shipping_discount=0.00&insurance_amount=0.00&receiver_id=629KGGVWNYARJ&txn_type=web_accept&item_name=test&discount=0.00&mc_currency=USD&item_number=pack2&residence_country=CY&receipt_id=5010-9735-3885-4626&handling_amount=0.00&shipping_method=Default&transaction_subject=78&payment_gross=0.99&shipping=0.00&ipn_track_id=855feda8e9756"; 
        $postdata = '';
        foreach ($_POST as $key=>$value) $postdata.=$key."=".urlencode($value)."&"; 
        $postdata .= "cmd=_notify-validate";  
        $curl = curl_init("https://www.paypal.com/cgi-bin/webscr"); 
        curl_setopt ($curl, CURLOPT_HEADER, 0);  
        curl_setopt ($curl, CURLOPT_POST, 1); 
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $postdata); 
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);  
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 1); 
        $response = curl_exec ($curl); 
        curl_close ($curl);
        if ($response != "VERIFIED") die("You should not do that ..."); 

        if ($_POST['receiver_email'] != $paypalemail || $_POST["txn_type"] != "web_accept") 
             die("You should not be here ..."); 

        $r = ORM::factory('order')
                ->where('txn_id', '=', $_POST['txn_id'])
                ->find();
        if($r->loaded()) die ("I feel like I met you before ...");

        if($_POST['item_number'] == 'wallet'){
            $wallet = ORM::factory('wallet')
            ->where('id', '=', (int) $_POST['custom'])
            ->find();
            $wallet->amount += $_POST['mc_gross'];
            $wallet->lastaccrual = date("Y-d-m H:i:s");
            $wallet->lastamount = $_POST['mc_gross'];
            $wallet->update();
        } else {
         $advert = ORM::factory('advert', (int) $_POST['custom']);
         $package = Model_Package::$packages[$_POST["item_number"]];
         $advert->add_package($package);
        }
        $order_date = date("Y-m-d H:i:s",strtotime ($_POST["payment_date"]));
        $r->txn_id = $_POST["txn_id"];
        $r->order_date = $order_date;
        $r->adv_id = (int) $_POST['custom'];
        $r->item_name = $_POST["item_name"];
        $r->item_number = $_POST["item_number"];
        $r->payment_status = $_POST['payment_status'];
        if(isset($_POST['pending_reason']))
            $r->pending_reason = $_POST['pending_reason'];
        $r->payment_type = $_POST['payment_type'];
        if(isset($_POST['payer_email']))
            $r->payer_email = $_POST['payer_email'];
        if(isset($_POST['first_name']))
            $r->first_name = $_POST['first_name'];
        if(isset($_POST['last_name']))
            $r->last_name = $_POST['last_name'];
        $r->mc_gross = $_POST['mc_gross'];
        $r->mc_fee = $_POST['mc_fee'];
        $r->save();
        echo 'success';
    }
    
    public function action_cancel(){
        Messages::errors(__('package.pay.cancel'));
        $this->request->initial()->redirect('profile');
    }
}
