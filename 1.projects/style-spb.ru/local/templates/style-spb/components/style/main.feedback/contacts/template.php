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



<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>


<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="opt_form">
<?=bitrix_sessid_post()?>



	<input type="text" name="user_name" class="fti" placeholder="Имя*" required="" value="<?=$arResult["AUTHOR_NAME"]?>"><br> 
	<input type="text" name="SURNAME" class="fti" placeholder="Фамилия*" required=""><br> 
	<input type="text" name="FIRM" class="urlic" placeholder="Название юридического лица*" required=""><br>
	<input type="tel" name="PHONE" class="urlic" placeholder="Телефон*" required=""><br> 
	<input type="email" name="user_email" class="urlic" placeholder="E-mail" value="<?=$arResult["AUTHOR_EMAIL"]?>"><br> 
	<input type="text" name="CITY" class="urlic" placeholder="Город*" required=""> <br>
<select class="inputselect" name="STORE" id="form_dropdown_opt_mag" placeholder="Тип магазина">
<option value="" disabled="disabled" selected="selected">Тип магазина</option>
<option value="отдельно стоящий  магазин">Отдельно стоящий магазин</option>
<option value="магазин в торговом центре">Магазин в торговом центре</option>
<option value="планирую открытие">Планирую открытие</option>
<option value="совместные закупки">совместные закупки</option>
<option value="другое">другое</option>
</select>
<br> 


	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
</form>
