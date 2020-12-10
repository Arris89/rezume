<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');


if ($_POST['delivery']) {

    $_POST['pay'] = 1;


    foreach ($_POST['obj'] as $key => $value) {
        $products[] = $value;
    }


    foreach ($_POST['propord'] as $key => $value) {
        $prodord[] = $value;
    }


    $basket = Bitrix\Sale\Basket::create(SITE_ID);

    $i = 0;
    foreach ($products as $product) {
        $item = $basket->createItem("catalog", $product["PRODUCT_ID"]);
        unset($product["PRODUCT_ID"]);
        $item->setFields($product);


        $basketPropertyCollection = $item->getPropertyCollection();

        $basketPropertyCollection->setProperty(array(
            array(
                'NAME' => 'Размер',
                'CODE' => 'RAZMER',
                'VALUE' => $prodord[$i]['razmer']['VALUE']
            ),
            array(
                'NAME' => 'Рост',
                'CODE' => 'ROST',
                'VALUE' => $prodord[$i]['rost']['VALUE']
            ),
        ));

        $i++;
    }

    $user = $USER->GetID();
    $order = Bitrix\Sale\Order::create(SITE_ID, $user['ID']);
    $order->setPersonTypeId(1);
    $order->setBasket($basket);

    $comment = 'Адрес доставки: ' . $_POST['address'] . ';  Комментарий клиента: ' . $_POST['message'];

    $order->setField('USER_DESCRIPTION', $comment);
    $order->setField('ADDITIONAL_INFO', $_POST['address']);

    $shipmentCollection = $order->getShipmentCollection();
    $shipment = $shipmentCollection->createItem(
        Bitrix\Sale\Delivery\Services\Manager::getObjectById($_POST['delivery']) // - вставляем id службы доставки
    );

    $shipmentItemCollection = $shipment->getShipmentItemCollection();

    foreach ($basket as $basketItem) {
        $item = $shipmentItemCollection->createItem($basketItem);
        $item->setQuantity($basketItem->getQuantity());
    }

    $paymentCollection = $order->getPaymentCollection();
    $payment = $paymentCollection->createItem(
        Bitrix\Sale\PaySystem\Manager::getObjectById($_POST['pay']) // - вставляем id службы оплаты через ajax
    );
    $payment->setField("SUM", $order->getPrice());
    $payment->setField("CURRENCY", $order->getCurrency());
    $result = $order->save();

    /*очистка корзины*/
    $user = $USER->GetID();

    $res = CSaleBasket::GetList(array(), array(
            "USER_ID" => $user,
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'N',
            'CAN_BUY' => 'Y')
    );

    while ($row = $res->fetch()) {
        CSaleBasket::Delete($row['ID']);
    }

}