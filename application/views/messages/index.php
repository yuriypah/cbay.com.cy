<div id="sub-sub-menu">
	<div class="wrapper">
		<ul>
                    <li class="current"><?php echo HTML::anchor('messages', __('messages_page.label.income'))?></li>
                    <li class="separator"></li>
                    <li class=""><?php echo HTML::anchor('messages/inbox', __('messages_page.label.inbox'))?></li>
                    <!--<li class="separator"></li>
                    <li class=""><?php echo HTML::anchor('messages/drafts', __('messages_page.label.drafts'))?></li>-->
                </ul>
		<div class="clear"></div>
	</div>
</div>
<!--<div id="message-types">
    <ul>
        <li class="pull-left"><?php echo HTML::anchor('messages','Входящие')?></li>
        <li class="pull-left"><?php echo HTML::anchor('messages/inbox','Исходящие')?></li>
        <li class="pull-left"><?php echo HTML::anchor('messages/drafts','Черновики')?></li>
    </ul>
</div>-->
<?php if(count($messages) > 0): ?>
<?php echo Form::open('form-messages-actions'); ?>
<div id="bookmark-panel">
	<div class="pull-left form-inline">
		<label class="chkAll">
			<input type="checkbox" id="chkAll" name="check_all" style="vertical-align: -2px"><span><?php echo __('messages_page.label.check_all'); ?></span>
		</label>
		&nbsp;&nbsp;&nbsp;
        <button name="delete" class="btn btn-danger" disabled="disabled">

            <i class="icon-trash icon-white icon"></i>  Удалить
        </button>

	</div>
	<div class="clear"></div>
</div>

<?php echo Form::hidden('token', Security::token()); ?>
<table class="table table-striped">
	<colgroup>
		<col width="50px" />
		<col />
		<col width="200px" />
		<col width="180px" />
	</colgroup>
	<thead>
		<tr>
			<th></th>
			<th><?php echo __('messages_page.label.title'); ?></th>
			<th><?php echo __('messages_page.label.author'); ?></th>
			<th><?php echo __('messages_page.label.date'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($messages as $message): ?>
		<tr>
			<td>&nbsp;<?php echo Form::checkbox('item['.$message->id.']'); ?></td>
			<th><?php echo HTML::anchor('messages/view/' . $message->id,
                $message->status != 1 ? $message->title : "<span style='font-weight:100'>".$message->title."</span>"
                ); ?></th>
			<td><?php echo $message->author!= '' ? $message->author : 'Анонимный пользователь'; ?></td>
			<td><?php echo $message->created(); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
    <script>
        $("input[type=checkbox]").change(function() {
            setTimeout(function() {
                if($("input[type=checkbox]:checked").length > 0) {
                    $("button[name=delete]").attr('disabled', false)
                } else {
                    $("button[name=delete]").attr('disabled', true)
                }
            },200)

        })
    </script>
<?php echo Form::close(); ?>

<?php else: ?>
<div class="hero-unit">
	<h1><?php echo __('messages_page.title'); ?></h1>
	<hr />
	<p class="lead"><?php echo __('messages_page.text.what_is'); ?></p>
</div>

<?php endif; ?>