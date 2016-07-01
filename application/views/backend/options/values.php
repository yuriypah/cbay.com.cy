<h4><?php echo 'Варианты' ?></h4>
<table class="table table-striped" id="option-values">
    <colgroup span="1">
        <col></col>
        <col width="30px"></col>
    </colgroup>
    <tbody>
    <?php if (count($values) > 0): ?>
        <?php foreach ($values as $value): ?>
            <?php

            echo View::factory('backend/options/value', array(
                'value' => $value
            ));
            ?>
        <?php endforeach; ?>
    <?php else: ?>
        <?php

        echo View::factory('backend/options/value', array(
            'value' => ORM::factory('advert_category_option_value')
        ));
        ?>
    <?php endif; ?>
    </tbody>
</table>

<hr/>
<a href="#" id="add-value" class="btn"><?php echo __('Добавить вариант'); ?></a>
<link rel='stylesheet' type='text/css'
      href='/plugins/source/jquery.fancybox.css'/>
<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<script>
    $(document).ready(function () {
        Translate.translatePanel();
    });
    $(".option_lang").click(function () {
        var opt_id = $(this).data("id");
        $.ajax({
            url: '/backend/options/getlangoptions',
            type: 'post',
            dataType: 'json',
            data: {'option_id': opt_id}
        }).done(function (data) {

            $.fancybox("<h1>Языковые параметры</h1>" +
            "<table class='table'>" +

            "<tr><td><img src='/resources/images/lang-ru.png'/></td><td><input value='" + data.langs.ru + "' name='var_ru' type='text'/></td></tr>" +
            "<tr><td><img src='/resources/images/lang-en.png'/></td><td><input value='" + (data.langs.en ? data.langs.en : '') + "' name='var_en' type='text'/></td></tr>" +
            "<tr><td><img src='/resources/images/lang-gr.png'/></td><td><input value='" + (data.langs.gr ? data.langs.gr : '') + "'  name='var_gr' type='text'/></td></tr>" +

            "</table><input type='button' value='Сохранить изменения' class='btn btn-default save_opt_langs'/><Br/>" +
            "<div class='translater'></div>");
            Translate.translatePanel('.translater');
            $(".save_opt_langs").click(function () {

                $.ajax({
                    'url': '/backend/options/savelangoptions',
                    'type': 'post',
                    'data': {
                        'option_id': opt_id,
                        'langs': {
                            'ru': $("input[name=var_ru]").val(),
                            'en': $("input[name=var_en]").val(),
                            'gr': $("input[name=var_gr]").val()
                        }
                    }
                }).done(function (data) {
                    window.location.reload();
                });
            });
        });


    });


</script>