/**
 * Created by George on 28.12.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/user/templates/login.html',
    'modules/user/views/forgotten',
    'user'
], function (app, backbone, marionette, $, template, forgottenView) {
    "use strict";
    return marionette.ItemView.extend({
        template: template,
        ui: {
            'login': '.login-submit',
            'errorContainer': '.error',
            'email': '.email',
            'pass': '.pass',
            'forgotten': '.forgotten-link',
            'fblink': '.fblink'
        },
        events: {
            'click @ui.login': 'login',
            'focus @ui.email, @ui.pass': 'clearAlerts',
            'click @ui.forgotten': 'forgotten',
            'click @ui.fblink': 'check_fb'
        },
        check_fb: function () {
            $.fancybox.showLoading();
            FB.login(function (response) {
                if (response.authResponse) {
                    FB.api('/me', function (response) {
                        app.isAuth = true;
                        app.user = {
                            id: response.id,
                            name: response.name
                        };
                        $.fancybox.close();
                        $.fancybox.hideLoading();
                        app.vent.trigger('Page:renderHeader');
                    });
                } else {

                }
            });
        },

        clearAlerts: function () {
            this.ui.errorContainer.empty();
        },
        forgotten: function (e) {
            e.preventDefault();
            app.vent.trigger("Popup", true, forgottenView, 'view');
        },
        login: function (e) {
            var self = this;
            e.preventDefault();
            app.User.login({
                email: this.ui.email.val(),
                pwd: this.ui.pass.val()
            }, function (err) {
                if (err) {
                    self.ui.errorContainer.html(err);
                }
            });

        }
    });
});