<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<? if (!empty($arResult["ERROR_MESSAGE"])) {
    foreach ($arResult["ERROR_MESSAGE"] as $v)
        ShowError($v);
}
if (strlen($arResult["OK_MESSAGE"]) > 0) {
    ?>
    <div class="mf-ok-text">Спасибо!
        Ваш заказ оформлен.<br> Мы свяжемся с вами в ближайшее время.
    </div>

    <?
    echo "<script>$('.contact-us').remove();</script>";
    ?>
<? } ?>


<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="contact-us">
    <div class="review-form-fields">
        <div id="bic-inputs-wrap">


            <?= bitrix_sessid_post() ?>


            <input type="text" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>" placeholder="Ваше имя*">

            <input type="text" name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>" placeholder="Ваш email*">

            <input type="text" name="user_tell" value="Телефон*" placeholder="Телефон*" class="telnum">


            <? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
                <div class="mf-captcha">
                    <div class="mf-text"><?= GetMessage("MFT_CAPTCHA") ?></div>
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
                         alt="CAPTCHA">
                    <div class="mf-text"><?= GetMessage("MFT_CAPTCHA_CODE") ?><span class="mf-req">*</span></div>
                    <input type="text" name="captcha_word" size="30" maxlength="50" value="">
                </div>
            <? endif; ?>

            <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">


            <? if ($arParams['USER_CONSENT'] == 'Y'): ?>
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
            <? endif; ?>


            <input type="submit" name="submit" value="Купить" class="submit">


        </div>
    </div>
</form>


