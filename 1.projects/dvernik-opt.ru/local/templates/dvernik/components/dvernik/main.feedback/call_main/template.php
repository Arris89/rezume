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
$('.popup__text').remove();
$('#form-pop1').remove();
$('.popup__title.title.title_h3').text('Заявка отправлена!');
$('.popup__title.title.title_h3').after('<p class=popup__text>В ближайшее время с Вами свяжется наш менеджер и ответит на все Ваши вопросы!</p>');
</script>";


    ?>

<? } ?>


<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="popup__form contact-form contact-form_popup">
    <?= bitrix_sessid_post() ?>
    <div class="contact-form__inner" id="form-pop1">


        <div class="contact-form__item">
            <input type="text" class="contact-form__input" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>"
                   placeholder="Ваше имя" required="">
        </div>


        <div class="contact-form__item">
            <input type="text" class="contact-form__input" name="user_tell" value="<?= $arResult["AUTHOR_TELL"] ?>"
                   placeholder="Ваш телефон" required="">
        </div>


        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <input type="submit" name="submit" value="Перезвоните мне" class="contact-form__btn btn">

    </div>
</form>
