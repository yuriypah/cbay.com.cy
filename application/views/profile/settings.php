<div class="form-horizontal user-settings-page">

    <?php
    echo View::factory('profile/settings/personal', array(
        'user' => $user
    ));

    /*echo View::factory('profile/settings/data', array(
        'count_adverts' => $count_adverts, 'user' => $user
    ));*/
    echo View::factory('profile/settings/contacts', array(
        'user' => $user
    ));

    echo View::factory('profile/settings/password', array(
        'user' => $user
    ));
    echo View::factory('profile/settings/messages', array(
        'user' => $user
    ));
    echo View::factory('profile/settings/delete', array(
        'user' => $user
    ));
    ?>

</div>
<script>
    $(".form-title").click(function () {
        //$('.showed').find(".accordion").slideUp();
        $(this).parents('.accordion_block').find(".accordion").slideToggle();
        //$(this).parents('.accordion_block').addClass('showed');
    });
    switch (window.location.hash) {
        case '#profile_name':
            $('.accordion').hide();
            $('.accordion.contacts').show();
            break;
    }
</script>