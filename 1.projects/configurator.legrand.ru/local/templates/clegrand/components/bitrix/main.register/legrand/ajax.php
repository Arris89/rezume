<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use \Bitrix\Main\Application;

$arReqFields = [
    "NAME",
    "LAST_NAME",
    "EMAIL",
    "PERSONAL_PHONE",
    "PASSWORD",
    "CONFIRM_PASSWORD"
];

$request = Application::getInstance()->getContext()->getRequest();
$arRequest = $request->getPostList()->toArray();

$arSaveFields = [];
foreach ($arReqFields as $field){
    $arSaveFields[$field] = $arRequest[$field];

    if($arRequest[$field] === ''){
        $arError[$field] = 'Заполните поле';
    }
}

if(!$arRequest['agree'] || $arRequest['agree'] !== 'on'){
    $arError['agree'] = 'Заполните поле';
}

// валидация телефона
$phoneFieldName = 'PERSONAL_PHONE';
if(!isset($arError[$phoneFieldName])){
    $phone = preg_replace('/[^0-9]+/', '', $arRequest[$phoneFieldName]);
    if(strlen($phone) !== 11){
        $arError[$phoneFieldName] = 'Неверный формат';
    }
}

// проверка email'а
$emailFieldName = 'EMAIL';
if(!isset($arError[$emailFieldName])){
    $email = trim($arRequest[$emailFieldName]);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $arError[$emailFieldName] = 'Неверный формат';
    }else{
        $rsUsers = \CUser::GetList(($by = "ID"), ($order = "desc"), [ 'EMAIL'=> $email ]);
        if($arUser = $rsUsers->Fetch()) {
            $arError[$emailFieldName] = 'Email уже используется';
        }
    }
}

if(!empty($arError)){
    $arRes = ['errors' => $arError];
    echo json_encode($arRes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
else {
    global $USER;
    $regUserRes = $USER->Register(
        $arSaveFields['EMAIL'], // USER_LOGIN
        $arSaveFields['NAME'], // USER_NAME
        $arSaveFields['LAST_NAME'], // USER_LAST_NAME
        $arSaveFields['PASSWORD'], // USER_PASSWORD
        $arSaveFields['CONFIRM_PASSWORD'], // USER_CONFIRM_PASSWORD
        $arSaveFields['EMAIL'] // USER_EMAIL
    );

    if($regUserRes['TYPE'] === 'OK'){
        $newUserId = $regUserRes['ID'];
        $user = new \CUser;
        $user->Update(
            $newUserId,
            ['PERSONAL_PHONE' => $arSaveFields['PERSONAL_PHONE']]
        );
        $arRes = ['status' => 'ok'];

    }else{
        $arRes['global_errors'] = $arSaveFields['MESSAGE'];
    }

    echo json_encode($arRes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
