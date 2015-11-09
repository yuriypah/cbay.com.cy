/**
 * Created by George on 04.11.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/page/templates/content.html'
], function (app, backbone, marionette, $, tpl) {
    "use strict";

    return marionette.ItemView.extend({
        template: tpl
    });

});