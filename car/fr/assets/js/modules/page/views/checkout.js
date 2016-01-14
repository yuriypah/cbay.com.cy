define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/page/templates/checkout.html',
    'moment'], function (app, backbone, marionette, $, tpl, moment) {
    "use strict";
    return marionette.ItemView.extend({
        template: tpl
    });
});