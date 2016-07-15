/**
 * Created by George on 14.01.2016.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/user/templates/adminorders.html',
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
            var self = this;
            return {
                user : function(id) {
                   var str = "";
                    for(var i = 0; i < self.options.users.length; i++) {
                        if(self.options.users[i]._id == id) {
                            str +=  "<span style='color:green'>"+self.options.users[i].name + "</span>, email: <span style='color:green'>" +
                            self.options.users[i].email + "</span>, Phone number: <span style='color:green'>" + self.options.users[i].phone + "</span>"
                        }
                    }
                  return str
                },
                orders: this.options.orders,
                cars: this.options.cars,
                additional : function() {
                    var str = "";
                    for(var i = 0; i < self.options.orders.length; i++) {

                        for(var j = 0; j < self.options.orders[i].additional.length; j++) {
                            var option = _.find(self.options.additionalOptions, function(item) {
                                return item.id == self.options.orders[i].additional[j].id
                            });
                          str += option.name;
                            if(j < self.options.orders[i].additional.length-1) {
                                str += ", ";
                            }
                        }
                    }
                  return str;
                },
                getDate: function (time, params) {
                    if(params) {
                        var hm = params.split(":");
                        var t =  moment.unix(time);
                        t.set({'hour':hm[0]});
                        t.set({'minute':hm[1]});
                        return t.format('DD.MM.YYYY HH:mm')
                    } else {
                        return moment.unix(time).format('DD.MM.YYYY HH:mm');
                    }

                }
            }
        }
    })
});