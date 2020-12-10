<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

/*$this->addExternalCss('/bitrix/css/main/bootstrap.css');*/

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
        ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
        : reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}
?>

<?

echo '<script>var itempage = 1; //alert(itempage);</script>';

?>


<section class="item">
    <div class="item__wrapper">
        <div class="item__inner item-content">
            <div class="item-content__img-area slider">
                <div class="item-content__list slider__list">
                    <div class="item-content__img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/item-image-0.jpg" alt="Входная дверь Металюкс Стандарт
                М550"></div>
                    <div class="item-content__img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/item-image-1.jpg" alt="Входная дверь Металюкс Стандарт
                М550"></div>
                    <div class="item-content__img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/item-image-2.jpg" alt="Входная дверь Металюкс Стандарт
                М550"></div>
                </div>
                <div class="item-content__slider-pagination slider__pagination slider__pagination_images">
                    <button type="button"><img src="<?= SITE_TEMPLATE_PATH ?>/img/item-image-0.jpg"
                                               alt="Входная дверь Металюкс Стандарт М550"></button>
                    <button type="button"><img src="<?= SITE_TEMPLATE_PATH ?>/img/item-image-1.jpg"
                                               alt="Входная дверь Металюкс Стандарт М550"></button>
                    <button type="button"><img src="<?= SITE_TEMPLATE_PATH ?>/img/item-image-2.jpg"
                                               alt="Входная дверь Металюкс Стандарт М550"></button>
                </div>
            </div>


            <div class="item-content__info"><h1
                        class="item-content__title title title_h1"><?= $arResult['NAME']; ?></h1>
                <ul class="item-content__details item-details">
                    <li class="item-details__item"><span class="item-details__name">Размеры:</span> <span
                                class="item-details__value"><?= $arResult['PROPERTIES']['RAZMER']['VALUE']; ?></span>
                    </li>
                    <li class="item-details__item"><span class="item-details__name">Толщина:</span> <span
                                class="item-details__value"><?= $arResult['PROPERTIES']['TOLSHINA']['VALUE']; ?></span>
                    </li>
                    <li class="item-details__item"><span class="item-details__name">Краска:</span> <span
                                class="item-details__value"><?= $arResult['PROPERTIES']['KRASKA']['VALUE']; ?></span>
                    </li>
                    <li class="item-details__item"><span class="item-details__name">Склад:</span> <span
                                class="item-details__value"><?= $arResult['PROPERTIES']['SKLAD']['VALUE']; ?></span>
                    </li>
                    <li class="item-details__item"><span class="item-details__name">Отделка снаружи:</span> <span
                                class="item-details__value"><?= $arResult['PROPERTIES']['OTDELKASN']['VALUE']; ?></span>
                    </li>
                    <li class="item-details__item"><span class="item-details__name">Отделка внутри:</span> <span
                                class="item-details__value"><?= $arResult['PROPERTIES']['OTDELKAVN']['VALUE']; ?></span>
                    </li>
                </ul>
                <div class="item-content__buttons">
                    <button class="item-content__btn item-content__btn_price btn btn_get-price" type="button"
                            data-url="<?= $arResult['ORIGINAL_PARAMETERS']['CURRENT_BASE_PAGE'] ?>">
                        Получить прайс
                    </button>
                    <button class="item-content__btn btn btn_type_link btn_get-call" type="button"
                            data-url="<?= $arResult['ORIGINAL_PARAMETERS']['CURRENT_BASE_PAGE'] ?>">Бесплатная
                        консультация
                    </button>
                </div>
            </div>
        </div>
        <div class="item__inner item__inner_specifications item-specifications">
            <ul class="item-specifications__list">
                <li class="item-specifications__item"><span class="item-specifications__name">Толщина полотна</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['POLOTNO']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span
                            class="item-specifications__name">Размер дверного блока</span> <span
                            class="item-specifications__value"><?= $arResult['PROPERTIES']['DVERBLOCK']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span
                            class="item-specifications__name">Количество уплотнителей</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['UPLOTN']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span class="item-specifications__name">Размеры</span> <span
                            class="item-specifications__value"><?= $arResult['PROPERTIES']['RAZMER2']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span class="item-specifications__name">Толщина короба</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['KOROB']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span
                            class="item-specifications__name">Толщина металла полотна</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['MEPOLOTNO']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span
                            class="item-specifications__name">Толщина металла короба</span> <span
                            class="item-specifications__value"><?= $arResult['PROPERTIES']['METALLKOROB']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span class="item-specifications__name">Верхний замок</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['VERHZAMOK']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span class="item-specifications__name">Нижний замок</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['NIZZAMOK']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span class="item-specifications__name">Ночная задвижка</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['ZADVIZKA']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span class="item-specifications__name">Производитель</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['PROIZVODITEL']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span
                            class="item-specifications__name">Страна производитель</span> <span
                            class="item-specifications__value"><?= $arResult['PROPERTIES']['COUNTRY']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span class="item-specifications__name">Цвет</span> <span
                            class="item-specifications__value"><?= $arResult['PROPERTIES']['COLOR']['VALUE']; ?></span>
                </li>
                <li class="item-specifications__item"><span class="item-specifications__name">Шумоизоляция</span>
                    <span class="item-specifications__value"><?= $arResult['PROPERTIES']['SHUMOIZOL']['VALUE']; ?></span>
                </li>
            </ul>
        </div>
        <div class="item__inner item__inner_text"><?= $arResult['DETAIL_TEXT'] ?></div>
    </div>
</section>
<section class="doors doors_similar">
    <div class="doors__wrapper"><h3 class="doors__title title title_h3">Похожие товары</h3>
        <div class="doors__content doors__content_new slider">
            <div class="doors__inner doors__inner_new slider__list">
                <?
                foreach ($arResult['PROPERTIES']['DOPTOVARS']['VALUE'] as $key1 => $value) {
                    $GLOBALS['rec']['ID'][] = $value;
                }

                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "element",
                    array(
                        "ACTION_VARIABLE" => "action",
                        "ADD_PICT_PROP" => "-",
                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "ADD_TO_BASKET_ACTION" => "ADD",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "BACKGROUND_IMAGE" => "-",
                        "BASKET_URL" => "/personal/basket.php",
                        "BRAND_PROPERTY" => "BRAND_REF",
                        "BROWSER_TITLE" => "-",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COMPATIBLE_MODE" => "Y",
                        "CONVERT_CURRENCY" => "Y",
                        "CURRENCY_ID" => "RUB",
                        "CUSTOM_FILTER" => "",
                        "DATA_LAYER_NAME" => "dataLayer",
                        "DETAIL_URL" => "",
                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "ELEMENT_SORT_FIELD" => "sort",
                        "ELEMENT_SORT_FIELD2" => "id",
                        "ELEMENT_SORT_ORDER" => "asc",
                        "ELEMENT_SORT_ORDER2" => "desc",
                        "ENLARGE_PRODUCT" => "PROP",
                        "ENLARGE_PROP" => "-",
                        "FILTER_NAME" => "rec",
                        "HIDE_NOT_AVAILABLE" => "N",
                        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                        "IBLOCK_ID" => IBLOCK_CATALOG,
                        "IBLOCK_TYPE" => "catalog",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "LABEL_PROP" => array(
                            0 => "HIT",
                            1 => "NEW",
                        ),
                        "LABEL_PROP_MOBILE" => array(
                            0 => "HIT",
                            1 => "NEW",
                        ),
                        "LABEL_PROP_POSITION" => "top-left",
                        "LAZY_LOAD" => "N",
                        "LINE_ELEMENT_COUNT" => "3",
                        "LOAD_ON_SCROLL" => "N",
                        "MESSAGE_404" => "",
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                        "MESS_BTN_BUY" => "Купить",
                        "MESS_BTN_DETAIL" => "Подробнее",
                        "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                        "META_DESCRIPTION" => "-",
                        "META_KEYWORDS" => "-",
                        "OFFERS_CART_PROPERTIES" => array(
                            0 => "ARTNUMBER",
                            1 => "COLOR_REF",
                            2 => "SIZES_SHOES",
                            3 => "SIZES_CLOTHES",
                        ),
                        "OFFERS_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "OFFERS_LIMIT" => "15",
                        "OFFERS_PROPERTY_CODE" => array(
                            0 => "COLOR_REF",
                            1 => "SIZES_SHOES",
                            2 => "SIZES_CLOTHES",
                            3 => "",
                        ),
                        "OFFERS_SORT_FIELD" => "sort",
                        "OFFERS_SORT_FIELD2" => "id",
                        "OFFERS_SORT_ORDER" => "asc",
                        "OFFERS_SORT_ORDER2" => "desc",
                        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
                        "OFFER_TREE_PROPS" => array(
                            0 => "COLOR_REF",
                            1 => "SIZES_SHOES",
                            2 => "SIZES_CLOTHES",
                        ),
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Товары",
                        "PAGE_ELEMENT_COUNT" => "6",
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                        "PRICE_CODE" => array(
                            0 => "BASE",
                        ),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                        "PRODUCT_DISPLAY_MODE" => "Y",
                        "PRODUCT_ID_VARIABLE" => "id",
                        "PRODUCT_PROPERTIES" => array(
                            0 => "NEWPRODUCT",
                            1 => "MATERIAL",
                        ),
                        "PRODUCT_PROPS_VARIABLE" => "prop",
                        "PRODUCT_QUANTITY_VARIABLE" => "",
                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                        "PRODUCT_SUBSCRIPTION" => "Y",
                        "PROPERTY_CODE" => array(
                            0 => "NEWPRODUCT",
                            1 => "",
                        ),
                        "PROPERTY_CODE_MOBILE" => array(
                            0 => "HIT",
                            1 => "NEW",
                        ),
                        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                        "RCM_TYPE" => "personal",
                        "SECTION_CODE" => "vhodnie-dveri",
                        "SECTION_ID" => "",
                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => array(
                            0 => "",
                            1 => "",
                        ),
                        "SEF_MODE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SHOW_ALL_WO_SECTION" => "N",
                        "SHOW_CLOSE_POPUP" => "N",
                        "SHOW_DISCOUNT_PERCENT" => "Y",
                        "SHOW_FROM_SECTION" => "N",
                        "SHOW_MAX_QUANTITY" => "N",
                        "SHOW_OLD_PRICE" => "N",
                        "SHOW_PRICE_COUNT" => "1",
                        "SHOW_SLIDER" => "N",
                        "SLIDER_INTERVAL" => "3000",
                        "SLIDER_PROGRESS" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "USE_ENHANCED_ECOMMERCE" => "N",
                        "USE_MAIN_ELEMENT_SECTION" => "N",
                        "USE_PRICE_COUNT" => "N",
                        "USE_PRODUCT_QUANTITY" => "N",
                        "COMPONENT_TEMPLATE" => "element",
                        "DISPLAY_COMPARE" => "N"
                    ),
                    false
                ); ?>

            </div>
            <div class="doors__slider-pagination slider__pagination"></div>
        </div>

    </div>
</section>


<?


if ($arParams['DISPLAY_COMPARE']) {
    $jsParams['COMPARE'] = array(
        'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
        'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
        'COMPARE_PATH' => $arParams['COMPARE_PATH']
    );
}
?>
<script>
    BX.message({
        ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
        TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
        TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
        BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
        BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
        BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
        BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
        BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
        TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
        COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
        COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
        COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
        BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
        PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
        PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
        RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
        RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
        SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
    });

    var <?=$obName?> =
    new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>


<?
unset($actualItem, $itemIds, $jsParams);

?>

