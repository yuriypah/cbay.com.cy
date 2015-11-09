/**
 * Created by George on 29.09.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/page/templates/layout.html'
], function (app, backbone, marionette, jquery, tpl) {
    "use strict";
    return marionette.LayoutView.extend({
        template: tpl,
        el: 'body',
        regions: {
            'header': '#header',
            'content': '#content',
            'footer': '#footer'
        },
        onRender: function () {
            app.vent.trigger('layoutRendered');
        }
    });
});