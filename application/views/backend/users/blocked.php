<table class="table table-striped">
    <colgroup>
        <col/>
        <col width="100px"/>
        <col width="150px"/>
    </colgroup>
    <thead>
    <tr>
        <th>Имя пользователя</th>
        <th>Электронная почта</th>
        <th>Баланс пользователя</th>
        <th>Последний вход</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
    <?php if($user->status == 0) { ?>
        <tr data-id="<?php echo $user->id; ?>">
            <td>
                <?php echo HTML::anchor('backend/users/view/' . $user->id, $user->profile->name); ?>
                <?php echo HTML::label($user->username); ?>
            </td>
            <td><?php echo $user->email; ?></td>
            <td>
                <?php echo "</span><span class='amountText'>" . $user->amount . "</span> " . __('currency.euro') . " <span style='cursor:pointer' class='icon icon-pencil changeamount'></span>" ?>
                <div class='amountForm' style='display:none'>
                    <form action='/backend/users' method='post' style='margin:0'>
                        <input type='hidden' value='<?php echo $user->id ?>' name='id'/>
                        <input style='width:40px;padding:0' value='<?php echo $user->amount ?>' name='amount'
                               type='number' step="0.01"/>
                        <input type='submit' value='Ok'/></form>
                </div>
            </td>
            <td><?php echo date("d.m.Y в H:i", $user->last_login); ?></td>
            <td><?= ($user->status == 0) ? "<span style='color:red'>" . __('backend.users.blocked') . "</span>" : "<span style='color:green'>" . __('backend.users.active') . "</span>"; ?></td>
            <td><?= ($user->status == 0) ? HTML::anchor('backend/users/unblockuser/' . $user->id, __('backend.users.unblock'), array('class' => 'advert_deactivate btn btn-mini btn-success')) : HTML::anchor('backend/users/blockuser/' . $user->id, __('backend.users.block'), array('class' => 'advert_deactivate btn btn-mini btn-danger')); ?></td>
        </tr>
        <? } ?>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(".changeamount").click(function () {
        $(this).parents("td").find(".amountForm").slideToggle();
    });
</script>