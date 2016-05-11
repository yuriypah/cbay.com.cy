<? if ($data['indexpage']) : ?>
    <a href="/"><img src="/<?php echo $resources_path; ?>images/logo4.png" id="logo"/></a>
<? else: ?>
    <a href="/"><img src="/<?php echo $resources_path; ?>images/logo4.png" id="logo"/></a>
<? endif; ?>
    <div id="logo_text"><?php echo __('layout.text.logo_text'); ?></div>
    <style>
        #buttons .nav_b a {
            display: inline-block;
            font-weight: bold;
            font-size: 10px;
            color: #fff;
            background-repeat: repeat-x;
            line-height: 21px;
            padding: 0 5px 5px;
            text-transform: uppercase;
            text-decoration: none;
            position: relative;

        }

        #buttons .nav_b a:hover {
            color: #fffd6d;
        }

        .nav_b {
            height: 21px;
            vertical-align: top;
            white-space: nowrap;
            display: inline-block;
            padding: 0;
            margin: 0;
            margin-left: -4px;
        }

        .sep1 {
            background: url(/resources/images/dops/sep1.png);
            height: 21px;
            width: 10px;

        }

        .sep2 {
            background: url(/resources/images/dops/sep2.png);
            height: 21px;
            width: 11px;
        }

        .sep3 {
            background: url(/resources/images/dops/sep3.png);
            height: 21px;
            width: 11px;
        }

        .sep4 {
            background: url(/resources/images/dops/sep4.png);
            height: 21px;
            width: 9px;
        }

        .link1 {
            background: url(/resources/images/dops/green.png) 0 0 repeat-x;
        }

        .link2 {
            background: url(/resources/images/dops/blue.png) 0 0 repeat-x;
        }

        .link3 {
            background: url(/resources/images/dops/blue.png) 0 0 repeat-x;
        }
    </style>
    <div id="buttons">
        <div class="nav_b sep1"></div>
        <!--------->
        <div class="nav_b link1"><a href="#">
                <?php echo "<a href='/advert/place'><span style='opacity: 0.6;margin-left: -9px;vertical-align: -4px' class='icon icon-plus'></span> " . __('menu.label.advert_place') . "</a>"; ?>
            </a></div>
        <div class="nav_b sep2"></div>

        <!--------->
        <div class="nav_b link2">
            <?php
            if (!$ctx->auth->logged_in()) {
                echo "<a href='/register'>" . __('menu.label.register') . "</a>";
            } else {
                echo "<a href='/profile'>" . ___('menu.label.user', array(
                        ':name' => $ctx->user->profile->name
                    )) . "</a>";
            }
            ?>
        </div>

        <div class="nav_b sep3"></div>
        <!--------->
        <?php
        if ($ctx->auth->logged_in() && $data['messages'] > 0) {
            ?>
            <div class="nav_b link2"><a href="/messages">
                    <?php echo $data['messages'] . " " . HTML::declination($data['messages'], array(
                            __('menu.label.messages.count.one'),
                            __('menu.label.messages.count.few'),
                            __('menu.label.messages.count.many')
                        ));
                    ?>
                </a></div>
            <div class="nav_b sep3"></div>
        <?
        }

        if ($ctx->auth->logged_in()) {
           // echo "<div class='nav_b link2'><a href='/wallet'>". $ctx->user->amount . " €</a></div><div class='nav_b sep3'></div>";
        }


        ?>

        <div class="nav_b link3">
            <?php
            if (!$ctx->auth->logged_in()) {
                echo "<a href='/login'>" . __('menu.label.login') . "</a>";
            } else {
                echo "<a href='/logout'>" . __('menu.label.logout') . "</a>";
            }
            ?>
            </a></div>
        <div class="nav_b sep4"></div>
        <!--
	<a href="/advert/place" class="nav-button green first last"><?php echo __('menu.label.advert_place'); ?></a>

<?php if (!$ctx->auth->logged_in()): ?>
<?php echo HTML::anchor('register', __('menu.label.register'), array(
            'class' => 'nav-button blue first sep'
        )); ?>
<?php echo HTML::anchor('login', __('menu.label.login'), array(
            'class' => 'nav-button blue last'
        )); ?>
<?php else: ?>
<?php echo HTML::anchor('profile', ___('menu.label.user', array(
            ':name' => $ctx->user->profile->name
        )), array(
            'class' => 'nav-button blue first sep fname'
        )); ?>
    <script>
        $(function() {
            if($(".fname").text().length > 11) {
                var fname = $(".fname").text().split(""), new_fname = '';
                for(var i in fname) {
                    if(i <=5) {
                        new_fname += fname[i];
                    }
                }
                $(".fname").text(new_fname + "...");
            }
        });
    </script>
<?php
            if ($data['messages'] > 0): ?>

  <?php echo "<a href='/messages' class='nav-button blue sep' style='margin-left:-3px'>" . $data['messages'] . " " . HTML::declination($data['messages'], array(
                    __('menu.label.messages.count.one'),
                    __('menu.label.messages.count.few'),
                    __('menu.label.messages.count.many')
                )) . "</a>"; ?>
<?php
                /* echo HTML::anchor('messages', ___('menu.label.messages.count.one', $data['messages'], array(
                            ':count' => $data['messages']
                        )), array(
                        'class' => 'button blue sep'
                ));*/
                ?>
<?php endif; ?>
<?php echo HTML::anchor('logout', __('menu.label.logout'), array(
                'class' => 'nav-button blue last logout-link'
            )); ?>
<?php endif; ?>
    -->
    </div>

<?php if (Model_Lang_Part::count() > 1): ?>
    <div id="langs">
        <?php
        foreach (Model_Lang_Part::$languages as $lang => $name)
            echo HTML::anchor($request->url() . '?lang=' . $lang, HTML::image($resources_path . 'images/lang-' . $lang . '.png'), array('class' => ($lang == I18n::lang()) ? 'current' : ''));
        ?>
    </div>

<?php endif; ?>
<script type="text/javascript">
    var $DATA = JSON.parse('<?php echo file_get_contents('resources/js/tree.js') ?>')
</script>
