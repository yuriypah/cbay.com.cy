<?php echo Form::open('/form-profile-messages', array('method' => 'post', 'class' => 'ajax', 'id' => 'form_profle_edit_messages')); ?>
<?php echo Form::hidden('token', Security::token()); ?>
<div class="accordion_block">
    <div class="form-title"><?php echo __('profile_page.settings.title.messages'); ?></div>
    <div class="accordion" style="display: none">
        <?php echo HTML::message(__('profile_page.settings.text.messages_info')); ?>

        <div class="control-group">
            <label class="checkbox inline">
                <?php echo Form::checkbox('message[notice]', 1, $user->profile->notice == 1, array('id' => 'message_notice')); ?>
                <?php echo __('profile_page.settings.label.notice'); ?>
            </label>
            <br/>
            <label class="checkbox inline">
                <?php echo Form::checkbox('message[remiders]', 1, $user->profile->remiders == 1, array('id' => 'message_remiders')); ?>
                <?php echo __('profile_page.settings.label.remiders'); ?>
            </label>
        </div>
        <div class="control-group">
            <button type="submit"
                    class="btn"><?php echo __('profile_page.settings.label.save') . ' ' . HTML::icon('chevron-right'); ?></button>
        </div>
    </div>
    </div>
<?php echo Form::close(); ?>