<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arCollections = array();
foreach($arResult['FUNCTION']['ITEMS'] as $arFunction) {
    $functionId = $arFunction['ID'];

    $collectionPropId = $arFunction['PROPERTIES']['COLLECTION']['ID'];
    $filterCollectionId = $arParams['CATALOG_QUERY_FILTER'][ $collectionPropId ];

    $collectionValId = $arFunction['PROPERTIES']['COLLECTION']['VALUE'][0];
    $collectionValSort = $arResult['FUNCTION']['COLLECTIONS'][ $collectionValId ]['SORT'];
    $collection = $arResult['FUNCTION']['COLLECTIONS'][ $collectionValId ]['NAME'];

    if (stripos($collection, 'Livinglight') !== false) {
        $collection = 'Livinglight';
    }

    if (count($arFunction['PROPERTIES']['COLLECTION']['VALUE']) > 1) {
        foreach ($arFunction['PROPERTIES']['COLLECTION']['VALUE'] as $collectionId) {

            if ((int)$collectionId === (int)$filterCollectionId) {
                $collectionValId = $collectionId;
                $collectionValSort = $arResult['FUNCTION']['COLLECTIONS'][ $collectionId ]['SORT'];
                $collection = $arResult['FUNCTION']['COLLECTIONS'][ $collectionId ]['NAME'];
            }
        }
    }

    $functionGroupPropId = $arFunction['PROPERTIES']['FUNCTION_GROUP']['ID'];
    $filterFunctionGroup = $arParams['CATALOG_QUERY_FILTER'][ $functionGroupPropId ];

    $functionGroup = $arFunction['PROPERTIES']['FUNCTION_GROUP']['VALUE'][0];

    if (count($arFunction['PROPERTIES']['FUNCTION_GROUP']['VALUE']) > 1) {
        $functionGroup = implode('|', $arFunction['PROPERTIES']['FUNCTION_GROUP']['VALUE']);

        foreach ($arFunction['PROPERTIES']['FUNCTION_GROUP']['VALUE'] as $function) {

            if ($function === $filterFunctionGroup) {
                $functionGroup = $function;
            }
        }
    }

    $arCollections[ $functionId ]['ID'] = $functionId;
    $arCollections[ $functionId ]['NAME'] = $arFunction['NAME'];
    $arCollections[ $functionId ]['COLLECTION_ID'] = $collectionValId;
    $arCollections[ $functionId ]['COLLECTION_SORT'] = $collectionValSort;
    $arCollections[ $functionId ]['COLLECTION'] = $collection;
    $arCollections[ $functionId ]['PICTURE'] = $arResult['FUNCTION']['IMAGES'][ $arFunction['PROPERTIES']['FUNCTION_IMG']['VALUE'] ];
    $arCollections[ $functionId ]['FUNCTION_GROUP'] = $functionGroup;
    $arCollections[ $functionId ]['COLOR'] = $arFunction['PROPERTIES']['FUNCTION_COLOR']['VALUE'];
    $arCollections[ $functionId ]['COUNT_FUNCTION'] = $arFunction['PROPERTIES']['FRAME_COUNT_FUNCTION']['VALUE'];

    foreach ($arFunction['PROPERTIES']['PACKAGE_ARTICUL']['VALUE'] as $xmlId) {
        $arCollections[ $functionId ]['XML_ID_PRICE'][ $xmlId ] = $arResult['FUNCTION']['XML_ID_PRICE'][ $xmlId ];
    }
}
$arResult['FUNCTION']['ITEMS'] = $arCollections;