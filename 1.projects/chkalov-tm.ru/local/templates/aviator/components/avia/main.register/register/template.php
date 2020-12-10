<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

?>


<p>Войдите с помощью аккаунта в соц сетях</p>
<div class="socials-list">
    <div class="wa-auth-adapters">
        <ul>
            <li class="wa-auth-adapter-facebook">
                <a title="Facebook" href="javascript:void(0)" onclick="BxShowAuthFloat('Facebook', 'form')">
                    <img alt="Facebook" src="<?= SITE_TEMPLATE_PATH ?>/images/facebook.png">
                </a>
            </li>

            <li class="wa-auth-adapter-vkontakte">
                <a title="ВКонтакте" href="javascript:void(0)" onclick="BxShowAuthFloat('VKontakte', 'form')">
                    <img alt="ВКонтакте" src="<?= SITE_TEMPLATE_PATH ?>/images/vkontakte.png"></a>
            </li>

        </ul>

        <p>Авторизуйтесь, указав свои контактные данные, или воспользовавшись перечисленными выше сервисами.</p>
    </div>
</div>

<div class="separate-line"></div>
<div class="wrap">
    <div class="wa-form">

        <? if ($USER->IsAuthorized()): ?>

            <p><? echo GetMessage("MAIN_REGISTER_AUTH") ?></p>

        <? else: ?>
            <?
            if (count($arResult["ERRORS"]) > 0):
                foreach ($arResult["ERRORS"] as $key => $error)
                    if (intval($key) == 0 && $key !== 0)
                        $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);

                ShowError(implode("<br />", $arResult["ERRORS"]));

            elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
                ?>
                <p><? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT") ?></p></br>
            <? endif ?>

            <form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" enctype="multipart/form-data">
                <?
                if ($arResult["BACKURL"] <> ''):
                    ?>
                    <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                    <?
                endif;
                ?>


                <? foreach ($arResult["SHOW_FIELDS"] as $FIELD): ?>
                    <? if ($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true): ?>

                        <? echo GetMessage("main_profile_time_zones_auto") ?><? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?>
                            <span class="starrequired">*</span><? endif ?>

                        <select name="REGISTER[AUTO_TIME_ZONE]"
                                onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
                            <option value=""><? echo GetMessage("main_profile_time_zones_auto_def") ?></option>
                            <option value="Y"<?= $arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : "" ?>><? echo GetMessage("main_profile_time_zones_auto_yes") ?></option>
                            <option value="N"<?= $arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : "" ?>><? echo GetMessage("main_profile_time_zones_auto_no") ?></option>
                        </select>


                        <? echo GetMessage("main_profile_time_zones_zones") ?>

                        <select name="REGISTER[TIME_ZONE]"<? if (!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"' ?>>
                            <? foreach ($arResult["TIME_ZONE_LIST"] as $tz => $tz_name): ?>
                                <option value="<?= htmlspecialcharsbx($tz) ?>"<?= $arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : "" ?>><?= htmlspecialcharsbx($tz_name) ?></option>
                            <? endforeach ?>
                        </select>


                    <? else: ?>

                        <?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>:<? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?>
                            <span class="starrequired">*</span><? endif ?>
                        <?
                        switch ($FIELD) {
                            case "PASSWORD":
                                ?>

                                <div class="wa-field wa-field-password">
                                    <div class="wa-name">Пароль</div>
                                    <div class="wa-value">
                                        <input size="30" type="password" name="REGISTER[<?= $FIELD ?>]"
                                               value="<?= $arResult["VALUES"][$FIELD] ?>" autocomplete="off"
                                               class="bx-auth-input"/>
                                    </div>
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
                                </div>
                                <?
                                break;
                            case "CONFIRM_PASSWORD":
                                ?>
                                <div class="wa-field wa-field-password_confirm">
                                    <div class="wa-name">Подтвердите пароль</div>
                                    <div class="wa-value">
                                        <input size="30" type="password" name="REGISTER[<?= $FIELD ?>]"
                                               value="<?= $arResult["VALUES"][$FIELD] ?>" autocomplete="off"/>
                                    </div>
                                </div>

                                <?
                                break;

                            case "PERSONAL_GENDER":
                                ?>


                                <div class="choose-wrap">


                                    <div class="sex" name="REGISTER[<?= $FIELD ?>]">


                                        <label class="prettycheckbox1">
                                            <div class="position-labelright clearfix prettyradio labelright  blue">
                                                <input type="radio" name="REGISTER[<?= $FIELD ?>]" id="woman"
                                                       class="prettyCheckable1"
                                                       value="F"<?= $arResult["VALUES"][$FIELD] == "F" ? " checked" : "" ?>>
                                                <div class="checkpay"></div>
                                                Женщина
                                            </div>
                                        </label>


                                        <label class="prettycheckbox1">
                                            <div class="position-labelright clearfix prettyradio labelright  blue">
                                                <input type="radio" name="REGISTER[<?= $FIELD ?>]" id="men"
                                                       class="prettyCheckable1"
                                                       value="M"<?= $arResult["VALUES"][$FIELD] == "M" ? " checked" : "" ?>>
                                                <div class="checkpay"></div>
                                                Мужчина
                                            </div>
                                        </label>

                                    </div>

                                    <div class="clear"></div>
                                </div>


                                <?
                                break;

                            case "PERSONAL_COUNTRY":
                            case "WORK_COUNTRY":
                                ?><select name="REGISTER[<?= $FIELD ?>]"><?
                                foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value) {
                                    ?>
                                    <option value="<?= $value ?>"<? if ($value == $arResult["VALUES"][$FIELD]): ?> selected="selected"<? endif ?>><?= $arResult["COUNTRIES"]["reference"][$key] ?></option>
                                    <?
                                }
                                ?></select><?
                                break;

                            case "PERSONAL_PHOTO":
                            case "WORK_LOGO":
                                ?><input size="30" type="file" name="REGISTER_FILES_<?= $FIELD ?>" /><?
                                break;

                            case "PERSONAL_NOTES":
                            case "WORK_NOTES":
                                ?>


                                <textarea cols="30" rows="5"
                                          name="REGISTER[<?= $FIELD ?>]"><?= $arResult["VALUES"][$FIELD] ?></textarea>

                                <?
                                break;
                            default:
                                if ($FIELD == "PERSONAL_BIRTHDAY"):?>
                                    <small><?= $arResult["DATE_FORMAT"] ?></small><br/><?endif;
                                ?><input size="30" type="text" name="REGISTER[<?= $FIELD ?>]"
                                         value="<?= $arResult["VALUES"][$FIELD] ?>" /><?
                                if ($FIELD == "PERSONAL_BIRTHDAY")
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:main.calendar',
                                        '',
                                        array(
                                            'SHOW_INPUT' => 'N',
                                            'FORM_NAME' => 'regform',
                                            'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                            'SHOW_TIME' => 'N'
                                        ),
                                        null,
                                        array("HIDE_ICONS" => "Y")
                                    );
                                ?><?
                        } ?>
                    <? endif ?>
                <? endforeach ?>





                <? // ********************* User properties ***************************************************?>
                <? if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
                    <tr>
                        <td colspan="2"><?= strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB") ?></td>
                    </tr>
                    <? foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>
                        <tr>
                            <td><?= $arUserField["EDIT_FORM_LABEL"] ?>:<? if ($arUserField["MANDATORY"] == "Y"): ?><span
                                        class="starrequired">*</span><? endif; ?></td>
                            <td>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:system.field.edit",
                                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS" => "Y")); ?></td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
                <? // ******************** /User properties ***************************************************?>
                <?
                /* CAPTCHA */
                if ($arResult["USE_CAPTCHA"] == "Y") {
                    ?>
                    <div class="wa-field">
                        <div class="wa-value">
                            <div class="wa-captcha wa-recaptcha">
                                <b><?= GetMessage("REGISTER_CAPTCHA_TITLE") ?></b>

                                <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                     style="margin: auto;"
                                     width="180" height="40" alt="CAPTCHA"/>

                                <?= GetMessage("REGISTER_CAPTCHA_PROMT") ?>:<span class="starrequired">*</span>
                                <input type="text" name="captcha_word" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>

                <? } ?>



                <? if ($arParams['USER_CONSENT'] == 'Y'): ?>
                    <div class="personal-data-wrap singup">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.userconsent.request",
                            "avia",
                            array(
                                "ID" => $arParams["USER_CONSENT_ID"],
                                "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                                "AUTO_SAVE" => "Y",
                                "IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
                                "REPLACE" => array(
                                    'button_caption' => 'Подписаться!',
                                    'fields' => array('Email', 'Телефон', 'Имя')
                                ),
                            )
                        ); ?>
                    </div>
                <? endif; ?>


                <div class="wa-field">
                    <div class="wa-value wa-submit">
                        <input type="submit" name="register_submit_button" id="regsite"
                               value="<?= GetMessage("AUTH_REGISTER") ?>"/>
                        <span><a href="/login/">или войдите, если у вас уже есть аккаунт</a> </span>
                    </div>
                </div>

                </br>
                <p><span class="starrequired">*</span><?= GetMessage("AUTH_REQ") ?></p>

            </form>
        <? endif ?>
    </div>

</div>
<div class="clear"></div>


<script>


    $(document).ready(function () {

        $('#regsite').on('click', function (e) {


            $("#sender_subscribe").change(function () {
                if (this.checked) {
                    var mail = $('[name = REGISTER\\[EMAIL\\]]').val();
                    //alert(mail);
                    regnews(allpric);

                    function regnews(IDbask) {

                        $.post('/ajax/subscribe-news.php', {mail}, function (datab) {

                        })
                    }


                }

            })
        })
    });


</script>
