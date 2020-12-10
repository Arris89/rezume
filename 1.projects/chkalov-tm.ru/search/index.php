<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>

<?$APPLICATION->IncludeComponent(
    "codeblogpro:sort.panel",
    "avia",
    array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "FIELDS_CODE" => array(
            0 => "name",
        ),
        "IBLOCK_ID" => IBLOCK_ID__CATALOG,
        "IBLOCK_TYPE" => "catalog",
        "INCLUDE_SORT_TO_SESSION" => "Y",
        "ORDER_NAME" => "ORDER",
        "PRICE_CODE" => array(
            0 => "1",
        ),
        "PROPERTY_CODE" => array(
        ),
        "SORT_NAME" => "SORT",
        "SORT_ORDER" => array(
            0 => "asc",
            1 => "desc",
        ),
        "COMPONENT_TEMPLATE" => "avia"
    ),
    false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.search", 
	"avia", 
	array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "11",
		"ELEMENT_SORT_FIELD" => $SORT,
		"ELEMENT_SORT_ORDER" => $ORDER,
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "20",
		"LINE_ELEMENT_COUNT" => "4",
		"PROPERTY_CODE" => array(
			0 => "SOSTAV",
			1 => "PROIZVODITEL",
			2 => "DOSTAVKA",
			3 => "RECOMMEND",
			4 => "NEWCOLOR",
			5 => "ARTICUL",
			6 => "FAV",
			7 => "TSVET_1",
			8 => "COLOR",
			9 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "CML2_LINK",
			1 => "RAZMER_TP",
			2 => "COLOR_TP",
			3 => "ARTICUL_TP",
			4 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "0",
		"PRICE_CODE" => array(
			0 => "РРЦ",
		),
		"USE_PRICE_COUNT" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"RESTART" => "Y",
		"NO_WORD_LOGIC" => "Y",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "show_more",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"HIDE_NOT_AVAILABLE" => "N",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "CML2_LINK",
		),
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "avia",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>