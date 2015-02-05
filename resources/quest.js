define([
    'app',
    'backbone',
    'marionette',
    'jquery',
    'text!modules/performed/templates/quest.html',
    'audioModel',
    'channelManager',
    'backbone.syphon',
    'mod-audio'
], function (app, Backbone, Marionette, $, template, audioModel, channelManager) {
    'use strict';

    return Marionette.ItemView.extend({
        template: template,
        ui: {
            form: 'form',
            questVoice: '.control-quest-voice',
            next: '.control-next',
            answer: '.control-answer',
            variant: '.answer-variant',
            radio: '.answer-variant-radio',
            checkbox: '.answer-variant-checkbox',
            'answersVoice': '.answers-voice'
        },
        triggers: {
            //'click @ui.next': 'show:next'
        },
        events: {
            'click @ui.questVoice': 'questVoicePlay',
            'click @ui.next': 'next',
            'click @ui.answer': 'check',
            'mouseenter @ui.answer': 'hoverAnswer',
            'submit @ui.form': 'check',
            'click @ui.radio': 'updateRadio',
            'click @ui.checkbox': 'updateCheckbox',
            'mouseenter @ui.variant': 'hoverVariant',
            'click @ui.answersVoice': 'answersVoicePlay'
            //'click @ui.variant': 'checked'
        },
        questVoiceModel: undefined,
        performedModel: undefined,
        answersVoice: new Backbone.Collection,
        initialize: function (options) {
            // запуск озвучек
            var self = this;
            $(document).scrollTop($('.performed-content').offset().top - 5);

            this.performedModel = options.performedModel;
            channelManager.resetChannel('Quest');

            var quest = this.model.get('quest');
            if (quest.voice) {
                this.questVoiceModel = new audioModel({
                    src: quest.voice
                });
                if (app.request('config', 'audioAutoPlay')) {
                    this.questVoicePlay();
                }
            }

            if (self.model.get('answer').type == 4) {  // для перетаскивалок подгрузить драйвер
                require(['modules/performed/drivers/drag'], function (dragDriver) {
                    new dragDriver({
                        'dragElements': '.drag',
                        'targetElements': 'img',
                        'sensitive': 10, // чувствительность точности расположения на таргет элементе
                        'answers': self.model.get('answers')
                    });
                    app.execute("Drag:on");
                });
            }
        },
        onShow: function () {
            if (this.$('.iq_field').length > 0) {
                this.$('.iq_field').each(function () {
                    var dom = null;
                    /* dom = $('input[name=a' + $(this).data('id') + ']:not(.answer-field)').parents(".input-box");*/
                    // if (dom.length == 0) {
                    dom = $('input[name=a' + $(this).data('id') + ']:not(.answer-field)').parents(".input-box-absolute");
                    // }
                    dom.addClass('answer-field');
                    $(this).replaceWith(dom);
                });
                if (this.$(".input-box").length == 0) {
                    this.$(".answers").hide();
                }
            }
            this.$("input[type=text]:first").focus(); // поставить фокус в первое поле (если такое найдется)
            app.vent.trigger("Performed:showed");
        },
        hoverAnswer: function () {
            app.vent.trigger("bgAudio:hoverAnswer");
        },
        hoverVariant: function () {
            app.vent.trigger("bgAudio:hoverVariant");
        },
        questVoicePlay: function () {
            if (this.questVoiceModel) {
                //app.execute("Audio:Track:add", {from: 'Quest', track: this.questVoiceModel});
                channelManager.addTrack({'from': 'Quest', track: this.questVoiceModel});
            }
        },
        answersVoicePlay: function (e) {
            e.preventDefault();
            this.answersVoice.each(function (item) {
                if (item.nodeID() == $(e.currentTarget).attr('id')) {
                    channelManager.addTrack({
                        'from': 'answersVoice',
                        'track': item
                    });
                }
            });
        },
        next: function (e) {
            e.preventDefault();
            if (this.performedModel.isLimitUsed()) {
                return;
            }
            channelManager.resetChannel('Quest');
            this.model.set({
                result: {valid: true}
            });
            this.trigger('answer:next');
        },
        check: function (e) {
            e.preventDefault();
            channelManager.resetChannel('Quest');
            //app.execute("Audio:Track:reset", {from: 'Quest'});
            if (this.performedModel.isLimitUsed()) {
                return;
            }

            var valid = 0,
                formData = Backbone.Syphon.serialize(this),
                answerParam = this.model.get('answer'),
                answerResult = [],
                answers = this.model.get('answers');

            // радио
            if (answerParam.type == 1) {
                var answer = _.find(answers, function (item) {
                    return item.id == formData.answer_value;
                });
                valid = (answer && answer.value);

                answerResult = _.map(answers, function (item) {
                    return {
                        id: item.id,
                        value: item.id == formData.answer_value ? 1 : 0
                    };
                });
            }
            else if (answerParam.type == 2) {
                valid = 1;
                for (var i = 0; i < answers.length; i++) {
                    var answer = answers[i];
                    if (answer.value != formData['a' + answer.id]) {
                        valid = 0;
                        break;
                    }
                }

                answerResult = _.map(answers, function (item) {
                    return {
                        id: item.id,
                        value: formData['a' + item.id] ? 1 : 0
                    };
                });
            }
            else if (answerParam.type == 3) {
                valid = 1;
                for (var i = 0; i < answers.length; i++) {
                    var answer = answers[i];
                    // проверка с удалением пробелов и приведением к строке
                    if ($.trim(answer.value).toLowerCase() != $.trim(formData['a' + answer.id]).toLowerCase()) {
                        valid = 0;
                        break;
                    }
                }

                answerResult = _.map(answers, function (item) {
                    return {
                        id: item.id,
                        value: formData['a' + item.id]
                    };
                });
            }
            else if (answerParam.type == 4) { // сравнить пути в перетаскивалках
                valid = 1;
                for (var i = 0; i < answers.length; i++) {
                    var answer = answers[i], params = JSON.parse(answer.value);
                    if (_.where(params, {'dragtarget': formData['a' + answer.id]}).length == 0 &&
                        _.where(params, {'dragtarget': 'isEmpty'}).length == 0) {
                        valid = 0;
                    }
                    /*if ("/upload/lib/" + answer.value != formData['a' + answer.id]) {
                     valid = 0;
                     break;
                     }*/
                }

                answerResult = _.map(answers, function (item) {
                    return {
                        id: item.id,
                        value: formData['a' + item.id]
                    };
                });
            }

            this.model.set({
                result: _.extend(formData, {
                    valid: !!valid,
                    // для запоминания порядка вариантов ответов в вопросах с перемешиванием.
                    answers: answerResult
                })
            });

            if (valid) {
                this.trigger('answer:correctly');
            }
            else {
                this.trigger('answer:incorrectly');
            }
        },
        updateCheckbox: function (e) {
            app.vent.trigger("bgAudio:chooseVariant");
            var node = $(e.currentTarget),
                input = node.find('input');
            if (input.prop('checked')) {
                input.prop({checked: false});
                node.removeClass('active');
            } else {
                input.prop({checked: true});
                node.addClass('active');
            }
        },
        updateRadio: function (e) {
            app.vent.trigger("bgAudio:chooseVariant");
            var node = $(e.currentTarget);
            this.$(this.ui.variant).removeClass('active');
            node.addClass('active');
            node.find('input').prop({checked: true});
        },
        checked: function (e) {
            $(['.answer-variant [type=radio], .answer-variant [type=checkbox]'], $(this.ui.answer)).each(function (i) {
                var $input = $(this);
                if ($input.prop('checked')) {
                    $input.parents('.answer-variant').addClass('active');
                } else {
                    $input.parents('.answer-variant').removeClass('active');
                }
            });
        },
        templateHelpers: function () {
            var self = this;
            return {
                questVoiceID: function () {
                    return self.questVoiceModel.nodeID();
                },
                answersVoiceID: function (item) {
                    var audio = new audioModel({
                        'src': {'mp3': item.voice.mp3, 'ogg': item.voice.ogg}
                    })
                    self.answersVoice.add(audio);
                    return audio.nodeID();
                },
                inputBoxClass: function (item) {
                    if (item.position.type == 1) {
                        return 'input-box-absolute';
                    }
                    return 'input-box';
                },
                inputBoxStyle: function (item) {
                    if (item.position.type == 1) {
                        return 'top:' + item.position.top + 'px;' +
                        'left:' + item.position.left + 'px;' +
                        'z-index:' + item.position.zindex + ';';
                    }
                    return '';
                },
                inputTextClass: function (item) {
                    if (item.size.type == 0) {
                        return 'short';
                    } else if (item.size.type == 1) {
                        return 'long';
                    }
                    return '';
                },
                inputTextStyle: function (item) {
                    if (item.size.type == 2) {
                        return 'width:' + item.size.width + 'px;font-size:' + item.size.font + 'px;';
                    }
                    return '';
                },
                controlState: function () {
                    return self.performedModel.isLimitUsed() ? 'disabled' : '';
                },
                limitNotice: function () {
                    return self.performedModel.noticeButtonLimit();
                }
            }
        }
    });

});