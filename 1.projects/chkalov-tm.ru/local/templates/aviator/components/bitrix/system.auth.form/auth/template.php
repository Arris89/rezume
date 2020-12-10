<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
global $USER;

var_dump($user);

if ($USER->IsAuthorized()) {
    die('Y');
}


if (isset($arResult['ERROR_MESSAGE']['MESSAGE']) && strlen($arResult['ERROR_MESSAGE']['MESSAGE']) > 0) {
    die($arResult['ERROR_MESSAGE']['MESSAGE']);
} else {
    die('Ошибка авторизации');
}
