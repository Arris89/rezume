<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $arrFilter;
$filterName = 'arrFilter';
$arrFilter = $arResult['FILTER'];
?>
<div class="section-r-order">
    <div class="section-r-order__container container">
        <div class="basket">
            <div class="basket__head">
                <h1 class="basket__title page-title">Магазины партнеров</h1>
            </div>
        </div>
        <div class="r-order">
            <? $APPLICATION->IncludeComponent(
                "bitrix:catalog.smart.filter",
                "shops",
                Array(
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CONVERT_CURRENCY" => "N",
                    "DISPLAY_ELEMENT_COUNT" => "Y",
                    "FILTER_NAME" => $filterName,
                    "FILTER_VIEW_MODE" => "vertical",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "IBLOCK_ID" => $arResult['IBLOCK_SHOPS_ID'],
                    "IBLOCK_TYPE" => "",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "POPUP_POSITION" => "left",
                    "PREFILTER_NAME" => "smartPreFilter",
                    "PRICE_CODE" => array(),
                    "SAVE_IN_SESSION" => "N",
                    "SECTION_CODE" => "",
                    "SECTION_DESCRIPTION" => "-",
                    "SECTION_ID" => "",
                    "SECTION_TITLE" => "-",
                    "SEF_MODE" => "N",
                    "TEMPLATE_THEME" => "blue",
                    "XML_EXPORT" => "N",
                    "CUR_CITY" => $arResult['CUR_CITY']
                )
            ); ?>
            <?// ToDo: Избавиться от bitrix:news.list. Получать список элементов в текущем компоненте?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "shops-list",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("NAME", ""),
                    "FILE_404" => "",
                    "FILTER_NAME" => $filterName,
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => $arResult['IBLOCK_SHOPS_ID'],
                    "IBLOCK_TYPE" => "",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK" => "",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "modern",
                    "PAGER_TITLE" => "",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("", "ADRESS", "PHONE", "METRO", "SITE", "TIME", "COLLECTIONS", ""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "Y",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "Y",
                    "SORT_BY1" => "NAME",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N"
                )
            ); ?>

            <div class="preloader js-preloader" style="display: none">
                <div class="sk-circle-bounce">
                    <div class="sk-child sk-circle-1"></div>
                    <div class="sk-child sk-circle-2"></div>
                    <div class="sk-child sk-circle-3"></div>
                    <div class="sk-child sk-circle-4"></div>
                    <div class="sk-child sk-circle-5"></div>
                    <div class="sk-child sk-circle-6"></div>
                    <div class="sk-child sk-circle-7"></div>
                    <div class="sk-child sk-circle-8"></div>
                    <div class="sk-child sk-circle-9"></div>
                    <div class="sk-child sk-circle-10"></div>
                    <div class="sk-child sk-circle-11"></div>
                    <div class="sk-child sk-circle-12"></div>
                </div>
            </div>
        </div>
    </div>
</div>