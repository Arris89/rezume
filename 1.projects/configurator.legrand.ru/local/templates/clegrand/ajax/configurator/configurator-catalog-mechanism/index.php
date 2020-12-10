<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Context;

$catalogFilterRequest = Context::getCurrent()->getRequest();

if ($catalogFilterRequest->isAjaxRequest()) {

    $arrCatalogFilterRequest = $catalogFilterRequest->getQueryList()->toArray();
    $arrCatalogFilter = array();

    foreach ($arrCatalogFilterRequest as $catalogFilterRequest => $catalogFilterRequestValue) {

        if (stristr($catalogFilterRequest, 'arrFilter') !== false) {
            $propertyId = str_replace('arrFilter_', '', $catalogFilterRequest);
            $filterProperty = '=PROPERTY_' . $propertyId . '_VALUE';
            $arrCatalogFilter[ $filterProperty ] = $catalogFilterRequestValue;

            $arrCatalogFilterQuery[ $propertyId ] = $catalogFilterRequestValue;
        }
    }

    $APPLICATION->IncludeComponent(
        "4px:configurator-main.mechanism-catalog",
        "",
        Array(
            "CACHE_TYPE" => "Y",
            "CACHE_TIME" => 3600,
            "CATALOG_IBLOCK_TYPE" => "catalog",
            "CATALOG_IBLOCK_ID" => 25,
            "SECTION_CODE" => "FUNCTION",
            "CATALOG_FILTER" => $arrCatalogFilter,
            "CATALOG_QUERY_FILTER" => $arrCatalogFilterQuery,
            "arOrder" => array(
                "PROPERTY_COLLECTION.SORT" => "ASC",
                "propertysort_FUNCTION_GROUP" => "ASC",
                "NAME" => "ASC",
                "ID" => "DESC"
            )
        ),
        false
    );
}