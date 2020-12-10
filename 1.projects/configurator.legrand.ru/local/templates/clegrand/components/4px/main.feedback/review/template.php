<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
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
<div class="mfeedback">
<?

if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="popup-form">
<?=bitrix_sessid_post()?>
       <div class="popup-form__fields">
                            <div class="popup-form__field">
                                <label class="label-style"><span class="label-style__head"><span
                                                class="label-style__hint">Ваше имя</span>

			<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
	{
		if($v=='Укажите ваше имя.')
		{?>
			<span class="label-style__error" style="display: inline;">Заполните поле</span>
		<?}
	}

}?>
                                            </span>
                                  <input class="input input-style" name="user_name" type="text" tabindex="0"/>

                                </label>
                            </div>
                            <div class="popup-form__field">
                                <label class="label-style"><span class="label-style__head"><span
                                                class="label-style__hint">отзыв</span>
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
	{
		if($v=='Вы не написали сообщение.')
		{?>
			<span class="label-style__error" style="display: inline;">Заполните поле</span>
		<?}
	}

}?>
                                              <!--   <span class="label-style__error">Заполните поле</span> -->

                                            </span>
                                    <textarea class="textarea-style" name="MESSAGE" cols="30" rows="10"></textarea>
                                </label>
                            </div>

                            	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

                            <div class="popup-form__send">
                                <button class="popup-form__submit my-btn" type="submit" name="submit" 
                                value="<?=GetMessage("MFT_SUBMIT")?>">Отправить
                                </button>
                            </div>
          </div>

<!-- 	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>"> -->
</form>
</div>