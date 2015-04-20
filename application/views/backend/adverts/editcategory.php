<h1>Изменить категорию</h1>
<style>
    input[type=text] {
        margin-bottom:0 !important;
    }
</style>
<?php echo Form::open(null, array('method' => 'post'));
echo Form::hidden('action_type', 'save');
echo "<select name='category_id' id='category_id' onchange='category_select()'><option value='0'>-- Выберите категорию --</option>";
foreach ($categories as $key => $value) {
    if (is_array($value)) {
        echo "<optgroup label='" . $key . "'>";
        foreach ($value as $key_item => $value_item) {
            echo "<option " . (Arr::get($data, 'category_id') == $key_item ? " selected='selected' " : "") . " value='" . $key_item . "'>" . $value_item . "</option>";
        }
        echo "</optgroup>";
    } else {
        echo "<option " . (Arr::get($data, 'category_id') == $key_item ? " selected='selected' " : "") . " value='" . $key . "'>" . $value . "</option>";
    }
}
echo "</select>";
?>
<div id="categoryoptions"></div>
<script type="text/javascript">

    cat_options = '<?= isset($data['option']) ? json_encode($data['option']) : false ?>';
    $(document).ready(function () {
        category_select(<?= isset($data["category_id"]) ? $data["category_id"] : 'null' ?>);
    });
</script>
<?php
echo Form::submit(null, 'Изменить');
Form::close();
?>