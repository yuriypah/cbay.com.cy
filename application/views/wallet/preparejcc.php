<form target="_blank" class="jcc_form" method="post" action="<?= $jcc_params["action"] ?>">
    <input type="hidden" name="Version" value="<?= $jcc_params["version"] ?>"/>
    <input type="hidden" name="MerID" value="<?= $jcc_params["MerID"] ?>"/>
    <input type="hidden" name="AcqID" value="<?= $jcc_params["AcqID"] ?>"/>
    <input type="hidden" name="MerRespURL" value="<?= $jcc_params["MerRespURL"] ?>"/>
    <input type="hidden" name="PurchaseAmt" value="<?= $jcc_params["PurchaseAmt"] ?>"/>

    <input type="hidden" name="PurchaseCurrency" value="<?= $jcc_params["PurchaseCurrency"] ?>"/>
    <input type="hidden" name="PurchaseCurrencyExponent" value="<?= $jcc_params["PurchaseCurrencyExponent"] ?>"/>
    <input type="hidden" name="OrderID" value="<?= $jcc_params["OrderID"] ?>">
    <input type="hidden" name="CaptureFlag" value="<?= $jcc_params["CaptureFlag"] ?>">
    <input type="hidden" name="Signature" value="<?= $jcc_params["Signature"] ?>">
    <input type="hidden" name="SignatureMethod" value="<?= $jcc_params["SignatureMethod"] ?>">
</form>