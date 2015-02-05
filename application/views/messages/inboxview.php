<div class="hero-unit">
    <h3><img style="vertical-align:-10px" src='/resources/images/icon-advert-options-sendtomail.png'/> Отправленное сообщение пользователю: <?php echo $message->recipient ?></h3>
    <div style="margin-left:38px"><b>Статус:</b> <?php echo $message->status == 0 ? "<span style='color:red'>Не прочитано</span>" : "<span style='color:green'>Прочитано</span>"; ?></div>
    <hr />
    <div class="content">
        <b>Ваше сообщение пользователю <?php echo $message->recipient ?>:</b> <br/>
        <p><i><?php  echo $message->text; ?></i></p>
    </div>
</div>
</div>