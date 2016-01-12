/**
 * Created by George on 28.12.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/user/templates/login.html'
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
            $.ajax({
                url: '/auth',
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    app.vent.trigger('Loading', true);
                },
                data: {
                    action: 'login',
                    email: this.ui.email.val(),
                    pwd: this.ui.pass.val()
                }
            }).done(function (data) {
                console.log(data)
                app.vent.trigger('Loading', false);
                if (data.status == 1) {
                    app.vent.trigger("Popup", false);
                    app.isAuth = 1;
                    app.vent.trigger('Page:renderHeader');
                } else {
                    self.ui.errorContainer.html("<div class='alert alert-danger'>" + app._('user.login.incorrectEmailOrPwd') + "</div>");
                }
            });
        }
    });
});