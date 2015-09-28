<Br/>
<h3>
        <?php

        if (!$id) {
            echo "Сортировать категории";
        } else {
            echo "Сортировать опции";
        }
        ?>
    </h3>
<link rel="stylesheet" type="text/css" href="/resources/js/jquery-ui-1.11.2.custom/jquery-ui.min.css"/>
<script type="text/javascript" src="/resources/js/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
<link rel='stylesheet' type='text/css'
      href='/plugins/source/jquery.fancybox.css'/>
<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<?php
if ($categories && !$id) {
    echo "<div class='categories category_0'>";
    foreach ($categories as $key => $value) {

        if (is_array($value)) {
            foreach ($value as $key2 => $value2) {
                echo "<div class='category_item option_container category_1' data-id='" . $key . "'><span class='collapse_holder icon icon-circle-arrow-right'></span>" . $key2;
                if (is_array($value2)) {
                    echo "<div class='option_childs'>";
                    foreach ($value2 as $key3 => $value3) {
                        echo "<div class='category_item category_2' data-id='" . $key3 . "'>&nbsp;&nbsp;&nbsp;&nbsp;" . $value3 . "</div>";
                    }
                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "<div class='category_item category_1' data-id='" . $key . "'>" . $value . "</div>";
        }
    }
    echo "</div>";
    ?>
    <script>
        $(".category_0, .category_1 .option_childs").sortable({
            stop: function (e, ui) {
                var indexes = [];
                $('.category_item').each(function (i) {
                    indexes.push({
                        'id': $(this).data('id'),
                        'index': i
                    });
                });
                $.ajax({
                    beforeSend: function () {

                        $.fancybox.showLoading();
                    },
                    'url': '/backend/options/savecategoryindex/',
                    'type': 'post',
                    data: {'data': indexes}
                }).done(function () {
                    $.fancybox.hideLoading();
                });

            }
        });

    </script>
<? } ?>
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
                    optionsHTML += "<div style='border:1px solid #ddd;' class='option_container'>";
                    if (json.options[json.categories[i].options[optId]].title != '') {
                        optionsHTML += "<div class='val_parent_item' data-id='" + json.options[json.categories[i].options[optId]].id + "'><span class='collapse_holder icon icon-circle-arrow-right'></span> <a href='/backend/options/edit/" + json.options[json.categories[i].options[optId]].id + "'>" +
                        json.options[json.categories[i].options[optId]].title +
                        ' (' + json.options[json.categories[i].options[optId]].description + ')' +
                        "</a></div>"
                    } else {
                        optionsHTML += "<div class='val_parent_item' data-id='" + json.options[json.categories[i].options[optId]].id + "'><a href='/backend/options/edit/" + json.options[json.categories[i].options[optId]].id + "'>Выбор вариантов</a></div>"
                    }
                    optionsHTML += "<div class='sortable option_childs'>";
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
        $('.collapse_holder').toggle(function () {
            $(this).parents('.option_container').find('.option_childs').show();
            $(this).removeClass('icon-circle-arrow-right');
            $(this).addClass('icon-circle-arrow-down');
        }, function () {
            $(this).parents('.option_container').find('.option_childs').hide();
            $(this).addClass('icon-circle-arrow-right');
            $(this).removeClass('icon-circle-arrow-down');
        });
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