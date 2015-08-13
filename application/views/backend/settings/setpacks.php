<div class="page-header">
    <h1>Сортировать опции</h1>
    <br/>
    <?php
    $packs = HTML::getPacks();
    ?>
    <div class="well">
        <h5>Настройки бесплатного размещения:</h5><br/>
        Срок размещения: <input value="<?= $packs->default->days ?>" min="0" class="default_days input-mini"
                                type="number"/>
        дней
    </div>

    <div class="well">
        <h5>Настройки пакета "Поднятие": <img src="/resources/images/up.png" width="10"></h5><br/>
        <table>
            <tr>
                <td>
                    Срок размещения:&nbsp;&nbsp;
                </td>
                <td>
                    <input value="<?= $packs->pack_up->days ?>" min="0" class="pack_up_days input-mini" type="number"/>
                    дней<Br/>
                </td>
            </tr>
            <tr>
                <td>
                    Цена:
                </td>
                <td>
                    <input value="<?= $packs->pack_up->price ?>" min="0" class="pack_up_price input-mini"
                           type="number"/>
                </td>
            </tr>
        </table>
    </div>

    <div class="well">
        <h5>Настройки пакета "Выделение": <img src="/resources/images/color.png" width="10"></h5><br/>
        <table>
            <tr>
                <td>
                    Срок размещения:&nbsp;&nbsp;
                </td>
                <td>
                    <input value="<?= $packs->pack_pickout->days ?>" min="0" class="pack_pickout_days input-mini"
                           type="number"/>
                    дней<Br/>
                </td>
            </tr>
            <tr>
                <td>
                    Цена:
                </td>
                <td>
                    <input value="<?= $packs->pack_pickout->price ?>" min="0" class="pack_pickout_price input-mini"
                           type="number"/>
                </td>
            </tr>
        </table>
    </div>

    <div class="well">
        <h5>Настройки пакета "Престиж": <img src="/resources/images/prestig.png" width="10"></h5><br/>
        <table>
            <tr>
                <td>
                    Срок размещения:&nbsp;&nbsp;
                </td>
                <td>
                    <input value="<?= $packs->pack_prestige->days ?>" min="0" class="pack_prestige_days input-mini"
                           type="number"/>
                    дней<Br/>
                </td>
            </tr>
            <tr>
                <td>
                    Цена:
                </td>
                <td>
                    <input value="<?= $packs->pack_prestige->price ?>" min="0" class="pack_prestige_price input-mini"
                           type="number"/>
                </td>
            </tr>
        </table>
    </div>

    <div class="well">
        <h5>Настройки пакета "VIP": <img src="/resources/images/vip.png" width="10"></h5><br/>
        <table>
            <tr>
                <td>
                    Срок размещения:&nbsp;&nbsp;
                </td>
                <td>
                    <input value="<?= $packs->pack_vip->days ?>" min="0" class="pack_vip_days input-mini"
                           type="number"/> дней<Br/>
                </td>
            </tr>
            <tr>
                <td>
                    Цена:
                </td>
                <td>
                    <input value="<?= $packs->pack_vip->price ?>" min="0" class="pack_vip_price input-mini"
                           type="number"/>
                </td>
            </tr>
        </table>
    </div>

    <br/>
    <input type="button" class="savePacks btn btn-default" value="Сохранить изменения"/>
</div>
<script>
    $('.savePacks').click(function () {
        $.ajax({
            url: '/backend/settings/setpacks',
            type: 'post',
            data: {
                action: 'save',
                data: {
                    "default": {
                        "days": $('.default_days').val()
                    },
                    "pack_up": {
                        "days": $('.pack_up_days').val(),
                        "price": $('.pack_up_price').val()
                    },
                    "pack_pickout": {
                        "days": $('.pack_pickout_days').val(),
                        "price": $('.pack_pickout_price').val()
                    },
                    "pack_prestige": {
                        "days": $('.pack_prestige_days').val(),
                        "price": $('.pack_prestige_price').val()
                    },
                    "pack_vip": {
                        "days": $('.pack_vip_days').val(),
                        "price": $('.pack_vip_price').val()
                    }

                }
            }
        }).done(function () {
            alert('Успешно сохранено!');
        })
    });
</script>