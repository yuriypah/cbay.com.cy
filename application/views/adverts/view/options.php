<script type="text/javascript">
	I18n.advert_options = {
		'add_bookmarks': '<?php echo __('advert_page.label.add_bookmarks'); ?>',
		'remove_bookmarks': '<?php echo __('advert_page.label.remove_bookmarks'); ?>',
	}
</script>

<div id="advert-options">
	<ul class="unstyled">
		<?php if($advert->allow_mails() && $advert->user->profile->id != $ctx->auth->get_user()->profile_id): ?>
		<li>
			<?php echo HTML::anchor('#', __('advert_page.label.send_email'), array('class' => 'mail-to-user option', 'id' => 'message-click')); ?>
		</li>
		<?php endif; ?>
		<?php /*<li>
			<?php echo HTML::anchor('#', __('advert_page.label.send_friend'), array('class' => 'mail-to-friend option')); ?>
		</li> */ ?>
		<li>
			<?php echo HTML::anchor('#', __('advert_page.label.abuse'), array('class' => 'report option')); ?>
		</li>
		<li>
			<?php if(in_array($advert->id, Arr::get(Model_Bookmark_Cookie::$bookmarks, 'advert', array()))): ?>
			<?php echo HTML::anchor('#', __('advert_page.label.remove_bookmarks'), array('class' => 'add-to-bookmarks added')); ?>
			<?php else: ?>
			<?php echo HTML::anchor('#', __('advert_page.label.add_bookmarks'), array('class' => 'add-to-bookmarks')); ?>

			<?php endif; ?>
		</li>
        <li>
            <?php echo HTML::anchor('#', __('advert_page.label.print'), array('class' => 'add-to-print', 'onclick' => 'window.print();return false')); ?>
        </li>
        <li style="margin-right:0" class="pull-right">
            <script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
            <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
            <div class="ya-share2" data-services="vkontakte,facebook,gplus,twitter"></div>

            <style>
                .ya-share2 a{
                    padding-left:0px !important;
                }
                .ya-share2 li {
                    margin-right:5px !important;
                }
            </style>
        </li>
        <li class="pull-right" style="margin-right:0">
            <input type="text" class="link_sel" value="https://cbay.com.cy/advert/<?=$advert->id?>" style="width:200px;height:15px"/>
            <script>
                $(".link_sel").select();
            </script>
        </li>
		<!--<li class="pull-right">
			<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki"></div> 

		</li>-->
	</ul>
	<div class="clear"></div>
	
	<div id="options-form-container"></div>
</div>
<br />