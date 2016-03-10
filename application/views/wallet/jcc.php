<link rel='stylesheet' type='text/css'
      href='/plugins/source/jquery.fancybox.css'/>
<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<h1><?= $paymentText["paymentHeader"] ?></h1>
<p>
    <?= $paymentText["paymentContent"] ?>
</p>
<? if($paymentText["status"] == 1) {
    ?>
    <script type="text/javascript">
        $.fancybox.showLoading();
        setTimeout(function() {
            window.location.href = "/wallet";
        },2000);
    </script>
<?
}
?>