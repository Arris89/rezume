<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


/*удаление товара из корзины*/

CModule::IncludeModule('sale');
CModule::IncludeModule('main');

if ($_POST['del']) {

    $user = $USER->GetID();

    $res = CSaleBasket::GetList(array(), array(
        'FUSER_ID' => CSaleBasket::GetBasketUserID(),
        'LID' => SITE_ID,
        'ORDER_ID' => 'null',
        'DELAY' => 'N'
    ));


    while ($row = $res->fetch()) {
        if ($_POST['del'] == $row['ID']) {
            CSaleBasket::Delete($row['ID']);


            $res = CSaleBasket::GetList(array(), array(
                'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                'LID' => SITE_ID,
                'ORDER_ID' => 'null',
                'DELAY' => 'N'
            ));

            $list = $res->SelectedRowsCount();

            while ($arItems = $res->Fetch()) {
                $cart_sum += $arItems['PRICE'] * $arItems['QUANTITY'];
            }
            /*вывод цены и количества для обновления по ajax*/
            $resmass['num'] = $list;
            $resmass['sum'] = $cart_sum;

            $resJS = json_encode($resmass);
            print_r($resJS);


        }
    }


}