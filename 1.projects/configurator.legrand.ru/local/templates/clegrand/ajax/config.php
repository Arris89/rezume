<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
CModule::IncludeModule("sale");
$catID = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];


if (isset($_POST['frameID']) && isset($_POST['frameOrientation']) && isset($_POST['postsNumber'])) {

    /*Получаем название рамки*/

    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", 'CATALOG_GROUP_1');
    $arFilter = Array("IBLOCK_ID" => $catID, "ID" => $_POST['frameID'], "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
    }

    $result['name'] = $arFields['NAME'];
    $result['articul'] = $arProps['ARTICUL']['VALUE'];
    $result['price'] = number_format($arFields['CATALOG_PRICE_1'], 2, '.', ' ');
    $result['color'] = $arProps['FRAME_COLOR']['VALUE'];

    $res = CIBlockElement::GetByID($arProps['COLLECTION']['VALUE'][0]);
    if ($ar_res = $res->GetNext())


        /*Получаем максимальное числов постов*/

        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE");


    if ($arFields['CODE'] !== '') {

        $arFilter = Array("IBLOCK_ID" => $catID,
            "NAME" => $arFields['NAME'],
            "PROPERTY_COLLECTION" => $arProps["COLLECTION"]['VALUE'][0],
            "CODE" => $arFields['CODE'],
            "ACTIVE" => "Y");

    } else {

        $arFilter = Array("IBLOCK_ID" => $catID,
            "NAME" => $arFields['NAME'],
            "PROPERTY_COLLECTION" => $arProps["COLLECTION"]['VALUE_ENUM_ID'],
            "ACTIVE" => "Y");
    }

    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

    while ($ob = $res->GetNextElement()) {
        $arProps = $ob->GetProperties();

        $mass[] = $arProps['FRAME_COUNT_FUNCTION']['VALUE'];

    }

    $max = max($mass);
    $min = min($mass);

    $result['max'] = $max;
    $result['min'] = $min;
    $result['posts'] = $mass;


    $res = CIBlockElement::GetByID($arProps['COLLECTION']['VALUE'][0]);
    if ($ar_res = $res->GetNext())

        $result['collection'] = $ar_res['NAME'];


    if ($max < $_POST['postsNumber']) {

        /*Получаем картинку для уменьшенного числа постов */


        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE");
        $arFilter = Array("IBLOCK_ID" => $catID,
            "NAME" => $arFields['NAME'],
            "PROPERTY_FRAME_COUNT_FUNCTION_VALUE" => $max,
            "PROPERTY_COLLECTION" => $arProps['COLLECTION']['VALUE'][0],
            "CODE" => $arFields['CODE'],
            "ACTIVE" => "Y");
        $res1 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob1 = $res1->GetNextElement()) {
            $arFields1 = $ob1->GetFields();
            $arProps1 = $ob1->GetProperties();
            $result['ID'] = $arFields1['ID'];

        }


        if ($_POST['frameOrientation'] == 'horizontal') {

            $img = CFile::GetFileArray($arProps1['FRAME_IMG_HORIZONTAL']['VALUE']);
            $result['img'] = $img['SRC'];


        } else {

            $img = CFile::GetFileArray($arProps1['FRAME_IMG_VERTICAL']['VALUE']);
            $result['img'] = $img['SRC'];

        }


    } /*Вариант, когда минимальное кол-во постов больше запрашиваемого*/
    elseif ($min > $_POST['postsNumber']) {

        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE");
        $arFilter = Array("IBLOCK_ID" => $catID,
            "NAME" => $arFields['NAME'],
            "PROPERTY_FRAME_COUNT_FUNCTION_VALUE" => $min,
            "PROPERTY_COLLECTION" => $arProps['COLLECTION']['VALUE'][0],
            "CODE" => $arFields['CODE'],
            "ACTIVE" => "Y");
        $res1 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob1 = $res1->GetNextElement()) {
            $arFields1 = $ob1->GetFields();
            $arProps1 = $ob1->GetProperties();
            $result['ID'] = $arFields1['ID'];

        }


        if ($_POST['frameOrientation'] == 'horizontal') {

            $img = CFile::GetFileArray($arProps1['FRAME_IMG_HORIZONTAL']['VALUE']);
            $result['img'] = $img['SRC'];

        } else {

            $img = CFile::GetFileArray($arProps1['FRAME_IMG_VERTICAL']['VALUE']);
            $result['img'] = $img['SRC'];

        }

    } else {

        /*Получаем картинку для рамки c нормальным кол-вом постов*/

        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE");
        $arFilter = Array("IBLOCK_ID" => $catID,
            "NAME" => $arFields['NAME'],
            "PROPERTY_FRAME_COUNT_FUNCTION_VALUE" => $_POST['postsNumber'],
            "PROPERTY_COLLECTION" => $arProps['COLLECTION']['VALUE'][0],
            "CODE" => $arFields['CODE'],
            "ACTIVE" => "Y");
        $res1 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        $resNum = $res1->SelectedRowsCount();

        if ($resNum > 0) {

            while ($ob1 = $res1->GetNextElement()) {
                $arFields1 = $ob1->GetFields();
                $arProps1 = $ob1->GetProperties();
                $result['ID'] = $arFields1['ID'];

            }


            if ($_POST['frameOrientation'] == 'horizontal') {

                $img = CFile::GetFileArray($arProps1['FRAME_IMG_HORIZONTAL']['VALUE']);
                $result['img'] = $img['SRC'];

            } else {

                $img = CFile::GetFileArray($arProps1['FRAME_IMG_VERTICAL']['VALUE']);
                $result['img'] = $img['SRC'];

            }


        } else  /*Вариант когда выбранного числа постов не нашлось*/ {

            foreach ($mass as $key => $value) {
                if ($value > $_POST['postsNumber']) {
                    if (isset($mass[$key - 1])) {
                        $resPost = $mass[$key - 1];
                        break;
                    } else {

                        $resPost = $mass[$key];
                        break;
                    }

                }
            }

            $result['postfix'] = $resPost;

            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE");
            $arFilter = Array("IBLOCK_ID" => $catID,
                "NAME" => $arFields['NAME'],
                "PROPERTY_FRAME_COUNT_FUNCTION_VALUE" => $resPost,
                "PROPERTY_COLLECTION" => $arProps['COLLECTION']['VALUE'][0],
                "CODE" => $arFields['CODE'],
                "ACTIVE" => "Y");
            $res1 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

            while ($ob1 = $res1->GetNextElement()) {
                $arFields1 = $ob1->GetFields();
                $arProps1 = $ob1->GetProperties();
                $result['ID'] = $arFields1['ID'];

            }


            if ($_POST['frameOrientation'] == 'horizontal') {

                $img = CFile::GetFileArray($arProps1['FRAME_IMG_HORIZONTAL']['VALUE']);
                $result['img'] = $img['SRC'];

            } else {

                $img = CFile::GetFileArray($arProps1['FRAME_IMG_VERTICAL']['VALUE']);
                $result['img'] = $img['SRC'];
            }

        }


    }


    /*Вывод результата*/

    $ex = json_encode($result, JSON_UNESCAPED_SLASHES);
    echo $ex;

}


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
    echo number_format($resPrice, 2, '.', ' ');
}


/*Смена комнаты в модальном окне конфигуратора и в корзине*/
if (isset($_POST['room']) && isset($_POST['walls'])) {

    if (!$USER->IsAuthorized()) {
        $dbBasketItems = CSaleBasket::GetList(array(), array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'N'
        ));
    } else {
        $user = $USER->GetID();
        $dbBasketItems = CSaleBasket::GetList(array(), array(
            'USER_ID' => $user,
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'N'
        ));
    }

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
                    "DELAY" => "N",
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


/*Смена стен в модальном окне конфигуратора и в корзине*/
if (isset($_POST['walls']) && isset($_POST['room'])) {


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
                    "DELAY" => "N",
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





