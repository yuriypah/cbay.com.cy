/**
 * Created by George on 29.09.2015.
 */
define([
    'marionette',
    'jquery.fancybox'
], function (Marionette) {
    "use strict";
    var app = new Marionette.Application();
    app.searchParams = {};
    app.order = {};
    app.currency = 'eur';
    app.on("start", function () {
        $.get('/check', function (data) {
            app.isAuth = data.status;
            app.user = data.userData;
            require(["bootstrap"]);
            require(['page']);
            require(['user']);
        });
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6&appId=205933253138876";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '205933253138876',
                xfbml      : true,
                version    : 'v2.6'
            });
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
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
                }
            });
            FB.Event.subscribe('auth.statusChange',  function(response){
                FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
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
                    }
                });
            });
        };



        $.get('/get_currency', function (data) {
            if (typeof data.currency != 'undefined') {
                app.currency = data.currency;
            }
        })
    });

    app._ = function (key) {
        var keys = {
            "user.login.incorrectEmailOrPwd": "Incorrect email or password",
            "user.login.emptyName": "Please enter your name",
            "user.login.emptyEmail": "Please enter your email address",
            "user.login.emptyPwd": "Please enter password",
            "user.login.wrongEmail": "Incorrect email",
            "user.login.registerError": "Registration is failed. Please update page and try again",
            "user.login.pwdNotEquals": "Password and confrim password isn`t match",
            "user.login.pwdWrongLength": "Password length must be from 6 to 12 symbols",
            "user.login.wrongPhone": "Incorrect phone number",
            "user.login.existEmail": "This email address already registered",
            "order.errorDates": "Wrong dates. Please select correct dates and try again",
            "order.confirmation.header": "Confirmation order"
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