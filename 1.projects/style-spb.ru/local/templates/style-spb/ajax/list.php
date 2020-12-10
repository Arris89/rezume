<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if (isset($_POST['list'])) {

    session_start();
    $_SESSION['list'] = $_POST['list'];
    header("Content-type: text/html; charset=UTF-8");
    print_r('ok');
}

?>