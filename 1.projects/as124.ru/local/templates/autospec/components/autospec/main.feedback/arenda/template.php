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


    <form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="modal__form">
        <?= bitrix_sessid_post() ?>


        <div class="form__item">
            <div class="form__label">Имя *</div>


            <input type="text" name="user_name" class="field" value="<?= $arResult["AUTHOR_NAME"] ?>" placeholder=""
                   required="">
        </div>


        <div class="form__item">
            <div class="form__label">Телефон *</div>


            <input type="text" name="user_tell" class="field phone-mask" value="<?= $arResult["AUTHOR_EMAIL"] ?>">
        </div>


        <div class="form__item">
            <div class="form__label">Укажите какая техника, вид работ</div>

            <textarea name="MESSAGE" class="field field_text"><?= $arResult["MESSAGE"] ?></textarea>
        </div>


        <div class="form-item">
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


        <div class="form__item form__item_bottom">

            <input type="submit" name="submit" value="<?= GetMessage("MFT_SUBMIT") ?>" style="font-size: 16px;
    line-height: 18px;
    text-align: center;
    color: #ffffff;
    border-radius: 3px;
    background-color: #243762;
    -webkit-transition: all .3s;
    -o-transition: all .3s;
    transition: all .3s;
    border: 1px solid transparent;
    padding: 15px 25px;">
        </div>
    </form>

<? } ?>