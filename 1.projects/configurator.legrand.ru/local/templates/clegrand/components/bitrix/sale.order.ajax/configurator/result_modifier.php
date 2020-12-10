<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main;
$request = Main\Application::getInstance()->getContext()->getRequest();
$arResult['STEP'] = 2;

if ($request->get('ORDER_ID') > 0) {
    $arResult['STEP'] = 4;
    return;
}
if ($request->get('step') == 2) {
    $arResult['STEP'] = 2;
    return;
}

// информация о выбранном магазине
$shopId = null;
if($request->get('shop') > 0){
    $shopId = $request->get('shop');
    $_SESSION['shop'] = $shopId;
}elseif($_SESSION['shop'] > 0){
    $shopId = $_SESSION['shop'];
}
if($shopId > 0){
    $res = \CIBlockElement::GetList([], ['ID' => $shopId], false, false, ['NAME', 'ID', 'IBLOCK_ID']);
    if($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();

        $shopMetroIds = is_array($arProps['CONFIGURATOR_METRO']['VALUE']) ? $arProps['CONFIGURATOR_METRO']['VALUE'] : null;
        $shopMetroNames = [];
        if($shopMetroIds){
            $oMetro = \CIBlockElement::GetList([], ['ID' => $shopMetroIds], false, false, ['NAME', 'ID']);
            while($arMetro = $oMetro->GetNext()){
                $shopMetroNames[] = $arMetro['NAME'];
            }
        }

        $shopInfo = [
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'ADDRESS' => is_array($arProps['ADRESS']['VALUE']) ? $arProps['ADRESS']['VALUE']['TEXT'] : $arProps['ADRESS']['VALUE'],
            'PHONE' => $arProps['PHONE']['VALUE'],
            'SITE' => str_replace(['http://', 'https://', '//'], '', $arProps['SITE']['VALUE']),
            'METRO' => !empty($shopMetroNames) ? implode(', ', $shopMetroNames) : null,
        ];

        if($arProps['CONFIGURATOR_CITY']['PHONE']['VALUE'] > 0){
            $obCity = \CIBlockElement::GetList([], ['ID' => $arProps['CONFIGURATOR_CITY']['PHONE']['VALUE']], false, false, ['NAME']);
            if($resCity = $obCity->GetNext()){
                $shopInfo['CITY'] = $resCity['NAME'];
            }
        }
        $arResult['SHOP'] = $shopInfo;
        $arResult['STEP'] = 3;
    } else{
        $arResult['SHOP'] = null;
    }
}

// поля формы
$arFormFields = ['FIRST_NAME', 'LAST_NAME', 'PHONE', 'EMAIL'];
$arOrderFields = [];
foreach ($arResult['ORDER_PROP']['USER_PROPS_Y'] as $arProp){
    $arOrderFields[$arProp['CODE']] = [
        'ID' => $arProp['ID'],
        'NAME' => $arProp['NAME'],
        'CODE' => $arProp['CODE'],
        'VALUE' => $arProp['VALUE'],
    ];
}
foreach ($arResult['ORDER_PROP']['USER_PROPS_N'] as $arProp){
    $arOrderFields[$arProp['CODE']] = [
        'ID' => $arProp['ID'],
        'NAME' => $arProp['NAME'],
        'CODE' => $arProp['CODE'],
        'VALUE' => $arProp['VALUE'],
    ];
}
global $USER;
if($USER->IsAuthorized()) {
    $rsUser = \CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    $arOrderFields['FIRST_NAME']['VALUE'] = $arUser['NAME'];
    $arOrderFields['LAST_NAME']['VALUE'] = $arUser['LAST_NAME'];
    $arOrderFields['PHONE']['VALUE'] = $arUser['PERSONAL_PHONE'];
    $arOrderFields['EMAIL']['VALUE'] = $arUser['EMAIL'];
}

$arResult['ORDER_TOTAL_PRICE'] = number_format($arResult['ORDER_TOTAL_PRICE'], 2, '.', ' ');
$arResult['FORM_FIELDS'] = $arFormFields;
$arResult['ORDER_FIELDS'] = $arOrderFields;

