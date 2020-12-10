<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');

$IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];

/*1 Добавление в корзину из конфигуратора*/


/*удаление старых товаров при изменении комплекта*/
if ($_POST['comp'] !== 1) {


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
            if (($ar_res['NAME'] == 'KOMP') && ($ar_res['VALUE'] == $_POST['comp'])) {
                CSaleBasket::Delete($arItems['ID']);
            }
        }

    }


}


if (isset($_POST['result'])) {


    if ($_POST['result']['frame'] !== "") {


        $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
        $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['result']['frame'], "ACTIVE" => "Y");
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
                "PRODUCT_ID" => $_POST['result']['frame'],
                "PRICE" => $arFields['CATALOG_PRICE_1'],
                "CURRENCY" => "RUB",
                "WEIGHT" => 531,
                "QUANTITY" => 1,
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


            /*убираем лишнюю фильтрацию, осталвяем только коллекции*/
            $resultUrl = explode('&arrFilter_113', $_POST['url'], 2);
            $resultUrl1 = ltrim($resultUrl[0]);
            $resultUrl2 = explode('&arrFilter_112', $resultUrl1, 2);
            $resultUrl3 = ltrim($resultUrl2[0]);

            $resultUrl4 = explode('&arrFilter_104', $resultUrl3, 2);
            $resultUrl5 = ltrim($resultUrl4[0]);
            $resultUrl6 = explode('&arrFilter_105', $resultUrl5, 2);
            $resultUrl7 = ltrim($resultUrl6[0]);

            $arProps1[] = array(
                "NAME" => "URL",
                "VALUE" => $resultUrl7
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
                "VALUE" => $_POST['result']['frameOrientation']
            );

            $arProps1[] = array(
                "NAME" => "MEXLIST",
                "VALUE" => $_POST['mexlist']
            );


            $ResArFields["PROPS"] = $arProps1;


            CSaleBasket::Add($ResArFields);


        }
    }


    /*2 Добавление функций в корзину*/


    if ($_POST['result']['mechanisms'] !== "") {

        foreach ($_POST['result']['mechanisms'] as $key => $value2) {

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
                            "DELAY" => "N",
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
                            "DELAY" => "N",
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
                            "DELAY" => "N",
                            "CAN_BUY" => "Y",
                            "NAME" => $arFields2['NAME'],
                        );


                    }


                    $arProps3 = array();

                    $arProps3[] = array(
                        "NAME" => "KOMP",
                        "VALUE" => $compName
                    );

                    /*убираем фильтрацию по функциям*/
                    $resultUrl = explode('&arrFilter_113', $_POST['url'], 2);
                    $resultUrl1 = ltrim($resultUrl[0]);
                    $resultUrl2 = explode('&arrFilter_112', $resultUrl1, 2);
                    $resultUrl3 = ltrim($resultUrl2[0]);

                    $resultUrl4 = explode('&arrFilter_104', $resultUrl3, 2);
                    $resultUrl5 = ltrim($resultUrl4[0]);
                    $resultUrl6 = explode('&arrFilter_105', $resultUrl5, 2);
                    $resultUrl7 = ltrim($resultUrl6[0]);

                    $arProps1[] = array(
                        "NAME" => "URL",
                        "VALUE" => $resultUrl7
                    );

                    $arProps3[] = array(
                        "NAME" => "ARTICUL",
                        "VALUE" => $arProps2['ARTICUL']['VALUE']
                    );


                    $arProps3[] = array(
                        "NAME" => "WALLS",
                        "VALUE" => $_POST['walls']
                    );

                    $arProps3[] = array(
                        "NAME" => "ROOM",
                        "VALUE" => $_POST['room']
                    );

                    $arProps3[] = array(
                        "NAME" => "ORIENTATION",
                        "VALUE" => $_POST['result']['frameOrientation']
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


                    $ResArFields2["PROPS"] = $arProps3;


                    if ($arItems['QUANTITY'] > 0) {
                        CSaleBasket::Update($basketItemID, $ResArFields2);
                    } else {

                        CSaleBasket::Add($ResArFields2);

                    }

                }

            }
        }


    }


}

print_r($compName);