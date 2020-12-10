<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

/*
 * Получение id, code разделов
 */
$rsSections = \CIBlockSection::GetList(
    array(
        'SORT' => 'ASC'
    ),
    array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE']
    ),
    false,
    array(
        'IBLOCK_ID',
        'CODE',
        'ID'
    ),
false
);

while ($arSection = $rsSections->GetNext()) {
    $sectionId = $arSection['ID'];
    $arResult['SECTIONS'][ $sectionId ] = $arSection['CODE'];
}

/*
 * Получение цены функции по xmlId
 */
$xmlIdPrice = array();
foreach ($arResult['ITEMS'] as $item) {

    $sectionId = $item['IBLOCK_SECTION_ID'];
    if ($arResult['SECTIONS'][ $sectionId ] === 'FUNCTION') {
        foreach ($item['PROPERTIES']['PACKAGE_ARTICUL']['VALUE'] as $xmlId) {
            $xmlIdPrice[ $xmlId ] = $xmlId;
        }
    }
}

if (count($xmlIdPrice) > 0) {

    $rsCatalog = \CIBlockElement::GetList(
        array(),
        array(
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
            'SECTION_CODE' => array(
                'ACCESSORY',
                'MECHANISM'
            ),
            'ACTIVE' => 'Y',
            'PROPERTY_XML_ID' => $xmlIdPrice
        ),
        false,
        false,
        array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'CATALOG_GROUP_1',
            'PROPERTY_XML_ID'
        )
    );

    while ($arCatalog = $rsCatalog->Fetch()) {

        $xmlId = $arCatalog['PROPERTY_XML_ID_VALUE'];
        $price = $arCatalog['CATALOG_PRICE_1'];

        $arResult['XML_ID_PRICES'][ $xmlId ] = $price;
    }
}

$arResult['COLLECTIONS'] = \FourPx\Helper::getCollections();