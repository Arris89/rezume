<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');

/*получить количество товаров в избранном*/

if (!$USER->IsAuthorized()) {

    $dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC", "ID" => "ASC"),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL",
            "DELAY" => "Y"),
        false,
        false,
        array());
} else {

    $user = $USER->GetID();
    $dbBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "USER_ID" => $user,
            "LID" => SITE_ID,
            "DELAY" => "Y",
            "ORDER_ID" => null
        ),
        false,
        false,
        array()
    );
}

while ($arItems = $dbBasketItems->Fetch()) {

    $cart_num += $arItems['QUANTITY'];

}

print_r($cart_num);