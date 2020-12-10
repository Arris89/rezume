<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>


<div class="basket-wrap basket-order signup">
    <? if ($arResult["AUTH_SERVICES"]): ?>
        <div class="title"><h2><? echo GetMessage("AUTH_TITLE") ?></h2></div>
    <? endif ?>
    <div class="container">
        <div class="separate-line"></div>
        <div class="container-small registration">


            <? if ($arResult["AUTH_SERVICES"]): ?>

                <p>Войдите с помощью аккаунта в соц сетях</p>
                <div class="socials-list">
                    <div class="wa-auth-adapters">
                        <ul>
                            <li class="wa-auth-adapter-facebook">
                                <a title="Facebook" href="javascript:void(0)"
                                   onclick="BxShowAuthFloat('Facebook', 'form')">
                                    <img alt="Facebook" src="<?= SITE_TEMPLATE_PATH ?>/images/facebook.png">
                                </a>
                            </li>

                            <li class="wa-auth-adapter-vkontakte">
                                <a title="ВКонтакте" href="javascript:void(0)"
                                   onclick="BxShowAuthFloat('VKontakte', 'form')">
                                    <img alt="ВКонтакте" src="<?= SITE_TEMPLATE_PATH ?>/images/vkontakte.png"></a>
                            </li>

                        </ul>

                        <p>Авторизуйтесь, указав свои контактные данные, или воспользовавшись перечисленными выше
                            сервисами.</p>
                    </div>
                </div>
            <? endif ?>


            <div class="enter-order">

                <form name="form_auth" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">

                    <div class="wa-form">
                        <input type="hidden" name="AUTH_FORM" value="Y"/>
                        <input type="hidden" name="TYPE" value="AUTH"/>
                        <? if (strlen($arResult["BACKURL"]) > 0): ?>
                            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                        <? endif ?>
                        <? foreach ($arResult["POST"] as $key => $value): ?>
                            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                        <? endforeach ?>


                        <input class="bx-auth-input form-control" type="text" name="USER_LOGIN" placeholder="Имя"
                               maxlength="255"
                               value="<?= $arResult["LAST_LOGIN"] ?>"/>


                        <input class="bx-auth-input form-control" type="password" name="USER_PASSWORD"
                               placeholder="Пароль" maxlength="255"
                               autocomplete="off"/>
                        <? if ($arResult["SECURE_AUTH"]): ?>
                            <span class="bx-auth-secure" id="bx_auth_secure"
                                  title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
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


                        <? if ($arResult["CAPTCHA_CODE"]): ?>

                        <? endif; ?>

                        <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>


                        <? endif ?>
                        <div class="wa-value wa-submit">
                            <input type="submit" class="btn btn-primary" name="Login"
                                   value="<?= GetMessage("AUTH_AUTHORIZE") ?>"/>
                        </div>


                        <? if ($arParams["NOT_SHOW_LINKS"] != "Y"): ?>
                            <noindex>
                                <p>
                                    <a href="/forgotpassword/"
                                       rel="nofollow"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></a>
                                </p>
                            </noindex>
                        <? endif ?>



                        <? if ($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"): ?>

                        <? endif ?>


                    </div>
                </form>

            </div>


        </div>
    </div>
</div>


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


