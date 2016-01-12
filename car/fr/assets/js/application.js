/**
 * Created by George on 29.09.2015.
 */
define([
    'marionette',
    'jquery.fancybox'
], function (Marionette) {
    "use strict";
    var app = new Marionette.Application();
    app.on("start", function () {
        $.get('/check', function (data) {
            app.isAuth = data.status;
            require(["bootstrap"]);
            require(['page']);
        });
    });
    app._ = function (key) {
        var keys = {
            "user.login.incorrectEmailOrPwd": "Incorrect email or password",
            "user.login.emptyEmail": "Please enter your email address",
            "user.login.emptyPwd": "Please enter password",
            "user.login.wrongEmail": "Incorrect email",
            "user.login.registerError": "Registration is failed. Please update page and try again",
            "user.login.pwdNotEquals": "Password and confrim password isn`t match",
            "user.login.pwdWrongLength": "Password length must be from 6 to 12 symbols",
            "user.login.wrongPhone": "Incorrect phone number",
            "user.login.existEmail": "This email address already registered"
        };
        return keys[key];
    };
    app.vent.on({
        "Loading": function (flag) {
            return flag ? $.fancybox.showLoading() : $.fancybox.hideLoading();
        },
        "Popup": function (flag, data, type) {
            if (flag) {
                switch (type) {
                    case 'view' :

                        $.fancybox($('#popup'), {
                            beforeClose: function () {
                                app.page.layout.getRegion('popup').reset()
                            }
                        });
                        app.page.layout.getRegion('popup').show(new data());
                        break;
                    default:
                        $.fancybox(data, {
                            beforeClose: function () {
                                app.page.layout.getRegion('popup').reset()
                            }
                        })
                        break;
                }
            } else {
                app.page.layout.getRegion('popup').reset()
                $.fancybox.close();
            }
        }
    })
    return window.app = app;
});