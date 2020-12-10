<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); // Обязательно подключаем, чтобы работали методы API Битрикс
if (CModule::IncludeModule("sale"))
{ //Если в корзине нет товаров, то и купон не применится, поэтому проверяем, есть ли товары в корзине
    $arBasketItems = array();
    $dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC","ID" => "ASC"),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
        false,
        false,
        array("ID","MODULE","PRODUCT_ID","QUANTITY","CAN_BUY","PRICE"));
    while ($arItems=$dbBasketItems->Fetch())
    {
        $arItems=CSaleBasket::GetByID($arItems["ID"]);
        $arBasketItems[]=$arItems;
        $cart_num+=$arItems['QUANTITY'];
    }
}
$msg_box = "";
$errors = array(); // контейнер для ошибок
// проверяем корректность поля
if($_POST['coupon'] == ""){$errors[] = "Код купона не введен";};
if($cart_num<=1){$errors[] = "Добавьте товар в корзину";};
// если поле заполнено
if(empty($errors)){
    if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {
        $coupon = $_POST['coupon']; // номер купона
        $couponinfo = \Bitrix\Sale\DiscountCouponsManager::getData($coupon, true); // получаем информацио о купоне
        if ($couponinfo['ACTIVE'] == "Y") {
            $addCoupon = \Bitrix\Sale\DiscountCouponsManager::add($coupon); // true - купон есть / false - его нет
            if ($addCoupon) {
                $msg_box = "<span style='color: green;'>Купон Активирован</span><br/>";
            } else {
                $msg_box = "<span style='color: red;'>Купон уже активирован</span><br/>";
            }
        } else if (!$couponinfo['ACTIVE']) {
            $msg_box = "<span style='color: red;'>Такого купона нет</span><br/>";
        } else {
            $msg_box = "<span style='color: red;'>Ошибка Активации купона</span><br/>";
        }
    }
}else{
// если были ошибки, то выводим их
    $msg_box = "";
    foreach($errors as $one_error){
        $msg_box .= "<span style='color: red;'>$one_error</span><br/>";
    }
}
// делаем ответ на клиентскую часть в формате JSON
echo json_encode(array(
    'result' => $msg_box
));
?>