<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$userId = $USER->GetID();
$rsUser = \CUser::GetByID($userId);

/*
 * Получение имени текущего зарегистрированного пользователя
 */
$arResult['CURRENT_USER'] = array();
if ($arUser = $rsUser->Fetch()) {
    $arResult['CURRENT_USER']['NAME'] = $arUser['NAME'];
    $arResult['CURRENT_USER']['FULL_NAME'] = $arUser['NAME'] . ' ' . $arUser['LAST_NAME'];
    $arResult['CURRENT_USER']['EMAIL'] = $arUser['EMAIL'];
}
unset($rsUser);

/*
 * Получение справочника коллекций
 */
$arCollection = \FourPx\Helper::getCollections();

/*
 * Получение справочника аксессуаров/механизмов
 * по XML_ID
 */
$arXmlIdList = array();
foreach ($arResult['GRID']['ROWS'] as $productKey => $arProduct) {
    $arResult['GRID']['ROWS'][ $productKey ]['PROPERTY_COLLECTION_VALUE'] = $arCollection[ $arProduct['PROPERTY_COLLECTION_VALUE'] ]['NAME'];
    $productId = $arProduct['PRODUCT_ID'];

    $arXmlId = array();
    if (! empty($arProduct['PROPERTY_PACKAGE_ARTICUL_VALUE'])) {
        $arXmlId = explode(',', trim($arProduct['PROPERTY_PACKAGE_ARTICUL_VALUE']));
    }

    if (is_array($arXmlId)) {

        foreach ($arXmlId as &$xmlId) {
            $xmlId = trim($xmlId);
            $arXmlIdList[ $xmlId ] = $xmlId;
        }
        unset($xmlId);

        $arResult['GRID']['ROWS'][ $productKey ]['XML_ID_PACKAGE_ARTICUL'] = $arXmlId;
    }
}

$rsAccessories = \CIBlockElement::GetList(
    array(),
    array(
        'IBLOCK_ID' => 25,
        'IBLOCK_TYPE' => 'catalog',
        'SECTION_CODE' => array(
            'ACCESSORY',
            'MECHANISM'
        ),
        'ACTIVE' => 'Y',
        'PROPERTY_XML_ID' => $arXmlIdList
    ),
    false,
    false,
    array(
        'ID',
        'NAME',
        'IBLOCK_ID',
        'IBLOCK_SECTION_ID',
        'CATALOG_GROUP_1',
    )
);

$arAccessoriesList = array();
while ($arAccessories = $rsAccessories->GetNextElement()) {
    $arAccessoriesFields = $arAccessories->GetFields();
    $arAccessoriesProps = $arAccessories->GetProperties();

    $xmlId = $arAccessoriesProps['XML_ID']['VALUE'];

    $arAccessoriesList[ $xmlId ]['ID'] = $arAccessoriesFields['ID'];
    $arAccessoriesList[ $xmlId ]['XML_ID'] = $arAccessoriesProps['XML_ID']['VALUE'];
    $arAccessoriesList[ $xmlId ]['NAME'] = $arAccessoriesFields['NAME'];
    $arAccessoriesList[ $xmlId ]['BASE_PRICE'] = $arAccessoriesFields['CATALOG_PRICE_1'];
    $arAccessoriesList[ $xmlId ]['ARTICUL'] = $arAccessoriesProps['ARTICUL']['VALUE'];
}
unset($rsAccessories);

/*
 * Запись аксессуаров/механизмов по XML_ID для конкретного товара
 */
foreach ($arResult['GRID']['ROWS'] as $productKey => $arProduct) {

    $baseCustomPrice = array();
    if ($arProduct['PROPERTY_SECTION_CODE_VALUE'] === 'FUNCTION') {
        foreach ($arProduct['XML_ID_PACKAGE_ARTICUL'] as $xmlId) {
            $arXmlId = $arAccessoriesList[$xmlId];

            if (count($arXmlId) > 0) {
                $quantityAccessories = $arProduct['QUANTITY'] * (int)substr_count($arProduct['PROPERTY_PACKAGE_ARTICUL_VALUE'], $xmlId);
                $basePriceAccessories = $arAccessoriesList[$xmlId]['BASE_PRICE'];
                $fullPriceAccessories = round($quantityAccessories * $basePriceAccessories, 2);

                $arResult['GRID']['ROWS'][$productKey]['MECHANISM_FOR_FUNCTION'][$xmlId] = $arXmlId;
                $arResult['GRID']['ROWS'][$productKey]['MECHANISM_FOR_FUNCTION'][$xmlId]['QUANTITY'] = $quantityAccessories;
                $arResult['GRID']['ROWS'][$productKey]['MECHANISM_FOR_FUNCTION'][$xmlId]['SUM_BASE_PRICE'] = $fullPriceAccessories;
                $baseCustomPrice[ $xmlId ] = $basePriceAccessories * substr_count($arProduct['PROPERTY_PACKAGE_ARTICUL_VALUE'], $xmlId);
            }
        }
    } else if ($arProduct['PROPERTY_SECTION_CODE_VALUE'] === 'FRAME') {
        $baseCustomPrice[] = $arProduct['BASE_PRICE'];
    }

    $baseCustomPrice = array_sum($baseCustomPrice);
    $sumBaseCustomPrice = $baseCustomPrice * $arProduct['QUANTITY'];

    $arResult['GRID']['ROWS'][$productKey]['BASE_CUSTOM_PRICE'] = $baseCustomPrice;
    $arResult['GRID']['ROWS'][$productKey]['SUM_BASE_CUSTOM_PRICE'] = $sumBaseCustomPrice;
}

/*
 * Комплекты/Товары без комплекта для отображения в корзине
 */
$arResult['COMPLECTATIONS_ITEMS'] = array();
foreach ($arResult['GRID']['ROWS'] as $productKey => $arProduct) {

    if ($arProduct['PROPERTY_SECTION_CODE_VALUE'] === 'FUNCTION') {
        foreach ($arProduct['XML_ID_PACKAGE_ARTICUL'] as $xmlId) {
            $arXmlId = $arAccessoriesList[$xmlId];

            if (count($arXmlId) > 0) {
                $arResult['GRID']['ROWS'][$productKey]['MECHANISM_FOR_FUNCTION'][$xmlId] = $arXmlId;
            }
        }
    }

    foreach ($arProduct['PROPS'] as $arProperty) {
        if ($arProperty['CODE'] === 'KOMP') {
            $complectNameId = $arProperty['VALUE'];

            $arResult['COMPLECTATIONS_ITEMS'][ $complectNameId ][] = $arProduct;
        }
    }
}