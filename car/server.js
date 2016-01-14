(function () {
    var application_root = __dirname;
        global.express = require('express');
    global.path = require('path');
    global.mongoose = require('mongoose');
    global.md5 = require('md5');
    global.validator = require('validator');
    global.cookie = require('cookie');
    global.app = express();
    global.app.configure(function () {
        app.use(express.bodyParser());
        app.use(express.methodOverride());
        app.use(app.router);
        app.use(express.static(global.path.join(application_root, 'fr')));
        app.use(express.errorHandler({
            dumpExceptions: true,
            showStack: true
        }))
    });
    //start server
    var port = 4711;
    app.listen(port, function () {
        // server is started;
    });



    mongoose.connect('mongodb://localhost/library_database');
    // include custom modules
    var user = require('./backend_modules/user');
    user.initialize();
    var cars = require('./backend_modules/cars');
    cars.initialize();
})();


