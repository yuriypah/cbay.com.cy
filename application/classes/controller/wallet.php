<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Wallet extends Controller_System_Page
{

    public function action_index()
    { 
        $wallet = ORM::factory('wallet')
            ->where('id', '=', $this->ctx->user->id)
            ->find();
        $user = ORM::factory('user')->where('id', '=', $this->ctx->user->id)->find();
        $this->template->content->amount = $user->amount;
        $this->template->content->wallet = $wallet;
    }

    public function action_preparejcc()
    {
        $domain = "https://" . $_SERVER["HTTP_HOST"];
        $data = $this->request->post();
        $purchaseAmt = str_pad("20.50", 13, "0", STR_PAD_LEFT);
        $preparedPurchaseAmt = substr($purchaseAmt, 0, 10) . substr($purchaseAmt, 11);
        $params = array();
        $params["action"] = "https://tjccpg.jccsecure.com/EcomPayment/RedirectAuthLink";
        $params["version"] = "1.0.0";
        $params["MerID"] = "0099405011";
        $params["AcqID"] = "402971";
        $params["MerRespURL"] = $domain . "/wallet/jcc";
        $params["PurchaseAmt"] = $preparedPurchaseAmt;
        $params["PurchaseCurrency"] = 978;
        $params["PurchaseCurrencyExponent"] = 2;
        $params["OrderID"] = "TestOrder12345";
        $params["CaptureFlag"] = "A";
        $params["password"] = "S6m861vR";
        $sign = $params["password"] . $params["MerID"] . $params["AcqID"] .
            $params["OrderID"] . $params["PurchaseAmt"] . $params["PurchaseCurrency"];
        $sha = sha1($sign);

        $params["Signature"] = base64_encode(pack("H*", $sha));
        echo $params["Signature"];
        $params["SignatureMethod"] = "SHA1";
        die(View::factory("/wallet/preparejcc", array(
            "jcc_params" => $params
        )));
    }

    public function action_jcc()
    {
        $data = $this->request->post();
        $returned = array(
            "jccMerID" => $data['MerID'],
            "jccAcqID" => $data['AcqID'],
            "jccOrderID" => $data['OrderID'],
            "jccResponseCode" => intval($data['ResponseCode']),
            "jccReasonCode" => intval($data['ReasonCode']),
            "jccReasonDescr" => $data['ReasonCodeDesc'],
            "jccRef" => $data['ReferenceNo'],
            "jccPaddedCardNo" => $data['PaddedCardNo'],
            "jccSignature" => $data['ResponseSignature']
        );
        $origin = array(
            "MerID" => "0099405011",
            "password" => "S6m861vR",
            "AcqID" => "402971",
            "OrderID" => "TestOrder12345"
        );
        $sign = $origin["password"] . $origin["MerID"] . $origin["AcqID"] . $origin["OrderID"] .
            $returned["jccResponseCode"] . $returned["jccReasonCode"];
        $sha = sha1($sign);
        $resultSign = base64_encode(pack("H*", $sha));
        if ($resultSign == $returned["jccSignature"]) {
            $paymentHeader = __("payment.header.success");
            $paymentContent = __("payment.content.error");

        } else {
            $paymentHeader = "<span style='color:red'>" . __("payment.header.error") . "</span>";
            $paymentContent = __("payment.content.error");
        }
        $this->template->content->paymentText = array(
            "paymentHeader" => $paymentHeader,
            "paymentContent" => $paymentContent
        );
    }
}