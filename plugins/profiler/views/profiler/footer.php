<?php if(Kohana::$profiling):?>
	<div id="kohana-profiler"><?php echo View::factory('profiler/stats') ?></div>
<?php endif; ?> 