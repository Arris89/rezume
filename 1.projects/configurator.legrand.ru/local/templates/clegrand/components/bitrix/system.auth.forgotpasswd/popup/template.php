<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>

<div class="popup popup_enter zoom-anim-dialog mfp-hide" id="popup-forgotpasswd">
    <div class="popup__content">
        <div class="enter-popup">
            <div class="enter-popup__title popup-title">Восстановить пароль</div>
            <form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?
                if (strlen($arResult["BACKURL"]) > 0)
                {
                    ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                    <?
                }
                ?>
                <input type="hidden" name="AUTH_FORM" value="Y">
                <input type="hidden" name="TYPE" value="SEND_PWD">
                
                <div class="popup-form__field">
                    <label class="label-style">
                        <span class="label-style__head">
                            <span class="label-style__hint"><?=GetMessage("sys_forgot_pass_login1")?></span>
                        </span>
                        <input type="text" class="input input-style"  name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" />
                        <input type="hidden" name="USER_EMAIL" />
                    </label>
                </div>
                <div class="popup-form__send">
                    <button type="submit" class="popup-form__submit my-btn"><?=GetMessage("AUTH_SEND")?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>
