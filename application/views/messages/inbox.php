<div id="sub-sub-menu">
	<div class="wrapper">
		<ul>
                    <li class=""><?php echo HTML::anchor('messages', __('messages_page.label.income'))?></li>
                    <li class="separator"></li>
                    <li class="current"><?php echo HTML::anchor('messages/inbox',  " <i class='icon icon-ok'></i> ".__('messages_page.label.inbox')."&nbsp;")?></li>
                   <!-- <li class="separator"></li>
                    <li class=""><?php echo HTML::anchor('messages/drafts', __('messages_page.label.drafts'))?></li>-->
                </ul>
		<div class="clear"></div>
	</div>
</div>
<?php if(count($messages) > 0): ?>
<?php echo Form::open('form-messages-delinbox'); ?>

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
<th></th>
			<th><?php echo __('messages_page.label.date'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($messages as $message): ?>
		<tr>
			<td></td>
			<th><?php
                if($message->status == 0) {
                    echo HTML::anchor('messages/inboxview/' . $message->id,$message->title)."<span style='color:gray;font-weight:100'> (Еще не прочитано пользователем)</span>";
                } else {
                    echo HTML::anchor('messages/inboxview/' . $message->id,"<span style='font-weight:100'>".$message->title."</span>");
                }
                    ?>
                </th>
			<td></td>
			<td><?php echo $message->created(); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php echo Form::close(); ?>

<?php else: ?>
<div class="hero-unit">
	<h1><?php echo __('messages_page.inbox_title'); ?></h1>
	<hr />
	<p class="lead"><?php echo __('messages_page.inbox_text.what_is'); ?></p>
</div>

<?php endif; ?>