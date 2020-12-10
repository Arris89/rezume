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
                <div class="form__label">Место отправления *</div>
                <input type="text" name="text" class="field" placeholder="">
            </div>

            <div class="form__item form__item_inline-block">
                <div class="form__label">Место прибытия *</div>
                <input type="text" name="text" class="field" placeholder="">
            </div>

            <div class="form__item form__item_bottom">
                <button type="submit" class="btn btn_mainform btn_mainform--js" data-next-step="2">Далее</button>
            </div>

        </div>


        <div class="mainform__block" data-id="2">
            <div class="form__item form__item_coll">
                <div class="form__label">Ширина, м</div>
                <input type="text" name="text" class="field" placeholder="">
            </div>
            <div class="form__item form__item_coll">
                <div class="form__label">Длина, м</div>
                <input type="text" name="text" class="field" placeholder="">
            </div>
            <div class="form__item form__item_coll">
                <div class="form__label">Высота, м</div>
                <input type="text" name="text" class="field" placeholder="">
            </div>
            <div class="form__item form__item_coll">
                <div class="form__label">Масса, м</div>
                <input type="text" name="text" class="field" placeholder="">
            </div>
            <div class="form__item form__item_coll">
                <div class="form__label">Объем, м3</div>
                <input type="text" name="text" class="field" placeholder="">
            </div>
            <div class="form__item">
                <select class="js-example-responsive">
                    <option value="0">Тип перевозки</option>
                    <option value="1">Негабаритный груз</option>
                    <option value="2">Пункт 2</option>
                    <option value="3">Пункт 3</option>
                    <option value="4">Пункт 4</option>
                </select>
            </div>
            <div class="form__item form__item_text">
                <div class="form__label">Дополнительный комментарий</div>
                <textarea name="text" class="field field_text" placeholder=""></textarea>
            </div>
            <div class="form__item form__item_bottom">
                <button type="submit" class="btn btn_mainform btn_mainform--js" data-next-step="3">Далее</button>
                <button class="btn btn_return btn_mainform--js" data-next-step="1">Назад</button>
            </div>
        </div>


        <div class="mainform__block" data-id="3">

            <div class="form__item form__item_block">
                <div class="form__label">Имя *</div>
                <input type="text" class="field" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>"></div>

            <div class="form__item form__item_block">
                <div class="form__label">E-mail *</div>
                <input type="text" class="field" name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>">
            </div>
            <div class="form__item form__item_block">
                <div class="form__label">Телефон *</div>
                <input type="text" class="field" name="user_tell" value="<?= $arResult["AUTHOR_TELL"] ?>">
            </div>


            <div class="form-item">
                <label class="label--checkbox">
                    <input type="checkbox" class="checkbox checkbox-politic" checked="">
                    <a href="#" class="label-desc">Я даю свое согласие на обработку персональных данных</a>
                </label>
                <div class="result"></div>
            </div>
            <div class="form__item form__item_bottom">

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
                <button class="btn btn_return btn_mainform--js" data-next-step="2">Назад</button>


                <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">

            </div>
        </div>

        <div class="mainform__block" data-id="4">
            <div class="mainform__thanks mainform__thanks_page-home"></div>
        </div>

    </form>
<? } ?>