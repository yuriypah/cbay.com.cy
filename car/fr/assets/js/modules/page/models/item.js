/**
 * Created by George on 07.11.2015.
 */
define([
    'app',
    'backbone',
    'marionette'
], function (app, backbone, marionette) {
    "use strict";
    return backbone.Model.extend({
        defaults: {
            mainImage: '',
            images: [],
            description: '',
            price: 0,
            raiting: 4, // рэйтинг
            properties: [] // свойства авто
        }
    });
})