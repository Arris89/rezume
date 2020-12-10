<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');


$noCompItems = 0;

$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
    array(),
    array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "DELAY" => "N"),
    false,
    false,
    array()
);

while ($arItems = $dbBasketItems->Fetch()) {


    $db_res = CSaleBasket::GetPropsList(
        array(
            "SORT" => "ASC",
            "NAME" => "ASC"
        ),
        array("BASKET_ID" => $arItems['ID'])
    );

    while ($ar_res = $db_res->Fetch()) {


        if ($ar_res['NAME'] == 'KOMP') {
            $anyComp = $ar_res['VALUE'];

            if ($anyComp == $_POST['comp']) {
                if ($_POST['delitem'] == $arItems['PRODUCT_ID']) {
                    CSaleBasket::Delete($arItems['ID']);
                }
                $noCompItems++;
            }

        }

    }


}
/*получаем обновленную цену комплекта*/
$dbBasketItems = CSaleBasket::GetList(
    array(),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "DELAY" => "N",
    ),
    false,
    false,
    array()
);

while ($arItems = $dbBasketItems->Fetch()) {


    $arBasketItems[] = $arItems;
    $cart_num += $arItems['QUANTITY'];
}

foreach ($arBasketItems as $key => $value) {

    $db_res = CSaleBasket::GetPropsList(
        array(
            "SORT" => "ASC",
            "NAME" => "ASC"
        ),
        array("BASKET_ID" => $value['ID'])
    );


    while ($ar_res = $db_res->Fetch()) {
        if ($ar_res['NAME'] == 'KOMP') {
            if ($ar_res['VALUE'] == 'Товары без комплекта') {
                $CompPrice += $value['PRICE'] * $value['QUANTITY'];
            }
        }
    }

}


$resList['pricecomp'] = round($CompPrice, 2);
$resList['nocomp'] = $noCompItems;
$resList['num'] = $cart_num;

$resListEnd = json_encode($resList);

print_r($resListEnd);
