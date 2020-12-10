<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use \Bitrix\Main\Application;

CModule::IncludeModule('sale');

if(check_bitrix_sessid()) {

  $dbBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "DELAY" => "N",
            "ORDER_ID" => null
        ),
        false,
        false,
        array()
    );

      while ($arItems = $dbBasketItems->Fetch()){
        $arBasketItems[] = $arItems['ID'];
}

    $request = Application::getInstance()->getContext()->getRequest();
    $arRequest = $request->getPostList()->toArray();
    $result['$arRequest'] = $arRequest;
    global $USER;
    $res = $USER->Login(strip_tags($arRequest['LOGIN']), strip_tags($arRequest['PASSWORD']), 'Y');
    if(empty($res['MESSAGE'])){
        $result['status'] = 'ok';

$user = $USER->GetID();
  $dbBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "USER_ID" => $user,
            "LID" => SITE_ID,
            "DELAY" => "N",
            "ORDER_ID" => null
        ),
        false,
        false,
        array()
    );


      while ($arItems = $dbBasketItems->Fetch()){
        if(!in_array($arItems['ID'], $arBasketItems)){
            CSaleBasket::Delete($arItems['ID']);
        }
}


    }
    else {
        $result['msg'] = $res['MESSAGE'];
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
