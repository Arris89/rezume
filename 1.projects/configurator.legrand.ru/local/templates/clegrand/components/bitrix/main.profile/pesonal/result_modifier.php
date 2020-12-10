<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// смена логина, если изменен емейл
if($arResult['DATA_SAVED'] === 'Y'){
    global $USER;
    if($USER->GetEmail() !== $USER->GetParam("LOGIN")){
        $user = new \CUser;
        $user->Update(
            $USER->GetID(),
            ['LOGIN' => $USER->GetEmail()]
        );
    }
}



