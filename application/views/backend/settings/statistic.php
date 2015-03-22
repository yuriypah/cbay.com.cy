<H1>Статистика пользователей</H1>
Хронология сообщений:<br/>
<div class="stat_messages pull-left">
<table class="table table-bordered">
    <tr>
       <th>Отправлено</th>
        <th>От кого</th>
        <th>Заголовок</th>
        <th>Сообщение</th>
        <th>Прочитано</th>
    </tr>

<?php
if($messages) {
   foreach($messages as $message) {
       echo "<tr>";
       echo "<td><b>".$message->created()."</b></td>";
       echo "<td>".($message->author != '' ? "<b>".$message->author." (id#".$message->from_user_id.")</b>" : "<span style='color:red'>Анонимный</span>")."</td>";
       echo "<td>".$message->title."</td>";
       echo "<td>".$message->text."</td>";
       echo "<td>".($message->status != 1 ? "<span style='color:red'>Нет</span>" : "<span style='color:green'>Да</span>")."</td>";
       echo "</tr>";
   }
}
?>
</table>
</div>
