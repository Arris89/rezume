<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent(
    "4px:custom.block",
    "shops-page.order",
    Array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "GET_PARAMS" => "",
        "PAGEN_PARAM_NAME" => "page",
        "PAGE_ITEMS_COUNT" => "20",
        "PARAMS_JSON" => json_encode(
            array(
                "arParams" => $arParams,
            ),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        )
    )
);