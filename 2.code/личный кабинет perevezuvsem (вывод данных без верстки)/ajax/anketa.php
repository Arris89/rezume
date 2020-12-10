<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


if (CModule::IncludeModule('iblock')) {

    /*Добавление транспорта*/
    if ($_POST['transId']) {

        $el = new CIBlockElement;

        foreach ($_POST['imaglist'] as $key => $value) {
                $imaglist[$key] = $value;
        }

        $PROP = array();
        $PROP['NAME'] = $_POST['t_name']; 
        $PROP['DESCRIPTION'] = $_POST['t_desc'];       
        $PROP['TRANSPORT_FOTO'] = $imaglist;
        $PROP['ANKETA'] = $_POST['ank_id'];

        $arLoadProductArray = Array(
            "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
            "IBLOCK_ID" => 13,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $_POST['t_name'],
            "DETAIL_TEXT" => $_POST['t_desc'],
            "ACTIVE" => "Y"           

        );

        $PRODUCT_ID = $el->Add($arLoadProductArray);

    } /*Удаление транспорта*/

    elseif ($_POST['DelId']) {
        echo 'удаление';


        CIBlockElement::Delete($_POST['DelId']);
    } /*Добавление анкеты*/

    else {

        $el = new CIBlockElement;

        $PROP = array();

        $PROP['WORKEXP'] = $_POST['workexp'];
        $PROP['DRIVEEXP'] = $_POST['driveexp'];
        $PROP['ABOUT'] = $_POST['about'];
        $PROP['ABOUTDETAIL'] = $_POST['aboutdetail'];
        $PROP['SALES'] = $_POST['sales'];
        $PROP['CITY'] = $_POST['city'];
        $PROP['STREET'] = $_POST['street'];
        $PROP['HOME'] = $_POST['home'];
        $PROP['KVAR'] = $_POST['kv'];
        $PROP['TRAVEL'] = $_POST['trav'];


        foreach ($_POST['servlist'] as $key) {
            $services[] = $key;
        }

        $PROP['SERVICES'] = $services;

        $arLoadProductArray = Array(
            "IBLOCK_SECTION" => false,          
            "PROPERTY_VALUES" => $PROP,
            "ACTIVE" => "Y",           
        );

        $PRODUCT_ID = $_POST['ank_id']; 

        $res = $el->Update($PRODUCT_ID, $arLoadProductArray);


    }


}

?>