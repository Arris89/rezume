<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');
use Bitrix\Sale;

if ($_POST['id']) {

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

    /*перезаказ*/

    $order = Sale\Order::load($_POST['id']);
    $basket = $order->getBasket();

    foreach ($basket as $basketItem) {

        $id = $basketItem->getProductId();
        $quan = $basketItem->getQuantity();


        $fields = [
            'PRODUCT_ID' => $id, // ID товара, обязательно
            'QUANTITY' => $quan, // количество, обязательно
            'PROPS' => [
                ['NAME' => 'Test prop', 'CODE' => 'TEST_PROP', 'VALUE' => 'test value'],
            ],

        ];
        $r = Bitrix\Catalog\Product\Basket::addProduct($fields);

    }

}

