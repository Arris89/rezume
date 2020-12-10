<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="section-style container">
    <div class="page-title">Подтверждение регистрации</div>
    <br>
    <div style="margin-bottom: 20px">
        <p><? echo $arResult["MESSAGE_TEXT"] ?></p>
    </div>
    <? //here you can place your own messages
    switch ($arResult["MESSAGE_CODE"]) {
        case "E01":
            ?><? //When user not found
            break;
        case "E02":
            ?><? //User was successfully authorized after confirmation
            break;
        case "E03":
            ?><? //User already confirm his registration
            break;
        case "E04":
            ?><? //Missed confirmation code
            break;
        case "E05":
            ?><? //Confirmation code provided does not match stored one
            break;
        case "E06":
            ?><? //Confirmation was successfull
            break;
        case "E07":
            ?><? //Some error occured during confirmation
            break;
    }
    ?>
    <? if ($arResult["SHOW_FORM"]): ?>
        <form class="decor-form" method="post" action="<? echo $arResult["FORM_ACTION"] ?>">
            <div class="decor-form__fields">
                <div class="decor-form__field">
                    <label class="label-style">
                    <span class="label-style__head">
                        <span class="label-style__hint"><? echo GetMessage("CT_BSAC_LOGIN") ?></span></span>
                        <input class="input input-style" type="text" name="<? echo $arParams["LOGIN"] ?>" maxlength="50"
                               value="<? echo $arResult["LOGIN"] ?>"/>
                    </label>
                </div>
                <div class="decor-form__field">
                    <label class="label-style">
                    <span class="label-style__head">
                        <span class="label-style__hint"><? echo GetMessage("CT_BSAC_CONFIRM_CODE") ?></span></span>
                        <input class="input input-style" type="text" name="<? echo $arParams["CONFIRM_CODE"] ?>"
                               maxlength="50" value="<? echo $arResult["CONFIRM_CODE"] ?>"/>
                    </label>
                </div>
                <div class="decor-form__row">
                    <div class="decor-form__field">
                        <input class="my-btn" type="submit" value="<? echo GetMessage("CT_BSAC_CONFIRM") ?>"/>
                    </div>
                </div>
            </div>
            <input type="hidden" name="<? echo $arParams["USER_ID"] ?>" value="<? echo $arResult["USER_ID"] ?>"/>
        </form>
    <? elseif (!$USER->IsAuthorized()): ?>
    </div>
        <? $APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "", array()); ?>
    <div>
    <? endif ?>
</div>