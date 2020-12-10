<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('main');
CModule::IncludeModule('iblock');

$iblockID = \IbHelp\Helper::getIblockIdByCodes('img')["img"];


/*2 добавление отметок на изображение*/
$i = 1;
foreach ($_POST['mass'] as $key => $value1) {
    $products[$key] = $value1;


    $el = new CIBlockElement;

    $PROP = array();

    $PROP['Y_COORD'] = $value1[0];
    $PROP['X_COORD'] = $value1[1];
    $PROP['RAZDEL'] = $value['sect'];


    $arLoadProductArray = Array(
        "IBLOCK_ID" => $iblockID,
        "IBLOCK_SECTION_ID" => $_POST['razdel'],
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $value1[2],
        "ACTIVE" => "Y",
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);

    $i++;
}

