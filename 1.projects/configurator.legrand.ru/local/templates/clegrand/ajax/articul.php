<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');

$IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];

/*получение артикулов для рамки*/


$arSelect1 = Array('ID', 'IBLOCK_ID', 'CATALOG_GROUP_1');
$arFilter1 = Array("IBLOCK_ID" => $IDcat, "ID" => $_POST['result1']['frame']);
$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, Array(), $arSelect1);
while ($ob1 = $res1->GetNextElement()) {

    $arProps1 = $ob1->GetProperties();
    $arFields1 = $ob1->GetFields();

}

$modalResMech['FRAME'] = $arProps1['ARTICUL']['VALUE'];

$modalResMech['PRICE'] = number_format($arFields1['CATALOG_PRICE_1'], 2, '.', ' ');

/*получение артикулов для механизмов в модальное окно*/

if ($_POST['result1']['mechanisms'] !== "") {

    foreach ($_POST['result1']['mechanisms'] as $key => $value) {
        if ($value !== '') {

            $arSelect = Array('ID', 'IBLOCK_ID');
            $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $value);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while ($ob = $res->GetNextElement()) {

                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();


            }
            $modalResMech['MECH'][$arFields['ID']] = $arProps['ARTICUL']['VALUE'];
        }

    }

}


$modalResMech1 = json_encode($modalResMech);
print_r($modalResMech1);






