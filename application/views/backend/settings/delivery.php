<link rel='stylesheet' type='text/css' href='/plugins/source/jquery.fancybox.css' />
<link rel='stylesheet' type='text/css' href='/resources/js/redactor/redactor.css' />

<script type="text/javascript" src="/plugins/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="/resources/js/redactor/redactor.min.js"></script>

<div class="page-header">
    <h1>Пользовательская рассылка</h1><Br/>
    <form>
        <div class="well">
            <h5>Тип рассылки:</h5>
            <select class="form-control">
                <option>Всем пользователям</option>
                <option>Тем, кто не авторизировался более 30 дней</option>
                <option>Тем, кто добавлял объявления, в течении 3 дней</option>
                <option>Тем, у кого осталось менее 3 дней до завершения размещения</option>
                <option>Тем, у кого закончился пакет выделения (спустя 1 день) и объявления актуальны</option>
            </select>
            <br/>
            <h5>Заголовок письма:</h5>
            <textarea cols="100" rows="3"></textarea>
            <h5>Содержимое письма</h5>
            <textarea class="delivery_content" cols="100" rows="6"></textarea>
            <br/>
            <input type="button" class="btn btn-default" value="Отправить"/>
        </div>
    </form>
    <br/>
</div>
<script>
    $('.delivery_content').redactor({
        imageUpload: "/backend/settings/imageupload",
        imageGetJson: "/backend/settings/getimages",
        keyupCallback : function() {


        }
    });
</script>