/**
 * Created by George on 29.09.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'modules/page/views/layout',
    'modules/page/views/header',
    'modules/page/views/content',
    'modules/page/views/catalog',
    'modules/page/views/footer'
], function (app, backbone, marionette, jquery, layout, header, content, catalog, footer) {
    "use strict";
    app.module("page", function (page) {
        page.layout = new layout();
        app.vent.on({
            "Page:renderHeader": function () {
                page.layout.getRegion('header').show(new header()); // show header
            }
        });
        page.layout.on("render", function () {
            this.router = backbone.Router.extend({
                name: 'page',
                routes: {
                    '': 'index',
                    'catalog/:id': 'catalog'
                },
                index: function () {
                    page.layout.getRegion('header').show(new header()); // show header
                    page.layout.getRegion('content').show(new content()); // show content
                    page.layout.getRegion('footer').show(new footer()); // show footer
                },
                catalog: function (id) {
                    page.layout.getRegion('header').show(new header()); // show header
                    page.layout.getRegion('content').show(new catalog({
                        id: id
                    }));
                    page.layout.getRegion('footer').show(new footer()); // show footer
                }
            });
            this.appRouter = new this.router;
        }, this);
        this.layout.render();
        Backbone.history.start();

    });
});