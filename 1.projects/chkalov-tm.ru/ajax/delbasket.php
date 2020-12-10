<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule("sale")) {

    if (isset($_POST['NumItem'])) {

        CSaleBasket::Delete($_POST['NumItem']); //для удаления одног отовара из корзины вместо id товара передаем id записи из корзины


//получаем количество товаров в корзине
        $cntBasketItems = CSaleBasket::GetList(
            array(),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
            array()
        );


        echo $cntBasketItems;

    }
}
?>