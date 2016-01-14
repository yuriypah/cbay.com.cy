/**
 * Created by George on 28.12.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/user/templates/login.html',
    'user'
], function (app, backbone, marionette, $, template) {
    "use strict";
    return marionette.ItemView.extend({
        template: template,
        ui: {
            'login': '.login-submit',
            'errorContainer': '.error',
            'email': '.email',
            'pass': '.pass'
        },
        events: {
            'click @ui.login': 'login',
            'focus @ui.email, @ui.pass': 'clearAlerts'
        },
        clearAlerts: function () {
            this.ui.errorContainer.empty();
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