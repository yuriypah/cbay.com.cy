<div id="sub-sub-menu">
    <div class="wrapper">
        <ul>
            <li class=""><a href="/backend/adverts"><?= __('backend.adverts.new'); ?> <?= ($new_count > 0) ? '('.$new_count.')' : '' ?></a></li>
            <li class="separator"></li>
            <li class=""><a href="/backend/adverts/enabled"><?= __('backend.adverts.enabled'); ?></a></li>
            <li class="separator"></li>
            <li class="current"><a href="/backend/adverts/blocked"><?= __('backend.adverts.blocked'); ?></a></li>
        </ul>
        <div class="pull-right">
            <?= __('backend.adverts.selected'); ?>:
            <input type="button" onclick="backend.advAction('manyunblock')" value=" <?= __('backend.adverts.unblock'); ?>" class="advert_deactivate btn btn-mini btn-success">
        </div>
        <div class="clear"></div>
    </div>
</div>

<div id="adverts-list" class="type-edit">
    <? foreach($adverts as $advert) :?>
        <div class="item  backend" data-id="63">

            <div class="image">
                <?php if($advert->image_exists('135_90'))
                {
                    $image = HTML::image( $advert->image('135_90'), array('width' => '60px', 'title' => $advert->title(), 'alt' => $advert->title()) );
                    echo HTML::anchor('advert/'.$advert->id, $image);
                }
                else
                    echo HTML::anchor('advert/'.$advert->id, NULL, array('class' => 'no-image', 'title' => $advert->title()));
                ?>
            </div>
            <div class="content">
                <?php echo HTML::anchor('advert/'.$advert->id, $advert->title(), array('class' => '')); ?>
                <input type="checkbox" class="pull-right advert-checkbox" name="checked" value="<?= $advert->id; ?>">
                <br>
                <div class="options backend">
                    <span class=""><?= __('backend.adverts.author'); ?>: <?= HTML::anchor('backend/adverts/blocked/'.$advert->user_id.$ip, $advert->user, array('class' => '')); ?></span><br>
                    <span class="">IP: <?= HTML::anchor('backend/adverts/blocked/'.$id.'?ip='.$advert->ip(), $advert->ip(), array('class' => '')); ?></span><br>
                    <span class=""><?= __('backend.adverts.added'); ?>: <?= $advert->published_on(); ?></span><br>
                    <span class=""><?= __('backend.adverts.changed'); ?>: <?= $advert->updated_on(); ?></span><br>
                </div>
            </div>
            <div class="options backend">
                <a href="/backend/users/blockuser/<?= $advert->user_id; ?>" class="advert_deactivate btn btn-mini btn-danger"><?= __('backend.adverts.block_user'); ?></a>
                <a href="/backend/adverts/unblock/<?= $advert->id; ?>" class="advert_deactivate btn btn-mini btn-success"><?= __('backend.adverts.mark_enabled'); ?></a>
            </div>
        </div>
    <? endforeach; ?>
</div>