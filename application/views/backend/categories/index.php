<?php
if ($parts['ru']->related_id) {
    ?>
    <h1>Категория: <?php echo $parts['ru']->title ?></h1>
    <a class="btn btn-mini btn-warning" href="/backend/categories/edit/<?php echo $parts['ru']->related_id ?>">Редактировать категорию</a>

    <a class="pull-right btn btn-mini btn-danger" onclick="return confirm('ВАЖНО: Необходимо убедиться в отсутсвтии подкатегорий и опций у категории, преждем ее удалить. Продолжить удаление?')"
       href="/backend/categories/remove/<?php echo $parts['ru']->related_id ?>">Удалить категорию</a>
    <Br/>
    <h3 style='color: gray'>Настроить языковые параметры:</h3>
    <table class='table '>
        <tr>
            <td><img src="/resources/images/lang-ru.png"/></td>
            <td><input name='category_ru' type='text'
                       value='<?php echo $parts['ru']->title ?>'/></td>
        </tr>
        <tr>
            <td><img src="/resources/images/lang-en.png"/></td>
            <td><input name='category_en' type='text'
                       value='<?php echo $parts['en']->title ?>'/></td>
        </tr>
        <tr>
            <td><img src="/resources/images/lang-gr.png"/></td>
            <td><input name='category_gr' type='text'
                       value='<?php echo $parts['gr']->title ?>'/></td>
        </tr>
        <tr>
            <td><img src="/resources/images/lang-zh.png"/></td>
            <td><input name='category_zh' type='text'
                       value='<?php echo $parts['zh']->title ?>'/></td>
        </tr>

    </table>

    <input class='category_save btn btn-default' type='button'
           value='Сохранить изменения'/>
    <hr/>
    <Br/>
<?
}
?>



<h3>Действия</h3>
<div id="container-content">
    <div id="bookmark-panel">
        <?php

        echo HTML::anchor('/backend/categories/add/', 'Добавить категорию', array(
            'class' => 'btn'
        ));
        ?>

        <?php

        echo HTML::anchor('/backend/options/add/', 'Добавить опцию', array(
            'class' => 'btn'
        ));
        ?>
        <div class="clear"></div>
    </div>
</div>
<?php echo $options; ?>
<script type="text/javascript">
    $(document).ready(function () {
        Translate.translatePanel();
    });
    $('.category_save').click(function () {
        var category_id = '<?php echo $parts['ru']->related_id ?>';
        if (category_id != '') {
            $.ajax({
                'url': '/backend/categories/savecategorieslang',
                'type': 'post',
                'data': {
                    'category_id': category_id,
                    'langs': {
                        'ru': $("input[name=category_ru]").val(),
                        'en': $("input[name=category_en]").val(),
                        'gr': $("input[name=category_gr]").val(),
                        'zh': $("input[name=category_zh]").val()
                    }
                }
            }).done(function (data) {
                window.location.reload();
            });
        }
    });
</script>