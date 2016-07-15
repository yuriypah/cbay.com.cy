(function () {
    "use strict";
    var carsModule = function () {
        var staticData = {
            categories: [
                {
                    id: 1,
                    name: 'Popular cars'
                },
                {
                    id: 2,
                    name: 'Comfortable cars'
                },
                {
                    id: 3,
                    name: 'Cheap cars'
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
                        {
                            src: '/assets/img/cars/note/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/8.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/9.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/10.jpg'
                        },

                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 3],
                    price: 16,
                    prices: [
                        {
                            "1": {"1": 30, "3": 25, "8": 18, "15": 16}
                        },
                        {
                            "2": {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "3": {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "4": {"1": 35, "3": 30, "8": 27, "15": 25}
                        }
                    ],
                    deposit: [
                        {
                            id: 1,
                            description: '',
                            deposit: 300,
                            excess: 800
                        }
                    ]
                },
                {
                    id: 11,
                    name: 'NISSAN NOTE',
                    image: '/assets/img/cars/note/2.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/note/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/8.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/9.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/10.jpg'
                        },

                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 3],
                    price: 30,
                    prices: [
                        {
                            "1": {"1": 30, "3": 25, "8": 18, "15": 16}
                        },
                        {
                            "2": {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "3": {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "4": {"1": 35, "3": 30, "8": 27, "15": 25}
                        }
                    ],
                    deposit: [
                        {
                            id: 1,
                            description: '',
                            deposit: 300,
                            excess: 800
                        }
                    ]
                },
                {
                    id: 12,
                    name: 'NISSAN NOTE',
                    image: '/assets/img/cars/note/3.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/note/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/8.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/9.jpg'
                        },
                        {
                            src: '/assets/img/cars/note/10.jpg'
                        },

                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 3],
                    price: 30,
                    prices: [
                        {
                            "1": {"1": 30, "3": 25, "8": 18, "15": 16}
                        },
                        {
                            "2": {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "3": {"1": 35, "3": 27, "8": 25, "15": 23}
                        },
                        {
                            "4": {"1": 35, "3": 30, "8": 27, "15": 25}
                        }
                    ],
                    deposit: [
                        {
                            id: 1,
                            description: '',
                            deposit: 300,
                            excess: 800
                        }
                    ]
                },
                {
                    id: 2,
                    name: 'NISSAN LATIO',
                    image: '/assets/img/cars/latio/9.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/latio/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/8.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/9.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 3],
                    price: 35,
                    prices: [
                        {
                            "1": {"1": 35, "3": 30, "8": 25, "15": 20}
                        },
                        {
                            "2": {"1": 45, "3": 40, "8": 35, "15": 30}
                        },
                        {
                            "3": {"1": 45, "3": 40, "8": 35, "15": 30}
                        },
                        {
                            "4": {"1": 55, "3": 45, "8": 40, "15": 35}
                        }
                    ]
                },
                {
                    id: 22,
                    name: 'NISSAN LATIO',
                    image: '/assets/img/cars/latio/2.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/latio/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/8.jpg'
                        },
                        {
                            src: '/assets/img/cars/latio/9.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 3],
                    price: 35,
                    prices: [
                        {
                            "1": {"1": 35, "3": 30, "8": 25, "15": 20}
                        },
                        {
                            "2": {"1": 45, "3": 40, "8": 35, "15": 30}
                        },
                        {
                            "3": {"1": 45, "3": 40, "8": 35, "15": 30}
                        },
                        {
                            "4": {"1": 55, "3": 45, "8": 40, "15": 35}
                        }
                    ]
                },
                {
                    id: 3,
                    name: 'TOYOTA SIENTA',
                    image: '/assets/img/cars/sienta/1.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/sienta/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/sienta/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/sienta/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/sienta/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/sienta/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/sienta/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/sienta/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/sienta/8.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 4,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 2],
                    price: 55,
                    prices: [
                        {
                            "1": {"1": 55, "3": 50, "8": 45, "15": 40}
                        },
                        {
                            "2": {"1": 65, "3": 60, "8": 55, "15": 53}
                        },
                        {
                            "3": {"1": 65, "3": 60, "8": 55, "15": 53}
                        },
                        {
                            "4": {"1": 70, "3": 65, "8": 60, "15": 55}
                        }
                    ]
                },
                {
                    id: 4,
                    name: 'NISSAN JUKE',
                    image: '/assets/img/cars/juke/4.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/juke/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/8.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/9.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/10.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/11.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 2],
                    price: 50,
                    prices: [
                        {
                            "1": {"1": 50, "3": 40, "8": 35, "15": 30}
                        },
                        {
                            "2": {"1": 60, "3": 55, "8": 50, "15": 45}
                        },
                        {
                            "3": {"1": 60, "3": 55, "8": 50, "15": 45}
                        },
                        {
                            "4": {"1": 75, "3": 60, "8": 55, "15": 50}
                        }
                    ]
                },
                {
                    id: 44,
                    name: 'NISSAN JUKE',
                    image: '/assets/img/cars/juke/5.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/juke/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/8.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/9.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/10.jpg'
                        },
                        {
                            src: '/assets/img/cars/juke/11.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 2],
                    price: 50,
                    prices: [
                        {
                            "1": {"1": 50, "3": 40, "8": 35, "15": 30}
                        },
                        {
                            "2": {"1": 60, "3": 55, "8": 50, "15": 45}
                        },
                        {
                            "3": {"1": 60, "3": 55, "8": 50, "15": 45}
                        },
                        {
                            "4": {"1": 75, "3": 60, "8": 55, "15": 50}
                        }
                    ]
                },
                {
                    id: 5,
                    name: 'NISSAN MICRA',
                    image: '/assets/img/cars/march/7.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/march/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/march/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/march/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/march/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/march/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/march/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/march/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/march/8.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 4,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 3],
                    price: 27,
                    prices: [
                        {
                            "1": {"1": 27, "3": 25, "8": 17, "15": 15}
                        },
                        {
                            "2": {"1": 35, "3": 30, "8": 23, "15": 20}
                        },
                        {
                            "3": {"1": 35, "3": 30, "8": 23, "15": 20}
                        },
                        {
                            "4": {"1": 35, "3": 30, "8": 25, "15": 23}
                        }
                    ]
                },
                {
                    id: 6,
                    name: 'NISSAN SERENA',
                    image: '/assets/img/cars/serena/6.jpg',
                    images: [
                        {
                            src: '/assets/img/cars/serena/1.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/2.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/3.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/4.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/5.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/6.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/7.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/8.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/9.jpg'
                        },
                        {
                            src: '/assets/img/cars/serena/10.jpg'
                        },
                    ],
                    description: 'Great way and chipiest! For a little family',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1, 2],
                    price: 50,
                    prices: [
                        {
                            "1": {"1": 50, "3": 40, "8": 35, "15": 30}
                        },
                        {
                            "2": {"1": 60, "3": 55, "8": 50, "15": 45}
                        },
                        {
                            "3": {"1": 100, "3": 80, "8": 65, "15": 60}
                        },
                        {
                            "4": {"1": 100, "3": 80, "8": 70, "15": 65}
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
            ],
            priceSeasons: [
                {
                    "id": 1,
                    "name": "Low season (1 Nov - 1 Apr)",
                    "start": "2016/11/01",
                    "end": "2017/04/01"
                },
                {
                    "id": 2,
                    "name": "Medium season (1 Apr - 1 Jul)",
                    "start": "2016/04/01",
                    "end": "2016/07/01"
                },
                {
                    "id": 3,
                    "name": "Medium season (1 Oct - 1 Nov)",
                    "start": "2016/10/01",
                    "end": "2016/11/01"
                },
                {
                    "id": 4,
                    "name": "High season (1 Jul - 1 Oct)",
                    "start": "2016/07/01",
                    "end": "2016/10/01"
                }
            ],
            AddItems: [
                {
                    id: 1,
                    name: 'Baby seats or booster',
                    price: 3,
                    deposit: 0
                },
                {
                    id: 2,
                    name: 'GPS Navigator',
                    price: 5,
                    deposit: 100
                },
                {
                    id: 3,
                    name: 'Car Video Recorder',
                    price: 5,
                    deposit: 50
                },
                {
                    id: 4,
                    name: 'Wi-Fi',
                    price: 7,
                    deposit: 50
                },
                {
                    id: 5,
                    name: 'Camera "Xiaomi"',
                    price: 5,
                    deposit: 50
                },
                {
                    id: 6,
                    name: 'Walky-Talky (radio)',
                    price: 3,
                    deposit: 0
                },
                {
                    id: 7,
                    name: 'Converter',
                    price: 1,
                    deposit: 0
                },
                {
                    id: 8,
                    name: 'Refrigerator',
                    price: 3,
                    deposit: 0
                },
                {
                    id: 9,
                    name: 'Usb-Adapter',
                    price: 1,
                    deposit: 0
                },
                {
                    id: 10,
                    name: 'Telephone Holder',
                    price: 1,
                    deposit: 0
                },
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
            deposit: String,
            additional: [],
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
            return response.send({
                AddItems: staticData.AddItems
            });
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
                deposit: request.body.deposit,
                additional: request.body.additional,
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
                            if (orders.length > 0) {
                                response.send({
                                    orders: orders,
                                    cars: staticData.cars,
                                    additionalOptions: staticData.AddItems
                                });
                            }
                        })
                    }
                }

            });
        });
        app.get('/adminorders', function (request, response) {
            var localData = cookie.parse(request.headers.cookie || '');
            return UsersSchema.find(null, function (err, user) {
                for (var i = 0; i < user.length; i++) {

                    ordersSchema.find(null, function (err, orders) {
                        if (orders.length > 0) {
                            response.send({
                                users: user,
                                orders: orders,
                                cars: staticData.cars,
                                additionalOptions: staticData.AddItems
                            });
                        }
                    })

                }

            });
        });
        app.post('/search', function (request, response) {
            return UsersSchema.find(null, function (err, user) {
                ordersSchema.find(null, function (err, orders) {
                    response.send({
                        orders: orders
                    });
                })
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