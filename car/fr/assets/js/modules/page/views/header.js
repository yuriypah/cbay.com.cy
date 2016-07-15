/**
 * Created by George on 29.09.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'bootstrapDatepicker',
    'text!modules/page/templates/header.html',
    'modules/user/views/login',
    'modules/user/views/register',
    'moment'
], function (app, backbone, marionette, $, bootstrapDatepicker, tpl, loginView, registerView, moment) {
    "use strict";

    return marionette.ItemView.extend({
        template: tpl,
        ui: {
            'start_calendar': '.start_calendar',
            'end_calendar': '.end_calendar',
            'start_timer': '.start_timer',
            'end_timer': '.end_timer',
            'searchPanel': '.search-panel-container',
            'advanced_search_block': '.advanced_search',
            'advanced_search_holder': '.advanced-link',
            'loginHolder': '.login',
            'logoutHolder': '.logout',
            'registerHolder': '.register',
            'currency_link': '.currency_link',
            'submit': '.submit'
        },
        events: {
            'click @ui.advanced_search_holder': 'showAdvanced',
            'click @ui.loginHolder': 'login',
            'click @ui.logoutHolder': 'logout',
            'click @ui.registerHolder': 'register',
            'keydown @ui.start_calendar,@ui.end_calendar,@ui.start_timer,@ui.end_timer': 'stopKey',
            'click @ui.currency_link': 'changeCurrency',
            'click @ui.submit': 'submit'
        },
        submit: function () {

            $.fancybox.showLoading();
            $.post('/search', {

                startDate: moment(app.searchParams.startDate).unix(),
                endDate: moment(app.searchParams.endDate).unix(),
                startTime: moment(app.searchParams.startTime).format('HH:mm'),
                endTime: moment(app.searchParams.endTime).format('HH:mm'),

            }, function (data) {
                var countBookedCars = 0;
                for (var i = moment(app.searchParams.startDate).unix(); i <= moment(app.searchParams.endDate).unix(); i += 86400) {
                    for (var j = 0; j < data.orders.length; j++) {
                        if (i >= data.orders[j].start_date && i <= data.orders[j].end_date) {
                            $(".car-item[data-id=" + data.orders[j].car_id + "]").parent().parent().hide();
                            countBookedCars++;
                        } else {
                            $(".car-item[data-id=" + data.orders[j].car_id + "]").parent().parent().show();

                        }
                    }
                }

                $(".text-hello, .image-hello").remove();
                $(".h1-hello").html("Search results: <span style='color:green'>Available " + ($(".car-item").length - countBookedCars) + " cars</span>");
                $.fancybox.hideLoading();
            });

        },
        changeCurrency: function (e) {
            e.preventDefault();
            var obj = $(e.currentTarget);
            obj.parents('.nav-tabs').find('li').removeClass('active');
            obj.parent().addClass('active');
            $.post('/save_currency', {currency: obj.data('currency')});
        },
        stopKey: function (e) {
            e.preventDefault();
            return false;
        },
        register: function (e) {
            e.preventDefault();
            app.vent.trigger("Popup", true, registerView, 'view');
        },
        login: function (e) {
            e.preventDefault();
            app.vent.trigger("Popup", true, loginView, 'view');

        },
        logout: function (e) {
            e.preventDefault();
            app.User.logout();

        },
        showAdvanced: function (e) {
            e.preventDefault();
            this.ui.advanced_search_block.slideToggle(300, function () {
                if ($(e.currentTarget).find('.glyphicon').hasClass('glyphicon-menu-down')) {
                    $(e.currentTarget).find('.glyphicon').removeClass('glyphicon-menu-down').addClass('glyphicon-menu-up');
                } else {
                    $(e.currentTarget).find('.glyphicon').removeClass('glyphicon-menu-up').addClass('glyphicon-menu-down');
                }
            });

        },
        changeSearchParams: function () {
            app.searchParams = {
                startDate: this.ui.start_calendar.data('DateTimePicker').date(),
                endDate: this.ui.end_calendar.data('DateTimePicker').date(),
                startTime: this.ui.start_timer.data('DateTimePicker').date(),
                endTime: this.ui.end_timer.data('DateTimePicker').date()
            };
            app.vent.trigger("Search:changed");
        },
        onShow: function () {
            var self = this;
            $('[data-currency=' + app.currency + '].currency_link').click();
            this.ui.start_calendar.datetimepicker({
                locale: 'en',
                format: 'DD.MM.YYYY',
                showClear: true,
                showClose: true,
                minDate: new Date()
            });
            var yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);
            this.ui.start_calendar.data("DateTimePicker").minDate(yesterday)
            if (app.searchParams.startDate) {
                this.ui.start_calendar.data("DateTimePicker").date(app.searchParams.startDate)
            } else {
                this.ui.start_calendar.data("DateTimePicker").date(new Date())
            }
            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);

            this.ui.end_calendar.datetimepicker({
                locale: 'en',
                format: 'DD.MM.YYYY',
                showClear: true,
                showClose: true
            });
            this.ui.end_calendar.data("DateTimePicker").minDate(yesterday)
            if (app.searchParams.endDate) {
                this.ui.end_calendar.data("DateTimePicker").date(app.searchParams.endDate)
            } else {
                this.ui.end_calendar.data("DateTimePicker").date(tomorrow)
            }


            this.ui.start_timer.datetimepicker({
                locale: 'en',
                format: 'HH:mm',
                showClear: true,
                showClose: true
            });
            if (app.searchParams.startTime) {
                this.ui.start_timer.data("DateTimePicker").date(app.searchParams.startTime)
            }
            this.ui.end_timer.datetimepicker({
                locale: 'en',
                format: 'HH:mm',
                showClear: true,
                showClose: true
            });
            if (app.searchParams.endTime) {
                this.ui.end_timer.data("DateTimePicker").date(app.searchParams.endTime)
            }
            this.ui.start_calendar.on("dp.change", function () {
                self.changeSearchParams()
            })
            this.ui.end_calendar.on("dp.change", function () {
                self.changeSearchParams()
            })
            this.ui.start_timer.on("dp.change", function () {
                self.changeSearchParams()
            })
            this.ui.end_timer.on("dp.change", function () {
                self.changeSearchParams()
            });
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6&appId=205933253138876";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        }
    })
});