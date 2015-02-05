<p><?php echo __('message.send.template', array(
        ':advert_link' => HTML::anchor('advert/' . $advert->id, $advert->part()->title),
        ':author' => $name,
        ':text' => $text
    )); ?>
</p>
