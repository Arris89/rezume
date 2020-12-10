<?
if (stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) return;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Context,
    Bitrix\Main\Loader;

$request = Context::getCurrent()->getRequest();

if ($request->isAjaxRequest()) {

    if (Loader::includeModule('iblock')) {

        $arElements = $request->getPost('items');

        foreach ($arElements as $arElement) {
            $elementId = $arElement['id'];

            $arElementsId[ $elementId ] = $elementId;
        }

        $APPLICATION->IncludeComponent(
            "4px:specification.list",
            "",
            Array(
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => 3600,
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => 25,
                "FILTER" => array(
                    "SECTION_CODE" => array(
                        "FUNCTION",
                        "FRAME"
                    ),
                    "ID" => $arElementsId,
                ),
                "ITEMS_REQUEST" => $arElements
            ),
            false
        );

    }
}