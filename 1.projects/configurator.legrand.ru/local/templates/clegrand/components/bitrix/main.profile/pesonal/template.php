<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="panel-personal">
    <div class="panel-personal__head js-toggle-panel">
        <div class="personal-title">
            <svg class="icon icon_businessman">
                  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#businessman"></use>
                </svg>
            <div class="personal-title__text">личная информация
            </div>
        </div>
        <div class="panel-personal__arrow"><svg class="icon icon_angle-right">
                  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#angle-right"></use>
                </svg></i>
        </div>
    </div>
    <div class="panel-personal__block">
        <div>
            <?ShowError($arResult["strProfileError"]);?>
            <?
            if ($arResult['DATA_SAVED'] == 'Y')
                ShowNote('Изменения сохранены.<br><br>');
            ?>
        </div>
        <form class="personal-form" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
            <?=$arResult["BX_SESSION_CHECK"]?>
            <input type="hidden" name="lang" value="<?=LANG?>" />
            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
            <div class="personal-form__fields">
                <div class="personal-form__field">
                    <label class="label-style">
                        <span class="label-style__head"><span class="label-style__hint">Имя</span></span>
                        <input class="input input-style" name="NAME" type="text" value="<?=$arResult["arUser"]["NAME"]?>" required>
                    </label>
                </div>
                <div class="personal-form__field">
                    <label class="label-style">
                        <span class="label-style__head"><span class="label-style__hint">Фамилия</span></span>
                        <input class="input input-style" name="LAST_NAME" type="text" value="<?=$arResult["arUser"]["LAST_NAME"]?>" required>
                    </label>
                </div>
                <div class="personal-form__field">
                    <label class="label-style">
                        <span class="label-style__head"><span class="label-style__hint">Электронная почта</span></span>
                        <input class="input input-style" name="EMAIL" type="email" value="<? echo $arResult["arUser"]["EMAIL"]?>" required>
                    </label>
                </div>
                <div class="personal-form__field">
                    <label class="label-style">
                        <span class="label-style__head"><span class="label-style__hint">Контактный телефон</span></span>
                        <input class="input input-style js-phone-mask" name="PERSONAL_PHONE" type="tel" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" required>
                    </label>
                </div>
                <div class="personal-form__field">
                    <label class="label-style">
                        <span class="label-style__head"><span class="label-style__hint">Новый пароль</span></span>
                        <input class="input input-style" name="NEW_PASSWORD" type="password" value="" autocomplete="off">
                    </label>
                </div>
                <div class="personal-form__field">
                    <label class="label-style">
                        <span class="label-style__head"><span class="label-style__hint">Подтверждение нового пароля</span></span>
                        <input class="input input-style" name="NEW_PASSWORD_CONFIRM" type="password" value="" autocomplete="off">
                    </label>
                </div>
                <div class="personal-form__field">
                    <input class="personal-form__submit my-btn" name="save" type="submit" value="Сохранить">
                </div>
            </div>
        </form>
    </div>
</div>