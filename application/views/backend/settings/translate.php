<h1>Настройки перевода <button style="float:right" class="btn" onclick="TranslateActions.save()">Сохранить</button></h1>

<link rel='stylesheet' type='text/css' href='/plugins/source/jquery.fancybox.css' />
<link rel='stylesheet' type='text/css' href='/resources/js/redactor/redactor.css' />

<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="/resources/js/redactor/redactor.min.js"></script>

<link rel="stylesheet" type="text/css" href="/resources/js/jquery-ui-1.11.2.custom/jquery-ui.min.css"/>
<script type="text/javascript" src="/resources/js/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
<table class="table" style="background:#f1f1f1">
    <tr>
        <td>
            <div class="keyForm">
                <h4>Добавить текстовую переменную:</h4><Br/>
                <table class='table' style="background:#f1f1f1;width:200px">
                    <tr><th>Ключ:</th><th><input name="t_key" type="text"/></th></tr>
                    <tr><th>Категория:</th><th><input name="t_category" type="text"/></th></tr>
                    <tr><th>Описание:</th><th><input name="t_desc" type="text"/></th></tr>
                    <tr><th></th><th><input onclick="TranslateActions.addkey()" value="Добавить" class="btn btn-default" type="button"/></th></tr>
                </table>
            </div>
        </td>
        <td>
            <h4>Группы текстовых переменных:</h4><Br/>
            <?php
            if($groups) {
                foreach($groups as $group) {
                    echo "<div><span onclick='TranslateActions.get(this)' class='selectGroup' data-category='".$group['category']."' href='#'>".$group['category']."</span> <span style='color:Gray'></span></div>";
                }
            }
            ?>
        </td>
    </tr>
</table>
<h1 class="groupHeader"></h1>
<div class="groupContent"></div>
<script>
    Translate.translatePanel('body');
</script>
<!--
<div class='text-right'>
    <input type='button' class='btn btn-default translate-save'
           value='Сохранить'/>
</div>
<br/>
<table class='translate_table table'>
    <tr>
        <th>Свойство</th>
        <th>Русский</th>
        <th>Английский</th>
        <th>Греческий</th>
    </tr>
    <?php

    function tr_tpl($key, $value1, $value2, $value3)
    {
        $tr = "<tr>";
        $tr .= "<td>" . $key . "</td>";
        $tr .= "<td><textarea data-key='" . $key . "' data-lang='ru' class='lang'>" . $value1 . "</textarea></td>";
        /* $tr .= "<td><textarea data-key='" . $key . "' data-lang='en' class='lang'>" . $value2 . "</textarea></td>";
         $tr .= "<td><textarea data-key='" . $key . "' data-lang='el' class='lang'>" . $value3 . "</textarea></td>";*/
        $tr .= "</tr>";
        return $tr;
    }

    $i18n_jsons = array(
        'ru' => ( array )json_decode(file_get_contents("application/i18n/data/ru.json"), true),
        'en' => ( array )json_decode(file_get_contents("application/i18n/data/en.json"), true),
        'el' => ( array )json_decode(file_get_contents("application/i18n/data/el.json"), true)
    );

    if ($i18n_jsons) {
        foreach ($i18n_jsons ['ru'] as $key => $value) {
            //echo tr_tpl($key,$value,$i18n_jsons ['en'][$key],$i18n_jsons ['el'][$key]);
        }
    }

    // $arr = include ("/application/i18n/ru.php");
    // function tr_tpl($key, $value) {
    // 	$tr = "<tr>";
    // 	$tr .= "<td>" . $key . "</td>";
    // 	$tr .= "<td><textarea data-key='" . $key . "' data-lang='ru' class='lang'>" . $value . "</textarea></td>";
    // 	$tr .= "<td><textarea data-key='" . $key . "' data-lang='en' class='lang'>" . $value . "</textarea></td>";
    // 	$tr .= "<td><textarea data-key='" . $key . "' data-lang='el' class='lang'>" . $value . "</textarea></td>";
    // 	$tr .= "</tr>";
    // 	return $tr;
    // }
    // if ($arr) {
    // 	foreach ( $arr as $key0 => $items ) {
    // 		foreach ( $items as $key => $value ) {
    // 			if (! is_array ( $value )) {
    // 				echo tr_tpl ( $key0 . "." . $key, $value );
    // 			} else {
    // 				foreach ( $value as $key1 => $value1 ) {
    // 					if (! is_array ( $value1 )) {
    // 						echo tr_tpl ( $key0 . "." . $key . "." . $key1, $value1 );
    // 					} else {
    // 						foreach ( $value1 as $key2 => $value2 ) {
    // 							if (! is_array ( $value2 )) {
    // 								echo tr_tpl ( $key0 . "." . $key . "." . $key1 . "." . $key2, $value2 );
    // 							} else {
    // 								foreach ( $value2 as $key3 => $value3 ) {
    // 									echo tr_tpl ( $key0 . "." . $key . "." . $key1 . "." . $key2 . "." . $key3, $value3 );
    // 								}
    // 							}
    // 						}
    // 					}
    // 				}
    // 			}
    // 		}
    // 	}
    // }
    ?>
</table>
<script type="text/javascript">
    $(".translate-save").click(function () {
        var slovars = {'ru': {}, 'en': {}, 'el': {}};
        $("textarea.lang").each(function () {
            var _this = $(this);
            slovars[_this.data('lang')][_this.data('key')] = _this.val();
        });
        $.ajax({
            "url": "/backend/settings/langsave",
            'type': 'post',
            'dataType': 'json',
            'data': slovars
        }).done(function () {
            alert("Успешно сохранено");
        });

    });
    $(document).ready(function () {

        Translate.translatePanel();
    });
</script>
