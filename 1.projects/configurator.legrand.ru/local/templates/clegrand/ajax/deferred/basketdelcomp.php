<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');


/* Удаление комплекта из корзины*/
if (isset($_POST['delname'])) {

    if (!$USER->IsAuthorized()) {

        $res = CSaleBasket::GetList(array(), array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'Y'
        ));

    } else {

        $user = $USER->GetID();

        $res = CSaleBasket::GetList(array(), array(
            'USER_ID' => $user,
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'Y'
        ));

    }

    while ($arItems = $res->Fetch()) {

        $db_res = CSaleBasket::GetPropsList(
            array(
                "SORT" => "ASC",
                "NAME" => "ASC"
            ),
            array("BASKET_ID" => $arItems['ID'])
        );


        while ($ar_res = $db_res->Fetch()) {
            if (($ar_res['NAME'] == 'KOMP') && ($ar_res['VALUE'] == $_POST['delname'])) {
                CSaleBasket::Delete($arItems['ID']);
            }
        }

    }
}