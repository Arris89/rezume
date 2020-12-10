<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
    "GROUPS" => array(
    ),
    "PARAMETERS" => array(
        "AJAX_MODE" => array(),
        "CACHE_TIME"  =>  array(
            "DEFAULT" => 36000000
        ),
        "CACHE_GROUPS" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CP_BND_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "CATALOG_FILTER" => array(),
        "CATALOG_QUERY_FILTER" => array(),
        "CATALOG_IBLOCK_TYPE" => "",
        "CATALOG_IBLOCK_ID" => "",
        "SECTION_CODE" => "",
        "arOrder" => array(),
        "arNavStartParams" => array()
    )
);