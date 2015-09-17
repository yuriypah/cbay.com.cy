<?php echo HTML::doctype('html5'); ?>
<html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $ctx->page->meta_title; ?></title>
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="<?php echo $ctx->page->meta_keywords ?>" />
        <meta name="description" content="<?php echo $ctx->page->meta_description ?>" />

        <link rel="icon" href="/favicon.png" type="image/x-icon" />

        <script type="text/javascript">
            var resources_path = "/<?php echo $resources_path; ?>";
            var directory = "<?php echo Request::current()->directory(); ?>";
            var controller = "<?php echo Request::current()->controller(); ?>";
            var action = "<?php echo Request::current()->action(); ?>";
            var cat_options;
        </script>
        <?php
        foreach ($styles as $style) {
            echo "\t" . Html::style($resources_path . $style) . "\n";
        }
        foreach ($scripts as $script) {
            echo "\t" . Html::script($resources_path . $script) . "\n";
        }
        ?>

        <script type="text/javascript">
            $(document).ready(function(){
            $('#slogan').gradientText({
            colors: ['#65a7e2', '#a9b939', '#3992b9', '#699e39']
            });
            });
        </script>
        <?php Observer::notify('page_layout_head'); ?>

    </head>
    <body id="body_index">

        <div id="water_bg">
            <div id="content" class="wrapper">
                <?php Block::run('header_block'); ?>

                <div id="slogan"><?php  echo __('index_page.text.slogan'); ?></div>
                <div id="tags"><?php echo __('index_page.text.tags'); ?></div>
                <div class="digital-nums">
                    <div class="nums"><?php if ($adverts_count < 100): ?>00<?php endif; ?><?php echo $adverts_count; ?></div>
                    <?php echo HTML::declination($adverts_count,array(
                    		__('index_page.text.ads_counter.0'),
                    		__('index_page.text.ads_counter.1'),
                    		__('index_page.text.ads_counter.2')
                    )); ?>

                    <div class="clear"></div>
                </div>

                <div id="lands-points">
                    <?php foreach (Model_Map::$cities as $id => $city): ?>
                        <div id="point-<?php echo $city->key(); ?>" class="point">
                            <a href="/adverts/?l=<?php echo $id; ?>">
                                <?php echo HTML::image($resources_path . 'images/map-pointer.png'); ?>
                                <span><?php echo $city->name(); ?></span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <ul id="lands-list">
                    <li class="land-main-icon">
                        <a href="/adverts/?q=&c=0&l=0" data-id="all">
                            <img src="/resources/images/land/cyprus.png"><?php echo __('map.label.all_adverts'); ?>
                        </a>
                    </li>
                    <?php foreach (Model_Map::$cities as $id => $city): ?>
                        <li>
                            <a href="/adverts/?l=<?php echo $id; ?>" data-id="<?php echo $city->key(); ?>">
                                <?php echo $city->icon() . $city->name(); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <?php
                echo HTML::image($resources_path . 'images/island/0.png', array(
                    'id' => 'island', 'usemap' => '#islandmap'
                ));
                ?>

                <map id="islandmap-cont" name="islandmap">
                    <?php foreach (Model_Map::$cities as $id => $city): ?>
                        <?php if (!empty($city->coords)): ?>
                            <area id="islandmap_<?php echo $city->key(); ?>" shape="poly" href="/adverts/?l=<?php echo $id; ?>" coords="<?php echo $city->coords; ?>" />
                        <?php endif; ?>
                    <?php endforeach; ?>
                </map>
            </div>
            <div id="footer-index" class="footer">
                <p class="text"><?php echo __('index_page.text.footer'); ?></p>
                <?php Block::run('footer_block'); ?>
            </div>
        </div>
    </body>
</html>