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
        catalogData: null,
        initialize: function (data) {
            this.catalogData = data.data;
        },
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
                seasons: this.catalogData.priceSeasons,
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
                    app.reqres.setHandler("app:order:price:update", function () {
                        var days = (moment(app.searchParams.endDate).unix() - moment(app.searchParams.startDate).unix()) / 3600 / 24,
                            priceSeasons = this.seasons;
                        if (Math.ceil == 0) {
                            app.order = {days: 0, price: 0, car: {}}
                            return 0;
                        }
                        var searchedStartDate = new Date(moment(app.searchParams.startDate).format("YYYY/MM/DD")),
                            price = 0, priceOneDay = 0,
                            searchedEndDate = new Date(moment(app.searchParams.endDate).format("YYYY/MM/DD"));
                        for (var time = searchedStartDate.getTime(); time < searchedEndDate.getTime(); time += 86400000) {
                            for (var i = 0; i < priceSeasons.length; i++) {

                                var start = new Date(priceSeasons[i].start).getTime(),
                                    end = new Date(priceSeasons[i].end).getTime();

                                if (time >= start && time <= end) {
                                    var priceBySeason = data.prices[i];
                                    if (Math.ceil(days) >= 1 && Math.ceil(days) <= 3) {
                                        for (var i in priceBySeason) {
                                            priceOneDay = priceBySeason[i]["1"];
                                            price += priceBySeason[i]["1"];

                                        }
                                    }
                                    else if (Math.ceil(days) >= 3 && Math.ceil(days) <= 8) {
                                        for (var i in priceBySeason) {
                                            priceOneDay = priceBySeason[i]["3"];
                                            price += priceBySeason[i]["3"];
                                        }
                                    }
                                    else if (Math.ceil(days) >= 8 && Math.ceil(days) <= 15) {
                                        for (var i in priceBySeason) {
                                            priceOneDay = priceBySeason[i]["8"];
                                            price += priceBySeason[i]["8"];
                                        }
                                    }
                                    else if (Math.ceil(days) >= 15) {
                                        for (var i in priceBySeason) {
                                            priceOneDay = priceBySeason[i]["15"];
                                            price += priceBySeason[i]["15"];
                                        }
                                    }
                                }
                            }
                        }
                        app.order = {days: Math.ceil(days), price: price, car: data, priceOneDay: priceOneDay}
                        return price;
                    }, this);
                    return app.request("app:order:price:update")

                },
                startDate: moment(app.searchParams.startDate).format('LL') + ', ' + moment(app.searchParams.startTime).format('HH:mm'),
                endDate: moment(app.searchParams.endDate).format('LL') + ', ' + moment(app.searchParams.endTime).format('HH:mm')
            }
        }
    });
});