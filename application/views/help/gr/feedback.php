<?= __('help.feedback')?>
<br/><br/>
<h4><?= __('feedback.header')?></h4><Br/>
<form method="post" class="form-horizontal" action="/help/feedbackmessage">
    <div class="control-group ">
        <label class="control-label" for="title"><?= __('feedback.name')?></label>

        <div class="controls">
            <input type="text" placeholder="<?= __('feedback.name')?>" id="title" name="feedback_name" class="span5">
        </div>
    </div>
    <div class="control-group ">
        <label class="control-label" for="title"><?= __('feedback.email')?></label>

        <div class="controls">
            <input type="text" placeholder="<?= __('feedback.email')?>" id="title" name="feedback_email" class="span3">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="description"><?= __('message')?></label>

        <div class="controls">
            <textarea id="description" name="feedback_message" cols="50" rows="10" maxlength="1500" class="span7"></textarea>
        </div>
    </div>
    <div class="control-group">


        <div class="controls">
            <input class="btn btn-success" type="submit" value="<?= __('feedback.submit')?>"/>
        </div>
    </div>

</form>