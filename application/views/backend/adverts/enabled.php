<div id="sub-sub-menu">
    <div class="wrapper">
        <ul>
            <li class=""><a
                    href="/backend/adverts"><?= __('backend.adverts.new'); ?><?= ($new_count > 0) ? '(' . $new_count . ')' : '' ?></a>
            </li>
            <li class="separator"></li>
            <li class="current"><a href="/backend/adverts/enabled"><?= __('backend.adverts.enabled'); ?></a></li>
            <li class="separator"></li>
            <li class=""><a href="/backend/adverts/blocked"><?= __('backend.adverts.blocked'); ?></a></li>
        </ul>
        <div class="pull-right">
            <?= __('backend.adverts.selected'); ?>:
            <input type="button" onclick="backend.advAction('manyblock')" value=" <?= __('backend.adverts.block'); ?>"
                   class="advert_deactivate btn btn-mini btn-warning">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="adverts-list" class="type-edit">
    <? foreach ($adverts as $advert) : ?>
        <div class="item  backend" data-id="63">

            <div class="image">
                <?php if ($advert->image_exists('135_90')) {
                    $image = HTML::image($advert->image('135_90'), array('width' => '60px', 'title' => $advert->title(), 'alt' => $advert->title()));
                    echo HTML::anchor('advert/' . $advert->id, $image);
                } else
                    echo HTML::anchor('advert/' . $advert->id, NULL, array('class' => 'no-image', 'title' => $advert->title()));
                ?>

                <div class="list_advert_packs">
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
            </div>
            <div class="content">

                <?php

                echo HTML::anchor('advert/' . $advert->id, $advert->title(), array('class' => '', 'target' => '_blank')) . " " . ($advert->status > 3 ? "<span style='color:red'>Продано</span>" : "");
                echo " <span style='color:gray'>(" . $advert->category() . ") <a href='/backend/adverts/editcategory/?id=" . $advert->id . "'><i class='icon-pencil'></i></a></span>";
                ?>

                <input type="checkbox" class="pull-right advert-checkbox" name="checked" value="<?= $advert->id; ?>">
                <br>

                <div class="options backend">
                    <span class=""><?= __('backend.adverts.author'); ?>
                        : <?= HTML::anchor('backend/adverts/enabled/' . $advert->user_id . $ip, $advert->user, array('class' => '')); ?></span><br>
                    <span
                        class="">IP: <?= HTML::anchor('backend/adverts/enabled/' . $id . '?ip=' . $advert->ip(), $advert->ip(), array('class' => '')); ?></span><br>
                    <span class=""><?= __('backend.adverts.added'); ?>: <?= $advert->published_on(); ?></span><br>
                    <span class=""><?= __('backend.adverts.changed'); ?>: <?= $advert->updated_on(); ?></span><br>
                </div>
            </div>
            <div class="options backend">
                <a href="/backend/adverts/block/<?= $advert->id; ?>"
                   class="advert_deactivate btn btn-mini btn-warning"><?= __('backend.adverts.block'); ?></a>
                <a data-id='<?php echo $advert->id; ?>'
                   class='btn btn-mini translateAdvert'>Перевести</a>
                <a data-id='<?php echo $advert->id; ?>' class="btn btn-mini manage-packages">Пакеты услуг</a>
                <?php
                if ($advert->user_status) {
                    ?>
                    <a href="/backend/users/blockuser/<?= $advert->user_id; ?>"
                       class="advert_deactivate btn btn-mini btn-danger"><?= __('backend.users.block'); ?></a>
                <?php
                } else {
                    ?>
                    <a href="/backend/users/unblockuser/<?= $advert->user_id; ?>"
                       class="advert_deactivate btn btn-mini btn-success"><?= __('backend.users.unblock'); ?></a>
                <?php
                }
                ?>
            </div>
        </div>
    <? endforeach; ?>
</div>
<link rel='stylesheet' type='text/css'
      href='/plugins/source/jquery.fancybox.css'/>
<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<script>
    $(".manage-packages").click(function () {
        $.ajax({
            url: '/backend/adverts/managepacks',
            type: 'post',
            data: {id: $(this).data('id')}
        }).done(function (data) {
            $.fancybox(data);
        });
    })

    $(".translateAdvert").click(function () {
        var advert_id = $(this).data('id');
        if (advert_id) {
            $.ajax({
                url: '/backend/adverts/getlangparts',
                'type': 'post',
                dataType: 'json',
                data: {'advert_id': advert_id}
            }).done(function (data) {
                $.fancybox("<h1>Языковые параметры</h1>" +
                "<table class='table'>" +
                "<tr>" +
                "<th></th>" +
                "<th><img src='/resources/images/lang-ru.png'/></th>" +
                "<th><img src='/resources/images/lang-en.png'/></th>" +
                "<th><img src='/resources/images/lang-gr.png'/></th>" +

                "</tr>" +

                "<tr>" +
                "<td><b>Заголовок объявления</b></td>" +
                "<td><textarea class='ru_title'>" + data.langs.ru.title + "</textarea></td>" +
                "<td><textarea class='en_title'>" + data.langs.en.title + "</textarea></td>" +
                "<td><textarea class='gr_title'>" + data.langs.gr.title + "</textarea></td>" +

                "</tr>" +

                "<tr>" +
                "<td><b>Текст объявления</b></td>" +
                "<td><textarea class='ru_description'>" + data.langs.ru.description + "</textarea></td>" +
                "<td ><textarea class='en_description'>" + data.langs.en.description + "</textarea></td>" +
                "<td><textarea class='gr_description'>" + data.langs.gr.description + "</textarea></td>" +

                "</tr>" +


                "</table><input type='button' value='Сохранить изменения' class='btn btn-default save_advert_langs'/><br/>" +
                "<div class='translater'></div>");
                Translate.translatePanel('.translater');

                $("textarea").each(function () {
                    if ($(this).val() == 'null') {
                        $(this).val('');
                    }
                });

                $(".save_advert_langs").click(function () {
                    $.ajax({
                        url: '/backend/adverts/setlangparts',
                        'type': 'post',
                        data: {
                            'advert_id': advert_id, 'advert': {
                                'ru': {
                                    'title': $('.ru_title').val(),
                                    'description': $('.ru_description').val(),
                                    'keywords': $('.ru_keywords').val()
                                },
                                'en': {
                                    'title': $('.en_title').val(),
                                    'description': $('.en_description').val(),
                                    'keywords': $('.en_keywords').val()
                                },
                                'gr': {
                                    'title': $('.gr_title').val(),
                                    'description': $('.gr_description').val(),
                                    'keywords': $('.gr_keywords').val()
                                }
                            }
                        }
                    }).done(function () {
                        window.location.reload();
                    });
                });
            });
        }

    });
</script>