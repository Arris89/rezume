<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');

if ($_POST['button'] == 'plus') {


    $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
    $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
    $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['result'][$_POST['comp']]['frame'], "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();

        $compName = $_POST['comp'];


        $dbBasketItems = CSaleBasket::GetList(
            array(),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "DELAY" => "N",
                "PRODUCT_ID" => $_POST['result'][$_POST['comp']]['frame']
            ),
            false,
            false,
            array()
        );


        while ($arItems = $dbBasketItems->Fetch()) {

            $basQ = (int)$arItems['QUANTITY'];

            $basketItemID = $arItems['ID'];


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


                    if ($anyComp == $compName) {

                        $quan = $basQ + 1;

                        /*Добавление рамки*/

                        $ResArFields = array(
                            "PRODUCT_ID" => $_POST['result'][$_POST['comp']]['frame'],
                            "PRICE" => $arFields['CATALOG_PRICE_1'],
                            "CURRENCY" => "RUB",
                            "WEIGHT" => 531,
                            "QUANTITY" => $quan,
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


                        if ($ar_res['NAME'] == 'WALLS') {
                            $arProps1[] = array(
                                "NAME" => "WALLS",
                                "VALUE" => $ar_res['VALUE']
                            );
                        }

                        if ($ar_res['NAME'] == 'ROOM') {
                            $arProps1[] = array(
                                "NAME" => "ROOM",
                                "VALUE" => $ar_res['VALUE']
                            );
                        }


                        $ResArFields["PROPS"] = $arProps1;


                        CSaleBasket::Update($basketItemID, $ResArFields);


                    }
                }
            }
        }
    }


    /*Добавление механизмов*/


    foreach ($_POST['result'][$_POST['comp']]['mechanisms'] as $key => $value2) {

        $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
        $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
        $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $value2, "ACTIVE" => "Y");
        $res2 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while ($ob2 = $res2->GetNextElement()) {

            $arFields2 = $ob2->GetFields();
            $arProps2 = $ob2->GetProperties();

            $dbBasketItems = CSaleBasket::GetList(
                array(),
                array(
                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                    "LID" => SITE_ID,
                    "DELAY" => "N",
                    "PRODUCT_ID" => $value2
                ),
                false,
                false,
                array()
            );


            while ($arItems = $dbBasketItems->Fetch()) {

                $basQ = (int)$arItems['QUANTITY'];

                $basketItemID = $arItems['ID'];


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


                        if ($anyComp == $compName) {


                            $quan = $basQ * 2;


                            $ResArFields2 = array(
                                "PRODUCT_ID" => $value2,
                                "PRICE" => $arProps2['TOTAL_PRICE']['VALUE'],
                                "CURRENCY" => "RUB",
                                "WEIGHT" => 531,
                                "QUANTITY" => $quan,
                                "LID" => LANG,
                                "DELAY" => "N",
                                "CAN_BUY" => "Y",
                                "NAME" => $arFields2['NAME'],
                            );


                            $arProps3 = array();

                            $arProps3[] = array(
                                "NAME" => "KOMP",
                                "VALUE" => $compName
                            );

                            $arProps3[] = array(
                                "NAME" => "ARTICUL",
                                "VALUE" => $arProps2['ARTICUL']['VALUE']
                            );


                            if ($ar_res['NAME'] == 'WALLS') {
                                $arProps1[] = array(
                                    "NAME" => "WALLS",
                                    "VALUE" => $ar_res['VALUE']
                                );
                            }

                            if ($ar_res['NAME'] == 'ROOM') {
                                $arProps1[] = array(
                                    "NAME" => "ROOM",
                                    "VALUE" => $ar_res['VALUE']
                                );
                            }


                            $ResArFields2["PROPS"] = $arProps3;

                            CSaleBasket::Update($basketItemID, $ResArFields2);


                        }

                    }
                }
            }
        }

    }
} else {


    /*Вычитание рамки*/

    $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
    $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
    $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['result'][$_POST['comp']]['frame'], "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();


        $dbBasketItems = CSaleBasket::GetList(
            array(),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "DELAY" => "N",
                "PRODUCT_ID" => $_POST['result'][$_POST['comp']]['frame']
            ),
            false,
            false,
            array()
        );


        while ($arItems = $dbBasketItems->Fetch()) {

            $basQ = (int)$arItems['QUANTITY'];

            $basketItemID = $arItems['ID'];

        }

        $compName = $_POST['comp'];
        $quanres = $basQ - 1;


        if ($quanres >= 1) {

            $ResArFields = array(
                "PRODUCT_ID" => $_POST['result'][$_POST['comp']]['frame'],
                "PRICE" => $arFields['CATALOG_PRICE_1'],
                "CURRENCY" => "RUB",
                "WEIGHT" => 531,
                "QUANTITY" => $quanres,
                "LID" => LANG,
                "DELAY" => "N",
                "CAN_BUY" => "Y",
                "NAME" => $arFields['NAME'],
            );


            $arProps1 = array();

            $arProps1[] = array(
                "NAME" => "KOMP",
                "VALUE" => $compName
            );

            $arProps1[] = array(
                "NAME" => "ARTICUL",
                "VALUE" => $arProps['ARTICUL']['VALUE']
            );


            $ResArFields["PROPS"] = $arProps1;


            CSaleBasket::Update($basketItemID, $ResArFields);

        }

    }


    if ($quanres >= 1) {


        foreach ($_POST['result'][$_POST['comp']]['mechanisms'] as $key => $value2) {

            $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
            $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
            $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $value2, "ACTIVE" => "Y");
            $res2 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while ($ob2 = $res2->GetNextElement()) {

                $arFields2 = $ob2->GetFields();
                $arProps2 = $ob2->GetProperties();

                $dbBasketItems = CSaleBasket::GetList(
                    array(),
                    array(
                        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                        "LID" => SITE_ID,
                        "DELAY" => "N",
                        "PRODUCT_ID" => $value2
                    ),
                    false,
                    false,
                    array()
                );


                while ($arItems = $dbBasketItems->Fetch()) {

                    $basQ = (int)$arItems['QUANTITY'];

                    $basketItemID = $arItems['ID'];

                }

                $quan = $basQ / 2;


                $ResArFields2 = array(
                    "PRODUCT_ID" => $value2,
                    "PRICE" => $arProps2['TOTAL_PRICE']['VALUE'],
                    "CURRENCY" => "RUB",
                    "WEIGHT" => 531,
                    "QUANTITY" => $quan,
                    "LID" => LANG,
                    "DELAY" => "N",
                    "CAN_BUY" => "Y",
                    "NAME" => $arFields2['NAME'],
                );


                $arProps3 = array();

                $arProps3[] = array(
                    "NAME" => "KOMP",
                    "VALUE" => $compName
                );

                $arProps3[] = array(
                    "NAME" => "ARTICUL",
                    "VALUE" => $arProps2['ARTICUL']['VALUE']
                );


                $ResArFields2["PROPS"] = $arProps3;

                CSaleBasket::Update($basketItemID, $ResArFields2);


            }
        }
    }
}
