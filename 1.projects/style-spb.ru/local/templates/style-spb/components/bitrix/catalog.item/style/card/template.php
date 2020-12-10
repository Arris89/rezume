<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>



<div class="left-block">
    <div class="product-image-container">
        <a class="product_img_link"
           href="<?=$item['DETAIL_PAGE_URL']?>"
           title="" itemprop="url">

<?
            $renderImage = CFile::ResizeImageGet($arResult['ITEM']['PREVIEW_PICTURE']['ID'], Array("width" => 250, "height" => 380), BX_RESIZE_IMAGE_EXACT, false);

  ?>
            <img class="replace-2x img-responsive rollover-images"
                 data-rollover="<?=$renderImage['src']?>"
                 src="<?= $renderImage['src'] ?>"
                 alt="" title="<?= $imgTitle ?>"
                 width="250" height="320" itemprop="image">
        </a>
        <div class="content_price" itemprop="offers" itemscope="" itemtype="https://schema.org/Offer">
             <span itemprop="price" class="price product-price">
               <?=$arResult['ITEM']['ITEM_PRICES']['0']['PRINT_BASE_PRICE']?>
             </span>
            <meta itemprop="priceCurrency" content="RUB">
            <span class="unvisible">
             <link itemprop="availability" href="https://schema.org/InStock">в наличии                                                                                   </span>
        </div>
        <? if($arResult['ITEM']['PROPERTIES']['NEWPRODUCT']['VALUE']){?>
        <a class="new-box" href="<?=$item['DETAIL_PAGE_URL']?>">
            <span class="new-label">Новое</span>
        </a>
        <?}?>
    </div>
</div>
<div class="right-block">
    <h5 itemprop="name">
        <a class="product-name"
           href="<?=$item['DETAIL_PAGE_URL']?>"
           title="" itemprop="url">
            <?=$productTitle?>
        </a>
    </h5>
             <?

                                if (CModule::IncludeModule('highloadblock')) {

                                    $ID = 4; /* ID справочника*/

                                    $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

                                    $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                                    $entity_data_class = $hlentity->getDataClass();

                                    $result = $entity_data_class::getList(array(
                                        "select" => array("UF_NAME", "UF_LINK"), // Поля для выборки
                                        "order" => array(),
                                        "filter" => array("UF_XML_ID"=> $arResult['ITEM']['PROPERTIES']['COLOR']['VALUE']),
                                    ));

                                    while ($resds = $result->fetch()) {
                                        $itemColorCode = $resds["UF_LINK"];
                                        $itemColorName = $resds["UF_NAME"];
                                    }
                                } ?>
    <p class="product-desc" itemprop="description">
    <?if($arResult['ITEM']['PROPERTIES']['COLOR']['VALUE']){?>
        Цвет: <?=$itemColorName?>
     <?}?>   
    <?if($arResult['ITEM']['PROPERTIES']['SOSTAV']['VALUE']){?>
        Состав: <?=$arResult['ITEM']['PROPERTIES']['SOSTAV']['VALUE']?>
    <?}?>
    </p>
    <div class="content_price">
        <span class="price product-price">
            <?=$arResult['ITEM']['ITEM_PRICES']['0']['PRINT_BASE_PRICE']?>
        </span>
    </div>
        <div class="content_price">
        <span class="price product-price" style="font-size: 14px;">
          Размеры в наличии  

<?
if($arResult['ITEM']['PROPERTIES']['RAZMER']['VALUE_ENUM']){
foreach ($arResult['ITEM']['PROPERTIES']['RAZMER']['VALUE_ENUM'] as $key => $value) {
	echo $value.', ';
}
}


?>
         
        </span>
    </div>
    <div class="button-container">
    </div>

    <div class="color-list-container">
        <ul class="color_to_pick_list clearfix">
            <li>
                       <a href="<?=$item['DETAIL_PAGE_URL']?>"   id="" class="color_pick" style="background:#<?=$itemColorCode?>;">
      
                </a>
            </li>
        </ul>
    </div>
    <div class="product-flags">
    </div>
    <span class="availability">
        <?
        if($arResult["ITEM"]["PRODUCT"]["QUANTITY"]>10){?>
        <span class=" label-success">
            в наличии
        </span>
        <?}elseif($arResult["ITEM"]["PRODUCT"]["QUANTITY"]==0){?>
<span class="label-danger">
                                        Нет в наличии
                                    </span>
        <?}?>
    </span>
</div>

