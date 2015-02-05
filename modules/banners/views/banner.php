<div id="banner_<?php $banner->place->id;?>">
  <?php switch ($banner->type) : 
    case "image": 
      echo HTML::anchor($banner->url, HTML::image(Banners::getPath(), array('alt' => $banner->title)));
    break;
    case "swf":
      ?>
      <object width="<?php echo $banner->place->width; ?>" height="<?php echo $banner->place->height; ?>">
        <param name="quality" value="high" />
        <param name="src" value="<?php echo Banners::getPath().$banner->filename; ?>" />
        <embed type="application/x-shockwave-flash" width="<?php echo $banner->place->width; ?>" height="<?php echo $banner->place->height; ?>" src="<?php echo Banners::getPath().$banner->filename; ?>" quality="high">
        </embed>
      </object>
      <?
    break;
    default:
    case "text":
      echo $banner->text;
    break; 
  endswitch; ?>
</div>