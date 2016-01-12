<style>
    li {
        list-style: none;
    }

    #left-menu > ul > li {
        margin-bottom: 0px !important;
        padding: 5px;
        width: 100%;
    }

    .items li {
        width: 100%;
        padding: 5px;
        margin-left: -5px !important;
        margin-bottom: 0px !important;

    }

    li.active {
        background: #2E8BAE;

    }

    li.active a {
        text-decoration: none;
        color: white;
    }

</style>

<div class="content-styled" id="left-menu">
    <ul>
        <li class="<?php echo $_SERVER['REQUEST_URI'] == "/about" ? "active" : "" ?>">
            <a href="<?= URL::site(); ?>about"><?= __('about.index.link') ?></a>
        </li>
        <li>

            <ul class="items">
                <li class="<?php echo $_SERVER['REQUEST_URI'] == "/about/refund" ? "active" : "" ?>"><a
                        href="<?= URL::site(); ?>about/refund"><?= __('about.refund.link') ?>
                        </a></li>
                <li class="<?php echo $_SERVER['REQUEST_URI'] == "/about/terms" ? "active" : "" ?>"><a
                        href="<?= URL::site(); ?>about/terms"><?= __('about.terms.link') ?></a>
                </li>
                <li class="<?php echo $_SERVER['REQUEST_URI'] == "/about/privacy" ? "active" : "" ?>"><a
                        href="<?= URL::site(); ?>about/privacy"><?= __('about.privacy.link') ?></a>
                </li>
                <li class="<?php echo $_SERVER['REQUEST_URI'] == "/about/contacts" ? "active" : "" ?>"><a
                        href="<?= URL::site(); ?>about/contacts"><?= __('about.contacts.link') ?></a></li>
            </ul>
        </li>
        <!--
		<li>
			<span><?= __('about.label.causes_of_blocking') ?></span>
			<ul>
				<li><a href="<?= URL::site(); ?>about/main_reason_for_blocking"><?= __('about.label.main_reason_for_blocking') ?></a></li>
				<li><a href="<?= URL::site(); ?>about/prohibited_goods_list"><?= __('about.label.prohibited_goods_list') ?></a></li>
			</ul>
		</li>
		<li>
			<span><?= __('about.label.registration') ?></span>
			<ul>
				<li><a href="<?= URL::site(); ?>about/is_registration_necessary"><?= __('about.label.is_registration_necessary') ?></a></li>
				<li><a href="<?= URL::site(); ?>about/how_to_register"><?= __('about.label.how_to_register') ?></a></li>
				<li><a href="<?= URL::site(); ?>about/how_change_personal_info"><?= __('about.label.how_change_personal_info') ?></a></li>
				<li><a href="<?= URL::site(); ?>about/registered_users_rights"><?= __('about.label.registered_users_rights') ?></a></li>
				<li><a href="<?= URL::site(); ?>about/unregistered_users_rights"><?= __('about.label.unregistered_users_rights') ?></a></li>
				<li><a href="<?= URL::site(); ?>about/unregistered_users_rights"><?= __('about.label.unregistered_users_rights') ?></a></li>
			</ul>
		</li>-->
    </ul>
</div>
