<div class="page-header">
    <h1>Сортировать опции</h1>
</div>
<link rel="stylesheet" type="text/css" href="/resources/js/jquery-ui-1.11.2.custom/jquery-ui.min.css"/>
<script type="text/javascript" src="/resources/js/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
<link rel='stylesheet' type='text/css'
      href='/plugins/source/jquery.fancybox.css'/>
<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<div class="options">

</div>
<script>
    $(function () {
        var json = $DATA, id = parseInt(('<?php echo  $id ?>'), 10);
        var html = "", optionsHTML = "";
        for (var i in json.categories) {
            if (id == json.categories[i].id) {
                optionsHTML = "<div class='sortable sort_parent' data-id='" + json.categories[i].id + "'>"
                for (var optId in json.categories[i].options) {
                    optionsHTML += "<div style='border:1px solid #ddd;' class=''>";
                    if (json.options[json.categories[i].options[optId]].title != '') {
                        optionsHTML += "<div class='val_parent_item' data-id='" + json.options[json.categories[i].options[optId]].id + "'><a href='/backend/options/edit/" + json.options[json.categories[i].options[optId]].id + "'>" +
                        json.options[json.categories[i].options[optId]].title +
                        ' (' + json.options[json.categories[i].options[optId]].description + ')' +
                        "</a></div>"
                    } else {
                        optionsHTML += "<div class='val_parent_item' data-id='" + json.options[json.categories[i].options[optId]].id + "'><a href='/backend/options/edit/" + json.options[json.categories[i].options[optId]].id + "'>Выбор вариантов</a></div>"
                    }
                    optionsHTML += "<div class='sortable'>";
                    for (var opt_val_id = 0; opt_val_id < json.options[json.categories[i].options[optId]].values.length; opt_val_id++) {
                        if (json.options[json.categories[i].options[optId]].values[opt_val_id].title != null && json.options[json.categories[i].options[optId]].values[opt_val_id].title != '')
                            optionsHTML += "<div class='val_item' data-id='" + json.options[json.categories[i].options[optId]].values[opt_val_id].id + "'>&nbsp;&nbsp;&nbsp;&nbsp; -> &nbsp;" + json.options[json.categories[i].options[optId]].values[opt_val_id].title + '</div>';
                    }
                    optionsHTML += '</div></div>';
                }

                optionsHTML += "</div>";

            }
        }
        $(".options").append(optionsHTML);
        $(".sortable").sortable({
            stop: function (e, ui) {
                var items = $(ui.item).parent(), indexes = [];
                if ($(ui.item).parent().is('.sort_parent')) {
                    items.find('.val_parent_item').each(function (i) {
                        indexes.push({
                            'id': $(this).data('id'),
                            'index': i
                        })
                    });
                    $.ajax({
                        beforeSend: function () {
                            $.fancybox.showLoading();
                        },
                        'url': '/backend/options/saveparentindex/',
                        'type': 'post',
                        data: {'data': indexes}
                    }).done(function () {
                        $.fancybox.hideLoading();
                    });
                } else {
                    items.find('.val_item').each(function (i) {
                        indexes.push({
                            'id': $(this).data('id'),
                            'index': i
                        })
                    });
                    $.ajax({
                        beforeSend: function () {
                            $.fancybox.showLoading();
                        },
                        'url': '/backend/options/saveindex/',
                        'type': 'post',
                        data: {'data': indexes}
                    }).done(function () {
                        $.fancybox.hideLoading();
                    });
                }


            }
        });
        $(".sortable").disableSelection();
        /*function updateIndexes() {
         var indexes = [];
         $(".item").each(function() {
         indexes.push({
         category : $(this).data('category'),
         id : $(this).data('id'),
         index : $(this).index()
         })
         });
         $.ajax({
         url : '/backend/settings/savesort',
         type : 'post',
         beforeSend : function() {
         $.fancybox.showLoading();
         },
         data : {'indexes' : indexes}
         }).done(function() {
         $.fancybox.hideLoading();
         });
         }
         $.ajax({
         url : '/resources/js/sortsearch.json',
         'dataType' : 'json'
         }).done(function(data) {
         $('.sortable').each(function() {
         var newDOM = $(this);
         for(var i in data) {
         if(newDOM.data('id') == data[i].category) {
         $(this).append(newDOM.find("[data-id=" + data[i].id + "]"));
         }
         }
         });
         });
         */
    });

</script>