<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$iblockPropsReference = \FourPx\Helper::getIBlockPropsReference('CATALOG');

$arResult['FILTER_PROPS_CODE']['COLLECTION'] = $iblockPropsReference['COLLECTION']['ID'];
$arResult['FILTER_PROPS_CODE']['COLOR_RAM'] = $iblockPropsReference['COLOR_RAM']['ID'];
$arResult['FILTER_PROPS_CODE']['MATERIAL'] = $iblockPropsReference['MATERIAL']['ID'];
$arResult['FILTER_PROPS_CODE']['FUNCTION'] = $iblockPropsReference['FUNCTION']['ID'];
$arResult['FILTER_PROPS_CODE']['COLOR_MEX'] = $iblockPropsReference['COLOR_MEX']['ID'];
$arResult['FILTER_PROPS_CODE']['FRAME_COUNT_FUNCTION'] = $iblockPropsReference['FRAME_COUNT_FUNCTION']['ID'];

$arResult['FILTER_FRAME']['COLLECTION'] = '=PROPERTY_' . $iblockPropsReference['COLLECTION']['ID'];
$arResult['FILTER_FRAME']['MATERIAL'] = '=PROPERTY_' . $iblockPropsReference['FRAME_MATERIAL']['ID'];
$arResult['FILTER_FRAME']['COLOR'] = '=PROPERTY_' . $iblockPropsReference['FRAME_COLOR']['ID'];

$arResult['FILTER_FUNCTION']['COLLECTION'] = '=PROPERTY_' . $iblockPropsReference['COLLECTION']['ID'];
$arResult['FILTER_FUNCTION']['FUNCTION_GROUP'] = '=PROPERTY_' . $iblockPropsReference['FUNCTION_GROUP']['ID'];
$arResult['FILTER_FUNCTION']['COLOR'] = '=PROPERTY_' . $iblockPropsReference['FUNCTION_COLOR']['ID'];