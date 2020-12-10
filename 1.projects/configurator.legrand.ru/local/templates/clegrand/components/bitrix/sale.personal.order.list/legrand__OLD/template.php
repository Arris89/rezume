<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");
CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);

?>
<?
global $USER;
$USER = new CUser;


$us = $USER->GetID();

$rsUser = CUser::GetByID($us);

$arUser = $rsUser->Fetch();
$us_id = $arUser['ID'];
echo "<script>
window.us_id = $us_id;
</script>";

/*
echo '<pre>'; 
print_r($arResult['ORDERS']);
echo '<pre>';*/

 ?>

 <div class="section-cabinet section-style">
        <div class="section-cabinet__container container">
          <div class="cabinet">
            <div class="cabinet__head">
              <h1 class="cabinet__title page-title"><?$APPLICATION->ShowTitle()?>
              </h1>
            </div>
            <div class="cabinet__content">
              <div class="cabinet__left">
<?
if (!$arResult['ORDERS']) {?>
  На данный момент вы не сделали еще ни одного заказа. Перейдите в раздел <a href="/configurator/">Собрать проект</a> или <a href="/specification/">Собрать спецификацию</a> и оформите новый заказ.
<?} else {?>

                <div class="cabinet__subhead">
                  <div class="basket-kit">
                    <div class="basket-kit__head">
                      <div class="basket-kit__head-left">история заказов
                      </div>
                    </div>
                  </div>
                </div>
                <?}?>

<? foreach ($arResult['ORDERS'] as $key => $value) { ?>
                <div class="cabinet__info">
                  <div class="cabinet__info-title"> <?=$value['ORDER']['ID']?> гостинная, советская
                 </div>
                  <div class="cabinet__info-list">
                    <div class="cabinet__info-date">
                      <div class="param-block">
                        <div class="param-block__key">дата:
                        </div>
                        <div class="param-block__val">
                        	<?=$value['ORDER']['DATE_INSERT_FORMATED']?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                   <div class="cabinet__bottom">
                  <div class="cabinet-bottom">
                    <div class="cabinet-bottom__btns">
                      <div class="cabinet-bottom__btn">
                        <div class="icon-text icon-text_hover" role="button">
                          <div class="icon-text__icon">
                            <svg class="icon icon_trash">
                              <use xlink:href="svg/sprite/sprite.svg#trash"></use>
                            </svg>
                          </div>
                          <div class="icon-text__text delete" data-id="<?=$value['ORDER']['ID']?>">Удалить
                          </div>
                        </div>
                      </div>
                      <div class="cabinet-bottom__btn">
                        <div class="icon-text icon-text_hover" role="button">
                          <div class="icon-text__icon">
                            <svg class="icon icon_print">
                              <use xlink:href="svg/sprite/sprite.svg#print"></use>
                            </svg>
                          </div>
                          <div class="icon-text__text">Распечатать проект
                          </div>
                        </div>
                      </div>
                      <div class="cabinet-bottom__btn"><a class="icon-text icon-text_hover" download="download" href="#"><span class="icon-text__icon">
                        <svg class="icon icon_xls">
                          <use xlink:href="svg/sprite/sprite.svg#xls"></use>
                        </svg></span><span class="icon-text__text">Скачать XLS</span></a>
                      </div>
                      <div class="cabinet-bottom__btn">
                        <div class="icon-text icon-text_hover" role="button">
                          <div class="icon-text__icon">
                            <svg class="icon icon_wrong-access">
                              <use xlink:href="svg/sprite/sprite.svg#wrong-access"></use>
                            </svg>
                          </div>
                        <div class="icon-text__text"><a href="<?=$value['ORDER']['URL_TO_DETAIL']?>" style="color: #999999;">Посмотреть детали
                          </a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
<?} ?>
              </div>

              <div class="cabinet__right">
                <div class="panel-personal">
                  <div class="panel-personal__head js-toggle-panel">
                    <div class="personal-title"><i class="fa fa-user"></i>
                      <div class="personal-title__text">личная информация
                      </div>
                    </div>
                    <div class="panel-personal__arrow"><i class="fa fa-angle-down"></i>
                    </div>
                  </div>
                  <div class="panel-personal__block">
                      <div class="personal-form__fields">
                        <div class="personal-form__field">
                          <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Имя</span></span><input class="input input-style" id="inp_name" name="name" type="text" value="<?=$arUser['NAME']?>" tabindex="0"/>
                          </label>
                        </div>
                        <div class="personal-form__field">
                          <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Фамилия</span></span><input class="input input-style" id="inp_surname" name="lastname" type="text" value="<?=$arUser['LAST_NAME']?>" tabindex="0"/>
                          </label>
                        </div>
                        <div class="personal-form__field">
                          <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Электронная почта</span></span><input class="input input-style" id="inp_email" name="email" type="text" value="<?=$arUser['EMAIL']?>" tabindex="0"/>
                          </label>
                        </div>
                        <div class="personal-form__field">
                          <label class="label-style"><span class="label-style__head"><span class="label-style__hint">Контактный телефон</span></span><input class="input input-style" id="inp_phone" name="phone" type="text" value="<?=$arUser['PERSONAL_PHONE']?>" tabindex="0"/>
                          </label>
                        </div>
                        <div class="personal-form__field">
                          <button class="personal-form__submit my-btn">Сохранить
                          </button>
                        </div>
                      </div>
                      <div id="info"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


<script>
      $(document).ready(function () {
         $('.personal-form__submit.my-btn').on('click', function (e) {

var user_name = $("#inp_name").val();
var user_surname = $("#inp_surname").val();

var user_phone = $("#inp_phone").val();


$.post('/local/templates/clegrand/ajax/profile.php', {us_id, user_name, user_surname, user_phone}, function (datald) {

    $("#info").text('Информация успешно обновлена');

            })
        });
   });



        $(document).on('click', '.icon-text__text.delete', function () {
           var id = $(this).attr('data-id');
           //alert(id);
    $.post('/local/templates/clegrand/ajax/order.php', {id}, function (data) {
    //alert(data);
    location.reload();
          })
    });
</script>