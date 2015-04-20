<div id="search-panel">
    <form class="wrapper" method="get" action="/adverts/">
        <fieldset>
            <?php echo Form::input('q', $request->query('q'), array(
                'id' => 'search-keyword', 'placeholder' => __('search.label.keyword')
            )); ?>

            <select id="search-category" name="c" onchange="categoty_filter(this);setFiledCss()">
                <? foreach ($data['categories']['value'] as $item => $value) : ?>
                    <option value="<?= $item; ?>" <?= ($item == $request->query('c')) ? 'selected="selected"' : ''; ?>
                            class="<? if ($item != 0) echo ($data['categories']['parent'][$item] == '0') ? 'parent-category' : '' ?>"><?= $value; ?></option>
                <? endforeach; ?>
            </select>
            <?php echo Form::select('l', $data['cities'], $request->query('l'), array(
                'id' => 'search-region'
            )); ?>
        </fieldset>
        <fieldset class="form-inline" id="pre-filters">
            <label for="search-match" class="checkbox">
                <?php echo Form::checkbox('t', 1, $request->query('t') == 1, array(
                    'id' => 'search-match'
                )); ?>
                <?php echo __('search.label.only_title'); ?>
            </label>
            <label for="search-images-exists" class="checkbox">
                <?php echo Form::checkbox('i', 1, $request->query('i') == 1, array(
                    'id' => 'search-images-exists'
                )); ?>
                <?php echo __('search.label.only_with_images'); ?>
            </label>
            <input type="button" id="show-search-add" onclick="showSearchOptions(); setFiledCss()"
                   value="<?= __('search.label.search_show') ?>" class="advert_delete btn btn-mini btn-danger"/>
            <script>
                var search = {
                    'hide_lable': '<?= __('search.label.search_hide') ?>',
                    'hide_show': '<?= __('search.label.search_show') ?>'
                };
            </script>
        </fieldset>

        <div class="form-inline" id="search_filters">

        </div>

        <button id="search-button">Найти</button>
    </form>
    <div class="clear"></div>
</div>
<script>
    $(window).load(function () {
        var cat = $("#search-category");
        categoty_filter(cat);
        var options = new Array();
        var opt_names = new Array();
        <? if($request->query('option')){
                foreach($request->query('option') as $index => $option){
                    if($option != ""){
                        echo "options.push(".$option.");";
                        echo "opt_names.push(".$index.");";
                    }
                }
        }
        ?>
        for (var i = 0; i < options.length; i++) {
            $("#option_" + opt_names[i]).val(options[i]);
        }
    });
    function setFiledCss() {
        $("input[value=undefined]").parent().remove();
        $("#search_filters").find("select").width(200);
    }

</script>