<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');

$IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];


/*Добавление в корзину из отложенных*/


if (isset($_POST['comp'])) {

    $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
    $j = 0;
    $res = CSaleBasket::GetList(
        array(),
        array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'DELAY' => 'Y'
        ),
        false,
        false,
        array()
    );

    while ($arItems = $res->GetNext()) {

        $db_res = CSaleBasket::GetPropsList(
            array(
                "SORT" => "ASC",
                "NAME" => "ASC"
            ),
            array("BASKET_ID" => $arItems['ID'])
        );


        while ($ar_res = $db_res->Fetch()) {

            if ($ar_res['NAME'] == 'KOMP') {
                if ($ar_res['VALUE'] == $_POST['comp']) {


                    $def[$j]['PROD'] = $arItems['PRODUCT_ID'];
                    $def[$j]['BASKET_ID'] = $arItems['ID'];
                    $def[$j]['QUANTITY'] = $arItems['QUANTITY'];

                    $j++;


                }
            }


            if ($ar_res['NAME'] == 'WALLS') {
                $def[$j]['WALLS'] = $ar_res['VALUE'];
            }

            if ($ar_res['NAME'] == 'ROOM') {
                $def[$j]['ROOM'] = $ar_res['VALUE'];
            }


        }

    }


    foreach ($def as $value) {


        $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
        $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $value['PROD'], "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();


            if ($arProps['TOTAL_PRICE']['VALUE']) {
                $ResArFields['PRICE'] = $arProps['TOTAL_PRICE']['VALUE'];
            } else {
                $ResArFields['PRICE'] = $arFields['CATALOG_GROUP_1'];
            }


            $ResArFields = array(
                "PRODUCT_ID" => $value['PROD'],
                "CURRENCY" => "RUB",
                "WEIGHT" => 531,
                "QUANTITY" => $value["QUANTITY"],
                "LID" => LANG,
                "DELAY" => "N",
                "CAN_BUY" => "Y",
                "NAME" => $arFields['NAME'],
            );


            $arProps1 = array();

            $arProps1[] = array(
                "NAME" => "KOMP",
                "VALUE" => $_POST['comp']
            );

            $arProps1[] = array(
                "NAME" => "ARTICUL",
                "VALUE" => $arProps['ARTICUL']['VALUE']
            );

            $arProps1[] = array(
                "NAME" => "WALLS",
                "VALUE" => $value['WALLS']
            );

            $arProps1[] = array(
                "NAME" => "ROOM",
                "VALUE" => $value['ROOM']
            );

            $arProps1[] = array(
                "NAME" => "URL",
                "VALUE" => $_POST['url']
            );


            $arProps1[] = array(
                "NAME" => "ORIENTATION",
                "VALUE" => $_POST['result1']['frameOrientation']
            );

            $arProps1[] = array(
                "NAME" => "MEXLIST",
                "VALUE" => $_POST['mexlist']
            );


            $ResArFields["PROPS"] = $arProps1;


            CSaleBasket::Update($value['BASKET_ID'], $ResArFields);


        }

    }

}


