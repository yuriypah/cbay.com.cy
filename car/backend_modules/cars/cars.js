(function () {
    "use strict";
    var carsModule = function () {
        var staticData = {
            categories: [
                {
                    id: 1,
                    name: 'Popular cars'
                }
            ],
            cars: [
                {
                    id: 1,
                    name: 'NISSAN NOTE',
                    image: '/assets/img/cars/note/1.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/note/1.jpg'
                        },

                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1],
                    price: 30,
                    prices: [
                        {
                            "1" : {"1": 30, "3": 25, "8": 18, "15": 16}
                        },
                        {
                            "2" : {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "3" : {"1": 35, "3": 30, "8": 27, "15": 25}
                        }
                    ]
                },
                {
                    id: 2,
                    name: 'NISSAN LATIO',
                    image: '/assets/img/cars/latio/ttn_169291848.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/latio/ttn_169291848.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1],
                    price: 35,
                    prices: [
                        {
                            "1" : {"1": 30, "3": 25, "8": 18, "15": 16}
                        },
                        {
                            "2" : {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "3" : {"1": 35, "3": 30, "8": 27, "15": 25}
                        }
                    ]
                },
                {
                    id: 3,
                    name: 'NISSAN SIENTA',
                    image: '/assets/img/cars/sienta/toyota-sienta-05.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/sienta/toyota-sienta-05.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1],
                    price: 35,
                    prices: [
                        {
                            "1" : {"1": 30, "3": 25, "8": 18, "15": 16}
                        },
                        {
                            "2" : {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "3" : {"1": 35, "3": 30, "8": 27, "15": 25}
                        }
                    ]
                }
            ],
            properties: [
                {
                    id: 1,
                    name: 'Transmission',
                    value: 'Automat',
                    shortValue: 'AT',
                    shortDescription: 'Automat',
                    iconClass: 'glyphicon glyphicon-ok'
                },
                {
                    id: 2,
                    name: 'Count passengers',
                    value: 5,
                    shortValue: '5',
                    shortDescription: '5 passengers',
                    iconClass: 'glyphicon glyphicon-user'
                },
                {
                    id: 3,
                    name: 'Climat',
                    value: 'yes',
                    shortValue: 'AC',
                    shortDescription: 'Climat control : yes',
                    iconClass: 'glyphicon glyphicon-asterisk'
                },
                {
                    id: 4,
                    name: 'Wi-Fi',
                    value: 'yes',
                    shortValue: 'WiFi',
                    shortDescription: 'WiFi',
                    iconClass: 'glyphicon glyphicon-signal'
                },
                {
                    id: 5,
                    name: 'Video',
                    value: 'yes',
                    shortValue: 'V',
                    shortDescription: 'Video registration',
                    iconClass: 'glyphicon glyphicon-facetime-video'
                },
                {
                    id: 6,
                    name: 'Liked',
                    value: '0',
                    shortValue: '0',
                    shortDescription: 'Liked users : 0',
                    iconClass: 'glyphicon glyphicon-thumbs-up'
                }
            ]
        };
        var orderModel = new mongoose.Schema({
            car_id: String,
            user_id: String,
            start_date: String,
            end_date: String,
            start_time: String,
            end_time: String,
            price: String,
            date: String
        })
        var ordersSchema = mongoose.model('order', orderModel);
        app.get('/cars', function (request, response) {
            return response.send(staticData);
        });
        app.get('/catalog/:id', function (request, response) {
            return response.send(staticData);
        });
        app.get('/catalog/:id/confirmation', function (request, response) {
            return response.send({});
        });
        app.post('/checkout', function (request, response) {
            var order = new ordersSchema({
                car_id: request.body.carId,
                user_id: request.body.userId,
                start_date: request.body.startDate,
                end_date: request.body.endDate,
                start_time: request.body.startTime,
                end_time: request.body.endTime,
                price: request.body.price,
                date: +new Date
            })
            order.save();
            return response.send({});
        });
        app.get('/orders', function (request, response) {
            var localData = cookie.parse(request.headers.cookie || '');
            return UsersSchema.find(null, function (err, user) {
                for (var i = 0; i < user.length; i++) {
                    if (md5(user[i].email) == localData.a) {
                        ordersSchema.find({user_id: user[i]._id}, function (err, orders) {
                            response.send({
                                orders: orders,
                                cars: staticData.cars
                            });
                        })
                    }
                }

            });
        });
        app.post('/order_delete', function (request, response) {
            ordersSchema.find({_id: request.body.id}).remove().exec();
        });
    };
    exports.initialize = function (app) {
        carsModule(app);
    };
})();