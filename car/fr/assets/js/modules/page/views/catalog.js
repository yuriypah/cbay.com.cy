/**
 * Created by George on 07.11.2015.
 */
define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/page/templates/catalog.html',
    'fotorama'
], function (app, backbone, marionette, $, catalog, fotorama) {
    "use strict";
    return marionette.ItemView.extend({
        template: catalog,
        initialize: function (options) {
           // console.log(options.id);
        },
        onShow: function () {
            $('.fotorama').fotorama({
                thumbheight: '80px',
                thumbwidth: '140px',
                thumbmargin: 20,
                width: '100%'
            });
        }
    });
});