<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
$catID = \FourPx\Helper::getIblockIdByCodes('catalog')["catalog"];


if ($_POST['mass'] !== 'none') {

    foreach ($_POST['mass'] as $key => $value) {


        $arSelect = Array("ID", "IBLOCK_ID", "NAME", 'CATALOG_GROUP_1');
        $arFilter = Array("IBLOCK_ID" => $catID, "ID" => $value, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
        }

        $products += $arFields['CATALOG_PRICE_1'];
    }


}


/*цена рамки*/

$arSelect = Array("ID", "IBLOCK_ID", 'CATALOG_GROUP_1');
$arFilter = Array("IBLOCK_ID" => $catID, "ID" => $_POST['frameID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
}


if ($products) {
    $cost = $arFields['CATALOG_PRICE_1'] + $products;
} else {
    $cost = $arFields['CATALOG_PRICE_1'];
}


echo $cost;







