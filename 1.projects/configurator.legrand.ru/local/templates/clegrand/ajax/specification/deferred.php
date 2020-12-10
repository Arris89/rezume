<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');

/* Добавление в отложенные из спецификаций*/


if (isset($_POST['items'])) {

    $compName = 'Товары без комплекта';
    $catID = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];

    foreach ($_POST['items'] as $key => $value) {

        $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1', 'IBLOCK_SECTION_ID', "ACTIVE");
        $arFilter = Array("IBLOCK_ID" => $catID, "ID" => $value['id'], "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();


            $res = CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID']);
            if ($ar_res2 = $res->GetNext())


                if ($ar_res2['NAME'] == 'Рамки') {


                    /*Добавление рамки*/

                    $ResArFields = array(
                        "PRODUCT_ID" => $value['id'],
                        "PRICE" => $arFields['CATALOG_PRICE_1'],
                        "CURRENCY" => "RUB",
                        "WEIGHT" => 531,
                        "QUANTITY" => $value['count'],
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

                    $arProps1[] = array(
                        "NAME" => "ARTICUL",
                        "VALUE" => $arProps['ARTICUL']['VALUE']
                    );

                    $arProps1[] = array(
                        "NAME" => "ORIENTATION",
                        "VALUE" => "horizontal"
                    );


                    $ResArFields["PROPS"] = $arProps1;

                    CSaleBasket::Add($ResArFields);


                } /*Добавление механизмов*/


                else {


                    $db_props = CIBlockElement::GetProperty($catID, $value['id'], array(), Array("CODE" => "PACKAGE_ARTICUL"));

                    while ($ar_props = $db_props->GetNext()) {
                        $xmlID = $ar_props["VALUE"];

                        if (!empty($xmlID)) {

                            $arSelect3 = Array("ID", "IBLOCK_ID", "NAME", "CATALOG_GROUP_1");
                            $arFilter3 = Array(
                                "IBLOCK_ID" => $catID,
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

                    $res = CIBlockElement::GetByID($value['id']);
                    if ($ar_res = $res->GetNext())

                        $ResArFields2 = array(
                            "PRODUCT_ID" => $value['id'],
                            "PRICE" => $PriceF,
                            "CURRENCY" => "RUB",
                            "WEIGHT" => 531,
                            "QUANTITY" => $value['count'],
                            "LID" => LANG,
                            "DELAY" => "Y",
                            "CAN_BUY" => "Y",
                            "NAME" => $ar_res['NAME'],
                        );


                    $arProps3 = array();

                    $arProps3[] = array(
                        "NAME" => "KOMP",
                        "VALUE" => $compName
                    );

                    $arProps3[] = array(
                        "NAME" => "ARTICUL",
                        "VALUE" => $arProps['ARTICUL']['VALUE']
                    );


                    $ResArFields2["PROPS"] = $arProps3;


                    CSaleBasket::Add($ResArFields2);

                }


        }

    }

}