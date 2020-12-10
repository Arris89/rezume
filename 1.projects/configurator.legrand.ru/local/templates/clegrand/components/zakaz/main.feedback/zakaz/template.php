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

<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="decor-form" >
<?=bitrix_sessid_post()?>
     <div class="decor-form__fields">
                      <div class="decor-form__field">
                        <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Ваше имя</span><span class="label-style__error">Заполните поле</span></span>
                        <input type="text" class="input input-style" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>" tabindex="0">
                        </label>
                      </div>
                      <div class="decor-form__field">
                        <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Фамилия</span><span class="label-style__error">Заполните поле</span></span><input class="input input-style" name="second_name" type="text" tabindex="0"/>
                        </label>
                      </div>
                      <div class="decor-form__field input-error">
                        <label class="label-style"><span class="label-style__head"><span class="label-style__hint">контактный телефон</span><span class="label-style__error">Заполните поле</span></span><input class="input input-style js-phone-mask" name="name" type="text" tabindex="0"/>
                        </label>
                      </div>
                      <div class="decor-form__field">
                        <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Электронная почта</span><span class="label-style__error">Заполните поле</span></span>
                        	<!-- <input class="input input-style" name="second_name" type="text" tabindex="0"/> -->
                        	<input class="input input-style" type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>" tabindex="0">
                        </label>
                      </div>
                      <div class="decor-form__field decor-form__field_wide">
                        <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Ваш комментарий</span><span class="label-style__error">Заполните поле</span></span><input class="input input-style" name="second_name" type="text" tabindex="0"/>
                        </label>
                      </div>

                      	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
							

                      <div class="decor-form__row">
                        <div class="decor-form__field">
                         <input type="submit" name="submit" value="ОФОРМИТЬ ЗАКАЗ" class="my-btn">
                        </div>
                        <div class="decor-form__field decor-form__field_checker">
                          <div class="checker">

<?if ($arParams['USER_CONSENT'] == 'Y'):?>
     <?$APPLICATION->IncludeComponent(
      "bitrix:main.userconsent.request",
      "zakaz",
      array(
          "ID" => $arParams["USER_CONSENT_ID"],
          "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
          "AUTO_SAVE" => "Y",
          "IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
          "REPLACE" => array(
           'button_caption' => 'Подписаться!',
           'fields' => array('Email', 'Телефон', 'Имя')
          ),
      )
     );?>
    <?endif;?>
                 

                          </div>
                        </div>
                      </div>
                    </div>



		<!-- <input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
		
		
		<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
		 -->

	
<!-- 		<textarea name="MESSAGE" rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea> -->

</form>
