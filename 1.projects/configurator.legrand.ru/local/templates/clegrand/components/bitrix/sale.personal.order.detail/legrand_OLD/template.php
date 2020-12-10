<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

if ($arParams['GUEST_MODE'] !== 'Y')
{
	Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
	Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
}
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");

CJSCore::Init(array('clipboard', 'fx'));

$APPLICATION->SetTitle("");

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach ($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}

	$component = $this->__component;

	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}
}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach ($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	?>

	

		<?
		if ($arParams['GUEST_MODE'] !== 'Y')
		{
			?>
			<a class="sale-order-detail-back-to-list-link-up" href="<?= htmlspecialcharsbx($arResult["URL_TO_LIST"]) ?>">
				&larr; <?= Loc::getMessage('SPOD_RETURN_LIST_ORDERS') ?>
			</a>
			<?
		}

	}
		?>


<?
/*echo '<pre>'; 
print_r($arResult['BASKET']);
echo '<pre>';*/
?> 


		<h1 class="sale-order-detail-title-element">
				<?= Loc::getMessage('SPOD_LIST_MY_ORDER', array(
					'#ACCOUNT_NUMBER#' => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]),
					'#DATE_ORDER_CREATE#' => $arResult["DATE_INSERT_FORMATED"]
				)) ?>
			</h1>
		
 <div class="section-cabinet section-style">
        <div class="section-cabinet__container container">
          <div class="cabinet">
      
            <div class="cabinet__content">
              <div class="cabinet__left">
         
                <div class="cabinet__info">
                  <div class="cabinet__info-title">Комплект Орех
                  </div>
                  <div class="cabinet__info-list">
       
                  </div>
                </div>
                <div class="cabinet__table">
                  <div class="m-table m-table_basket">
                    <div class="m-table__head">
                      <div class="m-table__head-item m-table-column-1">СОСТАВ КОМПЛЕКТУЮЩИХ
                      </div>
                      <div class="m-table__head-item m-table-column-2"><!-- КОЛ-ВО (шт.) -->
                      </div>
                      <div class="m-table__head-item m-table-column-3">СТОИМОСТЬ
                      </div>
                    </div>



                    <div class="m-table__content">
                      


<?




foreach ($arResult['BASKET'] as $key => $value) {


	foreach ($value['PROPS'] as $key1 => $value1) {
	if ($value1['NAME']=='KOMP') {
		$comp = $value1['VALUE'];
	} 

	if ($value1['NAME']=='ARTICUL') {
		$art = $value1['VALUE'];
	}
}

?>

<?

/*Получение постов*/
$IDcatalog = \FourPx\Helper::getIblockIdByCodes('catalog')["catalog"];
$res = CIBlockElement::GetProperty($IDcatalog, $value['PRODUCT_ID'], "sort", "asc", array("CODE" => "POSTS"));
    if ($ob = $res->GetNext())
    {
        $Posts = $ob['VALUE'];
    }


    /*Получение типа товара*/
$IDcatalog = \FourPx\Helper::getIblockIdByCodes('catalog')["catalog"];
$res = CIBlockElement::GetProperty($IDcatalog, $value['PRODUCT_ID'], "sort", "asc", array("CODE" => "TYPE"));
    if ($ob = $res->GetNext())
    {
        $Type = $ob['VALUE_ENUM'];
    }

/*Получение картинок*/
if ($Type =='Рамки') {
	$IDcatalog = \FourPx\Helper::getIblockIdByCodes('catalog')["catalog"];
$res = CIBlockElement::GetProperty($IDcatalog, $value['PRODUCT_ID'], "sort", "asc", array("CODE" => "GORIZ_IMG"));
    if ($ob = $res->GetNext())
    {
        $frameImg = CFile::GetFileArray($ob['VALUE']);
    }
} else {
	$IDcatalog = \FourPx\Helper::getIblockIdByCodes('catalog')["catalog"];
$res = CIBlockElement::GetProperty($IDcatalog, $value['PRODUCT_ID'], "sort", "asc", array("CODE" => "FUNCTION_IMG"));
    if ($ob = $res->GetNext())
    {
        $functImg = CFile::GetFileArray($ob['VALUE']);
    }
}


    /*Получение цвета*/
if ($Type =='Рамки') {
	$IDcatalog = \FourPx\Helper::getIblockIdByCodes('catalog')["catalog"];
$res = CIBlockElement::GetProperty($IDcatalog, $value['PRODUCT_ID'], "sort", "asc", array("CODE" => "COLOR_RAM"));
    if ($ob = $res->GetNext())
    {
        $frameCol = $ob['VALUE_ENUM'];
    }
} else {
	$IDcatalog = \FourPx\Helper::getIblockIdByCodes('catalog')["catalog"];
$res = CIBlockElement::GetProperty($IDcatalog, $value['PRODUCT_ID'], "sort", "asc", array("CODE" => "COLOR_MEX"));
    if ($ob = $res->GetNext())
    {
        $functCol = $ob['VALUE_ENUM'];
    }
}



    $Posts = (integer)$Posts;
?>
            
                      <div class="m-table__body">
                        <div class="m-table__body-item m-table-column-1">
                          <div class="m-table__desktop">
                            <div class="kit-good">
                              <div class="kit-good__image">

     <?
		if ($Type=='Рамки') {?>
	<img src="<?=$frameImg['SRC']?>" alt="" role="presentation"/>
		<?} else {?>
	<img src="<?=$functImg['SRC']?>" alt="" role="presentation"/>
	<?}?>
         
                              </div>
                              <div class="kit-good__content">
                                <div class="kit-good__name"><?=$art?>
                                </div>
          
     		                    <div class="kit-good__text"><?=$value['NAME']?> 
<?
 if($Type=='Рамки')
 {
if($Posts == 1)
{
echo $Posts.' пост';
}
elseif(($Posts==2) or ($Posts==3) or ($Posts==4))
{
echo $Posts.' поста';
}
else
{
echo $Posts.' постов';
}
}
?>

                          - 
<?if ($Type=='Рамки') {
	echo $frameCol;
}
else
{
echo $functCol;
}

?>

                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="m-table__mob"><strong><?=$art?></strong> <?=$value['NAME']?> 

<?

if($Type=='Рамки')
{
if($Posts == 1)
{
echo $Posts.' пост';
}
elseif(($Posts==2) or ($Posts==3) or ($Posts==4))
{
echo $Posts.' поста';
}
else
{
echo $Posts.' постов';
}
}

?>

                           - <?if ($Type=='Рамки') {
	echo $frameCol;
}
else
{
echo $functCol;
}

?>
                          </div>
                        </div>
                        <div class="m-table__body-item m-table-column-2">
                          <div class="m-table__mob">
                            <div class="m-table__row">
                              <div class="m-table__row-left">
                                <div class="kit-mob">
                                  <div class="kit-mob__image">

                            <?
		if ($Type=='Рамки') {?>
	<img src="<?=$frameImg['SRC']?>" alt="" role="presentation"/>
		<?} else {?>
	<img src="<?=$functImg['SRC']?>" alt="" role="presentation"/>
	<?}?>
                                  </div>
                                  <div class="kit-mob__price">ЦЕНА:
                                  </div>
                                  <div class="kit-mob__price-val"><?=$value['BASE_PRICE']?> руб.
                                  </div>
                                </div>
                              </div>
                              <div class="m-table__row-right">кол-во: <strong>10</strong>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="m-table__body-item m-table-column-3"><?=$value['BASE_PRICE']?> руб.
                        </div>
                      </div>
   <? $FullPrice += $value['BASE_PRICE']; ?>
					<?}?>

                    </div>




                  </div>
                </div>



                <div class="cabinet__bottom">
                  <div class="cabinet-bottom">

              <!--       <div class="cabinet-bottom__btns">
                <div class="cabinet-bottom__btn">
                  <div class="icon-text icon-text_hover" role="button">
                    <div class="icon-text__icon">
                      <svg class="icon icon_trash">
                        <use xlink:href="svg/sprite/sprite.svg#trash"></use>
                      </svg>
                    </div>
                    <div class="icon-text__text delete" data-id="<?=$value['ORDER_ID']?>">Удалить
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
                    <div class="icon-text__text">Посмотреть детали
                    </div>
                  </div>
                </div>
              </div> -->


                    <div class="cabinet-bottom__price">
                      <div class="cabinet-bottom__settings">
                        <div class="cabinet-bottom__setting">
                          <div class="param-block">
                            <div class="param-block__key">Магазин:
                            </div>
                            <div class="param-block__val">220 city
                            </div>
                          </div>
                        </div>
                        <div class="cabinet-bottom__setting">
                          <div class="param-block">
                            <div class="param-block__key">тел.:
                            </div>
                            <div class="param-block__val">+7 (495) 122-22-59
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="p-price p-price_inline">
                        <div class="p-price__text">стоимость <br> комплекта
                        </div>
                        <div class="p-price__value"><span><?=$FullPrice?> </span> руб.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>



              </div>
        
            </div>
          </div>
        </div>
      </div>

