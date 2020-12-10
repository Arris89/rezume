<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>


<? if ($arResult["isFormErrors"] == "Y"): ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>

<?= $arResult["FORM_NOTE"] ?>

<? if ($arResult["isFormNote"] != "Y") {
    ?>
    <?= $arResult["FORM_HEADER"] ?>
    <?= $arResult['arForm']['DESCRIPTION'] ?>

    <?
    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
        if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
            echo $arQuestion["HTML_CODE"];
        } else {
            ?>
            <? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                <span class="error-fld" title="<?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>"></span>
            <?endif; ?>

            <?
            $placeholder = " placeholder=\"" . $arQuestion["CAPTION"] . "\">";
            echo str_replace(">", $placeholder, $arQuestion["HTML_CODE"]);

        }
    }
    ?>

    <? if ($arResult["isUseCaptcha"] == "Y"):?>

        <div class="capcha">
            <div class="wa-captcha wa-recaptcha">
                <div class="g-recaptcha">
                    <?= GetMessage("FORM_CAPTCHA_TABLE_TITLE") ?>
                    <input type="hidden" name="captcha_sid"
                           value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"/><img
                            src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"
                            width="180" height="40"/>
                </div>
                <div class="g-recaptcha">
                    <?= GetMessage("FORM_CAPTCHA_FIELD_TITLE"); ?> <?= $arResult["REQUIRED_SIGN"]; ?>
                    <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext"/>
                    <?= $arResult["REQUIRED_SIGN"]; ?> - <?= GetMessage("FORM_REQUIRED_FIELDS"); ?>
                </div>
            </div>
        </div>

    <?endif; ?>
    </br></br>
    <input type="submit" value="<?= $arResult["arForm"]["BUTTON"]; ?>" name="web_form_apply" class="submit">

    <?= $arResult["FORM_FOOTER"];
}
?>


