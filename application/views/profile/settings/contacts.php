<?php echo Form::open('/form-profile-contacts', array('method' => 'post', 'class' => 'ajax', 'id' => 'form_profle_edit_contacts')); ?>
<?php echo Form::hidden('token', Security::token()); ?>
<div class="accordion_block">
    <div class="form-title"><?php echo __('profile_page.settings.title.contacts_information'); ?></div>
    <div class="accordion contacts" style="display:none">
        <div class="control-group">
            <label class="control-label"
                   for="profile_name"><?php echo __('profile_page.settings.label.name'); ?></label>

            <div class="controls">
                <?php
                echo Form::input('profile[name]', $user->profile->name, array(
                    'id' => 'profile_name', 'class' => ''
                ));
                ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label"
                   for="profile_phone"><?php echo __('profile_page.settings.label.phone'); ?></label>

            <div class="controls">
                <?php
                echo Form::input('profile[phone]', $user->profile->phone, array(
                    'id' => 'profile_phone', 'class' => ''
                ));
                ?>
            </div>
        </div>

        <?php if (count(Model_Lang_Part::$languages) > 1): ?>
            <div class="control-group">
                <label class="control-label"
                       for="profile_language"><?php echo __('profile_page.settings.label.language'); ?></label>

                <div class="controls">
                    <?php
                    echo Form::select('profile[default_locale]', Model_Lang_Part::$languages, $user->profile->default_locale, array(
                        'id' => 'profile_language'
                    ));
                    ?>
                </div>
            </div>
        <?php else: ?>
            <?php echo Form::hidden('profile[default_locale]', $user->profile->default_locale); ?>

        <?php endif; ?>
        <?php echo View::factory('map/form', array(
            'city_id' => $user->profile->city_id,
            'field' => 'profile'
        ));?>
        <div class="control-group">
            <div class="controls">
                <div class="row">
                    <div class="span2">
                        <button type="submit"
                                class="btn"><?php echo __('profile_page.settings.label.save') . ' ' . HTML::icon('chevron-right'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php echo Form::close(); ?>