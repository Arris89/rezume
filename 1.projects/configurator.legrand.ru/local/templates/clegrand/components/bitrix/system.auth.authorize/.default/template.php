<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="container section-style">
    <? if ($arResult["AUTH_SERVICES"]): ?>
        <div class="page-title"><? echo GetMessage("AUTH_TITLE") ?></div><br>
    <? endif ?>
    <?
    ShowMessage($arParams["~AUTH_RESULT"]);
    ShowMessage($arResult['ERROR_MESSAGE']);
    ?>
    <div class="bx-auth-note"><?= GetMessage("AUTH_PLEASE_AUTH") ?></div><br>

    <form class="decor-form" name="form_auth" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">

        <input type="hidden" name="AUTH_FORM" value="Y"/>
        <input type="hidden" name="TYPE" value="AUTH"/>
        <? if (strlen($arResult["BACKURL"]) > 0): ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
        <? endif ?>
        <? foreach ($arResult["POST"] as $key => $value): ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
        <? endforeach ?>
        <div class="decor-form__fields">
            <div class="decor-form__field">
                <label class="label-style">
                    <span class="label-style__head"><span
                                class="label-style__hint"><?= GetMessage("AUTH_LOGIN") ?></span></span>
                    <input class="input input-style" type="text" name="USER_LOGIN" maxlength="255"
                           value="<?= $arResult["LAST_LOGIN"] ?>"/>
                </label>
            </div>
            <div class="decor-form__field">
                <label class="label-style">
                    <span class="label-style__head"><span
                                class="label-style__hint"><?= GetMessage("AUTH_PASSWORD") ?></span></span>
                    <input class="input input-style" type="password" name="USER_PASSWORD" maxlength="255"
                           autocomplete="off"/>
                </label>
                <? if ($arResult["SECURE_AUTH"]): ?>
                    <span class="bx-auth-secure" id="bx_auth_secure" title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>"
                          style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                    <noscript>
				<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                    </noscript>
                    <script type="text/javascript">
                        document.getElementById('bx_auth_secure').style.display = 'inline-block';
                    </script>
                <? endif ?>

            </div>

            <? if ($arResult["CAPTCHA_CODE"]): ?>
                <div class="decor-form__field">
                    <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>" width="180"
                         height="40" alt="CAPTCHA"/>
                    <label class="label-style">
                        <span class="label-style__head"><span
                                    class="label-style__hint"><? echo GetMessage("AUTH_CAPTCHA_PROMT") ?></span></span>
                        <input class="input input-style" type="text" name="captcha_word" maxlength="50" value=""
                               size="15"/>
                    </label>
                </div>
            <? endif; ?>
            <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>


                <div class="decor-form__field decor-form__field_checker">
                    <div class="checker">
                        <label class="checker__label">
                            <input class="input checker__checkbox" type="checkbox" id="USER_REMEMBER"
                                   name="USER_REMEMBER" value="Y"/>
                            <span class="checker__box checker__box_2">
                    <span class="check-icon"></span>
                </span>
                            <span class="checker__text"><?= GetMessage("AUTH_REMEMBER_ME") ?></span>
                        </label>
                    </div>
                </div>

            <? endif ?>
            <div class="decor-form__row">
                <div class="decor-form__field">
                    <input class="my-btn" type="submit" name="Login" value="<?= GetMessage("AUTH_AUTHORIZE") ?>"/>
                </div>
            </div>
        </div>
        <div class="authorize-btns">
            <? if ($arParams["NOT_SHOW_LINKS"] != "Y"): ?>
                <noindex>
                    <p>
                        <a class="legrand-link legrand-link_blue authorize-btns__forget" href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>"
                           rel="nofollow"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></a>
                    </p>
                </noindex>
            <? endif ?>

            <? if ($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"): ?>
                <noindex>
                    <p>
                        <a class="legrand-link legrand-link_blue" class="popup-with-move-anim" href="#popup-register"
                           rel="nofollow"><?= GetMessage("AUTH_REGISTER") ?></a><br/>
                        <?//= GetMessage("AUTH_FIRST_ONE") ?>
                    </p>
                </noindex>
            <? endif ?>
        </div>

    </form>

    <script type="text/javascript">
        <?if (strlen($arResult["LAST_LOGIN"]) > 0):?>
        try {
            document.form_auth.USER_PASSWORD.focus();
        } catch (e) {
        }
        <?else:?>
        try {
            document.form_auth.USER_LOGIN.focus();
        } catch (e) {
        }
        <?endif?>
    </script>
</div>
