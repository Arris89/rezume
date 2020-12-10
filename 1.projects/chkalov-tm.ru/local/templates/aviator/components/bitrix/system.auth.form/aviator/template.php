<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();

?>

<? if ($USER->IsAuthorized()): ?>
    <li class="enter"><a href="#" rel="enter" class="not-visited login">
            <?= (CUser::GetFullName()) ? CUser::GetFullName() : CUser::GetLogin() ?>
        </a></li>
<? else: ?>
    <li class="enter"><a href="#" rel="enter" class="not-visited login">Вход</a>|</li>
    <li><a href="#" class="not-visited" id="signup">Регистрация</a></li>
<? endif; ?>


<? if ($arResult["FORM_TYPE"] == "login"): ?>
    <li class="enter"><a href="#" rel="enter" class="not-visited login">Вход</a>|</li>
    <li><a href="#" class="not-visited" id="signup">Регистрация</a></li>


<? elseif ($arResult["FORM_TYPE"] == "logout"): ?>

<? endif; ?>