<div id="sub-sub-menu">
	<div class="wrapper">
		<ul>
                    <li class=""><?php echo HTML::anchor('messages', __('messages_page.label.income'))?></li>
                    <li class="separator"></li>
                    <li class=""><?php echo HTML::anchor('messages/inbox', __('messages_page.label.inbox'))?></li>
                    <li class="separator"></li>
                    <li class="current"><?php echo HTML::anchor('messages/drafts', __('messages_page.label.drafts'))?></li>
                </ul>
		<div class="clear"></div>
	</div>
</div>
<?php if(count($messages) > 0): ?>
<?php echo Form::open('form-messages-deldrafts'); ?>
<div id="bookmark-panel">
	<div class="pull-left form-inline">
		<label class="chkAll">
			<input type="checkbox" id="chkAll" name="check_all"><span><?php echo __('messages_page.label.check_all'); ?></span>
		</label>
		&nbsp;&nbsp;&nbsp;
		<?php echo Form::button('delete', __('messages_page.label.delete_selected'), array('class' => 'btn btn-danger')); ?>
	</div>
	<div class="clear"></div>
</div>

<?php echo Form::hidden('token', Security::token()); ?>
<table class="table table-striped">
	<colgroup>
		<col width="50px" />
		<col />
		<col width="150px" />
		<col width="180px" />
	</colgroup>
	<thead>
		<tr>
			<th></th>
			<th><?php echo __('messages_page.label.title'); ?></th>
			<th>Получатель: <?//= __('messages_page.label.author'); ?></th>
			<th><?php echo __('messages_page.label.date'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($messages as $message): ?>
		<tr>
			<td><?php echo Form::checkbox('item['.$message->id.']'); ?></td>
			<th><?php echo HTML::anchor('advert/' . $message->advert_id.'?draft='.$message->id.'#message-click', $message->title); ?></th>
			<td><?php echo $message->author; ?></td>
			<td><?php echo $message->created(); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php echo Form::close(); ?>

<?php else: ?>
<div class="hero-unit">
	<h1><?php echo __('messages_page.draft_title'); ?></h1>
	<hr />
	<p class="lead"><?php echo __('messages_page.darft_text.what_is'); ?></p>
</div>

<?php endif; ?>