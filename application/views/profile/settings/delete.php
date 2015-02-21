<?php echo Form::open('profile/delete', array('method' => 'post', 'id' => 'form_profle_delete')); ?>
<?php echo Form::hidden('token', Security::token()); ?>
    <div class="accordion_block">
        <div class="form-title"><?php echo __('profile_page.settings.title.delete_profile'); ?></div>
        <div class="accordion" style="display:none">

            <?php echo HTML::message(__('profile_page.settings.text.delete_info'), ''); ?>
            <button type="submit" name="delete" value="process"
                    class="btn btn-danger"><?php echo __('profile_page.settings.label.delete') . ' ' . HTML::icon('trash icon-white'); ?></button>
        </div>
    </div>
<?php echo Form::close(); ?>