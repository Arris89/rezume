<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*
 * Сортировка коллекций по полю SORT
 */
$arResult['IBLOCK_PROPS_REFERENCE'] = \FourPx\Helper::getIBlockPropsReference('CATALOG');

$arCollections = \FourPx\Helper::getCollections();
$collectionId = $arResult['IBLOCK_PROPS_REFERENCE']['COLLECTION']['ID'];
foreach ($arResult['ITEMS'][ $collectionId ]['VALUES'] as $idCollection => &$arCollection) {
    $arCollection['SORT'] = $arCollections[ $idCollection ]['SORT'];
}
unset($arCollection);

uasort($arResult['ITEMS'][ $collectionId ]['VALUES'], 'cmp_usort_filter_frame');

function cmp_usort_filter_frame($str1, $str2) {

    if ($str1['SORT'] == $str2['SORT']) {
        return 0;
    }
    return ($str1['SORT'] < $str2['SORT']) ? -1 : 1;
}