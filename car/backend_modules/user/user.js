(function () {
    "use strict";
    var express = require('express'),
        path = require('path'),
        mongoose = require('mongoose'),
        md5 = require('md5'),
        validator = require('validator'),
        cookie = require('cookie');

    mongoose.connect('mongodb://localhost/library_database');

    var userModule = function (app) {
        var Users = new mongoose.Schema({
            email: String,
            pwd: String,
            phone: String,
            createdDate: String,
            lastDate: String
        });
        var UsersSchema = mongoose.model('Users', Users);
        app.post('/user', function (request, response) {
            if (request.body.action == 'create') {
                if (!validator.isEmail(request.body.email)) {
                    return response.send({
                        saved: false,
                        errorName: 'wrongEmail'
                    });
                }
                if (!validator.equals(request.body.pwd, request.body.cpwd)) {
                    return response.send({
                        saved: false,
                        errorName: 'pwdNotEquals'
                    });
                }
                if (!validator.isByteLength(request.body.pwd, 6, 12)) {
                    return response.send({
                        saved: false,
                        errorName: 'pwdWrongLength'
                    });
                }
                if (!validator.isNumeric(request.body.phone)) {
                    return response.send({
                        saved: false,
                        errorName: 'wrongPhone'
                    });
                }
                var user = new UsersSchema({
                    email: request.body.email,
                    pwd: md5(request.body.pwd),
                    phone: request.body.phone,
                    createdDate: request.body.createdDate
                });

                user.save();
                return UsersSchema.find({email: request.body.email}, function (err, data) {
                    if (data.length > 0) {
                        return response.send({
                            saved: false,
                            errorName: 'existEmail'
                        });
                    } else {
                        return response.send({
                            saved: true
                        });
                    }
                });

            } else if (request.body.action == 'change') {

            }
        });
        app.post('/auth', function (request, response) {
            if (request.body.action == 'login') {
                return UsersSchema.find({
                    email: request.body.email,
                    pwd: md5(request.body.pwd)
                }, function (err, user) {
                    if (user.length > 0) {
                        response.cookie('a', md5(user[0].email)); // write hash user
                        UsersSchema.update({_id: user[0]._id}, {$set: {lastDate: +new Date()}}).exec(); // update date of last log in
                        return response.send({'status': 1});
                    } else {
                        return response.send({'status': 0});
                    }

                });
            }
            else if (request.body.action == 'logout') {
                return response.clearCookie('a').send({});
            }
        });
        app.get('/check', function (request, response) {
            if (request.headers.cookie) {
                var localData = cookie.parse(request.headers.cookie);
                return UsersSchema.find(null, function (err, user) {
                    for (var i = 0; i < user.length; i++) {
                        if (md5(user[i].email) == localData.a) {
                            response.send({'status': 1});
                        } else {
                            response.send({'status': 0});
                        }
                    }
                });
            } else {
                response.send({'status': 0});
            }
        });
    };
    exports.initialize = function (app) { //
        userModule(app);
    };
})();