/**
 * Created by George on 14.01.2016.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/user/templates/orders.html',
    'moment'
], function (app, backbone, marionette, $, tpl, moment) {
    "use strict";
    return marionette.ItemView.extend({
        template: tpl,
        ui: {
            'removeOrder': '.removeOrder'
        },
        events: {
            'click @ui.removeOrder': 'removeOrder'
        },
        removeOrder: function (e) {
            var obj = $(e.currentTarget);
            if (confirm('This order will be delete, Confirm?')) {
                obj.parents('tr').remove();
                if ($('.orders tr').length  == 0) {
                    var router = new app.page.router();
                    router.navigate('', {trigger: true});
                }
                $.post('/order_delete', {id: obj.data('id')});
            } else {

            }
        },
        templateHelpers: function () {
            return {
                orders: this.options.orders,
                cars: this.options.cars,
                getDate: function (time) {
                    return moment.unix(time).format('LL');
                }
            }
        }
    })
});