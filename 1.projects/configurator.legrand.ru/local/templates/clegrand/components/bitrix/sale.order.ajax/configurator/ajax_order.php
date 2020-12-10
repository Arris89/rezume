<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;

$arError = [];
global $USER;
if(check_bitrix_sessid()) {
    Loader::includeModule("sale");
    $request = Application::getInstance()->getContext()->getRequest();
    $arRequest = $request->getPostList()->toArray();

    $rs = \Bitrix\Sale\Property::getList();
    $arProps = [];
    while($r = $rs->fetch())
    {
        $arProps[$r['CODE']] = $r['ID'];
    }

    $arReqFields = ['FIRST_NAME', 'LAST_NAME', 'PHONE', 'EMAIL'];
    $arSendData = [];
    foreach ($arReqFields as $field){
        $key = 'ORDER_PROP_'.$arProps[$field];
        if($arRequest[$key] === ''){
            $arError[$key] = 'Заполните поле';
        }
    }

    if(!$arRequest['agree'] || $arRequest['agree'] !== 'on'){
        $arError['agree'] = 'Заполните поле';
    }

    // валидация телефона
    $phoneFieldName = 'ORDER_PROP_'.$arProps['PHONE'];
    if(!isset($arError[$phoneFieldName])){
        $phone = preg_replace('/[^0-9]+/', '', $arRequest[$phoneFieldName]);
        if(strlen($phone) !== 11){
            $arError[$phoneFieldName] = 'Неверный формат';
        }
    }

    // проверка email'а
    $emailFieldName = 'ORDER_PROP_'.$arProps['EMAIL'];
    $email = trim($arRequest[$emailFieldName]);
    if(!isset($arError[$emailFieldName])
        && ( !$USER->IsAuthorized() || $email !== $USER->GetParam("EMAIL") )
    ){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $arError[$emailFieldName] = 'Неверный формат';
        }else{
            $rsUsers = \CUser::GetList(($by = "ID"), ($order = "desc"), [ 'EMAIL'=> $email ]);
            if($arUser = $rsUsers->Fetch()) {
                $arError[$emailFieldName] = 'Email уже используется';
            }
        }
    }


}else{
    $arError[] = 'session';
}

if(!empty($arError)){
    $arRes = ['errors' => $arError];
    echo json_encode($arRes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
else{
    if(!$USER->IsAuthorized()){
        $USER->SimpleRegister($email);
    }
    $arRequest['soa-action'] = 'saveOrderAjax';
    $request->set($arRequest);

    global $APPLICATION;
    $APPLICATION->IncludeComponent(
        'bitrix:sale.order.ajax',
        '.default',
        Array(
            "ACTION_VARIABLE" => "soa-action",
            "ADDITIONAL_PICT_PROP_19" => "-",
            "ADDITIONAL_PICT_PROP_25" => "-",
            "ALLOW_APPEND_ORDER" => "Y",
            "ALLOW_AUTO_REGISTER" => "Y",
            "BASKET_IMAGES_SCALING" => "adaptive",
            "COMPATIBLE_MODE" => "Y",
            "COUNT_DELIVERY_TAX" => "N",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "DELIVERY_NO_AJAX" => "N",
            "DELIVERY_NO_SESSION" => "Y",
            "DELIVERY_TO_PAYSYSTEM" => "d2p",
            "DISABLE_BASKET_REDIRECT" => "N",
            "EMPTY_BASKET_HINT_PATH" => "/",
            "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
            "PATH_TO_AUTH" => "/auth/",
            "PATH_TO_BASKET" => "/personal/cart/",
            "PATH_TO_PAYMENT" => "/personal/order/payment/",
            "PATH_TO_PERSONAL" => "/personal/order/",
            "PAY_FROM_ACCOUNT" => "N",
            "PRODUCT_COLUMNS_VISIBLE" => array("PROPS"),
            "SEND_NEW_USER_NOTIFY" => "Y",
            "SET_TITLE" => "Y",
            "SHOW_NOT_CALCULATED_DELIVERIES" => "N",
            "SHOW_VAT_PRICE" => "N",
            "SPOT_LOCATION_BY_GEOIP" => "N",
            "TEMPLATE_LOCATION" => "popup",
            "USER_CONSENT" => "N",
            "USER_CONSENT_ID" => "0",
            "USER_CONSENT_IS_CHECKED" => "Y",
            "USER_CONSENT_IS_LOADED" => "N",
            "USE_PHONE_NORMALIZATION" => "Y",
            "USE_PRELOAD" => "Y",
            "USE_PREPAYMENT" => "N"
        )
    );
}
