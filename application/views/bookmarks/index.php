<?php if ($total_bookmarks != 0): ?>
	<div id="container-content">
		<div id="bookmark-panel">
			<div class="pull-left form-inline">

				<label class="chkAll"><input type="checkbox" id="chkAll" name="check_all"><span><?php echo __('bookmarks.label.check_all'); ?></span></label>

				<button type="submit" class="btn btn-danger" id="delSelected"><?php echo __('bookmarks.label.delete_selected'); ?></button>
			</div>

			<div class="pull-right count-ads">

				<?php
                echo HTML::declination($total_bookmarks, array(
                    __('bookmarks.label.count.one', array(':count'=>$total_bookmarks)),
                    __('bookmarks.label.count.few', array(':count'=>$total_bookmarks)),
                    __('bookmarks.label.count.many', array(':count'=>$total_bookmarks))));
                ?>
			</div>

			<div class="clear"></div>
		</div>


		<div id="adverts-list" class="type-list-img with-checkbox">
			<?php
			echo View::factory('adverts/list/listimg', array(
				'adverts' => $adverts,
				'checkbox' => TRUE
			));
			?>
		</div>
	</div>
<?php else: ?>

		<div class="hero-unit">
			<h1><?php echo __('bookmarks.title'); ?></h1>
			<p><?php echo __('bookmarks.text.what_is'); ?></p>
		</div>

<?php endif; ?>
