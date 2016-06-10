/**
 * Created by George on 28.12.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/user/templates/forgotten.html',
    'user'
], function (app, backbone, marionette, $, template) {
    "use strict";
    return marionette.ItemView.extend({
        template: template,
        ui : {
            'submit' : '.forgotten-submit'
        },
        events : {
            'click @ui.submit' : 'submit'
        },
        submit : function(e) {
            e.preventDefault();
            app.vent.trigger("Popup", true, "<h3>Successfully!</h3> Check your email. We sended instruction for reset a new password");
        }
    });
});