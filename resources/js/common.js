Core.init.add(['body_advert_place', 'body_advert_edit'], function () {
    $("#upload").html5_upload({
        url: '/ajax-file-upload',
        sendBoundary: true,
        onStart: function () {
            return true;
        },
        onProgress: function (event, progress, name, number, total) {
            $('#upload').hide();
            $('#upload_preloader').fadeIn();
            $('.form-actions button').attr('disabled', 'disabled');
        },
        onFinishOne: function (event, response, name, number, total) {
            $.event.trigger("ajaxComplete", [{responseText: response}]);
            var json = $.parseJSON(response);
            $('#thumbnail').tmpl(json).appendTo('.thumbnails ul');
        },
        onFinish: function (event, response, name, number, total) {
            $('#upload').show();
            $('#upload_preloader').hide();
            $('.form-actions button').removeAttr('disabled');

            $(".image-selector").click(function () {
                $(".image-selected").removeClass('image-selected');
                $(this).addClass('image-selected');
                var path = $(this).find('input').val();
                var image = path.split('/');
                $("#main_image").val(image[image.length - 1]);
            });
            if ($(".image-selected").length == 0) {
                $(".image-selector").trigger('click');
            }
        }
    });

    $('.thumbnails .delete').live('click', function () {
        var thumb = $(this).parent();
        var file = thumb.find('img').data('path');

        $.post('/ajax-file-delete', {path: file}, function (response) {
            if (response.status) {
                thumb.fadeOut(function () {
                    $(this).remove();
                });
            }
        }, 'json')

        return false;
    });

//	Core.filters.switchOn('description', 'tinymce');
});

Core.init.add('body_index', function () {
    $('.digital-nums').digitalPanel();

    $('#lands-list a').hover(function () {
        var rel_id = $(this).data('id');
        $('#point-' + rel_id).css({
            top: "+=5"
        });
        island_hover(rel_id);
    }, function () {
        var rel_id = $(this).data('id');
        $('#point-' + rel_id).css({
            top: "-=5"
        });

        $('#island').attr('src', '/resources/images/island/0.png');
    });

    $('#lands-points .point').hover(function () {
        var rel_id = $(this).attr('id').substr(6);
        island_hover(rel_id);
    }, function () {
        var rel_id = $(this).attr('id').substr(6);
        $('#island').attr('src', '/resources/images/island/0.png');
    });

    $('#islandmap-cont area').mouseover(function () {
        var id = $(this).attr('id').substr(10);
        island_hover(id);
    }).mouseout(function () {
        $('#island').attr('src', '/resources/images/island/0.png');
    })

    footer_links_center();
});

var island_hover = function (id) {
    var img = $('#island');
    var src = '/resources/images/island/0.png';
    switch (id) {
        case 'all':
            src = '/resources/images/island/all.png';
            break;
        case 'nicosia':
            src = '/resources/images/island/6.png';
            break;
        case 'limassol':
        case 'troodos':
            src = '/resources/images/island/4.png';
            break;
        case 'larnaca':
            src = '/resources/images/island/3.png';
            break;
        case 'agia_napa':
        case 'protaras':
        case 'paralimni':
        case 'famagusta':
            src = '/resources/images/island/1.png';
            break;
        case 'kyrenia':
            src = '/resources/images/island/7.png';
            break;
        case 'paphos':
        case 'polis':
            src = '/resources/images/island/2.png';
            break;
    }

    $('#island').attr('src', src);
}

Core.init.add('body_adverts_view', function () {
    var images_cont = $('#advert-images');
    var opt_cont = $('#advert-options');

    $(document).bind('advert-form-send', function (e, resp, form) {
        if (resp.status == true) {
            $('#options-form-container').empty().hide();
        }
    });

    $('.image-small a.image-anchor', images_cont).click(function () {
        set_big_img($(this));

        return false;
    });

    function set_big_img($element) {
        var image = media_uri + '/510_410/' + $element.data('preview'),
            full_image = media_uri + '/full/' + $element.data('preview');

        $('.image-big .big-img-conteiner', images_cont)
            //.attr('src', image)
            .css({'background': 'url(' + image + ') 50% 0'})
            .parent()
            .attr('href', full_image);

        var divs = $('.image-small', images_cont)
            .removeClass('current')
            .find('.overlay')
            .remove();

        $element
            .parent()
            .addClass('current')
            .append('<div class="overlay" />');
    }

    $('.image-big .big-img-conteiner').click(function () {
        $('.current a').trigger('click.fb-start');
    });

    $(".fancybox").fancybox({
        helpers: {
            title: {
                type: 'inside'
            }
        },
        afterShow: function (obj) {
            set_big_img($(this.element));
        }
    });

    $('#show_phone').click(function () {
        var phone = $(this).data('phone');
        $.post('/ajax-advert-phone', {phone: phone}, function (response) {
            if (response.status) {
                var phone = $('<img />', {src: '/adverts/phone/'})
                $('#phone_container')
                    .empty()
                    .html(phone);
            }
        }, 'json')

        $(this).parent().prev().empty();
        $(this).remove();

        return false;
    });

    $('.add-to-bookmarks', opt_cont).click(function () {
        var anchor = $(this);
        $.post('/ajax-bookmark-set', {object_id: advert_id, object_name: 'advert'}, function (response) {
            if (response.status) {

                if (response.bookmark_status)
                    anchor
                        .text(I18n.advert_options.remove_bookmarks)
                        .addClass('added');
                else
                    anchor
                        .text(I18n.advert_options.add_bookmarks)
                        .removeClass('added');
            }
        }, 'json');

        return false;
    });

    $('.option', opt_cont).click(function () {
        $.fancybox.showLoading();
        var link = '/ajax-form-';
        var self = $(this);
        if (self.hasClass('mail-to-user'))
            link += 'message';
        else if (self.hasClass('mail-to-friend'))
            link += 'sendfriend';
        else if (self.hasClass('report'))
            link += 'abuse';
        else
            return false;
        $.post(link, {advert_id: advert_id}, function (response) {
            $.fancybox.hideLoading()
            $('#options-form-container')
                .empty()
                .html(response)
                .show();
        });

        return false;
    });

    $('#send_email_to_seller').click(function () {
        $('.mail-to-user', opt_cont).click();
    });
});

Core.init.add('body_bookmarks_index', function () {
    $('#chkAll').change(function () {
        var input = $('#adverts-list .chbox input');
        if ($(this).is(':checked')) {
            input.attr('checked', 'checked');
        } else {
            input.removeAttr('checked');
        }
    });

    $('#adverts-list .chbox input').change(function () {
        var cont = $('#adverts-list .chbox');
        var checked = $('input:checked', cont).length;
        var total = $('input', cont).length;
        var input_all = $('#chkAll');

        if (checked == total) {
            input_all.attr('checked', 'checked');
        } else {
            input_all.removeAttr('checked');
        }
    });

    $('#delSelected').click(function () {
        var adverts = $('#adverts-list input:checked');
        var ids = [];
        $.each(adverts, function () {
            ids.push($(this).val());
        })

        $.post('/ajax-bookmark-delete', {ids: ids, object_name: 'advert'}, function (response) {
            if (response.status) {
                window.location = '';
            }
        }, 'json');

        return false;
    });

    $('.del-from-bookmark').click(function () {
        var id = parseInt($(this).parent().parent().data('id'));

        $.post('/ajax-bookmark-delete', {ids: [id], object_name: 'advert'}, function (response) {
            if (response.status) {
                window.location = '';
            }
        }, 'json');

        return false;
    });
});

Core.init.add('body_backend_plugins_index', function () {
    $('#plugins .change-status').on('change', function () {
        var tr = $(this).parent().parent(),
            id = tr.attr('id'),
            status = $(this).checked() ? 1 : 0;

        $.post('/ajax-plugin-status', {id: id, status: status}, function (request) {
            if (!request.status)
                return;

            tr.replaceWith(request.html)
        }, 'json');
    })
});

Core.init.add('body_profile_ended', function () {

    $('.advert_prolong').click(function () {
        var $cont = $(this).parent().parent().parent().parent();
        var id = parseInt($cont.data('id'));
        $.post('/ajax-advert-activate', {id: id}, function (request) {
            if (!request.status)
                return;
        }, 'json');

        return false;
    });
});

Core.init.add('body_profile_index', function () {

    $('.advert_prolong').click(function () {
        var $cont = $(this).parent().parent().parent().parent();
        var id = parseInt($cont.data('id'));
        $.post('/ajax-advert-activate', {id: id}, function (request) {
            if (!request.status)
                return;
        }, 'json');

        return false;
    });

    $('#chkAll').change(function () {
        var input = $('#adverts-list .chbox input');
        if ($(this).is(':checked')) {
            input.attr('checked', 'checked');
        } else {
            input.removeAttr('checked');
        }
    });

    $('#unpublishSelected').click(function () {
        var inputs = $('#adverts-list .item .chbox input:checked');
        var $ids = [];
        $.each(inputs, function () {
            $ids.push($(this).parent().parent().data('id'));
        })

        $.post('/ajax-advert-deactivate', {ids: $ids}, function (request) {
            if (!request.status)
                return;
        }, 'json');
    })
});

Core.init.add('body_messages_view', function () {
    Core.filters.switchOn('message', 'tinymce');
})

Core.init.add(['body_backend_options_edit', 'body_backend_options_add'], function () {

    $("#add-value").click(function () {
        $.get('/form-values-add/' + $option_id, function (req) {
            $(req).appendTo('#option-values tbody');
        })
        return false;
    });

    $('a.delete-value').live('click', function () {
        var cont = $(this).parent().parent(),
            id = cont.data('id');
        if (id == undefined) {
            cont.remove();
            return;
        }

        $.get('/form-values-delete/' + id, function (req) {
            if (req.status == true) {
                cont.remove();
            }
        }, 'json')
        return false;
    });

});

$(function () {
    $('.button').button();
    remove_separator($('#header-menu li.current'));
    remove_separator($('#sub-menu li.current'));
    $("input[name='type']").change(function () {
        if ($(this).val() == 1) {
            $(".control-label[for='name']").text("Ваше имя");
        } else {
            $(".control-label[for='name']").text("Наименование компании");
        }
    });
});


var showSearchOptions = function () {
    var box = $("#search_filters");
    var button = $("#show-search-add");
    if (box.is(":visible")) {
        box.slideUp(200);
        button.val(search.hide_show);
    } else {
        box.slideDown(200);
        button.val(search.hide_lable);
    }
}

// Центрирование меню подвала на главной странице
var footer_links_center = function () {
    var footer = $('#footer-index');
    $('.links', footer).css('margin-left', (footer.width() - $('.links', footer).width()) / 2);
}


// Удаление разделителей до и после текущего пунтка меню
var remove_separator = function (cont) {
    var li = cont;
    var prev = li.prev();
    var next = li.next();

    if (prev.hasClass('separator')) prev.remove();
    if (next.hasClass('separator')) next.remove();
}


/* DEMO::*/
var inner = [];

/* DEMO::*/
function get_child(sel) {
    var idFnew = sel.id;
    if (idFnew == 'option_2') {
        $("#period").hide();
        if (sel.value == 4 || sel.value == 5)
            $("#period").show();
    }
    $('#option_' + idFnew).parents('.control-group').remove();
    if (inner[sel.value] == null) return;
    var of = option_switch(inner[sel.value], idFnew, inner[sel.value].values[0].option_id);
    $(sel).parents('.control-group').after(of);
}

/* DEMO::*/
function category_select(one_category_id) {

    $('#categoryoptions').empty();
    if (one_category_id == null) {
        var category_id = $('#category_id').val();
    }
    else {
        var category_id = one_category_id;
    }
    if (category_id == false) return false;
    var data = JSON.parse($DATA);
    var options_ids = (data.categories[category_id] || {}).options;
    if (!options_ids) {
        return;
    }
    $('#period').empty();
    $('#period').hide();
    $.each(options_ids, function (key, options_id) {
        inner[data.options[options_id].parent_id] = data.options[options_id];
        if (data.options[options_id].parent_id != null) return;
        var of = option_switch(data.options[options_id], options_id);
        //для селекта периода возле цены ->>/
        if (options_id == 170) {
            $('#period').append(of);
        } else {
            //->>end/
            $('#categoryoptions').append(of);
        }
    });
    if (typeof cat_options != "undefined" && cat_options != '') {
        var cat_options_array = JSON.parse(cat_options);
        var it;
        $.each(cat_options_array, function (o, v) {
            it = $("select#option_" + o + " [value='" + v + "']");
            if (it.length > 0) {
                return it.attr("selected", "selected");
            }
            it = $("input[type=radio][value='" + v + "']");
            if (it.length > 0) {
                return it.attr("checked", "checked");
            }
            it = $("input#option_" + o + "");
            if (it.length > 0) {
                return it.attr("value", v);
            }
        });
    }
//    if(disbl) $('#categoryoptions select, input').attr('disabled','disabled');
    /*    if(option_selected){
     var selected = JSON.parse(option_selected);
     $.each(selected, function(key, selected_val) {
     //            $("[name=option["+key+"]]").attr("selected", "selected");
     //            $('#categoryoptions select[name=option['+key+']] option[value='+selected_val+']').attr('selcted','selcted');
     });
     }*/
    setTimeout(function () {
        $(".form_item").each(function () {
            var self = this;
            if ($(this).data('ranged') == 2) {
                var sliderRange = $("<div/>", {
                    'class': 'slider_range',
                    width: $(self).find("input[type=text]").width() + 8
                }).appendTo(this);
                var rMin = $(this).data('rangedmin'), rMax = $(this).data('rangedmax'),
                    input = $(self).find("input[type=text]");
                if (input.val() == '' || input.val() == 'undefined') {
                    input.val((rMin + (rMax / 10)) + " - " + (rMax - (rMax / 10)))
                }
                sliderRange.slider({
                    range: true,
                    min: rMin,
                    max: rMax,
                    step: 10,
                    animate: 'slow',
                    values: [rMin + (rMax / 10), rMax - (rMax / 10)],
                    slide: function (event, ui) {
                        input.val(ui.values[0] + " - " + ui.values[1]);
                    }
                })
            } else if ($(this).data('ranged') == 1) {
                var  sliderRange = $("<div/>", {
                    'class': 'slider_range',
                    width: $(self).find("input[type=text]").width() + 8
                }).appendTo(this);

                var rMin = $(this).data('rangedmin'), rMax = $(this).data('rangedmax'),input = $(self).find("input[type=text]");
                if(input.val() == 'undefined') {
                    input.val(rMin)
                }
                sliderRange.slider({
                    range: false,
                    min : rMin,
                    max : rMax,
                    value: input.val() != 'undefined' ? input.val() : rMin,
                    step: 0.1,
                    animate: 'slow',
                    slide: function (event, ui) {
                        input.val(ui.value);
                    }
                })
            }
        });
    }, 500)

}

/* DEMO::*/
function option_switch(item, options_id, parent_id) {
    if (item == null) return;
    if (parent_id == null) parent_id = options_id;
    var attr = ' id="option_' + options_id + '" name="option[' + parent_id + ']" title="' + item.title + '"';
    var of = '<div class="control-group"><label class="control-label clear" for="option_' + options_id + '">' + item.title + '</label><div class="controls">';
    of += option_switch_by_type(item, attr);
    of += '</div></div>';
    return of;
}

/* DEMO::*/
function option_switch_filter(item, options_id, parent_id) {
    if (item == null) return;
    if (parent_id == null) parent_id = options_id;
    var attr = ' id="option_' + options_id + '" name="option[' + parent_id + ']"';
    var of = option_switch_by_type(item, attr);
    return of;
}

/* DEMO::*/
function option_switch_by_type(item, attr) {
    var inof = '';
    switch (item.type) {
        case '1': // select
            inof = '<div class="form_item" data-id="' + item.id + '"><select' + attr + ' onchange="get_child(this)">';
            if (item.title == "")
                inof += '<option value=""> -- сделайте выбор -- </option>';
            else
                inof += '<option value=""> -- ' + item.title + ' -- </option>';
            $.each(item.values, function (k, option) {
                inof += '<option value="' + option.id + '">' + option.title + '</option>';
            });
            inof += '</select></div>';
            break;
        case '2': // checkbox
            $.each(item.values, function (k, option) {
                inof += '<div class="form_item" data-id="' + option.id + '"><label><input type="checkbox"' + attr + ' value="' + option.id + '"> ' + option.title + '</label></div>';
            });
            break;
        case '5': // text <input
            inof = '<div data-ranged="' + item.ranged + '" data-rangedmin="' + item.ranged_min + '" data-rangedmax="' + item.ranged_max + '"  class="form_item" data-id="' + item.id + '"><input type="text"' + attr + ' placeholder="' + item.title + '" value="' + item.value + '" class="input-large" /></div>';

            break;
        case '9': // number float
            inof = '<div class="form_item" data-id="' + item.id + '"><input type="number" placeholder="' + item.title + '" min="0" class="input-mini" step="0.1" ' + attr + ' value="" /></div>';
            break;
        case '6': // radio input
            $.each(item.values, function (k, option) {
                inof += '<div class="form_item" data-id="' + option.id + '"><label><input type="radio"' + attr + ' value="' + option.id + '"> ' + option.title + '</label></div>';
            });
            break;
    }
    return inof;
}

/* DEMO::*/
function orders_options(order) {
    var of;
    var data = JSON.parse($DATA);
    $.each(order, function (key, options_id) {
        if (typeof(options_id) === 'number')
            of = option_switch_filter(data.options[options_id], options_id);
        else of = options_id;
        $('#search_filters').append(of);
    });
    $('input[type=number]').removeAttr('step');
}

/* DEMO::*/
function categoty_filter(cat) {

    cat = $(cat).val();
    $('#search_filters').empty();
    if (cat == null) return;
    var of;
    /*if(cat == 9){
     var order = [14,45,15,53,'<br />',54,50,51,46,'<br />',47,48,49,52];
     of = orders_options(order);
     return;
     }
     if(cat == 12 || cat == 13){
     var order = [2,5,6,7,'<br />общая площадь около ',41,' m<sup>2</sup>, жилая площадь около ',42,' m<sup>2</sup>']; // 40,
     of = orders_options(order);
     return;
     }
     if(cat == 14){
     var order = [2,5,6,7,'<br />общая площадь около ',41,' m<sup>2</sup>, жилая площадь около ',42,' m<sup>2</sup>, площадь участка около ',43]; // 40,
     of = orders_options(order);
     return;
     }
     if(cat == 62){
     var order = [3, ' площадь участка около ',43,' m<sup>2</sup>']; // 40,
     of = orders_options(order);
     return;
     }
     if(cat == 63){
     var order = [2,5, ' общая площадь около ',41,' m<sup>2</sup>']; // 40,
     of = orders_options(order);
     return;
     }
     if(cat == 64){
     var order = [2,9, ' общая площадь около ',41,' m<sup>2</sup>']; // 40,
     of = orders_options(order);
     return;
     }*/

    var data = JSON.parse($DATA);
    if (data.categories[cat]) {
        var options_ids = data.categories[cat].options;
        $.each(options_ids, function (key, options_id) { //console.log(cat,options_id);
            if (data.options[options_id].parent_id != null) return;
            of = option_switch_filter(data.options[options_id], options_id);
            $('#search_filters').append(of);
        });
    }
    $.ajax({
        url: '/resources/js/sortsearch.json',
        'dataType': 'json',
        beforeSend: function () {
            $.fancybox.showLoading();
        }
    }).done(function (data) {
        var newDOM = $("#search_filters");
        for (var i in data) {
            if ($("#search-category").val() == data[i].category) {
                newDOM.append(newDOM.find("[data-id=" + data[i].id + "]"));
            }
        }
        setTimeout(function () {
            $.fancybox.hideLoading();
        }, 500);
    });
}

var advEdit = {};
advEdit.checked = new Array();

advEdit.action = function (action) {
    advEdit.checked.push('val');
    var checkboks = $(".advert-checkbox");
    advEdit.checked = new Array();
    checkboks.each(function (index, element) {
        if ($(element).is(':checked')) {
            var val = $(element).val();
            advEdit.checked.push(val);
        }
    });
    if (advEdit.checked.length > 0) {
        var getParam = '';
        for (var i = 0; i < advEdit.checked.length; i++) {
            getParam += advEdit.checked[i];
            if (i != advEdit.checked.length - 1)
                getParam += ':';
        }
        window.location = '/adverts/' + action + '/' + getParam;
    }
}

var backend = {};
backend.advAction = function (action) {
    var checkboks = $(".advert-checkbox");
    advEdit.checked = new Array();
    checkboks.each(function (index, element) {
        if ($(element).is(':checked')) {
            var val = $(element).val();
            advEdit.checked.push(val);
        }
    });
    if (advEdit.checked.length > 0) {
        var getParam = '';
        for (var i = 0; i < advEdit.checked.length; i++) {
            getParam += advEdit.checked[i];
            if (i != advEdit.checked.length - 1)
                getParam += ':';
        }
        window.location = '/backend/adverts/' + action + '/' + getParam;
    }
    backend.userAction = function (action) {
        var checkboks = $(".advert-checkbox");
        advEdit.checked = new Array();
        checkboks.each(function (index, element) {
            if ($(element).is(':checked')) {
                var val = $(element).val();
                advEdit.checked.push(val);
            }
        });
        if (advEdit.checked.length > 0) {
            var getParam = '';
            for (var i = 0; i < advEdit.checked.length; i++) {
                getParam += advEdit.checked[i];
                if (i != advEdit.checked.length - 1)
                    getParam += ':';
            }
            window.location = '/backend/users/' + action + '/' + getParam;
        }
    }
}
$(function () {
    $(".image-selector").click(function () {
        $(".image-selected").removeClass('image-selected');
        $(this).addClass('image-selected');
        var path = $(this).find('input').val();
        var image = path.split('/');
        $("#main_image").val(image[image.length - 1]);
    });

    $('#description').bind('input propertychange', function () {
        var chars = $(this).val();
        var enters = chars.split('\n');
        var left = (500 - (chars.length + (enters.length - 1)));
        $('#leftchars').find('span').text(left);
    });
    $("#chkAll").click(function () {
        if ($(this).is(':checked'))
            $("input[type='checkbox']").attr('checked', true);
        else {
            $("input[type='checkbox']").attr('checked', false);
        }
    });
    $("[data-tooltip]").mousemove(function (eventObject) {
        $data_tooltip = $(this).attr("data-tooltip");

        $("#tooltip").html($data_tooltip)
            .css({
                "top": eventObject.pageY + 5,
                "left": eventObject.pageX + 5
            })
            .show();
    }).mouseout(function () {
        $("#tooltip").hide()
            .text("")
            .css({
                "top": 0,
                "left": 0
            });
    });
    $("#payment-paypal").click(function () {
        var paypalbutton = $("#paypalbutton");
        if (paypalbutton.is(":hidden")) {
            $("#paypalbutton").show();
        } else {
            $("#paypalbutton").hide();
        }
    });
    $('.package-block').click(function (e) {
        if ($(this).hasClass('selected-package')) {
            $(this).removeClass('selected-package');
        } else {
            $('.package-block').removeClass('selected-package');
            $(this).addClass('selected-package');
        }
        setTimeout(function () {
            $('.package-block').each(function () {
                if ($(this).hasClass('selected-package')) {
                    $(this).find('input[type=checkbox]').attr('checked', true);
                } else {
                    $(this).find('input[type=checkbox]').attr('checked', false);
                }
            });
        })

        /* if (e.target.localName == 'input') {
         $(this).addClass('selected-package');
         var self = this;
         setTimeout(function () {
         $(self).find('input[type=checkbox]').attr('checked', true);
         }, 100);
         } else {
         $(this).addClass('selected-package');
         $(this).find('input[type=checkbox]').attr('checked', true);
         }*/
    });
    function savePackage(key, value) {
        var selected = [];
        if (window.localStorage != undefined) {
            window.localStorage.setItem(key, value);
        }
    }

    /* $('.package-block').click(function () {
     $('.package-block').removeClass('selected-package');
     var val = $(this).attr('val');
     var input = $("#addpackage");
     var radio = $(this).find("input[type='radio']");
     if (radio.is(':checked')) {
     radio.attr('checked', false);
     if ($('#suggest-adverts').length > 0) {
     $('.suggest-advert-box').show();
     }
     } else {
     radio.attr('checked', true);
     $(this).addClass('selected-package');
     if ($('#suggest-adverts').length > 0) {
     var pack = radio.val();
     $('.suggest-advert-box').show();
     $('#suggest-adverts').find('.' + pack).removeClass('suggest-advert-selected').hide();
     }
     }
     });*/
    $('.suggest-advert-box').click(function () {
        //alert($(this).attr('val'));
        $('.suggest-advert-box').removeClass('suggest-advert-selected');
        $(this).addClass('suggest-advert-selected');
    });
    $('.list-img-pack').each(function (index, element) {
        if ($(element).find('img').length == 0) {
            $(element).remove();
        }
    });
    $('#payment-wallet').click(function () {
        var el = $("#wallet-button");
        if ($(el).is(':visible')) {
            $(el).hide();
        } else {
            $(el).show();
        }
    });
});
var suggest = {};
var changeaction = function (name) {
    $("#message-action").val(name);
}

var setSelectedPack = function (pack) {
    var selected_packs = JSON.parse(pack);
    for (var i in selected_packs) {
        $("input[value=" + selected_packs[i] + "]").click();
    }
}

var buySuggest = function () {
    if ($("input[name='addpackege']:checked").length > 0) {
        var pack = $("input[name='addpackege']:checked").val();
    } else {
        $.jGrowl(suggest.nopack);
        return false;
    }
    if ($('.suggest-advert-selected').length > 0) {
        var advert = $('.suggest-advert-selected').attr('val');
    } else {
        $.jGrowl(suggest.noadvert);
        return false;
    }
    document.location = '/packages/pay?advert=' + advert + '&package=' + pack;
}