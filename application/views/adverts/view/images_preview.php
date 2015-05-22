<?php
$html = "";
$other_images = $advert->images->find_all();
    $html .= "<a class='fancybox_gallery' rel='fancybox_gallery_".$advert->id."' href='/" . $advert->image('full') . "'><img src='/" . $advert->image('full') . "'/></a>";
if ($other_images) {
    foreach ($other_images as $image) {
        if ($image->exists('full')) {
            $html .= "<a class='fancybox_gallery' rel='fancybox_gallery_".$advert->id."' href='/" . $image->image('full') . "'><img src='/" . $advert->image('full') . "'/></a>";
        }
    }
}
echo $html;
?>