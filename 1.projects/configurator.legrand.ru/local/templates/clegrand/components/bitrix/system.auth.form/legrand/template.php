<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// после авторизации пользователь попадает в ЛК
// редирерект на событии OnAfterUserAuthorize в init.php
CJSCore::Init(); ?>

<? if ($arResult["FORM_TYPE"] == "login"): ?>

    <div class="popup popup_enter zoom-anim-dialog mfp-hide" id="popup-enter">
        <div class="popup__content">
            <div class="enter-popup">
                <div class="enter-popup__title popup-title">вход в личный кабинет</div>
                <? if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) { ?>
                    <div><? ShowMessage($arResult['ERROR_MESSAGE']); ?></div>
                <? } ?>
                <form class="popup-form" id="form-auth" action="<?= $arResult["AUTH_URL"] ?>"
                      name="system_auth_form<?= $arResult["RND"] ?>" method="post">
                    <? if ($arResult["BACKURL"] <> ''): ?>
                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                    <? endif ?>
                    <? foreach ($arResult["POST"] as $key => $value): ?>
                        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                    <? endforeach ?>
                    <input type="hidden" name="AUTH_FORM" value="Y"/>
                    <input type="hidden" name="TYPE" value="AUTH"/>


                    <div class="popup-form__fields">
                        <div class="popup-form__field">
                            <label class="label-style">
                                <span class="label-style__head">
                                    <span class="label-style__hint">Email</span>
                                </span>
                                <input class="input input-style" name="USER_LOGIN" type="text">
                                <script>
                                    BX.ready(function () {
                                        var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                        if (loginCookie) {
                                            var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                            var loginInput = form.elements["USER_LOGIN"];
                                            loginInput.value = loginCookie;
                                        }
                                    });
                                </script>
                            </label>
                        </div>
                        <div class="popup-form__field">
                            <label class="label-style">
                                <span class="label-style__head">
                                    <span class="label-style__hint">Пароль</span>
                                </span>
                                <input class="input input-style" name="USER_PASSWORD" type="password">
                            </label>
                        </div>
                        <? if ($arResult["CAPTCHA_CODE"]): ?>
                            <div class="popup-form__field">
                                <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                     width="180" height="40" alt="CAPTCHA"/><br/>
                                <label class="label-style">
                                <span class="label-style__head">
                                    <span class="label-style__hint">Слово на картинке</span>
                                </span>
                                    <input class="input input-style" name="captcha_word" type="text">
                                </label>
                            </div>
                        <? endif ?>
                        <div class="popup-form__send">
                            <button class="popup-form__submit my-btn" type="submit">Войти</button>
                        </div>
                    </div>
                </form>
                <div class="enter-popup__forget">
                    <a class="legrand-link legrand-link_blue popup-with-move-anim" href="#popup-forgotpasswd">Забыли пароль?</a>
                </div>
                <div class="enter-popup__account">
                    <div class="enter-popup__account-text">Если у вас нет аккаунта, пожалуйста</div>
                    <div class="enter-popup__account-link">
                        <a class="legrand-link legrand-link_blue popup-with-move-anim" href="#popup-register">зарегистрируйтесь</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?global $APPLICATION;
    if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'] && !$APPLICATION->GetProperty("NO_AUTH_POPUP_TRIGGER")) {
        ?>
        <script>
            $(document).ready(function () {
                $('a[href="#popup-enter"]').trigger('click');
            })
        </script>
    <? } ?>
<? endif ?>
