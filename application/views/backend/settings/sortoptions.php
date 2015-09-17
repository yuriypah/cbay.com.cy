<div class="page-header">
    <h1>Сортировать опции</h1>
</div>
<link rel="stylesheet" type="text/css" href="/resources/js/jquery-ui-1.11.2.custom/jquery-ui.min.css"/>
<script type="text/javascript" src="/resources/js/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
<link rel='stylesheet' type='text/css'
      href='/plugins/source/jquery.fancybox.css' />
<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<div class="options">

</div>
<script>
    $(function () {
        var json = $DATA;
        console.log(json);
        var html = "<table class='table'>", optionsHTML = "<table class='table'>";
        for (var i in json.categories) {
            optionsHTML = "<div class='sortable' data-id='" + json.categories[i].id + "'>"
            for (var optId in json.categories[i].options) {
                if (!json.options[json.categories[i].options[optId]].parent_id) {
                    if (json.options[json.categories[i].options[optId]].type == 2) {
                        // checkboxes items
                        for (var chItem in json.options[json.categories[i].options[optId]].values) {
                            optionsHTML += "<div data-category='" + json.categories[i].id + "'  data-type='option_value' data-id='" + json.options[json.categories[i].options[optId]].values[chItem].id + "' class='item btn btn-default' style='margin:10px'>" + json.options[json.categories[i].options[optId]].values[chItem].title + "</div>"

                        }
                    } else {
                        if (json.options[json.categories[i].options[optId]].title != '') {
                            optionsHTML += "<div data-category='" + json.categories[i].id + "' data-type='option' data-id='" + json.options[json.categories[i].options[optId]].id + "' class='item btn btn-default' style='margin:10px'>" + json.options[json.categories[i].options[optId]].title + "</div>"
                        } else {
                            optionsHTML += "<div data-category='" + json.categories[i].id + "' data-type='option' data-id='" + json.options[json.categories[i].options[optId]].id + "' class='item btn btn-default' style='margin:10px'>Выбор вариантов</div>"
                        }
                    }

                }

            }
            optionsHTML += "</div>";
            html += "<tr>" +
            "<td><strong>" + json.categories[i].title + "</strong></td>" +
            "<td>" + optionsHTML + "</td>" +
            "</tr>";

        }
        html += "</table>";
        $(".options").append(html);
        $(".sortable").sortable({
            stop: function (e, ui) {
                updateIndexes();
            }
        });
        function updateIndexes() {
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

    });

</script>