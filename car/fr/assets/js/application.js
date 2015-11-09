/**
 * Created by George on 29.09.2015.
 */
define([
    'marionette',
    'jquery.fancybox'
], function (Marionette) {
    "use strict";
    var app = new Marionette.Application();
    app.on("start", function () {
        console.log('Application has been started!');
        require(["bootstrap"]);
        require(['page']);

    });
    app.vent.on({
        "Loading": function (flag) {
            return flag ? $.fancybox.showLoading() : $.fancybox.hideLoading();
        },
        "Popup": function (flag, html) {
            return flag ? $.fancybox(html) : $.fancybox.close();
        }
    })
    app.vent.on("Popup:show", function (html) {
        $.fancybox(html);
    });
    app.vent.on("Popup:hide", function (html) {
        $.fancybox(html);
    });
    return window.app = app;
});