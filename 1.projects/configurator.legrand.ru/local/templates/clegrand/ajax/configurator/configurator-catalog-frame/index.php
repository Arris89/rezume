<?
if (stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) return;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Context;

$catalogFilterRequest = Context::getCurrent()->getRequest();

if ($catalogFilterRequest->isAjaxRequest()) {

    $arrCatalogFilterRequest = $catalogFilterRequest->getQueryList()->toArray();
    $arrCatalogFilter = array();

    foreach ($arrCatalogFilterRequest as $catalogFilterRequest => $catalogFilterRequestValue) {

        if (stristr($catalogFilterRequest, 'arrFilter') !== false) {
            $filterProperty = '=PROPERTY_' . str_replace('arrFilter_', '', $catalogFilterRequest) . '_VALUE';
            $arrCatalogFilter[$filterProperty] = $catalogFilterRequestValue;
        }
    }

    $APPLICATION->IncludeComponent(
        "4px:configurator-main.frame-catalog",
        "",
        Array(
            "CACHE_TYPE" => "Y",
            "CACHE_TIME" => 3600,
            "CATALOG_IBLOCK_TYPE" => "catalog",
            "CATALOG_IBLOCK_ID" => 25,
            "SECTION_CODE" => "FRAME",
            "CATALOG_FILTER" => $arrCatalogFilter,
            "arOrder" => array(
                "PROPERTY_COLLECTION.SORT" => "ASC",
                "NAME" => "ASC",
                "ID" => "DESC"
            )
        ),
        false
    );
}