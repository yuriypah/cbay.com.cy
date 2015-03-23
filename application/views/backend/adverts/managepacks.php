<div class="list_advert_packs">Активные пакеты:
    <?php
    if ($advert->premium()) {
        ?>
        <?= HTML::image('resources/images/prestig.png', array('data-tooltip' => __('package.option.title.premium'))); ?>
    <? } ?>
    <? if ($advert->vip()) { ?>
        <?= HTML::image('resources/images/vip.png', array('data-tooltip' => __('package.option.title.vip'))); ?>
    <? } ?>
    <? if ($advert->selected()) { ?>
        <?= HTML::image('resources/images/color.png', array('data-tooltip' => __('package.option.title.selected'))); ?>
    <? } ?>
    <? if ($advert->top()) { ?>
        <?= HTML::image('resources/images/up.png', array('data-tooltip' => __('package.option.title.top'))); ?>
    <? } ?>
</div>
<table class='table table-bordered'>
    <?php

        echo "<tr><td>Услуга: <b>Размещение</b></td><td> истекает
                <input type='text' style='width:80px' class='long_pack_value' value='" . date("d.m.Y", strtotime($advert->finished)) .
            "'/><button data-advert='" . $advert->id . "' data-id='finished' class='btn btn-default long_pack'>Ok</button></td>
                    <td></td></tr>";

    if ($advert->premium()) {
        echo "<tr><td>Услуга: <b>Престиж</b></td><td> истекает
                <input type='text' style='width:80px' class='long_pack_value' value='" . date("d.m.Y", strtotime($advert->premium)) .
            "'/><button data-advert='" . $advert->id . "' data-id='premium' class='btn btn-default long_pack'>Ok</button></td>
                    <td><button data-advert='" . $advert->id . "'  data-id='premium' class='btn btn-default delete_pack'>Удалить пакет</button></td></tr>";
    }
    if ($advert->vip()) {
        echo "<tr><td>Услуга: <b>VIP</b></td><td> истекает
                <input type='text' style='width:80px' class='long_pack_value' value='" . date("d.m.Y", strtotime($advert->vip)) .
            "'/><button data-advert='" . $advert->id . "' data-id='vip' class='btn btn-default long_pack'>Ok</button></td>
                    <td><button data-advert='" . $advert->id . "'  data-id='vip' class='btn btn-default delete_pack'>Удалить пакет</button></td></tr>";
    }
    if ($advert->selected()) {
        echo "<tr><td>Услуга: <b>Выделение</b></td><td> истекает
                <input type='text' style='width:80px' class='long_pack_value' value='" . date("d.m.Y", strtotime($advert->selected)) .
            "'/><button data-advert='" . $advert->id . "' data-id='selected' class='btn btn-default long_pack'>Ok</button></td>
                    <td><button data-advert='" . $advert->id . "'  data-id='selected' class='btn btn-default delete_pack'>Удалить пакет</button></td></tr>";
    }
    if ($advert->top()) {
        echo "<tr><td>Услуга: <b>Поднятие</b></td><td> истекает
                <input type='text' style='width:80px' class='long_pack_value' value='" . date("d.m.Y", strtotime($advert->top)) .
            "'/><button data-advert='" . $advert->id . "' data-id='top' class='btn btn-default long_pack'>Ok</button></td>
                    <td><button data-advert='" . $advert->id . "'  data-id='top' class='btn btn-default delete_pack'>Удалить пакет</button></td></tr>";
    }
    ?>
</table>
<div>
    <select class="add-long-packname">
        <?php
        if (!$advert->premium()) {
            echo "<option value='premium'>Престиж</option>";
        }
        if (!$advert->vip()) {
            echo "<option value='vip'>VIP</option>";
        }
        if (!$advert->selected()) {
            echo "<option value='selected'>Выделить</option>";
        }
        if (!$advert->top()) {
            echo "<option value='top'>Поднять</option>";
        }
        ?>
    </select>&nbsp;&nbsp;
    Активировать до: <input style='width:80px' class='add-long-value' type="text" value="<?php echo date("d.m.Y"); ?>"/>&nbsp;&nbsp;
    <input type="button" class="btn btn-success add-pack" data-advert='<?php echo $advert->id  ?>'
           value="Добавить пакет"/>
</div>
<script>
    $(function () {
        $(".delete_pack").click(function () {
            var conf = confirm("Удалить пакет?");
            if (conf) {
                $.ajax({
                    url: '/backend/adverts/managepacks',
                    type: 'post',
                    data: {'action': 'delete', id: $(this).data('id'), advert: $(this).data('advert')}
                }).done(function () {
                    window.location.reload();
                })
            }
        })
        $(".long_pack").click(function () {
            var long_value = $(this).parents("tr").find(".long_pack_value").val();
            long_pack(long_value, $(this).data('advert'), $(this).data('id'));
        });
        $(".add-pack").click(function () {
            long_pack($(".add-long-value").val(), $(this).data('advert'), $(".add-long-packname").val());
        });
        function long_pack(long_value, advert, pack) {
            if (long_value != '' && long_value.length == 10) {
                $.ajax({
                    url: '/backend/adverts/managepacks',
                    type: 'post',
                    data: {
                        action: 'update',
                        id: pack,
                        advert: advert,
                        long_value: long_value
                    }
                }).done(function () {
                     window.location.reload();
                })
            } else {
                alert('Неверный формат даты: MM.DD.YYYY')
            }
        }
    });

</script>