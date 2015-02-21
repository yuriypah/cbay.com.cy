<?php
defined('SYSPATH') or die ('No direct access allowed.');

$map = array(
    'label' => __('Index'),
    'pages' => array(
        array(
            'label' => __('menu.label.index'),
            'visible' => FALSE
        ),
        array(
            'label' => __('menu.label.error'),
            'route' => 'error',
            'visible' => FALSE
        ),
        array(
            'label' => __('menu.label.about'),
            'controller' => 'about',
            'visible' => FALSE
        ),
        array(
            'label' => __('menu.label.advert_place'),
            'controller' => 'advert',
            'action' => 'place',
            'pages' => array(
                array(
                    'label' => __('menu.label.advert_confirm'),
                    'controller' => 'advert',
                    'action' => 'confirm',
                    'visible' => FALSE
                ),
                array(
                    'label' => __('menu.label.advert_finish'),
                    'controller' => 'advert',
                    'action' => 'finish',
                    'visible' => FALSE
                ),
                array(
                    'label' => __('menu.label.advert_update'),
                    'controller' => 'advert',
                    'action' => 'update',
                    'visible' => FALSE
                )
            )
        ),
        array(
            'label' => __('menu.label.adverts'),
            'controller' => 'adverts',
            'pages' => array(
                array(
                    'label' => __('menu.label.advert_view'),
                    'route' => 'advert_view',
                    'visible' => FALSE
                ),
                array(
                    'label' => __('menu.label.advert_edit'),
                    'controller' => 'advert',
                    'action' => 'edit',
                    'roles' => array(
                        'login'
                    ),
                    'template' => 'advert/place',
                    'visible' => FALSE
                ),
                array(
                    'label' => __('menu.label.publish'),
                    'controller' => 'adverts',
                    'action' => 'publish',
                    'roles' => array(
                        'login'
                    ),
                    'visible' => FALSE
                ),
                array(
                    'label' => __('menu.label.unpublish'),
                    'controller' => 'adverts',
                    'action' => 'unpublish',
                    'roles' => array(
                        'login'
                    ),
                    'visible' => FALSE
                )
            )
        ),
        array(
            'label' => __('menu.label.categories'),
            'controller' => 'categories',
            'visible' => FALSE
        ),
        array(
            'label' => __('menu.label.bookmarks'),
            'controller' => 'bookmarks'
        ),
        array(
            'label' => __('menu.label.help'),
            'controller' => 'help',
            'pages' => array(
                array(
                    'label' => __('help.label.rules_of_submission'),
                    'controller' => 'help',
                    'action' => 'rules_of_submission'
                ),
                array(
                    'label' => __('help.label.main_reason_for_blocking'),
                    'controller' => 'help',
                    'action' => 'main_reason_for_blocking'
                ),
                array(
                    'label' => __('help.label.prohibited_goods_list'),
                    'controller' => 'help',
                    'action' => 'prohibited_goods_list'
                ),
                array(
                    'label' => __('help.label.is_registration_necessary'),
                    'controller' => 'help',
                    'action' => 'is_registration_necessary'
                ),
                array(
                    'label' => __('help.label.how_to_register'),
                    'controller' => 'help',
                    'action' => 'how_to_register'
                ),
                array(
                    'label' => __('help.label.how_change_personal_info'),
                    'controller' => 'help',
                    'action' => 'how_change_personal_info'
                ),
                array(
                    'label' => __('help.label.registered_users_rights'),
                    'controller' => 'help',
                    'action' => 'registered_users_rights'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'unregistered_users_rights'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'registration_on_site'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'publication_adverts'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'making_headlines'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'formation_cost'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'individuals_legal'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'search_description'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'give_references'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'posting_photos'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'edit_ad'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'ads_moderating'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'additional_services'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'user_agreement'
                ),
                array(
                    'label' => __('help.label.unregistered_users_rights'),
                    'controller' => 'help',
                    'action' => 'feedback'
                )
            )
        ),

        array(
            'label' => __('menu.label.packages'),
            'controller' => 'packages',
            'roles' => array(
                'login'
            ),
            'visible' => FALSE,
            'pages' => array(
                array(
                    'label' => __('menu.label.packages_pay'),
                    'controller' => 'packages',
                    'action' => 'pay',
                    'roles' => array(
                        'login'
                    )
                )
            )
        ),

        array(
            'label' => __('menu.label.profile.index'),
            'route' => 'profile',
            'roles' => array(
                'login'
            ),
            'pages' => array(
                array(
                    'label' => __('menu.label.profile.adverts'),
                    'controller' => 'profile'
                ),
                array(
                    'label' => __('menu.label.profile.adverts'),
                    'controller' => 'profile',
                    'action' => 'ended',
                    'visible' => FALSE
                ),
                array(
                    'label' => __('menu.label.profile.adverts'),
                    'controller' => 'profile',
                    'action' => 'blocked',
                    'visible' => FALSE
                ),
                array(
                    'label' => __('menu.label.profile.wallet'),
                    'controller' => 'wallet'
                ),
                array(
                    'label' => __('menu.label.messages.index'),
                    'controller' => 'messages',
                    'pages' => array(
                        array(
                            'label' => __('menu.label.messages.delete'),
                            'controller' => 'messages',
                            'action' => 'delete',
                            'visible' => FALSE
                        ),
                        array(
                            'label' => __('menu.label.messages.view'),
                            'controller' => 'messages',
                            'action' => 'view',
                            'visible' => FALSE
                        ),
                        array(
                            'label' => __('menu.label.messages.index'),
                            'controller' => 'messages',
                            'action' => 'inbox',
                            'visible' => FALSE
                        ),
                        array(
                            'label' => __('menu.label.messages.index'),
                            'controller' => 'messages',
                            'action' => 'drafts',
                            'visible' => FALSE
                        ),
                        array(
                            'label' => __('menu.label.messages.view'),
                            'controller' => 'messages',
                            'action' => 'inboxview',
                            'visible' => FALSE
                        )
                    )
                ),
                array(
                    'label' => __('menu.label.profile.settings'),
                    'controller' => 'profile',
                    'action' => 'settings',
                    'separator' => TRUE,
                    'pages' => array(
                        array(
                            'label' => __('menu.label.profile.email_change'),
                            'controller' => 'profile',
                            'action' => 'changeemail',
                            'visible' => FALSE
                        ),
                        array(

                            'controller' => 'profile',
                            'action' => 'changeprofiletype',
                            'visible' => FALSE
                        ),
                        array(
                            'label' => __('menu.label.profile.delete'),
                            'controller' => 'profile',
                            'action' => 'delete',
                            'visible' => FALSE
                        )
                    )
                ),
                array(
                    'label' => __('menu.label.logout'),
                    'route' => 'user',
                    'action' => 'logout',
                    'visible' => FALSE,
                    'auto_render' => FALSE
                )
            )
        ),
        array(
            'label' => __('menu.label.login'),
            'route' => 'user',
            'action' => 'login',
            'visible' => FALSE
        ),
        array(
            'label' => __('menu.label.register'),
            'route' => 'user',
            'action' => 'register',
            'visible' => FALSE
        ),
        array(
            'label' => __('menu.label.forgot'),
            'route' => 'user',
            'action' => 'forgot',
            'visible' => FALSE
        ),

        array(
            'label' => __('menu.label.backend.admin'),
            'route' => 'backend',
            'controller' => 'settings',
            'roles' => array(
                'admin'
            ),
            'pages' => array(
                array(
                    'label' => __('menu.label.backend.settings'),
                    'route' => 'backend',
                    'controller' => 'settings'
                ),
                array(
                    'label' => __('menu.label.backend.translate_settings'),
                    'route' => 'backend',
                    'controller' => 'settings',
                    'action' => 'translate'
                ),
                array(
                    'label' => 'Сортировать опции',
                    'route' => 'backend',
                    'controller' => 'settings',
                    'action' => 'sortoptions'
                ),
                /*array (
                        'label' => __ ( 'menu.label.backend.plugins' ),
                        'route' => 'backend',
                        'controller' => 'plugins',
                        'pages' => array (
                                array (
                                        'label' => 'Настройки',
                                        'route' => 'backend',
                                        'controller' => 'plugins',
                                        'action' => 'settings',
                                        'visible' => FALSE
                                )
                        )
                ),*/
                array(
                    'label' => __('menu.label.backend.adverts'),
                    'route' => 'backend',
                    'controller' => 'adverts',
                    'pages' => array(
                        array(
                            'label' => __('menu.label.backend.adverts'),
                            'route' => 'backend',
                            'controller' => 'adverts',
                            'action' => 'enabled'
                        ),
                        array(
                            'label' => __('menu.label.backend.adverts'),
                            'route' => 'backend',
                            'controller' => 'adverts',
                            'action' => 'blocked'
                        )
                    )
                ),
                array(
                    'label' => __('menu.label.backend.categories.index'),
                    'route' => 'backend',
                    'controller' => 'categories',
                    'pages' => array(
                        array(
                            'label' => __('menu.label.backend.categories.add'),
                            'route' => 'backend',
                            'controller' => 'categories',
                            'action' => 'add',
                            'pages' => array(
                                array(
                                    'label' => __('menu.label.backend.categories.edit'),
                                    'route' => 'backend',
                                    'controller' => 'categories',
                                    'action' => 'edit',
                                    'visible' => FALSE
                                )
                            )
                        )
                    )
                ),
                array(
                    'label' => __('menu.label.backend.users.index'),
                    'route' => 'backend',
                    'controller' => 'users',
                    'pages' => array(
                        array(
                            'label' => __('menu.label.backend.users.view'),
                            'route' => 'backend',
                            'controller' => 'users',
                            'action' => 'view',
                            'visible' => FALSE
                        )
                    )
                ),
                array(
                    'label' => __('menu.label.backend.options.index'),
                    'route' => 'backend',
                    'controller' => 'options',
                    'visible' => FALSE,
                    'pages' => array(
                        array(
                            'label' => __('menu.label.backend.options.add'),
                            'route' => 'backend',
                            'controller' => 'options',
                            'action' => 'add',
                            'visible' => FALSE
                        ),
                        array(
                            'label' => __('menu.label.backend.options.edit'),
                            'route' => 'backend',
                            'controller' => 'options',
                            'action' => 'edit',
                            'visible' => FALSE
                        )
                    )
                ),
                array(
                    'label' => __('menu.label.backend.search.index'),
                    'route' => 'backend',
                    'controller' => 'search',
                    'pages' => array(
                        array(
                            'label' => __('menu.label.backend.search.indexer'),
                            'route' => 'backend',
                            'controller' => 'search',
                            'action' => 'indexer',
                            'auto_render' => FALSE
                        )
                    )
                ),
                /*array (
                        'label' => __ ( 'menu.label.sitemap' ),
                        'controller' => 'generatesitemap',
                        'pages' => array (
                                array (
                                        'label' => __ ( 'menu.label.sitemap' ),
                                        'controller' => 'generatesitemap',
                                        'action' => 'index'
                                )
                        )
                ),*/
                array(

                    // 'controller' => 'paypal',
                    'pages' => array(
                        array(
                            'controller' => 'paypal',
                            'action' => 'success',
                            'auto_render' => FALSE
                        ),
                        array(
                            'controller' => 'paypal',
                            'action' => 'notify',
                            'auto_render' => FALSE
                        ),
                        array(
                            'controller' => 'paypal',
                            'action' => 'cancel',
                            'auto_render' => FALSE
                        )
                    )
                )
            )
        )
    )
);
return array(
    $map
);
