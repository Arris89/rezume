<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule('sale'))
{


if (isset($_POST['ido'])) {




$resz = CSaleBasket::GetList(array(), array("ORDER_ID" => $_POST['ido'])); // ID заказа
while ($arItemz = $resz->Fetch()) {


 $arFields = array(
    "PRODUCT_ID" => $arItemz['PRODUCT_ID'],
    "NAME" =>$arItemz['NAME'],
    "PRODUCT_PRICE_ID" => 0,
    "PRICE" => $arItemz['PRICE'],
    "CURRENCY" => "RUB",
    "QUANTITY" => $arItemz['QUANTITY'],
    "LID" => LANG,
    "DELAY" => "N",
    "CAN_BUY" => "Y",
    "CALLBACK_FUNC" => "MyBasketCallback",
    "ORDER_CALLBACK_FUNC" => "MyBasketOrderCallback",
  );

CSaleBasket::Add($arFields);

}



} 

}

?>