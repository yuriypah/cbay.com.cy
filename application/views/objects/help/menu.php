<style>
    li {
        list-style: none;
    }
    #left-menu > ul > li {
        margin-bottom:0px !important;
        padding:5px;
        width:100%;
    }

    .items li {
        width:100%;
        padding:5px;
        margin-left:-5px !important;
     margin-bottom:0px !important;

    }
    li.active {
        background:#2E8BAE;

    }
    li.active a {
        text-decoration: none;
        color:white;
    }

</style>

<div class="content-styled" id="left-menu">
	<ul>
		<li  class="<?php echo $_SERVER['REQUEST_URI'] == "/help" ? "active" : "" ?>">
			<a href="<?= URL::site(); ?>help"><?= __( 'help.index.link' )?></a>
		</li>
		<li>

			<ul class="items">
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/registration_on_site" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/registration_on_site"><?= __( 'help.registration_on_site.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/publication_adverts" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/publication_adverts"><?= __( 'help.publication_adverts.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/making_headlines" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/making_headlines"><?= __( 'help.making_headlines.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/formation_cost" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/formation_cost"><?= __( 'help.formation_cost.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/individuals_legal" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/individuals_legal"><?= __( 'help.individuals_legal.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/search_description" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/search_description"><?= __( 'help.search_description.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/give_references" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/give_references"><?= __( 'help.give_references.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/posting_photos" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/posting_photos"><?= __( 'help.posting_photos.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/edit_ad" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/edit_ad"><?= __( 'help.edit_ad.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/ads_moderating" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/ads_moderating"><?= __( 'help.ads_moderating.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/additional_services" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/additional_services"><?= __( 'help.additional_services.link' )?></a></li>
				<li class="<?php echo $_SERVER['REQUEST_URI'] == "/help/user_agreement" ? "active" : "" ?>"><a href="<?= URL::site(); ?>help/user_agreement"><?= __( 'help.user_agreement.link' )?></a></li>
                                <li><a href="<?= URL::site(); ?>help/feedback"><?= __( 'help.feedback.link' )?></a></li>
			</ul>
		</li>
<!--
		<li>
			<span><?= __( 'help.label.causes_of_blocking' ) ?></span>
			<ul>
				<li><a href="<?= URL::site(); ?>help/main_reason_for_blocking"><?= __( 'help.label.main_reason_for_blocking' ) ?></a></li>
				<li><a href="<?= URL::site(); ?>help/prohibited_goods_list"><?= __( 'help.label.prohibited_goods_list' ) ?></a></li>
			</ul>
		</li>
		<li>
			<span><?= __( 'help.label.registration' ) ?></span>
			<ul>
				<li><a href="<?= URL::site(); ?>help/is_registration_necessary"><?= __( 'help.label.is_registration_necessary' ) ?></a></li>
				<li><a href="<?= URL::site(); ?>help/how_to_register"><?= __( 'help.label.how_to_register' ) ?></a></li>
				<li><a href="<?= URL::site(); ?>help/how_change_personal_info"><?= __( 'help.label.how_change_personal_info' ) ?></a></li>
				<li><a href="<?= URL::site(); ?>help/registered_users_rights"><?= __( 'help.label.registered_users_rights' ) ?></a></li>
				<li><a href="<?= URL::site(); ?>help/unregistered_users_rights"><?= __( 'help.label.unregistered_users_rights' ) ?></a></li>
				<li><a href="<?= URL::site(); ?>help/unregistered_users_rights"><?= __( 'help.label.unregistered_users_rights' ) ?></a></li>
			</ul>
		</li>-->
	</ul> 
</div>
