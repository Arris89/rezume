<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule('main')) {

    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $pass_confirm = $_POST['pass_confirm'];
    $userId = $_POST['us_id'];


    function isUserPassword($userId, $password)
    {
        $userData = CUser::GetByID($userId)->Fetch();
        $salt = substr($userData['PASSWORD'], 0, (strlen($userData['PASSWORD']) - 32));
        $realPassword = substr($userData['PASSWORD'], -32);
        $password = md5($salt . $password);

    }


    isUserPassword($userId, $old_pass);


    if ($password == $realPassword) {
        if ($new_pass == $pass_confirm) {

            $user = new CUser;
            $fields = Array(
                "PASSWORD" => $new_pass,
                "CONFIRM_PASSWORD" => $pass_confirm,
            );
            $user->Update($userId, $fields);
            $strError .= $user->LAST_ERROR;
            if ($strError) {
                echo 'no';
            }

        } else {
            echo 'noconfirm';
        }

    }


}

?>