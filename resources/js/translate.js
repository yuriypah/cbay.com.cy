var Translate = {
    settings: {
        url: 'https://translate.yandex.net/api/v1.5/tr.json/translate',
        key: 'trnsl.1.1.20141001T101444Z.27ed285051ab0be5.b004c4e3bd49171b8d3910e22316ac1dde340faa'

    },
    translatePanel: function (handle) {
        $(".translatePanel").remove();
        $(
            "<div/>",
            {
                'class': 'translatePanel',
                'style': 'position:fixed;bottom:0;left:0;padding:0px;background:#dddddd;width:100%',
                'html': "<h5 style='cursor:pointer;background:gray;color:white;margin:0 auto;text-align:center;' class='toggle_translate'>Переводчик</h5><div style='" + (window.sessionStorage.getItem('translate_state')== '1' ? 'display:block' : 'display:none') + "' class='toggle_translate_table'><br/><table><tr>"
                + "<td style='vertical-align:top;white-space:nowrap'>"
                + "<input type='radio' name='from' data-l='ru' id='radio_from_ru' /><label style='display:inline-block' for='radio_from_ru'>С русского</label><Br/>"
                + "<input type='radio' name='from' data-l='en' id='radio_from_en'/><label  style='display:inline-block' for='radio_from_en'>С Английского</label><br/>"
                + "<input type='radio' name='from' data-l='el' id='radio_from_el'/><label  style='display:inline-block' for='radio_from_el'>С Греческого</label><br/>"
                + "<input type='radio' name='from' data-l='zh' id='radio_from_zh'/><label  style='display:inline-block' for='radio_from_zh'>С китайского</label><br/>"
                + "</td>"
                + "<td style='vertical-align:top'><textarea style='width:450px;height:65px;' class='start_text'></textarea></td>"
                + "<td style='vertical-align:top;white-space:nowrap'>"
                + "<input type='radio' name='to' data-l='ru' id='radio_to_ru' /><label style='display:inline-block' for='radio_to_ru'>На русский</label><Br/>"
                + "<input type='radio' name='to' data-l='en' id='radio_to_en'/><label  style='display:inline-block' for='radio_to_en'>На английский</label><br/>"
                + "<input type='radio' name='to' data-l='el' id='radio_to_el'/><label  style='display:inline-block' for='radio_to_el'>На греческий</label><br/>"
                + "<input type='radio' name='to' data-l='zh' id='radio_to_zh'/><label  style='display:inline-block' for='radio_to_zh'>На китайский</label><br/>"
                + "</td>"
                + "<td style='vertical-align:top;padding-left:50px;'><h4>Результат:</h4><div class='result'></div></td></tr></table></div>"
            }).appendTo(handle ? handle : 'body');
        $("input[name=from],input[name=to]").change(function () {
            Translate.update();
        });
        $(".start_text").keyup(function () {
            Translate.update();
        });
        $(".start_text").blur(function () {

            Translate.update();
        });

        $(".toggle_translate").click(function() {
            if($(".toggle_translate_table").is(":visible")) {
                window.sessionStorage.setItem('translate_state',0);
            } else {
                window.sessionStorage.setItem('translate_state',1);
            }
            $('.toggle_translate_table').slideToggle();



        })
    },
    update: function () {
        $(".result").text(Translate.start(
            $("input[name=from]:checked").data('l'),
            $("input[name=to]:checked").data('l'),
            $(".start_text").val()));
    },
    start: function (langFrom, langTo, text) {
        var resultText = '';
        if (langFrom == undefined || langTo == undefined || text == undefined || text == '') {
            return;
        }
        var query = $.ajax({
            url: 'https://translate.yandex.net/api/v1.5/tr.json/translate',
            data: {
                'key': Translate.settings.key,
                'lang': langFrom + '-' + langTo,
                'text': text
            },
            dataType: 'json',
            async: false
        }).done(function (data) {
            resultText = data.text[0];
        });
        return resultText;
    },
    openRedactor : function(o) {
        if(o.value == 'html') {
            $(o).parents("td").find("textarea").redactor({
                imageUpload: "/backend/settings/imageupload",
                imageGetJson: "/backend/settings/getimages",
                keyupCallback : function() {
                   setTimeout(function() {
                       $(o).parents("td").find("textarea").change();
                   },300)

                }
            });
            $(".redactor_box").resizable();
        } else {
            $(o).parents("td").find("textarea").destroyEditor();
        }
    }
};
var TranslateActions = {
    'addkey': function () {
        $.ajax({
            url: '/backend/settings/addkey',
            type: 'post',
            dataType: 'json',
            data: {
                'key': $('[name=t_key]').val(),
                'category': $('[name=t_category]').val(),
                'desc': $('[name=t_desc]').val()
            }
        }).done(function (data) {
            if (data.status == 1) {
                window.location.reload();
            } else {
                alert('Ошибка. Не заполнены поля');
            }
        });
    },
    get: function (obj) {
        var key = $(obj).data("category");
        $('.selectGroup').removeClass('active');
        $(obj).addClass('active');
        $.ajax({
            'beforeSend': function () {
                $.fancybox.showLoading();
            },
            'url': '/backend/settings/translate',
            'type': 'post',
            data: {
                'category': key
            },
            dataType: 'json'
        }).done(function (data) {
            $("[name=t_category]").val(data.header);
            $.fancybox.hideLoading();
            $('.groupHeader').html(data.header);
            $('.groupContent').html(data.content);
        });
    },
    set: function (obj) {
        var id = $(obj).data('id');
        $.ajax({
            'url': '/backend/settings/langupdate',
            'beforeSend': function () {
                $.fancybox.showLoading();
            },
            data: {
                'id': id,
                'lang': $(obj).data('name'),
                'value': $(obj).val()
            },
            type: 'post'
        }).done(function () {
            $.fancybox.hideLoading();
        });
    },
    save: function () {
        $.ajax({
            'beforeSend': function () {
                $.fancybox.showLoading();
            },
            url: '/backend/settings/langsave'
        }).done(function () {
            $.fancybox.hideLoading();
        });
    },
    removeKey: function (obj) {
        var conf = confirm('Текстовая переменная будет удалена. Продолжить?');
        if (conf) {
            $.ajax({
                'url': '/backend/settings/removekey',
                'type': 'post',
                data: {
                    'id': $(obj).data('id')
                }
            }).done(function () {
                $(obj).parents('tr').remove();
                if ($('.groupContent tr').length == 0) {
                    window.location.reload();
                }
            });
        }
    }
}