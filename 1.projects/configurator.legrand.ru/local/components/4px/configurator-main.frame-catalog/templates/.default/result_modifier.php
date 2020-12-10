<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arCollections = array();
foreach($arResult['FRAME']['ITEMS'] as $arFrame) {
    $frameId = $arFrame['ID'];
    $collectionId = $arFrame['PROPERTIES']['COLLECTION']['VALUE'][0];

    $arCollections[ $frameId ]['ID'] = $frameId;
    $arCollections[ $frameId ]['NAME'] = $arFrame['NAME'];
    $arCollections[ $frameId ]['COLLECTION_ID'] = $arResult['FRAME']['COLLECTIONS'][ $collectionId ]['ID'];
    $arCollections[ $frameId ]['COLLECTION_CODE'] = $arResult['FRAME']['COLLECTIONS'][ $collectionId ]['CODE'];
    $arCollections[ $frameId ]['COLLECTION_SORT'] = $arResult['FRAME']['COLLECTIONS'][ $collectionId ]['SORT'];
    $arCollections[ $frameId ]['COLLECTION'] = $arResult['FRAME']['COLLECTIONS'][ $collectionId ]['NAME'];
    $arCollections[ $frameId ]['PICTURE'] = $arResult['FRAME']['IMAGES'][ $arFrame['PROPERTIES']['FRAME_IMG_HORIZONTAL']['VALUE'] ];
    $arCollections[ $frameId ]['MATERIAL'] = $arFrame['PROPERTIES']['FRAME_MATERIAL']['VALUE'];
    $arCollections[ $frameId ]['COUNT_FUNCTION'] = $arFrame['PROPERTIES']['FRAME_COUNT_FUNCTION']['VALUE'];
    $arCollections[ $frameId ]['PRICE'] = $arFrame['CATALOG_PRICE_1'];

    $arPosts = array();
    $frameCode = $arFrame['CODE'];
    foreach($arResult['FRAME']['FRAME_COUNT_FUNCTION'][ $frameCode ] as $arFrame) {
        $post = $arFrame['FRAME_COUNT_FUNCTION'];
        $arPosts[ $post ] = $post;
    }

    $arCollections[ $frameId ]['COLLECTION_POSTS'] = $arPosts;
}
$arResult['FRAME']['ITEMS'] = $arCollections;