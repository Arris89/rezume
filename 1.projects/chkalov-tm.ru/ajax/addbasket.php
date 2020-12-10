<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule("sale")) {

    if (isset($_POST['parampric']) && isset($_POST['numbic']) && isset($_POST['paramid']) && ($_POST['paramoldpric'])
        && ($_POST['discount'])
    ) {


        $arFields = array(
            "PRODUCT_ID" => $_POST['paramid'],
            "NAME" => $_POST['name'],
            "PRICE" => $_POST['paramoldpric'],
            "CURRENCY" => "RUB",
            "QUANTITY" => $_POST['numbic'],
            "LID" => LANG,
            "DELAY" => "N",
            "CALLBACK_FUNC" => "MyBasketCallback",
            "ORDER_CALLBACK_FUNC" => "MyBasketOrderCallback",
            "CUSTOM_PRICE" => "N",
        );

if ($_POST['discount'] !=='net') {
    $arFields["DISCOUNT_PRICE"] = -$_POST['discount'];
}

  
        $arFields["PROPS"] = $arProps;

        CSaleBasket::Add($arFields);


        $quanity = CSaleBasket::GetList(
            array(),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
            array()
        );

        echo $quanity;
    }
}
?>