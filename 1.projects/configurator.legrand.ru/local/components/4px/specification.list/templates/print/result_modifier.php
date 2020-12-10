<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$userId = $USER->GetID();
$rsUser = \CUser::GetByID($userId);

$arResult['CURRENT_USER'] = array();
if ($arUser = $rsUser->Fetch()) {
    $arResult['CURRENT_USER']['NAME'] = $arUser['NAME'];
    $arResult['CURRENT_USER']['FULL_NAME'] = $arUser['NAME'] . ' ' . $arUser['LAST_NAME'];
    $arResult['CURRENT_USER']['EMAIL'] = $arUser['EMAIL'];
}