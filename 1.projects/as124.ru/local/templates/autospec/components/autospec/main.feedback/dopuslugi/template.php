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
} ?>


<?php if (strlen($arResult["OK_MESSAGE"]) > 0) { ?>
    <div class="modal__img-thanks"></div>
<?
} else { ?>


    <form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="mainform__container">


        <?= bitrix_sessid_post() ?>
        <div class="mainform__block mainform__block_active" data-id="1">

            <div class="form__item form__item_inline-block">
                <div class="form__label">Имя *</div>

                <input type="text" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>" class="field">
            </div>


            <div class="form__item form__item_inline-block">
                <div class="form__label">Телефон *</div>
                <input type="text" name="user_tell" value="<?= $arResult["AUTHOR_EMAIL"] ?>" class="field phone-mask">
            </div>


            <div class="label__block">

                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.userconsent.request",
                    "footer1",
                    Array(
                        "AUTO_SAVE" => "N",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "ID" => "1",
                        "IS_CHECKED" => "Y",
                        "IS_LOADED" => "N"
                    )
                ); ?>
            </div>


            <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
            <input type="submit" name="submit" value="<?= GetMessage("MFT_SUBMIT") ?>" style="    position: relative;
    display: inline-block;
    text-decoration: none;
    padding: 15px 25px;
    font-size: 16px;
    line-height: 18px;
    text-align: center;
    color: #ffffff;
    border-radius: 3px;
    background-color: #243762;
    -webkit-transition: all .3s;
    -o-transition: all .3s;
    transition: all .3s;
    border: 1px solid transparent;">

    </form>
<? } ?>