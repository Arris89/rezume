<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');
CModule::IncludeModule('highloadblock');
use Bitrix\Sale;

if ($_POST['id']) {

    $order = Sale\Order::load($_POST['id']);

    $res['ID'] = $order->getId(); // ID заказа
    $res['SUM'] = $order->getPrice(); // Сумма заказа
    $res['SALE'] = $order->getDiscountPrice(); // Размер скидки
    $res['SUM_DEV'] = $order->getDeliveryPrice(); // Стоимость доставки
    $res['COMMENT'] = $order->getField('USER_DESCRIPTION'); // коммент
    $res['DOS'] = $order->getField('ADDITIONAL_INFO'); // доп информация с адресом

    /*Получаем дату*/
    $date = $order->getDateInsert(); // объект Bitrix\Main\Type\DateTime
    $res['DATE'] = $date->format("Y-m-d");

    $statusID = $order->getField("STATUS_ID"); //получаем статус заказа
    $dev = $order->getDeliverySystemId();


    /*Получаем текст по доставке*/
    $db_dtype = CSaleDelivery::GetList(
        array(
            "SORT" => "ASC",
        ),
        array(
            "LID" => SITE_ID,
            "ACTIVE" => "Y",
            "ID" => $dev
        ),
        false,
        false,
        array()
    );
    if ($ar_dtype = $db_dtype->Fetch()) {
        $res['ID_DEV'] = $ar_dtype['NAME'];
    }

    /*Получаем текст по статусу заказа*/
    $statusResult = \Bitrix\Sale\Internals\StatusLangTable::getList(array(
        'order' => array('STATUS.SORT' => 'ASC'),
        'filter' => array('STATUS_ID' => $statusID, 'LID' => LANGUAGE_ID),
        'select' => array('NAME'),
    ));

    while ($status = $statusResult->fetch()) {
        $res['STATUS'] = $status['NAME'];
    }


    /*Получаем данные адреса*/

    $ID = 5;

    $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
    $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
    $entity_data_class = $hlentity->getDataClass();

    $result = $entity_data_class::getList(array(
        "select" => array("UF_CITY", "UF_INDEX", "UF_PHONE", "UF_COUNTRY", "UF_STREET", "UF_COMPANY", "UF_FIO"),
        "order" => array(),
        "filter" => array("UF_ALIAS" => $res['DOS']),
    ));


    while ($resds = $result->fetch()) {
        $res['DELIVERY_INFO'] = $resds;
    }


    /*получаем список товаров*/

    $basket = $order->getBasket();

    $k = 0;
    foreach ($basket as $basketItem) {

        $res['ITEMS'][$k]['NAME'] = $basketItem->getField('NAME'); /* Имя товара */
        $res['ITEMS'][$k]['ID'] = $basketItem->getProductId(); /* ID товара*/
        $res['ITEMS'][$k]['PRICE'] = $basketItem->getPrice(); /* Цена за единицу*/
        $res['ITEMS'][$k]['QUANITY'] = $basketItem->getQuantity(); /* Количество*/
        $res['ITEMS'][$k]['SUM'] = $basketItem->getFinalPrice(); /* Сумма*/

        $k++;
    }


    $resJS = json_encode($res);
    print_r($resJS);

}



