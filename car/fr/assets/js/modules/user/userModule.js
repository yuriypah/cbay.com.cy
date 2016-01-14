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
    app.module("User", function (User) {
        User.login = function (data, callback) {
            var self = this;
            $.ajax({
                url: '/auth',
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    app.vent.trigger('Loading', true);
                },
                data: {
                    action: 'login',
                    email: data.email,
                    pwd: data.pwd
                }
            }).done(function (data) {
                app.vent.trigger('Loading', false);
                var err = null;
                if (data.status == 1) {
                    app.vent.trigger("Popup", false);
                    app.isAuth = 1;
                    app.user = data.userData;
                    app.vent.trigger('Page:renderHeader');
                } else {
                    err = "<div class='alert alert-danger'>" + app._('user.login.incorrectEmailOrPwd') + "</div>"
                }
                if (typeof callback == 'function') {
                    callback.call(this, err);
                }
            });
        };
        User.logout = function() {
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
        };
    });
    app.User.start();
});