<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

Bitrix\Main\Loader::includeModule('sale');
Bitrix\Main\Loader::includeModule('catalog');


if (isset($_POST['obj'])) {


/*Добавление нового пользователя*/
    if ($_POST['user'] == 'new') {

        $userOrd = new CUser;

        $new_password = randString(7);

        $arFieldsOrd = Array(

            "EMAIL" => $_POST['email'],
            "LOGIN" => $_POST['phone'],
            "PASSWORD" => $new_password,
            "CONFIRM_PASSWORD" => $new_password,
            "PERSONAL_PHONE" => $_POST['phone'],
            "LAST_NAME" => $_POST['lastname'],
            "NAME" => $_POST['name'],
            "PERSONAL_STATE" => $_POST['locm'],
            "UF_REGUL" => 0

        );

        /*Тут добавить свойство Постоянный покупатель*/
        if($_POST['customer']==1)

        {
            $arFieldsOrd["UF_REGUL"] = 1;
        }

        $ID = $userOrd->Add($arFieldsOrd);


        foreach ($_POST['obj'] as $key => $value) {
            $products[] = $value;
        }


        $basket = Bitrix\Sale\Basket::create(SITE_ID);

        foreach ($products as $product) {
            $item = $basket->createItem("catalog", $product["PRODUCT_ID"]);
            unset($product["PRODUCT_ID"]);
            $item->setFields($product);
        }

/*ниже после SITE_ID цифры - это логин пользователя на которого создаем заказ*/
        $order = Bitrix\Sale\Order::create(SITE_ID, $ID);
        $order->setPersonTypeId($ID);


    } else {


        foreach ($_POST['obj'] as $key => $value) {
            $products[] = $value;
        }


        $basket = Bitrix\Sale\Basket::create(SITE_ID);

        foreach ($products as $product) {
            $item = $basket->createItem("catalog", $product["PRODUCT_ID"]);
            unset($product["PRODUCT_ID"]);
            $item->setFields($product);
        }


        $order = Bitrix\Sale\Order::create(SITE_ID, $_POST['user']);
        $order->setPersonTypeId($_POST['user']);


    }


    $order->setBasket($basket);

    $order->setField('COMMENTS', $_POST['infox']);

    $shipmentCollection = $order->getShipmentCollection();
    $shipment = $shipmentCollection->createItem(
        Bitrix\Sale\Delivery\Services\Manager::getObjectById($_POST['delivery']) /* - вставляем id службы доставки */

    );
    $shipment->allowDelivery();

    $shipmentItemCollection = $shipment->getShipmentItemCollection();


    foreach ($basket as $basketItem) {
        $item = $shipmentItemCollection->createItem($basketItem);
        $item->setQuantity($basketItem->getQuantity());
    }

    $paymentCollection = $order->getPaymentCollection();
    $payment = $paymentCollection->createItem(
        Bitrix\Sale\PaySystem\Manager::getObjectById($_POST['pay']) /* - вставляем id службы оплаты */
    );
    $payment->setField("SUM", $order->getPrice());
    $payment->setField("CURRENCY", $order->getCurrency());


    $result = $order->save();
    if (!$result->isSuccess()) {
    }

    $final = $result->getId();

    /*очищение корзины*/
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());

    /*очищение купонов*/
    \Bitrix\Sale\DiscountCouponsManager::clear(true);

    print_r($final);

}


?>