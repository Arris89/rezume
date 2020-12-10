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


if (!empty($arResult["ERROR_MESSAGE"])) {
    foreach ($arResult["ERROR_MESSAGE"] as $v)
        ShowError($v);
}
if (strlen($arResult["OK_MESSAGE"]) > 0) {
    ?>
    <div class="mf-ok-text"><?= $arResult["OK_MESSAGE"] ?></div><?
}
?>

<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="get-price__form contact-form">
    <div class="contact-form__inner">

        <?= bitrix_sessid_post() ?>

        <div class="contact-form__item">
            <input type="text" class="contact-form__input" name="user_name" type="email"
                   value="<?= $arResult["NAME"] ?>" placeholder="Ваше имя">
        </div>

        <div class="contact-form__item">
            <input type="text" class="contact-form__input" name="user_tell" type="tel"
                   value="<?= $arResult["AUTHOR_TELL"] ?>" placeholder="Ваш телефон">
        </div>

        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <div class="contact-form__btn-area">
            <input class="contact-form__btn btn" type="submit" value="Перезвоните мне">
        </div>

    </div>
</form>
