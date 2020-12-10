<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Service\GeoIp,
    \Bitrix\Main\Application,
    \Bitrix\Main\Web\Cookie;

// город пользователя
$userCityCookie = Application::getInstance()->getContext()->getRequest()->getCookieRaw("4PX_USER_CITY");

if(!$userCityCookie){
    $ipAddress = GeoIp\Manager::getRealIp();
    $geoObj = GeoIp\Manager::getDataResult($ipAddress, "ru", ['cityName', 'countryName', 'regionName']);
    if($geoObj){
        $geoObj = $geoObj->getGeoData();
        $geoData = [$geoObj->regionName, $geoObj->cityName];
    }else{
        $geoData = [];
    }
}

// город пользователя из ИБ
$cityIbId = \FourPx\Helper::getIblockIdByCodes("CITY")["CITY"];
$arFilter = ['IBLOCK_ID' => $cityIbId];

$arFilter['=NAME'] = !empty($userCityCookie) ? [$userCityCookie] : $geoData;

$defaultCityName = 'москва и московская область';
$arFilter['=NAME'][] = $defaultCityName;

$ob = \CIBlockElement::GetList([], $arFilter, false, false, ['NAME', 'ID']);
$arCity = [];
$arDefaultCity = [];
while($res = $ob->GetNext()){
    $arr = [
        'ID' => $res['ID'],
        'NAME' => $res['NAME'],
        'LOWER' => mb_strtolower($res['NAME']),
    ];
    if(mb_strtolower($res['NAME']) === $defaultCityName){
        $arDefaultCity = $arr;
    }else{
        $arCity[] = $arr;
    }
}

$arCity = !empty($arCity) ? $arCity[0] : $arDefaultCity;

if(!$userCityCookie || $arCity['NAME'] !== $userCityCookie){
    $cookie = new Cookie("4PX_USER_CITY", $arCity['NAME'], time() + 60*60*24*30, false);
    $cookie->setHttpOnly(false);
    Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
}

// id ИБ "Магазины"
$arResult['IBLOCK_SHOPS_ID'] = \FourPx\Helper::getIblockIdByCodes("WHERE")["WHERE"];

$arFilter = [];
if(!$_REQUEST['set_filter']) {
    $arFilter['PROPERTY_CONFIGURATOR_CITY'] = $arCity['ID'];
}
$request = Application::getInstance()->getContext()->getRequest();
if($request->getQuery('FILTER_NAME')){
    $arFilter['%NAME'] = $_REQUEST['FILTER_NAME'];
}


$arResult['CUR_CITY'] = $arCity;
$arResult['FILTER'] = $arFilter;
