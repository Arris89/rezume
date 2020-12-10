<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="container section-style">
    <div class="page-title">Восстановление пароля</div>
    <br>
    <?ShowMessage($arParams["~AUTH_RESULT"]); ?>
    <form class="decor-form" name="bform" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
        <?
        if (strlen($arResult["BACKURL"]) > 0) {
            ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <?
        }
        ?>
        <input type="hidden" name="AUTH_FORM" value="Y">
        <input type="hidden" name="TYPE" value="SEND_PWD">

        <div>
            <label class="label-style">
                <span class="label-style__head"><span class="label-style__hint"><?= GetMessage("sys_forgot_pass_login1") ?></span></span>
                <input class="input input-style" type="text" name="USER_LOGIN" value="<?= $arResult["LAST_LOGIN"] ?>"/>
                <input type="hidden" name="USER_EMAIL"/>
            </label>
            <div style="margin: 20px 0"><? echo GetMessage("sys_forgot_pass_note_email") ?></div>
        </div>

        <? if ($arResult["PHONE_REGISTRATION"]): ?>
            <div>
                <label class="label-style">
                    <span class="label-style__head"><span class="label-style__hint"><?= GetMessage("sys_forgot_pass_phone") ?></span></span>
                    <input class="input input-style" type="text" name="USER_PHONE_NUMBER" value=""/>
                    <input type="hidden" name="USER_EMAIL"/>
                </label>
                <div><? echo GetMessage("sys_forgot_pass_note_phone") ?></div>
            </div>
        <? endif; ?>

        <? if ($arResult["USE_CAPTCHA"]): ?>
            <div style="margin-top: 20px">
                <div>
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180"
                         height="40" alt="CAPTCHA"/>
                </div>
                <div><? echo GetMessage("system_auth_captcha") ?></div>
                <div><input type="text" name="captcha_word" maxlength="50" value=""/></div>
            </div>
        <? endif ?>

        <div class="decor-form__row">
            <input class="my-btn"  type="submit" name="send_account_info" value="<?= GetMessage("AUTH_SEND") ?>"/>
        </div>
    </form>

    <div style="margin-top: 20px">
        <p><a class="legrand-link legrand-link_blue" href="<?= $arResult["AUTH_AUTH_URL"] ?>"><?= GetMessage("AUTH_AUTH") ?></a></p>
    </div>

    <script type="text/javascript">
        document.bform.onsubmit = function () {
            document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;
        };
        document.bform.USER_LOGIN.focus();
    </script>
</div>