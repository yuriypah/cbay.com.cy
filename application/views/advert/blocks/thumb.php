<?
if (isset($main_image)) {
    $image_path = explode("/", $thumb);
    $image = $image_path[(count($image_path) - 1)];

}
if(!file_exists($thumb)) {
    return;
}
?>
<script>
    rotateInc["/<?php echo($thumb); ?>"] = parseInt("<?php echo $rotate[$image]?>", 10) || 0;
</script>
<li class="span2">
    <? if ($actions) : ?>
    <? if (isset($main_image)) : ?>
    <div <?= ($main_image == $image ? ' class="image-selector image-selected"' : ' class="image-selector"') ?>>
        <? else : ?>
        <div class="image-selector">
            <? endif; ?>
            <? else: ?>
            <? if (isset($main_image)) : ?>
            <div <?= ($main_image == $image ? ' class="image-select-box image-selected"' : ' class="image-select-box"') ?>>
                <? else : ?>
                <div class="image-selector">
                    <? endif; ?>
                    <? endif; ?>
                    <div class="thumbnail">
                        <?php
                            echo HTML::image($thumb, array(
                                'data-path' => !isset($data_path) ? Encrypt::instance()->encode($thumb) : $data_path,
                                'class' => $rotate[$image] != "" ? "rotate_" . $rotate[$image] : ""
                            ));

                        ?>
                        <span class="rotate"></span>
                    </div>
                    <?php if ($actions): ?>
                        <?php echo HTML::anchor('#', __('place.label.delete'), array('class' => 'delete btn btn-mini btn-danger')); ?>
                        <?php echo Form::hidden('images[]', $thumb); ?>
                    <?php endif; ?><br>
                    <?= __('place.label.main_photo') ?>
                </div>
</li>
