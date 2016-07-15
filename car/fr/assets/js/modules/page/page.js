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
    'modules/page/views/footer',
    'modules/page/views/order',
    'modules/page/views/checkout',
    'modules/user/views/orders',
    'modules/page/views/agreement',
    'modules/page/views/about',
    'modules/user/views/adminorders',
], function (app, backbone, marionette, jquery, layout, header, content, catalog, footer, orderView, checkoutView, ordersView, agreementView, aboutView, adminordersView) {
    "use strict";
    app.module("page", function (page) {
        page.layout = new layout();
        app.vent.on({
            "Page:renderHeader": function () {
                page.layout.getRegion('header').show(new header()); // show header
            }
        });
        page.layout.on("render", function () {
            var self = this;
            this.router = backbone.Router.extend({
                name: 'page',
                routes: {
                    '': 'index',
                    'catalog/:id': 'catalog',
                    'catalog/:id/confirmation': 'confirmationOrder',
                    'checkout': 'checkout',
                    'orders': 'orders',
                    'agreement' : 'agreement',
                    'about' : 'about',
                    'adminorders' : 'adminorders'
                },
                index: function () {
                    $("body").scrollTop(0)
                    page.layout.getRegion('header').show(new header()); // show header
                    $.get("/cars", function (data) {
                        page.layout.getRegion('content').show(new content({
                            data: data
                        })); // show content
                    })
                    page.layout.getRegion('footer').show(new footer()); // show footer
                },
                agreement : function() {
                    $("body").scrollTop(0)
                    page.layout.getRegion('header').show(new header()); // show header
                    page.layout.getRegion('content').show(new agreementView({

                    }));
                    page.layout.getRegion('footer').show(new footer()); // show f
                },
                about : function() {
                    $("body").scrollTop(0)
                    page.layout.getRegion('header').show(new header()); // show header
                    page.layout.getRegion('content').show(new aboutView({

                    }));
                    page.layout.getRegion('footer').show(new footer()); // show f
                },
                catalog: function (id) {
                    $("body").scrollTop(0)
                    $.get("/catalog/" + id, function (data) {
                        page.layout.getRegion('header').show(new header()); // show header
                        page.layout.getRegion('content').show(new catalog({
                            id: id,
                            data: data
                        }));
                        page.layout.getRegion('footer').show(new footer()); // show footer
                    });

                },
                confirmationOrder: function (id) {
                    $("body").scrollTop(0)
                    var router = new self.router();
                    if (app.order.price > 0) {
                        if (!app.isAuth) {
                            $('.login').click();
                            router.navigate('#catalog/' + id);
                        } else {
                            $.get('/catalog/' + app.order.car.id + '/confirmation', function (data) {
                                page.layout.getRegion('header').show(new header()); // show header
                                app.page.layout.getRegion('content').show(new orderView({
                                    data : data
                                }));
                                page.layout.getRegion('footer').show(new footer()); // show footer
                            });
                        }
                    } else {
                        router.navigate('#catalog/' + id, {trigger: true});
                    }
                },
                checkout: function () {
                    var router = new self.router();
                    $("body").scrollTop(0);
                    if (app.order.price > 0) {
                        page.layout.getRegion('header').show(new header()); // show header
                        app.page.layout.getRegion('content').show(new checkoutView());
                        page.layout.getRegion('footer').show(new footer()); // show footer
                    } else {
                        router.navigate('', {trigger: true});
                    }
                },
                orders: function () {
                    var router = new self.router();
                    if (!app.isAuth) {
                        router.navigate('', {trigger: true});
                    } else {
                        page.layout.getRegion('header').show(new header()); // show header
                        $.get('/orders', function (data) {

                            app.page.layout.getRegion('content').show(new ordersView({
                                orders: data.orders,
                                cars : data.cars,
                                additionalOptions : data.additionalOptions
                            }));

                        });
                        page.layout.getRegion('footer').show(new footer()); // show footer
                    }
                },
                adminorders: function () {
                    var router = new self.router();
                    if (!app.isAuth) {
                        router.navigate('', {trigger: true});
                    } else {
                        page.layout.getRegion('header').show(new header()); // show header
                        $.get('/adminorders', function (data) {

                            app.page.layout.getRegion('content').show(new adminordersView({
                                users:data.users,
                                orders: data.orders,
                                cars : data.cars,
                                additionalOptions : data.additionalOptions
                            }));

                        });
                        page.layout.getRegion('footer').show(new footer()); // show footer
                    }
                }
            });
            this.appRouter = new this.router;
        }, this);
        this.layout.render();
        Backbone.history.start();

    });
});