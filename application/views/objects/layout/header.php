<? if($data['indexpage']) :?>
<a href="/"><img src="/<?php echo $resources_path; ?>images/logo_big.png" id="logo" /></a>
<? else: ?>
<a href="/"><img src="/<?php echo $resources_path; ?>images/logo.png" id="logo" /></a>
<? endif; ?>
<div id="logo_text"><?php echo __( 'layout.text.logo_text' ); ?></div>

<div id="buttons">

	<a href="/advert/place" class="nav-button green first last"><?php echo __( 'menu.label.advert_place' ); ?></a>

<?php if ( !$ctx->auth->logged_in() ): ?>
<?php echo HTML::anchor('register', __( 'menu.label.register' ), array(
	'class' => 'nav-button blue first sep'
)); ?>
<?php echo HTML::anchor('login', __( 'menu.label.login' ), array(
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
if($data['messages'] > 0): ?>

  <?php echo "<a href='/messages' class='nav-button blue sep' style='margin-left:-3px'>".$data['messages']." ".HTML::declination($data['messages'],array(
                    		__('menu.label.messages.count.one'),
                    		__('menu.label.messages.count.few'),
                    		__('menu.label.messages.count.many')
                    ))."</a>"; ?>
<?php
/* echo HTML::anchor('messages', ___('menu.label.messages.count.one', $data['messages'], array(
			':count' => $data['messages']
		)), array(
		'class' => 'button blue sep'
));*/ ?>
<?php endif; ?>
<?php echo HTML::anchor('logout', __( 'menu.label.logout' ), array(
	'class' => 'nav-button blue last logout-link'
)); ?>
<?php endif; ?>
</div>

<?php if ( Model_Lang_Part::count() > 1 ): ?>
	<div id="langs">
		<?php
		foreach ( Model_Lang_Part::$languages as $lang => $name )
			echo HTML::anchor( $request->url() . '?lang=' . $lang, HTML::image( $resources_path . 'images/lang-' . $lang . '.png' ), array('class'=>($lang == I18n::lang())?'current':'') );
		?>
	</div>
<?php endif; ?>