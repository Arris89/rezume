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


    echo "<script>

$('.popup__item_call-success').fadeIn(200);
$('.popup').fadeIn(200);
</script>";


} ?>


<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="get-price__form contact-form">
    <?= bitrix_sessid_post() ?>
    <div class="contact-form__inner">

        <div class="contact-form__item">
            <input type="text" class="contact-form__input" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>"
                   placeholder="Ваше имя" required="">
        </div>

        <div class="contact-form__item">
            <input type="text" class="contact-form__input" name="user_tell" value="<?= $arResult["AUTHOR_TELL"] ?>"
                   placeholder="Ваш телефон" required="">
        </div>

        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">

        <div class="contact-form__btn-area">
            <input type="submit" name="submit" value="Перезвоните мне" class="contact-form__btn btn">
        </div>

    </div>
</form>


