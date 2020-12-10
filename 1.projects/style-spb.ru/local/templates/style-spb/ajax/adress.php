<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('highloadblock');

if (isset($_POST['adr'])) {

    $ID = 5;
    $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
    $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
    $entity_data_class = $hlentity->getDataClass();
    $result = $entity_data_class::getList(array(
        "select" => array("ID", "UF_USER", "UF_CITY", "UF_INDEX", "UF_PHONE", "UF_COUNTRY", "UF_STREET", "UF_COMPANY", "UF_FIO", "UF_ALIAS"),
        "order" => array(),
        "filter" => array("ID" => $_POST['adr']),
    ));

    $resds = $result->fetch();


    $resds1 = json_encode($resds);
    print_r($resds1);

}
?>