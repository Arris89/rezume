<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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


<div class="separate-line"></div>



<div class="bx-system-auth-form">

    <?

    if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'] && ($APPLICATION->GetCurPage(false) !== '/login/') && ($APPLICATION->GetCurPage(false) !== '/auth/')) {
        ShowMessage($arResult['ERROR_MESSAGE']);
        echo '<script>
$(".fade-screen").first().show();
$(".popup.enter").show();
</script>';
    }
    ?>

    <div class="auth-error"></div>

    </br>

    <?if($arResult["FORM_TYPE"] == "login"):?>


        <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

            <?if($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <div class="wa-form">
                <div class="wa-field wa-field-email">
                    <div class="wa-name"><?=GetMessage("AUTH_LOGIN")?></div>
                    <div class="wa-value">
                        <input type="text" name="USER_LOGIN" placeholder="логин">
                        <script>
                            BX.ready(function() {
                                var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                if (loginCookie)
                                {
                                    var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                    var loginInput = form.elements["USER_LOGIN"];
                                    loginInput.value = loginCookie;
                                }
                            });
                        </script>
                    </div>
                </div>




                <div class="wa-field wa-field-password">
                    <div class="wa-name"><?=GetMessage("AUTH_PASSWORD")?></div>
                    <div class="wa-value">
                        <input type="password" name="USER_PASSWORD" placeholder="пароль">

                        <?if($arResult["SECURE_AUTH"]):?>
                            <span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                            <noscript>
                    <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                        <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                    </span>
                            </noscript>
                            <script type="text/javascript">
                                document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
                            </script>
                        <?endif?>

                    </div>
                </div>



                <div class="wa-field">
                    <table>
                        <?

                        //if ($arResult["STORE_PASSWORD"] == "Y"):?>
                        <!-- 	<tr>
		<td valign="top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /></td>
		<td width="100%"><label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label></td>
	</tr> -->
                        <?//endif?>
                        <?if ($arResult["CAPTCHA_CODE"]):?>
                            <tr>
                                <td colspan="2">
                                    <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
                                    <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
                                    <input type="text" name="captcha_word" maxlength="50" value="" /></td>
                            </tr>
                        <?endif?>
                    </table>
                    <div class="wa-value wa-submit">
                        <input type="hidden" name="wa_auth_login" value="1">
                        <input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>">
                     
                        <a href="/forgotpassword/" rel="nofollow">Забыли свой пароль?</a>
                        
                        <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
                            <!--                        <a href="--><?//=$arResult["AUTH_REGISTER_URL"]?><!--" rel="nofollow">--><?//=GetMessage("AUTH_REGISTER")?><!--</a>-->
                            <a href="#" type="submit" id="loginreload"><?=GetMessage("AUTH_REGISTER")?></a>

                        <?endif?>
                    </div>
                </div>





                <!--

		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>
<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex><br /></td>
		</tr>
<?endif?>

		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex></td>
		</tr>


-->
                <!--
<?if($arResult["AUTH_SERVICES"]):?>
		<tr>
			<td colspan="2">
				<div class="bx-auth-lbl"><?=GetMessage("socserv_as_user_form")?></div>
<?
                    $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
                        array(
                            "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                            "SUFFIX"=>"form",
                        ),
                        $component,
                        array("HIDE_ICONS"=>"Y")
                    );
                    ?>

			</td>
		</tr>

        </table>
<?endif?>
-->


            </div>
        </form>


        <?if($arResult["AUTH_SERVICES"]):?>
            <?
            $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                array(
                    "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                    "AUTH_URL"=>$arResult["AUTH_URL"],
                    "POST"=>$arResult["POST"],
                    "POPUP"=>"Y",
                    "SUFFIX"=>"form",
                ),
                $component,
                array("HIDE_ICONS"=>"Y")
            );
            ?>
        <?endif?>

        <?
    elseif($arResult["FORM_TYPE"] == "otp"):
        ?>

        <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <?if($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="OTP" />
            <table width="95%">
                <tr>
                    <td colspan="2">
                        <?echo GetMessage("auth_form_comp_otp")?><br />
                        <input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
                </tr>
                <?if ($arResult["CAPTCHA_CODE"]):?>
                    <tr>
                        <td colspan="2">
                            <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
                            <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
                            <input type="text" name="captcha_word" maxlength="50" value="" /></td>
                    </tr>
                <?endif?>
                <?if ($arResult["REMEMBER_OTP"] == "Y"):?>
                    <tr>
                        <td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
                        <td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
                    </tr>
                <?endif?>
                <tr>
                    <td colspan="2"><input type="submit" name="Login" id="login-form" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
                </tr>
            </table>
        </form>

        <?
    else:
        ?>

        <form action="<?=$arResult["AUTH_URL"]?>">
            <table width="95%">
                <tr>
                    <td align="center">
                        <?=$arResult["USER_NAME"]?><br />
                        [<?=$arResult["USER_LOGIN"]?>]<br />
                        <a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br />
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?foreach ($arResult["GET"] as $key => $value):?>
                            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                        <?endforeach?>
                        <input type="hidden" name="logout" value="yes" />
                        <input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
                    </td>
                </tr>
            </table>
        </form>
    <?endif?>
</div>
