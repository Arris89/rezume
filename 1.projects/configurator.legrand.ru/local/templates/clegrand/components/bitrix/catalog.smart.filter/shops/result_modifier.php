<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arFilterProps = [];
$arSelectedProps = [];
$filterName = $arParams['FILTER_NAME']; // arrFilter

$arComponentFilter = $GLOBALS[$filterName];

foreach ($arResult['ITEMS'] as $propId => $prop) {
    $arFilterProps[ $prop['CODE'] ] = array(
        'ID' => $propId,
        'CODE' => $prop['CODE'],
        'NAME' => $prop['NAME']
    );
}

// Дополняем данные по метро городом
$metroPropId = $arFilterProps['CONFIGURATOR_METRO']['ID'];
$metroIbElId = array_keys($arResult['ITEMS'][$metroPropId]['VALUES']);
$ob = \CIBlockElement::GetList([], ['ID' => $metroIbElId], false, false, ['ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_CITY']);
while($res = $ob->GetNext()){
    $arResult['ITEMS'][$metroPropId]['VALUES'][ $res['ID'] ]['CITY'] = $res['PROPERTY_CITY_VALUE'];
}

$arResult['FILTER_NAME'] = $filterName;
$arResult['FILTER_PROPS'] = $arFilterProps;
$arResult['CUR_FILTER'] = $arComponentFilter;
