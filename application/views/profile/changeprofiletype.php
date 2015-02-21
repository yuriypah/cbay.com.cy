<h1><?php echo __('profile_page.settings.label.change_profile_type'); ?></h1>
<?php
echo Form::open(null, array(
    'method' => 'POST',
    'id' => 'form_changeprofiletype'
));
echo Form::select('profiletype', array(
        1 => __('profile_page.settings.label.type.private'),
        2 => __('profile_page.settings.label.type.company')),
    $user->profile->type
);
?>
<Br/>
<?php
echo Form::submit(null, __('profile_page.settings.label.save'), array(
    'class' => 'btn'
));
echo Form::close();
