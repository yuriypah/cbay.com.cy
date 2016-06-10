/**
 * Created by George on 14.01.2016.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/page/templates/order.html',
    'moment'
], function (app, backbone, marionette, $, tpl, moment) {
    "use strict";
    return marionette.ItemView.extend({
        template: tpl,
        ui: {
            'choose_pay': '.choose_pay',
            'checkout': '.checkout'
        },
        events: {
            'click @ui.choose_pay': 'choose_pay',
            'click @ui.checkout': 'checkout'
        },
        choose_pay: function (e) {
            e.preventDefault();
            var obj = $(e.currentTarget);
            obj.parents('.payment_variants').find('.choose_pay').removeClass('active');
            obj.addClass('active');
            if (obj.hasClass('cache')) {
                this.ui.checkout.attr('disabled', false)
            } else {
                this.ui.checkout.attr('disabled', true);
            }
        },
        checkout: function (e) {
            e.preventDefault();

            $.post('/checkout', {
                carId: app.order.car.id,
                userId: app.user.id,
                startDate: moment(app.searchParams.startDate).unix(),
                endDate: moment(app.searchParams.endDate).unix(),
                startTime: moment(app.searchParams.startTime).format('HH:mm'),
                endTime: moment(app.searchParams.endTime).format('HH:mm'),
                price : app.order.price
            }, function () {
                var router = new app.page.router();
                router.navigate('#checkout', {trigger: true});
                app.order = {};
            });
        },
        onShow: function () {
            app.vent.on("Search:changed", function () {
                var days = (moment(app.searchParams.endDate).unix() - moment(app.searchParams.startDate).unix()) / 3600 / 24;
                if (Math.ceil(days) > 0) {
                    var price = app.order.car.price * Math.ceil(days);
                    app.order = {days: Math.ceil(days), price: price, car: app.order.car}
                    $('.checkout').attr('disabled', false);

                } else {
                    app.order.price = 0;
                    app.order.days = 0;
                    $('.checkout').attr('disabled', true);
                }
                try {
                    this.render();
                } catch (e) {

                }


            }, this);
        },
        templateHelpers: function () {
            var dates = {
                startDate: moment(app.searchParams.startDate).format('LL') + ', ' + moment(app.searchParams.startTime).format('HH:mm'),
                endDate: moment(app.searchParams.endDate).format('LL') + ', ' + moment(app.searchParams.endTime).format('HH:mm')
            };
            return {
                dates: dates
            }
        }
    });

});