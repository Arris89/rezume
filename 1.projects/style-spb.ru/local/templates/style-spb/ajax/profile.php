<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


if (CModule::IncludeModule('sale')) {


    $ID = $_POST['us_id'];

    $user = new CUser;

    $fields = array();


    $fields = Array(
        "NAME" => $_POST['user_name'],
        "LAST_NAME" => $_POST['user_surname'],
        "EMAIL" => $_POST['user_email'],
    );

    $user->Update($ID, $fields);


}

?>