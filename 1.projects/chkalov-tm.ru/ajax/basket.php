<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule('sale')) {

    if (isset($_POST['ItemNumb3']) & isset($_POST['IdNumb2'])) {

        $arFields = array(

            "QUANTITY" => $_POST['ItemNumb3'],

        );

        CSaleBasket::Update($_POST['IdNumb2'], $arFields);
        echo $_POST['ItemNumb3'];
    }


    if (isset($_POST['ItemNumb2']) & isset($_POST['IdNumb'])) {

        $arFields = array(

            "QUANTITY" => $_POST['ItemNumb2'],

        );

        CSaleBasket::Update($_POST['IdNumb'], $arFields);
        echo $_POST['ItemNumb2'];
    }

}

?>