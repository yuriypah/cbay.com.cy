<div class="page-header">
    <h1><?php echo $ctx->page->title; ?></h1>
</div>
<div>
    <div class="admin_folders well">
        <a href="/backend/settings/sortoptions"><img width="64" src="/resources/images/admin_folder.png"></a>

        <p><a href="/backend/settings/sortoptions" class="btn btn-default" role="button">Сортировать опции в
                поиске</a></p>
    </div>

    <div class="admin_folders well">
        <a href="/backend/settings/translate"><img width="64" src="/resources/images/admin_folder.png"></a>

        <p><a class="btn btn-default" href="/backend/settings/translate">Перевод сайта</a></p>
    </div>

    <div class="admin_folders well">
        <a href="/backend/settings/setpacks"><img width="64" src="/resources/images/admin_folder.png"></a>

        <p><a class="btn btn-default" href="/backend/settings/setpacks">Управление пакетами</a></p>
    </div>

    <div class="admin_folders well">
        <a href="/backend/settings/delivery"><img width="64" src="/resources/images/admin_folder.png"></a>

        <p><a class="btn btn-default" href="/backend/settings/delivery">Почтовая рассылка</a></p>
    </div>

    <div class="admin_folders well">
        <a href="/backend/users"><img width="64" src="/resources/images/admin_folder.png"></a>

        <p><a class="btn btn-default" href="/backend/users">Пользователи</a></p>
    </div>

    <div class="admin_folders well">
        <a href="/backend/companies"><img width="64" src="/resources/images/admin_folder.png"></a>

        <p><a class="btn btn-default" href="/backend/users/companies">Витрины</a></p>
    </div>

</div>

<Br/>
<?php echo Form::open(NULL, array('class' => 'form-horizontal')); ?>

<div class="control-group well">
    <?php echo Form::label('setting_site_title', 'Заголовок сайта:', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo Form::input('setting[site_title]', Model_Setting::get('site_title'), array('class' => 'input-xxlarge', 'id' => 'setting_site_title')); ?>
        <p class="help-block">Этот текст будет отображаться в панеле управления и может использоваться в темах.</p>
    </div>
</div>

<div class="control-group well">
    <?php echo Form::label('setting_date_format', 'Формат даты:', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        echo Form::select('setting[date_format]', array(
            'Y-m-d' => '2011-12-14',
            'd.m.Y' => '14.12.2011',
            "Y/m/d" => "2011/12/14",
            "m/d/Y" => "12/14/2011",
            "d/m/Y" => "14/12/2011"
        ), Model_Setting::get('date_format'), array('id' => 'setting_date_format'));
        ?>
    </div>
</div>

<div class="control-group well">
    <?php echo Form::label('setting_display_errors', 'Вывод ошибок:', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo Form::select('setting[display_errors]', array(
            'on' => 'Включен',
            'off' => 'Выключен',
        ), Model_Setting::get('display_errors'), array('id' => 'setting_display_errors')); ?>
    </div>
</div>

<div class="form-actions">
    <?php echo Form::button('submit', 'Сохранить', array('icon' => HTML::icon('ok'))); ?>
</div>
<div class="notify">
    <div class="notify_head">Уведомления</div>
    <div class="notify_content">
        <?php
        if ($new_adverts > 0) {
            echo "<b><span style='color:gray'>Новых объявлений: <span style='color:green'><a href='/backend/adverts'>" . $new_adverts . "</a></span></span></b>";
        } else {
            echo "<span style='color:gray'>Уведомлений пока нет</span>";
        }
        ?>

    </div>
</div>
<?php echo Form::close(); ?>