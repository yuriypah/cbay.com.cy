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
    'text!modules/user/templates/login.html',
    'text!modules/user/templates/register.html'
], function (app, backbone, marionette, $, bootstrapDatepicker, tpl, loginTemplate, registerTemplate) {
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
            'registerHolder': '.register'
        },
        events: {
            'click @ui.advanced_search_holder': 'showAdvanced',
            'click @ui.loginHolder': 'login',
            'click @ui.registerHolder': 'register'
        },
        register: function () {
            app.vent.trigger("Popup", true, marionette.Renderer.render(registerTemplate, {}));
        },
        login: function () {
            app.vent.trigger("Popup", true, marionette.Renderer.render(loginTemplate, {}));
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