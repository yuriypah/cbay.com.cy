/**
 * Created by George on 29.09.2015.
 */
var application_root = __dirname,
    express = require('express'),
    path = require('path'),
    mongoose = require('mongoose');
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
    console.log('Express server has been started');
});

mongoose.connect('mongodb://localhost/library_database');
var testDB = new mongoose.Schema({
    foo: String,
    bar: String
});
var testDB_model = mongoose.model('testDB', testDB);
app.get("/car", function () {

});
/*app.get('/api', function (request, response) {
 return testDB_model.find(function (err, data) {
 return response.send(data);
 })
 });*/
