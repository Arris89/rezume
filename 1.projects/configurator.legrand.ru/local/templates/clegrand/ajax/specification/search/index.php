<?
if (stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) return;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Context,
    Bitrix\Main\Loader;

$request = Context::getCurrent()->getRequest();

global $searchFilter,
       $preFilterSearch;

if ($request->isAjaxRequest()) {

    $arrRequest = $request->getQueryList()->toArray();

    $preFilterSearch = array(
        'PARAMS' => array(
            'iblock_section' => array(86, 87)
        )
    );

    if (Loader::includeModule('search')) {
        $arElements = $APPLICATION->IncludeComponent(
            "bitrix:search.page",
            "specification",
            Array(
                "RESTART" => "Y",
                "NO_WORD_LOGIC" => "Y",
                "USE_LANGUAGE_GUESS" => "Y",
                "CHECK_DATES" => "N",
                "USE_SEARCH_RESULT_ORDER" => "Y",
                "arrFILTER" => array(
                    0 => "iblock_catalog"
                ),
                "arrFILTER_iblock_catalog" => array(
                    0 => "25"
                ),
                "USE_TITLE_RANK" => "N",
                "DEFAULT_SORT" => "rank",
                "FILTER_NAME" => "preFilterSearch",
                "SHOW_WHERE" => "N",
                "arrWHERE" => array(),
                "SHOW_WHEN" => "N",
                "PAGE_RESULT_COUNT" => "100",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "N",
            ),
            false,
            array('HIDE_ICONS' => 'Y')
        );

        if (! empty($arElements) && is_array($arElements)) {
            $searchFilter = array(
                "=ID" => $arElements,
            );
        } else {
            if (is_array($arElements)) {
                return;
            }
        }

    } else {
        $searchQuery = '';
        if (isset($_REQUEST['q']) && is_string($_REQUEST['q']))
            $searchQuery = implode(' ', preg_split("/[\s+]+/", $arrRequest['q']));
        if ($searchQuery !== '') {
            $searchFilter = array(
                '*SEARCHABLE_CONTENT' => $searchQuery
            );
        }
        unset($searchQuery);
    }

    if (! empty($searchFilter) && is_array($searchFilter)) {

        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "search-modal",
            Array(
                "COMPONENT_TEMPLATE" => "search-modal",
                "ACTION_VARIABLE" => "action",
                "ADD_PICT_PROP" => "",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BACKGROUND_IMAGE" => "",
                "BASKET_URL" => "/personal/basket/",
                "BRAND_PROPERTY" => "BRAND_REF",
                "BROWSER_TITLE" => "-",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
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
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "ENLARGE_PRODUCT" => "PROP",
                "ENLARGE_PROP" => "NEWPRODUCT",
                "FILTER_NAME" => "searchFilter",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "25",
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_SUBSECTIONS" => "Y",
                "LABEL_PROP" => array(),
                "LABEL_PROP_MOBILE" => array(),
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
                "OFFERS_CART_PROPERTIES" => array(),
                "OFFERS_FIELD_CODE" => array(),
                "OFFERS_LIMIT" => "0",
                "OFFERS_PROPERTY_CODE" => array(),
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_ORDER2" => "desc",
                "OFFER_ADD_PICT_PROP" => "",
                "OFFER_TREE_PROPS" => array(),
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Товары",
                "PAGE_ELEMENT_COUNT" => "1000",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(
                    0 => "DEFAULT"
                ),
                "PRICE_VAT_INCLUDE" => "N",
                "PRODUCT_BLOCKS_ORDER" => "",
                "PRODUCT_DISPLAY_MODE" => "Y",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPERTIES" => array(
                    "ARTICUL",
                    "NAME",
                    "COLLECTION",
                    "FRAME_COLOR",
                    "FRAME_MATERIAL",
                    "FRAME_COUNT_FUNCTION",
                    "FRAME_NAME",
                    "TYPE_INSTALATION",
                    "FUNCTION_GROUP",
                    "FUNCTION_COLOR",
                    "PACKAGE_ARTICUL"
                ),
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "",
                "PRODUCT_ROW_VARIANTS" => "",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "PROPERTY_CODE" => array(
                    "ARTICUL",
                    "NAME",
                    "COLLECTION",
                    "FRAME_COLOR",
                    "FRAME_MATERIAL",
                    "FRAME_COUNT_FUNCTION",
                    "FRAME_NAME",
                    "TYPE_INSTALATION",
                    "FUNCTION_GROUP",
                    "FUNCTION_COLOR",
                    "PACKAGE_ARTICUL"
                ),
                "PROPERTY_CODE_MOBILE" => array(),
                "RCM_PROD_ID" => "",
                "RCM_TYPE" => "personal",
                "SECTION_CODE" => "",
                "SECTION_ID" => "",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array(),
                "SEF_MODE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "Y",
                "SET_TITLE" => "N",
                "SHOW_404" => "Y",
                "SHOW_ALL_WO_SECTION" => "N",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_FROM_SECTION" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "N",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "Y",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N"
            )
        );
    }
}