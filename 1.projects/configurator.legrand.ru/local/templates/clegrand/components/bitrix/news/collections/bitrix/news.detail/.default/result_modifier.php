<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/*
 * Получение минимальной цены по уникальным ID комплектующих
 * (выключатель в сборе с рамкой)
 */
$collectionId = $arResult['ID'];
$arXmlId = explode(',', $arResult['PROPERTIES']['XML_ID']['VALUE']);
foreach ($arXmlId as &$xmlId) {
    trim($xmlId);
}
unset($xmlId);

$rsFunctionPrice = \CIBlockElement::GetList(
    array(),
    array(
        'IBLOCK_ID' => '25',
        'PROPERTY_XML_ID' => $arXmlId,
        'ACTIVE' => 'Y',
        'CATALOG_GROUP_1'
    ),
    false,
    false,
    array(
        'ID',
        'IBLOCK_ID',
        'NAME',
        'IBLOCK_SECTION_ID',
        'CATALOG_PRICE_1',
        'PROPERTY_XML_ID'
    )
);

$arFunctionsPrices = array();
while ($arFunctionPrice = $rsFunctionPrice->GetNext()) {

    $xmlId = $arFunctionPrice['PROPERTY_XML_ID_VALUE'];

    $arFunctionsPrices[ $xmlId ]['IBLOCK_SECTION_ID'] = $sectionID;
    $arFunctionsPrices[ $xmlId ]['ID'] = $arFunctionPrice['ID'];
    $arFunctionsPrices[ $xmlId ]['NAME'] = $arFunctionPrice['NAME'];
    $arFunctionsPrices[ $xmlId ]['PRICE'] = $arFunctionPrice['CATALOG_PRICE_1'];
}
unset($rsFunctionPrice);

$arResult['MIN_PRICE'] = '';
foreach($arFunctionsPrices as $functionPrice) {
    $arResult['MIN_PRICE'] += $functionPrice['PRICE'];
}

$arResult['MIN_PRICE'];

/*
 * Получение постов в зависимости от коллекции
 * Количесиво отображаемых постов управляется
 * из админю панели сайта
 */
if (is_array($arResult['PROPERTIES']['COLLECTIONS']['VALUE'])
    && count($arResult['PROPERTIES']['COLLECTIONS']['VALUE']) > 0
) {
    $arResult['COLLECTIONS'] = array();

    $rsCollections = \CIBlockElement::GetList(
        array(
            'SORT' => 'ASC'
        ),
        array(
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'ID' => $arResult['PROPERTIES']['COLLECTIONS']['VALUE'],
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y'
        ),
        false,
        false,
        array(
            'ID',
            'CODE',
            'NAME',
            'PROPERTY_SLOTS'
        )
    );

    while ($arCollection = $rsCollections->GetNext()) {

        $collectionCode = $arCollection['CODE'];
        $slotValue = $arCollection['PROPERTY_SLOTS_VALUE'];

        $arResult['COLLECTIONS'][ $collectionCode ]['CODE'] = $collectionCode;
        $arResult['COLLECTIONS'][ $collectionCode ]['NAME'] = $arCollection['NAME'];
        $arResult['COLLECTIONS'][ $collectionCode ]['SLOTS'][ $slotValue ] = $slotValue;
    }
}