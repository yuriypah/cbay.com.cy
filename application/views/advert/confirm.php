<?php echo HTML::message(__('place.text.check.')); ?>

<div class="form-horizontal">
	
	<div class="form-title"><?php echo __('place.title.personal_information'); ?></div>

	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.name'); ?></label>
		<div class="controls">
			<?php echo Arr::get($data, 'name'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.email'); ?></label>
		<div class="controls">
			<?php echo Arr::get($data, 'email'); ?>
			
			<?php if(Arr::get($data, 'allow_mails') === Model_Advert::MAILS_NOT_ALLOW): ?>

			<?php endif; ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.phone'); ?></label>
		<div class="controls">
			<?php echo Model_User_Profile::format_phone(Arr::get($data, 'phone')); ?>

		</div>
	</div>
    <?php
    if(Arr::get($data, 'skype')) {
        ?>
        <div class="control-group">
            <label class="control-label"><?php echo __('place.label.skype'); ?></label>
            <div class="controls">
                <?php echo Arr::get($data, 'skype'); ?>

            </div>
        </div>
    <?php
    }
    ?>


	<br />

	<div class="form-title"><?php echo __('place.title.advert_information'); ?></div>
	
	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.title'); ?></label>
		<div class="controls">
			<?php echo Arr::get($data, 'title'); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.amount'); ?></label>
		<div class="controls">
			<?php if(Arr::get($data, 'amount') > 0): ?>
			<?php echo Arr::get($data, 'amount'); ?> <?php echo __('currency.euro'); ?>
			<?php else: ?>
			<?php echo __('currency.no_set'); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.category'); ?></label>
		<div class="controls">
			<?php echo implode(' &rarr; ', $category); ?>
		</div>
	</div>

    <?php if(!empty($options_for_view)){ ?>
	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.selected_options'); ?></label>
		<div class="controls">
			<?php foreach($options_for_view as $v){
                echo !empty($v['label']) ? $v['label'] . ': ' : '';
                echo $v['value'] . '<br />';
			}; ?>
		</div>
	</div>
	<div id="categoryoptions"></div>
    <?php } ?>
        <? if(Arr::get($data, 'keywords')) :?>
	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.keywords'); ?></label>
		<div class="controls">
			<?= Arr::get($data, 'keywords'); ?>
		</div>
	</div>
        <? endif; ?>
	<div class="control-group">
		<label class="control-label"><?php echo __('place.label.description'); ?></label>
		<div class="controls">
			<?php $description = Arr::get($data, 'description'); ?>
			<?php if(empty($description)): ?>
			—
			<?php else: ?>
			<?php echo $description; ?>
			<?php endif; ?>
		</div>
	</div>
        <? $package = Arr::get($data, 'addpackege');  ?>
        <? if($package) :?>
            <div class="control-group">
                    <label class="control-label"><?php echo __('place.label.package'); ?></label>
                    <div class="controls">
                        <div class="pull-left">

                           <? if($package == 'pack5') {?>
                                <div class="alert alert-info package-block-confirm">
                                    <div class="pull-left">
                                        <img src="/resources/images/prestig.png" class="sale_img"/>
                                    </div>
                                    <div class="pull-right package-textbox">
                                        <? echo __('package.description.premium'); ?>
                                    </div>
                                </div>
                           <? } ?>
                           <? if($package == 'pack2') {?>
                                <div class="alert alert-info package-block-confirm">
                                    <div class="pull-left">
                                        <img src="/resources/images/vip.png" class="sale_img"/>
                                    </div>
                                    <div class="pull-right package-textbox">
                                        <? echo __('package.description.vip'); ?>
                                    </div>
                                </div>
                           <? } ?>
                           <? if($package == 'pack3') {?>
                                <div class="alert alert-info package-block-confirm">
                                    <div class="pull-left">
                                        <img src="/resources/images/color.png" class="sale_img"/>
                                    </div>
                                    <div class="pull-right package-textbox">
                                        <? echo __('package.description.selected'); ?>
                                    </div>
                                </div>
                           <? } ?>
                           <? if($package == 'pack4') {?>
                                <div class="alert alert-info package-block-confirm">
                                    <div class="pull-left">
                                        <img src="/resources/images/up.png" class="sale_img"/>
                                    </div>
                                    <div class="pull-right package-textbox">
                                        <? echo __('package.description.top'); ?>
                                    </div>
                                </div>
                           <? }  ?>
                       </div>
                    </div>
            </div>
        <? endif; ?>
</div>

<?php if(isset($data['images'])): ?>
<div class="form-title"><?php echo __('place.label.images'); ?></div>
<div id="place-thumbnails" class="thumbnails row"
	<ul class="unstyled">	
		<?php
                        $main_image = null;
                        if(isset($data['main_image']))
                            $main_image = $data['main_image'];
			foreach ( $data['images'] as $image )
			{
				echo View::factory('advert/blocks/thumb', array('thumb' => $image, 'actions' => FALSE, 'main_image' => $main_image));
			}
		?>
	</ul>
</div>
<div class="clear"></div>
<?php endif; ?>

<?php echo Form::open('', array('class' => 'form-horizontal', 'id' => 'form_advert_confirm')); ?>
	<?php echo $auth_form; ?>
        <div class="form-title"><?= __('captcha.label.title'); ?></div>
        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label"><?= __('captcha.label.lable'); ?></label>
                <div class="controls">
                    <? echo $data['captcha'] ?>
                    <br>
                    <?= Form::input('captcha') ?>
                </div>
            </div>
        </div>
	<div class="form-actions">
        <button name="action" value="back" class=" btn"><?php echo HTML::icon('chevron-left icon-black') . ' ' . __('place.label.back')."&nbsp;"; ?></button>
        &nbsp;&nbsp;&nbsp;<button name="action" value="next" class="btn btn-success"><?php echo "&nbsp;".__('place.label.ready') . ' ' . HTML::icon('chevron-right'); ?></button>


	</div>
<?php echo Form::close(); ?>
