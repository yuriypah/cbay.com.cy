/**
 * Created by George on 29.09.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'bootstrapDatepicker',
    'text!modules/page/templates/header.html',
    'modules/user/views/login',
    'modules/user/views/register'
], function (app, backbone, marionette, $, bootstrapDatepicker, tpl, loginView, registerView) {
    "use strict";

    return marionette.ItemView.extend({
        template: tpl,
        ui: {
            'calendar': '.calendar',
            'timer': '.timer',
            'searchPanel': '.search-panel-container',
            'advanced_search_block': '.advanced_search',
            'advanced_search_holder': '.advanced-link',
            'loginHolder': '.login',
            'logoutHolder': '.logout',
            'registerHolder': '.register'
        },
        events: {
            'click @ui.advanced_search_holder': 'showAdvanced',
            'click @ui.loginHolder': 'login',
            'click @ui.logoutHolder': 'logout',
            'click @ui.registerHolder': 'register'
        },
        register: function () {
            app.vent.trigger("Popup", true, registerView, 'view');
        },
        login: function () {
            app.vent.trigger("Popup", true, loginView, 'view');

        },
        logout: function (e) {
            e.preventDefault();
            $.ajax({
                url: '/auth',
                type : 'post',
                beforeSend: function () {
                    app.vent.trigger('Loading', true);
                },
                data: {'action': 'logout'}
            }).done(function () {
                app.vent.trigger('Loading', false);
                app.isAuth = 0;
                app.vent.trigger('Page:renderHeader');
            });


        },
        showAdvanced: function (e) {
            e.preventDefault();
            this.ui.advanced_search_block.slideToggle(300, function () {
                if ($(e.currentTarget).find('.glyphicon').hasClass('glyphicon-menu-down')) {
                    $(e.currentTarget).find('.glyphicon').removeClass('glyphicon-menu-down').addClass('glyphicon-menu-up');
                } else {
                    $(e.currentTarget).find('.glyphicon').removeClass('glyphicon-menu-up').addClass('glyphicon-menu-down');
                }
            });

        },
        onShow: function () {
            /* this.ui.searchPanel.affix({
             offset: {
             top: 200
             }
             })*/
            this.ui.calendar.datetimepicker({
                locale: 'en',
                format: 'DD.MM.YYYY',
                showClear: true,
                showClose: true

            });
            this.ui.timer.datetimepicker({
                locale: 'en',
                format: 'hh:mm',
                showClear: true,
                showClose: true
            });

        }
    })
});