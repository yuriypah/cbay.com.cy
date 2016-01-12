define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/user/templates/register.html',
    'modules/user/models/user'
], function (app, backbone, marionette, $, template, userModel) {
    "use strict";
    return marionette.ItemView.extend({
        template: template,
        ui: {
            'errorContainer': '.error',
            'email': '.email',
            'phone': '.phone',
            'pwd': '.pwd',
            'cpwd': '.cpwd',
            'registerSubmit': '.register-submit'
        },
        events: {
            'click @ui.registerSubmit': 'register',
            'focus @ui.email, @ui.phone, @ui.pwd, @ui.cpwd': 'clearAlerts'
        },
        valid: function () {
            // previously preparation
            if (this.ui.email.val() == '') {
                this.ui.errorContainer.html("<div class='alert alert-danger'>" + app._('user.login.emptyEmail') + "</div>");
                return false;
            }
            if (this.ui.pwd.val() == '') {
                this.ui.errorContainer.html("<div class='alert alert-danger'>" + app._('user.login.emptyPwd') + "</div>");
                return false;
            }
            return true;
        },
        clearAlerts: function () {
            this.ui.errorContainer.empty();
        },
        register: function (e) {
            e.preventDefault();
            var self = this;
            if (this.valid()) {
                var user = new userModel();
                user.save({
                    email: this.ui.email.val(),
                    pwd: this.ui.pwd.val(),
                    cpwd: this.ui.cpwd.val(),
                    phone: this.ui.phone.val()
                }, {
                    wait: true,
                    success: function (model, response) {
                        if (response.saved == false) {
                            switch (response.errorName) {
                                case 'wrongEmail':
                                    self.ui.errorContainer.html("<div class='alert alert-danger'>" +
                                    app._('user.login.wrongEmail') + "</div>");
                                    break;
                                case 'pwdNotEquals':
                                    self.ui.errorContainer.html("<div class='alert alert-danger'>" +
                                    app._('user.login.pwdNotEquals') + "</div>");
                                    break;
                                case 'pwdWrongLength':
                                    self.ui.errorContainer.html("<div class='alert alert-danger'>" +
                                    app._('user.login.pwdWrongLength') + "</div>");
                                    break;
                                case 'wrongPhone':
                                    self.ui.errorContainer.html("<div class='alert alert-danger'>" +
                                    app._('user.login.wrongPhone') + "</div>");
                                    break;
                                case 'existEmail':
                                    self.ui.errorContainer.html("<div class='alert alert-danger'>" +
                                    app._('user.login.existEmail') + "</div>");
                                    break;
                            }
                        } else {
                            app.vent.trigger("Popup", false, {}); // close reg window
                        }
                    },
                    error: function (model, error) {
                        self.ui.errorContainer("<div class='alert alert-danger'>" +
                        app._('user.login.registerError') + "</div>")
                    }
                });
            }


        }
    });
});
