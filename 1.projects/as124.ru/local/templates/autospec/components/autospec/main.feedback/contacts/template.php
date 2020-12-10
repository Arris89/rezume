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

    <form class="contacts__form-block">
        <h2 class="contacts__caption">Напишите нам</h2>
        <div class="contacts__phone">
            <span>Или позвоните сами на </span>
            <a href="tel:+73912729279">+7 391 27-29-279</a>
        </div>
        <div class="contacts__form-block1"></div>
    </form>

<?
} else { ?>


    <form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="contacts__form-block">
        <h2 class="contacts__caption">Напишите нам</h2>
        <div class="contacts__phone">
            <span>Или позвоните сами на </span>
            <a href="tel:+73912729279">+7 391 27-29-279</a>
        </div>


        <?= bitrix_sessid_post() ?>


        <div class="form__item form__item_bottom">
            <div class="form__label">Имя</div>
            <input type="text" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>" class="field">
        </div>


        <div class="form__item form__item_bottom">
            <div class="form__label">E-mail</div>
            <input type="text" name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>" class="field">
        </div>


        <div class="form__item form__item_bottom">
            <div class="form__label">Текст</div>
            <textarea name="MESSAGE" class="field field_text" rows="5" cols="40"><?= $arResult["MESSAGE"] ?></textarea>
        </div>


        <div class="label__item">
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