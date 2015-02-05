<h1><?php echo "Настройка опции: <span style='color:gray'>".$parts['ru']->title."</span>" ?></h1>
	<div class="form-title"><?php echo __('General information'); ?></div>

	<div class="tabbable">
		<!--<?php if(count(Model_Lang_Part::$languages) > 1): ?>
		<ul class="nav nav-tabs">
		<?php foreach (Model_Lang_Part::$languages as $locale => $language) : ?>
		<li <?php if($locale == I18n::lang()):?>class="active"<?php endif; ?>><a href="#tab<?php echo $locale; ?>" data-toggle="tab"><?php echo $language; ?></a></li>
		<?php endforeach; ?>
		</ul>
		<?php endif; ?>-->
		<div class="tab-content">
		<?php foreach (Model_Lang_Part::$languages as $locale => $language) : ?>
			<hr/><h1><img src="/resources/images/lang-<?php echo $locale ?>.png"/></h1>
			<div class="tab-pane <?php if($locale == I18n::lang()):?>active<?php endif; ?>" id="tab<?php echo $locale; ?>">
				<div class="control-group">
					<?php echo Form::label('form_title_'.$locale, __('Название'), array(
						'class' => 'control-label'
					)); ?>
					<div class="controls">
						<?php echo Form::input( 'lang_part['.$locale.'][title]', isset($parts[$locale]) ? $parts[$locale]->title : NULL, array(
							'class' => 'input-title', 'id' => 'form_title_'.$locale
						)); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo Form::label('form_description_'.$locale, __('Описание'), array(
						'class' => 'control-label'
					)); ?>
					<div class="controls">
						<?php echo Form::textarea( 'lang_part['.$locale.'][description]', isset($parts[$locale]) ? $parts[$locale]->description : NULL, array(
							'id' => 'form_description_'.$locale, 'rows' => 3, 'class' => 'input-xlarge'
						)); ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
<hr/><hr/><hr/>