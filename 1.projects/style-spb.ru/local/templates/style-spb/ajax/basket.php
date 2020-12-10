<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');


if ($_POST['id']) {


    $fields = [
        'PRODUCT_ID' => $_POST['id'], // ID товара, обязательно
        'QUANTITY' => $_POST['quan'], // количество, обязательно
        'PROPS' => [
            ['NAME' => 'Размер', 'CODE' => 'razmer', 'VALUE' => $_POST['razmer']],
            ['NAME' => 'Рост', 'CODE' => 'rost', 'VALUE' => $_POST['rost']],
        ],

    ];
    $r = Bitrix\Catalog\Product\Basket::addProduct($fields);


    if ($r->isSuccess()) {

        if ($USER->IsAuthorized()) {
            $user = $USER->GetID();
            $res = CSaleBasket::GetList(array(), array(
                "USER_ID" => $user,
                'LID' => SITE_ID,
                'ORDER_ID' => 'null',
                'DELAY' => 'N'
            ));
        } else {
            $res = CSaleBasket::GetList(array(), array(
                'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                'LID' => SITE_ID,
                'ORDER_ID' => 'null',
                'DELAY' => 'N'
            ));
        }


        $list = $res->SelectedRowsCount();

        while ($arItems = $res->Fetch()) {


            $allProductPrices = \Bitrix\Catalog\PriceTable::getList([
                "select" => ["*"],
                "filter" => [
                    "=PRODUCT_ID" => $arItems['PRODUCT_ID'],
                ],
                "order" => ["CATALOG_GROUP_ID" => "ASC"]
            ])->fetchAll();
            /*получаем величину всех скидок на D7*/
            $arDiscounts = \CCatalogDiscount::GetDiscountByProduct(
                $arItems['PRODUCT_ID'],
                $USER->GetUserGroupArray(),
                "N",
                1,
                SITE_ID
            );
            if ($arDiscounts !== false) {
                $price = \CCatalogProduct::CountPriceWithDiscount(
                    $allProductPrices[0]['PRICE'],
                    $allProductPrices[0]['CURRENCY'],
                    $arDiscounts
                );
            }


            $price = (integer)$price;
            $allProductPrices[0]['PRICE'] = (integer)$allProductPrices[0]['PRICE'];
            $pr = $allProductPrices[0]['PRICE'] - $price;

            $cart_num += $arItems['QUANTITY'];

            if ($pr > 0) {
                $cart_sum[] = $pr * $arItems['QUANTITY'];
            } else {
                $cart_sum[] = $price * $arItems['QUANTITY'];
            }


            $sumend = array_sum($cart_sum);

            $mass = [$cart_num, $sumend];

        }

        $resJS = json_encode($mass);
        print_r($resJS);

    }
}

