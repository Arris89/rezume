<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

Bitrix\Main\Loader::includeModule('iblock');

$iblockID = \IbHelp\Helper::getIblockIdByCodes('img')["img"];


if (isset($_POST['x']) && isset($_POST['y']) && isset($_POST['sect'])) {


    $el = new CIBlockElement;

    $PROP = array();

    $PROP['X_COORD'] = $_POST['x'];
    $PROP['Y_COORD'] = $_POST['y'];
    $PROP['RAZDEL'] = $_POST['sect'];

    $arSelect = Array("ID", "IBLOCK_ID");

    $arFilter = Array(
        "IBLOCK_ID" => IntVal($iblockID),
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y"
    );

    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

    /*имя прописываем как кол-во элементов в разделе +1*/
    $name = ($res->SelectedRowsCount()) + 1;


    $arLoadProductArray = Array(
        "IBLOCK_ID" => $iblockID,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $name,
        "ACTIVE" => "Y",
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);


}


/*Удаление точек с картинки*/
if (isset($_POST['rm']) && isset($_POST['sect'])) {

    $arSelect = Array("ID", "IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID" => IntVal($iblockID), "PROPERTY_RAZDEL" => $_POST['sect'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        CIBlockElement::Delete($arFields['ID']);
    }


}
