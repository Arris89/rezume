<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');


if ($_POST['id']) {


    $_POST['quan'] = 2;

    $ResArFields = array(
        "PRODUCT_ID" => $_POST['id'],
        "CURRENCY" => "RUB",
        "QUANTITY" => $_POST['newval'],
        "DELAY" => "N",
        "CAN_BUY" => "Y",

    );

    CSaleBasket::Update($_POST['basket_id'], $ResArFields);


}


