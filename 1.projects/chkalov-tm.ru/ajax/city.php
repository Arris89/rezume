<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


    if (isset($_POST['city'])) {



        session_start();

        $_SESSION['city'] = $_POST['city'];

        header("Content-type: text/html; charset=UTF-8");



}

?>