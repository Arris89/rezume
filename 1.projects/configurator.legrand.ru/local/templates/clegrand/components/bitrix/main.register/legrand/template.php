<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>

    <form class="register-form" action="<?=$this->GetFolder()?>/ajax.php" name="register-form" enctype="multipart/form-data">
        <input type="hidden" name="success" value="<?=$arParams['SUCCESS_PAGE']?>">
        <div class="register-form__errors"></div>
        <div class="register-form__success"></div>
        <div class="register-form__fields">
            <?foreach ($arResult['FIELDS'] as $field){?>
                <div class="register-form__field">
                    <label class="label-style">
                        <span class="label-style__head">
                            <span class="label-style__hint"><?=GetMessage("REGISTER_FIELD_".$field)?></span>
                            <span class="label-style__error">Заполните поле</span>
                        </span>
                        <?switch ($field){
                            case 'PASSWORD':
                            case 'CONFIRM_PASSWORD':?>
                                <input class="input input-style" name="<?=$field?>" type="password" autocomplete="off">
                            <?break;
                            case 'EMAIL':?>
                                <input class="input input-style" name="<?=$field?>" type="email">
                                <?break;
                            case 'PERSONAL_PHONE':?>
                                <input class="input input-style js-phone-mask" name="<?=$field?>" type="tel">
                                <?break;
                            default:?>
                                <input class="input input-style" name="<?=$field?>" type="text">
                            <?break;?>
                        <?}?>
                    </label>
                </div>
            <?}?>
            <div class="register-form__field">
                <button type="submit" class="submit my-btn">Зарегистрироваться</button>
            </div>
            <div class="register-form__field">
                <div class="checker">
                    <label class="checker__label">
                        <input class="input checker__checkbox" name="agree" type="checkbox" value="on" checked>
                        <span class="checker__box checker__box_2"><span class="check-icon"></span></span>
                        <span class="checker__text">Я согласен на обработку персональных данных и ознакомился с правилами</span>
                    </label>
                </div>
            </div>
        </div>
    </form>
<?endif?>
