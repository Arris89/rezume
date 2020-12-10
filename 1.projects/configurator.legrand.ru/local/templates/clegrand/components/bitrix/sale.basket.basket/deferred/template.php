<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

global $USER;

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
  $arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
  $templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
  $templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
  $arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
  if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
  {
    $arParams['TEMPLATE_THEME'] = 'blue';
  }
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
  $arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
  $arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
  $arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
  $arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
  $arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

  CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

  $giftParameters = array(
    'SHOW_PRICE_COUNT' => 1,
    'PRODUCT_SUBSCRIPTION' => 'N',
    'PRODUCT_ID_VARIABLE' => 'id',
    'USE_PRODUCT_QUANTITY' => 'N',
    'ACTION_VARIABLE' => 'actionGift',
    'ADD_PROPERTIES_TO_BASKET' => 'Y',
    'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

    'BASKET_URL' => $APPLICATION->GetCurPage(),
    'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
    'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
    'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

    'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
    'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
    'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],

    'DETAIL_URL' => isset($arParams['GIFTS_DETAIL_URL']) ? $arParams['GIFTS_DETAIL_URL'] : null,
    'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
    'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
    'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
    'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
    'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
    'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
    'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
    'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
    'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

    'PRODUCT_ROW_VARIANTS' => '',
    'PAGE_ELEMENT_COUNT' => 0,
    'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
      SaleProductsGiftBasketComponent::predictRowVariants(
        $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
        $arParams['GIFTS_PAGE_ELEMENT_COUNT']
      )
    ),
    'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

    'ADD_TO_BASKET_ACTION' => 'BUY',
    'PRODUCT_DISPLAY_MODE' => 'Y',
    'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
    'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
    'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
    'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
    'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

    'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
    'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
    'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
  );
}

\CJSCore::Init(array('fx', 'popup', 'ajax'));

//$this->addExternalCss('/bitrix/css/main/bootstrap.css');
/*$this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

$this->addExternalJs($templateFolder.'/js/mustache.js');
$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');*/

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
  ? $arParams['COLUMNS_LIST_MOBILE']
  : $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
  include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';






/*if (empty($arResult['ERROR_MESSAGE']))
{*/


$gips = 0;
//$beton = 0;

/*Получение выпадающего списка для стен*/
                      $IDWalls = \FourPx\Helper::getIblockIdByCodes('walls')["walls"];
                                    $arSelect = Array("ID", "NAME");
                                    $arFilter = Array("IBLOCK_ID"=> $IDWalls, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                                    while($ob = $res->GetNextElement())
                                    {
                                        $arFields = $ob->GetFields();
                                        $WallsList[] = $arFields['NAME'];
                                    }

/*Получение выпадающего списка для помещений*/
                               $IDRooms = \FourPx\Helper::getIblockIdByCodes('rooms')["rooms"];
                                    $arSelect = Array("ID", "NAME");
                                    $arFilter = Array("IBLOCK_ID"=>  $IDRooms, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                                    while($ob = $res->GetNextElement())
                                    {
                                        $arFields = $ob->GetFields();
                                        $RoomsList[] = $arFields['NAME'];
                                    }




if(!$USER->IsAuthorized())

{

  $dbBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "DELAY" => "Y",
            "ORDER_ID" => null
        ),
        false,
        false,
        array()
    );

}
else
{

$user = $USER->GetID();
  $dbBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "USER_ID" => $user,
            "LID" => SITE_ID,
            "DELAY" => "Y",
            "ORDER_ID" => null
        ),
        false,
        false,
        array()
    );

}

    while ($arItems = $dbBasketItems->Fetch()){
        $arBasketItems[] = $arItems;

}


/*echo '<pre>'; 
print_r($arBasketItems);
echo '<pre>';*/




foreach ($arBasketItems as $key => $value) {

  $db_res = CSaleBasket::GetPropsList(
        array(
                "SORT" => "ASC",
                "NAME" => "ASC"
            ),
        array("BASKET_ID" => $value['ID'])
    );




    while ($ar_res = $db_res->Fetch())
    {


/*echo '<pre>'; 
print_r($ar_res);
echo '<pre>';*/



  
      if($ar_res['NAME']=='ARTICUL')
      {
        $value['ARTICUL'] = $ar_res['VALUE'];
      }



      if($ar_res['NAME']=='KOMP')
      {
         $arRes[$ar_res['VALUE']][] = $value;
         $comp = $ar_res['VALUE'];
      }


         if($ar_res['NAME']=='MEXLIST')
      {
        
        $arRes[$comp]['mexlist'] = $ar_res['VALUE'];
      }

       if($ar_res['NAME']=='ROOM')
      {
         $arRes[$comp]['room'] = $ar_res['VALUE'];
      }

       if($ar_res['NAME']=='WALLS')
      {
         $arRes[$comp]['walls'] = $ar_res['VALUE'];
      }

   if($ar_res['NAME']=='ORIENTATION')
      {
        $arRes[$comp]['orientation'] = $ar_res['VALUE'];
      }

        if($ar_res['NAME']=='URL')
      {
        $arRes[$comp]['url'] = $ar_res['VALUE'];
      }

          if($ar_res['NAME']=='MEX')
      {
        $value['MEX'] = $ar_res['VALUE'];
        //var_dump($ar_res['VALUE']);
         //$arRes[$comp]['mex'] .= $ar_res['VALUE'];
      }

   
    }


  }



/*echo '<pre>'; 
print_r($arRes);
echo '<pre>';*/

?>



      <div class="section-basket section-style">
        <div class="section-basket__container container">
          <div class="basket basket-real">
            <div class="basket__head">
              <h1 class="basket__title page-title"> <?$APPLICATION->ShowTitle()?>
              </h1>

       <!--        <div class="basket__nav">
         <div class="basket-nav">
           <div class="basket-nav__list">
             <div class="basket-nav__item basket-nav__item_active">
               <div class="basket-nav__icon">
                 <svg class="icon icon_list-on-window">
                   <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#list-on-window"></use>
                 </svg>
                 i.fa.fa-list-alt
               </div>
               <div class="basket-nav__text">состав заказа
               </div>
               <div class="basket-nav__arrow">
                 <svg class="icon icon_angle-right">
                   <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#angle-right"></use>
                 </svg>
               </div>
             </div>
             <div class="basket-nav__item">
               <div class="basket-nav__icon">
                 <svg class="icon icon_placeholder">
                   <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#placeholder"></use>
                 </svg>
                 i.fa.fa-map-marker
               </div>
               <div class="basket-nav__text">выберите магазин партнера
               </div>
               <div class="basket-nav__arrow">
                 <svg class="icon icon_angle-right">
                   <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#angle-right"></use>
                 </svg>
               </div>
             </div>
             <div class="basket-nav__item">
               <div class="basket-nav__icon">
                 <svg class="icon icon_id-card">
                   <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#id-card"></use>
                 </svg>
                 i.fa.fa-address-card-o
               </div>
               <div class="basket-nav__text">Даные покупателя
               </div>
               <div class="basket-nav__arrow">
                 <svg class="icon icon_angle-right">
                   <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#angle-right"></use>
                 </svg>
               </div>
             </div>
           </div>
         </div>
       </div> -->


            </div>

      <? if (count($ar_res) >0) {?>
            <div class="basket__content">
              <div class="basket-content">
                <div class="basket-content__left">

                  <div class="basket-kit">
                    <div class="goods-head">
                         <div class="goods-head__text">

                            Добавьте товары из списка в Корзину, чтобы оформить заказ. Или перенесите в "Избранное" товары из корзины, которые не собираетесь покупать прямо сейчас, чтобы не потерять их.
                     </div>
                      <div class="basket-kit__head-right">
                        <div class="icon-text icon-text_hover all">
                          <div class="icon-text__icon">
                            <div class="close-icon"></div>
                          </div>
                          <div class="icon-text__text" id="deleteAll">Очистить список
                          </div>
                        </div>
                      </div>
                    </div>
                    <ul class="basket-kit__list">

                
<?


/*echo '<pre>'; 
print_r($arRes);
echo '<pre>';*/


if($arRes)
{


  $j = 1;
foreach ($arRes as $key => $value) 

{


if($key!=='Товары без комплекта'){

$fullPosts = 0;
$mexwar = 0;
$catID = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];

$db_props = CIBlockElement::GetProperty($catID, $arRes[$key][0]['PRODUCT_ID'], array(), Array("CODE"=>"FRAME_COUNT_FUNCTION"));
if($ar_props = $db_props->Fetch())
    $posts = IntVal($ar_props["VALUE_ENUM"]);
  /*Число постов в рамке для сравния с числом механизмов далее*/
  $Ramposts = IntVal($ar_props["VALUE_ENUM"]*$arRes[$key][0]["QUANTITY"]);
  $RampostsForm = IntVal($ar_props["VALUE_ENUM"]); /*для передачи в форму изменения*/
 /*Коллекция в название комплекта*/
$db_props1 = CIBlockElement::GetProperty($catID, $arRes[$key][0]['PRODUCT_ID'], array(), Array("CODE"=>"COLLECTION"));
if($ar_props1 = $db_props1->Fetch())

$res = CIBlockElement::GetByID($ar_props1["VALUE"]);
if($ar_res = $res->GetNext())
        $CompColl = $ar_res['NAME']; 
    
  $db_props2 = CIBlockElement::GetProperty($catID, $arRes[$key][0]['PRODUCT_ID'], array(), Array("CODE"=>"FRAME_COLOR"));
if($ar_props2 = $db_props2->Fetch())
 
  /*Цвет в название комплекта*/
  $ColorColl = $ar_props2["VALUE"];

  ?>

  <li class="basket-kit__item">
<?} else {?>
  <li class="basket-kit__item" id="nocomplist">
<?}?>
     
                        <div class="basket-kit__kit">
                          <div class="basket-kit__kit-left">
                                <?
                      
                      if ($key=='Товары без комплекта') {
                          echo 'Товары без комплекта';
                      } else {
                           $keycut = strstr($key, 'comptimelab', true);
                           echo 'Комплект&nbsp<span class="Cmpname">'.$ColorColl.' '.$CompColl.'</span>&nbsp';
                      
if($posts==1){
echo $posts.'&nbspпост';
}
if(($posts==2) or ($posts==3) or ($posts==4)){
echo $posts.'&nbspпоста';
}
if(($posts==5) or ($posts==6) or ($posts==7)  or ($posts==8)){
echo $posts.'&nbspпостов';
}                      

 }


/*Получаем число комплектов (равно числу рамок)*/
$mexarr = [];
  foreach ($arRes[$key] as $key2 => $value2) 
    {


        if(($key2 !=='room') && ($key2 !=='walls') && ($key2 !=='orientation') && ($key2 !=='mexlist') && ($key2 !=='url')){

$res = CIBlockElement::GetByID($value2['PRODUCT_ID']);
if($ar_res = $res->GetNext())
{
$res2 = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);
if($ar_res2 = $res2->GetNext())
{

if($ar_res2['NAME']=='Рамки')
    {

      $compNum = $value2['QUANTITY'];
    }
    }
  }
  }
}


                            ?>
                          </div>


                          <? if ($key !== 'Товары без комплекта') {?>
                          <div class="basket-kit__kit-mid">
                            <div class="kit-number kit-number_str">
                              <div class="kit-number__text">кол-во:
                              </div>

<?
/*Получаем данные из строки со "слепком" первоначального комплекта*/
   
   /*print_r($arRes[$key]['mexlist']);
   echo 'sdsdsd3rfd';*/

if($arRes[$key]['mexlist'] !=='')
{


/*    echo '<pre>'; 
print_r($arRes[$key]['mexlist']);
echo '<pre>';*/

    $pieces = explode(",", $arRes[$key]['mexlist']);

/*    echo '<pre>'; 
print_r($pieces);
echo '<pre>';*/

    //$mexarr = 0;
    for ($im = 0; $im < count($pieces); $im += 2) {
    $mexarr[$key][$pieces[$im]] = $pieces[$im + 1];
    }

/*    echo '<pre>'; 
print_r( $mexarr);
echo '<pre>';*/

foreach ($mexarr[$key] as $keymexc => $mexc) {
  $mexc = (int)$mexc;
 $mexwar += $mexc;
$FirstPrice = 0;
}

}

/*echo '<pre>'; 
print_r($mexarr);
echo '<pre>';*/
//echo 'fgfgfgfg';

?>


                              <div class="kit-number__btn kit-number__btn_min compminus" data-mex="<?=$arRes[$key]['mexlist']?>" data-comp='<?=$key?>' data-url="<?=$arRes[$key]['url']?>">-
                              </div>
                              <div class="kit-number__value"><?=$compNum?> шт
                              </div>
                              <div class="kit-number__btn kit-number__btn_plus compplus" data-mex="<?=$arRes[$key]['mexlist']?>"  data-comp='<?=$key?>' data-url="<?=$arRes[$key]['url']?>">+
                              </div>
                            </div>
                          </div>
                          <div class="basket-kit__kit-right">
                            <div class="basket-kit__params">
                              <div class="basket-kit__param">
                                <div class="param">
                                  <div class="param__name">помещение:
                                  </div>
                                  <div class="param__value">
                                    <select class="clear modalroom" data-name="<?=$key?>" data-frame="<?=$arRes[$key]['orientation']?>" data-mex="<?=$arRes[$key]['mexlist']?>" data-url="<?=$arRes[$key]['url']?>">
                                      <?if($value['room'] !=='')
                                      {?>
                                        <option value="<?=$value['room']?>" selected><?=$value['room']?></option>
                                      <?}?>
                                      <!-- <option value="Не выбрано">Не выбрано</option> -->
                                          <?foreach ($RoomsList as $valuer) {?>
                                 <option value="<?=$valuer?>"><?=$valuer?></option>
                                            <?}?>
                                <!--       <option value="Прихожая">Прихожая</option> -->
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="basket-kit__param">
                                <div class="param">
                                  <div class="param__name">тип стен:
                                  </div>
                                  <div class="param__value">
                                    <select class="clear modalwall" data-name="<?=$key?>" data-posts="<?=$posts?>" data-frame="<?=$arRes[$key]['orientation']?>" data-mex="<?=$arRes[$key]['mexlist']?>" data-url="<?=$arRes[$key]['url']?>" data-cn="<?=$compNum?>">
                                          <option value="Не выбрано">Сбросить</option>
                                      <?if($value['walls'] !=='')
                                      {

                                if ($value['walls'] =='Гипсокартон') {
                                       $gips += $posts*$compNum;
                                      } else {
                                           $beton += $posts*$compNum;
                                      }

                                        ?>
                                       <option value="<?=$value['walls']?>" selected><?=$value['walls']?></option>
                                   <!--      <option value="Не выбрано">Не выбрано</option> -->
                                     <?}
                                    else
                                   { 
                                      $beton += $posts*$compNum; ?>

                                       <!--   <option value="Не выбрано" selected>Не выбрано</option> -->
                                   <? }
                                     ?>

                              <!--         <option value="Не выбрано">Не выбрано</option> -->
                                      <?

                                    foreach ($WallsList as $valuew) {?>
                                 <option value="<?=$valuew?>"><?=$valuew?></option>
                                            <?}?>
                                 <!--      <option value="Гипсокартон">Гипсокартон</option>
                                 <option value="Гипсокартон">Гипсокартон</option>
                                 <option value="Гипсокартон">Гипсокартон</option> -->
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                            <?}?>


                        </div>
                        <div class="basket-kit__table">
                          <div class="m-table m-table_basket">
                            <div class="m-table__head">
                              <div class="m-table__head-item m-table-column-1">СОСТАВ КОМПЛЕКТУЮЩИХ
                              </div>
                              <div class="m-table__head-item m-table-column-2">КОЛ-ВО (шт.)
                              </div>
                              <div class="m-table__head-item m-table-column-3">СТОИМОСТЬ
                              </div>
                            </div>


 <div class="m-table__content">
<?

/*echo '<pre>';
print_r($arRes);
echo '<pre>';*/
$q = 0;
$FirstPrice1 = 0;
  foreach ($arRes[$key] as $key2 => $value2) 
/*echo '<pre>';
print_r($value2);
echo '<pre>';*/
//echo $key2;
//echo $value2['PRODUCT_ID'].'ss';
    {

if ($key2 =='mexlist') {

    $pieces = explode(",", $value2);

    $newArray = array();
for ($i = 0; $i < count($pieces); $i += 2) {
    $mexarr[$key][$pieces[$i]] = $pieces[$i + 1];
  //$pieces = $value2;


/*echo '<pre>'; 
print_r($value2);
echo '<pre>';*/

}
}
/*echo '<pre>'; 
print_r($mexarr);
echo '<pre>';*/





          if ($key2 == 'orientation') {
                $ResJS[$key]['frameOrientation'] = $value2;
/*echo '<pre>'; 
print_r($value2);
echo '<pre>';*/
            } 


          if ($key2 == 'url') {
                $ResJS[$key]['url'] = $value2;
            }

               if ($key2 == 'room') {
                $ResJS[$key]['room'] = $value2;
            }

               if ($key2 == 'walls') {
                $ResJS[$key]['walls'] = $value2;
            }



        if(($key2 !=='room') && ($key2 !=='walls') && ($key2 !=='orientation') && ($key2 !=='mexlist') && ($key2 !=='url')){

$res = CIBlockElement::GetByID($value2['PRODUCT_ID']);
if($ar_res = $res->GetNext())
{

$res2 = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);
if($ar_res2 = $res2->GetNext())
{
   $itemType = $ar_res2['NAME'];
}
}
if(($itemType =='Рамки')or($itemType =='Функции'))
{

    
    

if($key =='Товары без комплекта')
    {?>
      <div class="m-table__body" item-n-id="<?=$value2['PRODUCT_ID']?>">
    <?}
  else
    {?>
      <div class="m-table__body" item-id="<?=$value2['PRODUCT_ID']?>">
    <?}



if($ar_res2['NAME']=='Рамки')
{


  $ResJS[$key]['frame'] = $value2['PRODUCT_ID'];


$catID = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];


//print_r($value);
//print_r($value2);
//print_r($arResult);


if ($value['orientation']=='horizontal') {
      $res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "FRAME_IMG_HORIZONTAL")); 
} else {
   $res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "FRAME_IMG_VERTICAL")); 
}

if ($key =='Товары без комплекта') {
  $res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "FRAME_IMG_HORIZONTAL")); 
} 


    if ($ob = $res2->Fetch())
    { 
        $imgID = $ob['VALUE']; 
    }

    $rsFile = CFile::GetByID($imgID);
    $arFile = $rsFile->Fetch();
    $href = "upload/".$arFile['SUBDIR']."/".$arFile['FILE_NAME']."";


      $res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "FRAME_COLOR")); 
    if ($ob = $res2->Fetch())
    { 
        $color = $ob['VALUE']; 
    }

     $res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "FRAME_COUNT_FUNCTION")); 
    if ($ob = $res2->Fetch())
    { 
        $posts = $ob['VALUE']; 
        //echo $posts;
    }

        $res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "COLLECTION")); 
    if ($ob = $res2->Fetch())
    { 

$res = CIBlockElement::GetByID($ob['VALUE']);
if($ar_res = $res->GetNext())
        $collect = $ar_res['NAME'];  /*????????????*/
    }



$res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "FRAME_COUNT_FUNCTION")); 
    if ($ob = $res2->Fetch())
    { 
        $framePosts = $ob['VALUE_ENUM']; 
    }


if ($framePosts==1) {
  $postText = 'пост';
} elseif (($framePosts==2)or($framePosts==3)or($framePosts==4)) {
   $postText = 'поста';
}
else
{
  $postText = 'постов';
}


    /*Общее число постов для всех рамок комплекта*/
?>

                                <div class="m-table__body-item m-table-column-1">
                                  <div class="m-table__desktop">

                                    <div class="kit-good">
                                      <div class="kit-good__image window-holder">
                                          <!-- основная картинка-->
                                        <img src="/<?=$href?>" alt="" role="presentation"/>
                                        <div class="p-window">
                                          <div class="p-window__close">
                                            <div class="close-icon js-close-p-window">
                                            </div>
                                          </div>

                                        <!-- Высплывающее окно-->
                                          <div class="p-window__wrap">
                                            <div class="breaker">
                                              <div class="breaker__image">
                                              <img class="breaker__preview" src="/<?=$href?>" alt="" title=""/>
                                              </div>
                                              <div class="breaker__title">Рамка <?=$value2['NAME'];?>
                                              </div>
                                              <div class="breaker__color"><?=$color?>
                                              </div>
<?if($ar_res2['NAME']=='Рамки'){?>
                                              <div class="breaker__posts">Постов:


<?if($framePosts==1)
{?>1<?}
else
{?>
 1 - <?=$framePosts?>
<?}?>
                                           
                                              </div>
<?}?>
                                              <div class="breaker__price">Цена  <?
                                                $price = number_format((float)$value2['PRICE'], 2, '.', '');
                                              echo $price;

                                              $FirstPrice1 += $price;

                                              ?> руб.
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="kit-good__content">
                                        <div class="kit-good__name"><?=$value2['ARTICUL'];?>
                                        </div>
                            <div class="kit-good__text">Рамка (<?=$collect.'), цвет '.$color.', '.$framePosts.' '.$postText.'' ;?>
                                        </div>
                                      </div>
                                    </div>


                                  </div>
                                  <div class="m-table__mob"><strong><?=$value2['ARTICUL'];?></strong> Рамка (<?=$collect.') цвет '.$color.' '.$framePosts.' '. $postText.'' ;?>
                                  </div>
                                </div>
 <?} 



 if($ar_res2['NAME']=='Функции') {



/*подсчет числа функций*/
/*для нестандартных коллекций проверяем число постов*/
$res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "FRAME_COUNT_FUNCTION")); 
    if ($ob = $res2->Fetch())
    { 
      /*print_r($ob);*/
        $mexPosts = $ob['VALUE_ENUM']; 
        
    }

    if ($mexPosts) {
      $fullPosts += $mexPosts*$value2['QUANTITY']; 
      //echo $fullPosts;
    } else {
      $fullPosts += $value2['QUANTITY']; 
      //echo $fullPosts;
    }
    




$ResJS[$key]['mechanisms'][] = $value2['PRODUCT_ID'];

$catID = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];

    $res2 = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], "sort", "asc", array("CODE" => "FUNCTION_IMG")); 
    if ($ob = $res2->Fetch())
    { 
        $imgID = $ob['VALUE']; 
    }

    $rsFile = CFile::GetByID($imgID);
    $arFile = $rsFile->Fetch();
    $hrefMex = "upload/".$arFile['SUBDIR']."/".$arFile['FILE_NAME']."";


        $res2 = CIBlockElement::GetProperty($catID,
            $value2['PRODUCT_ID'],
              "sort", "asc",
              array("CODE" => "FUNCTION_COLOR")
            ); 

    if ($ob = $res2->Fetch())
    { 
        $color = $ob['VALUE']; 
    }


        $res3 = CIBlockElement::GetProperty($catID,
            $value2['PRODUCT_ID'],
              "sort", "asc",
              array("CODE" => "TOTAL_PRICE")
            ); 

    if ($ob3 = $res3->Fetch())
    { 
        $mprice = $ob3['VALUE']; 
    }   

/*добавляем данные в форму для изменения механизмов.
 Цикл - для учета одинаковых механизмов*/


/*if ($value2['QUANTITY']>1) {*/

   /*  $i = 0;*/
 
/*while ($i < $value2['QUANTITY']) {*/

/*while ($i < $mexarr[$key][$value2['PRODUCT_ID']]) {


$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][src]" value="'.$hrefMex.'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][id]" value="'.$value2['PRODUCT_ID'].'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][name]" value="'.$value2['NAME'].'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][price]" value="'.$mprice.'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][color]" value="'.$color.'">';

if ($mexPosts =='') {
  $inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][width]" value="1">';
} else {
  $inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][width]" value="'.$mexPosts.'">';
}


$i++;
$q++;
}


} 
else 
{*/
  if($mexarr[$key][$value2['PRODUCT_ID']]>1)
  {
$i = 0;
while ($i < $mexarr[$key][$value2['PRODUCT_ID']]) {
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][src]" value="'.$hrefMex.'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][id]" value="'.$value2['PRODUCT_ID'].'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][name]" value="'.$value2['NAME'].'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][price]" value="'.$mprice.'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][color]" value="'.$color.'">';

if ($mexPosts =='') {
  $inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][width]" value="1">';
} else {
  $inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][width]" value="'.$mexPosts.'">';
}
$i++;
$q++;
}

}
else

{
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][src]" value="'.$hrefMex.'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][id]" value="'.$value2['PRODUCT_ID'].'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][name]" value="'.$value2['NAME'].'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][price]" value="'.$mprice.'">';
$inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][color]" value="'.$color.'">';

if ($mexPosts =='') {
  $inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][width]" value="1">';
} else {
  $inpMex[$key] .='<input type="hidden" name="res[mechanisms]['.$q.'][width]" value="'.$mexPosts.'">';
}
  $q++;
}


/*
$q++;
}
$i++;

}*/





/*разделы, из которых получаем товары*/
             /*получаем список механизмов для функций*/
                                 $newvalue = 0;
                                 $newOnevalue = 0;
                                 $FirstPrice = 0;
                                 $Fprice = 0;

                                    //$xmlID[$value2['PRODUCT_ID']] = 0;
$db_props = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], array(), Array("CODE"=>"PACKAGE_ARTICUL"));

            while($ar_props = $db_props->GetNext())
                            {
                              $xmlID[$value2['PRODUCT_ID']][$key][] = $ar_props["VALUE"];
                             }  

               $xmlmass = array_count_values($xmlID[$value2['PRODUCT_ID']][$key]);

                          //print_r($xmlmass);

              if(!empty($xmlID[$value2['PRODUCT_ID']][$key])) {
   
                          $arSelect3 = Array("ID", "IBLOCK_ID", "NAME", "CATALOG_GROUP_1","ACTIVE");
                          $arFilter3 = Array(
                            "IBLOCK_ID"=>$catID, 
                            "PROPERTY_XML_ID"=>$xmlID[$value2['PRODUCT_ID']][$key],
                           "SECTION_CODE"=> Array('ACCESSORY', 'MECHANISM', 'FUNCTION'),
                            "ACTIVE"=>"Y");
                          $res = CIBlockElement::GetList(Array(), $arFilter3, false, Array(), $arSelect3);
                          $s = 0;
                          while($ob = $res->GetNextElement())
                            {

                                $arFields = $ob->GetFields();
                                $arProps = $ob->GetProperties();

                              //echo $xmlmass[$arProps['XML_ID']['VALUE']];
                                if ($xmlmass[$arProps['XML_ID']['VALUE']]) {
                                  $mexquan = $xmlmass[$arProps['XML_ID']['VALUE']]*$value2['QUANTITY'];
                                }  


                                  /*цена с учетом количества механизмов*/
                                  $itemPrice = $mexquan*$arFields['CATALOG_PRICE_1'];

/*$berr = $xmlmass[$arProps['XML_ID']['VALUE']]*$arFields['CATALOG_PRICE_1'];
echo '<br>'.$berr.'<br>';
echo $xmlmass[$arProps['XML_ID']['VALUE']].'<br>';*/

                        $FirstPrice1 += $mexquan*$arFields['CATALOG_PRICE_1'];

                                  $itemPrice =  round($itemPrice, 2);
                                  $newvalue += $itemPrice;

                                  if($newvalue>0)
                                    {
                                      $itemPrice = $newvalue;
                                    }

 

                                  /*для расчета цены одной функции во всплывающем окне*/
                                  $onePrice = $arFields['CATALOG_PRICE_1'];
                                  $newOnevalue = $onePrice;
                                    //echo $itemPrice.'<br>';
                                     //echo $mexquan.'<br>';
                                    //echo $FirstPrice1.'<br>';

                        /*    echo '<pre>'; 
                            print_r($newOnevalue);
                            echo '<pre>';*/
                          /*      echo '<pre>'; 
                            print_r($mexarr);
                            echo '<pre>';*/


                                          if($mexarr)
                                            {
                            /*Учитываем начальное количество функций, а также число привязанных к функции механизмов, так как их может быть более 1*/
                                        $FirstPrice = $newOnevalue*$mexarr[$key][$value2['PRODUCT_ID']]*$xmlmass[$arProps['XML_ID']['VALUE']];

                                            }
                                            else  
                                              {
                                                  $FirstPrice = $newOnevalue;
                                              }
                                   
                                      //echo $FirstPrice;
                                   $Fprice +=$FirstPrice;
                                   //echo $Fprice.'<br>';


                        $mexList[$value2['PRODUCT_ID']][$key][$s]['NAME'] = $arFields['NAME'];
                        $mexList[$value2['PRODUCT_ID']][$key][$s]['ARTICUL'] = $arProps['ARTICUL']['VALUE'];
                        $mexList[$value2['PRODUCT_ID']][$key][$s]['MEXQUAN'] = $mexquan;
                        $mexList[$value2['PRODUCT_ID']][$key][$s]['PRICE'] = $arFields['CATALOG_PRICE_1'];
                        $mexList[$value2['PRODUCT_ID']][$key][$s]['XML'] = $arProps['XML_ID']['VALUE'];
                              $s++;
                            }
                          }
                             ?>



                        <div class="m-table__body-item m-table-column-1">
                                  <div class="m-table__desktop">

                                 <div class="kit-good-block">
                                    <div class="kit-good">
                                      <div class="kit-good__image window-holder">
                                          <!-- основная картинка-->
                                        <img src="/<?=$hrefMex?>" alt="" role="presentation"/>
                                        <div class="p-window">
                                          <div class="p-window__close">
                                            <div class="close-icon js-close-p-window">
                                            </div>
                                          </div>

                                        <!-- Высплывающее окно-->
                                          <div class="p-window__wrap">
                                            <div class="breaker">
                                              <div class="breaker__image">
                                              <img class="breaker__preview" src="/<?=$hrefMex?>" alt="" title=""/>
                                              </div>
                                              <div class="breaker__title"><?=$value2['NAME'];?>
                                              </div>
                                              <div class="breaker__color"><?=$color?>
                                              </div>



<?if($type==15){?>
                                              <div class="breaker__posts">Постов:


<?if($posts==1)
{?>1<?}
else
{?>
 1 - <?=$posts?>
<?}?>
                                           
                                              </div>
<?}?>


                                          
                                              <div class="breaker__price">Цена  <?
                   
                                              echo $newOnevalue;?> руб.
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                      </div>



                                      <div class="kit-good__content">
                                         <div class="kit-good__head">
                                        <div class="kit-good__name">
                                          <?=$value2['ARTICUL'];?>
                                        </div>
                                         <div class="kit-good__details">
                                          <a class="js-toggle-composition" href="#">Посмотреть состав</a>
                                          </div>
                                          </div>
                                        <div class="kit-good__text">
                                          <?=$value2['NAME'].', цвет '.$color;?>
                                        </div>
                                        </div>
                                    </div>


                                       <div class="kit-good-block__details">
                            <?
/*echo '<pre>'; 
print_r($mexList[$value2['PRODUCT_ID']]);
echo '<pre>';*/
                            /*    foreach ($mexList[$value2['PRODUCT_ID']] as $ml) {*/

/*echo '<pre>'; 
print_r($ml);
echo '<pre>';*/

                foreach ($mexList[$value2['PRODUCT_ID']][$key] as $ml) {

                                  ?>
                                              <div class="kit-good-block__detail">
                                          <div class="kit-good-detail">
                                            <div class="kit-good-detail__articul">
                                              <?=$ml['ARTICUL']?>
                                            </div>
                                            <div class="kit-good-detail__text">
                                               <?=$ml['NAME']?>
                                            </div>
                                        <?  
                                          //echo $xmlmass[$ml['XML']].'<br>';
                                        ?>
                        <div class="kit-good-detail__count" data-m-count="<?=$xmlmass[$ml['XML']]*$mexarr[$key][$value2['PRODUCT_ID']]?>" data-m-comp="<?=$key?>" data-mexid="<?=$value2['PRODUCT_ID']?>">
                                               <?=$ml['MEXQUAN']?>
                                               <?//=$ml['MEXQUAN']*$value2['QUANTITY']?>
                                            </div>
                          <div class="kit-good-detail__price" data-m-price="<?=$ml['PRICE']?>" data-m-price-id="<?=$value2['PRODUCT_ID']?>">
                                      <? //$itemPrice = $mexquan*$arFields['CATALOG_PRICE_1'];
                                             //$itemPrice =  round($itemPrice, 2);
                                                  //echo $itemPrice;
                                                  $pric =  $ml['PRICE']*$ml['MEXQUAN'];
                                                  //$pric =  round($pric, 2);
                                                  $pric = number_format($pric, 2, '.', ' ');
                                                  echo $pric;
                                                  //echo $mexarr[$key][$value2['PRODUCT_ID']];
                                $zzzz = $mexarr[$key][$value2['PRODUCT_ID']]*$FirstPrice;?>

                                            </div>
                                          </div>
                                        </div>
                                    <? } ?>

                                          </div>
                                  </div>

                                  </div>
                                  <div class="m-table__mob"><strong><?=$value2['ARTICUL'];?></strong>
                                   <?=$value2['NAME'].', цвет '.$color;?>
                                  </div>
                                </div>
                  <?}?>
                                <div class="m-table__body-item m-table-column-2">
                                  <div class="m-table__desktop">
                                    <div class="kit-number kit-number_centered">

                                      <? if ($key =='Товары без комплекта') {?>
                                <div class="kit-number__btn kit-number__btn_min basketminus" 
                          data-id="<?=$value2['PRODUCT_ID'];?>" data-comp="<?=$key?>">-
                                </div>        <?} ?> 

                                    <?if($ar_res2['NAME'] =='Рамки'){
$db_props = CIBlockElement::GetProperty($catID, $value2['PRODUCT_ID'], array(), Array("CODE"=>"FRAME_COUNT_FUNCTION"));
if($ar_props = $db_props->Fetch())
    $postsN = IntVal($ar_props["VALUE_ENUM"]);
/*echo 'кол-во постов рамки: '.$postsN;*/
$itemPriceFRame = $value2['PRICE']*$value2['QUANTITY'];
                                      ?>
                        <div class="kit-number__value item all" data-id="<?=$value2['PRODUCT_ID'];?>" data-type="ramk" data-posts="<?=$postsN?>" data-oneprice="<?=$value2['PRICE'];?>" data-n-comp="<?=$key?>" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>" data-price="<?=$itemPriceFRame?>">
                                    <?} else {?>
                         <div class="kit-number__value item all" data-id="<?=$value2['PRODUCT_ID'];?>" data-mexc="<?=$mexarr[$key][$value2['PRODUCT_ID']]?>" data-type='funct' data-oneprice="<?=$Fprice?>" data-n-comp="<?=$key?>" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>" data-price="<?=$itemPrice?>">
                                    <?}?>

                                        <?=$value2['QUANTITY'];?>
                                      </div>

                <? if ($key=='Товары без комплекта') {?>
                                <div class="kit-number__btn kit-number__btn_plus basketplus" 
                          data-id="<?=$value2['PRODUCT_ID'];?>" data-comp="<?=$key?>">+
                                </div> 
                  <?} ?> 

                                    </div>
                                  </div>
                                  <div class="m-table__mob">
                                    <div class="m-table__row">
                                      <div class="m-table__row-left">
                                        <div class="kit-mob">
                                          <div class="kit-mob__image">

                                        <? if ($ar_res2['NAME']=='Рамки') {?>
                                         <img src="/<?=$href?>" alt="" role="presentation"/>
                                        <?} else {?>
                                        <img src="/<?=$hrefMex?>" alt="" role="presentation"/>
                                        <?}?>
                          
                                          </div>
                                          <div class="kit-mob__price">ЦЕНА:
                                          </div>

<?
if ($key=='Товары без комплекта') {

if ($ar_res2['NAME']=='Рамки') {
  $itemPrice = $value2['PRICE']*$value2['QUANTITY'];?>
    <div class="kit-mob__price-val" data-nocomp-id="<?=$value2['PRODUCT_ID'];?>" data-nmob-comp="<?=$key?>" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>">
<?echo number_format($itemPrice, 2, '.', ' ');
} 
if ($ar_res2['NAME']=='Функции') {?>
  <div class="kit-mob__price-val" data-nocomp-id="<?=$value2['PRODUCT_ID'];?>" data-nmob-comp="<?=$key?>" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>">
  <?echo number_format($itemPrice, 2, '.', ' ');
} 


} else 

{
                                 
if ($ar_res2['NAME']=='Рамки') {

  $itemPrice = $value2['PRICE']*$value2['QUANTITY'];
  //echo $priceFrame;?>
   <div class="kit-mob__price-val" data-m-line="<?=$value2['PRODUCT_ID'];?>"data-price="<?=$itemPrice?>">
      <?
        echo number_format($itemPrice, 2, '.', ' ');
      } 

     if ($ar_res2['NAME']=='Функции')   {?>
       <div class="kit-mob__price-val" data-m-line="<?=$value2['PRODUCT_ID'];?>"data-price="<?=$itemPrice?>">
  <? echo number_format($itemPrice, 2, '.', ' ');
}

}
?>


                                <!--           <div class="kit-mob__price-val" data-m-line="<?=$value2['PRODUCT_ID'];?>"data-price="<?=$itemPrice?>"> -->
                                               <? //print_r( round($value2['PRICE'], 2)); ?> <!-- руб. -->
                                          </div>
                                        </div>
                                      </div>
                                      <div class="m-table__row-right">
                                        <div class="kit-number kit-number_centered">

          <!--кнопка минус для товара -->
                                    <? if ($key=='Товары без комплекта') {?> 
                      <div class="kit-number__btn kit-number__btn_min basketminus" data-no-id="<?=$value2['PRODUCT_ID'];?>" data-comp="<?=$key?>">-
                                       </div> 
                                              <?}  
                                if ($key=='Товары без комплекта') {

                                  if($ar_res2['NAME'] =='Рамки'){?>
                                      <div class="kit-number__value item" data-nocq-id="<?=$value2['PRODUCT_ID'];?>" data-type='ramk' data-oneprice="<?=$value2['PRICE'];?>" data-nmob-comp="<?=$key?>" data-posts="<?=$postsN?>" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>">
                                    <?} else {?>
                                      <div class="kit-number__value item" data-nocq-id="<?=$value2['PRODUCT_ID'];?>" data-mexc="<?=$mexarr[$key][$value2['PRODUCT_ID']]?>" data-type='funct' data-oneprice="<?=$zzzz?>" data-nmob-comp="<?=$key?>" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>">
                                    <?}
                                    }
                                  else

                                  {
                                    if($ar_res2['NAME'] =='Рамки'){?>
                                      <div class="kit-number__value item" data-id="<?=$value2['PRODUCT_ID'];?>" data-type='ramk' data-oneprice="<?=$value2['PRICE'];?>" data-nmob-comp="<?=$key?>" data-posts="<?=$postsN?>" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>">
                                    <?} else {?>
                                      <div class="kit-number__value item" data-id="<?=$value2['PRODUCT_ID'];?>" data-mexc="<?=$mexarr[$key][$value2['PRODUCT_ID']]?>" data-type='funct' data-oneprice="<?=$zzzz?>" data-nmob-comp="<?=$key?>" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>">
                                    <?}
                                    }
                                  echo $value2['QUANTITY'];?>
                                          </div>
              <!--кнопка плюс для товара -->
                    <? if ($key=='Товары без комплекта') {?>
                 <div class="kit-number__btn kit-number__btn_plus basketplus" data-no-id="<?=$value2['PRODUCT_ID'];?>" data-comp="<?=$key?>">+
                               </div> 
                                     <?} ?> 

                                        </div>
                                      </div>
                                    </div>

                                    <div class="kit-good-block kit-good-block_mobile">
                                      <?if($ar_res2['NAME'] !=='Рамки'){?>
                                    <div class="kit-good-block__button"><a class="js-toggle-composition" href="#">Посмотреть состав</a>
                                    </div>
                                    <div class="kit-good-block__details">
                              <?foreach ($mexList[$value2['PRODUCT_ID']][$key] as $ml) {?>
                                      <div class="kit-good-block__detail">
                                        <div class="kit-good-detail">
                                          <div class="kit-good-detail__articul"> <?=$ml['ARTICUL']?>
                                          </div>
                                          <div class="kit-good-detail__text"> <?=$ml['NAME']?>
                                          </div>
                                          <div class="kit-good-detail__count" data-m-count="<?=$xmlmass[$arProps['XML_ID']['VALUE']]?>" data-m-comp="<?=$key?>" data-mexid="<?=$value2['PRODUCT_ID']?>">
                                           <?=$ml['MEXQUAN']?>
                                          </div>
                                          <div class="kit-good-detail__price" data-m-price="<?=$arFields['CATALOG_PRICE_1']?>" data-m-price-id="<?=$value2['PRODUCT_ID']?>">
                                            <?//$itemPrice = $mexquan*$arFields['CATALOG_PRICE_1'];
                                             //$itemPrice =  round($itemPrice, 2);
                                                  //echo $ml['PRICE']; //echo $itemPrice;
                                                  echo number_format($ml['PRICE'], 2, '.', ' ');  
                                                  ?>
                                          </div>
                                        </div>
                                      </div>
                                      <?}?>
                                    </div>
                                    <?}?>
                                  </div>

                                  </div>

                                </div>
                                <div class="m-table__body-item m-table-column-3">

<?if($key =='Товары без комплекта')
{
  if ($ar_res2['NAME']=='Рамки') {
    $itemPrice = $value2['PRICE']*$value2['QUANTITY'];
    ?>

  <strong class="itemsprice" data-nocomp-id="<?=$value2['PRODUCT_ID'];?>">
 <?
        //echo $itemPrice;
        echo number_format($itemPrice, 2, '.', ' ');
      } 
if ($ar_res2['NAME']=='Функции')   {?>
 <strong class="itemsprice" data-nocomp-id="<?=$value2['PRODUCT_ID'];?>">
    <? echo number_format($itemPrice, 2, '.', ' ');
}

}
else
{
                                 
if ($ar_res2['NAME']=='Рамки') {

  $itemPrice = $value2['PRICE']*$value2['QUANTITY'];
  echo $priceFrame;?>
    <strong class="itemsprice" data-comp="<?=$key?>" data-line="<?=$value2['PRODUCT_ID'];?>" data-price="<?=$itemPrice?>">
      <?
        echo number_format($itemPrice, 2, '.', ' ');

      } 

     if ($ar_res2['NAME']=='Функции')   {?>
      <strong class="itemsprice" data-comp="<?=$key?>" data-line="<?=$value2['PRODUCT_ID'];?>" data-price="<?=$itemPrice?>">
  <? echo number_format($itemPrice, 2, '.', ' ');

}
  
}
                                  ?> руб.
                                </strong>
                                </div>

                 <? if ($key =='Товары без комплекта') {?>
<div class="icon-text icon-text_hover itemdel" data-id="<?=$value2['PRODUCT_ID'];?>" data-name="<?=$key?>"><div class="icon-text__icon"><div class="close-icon"></div></div><div class="icon-text__text">Удалить</div></div>
                       <?} ?> 

                              </div><?}?>
                         <?

if(($ar_res2['NAME']=='Рамки')or($ar_res2['NAME']=='Функции'))
{
                         $value2['PRICE'] = (int)$value2['PRICE'];
                              $priceRes[$j][] = $itemPrice;
}

                          }
                       }?>
                              </div>
                                 
                          </div>
                    
                        </div>


          <?
        if($key !=='Товары без комплекта'){

/*количество нехватки функций в данном комплекте*/
$noFunct =  $postsN - $mexwar;

            if($fullPosts<$Ramposts) 
            {
              $poz = $Ramposts - $fullPosts;
              ?>
                            <div class="warning">
                          !Обратите внимание, что комплект собран не полным. В списке отсутствует <? echo '<span data-w-comp="'.$key.'" data-w="'.$noFunct.'">'.$poz.'</span>';
                           
if ($poz == 1) {
  echo ' позиция ';
} elseif(($poz == 2) or($poz == 3) or ($poz == 4)) {
  echo ' позиции ';
}
else {
  echo ' позиций '; 
}

              ?>механизма.
                          </div>
            <?}
            }?>

                        <div class="basket-kit__bottom">
                          <div class="basket-kit-bottom basket-kit-bottom_basket">

                       <?/*if ($key !== 'Товары без комплекта') {*/?>

                            <div class="basket-kit-bottom__btns">

                           <?if ($key !== 'Товары без комплекта') {?>
                              <div class="basket-kit-bottom__btn">
                                <div class="icon-text icon-text_hover">
                                  
                                 <div class="icon-text__icon">
                                <svg class="icon icon_gear">
                                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#gear"></use>
                                </svg>
                              </div>
                              
<?
/*получаем все варианты постов для данной рамки*/
/*Получаем название рамки*/

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "CATALOG_GROUP_1");
$arFilter = Array("IBLOCK_ID"=>$catID, "ID"=>$ResJS[$key]['frame'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arProps = $ob->GetProperties();
  }


$res = CIBlockElement::GetByID($arProps['COLLECTION']['VALUE'][0]);
if($ar_res = $res->GetNext())

  /*Получаем максимальное числов постов*/

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE");


if ($arFields['CODE'] !=='') {
  
$arFilter = Array("IBLOCK_ID"=> $catID,
                  "NAME"=> $arFields['NAME'],
                  "PROPERTY_COLLECTION"=> $arProps["COLLECTION"]['VALUE'][0], 
                  "CODE" => $arFields['CODE'],
                  "ACTIVE"=> "Y");



} else {
  
$arFilter = Array("IBLOCK_ID"=> $catID,
                  "NAME"=> $arFields['NAME'],
                  "PROPERTY_COLLECTION"=> $arProps["COLLECTION"]['VALUE_ENUM_ID'],
                  "ACTIVE"=> "Y");
}

$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

$k = 0;
while($ob = $res->GetNextElement())
{
  $arProps = $ob->GetProperties();

$allPosts[$key] .= '<input type="hidden" name="res[posts]['.$k.']" value="'.$arProps['FRAME_COUNT_FUNCTION']['VALUE'].'">';
 $k++;
  }


?> 
                  
                   <form action="/configurator/<?=$ResJS[$key]['url']?>" method="post">
                        <input type="hidden" name="res[comp]" value="<?=$key?>">
                        <input type="hidden" name="res[frame][id]" value="<?=$ResJS[$key]['frame']?>">
                        <input type="hidden" name="res[frame][src]" value="<?=$href?>">
                        <input type="hidden" name="res[frame][posts]" value="<?=$RampostsForm?>">
                        <input type="hidden" name="res[frameOrientation]" value="<?=$value['orientation']?>">

                <input type="hidden" name="res[postmodframe][name]" value="<?=$arFields['NAME']?>">
                <input type="hidden" name="res[postmodframe][articul]" value="<?=$arProps['ARTICUL']['VALUE']?>">
                <input type="hidden" name="res[postmodframe][price]" value="<?=$arFields['CATALOG_PRICE_1']?>">
                <input type="hidden" name="res[postmodframe][img]" value="/<?=$href?>">

                 <input type="hidden" name="res[postfcollection]" value="<?=$collect?>">
                <input type="hidden" name="res[postcolor]" value="<?=$arProps['FRAME_COLOR']['VALUE']?>">


                            <?=$allPosts[$key]?>
                            <input type="hidden" name="res[collectionName]" value="<?=$collect?>">
                            <?=$inpMex[$key]?>
                             <button type="submit" class="icon-text__text">Изменить комплект</button> 

                           </form>
                                </div>
                              </div>
								<?}?>
                              <div class="basket-kit-bottom__btn">
                                <div class="icon-text icon-text_hover">
                                  <div class="icon-text__icon">
                                    <svg class="icon icon_trash">
                                      <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#trash"></use>
                                    </svg>
                                  </div>
                                  <div class="icon-text__text deleteComp" data-name="<?=$key?>">Удалить комплект
                                  </div>
                                </div>
                              </div>


                            </div>
<?/*}*/?>


       <div class="basket-kit__kit-btns">
                            <div class="settings-block">
                              <div class="settings-block__item">
                                <div class="icon-text icon-text_hover">
                                  <div class="icon-text__icon">
                                    <svg class="icon icon_trash">
                                      <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#trash"></use>
                                    </svg>
                                  </div>
                                  <div class="icon-text__text deleteComp" data-name="<?=$key?>">Удалить комплект
                                  </div>
                                </div>
                              </div>
                              <div class="settings-block__item">
                                <div class="icon-text icon-text_hover">
                                  <div class="icon-text__icon">
                                    <svg class="icon icon_gear">
                                      <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#gear"></use>
                                    </svg>
                                  </div>
                          <form action="/configurator/" method="post">

                            <input type="hidden" name="res[frame][id]" value="<?=$ResJS[$key]['frame']?>">
                            <input type="hidden" name="res[frame][src]" value="<?=$href?>">
                            <input type="hidden" name="res[frame][posts]" value="<?=$RampostsForm?>">
                            <input type="hidden" name="res[frameOrientation]" value="<?=$value['orientation']?>">
                            <?=$allPosts[$key]?>
                            <input type="hidden" name="res[collectionName]" value="<?=$collect?>">
                            <?=$inpMex[$key]?>
                            <button type="submit" class="icon-text__text">Изменить комплект</button> 

                           </form>
                                </div>
                              </div>
                            </div>
                          </div>




                            <div class="basket-kit-bottom__price">
                              <div class="p-price p-price_inline">
                                    <? if ($key!=='Товары без комплекта') {?>
                        <div class="p-price__text">стоимость <br> комплекта
                                </div>
                      <?} else
                      { ?>
                                <div class="p-price__text">стоимость <br> товаров
                                </div>
                      <?}?> 
                             

                                  <?$compSum = array_sum($priceRes[$j]);?>
                <div class="p-price__value" data-real="<?=$compSum?>" data-firstprice="<?=$FirstPrice1?>" data-c-price="<?=$key?>"><span>
                                  <? 
                                  //$compSum = array_sum($priceRes[$j]);
                                  $allSum += $compSum;
                                //echo $compSum;
                                echo number_format($compSum, 2, '.', ' ');
                                ?> </span> руб.
                                </div>
                              </div>
                            </div>
                          <div class="basket-kit-bottom__later">
                            <a href="#popup-basket" class="popup-with-move-anim">
                              <div class="basket-kit-bottom__button my-btn my-btn_gray my-btn_sm" data-name="<?=$key?>" data-url="<?=$arRes[$key]['url']?>" data-comp="<?=$key?>" data-mex="<?=$arRes[$key]['mexlist']?>">в корзину
                              </div>
                             </a>
                            </div>
                          </div>
                        </div>
                      </li>


                  <? 
                    
/*}}*/
  //echo $FirstPrice;

                  $j++;} ?>

                    </ul>
                  </div>
                </div>
                <div class="basket-content__right">

               <!--    <form action="<?=$arParams['PATH_TO_ORDER']?>" method="post" class="basket-panel">
                       <div class="basket-panel__top">
                           <div class="basket-panel__download">
                               <div class="basket-panel__download-text">
                                   скачать спецификацию в
                               </div>
               
                               <span class="basket-panel__download-link download-js"
                                     data-print="xls"
                                     style="cursor: pointer;"
                               >
                                   xls
                               </span>
               
                               <span class="basket-panel__download-link download-js"
                                     data-print="pdf"
                                     style="cursor: pointer;"
                               >
                                   pdf
                               </span>
                           </div>
                       </div>
                 <div class="basket-panel__main">
                   <div class="basket-panel__main-top">
                     <div class="basket-panel__block">
                       <div class="basket-panel__title basket-panel__title_input">Введите название проекта
                       </div>
                       <div class="basket-panel__input"><input class="input input-style" name="project_name" type="text" value="<?=$_SESSION['project_name']?>" tabindex="0"/>
                       </div>
                     </div>
                     <div class="basket-panel__block">
                       <div class="basket-panel__title">количество товаров
                       </div>
                       <div class="basket-panel__value" id='basketnum'>
                <?
               
                  
                  $dbBasketItems = CSaleBasket::GetList(
               array("NAME" => "ASC","ID" => "ASC"),
               array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID, 
                "ORDER_ID" => "NULL", 
                "DELAY" => "Y"),
               false,
               false,
                               array());
               
                  while ($arItems = $dbBasketItems->Fetch())
                  {
                                
                             $res = CIBlockElement::GetByID($arItems['PRODUCT_ID']);
                             if($ar_res = $res->GetNext())
                    
                       $res1 = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);
                       if($ar_res1 = $res1->GetNext())
               
               
               if($ar_res1['CODE']=='FUNCTION')
               {
               
               $cart_num += $arItems['QUANTITY'];
               
               $db_props = CIBlockElement::GetProperty($IDcat, $arItems['PRODUCT_ID'], array(), Array("CODE"=>"PACKAGE_ARTICUL"));
               
                           while($ar_props = $db_props->GetNext())
                         {
                           $xmlID = $ar_props["VALUE"];
                          
                               if(!empty($xmlID)) {
                  
                        $arSelect3 = Array("ID", "IBLOCK_ID", "NAME", "CATALOG_GROUP_1","ACTIVE");
                       $arFilter3 = Array(
                         "IBLOCK_ID"=>$IDcat, 
                         "PROPERTY_XML_ID"=>$xmlID,
                        "SECTION_CODE"=> Array('ACCESSORY', 'MECHANISM', 'FUNCTION'),
                         "ACTIVE_DATE"=>"Y", 
                         "ACTIVE"=>"Y");
                       $res = CIBlockElement::GetList(Array(), $arFilter3, false, Array(), $arSelect3);
                       while($ob = $res->GetNextElement())
                         {
               
                 $arFields = $ob->GetFields();
               
               
                     $cart_sum += $arFields['CATALOG_PRICE_1']*$arItems['QUANTITY'];
               
                         }
               
                     }
                         } 
               
               
               }
               
               if($ar_res1['CODE']=='FRAME')
               {
                 
                     $cart_num += $arItems['QUANTITY'];
                     $cart_sum += $arItems['PRICE']*$arItems['QUANTITY'];
                    
                  }
               
               
               
                }
               
               
                  if (empty($cart_num))
                     $cart_num = "0";
               
                   ?>
                         <?
               
               echo $cart_num;
               
               
                       ?> позиции
                       </div>
                     </div>
                     <div class="basket-panel__title">получение заказа
                     </div>
                     <div class="basket-panel__value">В магазине партнера
                     </div>
                   </div>
                   <div class="basket-panel__main-mid">
                     <div class="basket-panel__title">итоговая стоимость
                     </div>
                     <div class="basket-panel__price"><span>
                       <? 
                       echo number_format($allSum, 2, '.', ' ');
                       ?> </span> руб.
                     </div>
                     <div class="basket-panel__hint">Стоимость продукции носит исключительно справочный характер, конечная цена в магазине партнера может отличаться.
                     </div>
                   </div>
               
               
               
                              <div class="basket-panel__main-bottom">
                                <div class="basket-panel__title basket-panel__title_2 basket-panel__title_order">Включить в заказ <br><span id='podroz'><?
                              $podraz = $gips + $beton;
                                echo $gips + $beton; 
                                
                              if ($podraz%10==1) {
               echo ' подразетник';
                              } 
                              elseif (($podraz%10==2) or ($podraz%10==3) or($podraz%10==4)) 
                              {
               echo ' подразетника';
                              }
                              else 
                              {
               echo ' подразетников';
                              }
                              
                              
                              
                              
                              ?> 
                            </span> Legrand?
                                </div>
                              
                              <? 
                              $IdPodraz = \FourPx\Helper::getIblockIdByCodes('podraz')["podraz"];
                                $arSelect = Array("ID", "IBLOCK_ID", "NAME");
                          $arFilter = Array("IBLOCK_ID"=>$IdPodraz, "ACTIVE"=>"Y");
                          $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                          while($ob = $res->GetNextElement())
                          {
                              $arFields = $ob->GetFields();
                              $arProps = $ob->GetProperties();
                              if ($arFields['NAME']=='Гипс') {
                                $gipsPrice = $arProps['PRICE']['VALUE'];
                              } 
                              if ($arFields['NAME']=='Бетон') {
                                $betonPrice = $arProps['PRICE']['VALUE'];
                              }
                              
                          } 
                              
                              
                              
                              
                        /*      echo '<script>
                              var betonPrice = '.$betonPrice.';
                              console.log(betonPrice);
                              var gipsPrice = '.$gipsPrice.';
                              console.log(gipsPrice);
                              </script>';*/
                              
                              
                              
                          ?>
                              
                                <div class="basket-panel__checkboxes">
                <div class="basket-panel__checkbox">
                  <div class="checker">
                    <label class="checker__label"><input class="input checker__checkbox val" name="gips" type="checkbox" tabindex="0"/><span class="checker__box"><span class="check-icon"></span></span><span class="checker__text">Гипсокартонные + <span id="sumGips"><?echo $gipsPrice*$gips?></span> руб. (<?=$gipsPrice?> руб * <span id="gipsNum">
                      <?=$gips?></span> шт.)</span>
                    </label>
                  </div>
                </div>
                <div class="basket-panel__checkbox">
                  <div class="checker">
                    <label class="checker__label"><input class="input checker__checkbox val" name="beton" type="checkbox" tabindex="0"/><span class="checker__box"><span class="check-icon"></span></span><span class="checker__text">Бетонные + <span id="sumBeton"><?echo $betonPrice*$beton?></span> руб. (<?=$betonPrice?> руб * <span  id="betonNum">
                      <?=$beton?></span> шт.)</span>
                    </label>
                  </div>
                </div>
                <div class="basket-panel__checkbox">
                  <div class="checker">
                    <label class="checker__label"><input class="input checker__checkbox not" name="nopodraz" type="checkbox" tabindex="0" checked/><span class="checker__box"><span class="check-icon"></span></span><span class="checker__text">Не включать</span>
                    </label>
                  </div>
                </div>
                                </div>
                              </div>
               
               
               
                 </div>
                 <div class="basket-panel__bottom">
                   <button type="submit" class="basket-panel__button my-btn">оформить заказ
                   </button>
                 </div>
               </form> -->


                </div>
              </div>
            </div>
              <?}
/*}
}*/
              ?>
          </div>
        </div>
      </div>


<?

$ResJS = json_encode($ResJS);
echo '<script>
var result = '.$ResJS.';
console.log(result);
</script>';


/*оформление пустой корзины*/
}
else
{?>




            <div class="basket__content">
              <div class="basket-content">
                <div class="basket-content__left">

                  <div class="basket-kit">

                  <div class="goods-head">
                      <div class="goods-head__text">

                            Добавьте товары из списка в Корзину, чтобы оформить заказ. Или перенесите в "Избранное" товары из корзины, которые не собираетесь покупать прямо сейчас, чтобы не потерять их.
                     </div>
               <!--        <div class="goods-head__right">
                 <div class="icon-text icon-text_hover">
                   <div class="icon-text__icon">
                     <div class="close-icon"></div>
                   </div>
                   <div class="icon-text__text" id="deleteAll">Очистить список
                   </div>
                 </div>
               </div> -->
                    </div>

                  </div>
                </div>
                <div class="basket-content__right">


    <!--               <div class="basket-panel">
      <div class="basket-panel__top">
      </div>
      <div class="basket-panel__main">
        <div class="basket-panel__main-top">
          <div class="basket-panel__block">
            <div class="basket-panel__title">количество товаров
            </div>
            <div class="basket-panel__value">0 позиций
            </div>
          </div>
        </div>
        <div class="basket-panel__main-mid">
          <div class="basket-panel__title">итоговая стоимость
          </div>
          <div class="basket-panel__price"><span>0 </span> руб.
          </div>
          <div class="basket-panel__hint">Стоимость продукции носит исключительно справочный характер, конечная цена в магазине партнера может отличаться.
          </div>
        </div>
      </div>
      <div class="basket-panel__bottom">
      </div>
    </div> -->


                </div>
              </div>
            </div>
<!-- }} -->
       </div>
        </div>
      </div>
    </main>



<?}?>


   <div class="popup popup_specification zoom-anim-dialog mfp-hide" id="popup-basket">
            <div class="popup__content">
                <div class="specification-popup">
                    <div class="specification-popup__title popup-title">
                        Выбранные вами товары добавлены в
                        корзину
                    </div>

                    <div class="specification-popup__buttons">
                        <div class="specification-popup__button">
                            <div class="my-btn my-btn_stroked js-close-popup">
                                Продолжить
                            </div>
                        </div>

                        <div class="specification-popup__button">
                            <a class="my-btn" href="/personal/cart/">
                                В корзину
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<script>



   /*Удаление всех отложенных товаров*/
       $(document).on('click', '#deleteAll', function () {
           var deleteAll = 1;
          $.post('/local/templates/clegrand/ajax/deferred.php', {deleteAll}, function (data) {
             location.reload();
          })
      });




    $(document).on('click', '.download-js', function () {

        var _this = $(this),
            print = _this.data('print'),
            url = '/personal/cart/' + print + '/index.php?print=' + print,
            fileName = 'project.' + print;

        if (print === 'pdf' || print === 'xls') {
            $.ajax({
                url: url,
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (data) {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = fileName;
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                },
                error: function () {
                    console.log('Error download specification .' + print + '!');
                }
            });
        }
    });


/*обновление значка избранного в header и кнопки "очистить список"*/
function updateDefNum() {
       $.post('/local/templates/clegrand/ajax/deferred/deflist.php', {}, function (data) {
        if(data=='')
        {
              /*удаление стиля для значка избранного в header*/
               $('#def').attr('class','icon-text icon-text_hover');
               /*удаление кнопки "очистить список"*/
               $('.basket-kit__head-right').remove();
             }
          })
        }




/*Падеж для товаров в header*/
function declOfNum(number, titles) {  
    cases = [2, 0, 1, 1, 1, 2];  
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}


/*обновление цены и количества-товара в корзине*/
function updateBasketPrice() {
      var basketprice = 1;
       $.post('/local/templates/clegrand/ajax/deferred/basketlist.php', {basketprice}, function (data) {
          var datab = JSON.parse(data);
          console.log(datab);

          /*добавляем цену подразетников*/
          var gips = $('#sumGips').text();
          var gips = parseInt(gips);
          console.log(gips);
          var beton = $('#sumBeton').text();
          var beton = parseInt(beton);
          console.log(beton);


          var newSum = parseFloat(datab.SUM);
          console.log(newSum);

if ($('[name=gips]').is(':checked')){
    newSum += gips;
    newSum = newSum.toFixed(2);
} 

if ($('[name=beton]').is(':checked')){
    newSum += beton;
    newSum = newSum.toFixed(2);
}

            /*обновление в header*/
          var itemForm = declOfNum(datab.NUM, [' товар', ' товара', ' товаров']);
          $('.header-basket__value').html(''+datab.NUM+itemForm+' / '+newSum+' руб.');

          })
        }



           /*Удаление комплекта из отложенных*/
       $(document).on('click', '.deleteComp', function () {
           var delname = $(this).attr('data-name');
           $(this).closest('.basket-kit__item').remove();
          $.post('/local/templates/clegrand/ajax/deferred/basketdelcomp.php', {delname}, function (data) {
          updateDefNum();
          })
      });

                 /*Кнопка В корзину*/
       $(document).on('click', '.basket-kit-bottom__button.my-btn.my-btn_gray.my-btn_sm', function () {
            $(this).closest('.basket-kit__item').remove();
            var comp = $(this).attr('data-comp');
            console.log(comp);
            result1 = result[comp];
            console.log(result1);
            var url = $(this).attr('data-url');
            console.log(url);
            var mexlist = $(this).attr("data-mex");
            console.log(mexlist);
          $.post('/local/templates/clegrand/ajax/deferred/deferred.php', {comp, mexlist, url, result1}, function (data) {
            updateBasketPrice();
          })
          
      });

      function checkFirstOption(elem) {
        const currentValue = elem.val();
        const option = elem.find('option:first-child');
        const wrapper = elem.closest('.selectric-wrapper');
        console.log(currentValue,  option.attr('value'))
        if (currentValue === option.attr('value')) {
          wrapper.find('span.label').text(option.data('value'));
        }
      }

   /*Смена комнаты в отложенных*/
        $(".modalroom").change(function () {

            checkFirstOption($(this));

            var cmpname = $(this).attr("data-name");
            var room = $(this).val(); 

        let walls = {
            comp: cmpname,
            walls: ''
        };
            var frameOrientation = $(this).attr("data-frame");
            var mexlist = $(this).attr("data-mex");
            var url = $(this).attr("data-url");

            walls.walls = $(this).closest('.basket-kit__params').find(".modalwall").val();
            $.post('/local/templates/clegrand/ajax/deferred/config.php', {room, walls, frameOrientation, mexlist, url}, function (data) {
          })

        });


        /*Смена стен в отложенных*/
        $(".modalwall").change(function () {

            checkFirstOption($(this));

            var cmpname = $(this).attr("data-name");
             var walls = $(this).val();
        
        let room = {
            comp: cmpname,
            room: ''
        };

            var frameOrientation = $(this).attr("data-frame");
            var mexlist = $(this).attr("data-mex");
            var url = $(this).attr("data-url");


            room.room = $(this).closest('.basket-kit__params').find(".modalroom").val();
            $.post('/local/templates/clegrand/ajax/deferred/config.php', {walls, room, frameOrientation, mexlist, url}, function (data) {
          })

        });





         /*Нажатие на плюс для комплекта*/
$(document).on('click', '.kit-number__btn.kit-number__btn_plus.compplus', function () {

var comp = $(this).attr('data-comp');
console.log(comp);

var mex = $(this).attr('data-mex');
console.log(mex);

var url = $(this).attr('data-url');
console.log(url);

var button = 'plus';
result1 = result[comp];
console.log(result1);


/*установка числа комплектов для пересчета подразетников*/


        var vall = $(this).prev().text();
        var vall1 = parseInt(vall.match(/\d+/));

   $('.basket-kit__list').find('.modalwall').each(function(){

    var actComp = $(this).attr('data-name');

    if(actComp == comp)
      {
          $(this).attr('data-cn',vall1);
      }
    });

/*пересчет общей суммы комплекта*/
            var first = $('[data-c-price="'+comp+'"]').attr('data-firstprice');
                first = parseFloat(first);

                var real = $('[data-c-price="'+comp+'"]').attr('data-real');
                real = parseFloat(real);
                var compRes = (real+first).toFixed(2);

              $('[data-c-price="'+comp+'"]').html('<span>'+compRes+ '</span>  руб.');
              $('[data-c-price="'+comp+'"]').attr('data-real',''+compRes+'');


$.post('/local/templates/clegrand/ajax/deferred/modalframe.php', {result1, button, comp, mex, url}, function (datam) {
        re = /[0-9/.]+/
          })


          /*изменение числа товаров при увеличении комплектов*/

     $('body').find('[data-n-comp="'+comp+'"]').each(function(){

      var qqqq = $(this).attr('data-type');
   
   if($(this).attr('data-type') =="funct")
    {

        var num = parseInt($(this).text());
        var num1 = parseInt($(this).attr('data-mexc'));
        var numresm = num+num1;
        $(this).text(numresm);


        /*смена количества в списках механизмов*/
        var mexnum = parseInt($(this).attr('data-m-count'));
        var newmexnum = numresm*mexnum;
        var mexid = $(this).attr('data-id')

          $(this).closest('.basket-kit__item').find('[data-mexid='+mexid+']').each(function(){
            $(this).text(newmexnum);
          });


          /*смена цены в списках механизмов*/
          $(this).closest('.basket-kit__item').find('[data-m-price-id='+mexid+']').each(function(){
            var mpric = $(this).attr('data-m-price');
            mpric = parseFloat(mpric);
            var newpric = (mpric*newmexnum).toFixed(2);
            $(this).text(newpric);
          });


        /*смена цены в строке*/
        var id = parseInt($(this).attr('data-id'));

         var sum = $(this).attr('data-oneprice');
         sum = parseFloat(sum);

          var price = $(this).attr('data-price');
          price = parseFloat(price);

        var lineres = (sum+price).toFixed(2);

        $('[data-line="'+id+'"][data-comp="'+comp+'"]').text(''+lineres+' руб.');
        $('[data-line="'+id+'"][data-comp="'+comp+'"]').attr('data-price',''+lineres+'');
        $('[data-id="'+id+'"][data-n-comp="'+comp+'"]').attr('data-price',''+lineres+'');
    }

    else

    {
          var num = parseInt($(this).text());
          var numresm = num+1;
          $(this).text(numresm);


 /*смена цены в строке*/

        var id = parseInt($(this).attr('data-id'));

        var sum = $(this).attr('data-oneprice');
        sum = parseFloat(sum);

        var price = $(this).attr('data-price');
        price = parseFloat(price);

        var lineres = (sum+price).toFixed(2);

        $('[data-line="'+id+'"][data-comp="'+comp+'"]').text(''+lineres+' руб.');
        $('[data-line="'+id+'"][data-comp="'+comp+'"]').attr('data-price',''+lineres+'');
        $('[data-id="'+id+'"][data-n-comp="'+comp+'"]').attr('data-price',''+lineres+'');

    }  
            });


/*изменения сумм и количества для мобильной версии***********************/


$('body').find('[data-nmob-comp="'+comp+'"]').each(function(){

      var qqqq = $(this).attr('data-type');
   
   if($(this).attr('data-type') =="funct")
    {

        var num = parseInt($(this).text());
        var num1 = parseInt($(this).attr('data-mexc'));
        var numresm = num+num1;
        $(this).text(numresm);


        /*смена количества в списках механизмов*/
        var mexnum = parseInt($(this).attr('data-m-count'));
        var newmexnum = numresm*mexnum;
        var mexid = $(this).attr('data-id')

          $(this).closest('.basket-kit__item').find('[data-mexid='+mexid+']').each(function(){
            $(this).text(newmexnum);
          });

          /*смена цены в списках механизмов*/
          $(this).closest('.basket-kit__item').find('[data-m-price-id='+mexid+']').each(function(){
            var mpric = $(this).attr('data-m-price');
            mpric = parseFloat(mpric);
            var newpric = (mpric*newmexnum).toFixed(2);
            $(this).text(newpric);
          });


        /*смена цены в строке*/
        var id = parseInt($(this).attr('data-id'));

         var sum = $(this).attr('data-oneprice');
         sum = parseFloat(sum);

          var price = $('[data-m-line="'+id+'"]').attr('data-price');
          price = parseFloat(price);

        var lineres = (sum+price).toFixed(2);

        $('[data-m-line="'+id+'"]').text(''+lineres+' руб.');
        $('[data-m-line="'+id+'"]').attr('data-price',''+lineres+'');
    }

    else

    {
          var num = parseInt($(this).text());
          var numresm = num+1;
          $(this).text(numresm);


 /*смена цены в строке*/

        var id = parseInt($(this).attr('data-id'));

        var sum = $(this).attr('data-oneprice');
        sum = parseFloat(sum);

        var price = $('[data-m-line="'+id+'"]').attr('data-price');
        price = parseFloat(price);

        var lineres = (sum+price).toFixed(2);
        $('[data-m-line="'+id+'"]').text(''+lineres+' руб.');
        $('[data-m-line="'+id+'"]').attr('data-price',''+lineres+'');


    }  
            });


//****************************


/*пересчет числа недостающих функций в комплекте*/
$('body').find('[data-w-comp="'+comp+'"]').each(function(){
        var num = parseInt($(this).text());
        var num1 = parseInt($(this).attr('data-w'));
        var numresm = num+num1;
        $(this).text(numresm);
 });

});

         /*Нажатие на минус для комплекта*/
  $(document).on('click', '.kit-number__btn.kit-number__btn_min.compminus', function () {


var comp = $(this).attr('data-comp');
console.log(comp);

var url = $(this).attr('data-url');
console.log(url);

var mex = $(this).attr('data-mex');
console.log(mex);

var button = 'minus';
result1 = result[comp];
console.log(result1);


/*установка числа комплектов для пересчета подразетников*/


        var vall = $(this).next().text();
        var vall1 = parseInt(vall.match(/\d+/));

   $('.basket-kit__list').find('.modalwall').each(function(){

    var actComp = $(this).attr('data-name');

    if(actComp == comp)
      {
          $(this).attr('data-cn',vall1);
      }
    });


/*пересчет общей суммы комплекта*/
                var first = $('[data-c-price="'+comp+'"]').attr('data-firstprice');
                first = parseFloat(first);

                var real = $('[data-c-price="'+comp+'"]').attr('data-real');
                real = parseFloat(real);
                if(real>first){
                var compRes = (real-first).toFixed(2);

              $('[data-c-price="'+comp+'"]').html('<span>'+compRes+ '</span>  руб.');
              $('[data-c-price="'+comp+'"]').attr('data-real',''+compRes+'');
              }




$.post('/local/templates/clegrand/ajax/deferred/modalframe.php', {result1, button, comp, mex, url}, function (datam) {
        re = /[0-9/.]+/
          })



                    /*изменение числа товаров при уменьшении комплектов*/
     $('body').find('[data-n-comp="'+comp+'"]').each(function(){
   
   if($(this).attr('data-type') =="funct")
    {

        var num = parseInt($(this).text());
        var num1 = parseInt($(this).attr('data-mexc'));
if(num>num1)
{
        var numresm = num-num1;
        $(this).text(numresm);



        /*смена количества в списках механизмов*/
        var mexnum = parseInt($(this).attr('data-m-count'));
        var newmexnum = numresm*mexnum;
        var mexid = $(this).attr('data-id')

          $(this).closest('.basket-kit__item').find('[data-mexid='+mexid+']').each(function(){
            $(this).text(newmexnum);
          });




         /*смена цены в списках механизмов*/
          $(this).closest('.basket-kit__item').find('[data-m-price-id='+mexid+']').each(function(){
            var mpric = $(this).attr('data-m-price');
            mpric = parseFloat(mpric);
            var newpric = (mpric*newmexnum).toFixed(2);
            $(this).text(newpric);
          });


            /*смена цены в строке*/
          var id = parseInt($(this).attr('data-id'));

          var sum = $(this).attr('data-oneprice');
          sum = parseFloat(sum);

          var price = $(this).attr('data-price');
          price = parseFloat(price);

          var lineres = (price-sum).toFixed(2);


          $('[data-line="'+id+'"][data-comp="'+comp+'"]').text(''+lineres+' руб.');
          $('[data-line="'+id+'"][data-comp="'+comp+'"]').attr('data-price',''+lineres+'');
          $('[data-id="'+id+'"][data-n-comp="'+comp+'"]').attr('data-price',''+lineres+'');
}
    }
    else
    {
          var num = parseInt($(this).text());
if(num>1)
{
          var numresm = num-1;
          $(this).text(numresm);


             /*смена цены в строке*/
           var id = parseInt($(this).attr('data-id'));

          var sum = $(this).attr('data-oneprice');
          sum = parseFloat(sum);

          var price = $(this).attr('data-price');
          price = parseFloat(price);

          var lineres = (price-sum).toFixed(2);

          $('[data-line="'+id+'"][data-comp="'+comp+'"]').text(''+lineres+' руб.');
          $('[data-line="'+id+'"][data-comp="'+comp+'"]').attr('data-price',''+lineres+'');
          $('[data-id="'+id+'"][data-n-comp="'+comp+'"]').attr('data-price',''+lineres+'');
}
    }

            });



     /*******************/


                    /*изменение числа товаров при уменьшении комплектов*/
     $('body').find('[data-nmob-comp="'+comp+'"]').each(function(){
   
   if($(this).attr('data-type') =="funct")
    {

        var num = parseInt($(this).text());
        var num1 = parseInt($(this).attr('data-mexc'));
if(num>num1)
{
        var numresm = num-num1;
        $(this).text(numresm);



        /*смена количества в списках механизмов*/
        var mexnum = parseInt($(this).attr('data-m-count'));
        var newmexnum = numresm*mexnum;
        var mexid = $(this).attr('data-id')

          $(this).closest('.basket-kit__item').find('[data-mexid='+mexid+']').each(function(){
            $(this).text(newmexnum);
          });




         /*смена цены в списках механизмов*/
          $(this).closest('.basket-kit__item').find('[data-m-price-id='+mexid+']').each(function(){
            var mpric = $(this).attr('data-m-price');
            mpric = parseFloat(mpric);
            var newpric = (mpric*newmexnum).toFixed(2);
            $(this).text(newpric);
          });

          var id = parseInt($(this).attr('data-id'));

          var sum = $(this).attr('data-oneprice');
          sum = parseFloat(sum);

          var price = $('[data-m-line="'+id+'"]').attr('data-price');
          price = parseFloat(price);

          var lineres = (price-sum).toFixed(2);
          $('[data-m-line="'+id+'"]').text(''+lineres+' руб.');
          $('[data-m-line="'+id+'"]').attr('data-price',''+lineres+'');

}
    }
    else
    {
          var num = parseInt($(this).text());
if(num>1)
{
          var numresm = num-1;
          $(this).text(numresm);


             /*смена цены в строке*/
           var id = parseInt($(this).attr('data-id'));

          var sum = $(this).attr('data-oneprice');
          sum = parseFloat(sum);

          var price = $('[data-m-line="'+id+'"]').attr('data-price');
          price = parseFloat(price);

          var lineres = (price-sum).toFixed(2);
          $('[data-m-line="'+id+'"]').text(''+lineres+' руб.');
          $('[data-m-line="'+id+'"]').attr('data-price',''+lineres+'');

}
    }

            });


     /******************/


/*пересчет числа недостающих функций в комплекте*/
$('body').find('[data-w-comp="'+comp+'"]').each(function(){
        var num2 = parseInt($(this).text());
        console.log(num2);
        var num3 = parseInt($(this).attr('data-w'));
        console.log(num3);
        if(num2>num3)
          {
            var numresm2 = num2-num3;
            $(this).text(numresm2);
         }
 });

         setTimeout(function() {
          }, 2000);

      });

</script>