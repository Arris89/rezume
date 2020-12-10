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
    <div class="mf-ok-text"><?= $arResult["OK_MESSAGE"] ?></div><?
}
?>


<form action="<?= POST_FORM_ACTION_URI ?>" method="POST"  style="text-align: center;">



            <?= bitrix_sessid_post() ?>


            <input type="text" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>" placeholder="Ваше имя*">


            <input type="text" name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>" placeholder="Ваш email*">


            <textarea name="MESSAGE" placeholder="Текст"><?= $arResult["MESSAGE"] ?></textarea>


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

            <input type="submit" name="submit" value="Публиковать" class="submit" style=" padding: 0 30px 0 40px;">



</form>


