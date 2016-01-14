/**
 * Created by George on 11.01.2016.
 */
define([
    'app',
    'backbone',
    'marionette'
], function (app, backbone, marionette) {
    return backbone.Model.extend({
        url: '/user',
        defaults: {
            name : '',
            email: '',
            pwd: '',
            phone: '',
            createdDate: +new Date(),
            action: 'create'
        }
    });
});