<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
    "GROUPS" => array(
    ),
    "PARAMETERS" => array(
        'AJAX_MODE' => array(),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
        "CACHE_GROUPS" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CP_BND_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "PAGEN_PARAM_NAME"    =>  array(
            "PARENT"    =>  "BASE",
            "NAME"      =>  GetMessage("PAGEN_PARAM_NAME"),
            "TYPE"      =>  "STRING",
            "DEFAULT"   =>  "page"
        ),
        "PAGE_ITEMS_COUNT"    =>  array(
            "PARENT"    =>  "BASE",
            "NAME"      =>  GetMessage("PAGE_ITEMS_COUNT"),
            "TYPE"      =>  "STRING",
            "DEFAULT"   =>  "12"
        ),
        "GET_PARAMS"    =>  array(
            "PARENT"    =>  "CACHE_SETTINGS",
            "NAME"      =>  GetMessage("GET_PARAMS"),
            "TYPE"      =>  "STRING",
            "DEFAULT"   =>  ""
        ),
        "PARAMS_JSON"    =>  array(
            "PARENT"    =>  "ADDITIONAL_SETTINGS",
            "NAME"      =>  GetMessage("PARAMS_JSON"),
            "TYPE"      =>  "STRING",
            "DEFAULT"   =>  '{"p1":"v1","p2":"v2"}'
        ),
    ),
);