<link rel='stylesheet' type='text/css'
      href='/plugins/source/jquery.fancybox.css' />
<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<?php

if (count($adverts) >= 0): ?>

    <div id="adverts-panel">
        <?php
        foreach ($filter_types as $type) {
            $text = __('adverts_page.filter.' . $type);
            $params = array('class' => 'item');
            if (Input::get('f', 'all') == $type) {
                $params['class'] = 'item current';
            }
            echo HTML::anchor('adverts/' . URL::query(array('f' => $type)), $text, $params);
        }
        ?>
        <div class="sorting" style="margin-top:2px">
            <?php
            foreach ($sort_types as $type) {
                $text = __('adverts_page.filter.by_' . $type) . '';
                $params = array('class' => 'item');
                if (Input::get('s', 'date') == $type) {
                    $params['class'] = 'item current';
                }

              //  echo HTML::sort('adverts/', array('s' => $type), $text, $params);
            }
            ?>
            <a  class="">
                По цене: <input  type='button' data-type='price' class='btn btn-small asc <?=Input::get('s') == 'price' && Input::get('o') == 'asc' ? 'active' : '' ?>' value='Дешевле'/>
                <input  type='button' data-type='price' class='btn btn-small desc <?=Input::get('s') == 'price' && Input::get('o') == 'desc' ? 'active' : '' ?>' value='Дороже'/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a>
            <a  class="">
                По дате: <input  type='button' data-type='date' class='btn btn-small desc <?=Input::get('s') == 'date' && Input::get('o') == 'desc' ? 'active' : '' ?>' value='От новых к старым'/>
                <input  type='button' data-type='date' class='btn btn-small asc <?=Input::get('s') == 'date' && Input::get('o') == 'asc' ? 'active' : '' ?>' value='От старых к новым'/>
            </a>
        </div>
        <script>
            $(".sorting .item").click(function(e) {
                e.preventDefault();
            })
            $('.asc').click(function() {
                window.location.href = '/adverts/?s=' + $(this).data('type') + '&o=asc'
            });
            $('.desc').click(function() {
                window.location.href = '/adverts/?s=' + $(this).data('type') + '&o=desc'
            });

        </script>
        <div class="view-type">
            <?php
            foreach ($view_types as $type) {
                $image = HTML::image($resources_path . 'images/view-type-' . $type . '.png');
                $params = array('class' => 'item');
                if ($view_type == $type) {
                    $params['class'] = 'item current';
                }
                echo HTML::anchor('adverts/' . URL::query(array('v' => $type)), $image, $params);
            }
            ?>
        </div>
    </div>
    <?php if(count($adverts) == 0) { ?>
        <div class="hero-unit">
            <h1><?php echo __('adverts_page.empty.title'); ?></h1>
            <hr/>
            <div class="muse">
                <div class='muse_face clearfix'>
                </div>
                <p class="lead"><?php echo __('adverts_page.empty.what_is'); ?></p>
                <ul>
                    <li><?php echo __('adverts_page.empty.checkstring'); ?></li>
                    <li><?php echo __('adverts_page.empty.anotherwords'); ?></li>
                    <li><?php echo __('adverts_page.empty.anothertown'); ?></li>
                    <li><a href='/adverts'><?php echo __('adverts_page.empty.anotheradverse'); ?></a></li>
                </ul>
            </div>
        </div>
    <? } ?>
    <div id="adverts-box" <?= (count($vip_adverts) == 0) ? 'style="width:100%"' : '' ?>>
        <div id="adverts-list" class="type-<?php echo $view_type; ?>">
            <?php
            echo View::factory('adverts/list/' . URL::title($view_type, '_'), array(
                'adverts' => $adverts
            ));
            ?>

            <div class="clear"></div>
        </div>
    </div>
    <? if (count($vip_adverts) > 0) : ?>
        <div id="vip-conteiner">
            <div id="vip-header">
                <div
                    class="pull-left vip-link"><? echo HTML::anchor('packages', __('adverts_page.label.vip_header')) ?></div>
                <div class="pull-right"><img src="/resources/images/vip.png"></div>
            </div>
            <?php
            echo View::factory('adverts/list/vip', array(
                'adverts' => $vip_adverts
            ));
            ?>
            <div class="clear"></div>
        </div>
    <? endif; ?>
<?php else: ?>
    <div id="adverts-panel"></div>
    <div class="hero-unit">
        <h1><?php echo __('adverts_page.empty.title'); ?></h1>
        <hr/>
        <div class="muse">
            <div class='muse_face clearfix'>
            </div>
            <p class="lead"><?php echo __('adverts_page.empty.what_is'); ?></p>
            <ul>
                <li><?php echo __('adverts_page.empty.checkstring'); ?></li>
                <li><?php echo __('adverts_page.empty.anotherwords'); ?></li>
                <li><?php echo __('adverts_page.empty.anothertown'); ?></li>
                <li><a href='/adverts'><?php echo __('adverts_page.empty.anotheradverse'); ?></a></li>
            </ul>
        </div>
    </div>
<?php endif; ?>