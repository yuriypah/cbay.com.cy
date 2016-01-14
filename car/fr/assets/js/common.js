/**
 * Created by George on 29.09.2015.
 */
require.config({
    baseUrl: '/assets/js',
    shim: {
        'bootstrap': {
            deps: ['jquery']
        },
        'jquery': {
            exports: '$'
        },
        'jquery-ui': {
            deps: ['jquery']
        },
        'modernizr': {
            exports: 'Modernizr'
        },
        'underscore': {
            exports: '_'
        },
        'backbone': {
            exports: 'Backbone',
            deps: ['jquery', 'underscore']
        },
        'backbone.syphon': {
            deps: ['backbone']
        },
        'marionette': {
            exports: 'Marionette',
            deps: ['backbone']
        },
        'jquery.fancybox': {
            deps: ['jquery']
        },
        'bootstrapDatepicker': {
            exports: 'BootstrapDatepicker',
            deps: ['jquery', 'bootstrap', 'moment']
        }
    },
    paths: {
        'jquery': ["vendor/jquery/dist/jquery.min"],
        'jquery-ui': ['vendor/jquery-ui/jquery-ui.min'],
        'bootstrap': ['vendor/bootstrap/dist/js/bootstrap.min'],
        'moment': ['vendor/moment/min/moment-with-locales.min'],
        'bootstrapDatepicker': ['vendor/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker'],
        'modernizr': ['vendor/modernizr-min/modernizr.min'],
        'underscore': ['vendor/underscore/underscore-min'],
        'backbone': ['vendor/backbone/backbone-min'],
        'backbone.syphon': ['vendor/backbone.syphon/lib/backbone.syphon.min'],
        'marionette': ['vendor/marionette/lib/backbone.marionette.min'],
        'jquery.fancybox': ['vendor/fancybox/source/jquery.fancybox.pack'],
        'fotorama': ['vendor/fotorama/fotorama'],
        'text': ['vendor/requirejs-text/text'],
        'app': 'application',
        'page': 'modules/page/page',
        'user' : 'modules/user/userModule'

    },
    deps: ['jquery', 'underscore']
});
require(['app'], function () {
    app.start();
})