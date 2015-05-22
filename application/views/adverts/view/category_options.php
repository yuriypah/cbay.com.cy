<?php
//qw($advert->category(),$advert->category_id,'ae');
?>
<table id="advert-options-list">
    <colgroup>
        <col>
        <col width="15px">
        <col>
    </colgroup>
    <tbody class="option_tbody">
    <?php
    foreach ($options_for_view as $option) {

        ?>
        <tr class="option_tr" data-key="<?php echo $option['key']; ?>">
            <th><?php echo $option['label']; ?></th>
            <td></td>
            <td><?php echo $option['value']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script>
    $(function () {

        var newDom = '';
        $.ajax({
            url: '/resources/js/sortsearch.json',
            'dataType': 'json',
            beforeSend: function () {
                $.fancybox.showLoading();
            }
        }).done(function (data) {
            var count = 0;
            for (var i in data) {
                if ($("[data-key=" + data[i].id + "]").length > 0 && count < ($(".option_tr").length - 1)) {
                    newDom += $("[data-key=" + data[i].id + "]")[0].outerHTML;
                    count++;
                }
            }
            $(".option_tbody").html(newDom);
        });
    })

</script>