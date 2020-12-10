<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');

$IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];

$pieces = explode(",", $_POST['mexlist']);

$mexarr = array();
for ($im = 0; $im < count($pieces); $im += 2) {
    $mexarr[$pieces[$im]] = $pieces[$im + 1];
}


if ($_POST['button'] == 'plus') {

    $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
    $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['result']['frame'], "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();

        $compName = $_POST['comp'];

        if (!$USER->IsAuthorized()) {

            $dbBasketItems = CSaleBasket::GetList(array(), array(
                'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                'LID' => SITE_ID,
                'ORDER_ID' => 'null',
                'DELAY' => 'N',
                "PRODUCT_ID" => $_POST['result']['frame']
            ));

        } else {

            $user = $USER->GetID();

            $dbBasketItems = CSaleBasket::GetList(array(), array(
                'USER_ID' => $user,
                'LID' => SITE_ID,
                'ORDER_ID' => 'null',
                'DELAY' => 'N',
                "PRODUCT_ID" => $_POST['result']['frame']
            ));

        }


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

                        $basketItemID = $arItems['ID'];

                        $basQ = (int)$arItems['QUANTITY'];

                        $quan = $basQ + 1;


                        /*Добавление рамки*/

                        $ResArFields = array(
                            "PRODUCT_ID" => $_POST['result']['frame'],
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


                        if ($ar_res['NAME'] == 'ORIENTATION') {
                            $arProps1[] = array(
                                "NAME" => "ORIENTATION",
                                "VALUE" => $ar_res['VALUE']
                            );
                        }


                        $arProps1[] = array(
                            "NAME" => "ARTICUL",
                            "VALUE" => $arProps['ARTICUL']['VALUE']
                        );


                        $arProps1[] = array(
                            "NAME" => "WALLS",
                            "VALUE" => $_POST['WALLS']
                        );

                        $arProps1[] = array(
                            "NAME" => "ROOM",
                            "VALUE" => $_POST['ROOM']
                        );


                        $ResArFields["PROPS"] = $arProps1;


                        CSaleBasket::Update($basketItemID, $ResArFields);


                    }
                }
            }
        }
    }


    /*Добавление механизмов*/


    foreach ($_POST['result']['mechanisms'] as $key => $value2) {

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


            while ($arItems1 = $dbBasketItems->Fetch()) {


                $db_res = CSaleBasket::GetPropsList(
                    array(
                        "SORT" => "ASC",
                        "NAME" => "ASC"
                    ),
                    array("BASKET_ID" => $arItems1['ID'])
                );

                while ($ar_res = $db_res->Fetch()) {
                    if ($ar_res['NAME'] == 'KOMP') {
                        $anyComp1 = $ar_res['VALUE'];


                        if ($anyComp1 == $_POST['comp']) {

                            $basketItemID1 = $arItems1['ID'];
                            $basQ1 = (int)$arItems1['QUANTITY'];


                            if ($mexarr[$value2]) {
                                $mexarr1 = (int)$mexarr[$value2];
                                $quan1 = $basQ1 + $mexarr1;
                            } else {
                                $quan1 = $basQ1 + 1;
                            }


                            $db_props = CIBlockElement::GetProperty($IDcat, $value2, array(), Array("CODE" => "PACKAGE_ARTICUL"));

                            while ($ar_props = $db_props->GetNext()) {
                                $xmlID = $ar_props["VALUE"];

                                if (!empty($xmlID)) {

                                    $arSelect3 = Array("ID", "IBLOCK_ID", "CATALOG_GROUP_1");
                                    $arFilter3 = Array(
                                        "IBLOCK_ID" => $IDcat,
                                        "PROPERTY_XML_ID" => $xmlID,
                                        "SECTION_CODE" => Array('ACCESSORY', 'MECHANISM', 'FUNCTION'),
                                        "ACTIVE_DATE" => "Y",
                                        "ACTIVE" => "Y");
                                    $res = CIBlockElement::GetList(Array(), $arFilter3, false, Array(), $arSelect3);
                                    while ($ob = $res->GetNextElement()) {

                                        $arFields = $ob->GetFields();
                                        $PriceF += $arFields['CATALOG_PRICE_1'];

                                    }
                                }
                            }


                            $ResArFields2 = array(
                                "PRODUCT_ID" => $value2,
                                "PRICE" => $PriceF,
                                "CURRENCY" => "RUB",
                                "WEIGHT" => 531,
                                "QUANTITY" => $quan1,
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

                        }

                    }


                    $arProps3[] = array(
                        "NAME" => "WALLS",
                        "VALUE" => $_POST['WALLS']
                    );


                    $arProps3[] = array(
                        "NAME" => "ROOM",
                        "VALUE" => $_POST['ROOM']
                    );


                    $arProps3[] = array(
                        "NAME" => "MEXLIST",
                        "VALUE" => $_POST['mexlist']
                    );


                    $ResArFields2["PROPS"] = $arProps3;

                    CSaleBasket::Update($basketItemID1, $ResArFields2);


                }
            }
        }

    }

} else {


    /*Вычитание рамки*/


    $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
    $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['result']['frame'], "ACTIVE" => "Y");
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
                "PRODUCT_ID" => $_POST['result']['frame']
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


                    if ($anyComp == $_POST['comp']) {

                        $basketItemID = $arItems['ID'];

                        $basQ = (int)$arItems['QUANTITY'];

                        $quanres = $basQ - 1;


                        if ($quanres >= 1) {

                            $ResArFields = array(
                                "PRODUCT_ID" => $_POST['result']['frame'],
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
                                "VALUE" => $_POST['comp']
                            );

                            $arProps1[] = array(
                                "NAME" => "ORIENTATION",
                                "VALUE" => $_POST['result']['frameOrientation']
                            );

                            $arProps1[] = array(
                                "NAME" => "ARTICUL",
                                "VALUE" => $arProps['ARTICUL']['VALUE']
                            );


                        }
                    }

                    $arProps1[] = array(
                        "NAME" => "WALLS",
                        "VALUE" => $_POST['WALLS']
                    );

                    $arProps1[] = array(
                        "NAME" => "ROOM",
                        "VALUE" => $_POST['ROOM']
                    );


                    $ResArFields["PROPS"] = $arProps1;


                    CSaleBasket::Update($basketItemID, $ResArFields);


                }
            }
        }
    }


    /*вычитание механизмов*/


    foreach ($_POST['result']['mechanisms'] as $key => $value2) {

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


            while ($arItems1 = $dbBasketItems->Fetch()) {

                $db_res = CSaleBasket::GetPropsList(
                    array(
                        "SORT" => "ASC",
                        "NAME" => "ASC"
                    ),
                    array("BASKET_ID" => $arItems1['ID'])
                );

                while ($ar_res = $db_res->Fetch()) {
                    if ($ar_res['NAME'] == 'KOMP') {
                        $anyComp1 = $ar_res['VALUE'];


                        if ($anyComp1 == $_POST['comp']) {

                            $basketItemID1 = $arItems1['ID'];
                            $basQ1 = (int)$arItems1['QUANTITY'];


                            if ($mexarr[$value2]) {
                                $mexarr1 = (int)$mexarr[$value2];
                                $quanres = $basQ1 - $mexarr1;
                            } else {
                                $quanres = $basQ1 - 1;
                            }


                            if ($quanres >= 1) {

                                $db_props = CIBlockElement::GetProperty($IDcat, $value2, array(), Array("CODE" => "PACKAGE_ARTICUL"));

                                while ($ar_props = $db_props->GetNext()) {
                                    $xmlID = $ar_props["VALUE"];

                                    if (!empty($xmlID)) {

                                        $arSelect3 = Array("ID", "IBLOCK_ID", "CATALOG_GROUP_1");
                                        $arFilter3 = Array(
                                            "IBLOCK_ID" => $IDcat,
                                            "PROPERTY_XML_ID" => $xmlID,
                                            "SECTION_CODE" => Array('ACCESSORY', 'MECHANISM', 'FUNCTION'),
                                            "ACTIVE_DATE" => "Y",
                                            "ACTIVE" => "Y");
                                        $res = CIBlockElement::GetList(Array(), $arFilter3, false, Array(), $arSelect3);
                                        while ($ob = $res->GetNextElement()) {

                                            $arFields = $ob->GetFields();
                                            $PriceF += $arFields['CATALOG_PRICE_1'];

                                        }
                                    }
                                }


                                $ResArFields2 = array(
                                    "PRODUCT_ID" => $value2,
                                    "PRICE" => $PriceF,
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


                            }

                        }

                        $arProps3[] = array(
                            "NAME" => "WALLS",
                            "VALUE" => $_POST['WALLS']
                        );


                        $arProps3[] = array(
                            "NAME" => "ROOM",
                            "VALUE" => $_POST['ROOM']
                        );


                        $arProps3[] = array(
                            "NAME" => "MEXLIST",
                            "VALUE" => $_POST['mexlist']
                        );


                        $ResArFields2["PROPS"] = $arProps3;

                        CSaleBasket::Update($basketItemID1, $ResArFields2);


                    }


                }
            }
        }


    }


}
