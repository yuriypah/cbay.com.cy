<div class="accordion_block showed">
    <div class="form-title ">   <?php echo __('profile_page.settings.title.personal_information'); ?></div>
    <div class="accordion">
        <div class="control-group">
            <label class="control-label"><?php echo __('profile_page.settings.label.email'); ?></label>

            <div class="controls">
                <div class="row padding-4px">
                    <div class="span2">
                        <?php echo $user->email; ?>
                        <?php if ($user->id == (string)Auth::instance()->get_user()) { ?>
                            <a href="/profile/changeemail"><i class="icon-pencil"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?php echo __('profile_page.settings.label.profile_type'); ?></label>

            <div class="controls">
                <div class="row padding-4px">
                    <div class="span2">
                        <?php echo __($user->profile->type == 2 ? "profile_page.settings.label.type.company" : "profile_page.settings.label.type.private"); ?>
                        <?php if ($user->id == (string)Auth::instance()->get_user()) { ?>
                            <a href="/profile/changeprofiletype"><i class="icon-pencil"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo __('profile_page.settings.label.registered'); ?></label>

            <div class="controls">
                <div class="row padding-4px">
                    <div class="span2 gray">
                        <?php echo Date::format($user->profile->created, 'd F Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>