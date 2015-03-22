<? if($pack) :?>
    <div class="control-group">
        <div class="controls">
            <div class="pull-left">

                <? if($pack == 'pack5') {?>
                    <div class="alert alert-info package-block-confirm">
                        <div class="pull-left">
                            <img src="/resources/images/prestig.png" class="sale_img"/>
                        </div>
                        <div class="pull-right package-textbox">
                            <? echo __('package.description.premium'); ?>
                        </div>
                    </div>
                <? } ?>
                <? if($pack == 'pack2') {?>
                    <div class="alert alert-info package-block-confirm">
                        <div class="pull-left">
                            <img src="/resources/images/vip.png" class="sale_img"/>
                        </div>
                        <div class="pull-right package-textbox">
                            <? echo __('package.description.vip'); ?>
                        </div>
                    </div>
                <? } ?>
                <? if($pack == 'pack3') {?>
                    <div class="alert alert-info package-block-confirm">
                        <div class="pull-left">
                            <img src="/resources/images/color.png" class="sale_img"/>
                        </div>
                        <div class="pull-right package-textbox">
                            <? echo __('package.description.selected'); ?>
                        </div>
                    </div>
                <? } ?>
                <? if($pack == 'pack4') {?>
                    <div class="alert alert-info package-block-confirm">
                        <div class="pull-left">
                            <img src="/resources/images/up.png" class="sale_img"/>
                        </div>
                        <div class="pull-right package-textbox">
                            <? echo __('package.description.top'); ?>
                        </div>
                    </div>
                <? }  ?>
            </div>
        </div>
    </div>
<? endif; ?>