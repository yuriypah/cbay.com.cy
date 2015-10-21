<h1>
    <div class="amount_block">
        <table>
            <tr>
                <td><img src="/resources/images/coins-icon.png"></td>
                <td style="vertical-align: top;padding-left:5px"><?= __('wallet.amount'); ?>: <span
                        style='font-weight:100;color:#2E8BAE'><?= $amount . " " . __('currency.euro'); ?> <span
                            style="color:#000000"></span></span></td>
            </tr>
        </table>
    </div>
</h1>

<div style="margin-left: 38px">
    <?= __('wallet.comment'); ?><Br/>

    <div><b><?= __('wallet.amounttext'); ?></b>: <input value="5" style="width: 40px" min="1" type="number"
                                                        name="amount_value"/><span
            style='font-weight:100;color:#2E8BAE'> €</span></div>
    <br/>

    <div><b class=""><?= __('wallet.replenish'); ?>:</b></div>
    <table>
        <tr>
            <td>
                <div class="paiment-block">
                    <img class="submit_jcc" src="/resources/images/jcc_logo.jpg"/>

                    <div class="jcc_form_loader"></div>
                </div>
            </td>
            <td>
            </td>
            <td style="vertical-align: middle;text-align:center">
                <div class="paiment-block">
                    <div style="margin-top:45px">
                        <div id="payment-paypal" class="submit_form"></div>
                        <Br/>

                        <div id="">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank"
                                  class="paypal_form">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="business" value="gosup3@gmail.com">
                                <input type="hidden" name="no_shipping" value="1">
                                <input type="hidden" name="item_name" value="CBAY.COM.CY"/>
                                <input type="hidden" name="amount" value="5"/>
                                <input type="hidden" name="currency_code" value="EUR"/>
                                <input type="hidden" name="custom" value="<?= $wallet->id; ?>">
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
                                       border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                     width="1"
                                     height="1">
                            </form>
                        </div>
                    </div>
            </td>
        </tr>
    </table>
</div>
<script>
    $(function () {
        function prepareJCC() {
            $.ajax({
                url: "/wallet/preparejcc",
                beforeSend: function () {
                    $(".submit_jcc").css("opacity", "0.5");
                    $(".submit_jcc").attr('disabled', true);
                },
                type: "post",
                data: {"amountValue": $("input[name=amount_value]").val()}
            }).done(function (data) {
                $(".submit_jcc").css("opacity", "1");
                $(".jcc_form_loader").html(data);
                $(".submit_jcc").attr('disabled', false);
            })
        }

        $(".submit_form").click(function () {
            $(".paypal_form").submit();
        });
        $(".submit_jcc").click(function () {
            $(".jcc_form").submit();
        });
        $("input[name=amount_value]").change(function () {
            $("input[name=amount]").val(this.value);
            prepareJCC();
        })
    });

</script>

