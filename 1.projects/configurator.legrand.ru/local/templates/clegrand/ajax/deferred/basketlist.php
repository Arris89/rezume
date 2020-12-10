<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');


$IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];

/*Нажатие на плюс в корзине*/

if (isset($_POST['addid']) && isset($_POST['id']) && isset($_POST['comp'])) {


    $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1', "ACTIVE");
    $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['id'], "ACTIVE" => "Y");
    $res2 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($ob2 = $res2->GetNextElement()) {
        $arFields2 = $ob2->GetFields();
        $arProps2 = $ob2->GetProperties();

        $compName = $_POST['comp'];


        $dbBasketItems = CSaleBasket::GetList(
            array(),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "DELAY" => "N",
                "PRODUCT_ID" => $_POST['id']
            ),
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


                    if ($anyComp == $compName) {


                        $quan = $arItems['QUANTITY'];

                        $quanres = $quan + 1;
                        $basketItemID = $arItems['ID'];


                        if (!$arProps2['FUNCTION_IMG']['VALUE']) {
                            $price = $arFields2['CATALOG_PRICE_1'];
                        } else {


                            $db_props = CIBlockElement::GetProperty($IDcat, $_POST['id'], array(), Array("CODE" => "PACKAGE_ARTICUL"));

                            while ($ar_props = $db_props->GetNext()) {
                                $xmlID = $ar_props["VALUE"];

                                if (!empty($xmlID)) {

                                    $arSelect3 = Array("ID", "IBLOCK_ID", "NAME", "CATALOG_GROUP_1", "ACTIVE");
                                    $arFilter3 = Array(
                                        "IBLOCK_ID" => $IDcat,
                                        "PROPERTY_XML_ID" => $xmlID,
                                        "SECTION_CODE" => Array('ACCESSORY', 'MECHANISM', 'FUNCTION'),
                                        "ACTIVE" => "Y");
                                    $res = CIBlockElement::GetList(Array(), $arFilter3, false, Array(), $arSelect3);
                                    while ($ob = $res->GetNextElement()) {

                                        $arFields = $ob->GetFields();
                                        $price += $arFields['CATALOG_PRICE_1'];

                                    }

                                }
                            }


                        }

                        $basket['PRICEITEM'] = round($price * $quanres, 2);


                        $ResArFields2 = array(
                            "PRODUCT_ID" => $_POST['id'],
                            "PRICE" => $price,
                            "CURRENCY" => "RUB",
                            "WEIGHT" => 531,
                            "QUANTITY" => $quanres,
                            "LID" => LANG,
                            "DELAY" => "N",
                            "CAN_BUY" => "Y",
                            "NAME" => $arFields2['NAME'],
                        );


                        $arProps3 = array();

                        $arProps3[] = array(
                            "NAME" => "KOMP",
                            "VALUE" => $_POST['comp']
                        );

                        $arProps3[] = array(
                            "NAME" => "ARTICUL",
                            "VALUE" => $arProps2['ARTICUL']['VALUE']
                        );


                        if ($ar_res['NAME'] == 'WALLS') {
                            $arProps3[] = array(
                                "NAME" => "WALLS",
                                "VALUE" => $ar_res['VALUE']
                            );
                        }

                        if ($ar_res['NAME'] == 'ROOM') {
                            $arProps3[] = array(
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
                if ($ar_res['VALUE'] == $_POST['comp']) {
                    $CompPrice += $value['PRICE'] * $value['QUANTITY'];
                }
            }
        }


    }

    $basket['PRICECOMP'] = round($CompPrice, 2);

}


/*Нажатие на минус в корзине*/

if (isset($_POST['delid'])) {

    $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
    $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
    $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['id'], "ACTIVE" => "Y");
    $res2 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($ob2 = $res2->GetNextElement()) {
        $arFields2 = $ob2->GetFields();
        $arProps2 = $ob2->GetProperties();

        $compName = $_POST['comp'];


        $dbBasketItems = CSaleBasket::GetList(
            array(),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "DELAY" => "N",
                "PRODUCT_ID" => $_POST['id']
            ),
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


                    if ($anyComp == $compName) {


                        $quan = $arItems['QUANTITY'];

                        if ($quan > 1) {

                            $quanres = $quan - 1;
                            $basketItemID = $arItems['ID'];


                            if ($arProps2['TOTAL_PRICE']['VALUE']) {
                                $price = $arProps2['TOTAL_PRICE']['VALUE'];
                            } else {
                                $price = $arFields2['CATALOG_PRICE_1'];
                            }
                            $basket['PRICEITEM'] = round($price * $quanres, 2);


                            $ResArFields2 = array(
                                "PRODUCT_ID" => $_POST['id'],
                                "PRICE" => $price,
                                "CURRENCY" => "RUB",
                                "WEIGHT" => 531,
                                "QUANTITY" => $quanres,
                                "LID" => LANG,
                                "DELAY" => "N",
                                "CAN_BUY" => "Y",
                                "NAME" => $arFields2['NAME'],
                            );


                            $arProps3 = array();

                            $arProps3[] = array(
                                "NAME" => "KOMP",
                                "VALUE" => $_POST['comp']
                            );

                            $arProps3[] = array(
                                "NAME" => "ARTICUL",
                                "VALUE" => $arProps2['ARTICUL']['VALUE']
                            );


                            if ($ar_res['NAME'] == 'WALLS') {
                                $arProps3[] = array(
                                    "NAME" => "WALLS",
                                    "VALUE" => $ar_res['VALUE']
                                );
                            }

                            if ($ar_res['NAME'] == 'ROOM') {
                                $arProps3[] = array(
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
                if ($ar_res['VALUE'] == $_POST['comp']) {
                    $CompPrice += $value['PRICE'] * $value['QUANTITY'];
                }
            }
        }


    }

    $basket['PRICECOMP'] = round($CompPrice, 2);

}


/*3 пересчет стоимости и кол-ва товаров корзины*/

if ($_POST['basketprice'] !== "") {

    $dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC", "ID" => "ASC"),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL",
            "DELAY" => "N"),
        false,
        false,
        array());

    while ($arItems = $dbBasketItems->Fetch()) {

        $arSelect = Array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID');
        $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $arItems['PRODUCT_ID'], "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
        }


        $arSelect2 = Array('ID', 'IBLOCK_ID', 'CODE');
        $arFilter2 = Array("IBLOCK_ID" => $IDcat, "ID" => $arFields['IBLOCK_SECTION_ID'], "ACTIVE" => "Y");
        $res2 = CIBlockSection::GetList(Array(), $arFilter2, false, Array(), $arSelect2);
        while ($ob2 = $res2->GetNextElement()) {
            $arFields2 = $ob2->GetFields();
        }


        if ($arFields2['CODE'] == 'FUNCTION') {

            $cart_num += $arItems['QUANTITY'];


            $db_props = CIBlockElement::GetProperty($IDcat, $arItems['PRODUCT_ID'], array(), Array("CODE" => "PACKAGE_ARTICUL"));

            while ($ar_props = $db_props->GetNext()) {
                $xmlID = $ar_props["VALUE"];

                if (!empty($xmlID)) {

                    $arSelect3 = Array("ID", "IBLOCK_ID", "NAME", "CATALOG_GROUP_1", "ACTIVE");
                    $arFilter3 = Array(
                        "IBLOCK_ID" => $IDcat,
                        "PROPERTY_XML_ID" => $xmlID,
                        "SECTION_CODE" => Array('ACCESSORY', 'MECHANISM', 'FUNCTION'),
                        "ACTIVE" => "Y");
                    $res = CIBlockElement::GetList(Array(), $arFilter3, false, Array(), $arSelect3);
                    while ($ob = $res->GetNextElement()) {

                        $arFields = $ob->GetFields();


                        $cart_sum += $arFields['CATALOG_PRICE_1'] * $arItems['QUANTITY'];

                    }

                }
            }


        }

        if ($arFields2['CODE'] == 'FRAME') {

            $cart_num += $arItems['QUANTITY'];
            $cart_sum += $arItems['PRICE'] * $arItems['QUANTITY'];

        }

    }


    if (empty($cart_num))
        $cart_num = "0";
    if (empty($cart_sum))
        $cart_sum = "0";

    $basket['NUM'] = $cart_num;
    $basket['SUM'] = round($cart_sum, 2);


    $basketResJS = json_encode($basket);
    print_r($basketResJS);

}