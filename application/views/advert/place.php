<script id="thumbnail" type="text/x-jquery-tmpl">
	<?php echo View::factory('advert/blocks/thumb', array(
        'thumb' => '${file}',
        'data_path' => '${path}',
        'actions' => TRUE
    )); ?>
















</script>
<?php if ($action == 'place'): ?>
    <?php echo HTML::message(__('place.text.info')); ?>
<?php endif; ?>

<?php echo Form::open('', array('class' => 'form-horizontal', 'id' => 'form_advert_place')); ?>
<?php echo Form::hidden('token', Security::token()); ?>
<?php echo Form::hidden('package_id', $ctx->config->default_package); ?>

<?php
if ($ctx->auth->logged_in())
    echo View::factory('advert/blocks/place_registered', array('data' => $data));
else
    echo View::factory('advert/blocks/place_notregisterd', array('data' => $data));
?>
<?php if ($action == 'place'): ?>
    <?php echo View::factory('map/form', array(
        'city_id' => Arr::get($data, 'city_id', $city),
        'field' => NULL
    ));?>
<?php endif; ?>

<?php // if($action == 'place'): ?>

<div class="control-group <?php echo Arr::path($messages_array, 'errors.category_id') ? 'error' : ''; ?>">
    <label class="control-label" for="title"><?php echo __('place.label.category'); ?></label>

    <div class="controls">

        <?php
        echo "<select name='category_id' id='category_id' onchange='category_select()'><option value='0'>-- Выберите категорию --</option>";
        foreach ($categories as $key => $value) {
            if (is_array($value)) {
                echo "<optgroup label='" . $key . "'>";
                foreach ($value as $key_item => $value_item) {
                    echo "<option " . (Arr::get($data, 'category_id') == $key_item ? " selected='selected' " : "") . " value='" . $key_item . "'>" . $value_item . "</option>";
                }
                echo "</optgroup>";
            } else {
                echo "<option " . (Arr::get($data, 'category_id') == $key_item ? " selected='selected' " : "") . " value='" . $key . "'>" . $value . "</option>";
            }
        }
        echo "</select>";
        /* echo Form::select('category_id', array_merge(array('-- Выберите категорию --'), $categories), Arr::get($data, 'category_id'), array(
             'id' => 'category_id',
             'data-title' => __('advert.tooltip.category'),
             'OnChange' => 'category_select()',
         ));*/
        ?>

        <?php echo Form::error('errors.category_id', $messages_array); ?>
        <script type="text/javascript">

            cat_options = '<?= isset($data['option']) ? json_encode($data['option']) : false ?>';
            $(document).ready(function () {
                category_select(<?= isset($data["category_id"]) ? $data["category_id"] : 'null' ?>);
            });
        </script>
    </div>
</div>
<div id="categoryoptions"></div>
<?php // endif; ?>

<div class="control-group <?php echo Arr::path($messages_array, 'errors.title') ? 'error' : ''; ?>">
    <label class="control-label" for="title"><?php echo __('place.label.title'); ?></label>

    <div class="controls">
        <?php
        echo Form::input('title', Arr::get($data, 'title'), array(
            'id' => 'title', 'class' => 'span7', 'title' => __('advert.tooltip.title')
        ));
        ?>

        <?php echo Form::error('errors.title', $messages_array); ?>
    </div>
</div>
<!--<div class="control-group">
		<label class="control-label" for="keywords"><?php echo __('place.label.keywords'); ?></label>
		<div class="controls">
			<?php
echo Form::input('keywords', Arr::get($data, 'keywords'), array(
    'id' => 'keywords', 'class' => 'span7', 'title' => __('advert.tooltip.keywords')
));
?>
			<?php echo Form::error('errors.keywords', $messages_array); ?>
		</div>
	</div>-->
<div class="control-group">
    <label class="control-label" for="description"><?php echo __('place.label.description'); ?></label>

    <div class="controls">
        <?php
        echo Form::textarea('description', Arr::get($data, 'description'), array(
            'id' => 'description', 'maxlength' => 1500, 'class' => 'span7', 'title' => __('advert.tooltip.description')
        ));
        ?>
        <div id="leftchars">Осталось символов: <span>1500</span></div>
        <?php echo Form::error('errors.description', $messages_array); ?>
    </div>
</div>
<!--
        <?php if (Model_Lang_Part::count() > 1): ?>
        <div class="control-group">
            <label class="control-label" for="language"><?php echo __('place.label.language'); ?></label>
            <div class="controls">
                <?php echo Form::locales(); ?>
            </div>
        </div>
        <?php else: ?>
        <?php echo Form::locales(); ?>
        <?php endif; ?>
        -->
<div class="control-group <?php echo Arr::path($messages_array, 'errors.amount') ? 'error' : ''; ?>">
    <label class="control-label" for="amount"><?php echo __('place.label.amount'); ?></label>

    <div class="controls">
        <div class='price_fix clearfix'>
            <?php
            echo Form::input('amount', Arr::get($data, 'amount', 0), array(
                'id' => 'amount', 'class' => 'input-small', 'title' => __('advert.tooltip.amount')
            ));
            ?> <?php echo __('currency.euro'); ?>
        </div>
        <div id="period"></div>


        <?php echo Form::error('errors.amount', $messages_array); ?>
    </div>
</div>

<hr/>

<div class="control-group">

    <label class="control-label" for="upload"><?php echo __('place.label.images'); ?></label>

    <div class="controls">
        <div class="alert alert-info"><?php echo __('advert.tooltip.images'); ?></div>
        <label class="uploadbutton">
            <div class="button"><?php echo __('place.button.uploadimages'); ?></div>
            <?php
            echo Form::file('file', array(
                'id' => 'upload', 'multiple' => 'multiple'
            ));
            ?>
        </label>

        <?php
        echo HTML::image($resources_path . 'images/preloader.gif', array(
            'id' => 'upload_preloader', 'class' => 'hide'
        ));
        ?>

        <div id="place-thumbnails" class="thumbnails row">
            <ul class="unstyled">
                <?php if (isset($data['images'])): ?>
                    <?php
                    $main_image = null;
                    if (isset($data['main_image']))
                        $main_image = $data['main_image'];
                    foreach ($data['images'] as $k => $image) {
                        if ($image === NULL) continue;
                        echo View::factory('advert/blocks/thumb', array(
                            'thumb' => $data['images'][$k],
                            'actions' => true,
                            'main_image' => $main_image,
                            'rotate' => $data['image_rotation'][$k]
                        ));
                    }
                    ?>
                <?php endif; ?>
            </ul>
            <? echo Form::hidden('main_image', Arr::get($data, 'main_image'), array('id' => 'main_image')) ?>
        </div>

    </div>
</div>
<div class="control-group">
    <label class="control-label" for="language"><?= __('place.label.suggestion') ?></label>

    <div class="controls">
        <?php if (strtotime($data['premium']) <= time()) {
            ?>
            <div class="alert alert-info package-block">
                <input type="checkbox" name="addpackege" value="pack5" class="pull-left package-select">

                <div class="pull-left">
                    <img src="/resources/images/prestig.png" class="sale_img"/>
                </div>
                <div class="pull-right package-textbox">
                    <? echo __('package.description.premium'); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (strtotime($data['vip']) <= time()) {
            ?>
            <div class="alert alert-info package-block">
                <input type="checkbox" name="addpackege" value="pack2" class="pull-left package-select">

                <div class="pull-left">
                    <img src="/resources/images/vip.png" class="sale_img"/>

                </div>
                <div class="pull-right package-textbox">
                    <? echo __('package.description.vip'); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (strtotime($data['selected']) <= time()) {
            ?>
            <div class="alert alert-info package-block">
                <input type="checkbox" name="addpackege" value="pack3" class="pull-left package-select">

                <div class="pull-left">
                    <img src="/resources/images/color.png" class="sale_img"/>

                </div>
                <div class="pull-right package-textbox">
                    <? echo __('package.description.selected'); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (strtotime($data['time']) <= time()) {
            ?>
            <div class="alert alert-info package-block">
                <input type="checkbox" name="addpackege" value="pack4" class="pull-left package-select">

                <div class="pull-left">
                    <img src="/resources/images/up.png" class="sale_img"/>

                </div>
                <div class="pull-right package-textbox">
                    <? echo __('package.description.top'); ?>
                </div>
            </div>
        <?php
        }
        ?>

        <? if (isset($data['addpackege'])) : ?>
            <script>
                $(function () {
                    setSelectedPack('<?php echo json_encode($data['addpackege']) ?>')
                });
            </script>
        <? endif; ?>
    </div>
</div>
<div class="form-actions">
    <button name="action" value="next"
            class="btn btn-success"><?php echo __('place.label.next') . ' ' . HTML::icon('chevron-right'); ?></button>

</div>
<?php echo Form::close(); ?>
