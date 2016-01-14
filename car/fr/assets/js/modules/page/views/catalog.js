/**
 * Created by George on 07.11.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/page/templates/catalog.html',
    'moment',
    'modules/user/views/login',
    'fotorama'
], function (app, backbone, marionette, $, catalog, moment, loginView) {
    "use strict";
    return marionette.ItemView.extend({
        template: catalog,
        onShow: function () {
            var self = this;
            app.vent.on("Search:changed", function () {
                try {
                    this.render();
                } catch (e) {

                }
            }, this);
            $(".start_calendar").trigger('dp.change');
        },
        onRender: function () {
            // вынести галерею в отдельную въюшку
            $('.fotorama').fotorama({
                thumbheight: '80px',
                thumbwidth: '140px',
                thumbmargin: 20,
                width: '100%'
            });
        },
        templateHelpers: function () {
            var data = _.findWhere(this.options.data.cars, {id: +this.options.id})
            return {
                car: data,
                days: function () {
                    var days = (moment(app.searchParams.endDate).unix() - moment(app.searchParams.startDate).unix()) / 3600 / 24;
                    if (Math.ceil(days) > 0) {
                        return Math.ceil(days);
                    } else {
                        return "<span style='color:red'>Wrong dates!</span>";
                    }

                },
                price: function () {
                    var days = (moment(app.searchParams.endDate).unix() - moment(app.searchParams.startDate).unix()) / 3600 / 24;
                    if (Math.ceil(days) > 0) {
                        var price = data.price * Math.ceil(days);
                        app.order = {days: Math.ceil(days), price: price, car: data}
                        return price
                    } else {
                        app.order = {days: 0, price: 0, car: {}}
                        return 0;
                    }
                },
                startDate: moment(app.searchParams.startDate).format('LL') + ', ' + moment(app.searchParams.startTime).format('HH:mm'),
                endDate: moment(app.searchParams.endDate).format('LL') + ', ' + moment(app.searchParams.endTime).format('HH:mm')
            }
        }
    });
});