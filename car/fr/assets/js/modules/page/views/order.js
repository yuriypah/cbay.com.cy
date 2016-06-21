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
        initialize : function() {

        },
        choose_pay: function (e) {
            e.preventDefault();
            var obj = $(e.currentTarget);
            obj.parents('.payment_variants').find('.choose_pay').removeClass('active');
            obj.addClass('active');
            if (obj.hasClass('cache')) {
                this.ui.checkout.attr('disabled', false)
            } else if (obj.hasClass('paypal_case')) {
                $.fancybox("<h3>Paypal payment page</h3> Now you have 30 minutes to can pay this order by opened paypal form on a new tab<br/>");
                $(".paypal_form").submit();
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
                price: app.order.price
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
                dates: dates,
                deposit_variants: function () {
                    var arr = [];
                    switch (app.order.car.name) {
                        case "NISSAN NOTE":
                            arr = [
                                {'id':1, 'value':'Deposit: €300 (Accident Excess: €800)'},
                                {'id':2, 'value':'Deposit: €300 with insurance ADW (Accident Excess: €400): ' + (app.order.days*2) + '€'},
                                {'id':3, 'value':'Deposit: €300, with ADW+ (No excess): ' + (app.order.days*3) + '€'}
                            ];
                            break;
                        case "NISSAN LATIO":
                            arr = [
                                {'id':1, 'value':'Deposit: €300 (Accident Excess: €1000)'},
                                {'id':2, 'value':'Deposit: €300 with insurance ADW (Accident Excess: €500): ' + (app.order.days*3) + '€'},
                                {'id':3, 'value':'Deposit: €300, with ADW+ (No excess): ' + (app.order.days*4) + '€'}
                            ];
                            break;
                        case "NISSAN SIENTA":
                            arr = [
                                {'id':1, 'value':'Deposit: €500 (Accident Excess: €1000)'},
                                {'id':2, 'value':'Deposit: €500 with insurance ADW (Accident Excess: €500): €' + (app.order.days*4)},
                                {'id':3, 'value':'Deposit: €500, with ADW+ (No excess): €' + (app.order.days*5)}
                            ];
                            break;
                        case "NISSAN JUKE":
                            arr = [
                                {'id':1, 'value':'Deposit: €500 (Accident Excess: €1000)'},
                                {'id':2, 'value':'Deposit: €500 with insurance ADW (Accident Excess: €500): €' + (app.order.days*3)},
                                {'id':3, 'value':'Deposit: €500, with ADW+ (No excess): €' + (app.order.days*4)}
                            ];
                            break;
                        case "NISSAN MICRA":
                            arr = [
                                {'id':1, 'value':'Deposit: €200 (Accident Excess: €800)'},
                                {'id':2, 'value':'Deposit: €200 with insurance ADW (Accident Excess: €400): €' + (app.order.days*2)},
                                {'id':3, 'value':'Deposit: €200, with ADW+ (No excess): €' + (app.order.days*3)}
                            ];
                            break;
                        case "NISSAN SERENA":
                            arr = [
                                {'id':1, 'value':'Deposit: €600 (Accident Excess: €1000)'},
                                {'id':2, 'value':'Deposit: €600 with insurance ADW (Accident Excess: €500): €' + (app.order.days*4)},
                                {'id':3, 'value':'Deposit: €600, with ADW+ (No excess): €' + (app.order.days*5)}
                            ];
                            break;
                    }
                    return arr;
                }
            }
        }
    });

});