<div class="page-header">
	<h1><?php echo $ctx->page->title; ?></h1>
</div>

<div class="well page-actions">
    <?= Form::open() ?>
	<?= Form::button('create_sitemap', __('generatesitemap.label.create_button')) ?>
    <?= Form::close() ?>
</div>
