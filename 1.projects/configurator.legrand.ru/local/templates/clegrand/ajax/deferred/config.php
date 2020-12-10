<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
CModule::IncludeModule("sale");
$catID = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];


/*Получаем цену выбранного комплекта*/

if (isset($_POST['result'])) {

    /*Цена рамки*/
    if ($result['frame'] !== "null") {


        $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1');
        $arFilter = Array("IBLOCK_ID" => $catID, "ID" => $_POST['result']['frame'], "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();

            $resCost = $arFields['CATALOG_PRICE_1'];
        }


    }


    /*Цена механизмов*/
    foreach ($_POST['result']['mechanisms'] as $key => $value2) {


        if ($value2 !== "") {


            $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
            $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1', "ACTIVE");
            $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $value2, "ACTIVE" => "Y");
            $res2 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while ($ob2 = $res2->GetNextElement()) {
                $arFields2 = $ob2->GetFields();
                $arProps2 = $ob2->GetProperties();

                $db_props = CIBlockElement::GetProperty($IDcat, $value2, array(), Array("CODE" => "PACKAGE_ARTICUL"));
                $xmlMass = [];
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

                            $xmlMass['PRICE'][$arFields["ID"]] = $arFields['CATALOG_PRICE_1'];
                            $xmlMass[$arFields["ID"]]['ARTICUL'] = $arProps['ARTICUL']['VALUE'];

                            $PriceF[] = $arFields['CATALOG_PRICE_1'];

                        }
                    }
                }
            }

        }
    }

    $resMeh = array_sum($PriceF);
    $resPrice = $resCost + $resMeh;
    echo $resPrice;
}


/*Смена комнаты в отложенных товарах*/
if (isset($_POST['room']) && isset($_POST['walls'])) {


    $dbBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "DELAY" => "Y",
        ),
        false,
        false,
        array()
    );

    while ($arItems = $dbBasketItems->Fetch()) {

        $basQ = (int)$arItems['QUANTITY'];

        $db_res = CSaleBasket::GetPropsList(
            array(
                "SORT" => "ASC",
                "NAME" => "ASC"
            ),
            array("BASKET_ID" => $arItems['ID'])
        );


        while ($ar_res = $db_res->Fetch()) {

            if ($ar_res['NAME'] == 'ARTICUL') {
                $art = $ar_res['VALUE'];
            }

            if (($ar_res['NAME'] == 'KOMP') && ($ar_res['VALUE'] == $_POST['room']['comp'])) {


                $ResArFields = array(
                    "PRODUCT_ID" => $arItems['PRODUCT_ID'],
                    "PRICE" => $arItems['PRICE'],
                    "CURRENCY" => "RUB",
                    "WEIGHT" => 531,
                    "LID" => LANG,
                    "DELAY" => "Y",
                    "CAN_BUY" => "Y",
                    "NAME" => $arItems['NAME'],
                );


                $arProps1 = array();

                $arProps1[] = array(
                    "NAME" => "KOMP",
                    "VALUE" => $_POST['room']['comp']
                );


                $arProps1[] = array(
                    "NAME" => "URL",
                    "VALUE" => $_POST['url']
                );

                $arProps1[] = array(
                    "NAME" => "ROOM",
                    "VALUE" => $_POST['room']['room']
                );

                $arProps1[] = array(
                    "NAME" => "WALLS",
                    "VALUE" => $_POST['walls']
                );

                $arProps1[] = array(
                    "NAME" => "ARTICUL",
                    "VALUE" => $art
                );

                $arProps1[] = array(
                    "NAME" => "ORIENTATION",
                    "VALUE" => $_POST['frameOrientation']
                );

                $arProps1[] = array(
                    "NAME" => "MEXLIST",
                    "VALUE" => $_POST['mexlist']
                );


                $ResArFields["PROPS"] = $arProps1;


                CSaleBasket::Update($arItems['ID'], $ResArFields);

            }

        }

    }

}


/*Смена стен в отложенных товарах*/
if (isset($_POST['walls']) && isset($_POST['room'])) {


    $dbBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "DELAY" => "Y",
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

            if ($ar_res['NAME'] == 'ARTICUL') {
                $art = $ar_res['VALUE'];
            }

            if (($ar_res['NAME'] == 'KOMP') && ($ar_res['VALUE'] == $_POST['walls']['comp'])) {


                $ResArFields = array(
                    "PRODUCT_ID" => $arItems['PRODUCT_ID'],
                    "PRICE" => $arItems['PRICE'],
                    "CURRENCY" => "RUB",
                    "WEIGHT" => 531,
                    "LID" => LANG,
                    "DELAY" => "Y",
                    "CAN_BUY" => "Y",
                    "NAME" => $arItems['NAME'],
                );


                $arProps1 = array();

                $arProps1[] = array(
                    "NAME" => "KOMP",
                    "VALUE" => $_POST['walls']['comp']
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
                    "NAME" => "WALLS",
                    "VALUE" => $_POST['walls']['walls']
                );

                $arProps1[] = array(
                    "NAME" => "ROOM",
                    "VALUE" => $_POST['room']
                );

                $arProps1[] = array(
                    "NAME" => "ARTICUL",
                    "VALUE" => $art
                );

                $arProps1[] = array(
                    "NAME" => "ORIENTATION",
                    "VALUE" => $_POST['frameOrientation']
                );


                $ResArFields["PROPS"] = $arProps1;


                CSaleBasket::Update($arItems['ID'], $ResArFields);

            }

        }

    }

}





