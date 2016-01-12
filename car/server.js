(function () {
    var application_root = __dirname,
        express = require('express'),
        path = require('path');
    var app = express();
    app.configure(function () {
        app.use(express.bodyParser());
        app.use(express.methodOverride());
        app.use(app.router);
        app.use(express.static(path.join(application_root, 'fr')));
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
    // include custom modules
    var user = require('./backend_modules/user');
    user.initialize(app);

})();


