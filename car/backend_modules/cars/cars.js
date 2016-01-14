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
                    name: 'BMW X5',
                    image: '/assets/img/test_cars/bmv_x5.jpg',
                    images: [
                        {
                            src: '/assets/img/test_cars/bmv_x5.jpg'
                        },
                        {
                            src: '/assets/img/test_cars/bmv_x5.jpg'
                        },
                        {
                            src: '/assets/img/test_cars/bmv_x5.jpg'
                        },
                        {
                            src: '/assets/img/test_cars/bmv_x5.jpg'
                        }],
                    description: 'This car have been everything completely.. When you going to choose a car.',
                    rating: 5,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1],
                    price: 1390
                },
                {
                    id: 2,
                    name: 'BMW A320',
                    image: '/assets/img/test_cars/bmv_320.jpg',
                    images: [
                        {
                            src: '/assets/img/test_cars/bmv_320.jpg'
                        },
                        {
                            src: '/assets/img/test_cars/bmv_320.jpg'
                        },
                        {
                            src: '/assets/img/test_cars/bmv_320.jpg'
                        },
                        {
                            src: '/assets/img/test_cars/bmv_320.jpg'
                        }],
                    description: 'This car have been everything completely.. When you going to choose a car.',
                    rating: 4,
                    properties: [1, 2, 3, 4, 5, 6],
                    category: [1],
                    price: 1090
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
                    value: '69',
                    shortValue: '69',
                    shortDescription: 'Liked users : 69',
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