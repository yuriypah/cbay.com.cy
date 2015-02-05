<div id="sub-sub-menu">
    <div class="wrapper">
        <ul>
            <li class="<?php echo $current == 'active' ? 'current' : '' ?>">
                <?php echo HTML::anchor('profile', __('profile_page.label.activated') . ($counts['active'] > 0 ? " (" . $counts['active'] . ")" : '')); ?>
            </li>
            <li class="separator"></li>
            <li class="<?php echo  $current == 'ended' ? 'current' : '' ?>">
                <?php echo HTML::anchor('profile/ended', __('profile_page.label.ended') . ($counts['ended'] > 0 ? " (" . $counts['ended'] . ")" : '')); ?>
            </li>
            <li class="separator"></li>
            <li class="<?php echo  $current == 'blocked' ? 'current' : '' ?>">
                <?php echo HTML::anchor('profile/blocked', __('profile_page.label.blocked') . ($counts['blocked'] > 0 ? " (" . $counts['blocked'] . ")" : '')); ?>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
</div>