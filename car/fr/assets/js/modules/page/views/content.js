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
        template: tpl,
        templateHelpers: function () {
            var self = this;
            return {
                objects: self.options.data
            };
        },
        onShow : function() {
            $(".js-hello").animate({'opacity':'1.0'},1000, function() {
                $(".image-hello").animate({'opacity':'1.0'},1000);
            });
        }
    });

});