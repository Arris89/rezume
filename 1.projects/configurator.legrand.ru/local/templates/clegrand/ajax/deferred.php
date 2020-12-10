<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule("sale");


/*Добавление в отложенные из конфигуратора*/


/*удаление старых товаров при изменении комплекта*/
if ($_POST['comp'] !== 1) {


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
            if (($ar_res['NAME'] == 'KOMP') && ($ar_res['VALUE'] == $_POST['comp'])) {
                CSaleBasket::Delete($arItems['ID']);
            }
        }

    }


}


if (isset($_POST['resultdef'])) {

    if ($_POST['resultdef']['frame'] !== "") {


        $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
        $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
        $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['resultdef']['frame'], "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();

            $arSelect2 = Array('ID', 'IBLOCK_ID', 'NAME');
            $arFilter2 = Array("IBLOCK_ID" => $IDcoll, "ID" => $arProps['COLLECTION']['VALUE'][0], "ACTIVE" => "Y");
            $res2 = CIBlockElement::GetList(Array(), $arFilter2, false, Array(), $arSelect2);
            while ($ob2 = $res2->GetNextElement()) {
                $arFields2 = $ob2->GetFields();
            }

            if ($_POST['comp'] == 1) {
                /*делаем название комплекта уникальным*/
                $milliseconds = round(microtime(true) * 1000);
                $compName = $arFields2['NAME'] . ' ' . $arProps['FRAME_COLOR']['VALUE'] . ' comptimelab' . $milliseconds;
            } else {
                /*вариант для изменения комплекта*/
                $compName = $_POST['comp'];
            }

            /*Добавление рамки*/

            $ResArFields = array(
                "PRODUCT_ID" => $_POST['resultdef']['frame'],
                "PRICE" => $arFields['CATALOG_PRICE_1'],
                "CURRENCY" => "RUB",
                "WEIGHT" => 531,
                "QUANTITY" => 1,
                "LID" => LANG,
                "DELAY" => "Y",
                "CAN_BUY" => "Y",
                "NAME" => $arFields['NAME'],
            );


            $arProps1 = array();

            $arProps1[] = array(
                "NAME" => "KOMP",
                "VALUE" => $compName
            );

            /*убираем фильтрацию по функциям*/
            $resultUrl = explode('&arrFilter_113', $_POST['url'], 2);
            $resultUrl1 = ltrim($resultUrl[0]);
            $resultUrl2 = explode('&arrFilter_112', $resultUrl1, 2);
            $resultUrl3 = ltrim($resultUrl2[0]);

            $arProps1[] = array(
                "NAME" => "URL",
                "VALUE" => $resultUrl3
            );

            $arProps1[] = array(
                "NAME" => "ARTICUL",
                "VALUE" => $arProps['ARTICUL']['VALUE']
            );

            $arProps1[] = array(
                "NAME" => "WALLS",
                "VALUE" => $_POST['walls']
            );

            $arProps1[] = array(
                "NAME" => "ROOM",
                "VALUE" => $_POST['room']
            );


            $arProps1[] = array(
                "NAME" => "ORIENTATION",
                "VALUE" => $_POST['resultdef']['frameOrientation']
            );

            $arProps1[] = array(
                "NAME" => "MEXLIST",
                "VALUE" => $_POST['mexlist']
            );

            $ResArFields["PROPS"] = $arProps1;


            CSaleBasket::Add($ResArFields);


        }

    }

    /*Добавление механизмов*/
    foreach ($_POST['resultdef']['mechanisms'] as $key => $value2) {


        if ($value2 !== '') {


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
                        "DELAY" => "Y",
                        "PRODUCT_ID" => $value2
                    ),
                    false,
                    false,
                    array()
                );


                while ($arItems = $dbBasketItems->Fetch()) {

                    settype($arItems['QUANTITY'], "integer");

                }


                $db_props = CIBlockElement::GetProperty($IDcat, $value2, array(), Array("CODE" => "PACKAGE_ARTICUL"));
                $xmlMass = [];
                $PriceF = 0;
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
                            $arProps = $ob->GetProperties();

                            $xmlMass[$arFields["ID"]]['PRICE'] = $arFields['CATALOG_PRICE_1'];
                            $xmlMass[$arFields["ID"]]['ARTICUL'] = $arProps['ARTICUL']['VALUE'];

                            $PriceF += $arFields['CATALOG_PRICE_1'];

                        }
                    }
                }


                if ($arItems['QUANTITY']) {

                    $quan = $arItems['QUANTITY'] + 1;

                    $ResArFields2 = array(
                        "PRODUCT_ID" => $value2,
                        "PRICE" => $PriceF,
                        "CURRENCY" => "RUB",
                        "WEIGHT" => 531,
                        "QUANTITY" => $quan,
                        "LID" => LANG,
                        "DELAY" => "Y",
                        "CAN_BUY" => "Y",
                        "NAME" => $arFields2['NAME'],
                    );

                } else {

                    $ResArFields2 = array(
                        "PRODUCT_ID" => $value2,
                        "PRICE" => $PriceF,
                        "CURRENCY" => "RUB",
                        "WEIGHT" => 531,
                        "QUANTITY" => 1,
                        "LID" => LANG,
                        "DELAY" => "Y",
                        "CAN_BUY" => "Y",
                        "NAME" => $arFields2['NAME'],
                    );


                }


                $arProps2 = array();

                $arProps2[] = array(
                    "NAME" => "KOMP",
                    "VALUE" => $compName
                );


                /*убираем фильтрацию по функциям*/
                $resultUrl = explode('&arrFilter_113', $_POST['url'], 2);
                $resultUrl1 = ltrim($resultUrl[0]);
                $resultUrl2 = explode('&arrFilter_112', $resultUrl1, 2);
                $resultUrl3 = ltrim($resultUrl2[0]);

                $arProps1[] = array(
                    "NAME" => "URL",
                    "VALUE" => $resultUrl3
                );

                $arProps2[] = array(
                    "NAME" => "ARTICUL",
                    "VALUE" => $arProps['ARTICUL']['VALUE']
                );

                $arProps2[] = array(
                    "NAME" => "WALLS",
                    "VALUE" => $_POST['walls']
                );

                $arProps2[] = array(
                    "NAME" => "ROOM",
                    "VALUE" => $_POST['room']
                );


                $arProps3[] = array(
                    "NAME" => "ORIENTATION",
                    "VALUE" => $_POST['resultdef']['frameOrientation']
                );

                $xmlMass1 = json_encode($xmlMass, JSON_UNESCAPED_SLASHES);

                $arProps3[] = array(
                    "NAME" => "MEX",
                    "VALUE" => $xmlMass1
                );

                $arProps1[] = array(
                    "NAME" => "MEXLIST",
                    "VALUE" => $_POST['mexlist']
                );

                $ResArFields2["PROPS"] = $arProps2;


                if ($arItems['QUANTITY'] > 0) {
                    CSaleBasket::Update($basketItemID, $ResArFields2);
                } else {

                    CSaleBasket::Add($ResArFields2);

                }


            }

        }
    }


    /*подсчет количества товаров для вывода иконки в header*/
    if (!$USER->IsAuthorized()) {
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC", "ID" => "ASC"),
            array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
                "DELAY" => "Y"),
            false,
            false,
            array());
    } else {
        $user = $USER->GetID();
        $dbBasketItems = CSaleBasket::GetList(
            array(),
            array(
                "USER_ID" => $user,
                "LID" => SITE_ID,
                "DELAY" => "Y",
                "ORDER_ID" => null
            ),
            false,
            false,
            array()
        );
    }

    $list = $dbBasketItems->SelectedRowsCount();
    if ($list > 0) {
        $defResJS = json_encode($list);
        print_r($defResJS);
    }


}


/*Удаление всех товаров из отложенных*/
if (isset($_POST['deleteAll'])) {

    if (!$USER->IsAuthorized()) {

        $res = CSaleBasket::GetList(array(), array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'Y'
        ));
        while ($row = $res->fetch()) {
            CSaleBasket::Delete($row['ID']);
        }

    } else {

        $user = $USER->GetID();

        $res = CSaleBasket::GetList(array(), array(
            'USER_ID' => $user,
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'Y'
        ));
        while ($row = $res->fetch()) {
            CSaleBasket::Delete($row['ID']);
        }


    }

}


/*Удаление комлекта из отложенных*/
if (isset($_POST['delname1'])) {

    if (!$USER->IsAuthorized()) {

        $res = CSaleBasket::GetList(array(), array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'N'
        ));

    } else {

        $user = $USER->GetID();

        $res = CSaleBasket::GetList(array(), array(
            'USER_ID' => $user,
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'N'
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
            if (($ar_res['NAME'] == 'KOMP') && ($ar_res['VALUE'] == $_POST['delname1'])) {
                CSaleBasket::Delete($arItems['ID']);
            }
        }

    }
}


/*Кнопка Купить позже в корзине*/

if (isset($_POST['delname'])) {

    $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
    $j = 0;
    $res = CSaleBasket::GetList(
        array(),
        array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'DELAY' => 'N'
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
                if ($ar_res['VALUE'] == $_POST['delname']) {


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
                "DELAY" => "Y",
                "CAN_BUY" => "Y",
                "NAME" => $arFields['NAME'],
            );


            $arProps1 = array();

            $arProps1[] = array(
                "NAME" => "KOMP",
                "VALUE" => $_POST['delname']
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
                "NAME" => "MEXLIST",
                "VALUE" => $_POST['mexlist']
            );


            $arProps1[] = array(
                "NAME" => "ORIENTATION",
                "VALUE" => $_POST['frameorientation']
            );


            $ResArFields["PROPS"] = $arProps1;

            CSaleBasket::Update($value['BASKET_ID'], $ResArFields);


        }

    }

}

?>