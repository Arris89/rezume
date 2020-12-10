<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>

   <div class="section-decor section-style">
        <div class="section-decor__container container">
          <div class="basket">
            <div class="basket__head">
              <h1 class="basket__title page-title">оформление заказа
              </h1>
              <div class="basket__nav">
                <div class="basket-nav">
                  <div class="basket-nav__list"><a class="basket-nav__item" href="/basket.html"><span class="basket-nav__icon">
                    <svg class="icon icon_list-on-window">
                      <use xlink:href="svg/sprite/sprite.svg#list-on-window"></use>
                    </svg></span><span class="basket-nav__text">состав заказа</span><span class="basket-nav__arrow">
                    <svg class="icon icon_angle-right">
                      <use xlink:href="svg/sprite/sprite.svg#angle-right"></use>
                    </svg></span></a><a class="basket-nav__item" href="/receiving-order.html"><span class="basket-nav__icon">
                    <svg class="icon icon_placeholder">
                      <use xlink:href="svg/sprite/sprite.svg#placeholder"></use>
                    </svg></span><span class="basket-nav__text">выберите магазин партнера</span><span class="basket-nav__arrow">
                    <svg class="icon icon_angle-right">
                      <use xlink:href="svg/sprite/sprite.svg#angle-right"></use>
                    </svg></span></a>
                    <div class="basket-nav__item basket-nav__item_active">
                      <div class="basket-nav__icon">
                        <svg class="icon icon_id-card">
                          <use xlink:href="svg/sprite/sprite.svg#id-card"></use>
                        </svg>
                      </div>
                      <div class="basket-nav__text">Даные покупателя
                      </div>
                      <div class="basket-nav__arrow">
                        <svg class="icon icon_angle-right">
                          <use xlink:href="svg/sprite/sprite.svg#angle-right"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="decor">
            <div class="decor__title">данные покупателя
            </div>
            <div class="decor__content">
              <div class="decor__left">
                <div class="decor__form">

<?
$APPLICATION->IncludeComponent(
	"zakaz:main.feedback", 
	"zakaz", 
	array(
		"USE_CAPTCHA" => "N",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "my@email.com",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"COMPONENT_TEMPLATE" => "zakaz",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N"
	),
	false
);
?>

                </div>
              </div>
              <div class="decor__right">
                <div class="decor__register-text"> 
                	<?
						$APPLICATION->IncludeFile(SITE_DIR."include/zakaz.php", array(), 
						array(
						"MODE" => "html",
						"NAME" => "Block",
						)
					);?>
                </div>
                <div class="decor__shop">
                  <div class="decor__shop-name">Данные магазина партнера
                  </div>
                  <div class="decor__shop-text">
                  	<?	CModule::IncludeModule('iblock');
						$arSelect = Array("ID", "IBLOCK_ID", "NAME");
						$arFilter = Array("IBLOCK_ID"=>21, "ID"=>1335, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
						$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
						while($ob = $res->GetNextElement()){ 
 						$arFields = $ob->GetFields();  
 						$arProps = $ob->GetProperties();
						}				 
					?>
                  	<span><?=$arFields['NAME']?></span>      
                  	<?=$arProps['ADRESS']['VALUE']?>
                  </div>
                </div>
                <div class="decor__price">
                  <div class="p-price">
                    <div class="p-price__text">итоговая стоимость
                    </div>
                    <div class="p-price__value"><span> 5 310,20 </span> руб.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>