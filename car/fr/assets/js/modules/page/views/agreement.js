/**
 * Created by George on 13.06.2016.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/page/templates/agreement.html',

], function (app, backbone, marionette, $,tpl ) {
    "use strict";
    return marionette.ItemView.extend({
        template: tpl
    })
});