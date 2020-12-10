<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Коллекции");
$APPLICATION->SetPageProperty("title", "Коллекции");
$APPLICATION->SetPageProperty("description", "Коллекции");
$APPLICATION->SetPageProperty("key", "Коллекции");

global $arrFilterCollection;

$arrFilterCollection = array(
    '=PROPERTY_SHOW_MENU_VALUE' => 'Y'
);
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news",
    "collections",
    array(
        "IBLOCK_TYPE" => "CATALOG",
        "IBLOCK_ID" => \FourPx\Helper::getIblockIdByCodes('COLLECTIONS')['COLLECTIONS'],
        "NEWS_COUNT" => "100",
        "USE_SEARCH" => "N",
        "USE_RSS" => "N",
        "USE_RATING" => "N",
        "USE_CATEGORIES" => "N",
        "USE_REVIEW" => "N",
        "USE_FILTER" => "N",
        "SORT_BY1" => "NAME",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "CHECK_DATES" => "Y",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/collections/",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_ELEMENT_CHAIN" => "Y",
        "USE_PERMISSIONS" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => array(),
        "LIST_PROPERTY_CODE" => array(
            0 => "PRICES"
        ),
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "DISPLAY_NAME" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "DETAIL_FIELD_CODE" => array(),
        "DETAIL_PROPERTY_CODE" => array(
            0 => "SLOTS",
            1 => "CONFIGURATIONS",
            2 => "MOVIES",
            3 => "DESCRIPTION1",
            4 => "DESCRIPTION2",
            5 => "PRICES",
            6 => "XML_ID",
            7 => "DETAIL_PICTURE",
            8 => "BROCHURE"
        ),
        "DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
        "DETAIL_PAGER_TITLE" => "",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_SHOW_ALL" => "N",
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "FILTER_NAME" => "arrFilterCollection",
        "FILTER_FIELD_CODE" => array(),
        "FILTER_PROPERTY_CODE" => array(
            0 => "SLOTS",
            1 => "CONFIGURATIONS",
            2 => "MOVIES",
            3 => "DESCRIPTION1",
            4 => "DESCRIPTION2",
            5 => "PRICES",
            6 => "XML_ID",
            7 => "DETAIL_PICTURE",
            8 => "BROCHURE",
            9 => "SHOW_MENU"
        ),
        "SEF_URL_TEMPLATES" => array(
            "news" => "",
            "section" => "",
            "detail" => "#ELEMENT_CODE#/",
        )
    ),
    false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>