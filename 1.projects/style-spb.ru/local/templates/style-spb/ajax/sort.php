<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if (isset($_POST['sortcat'])) {

    session_start();
    $_SESSION['sortcat'] = $_POST['sortcat'];
    $_SESSION['ordercat'] = $_POST['ordercat'];
    header("Content-type: text/html; charset=UTF-8");
    print_r('ok');

}
?>