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


<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="contact-us">

    <?= bitrix_sessid_post() ?>

    <div class="review-form-fields">

        <div id="callback-inputs-wrap" style="display: block;">
            <input type="text" name="user_tell" value="<?= $arResult["AUTHOR_TELL"] ?>" placeholder="+_(___)___-__-__"
                   class="telnum">


            <div class="">

                <input type="submit" name="submit" value="Заказать" class="submit" style="margin: 0 auto;">

            </div>

        </div>


        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">


    </div>
</form>
