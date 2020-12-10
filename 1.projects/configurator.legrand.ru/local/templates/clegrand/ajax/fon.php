<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

if (isset($_POST['id'])) {

    $arSelect = Array("ID", "IBLOCK_ID", "PREVIEW_PICTURE");
    $arFilter = Array("IBLOCK_ID" => $catID,
        "ID" => $_POST['id'],
        "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $img = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
        echo $img['SRC'];

    }

}

