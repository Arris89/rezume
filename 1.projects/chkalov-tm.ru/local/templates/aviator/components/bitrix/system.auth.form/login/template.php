<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
?>



<? if ($arResult["AUTH_SERVICES"]): ?>

    <p>Войдите с помощью аккаунта в соц сетях</p>
    <div class="socials-list">
        <div class="wa-auth-adapters">
            <ul>
                <li class="wa-auth-adapter-facebook">
                <a title="Facebook" href="javascript:void(0)" onclick="BxShowAuthFloat('Facebook', 'form')">
                    <img alt="Facebook" src="<?=SITE_TEMPLATE_PATH?>/images/facebook.png">
                </a>
                </li>

                <li class="wa-auth-adapter-vkontakte">
                <a title="ВКонтакте" href="javascript:void(0)" onclick="BxShowAuthFloat('VKontakte', 'form')">
                    <img alt="ВКонтакте" src="<?=SITE_TEMPLATE_PATH?>/images/vkontakte.png"></a>
                </li>

            </ul>

            <p>Авторизуйтесь, указав свои контактные данные, или воспользовавшись перечисленными выше сервисами.</p>
        </div>
    </div>
<?endif ?>



<div class="enter-order">

    <?
    if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
        ShowMessage($arResult['ERROR_MESSAGE']);
    ?>

    <? if ($arResult["FORM_TYPE"] == "login"): ?>

        <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
              action="<?= $arResult["AUTH_URL"] ?>">
            <div class="wa-form">


                <? if ($arResult["BACKURL"] <> ''): ?>
                    <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                <?endif ?>


                <? foreach ($arResult["POST"] as $key => $value): ?>
                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                <?endforeach ?>
                <input type="hidden" name="AUTH_FORM" value="Y"/>
                <input type="hidden" name="TYPE" value="AUTH"/>


                <div class="wa-field wa-field-email">
                    <div class="wa-name">Email</div>
                    <div class="wa-value">


                        <input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" placeholder="Логин"/>
                    </div>
                </div>
                <div class="wa-field wa-field-password">
                    <div class="wa-name">Пароль</div>
                    <div class="wa-value">
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

                        <input type="password" name="USER_PASSWORD" maxlength="50" size="17" autocomplete="off"
                               placeholder="Пароль"/>
                    </div>
                </div>
                <div class="wa-field">
                    <div class="wa-value wa-submit">

                        <? if ($arResult["SECURE_AUTH"]): ?>
                            <span class="bx-auth-secure" id="bx_auth_secure<?= $arResult["RND"] ?>"
                                  title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                            <noscript>
				<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                            </noscript>
                            <script type="text/javascript">
                                document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
                            </script>
                        <?endif ?>





                        <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>


                        <?endif ?>



                        <? if ($arResult["CAPTCHA_CODE"]): ?>


                            <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:
                            <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                                 width="180" height="40" alt="CAPTCHA"/>
                            <input type="text" name="captcha_word" maxlength="50" value=""/>

                        <?endif ?>

                        <input type="submit" name="Login" value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"/>

                        <noindex><a href="/forgotpassword/" rel="nofollow">Забыли
                                пароль?</a>
                        </noindex>

                    </div>

                </div>
            </div>
        </form>
        <div class="clear"></div>


        <? if ($arResult["AUTH_SERVICES"]): ?>
            <?
            $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                array(
                    "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                    "AUTH_URL" => $arResult["AUTH_URL"],
                    "POST" => $arResult["POST"],
                    "POPUP" => "Y",
                    "SUFFIX" => "form",
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            );
            ?>
        <?endif ?>

        <?
    elseif ($arResult["FORM_TYPE"] == "otp"):
        ?>

        <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
              action="<?= $arResult["AUTH_URL"] ?>">
            <div>22222</div>


            <? if ($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <?endif ?>
            <input type="hidden" name="AUTH_FORM" value="Y"/>
            <input type="hidden" name="TYPE" value="OTP"/>
            <table width="95%">
                <tr>
                    <td colspan="2">
                        <? echo GetMessage("auth_form_comp_otp") ?><br/>
                        <input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off"/></td>
                </tr>
                <? if ($arResult["CAPTCHA_CODE"]):?>
                    <tr>
                        <td colspan="2">
                            <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                            <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                                 width="180" height="40" alt="CAPTCHA"/><br/><br/>
                            <input type="text" name="captcha_word" maxlength="50" value=""/></td>
                    </tr>
                <?endif ?>
                <? if ($arResult["REMEMBER_OTP"] == "Y"):?>
                    <tr>
                        <td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y"/>
                        </td>
                        <td width="100%"><label for="OTP_REMEMBER_frm"
                                                title="<? echo GetMessage("auth_form_comp_otp_remember_title") ?>"><? echo GetMessage("auth_form_comp_otp_remember") ?></label>
                        </td>
                    </tr>
                <?endif ?>
                <tr>
                    <td colspan="2"><input type="submit" name="Login" value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <noindex><a href="<?= $arResult["AUTH_LOGIN_URL"] ?>"
                                    rel="nofollow"><? echo GetMessage("auth_form_comp_auth") ?></a></noindex>
                        <br/></td>
                </tr>
            </table>
        </form>

        <?
    else:


        echo '<script>window.location.replace(\'/\');</script>';
        ?>




    <? endif ?>


</div>
