<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta meta="meta" http-equiv="Content-Language" content="ru"/>
    <meta content="" name="description"/>
    <meta content="" name="keywords"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1.0; user-scalable=false;"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta name="HandheldFriendly" content="true"/>
    <?
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/module/normalize/normalize.min.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/module/magnific-popup/magnific-popup.min.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/module/slick/slick.min.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/module/simplebar/simplebar.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/module/selectric/selectric.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/module/iziToast/iziToast.min.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.css');
    ?>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png"/>
    <link rel="manifest" href="./favicon/site.webmanifest"/>
    <link rel="mask-icon" href="./favicon/safari-pinned-tab.svg" color="#5bbad5"/>
    <meta name="msapplication-TileColor" content="#da532c"/>
    <meta name="theme-color" content="#ffffff"/>
    <script>(function (H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)</script>
    <? $APPLICATION->ShowHead(); ?>
</head>
<body class="page">

<? $APPLICATION->ShowPanel() ?>
<!--[if lte IE 9]>
<div class="browserupgrade">
    <p class="browserupgrade__inner">Вы используете <strong>устаревший</strong> браузер. Пожалуйста, <a
            style="text-decoration: underline;" href="http://browsehappy.com/">обновите его</a>, чтобы просмотреть сайт
    </p>
</div><![endif]-->

<div class="mobile-menu js-menu">
    <div class="mobile-menu__container">
        <ul class="mob-mainmenu">
            <li class="mob-mainmenu__item">
                <a class="mob-mainmenu__link"
                   href="/collections/"
                >
                    коллекции продукции
                    <span class="mob-mainmenu__arrow">
                        <svg class="icon icon_angle-right">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#angle-right"></use>
                        </svg>
                    </span>
                </a>
            </li>

            <li class="mob-mainmenu__item">
                <a class="mob-mainmenu__link"
                   href="/configurator/"
                >
                    создать проект
                    <span class="mob-mainmenu__arrow">
                        <svg class="icon icon_angle-right">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#angle-right"></use>
                        </svg>
                    </span>
                </a>
            </li>

            <li class="mob-mainmenu__item">
                <a class="mob-mainmenu__link"
                   href="/receiving-order/"
                >
                    магазины партнеров
                    <span class="mob-mainmenu__arrow">
                        <svg class="icon icon_angle-right">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#angle-right"></use>
                        </svg>
                    </span>
                </a>
            </li>

            <li class="mob-mainmenu__item">
                <a class="mob-mainmenu__link"
                   href="/specification/"
                >
                    собрать спецификацию
                    <span class="mob-mainmenu__arrow">
                        <svg class="icon icon_angle-right">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#angle-right"></use>
                        </svg>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>

<noscript class="noscript">
    <div class="noscript__wrap">
        <p class="noscript__text">Пожалуйста, включите JavaScript</p>
    </div>
</noscript>
<header class="section-header page__header">
    <div class="section-header__top">
        <div class="section-header__basket">
            <a href="/personal/cart/">
                <div class="header-basket">
                    <div class="header-basket__left">
                        <svg class="icon icon_shopping-cart">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#shopping-cart"></use>
                        </svg>
                    </div>
                    <div class="header-basket__right">
                        <div class="header-basket__title">корзина
                        </div>
                        <?
                        if (CModule::IncludeModule("sale"))
                        {

                        $IDcat = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];

                        if (!$USER->IsAuthorized()) {

                            $dbBasketItems = CSaleBasket::GetList(
                                array("NAME" => "ASC", "ID" => "ASC"),
                                array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
                                    "LID" => SITE_ID,
                                    "ORDER_ID" => "NULL",
                                    "DELAY" => "N"),
                                false,
                                false,
                                array());
                        } else {

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
                        }


                        while ($arItems = $dbBasketItems->Fetch()) {

                            $res = CIBlockElement::GetByID($arItems['PRODUCT_ID']);
                            if ($ar_res = $res->GetNext())

                                $res1 = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);
                            if ($ar_res1 = $res1->GetNext())

                                if ($ar_res1['CODE'] == 'FUNCTION') {

                                    $cart_num += $arItems['QUANTITY'];

                                    $db_props = CIBlockElement::GetProperty($IDcat, $arItems['PRODUCT_ID'], array(), Array("CODE" => "PACKAGE_ARTICUL"));

                                    while ($ar_props = $db_props->GetNext()) {
                                        $xmlID = $ar_props["VALUE"];

                                        if (!empty($xmlID)) {

                                            $arSelect3 = Array("ID", "IBLOCK_ID", "NAME", "CATALOG_GROUP_1", "ACTIVE");
                                            $arFilter3 = Array(
                                                "IBLOCK_ID" => $IDcat,
                                                "PROPERTY_XML_ID" => $xmlID,
                                                "SECTION_CODE" => Array('ACCESSORY', 'MECHANISM', 'FUNCTION'),
                                                "ACTIVE_DATE" => "Y",
                                                "ACTIVE" => "Y");
                                            $res = CIBlockElement::GetList(Array(), $arFilter3, false, Array(), $arSelect3);
                                            while ($ob = $res->GetNextElement()) {

                                                $arFields = $ob->GetFields();
                                                $cart_sum += $arFields['CATALOG_PRICE_1'] * $arItems['QUANTITY'];

                                            }

                                        }
                                    }


                                }

                            if ($ar_res1['CODE'] == 'FRAME') {

                                $cart_num += $arItems['QUANTITY'];
                                $cart_sum += $arItems['PRICE'] * $arItems['QUANTITY'];
                            }


                        }


                        if (empty($cart_num))
                            $cart_num = "0";
                        if (empty($cart_sum))
                            $cart_sum = "0";

                        ?>

                        <div class="header-basket__value"><?= $cart_num ?> товара
                            / <?= number_format($cart_sum, 2, '.', ' ') ?> руб.
                            <?
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="section-header__container container">
            <div class="header">
                <div class="header__logo">


                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "incs",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "PATH" => "/include/header-logo.php"
                        ),
                        false
                    ); ?>

                </div>
                <div class="header__right">
                    <div class="header__city header__elem">
                    </div>
                    <div class="header__elems">
                        <?
                        if (!$USER->IsAuthorized()) {
                            $dbBasketItems = CSaleBasket::GetList(
                                array("NAME" => "ASC", "ID" => "ASC"),
                                array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
                                    "LID" => SITE_ID,
                                    "ORDER_ID" => "NULL",
                                    "DELAY" => "Y"),
                                false,
                                false,
                                array()
                            );
                            $list = $dbBasketItems->SelectedRowsCount();
                        } else {
                            $user = $USER->GetID();
                            $dbBasketItems = CSaleBasket::GetList(
                                array(),
                                array(
                                    "USER_ID" => $user,
                                    "LID" => SITE_ID,
                                    "DELAY" => "Y",
                                    "ORDER_ID" => null
                                ),
                                false,
                                false,
                                array()
                            );
                            $list = $dbBasketItems->SelectedRowsCount();
                        }

                        ?>
                        <div class="header__goods header__elem">
                            <? if ($list > 0)
                            {
                            ?>
                            <a class="icon-text active icon-text_hover" href="/deferred/" id="def">
                                <?
                                }
                                else
                                {
                                ?>
                                <a class="icon-text icon-text_hover" href="/deferred/" id="def">
                                    <? } ?>
                                    <span class="icon-text__icon">
                          <svg class="icon icon_star">
                           <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#heart"></use>
                          </svg></span>
                                    <span class="icon-text__text">Избранное</span></a>
                        </div>
                        <div class="header__review header__elem"><a
                                    class="icon-text icon-text_hover popup-with-move-anim" href="#popup-review"><span
                                        class="icon-text__icon">
                  <svg class="icon icon_envelope">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#envelope"></use>
                  </svg></span><span class="icon-text__text">Оставить отзыв</span></a>
                        </div>
                    </div>


                    <? if ($USER->IsAuthorized()) { ?>
                        <div class="header__logged">
                            <div class="header__cabinet">
                                <a href="/personal/order/">Кабинет</a>
                            </div>
                            <div class="header__logout">
                                <a href="<? echo $APPLICATION->GetCurPageParam("logout=yes", array(
                                    "login",
                                    "logout",
                                    "register",
                                    "forgot_password",
                                    "change_password")); ?>">Выйти</a>
                            </div>
                        </div>
                    <?
                    } else { ?>
                        <div class="header__enter header__elem">
                            <a class="icon-text icon-text_hover popup-with-move-anim" href="#popup-enter">
              <span class="icon-text__icon">
                <svg class="icon icon_businessman">
                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#businessman"></use>
                </svg></span><span class="icon-text__text">Вход</span></a>
                        </div>
                        <div class="header__register"><a class="popup-with-move-anim"
                                                         href="#popup-register">Регистрация</a>
                        </div>
                    <? } ?>

                </div>
                <div class="header__mobile">
                    <div class="header-mobile"><a class="header-mobile__search" href="/specification.html"><i
                                    class="fa fa-search"></i></a>
                        <div class="header-mobile__menu">
                            <div class="hamburger js-slide-menu">
                                <div class="hamburger__line hamburger__line_1">
                                </div>
                                <div class="hamburger__line hamburger__line_2">
                                </div>
                                <div class="hamburger__line hamburger__line_3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-header__cities">
                <div class="header-cities">
                    <div class="header-cities__wrap" data-simplebar="data-simplebar" data-simplebar-auto-hide="false">
                        <ul class="header-cities__list">
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абакан</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Аксай</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абаза</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актау</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актобе</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Александров</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алексин</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алматы</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Альметьевск</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абакан</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Аксай</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абаза</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актау</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актобе</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Александров</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алексин</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алматы</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Альметьевск</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абакан</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Аксай</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абаза</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актау</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актобе</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Александров</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алексин</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алматы</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Альметьевск</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абакан</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Аксай</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абаза</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актау</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актобе</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Александров</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алексин</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алматы</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Альметьевск</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абакан</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Аксай</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абаза</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актау</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актобе</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Александров</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алексин</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алматы</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Альметьевск</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абакан</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Аксай</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Абаза</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актау</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Актобе</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Александров</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алексин</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city"
                                                               href="#">Алматы</a>
                            </li>
                            <li class="header-cities__item"><a class="header-cities__link js-pick-city" href="#">Альметьевск</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-header__bottom">
        <div class="section-header__container container">
            <nav class="nav">


                <? $APPLICATION->IncludeComponent("bitrix:menu", "main", Array(
                    "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
                    "MAX_LEVEL" => "1",    // Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "top",    // Тип меню для остальных уровней
                    "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "DELAY" => "N",    // Откладывать выполнение шаблона меню
                    "ALLOW_MULTI_SELECT" => "Y",    // Разрешить несколько активных пунктов одновременно
                    "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                    "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                    "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                    "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                ),
                    false
                ); ?>


                <div class="nav__item nav__item_basket"><a href="/personal/cart/">
                        <div class="header-basket">
                            <div class="header-basket__left">
                                <svg class="icon icon_shopping-cart">
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#shopping-cart"></use>
                                </svg>
                            </div>
                            <div class="header-basket__right">
                                <div class="header-basket__title">
                                    корзина
                                </div>

                                <div class="header-basket__value"><?

                                    function ending($number, $one, $two, $five)
                                    {
                                        $number = $number % 100;

                                        if (($number > 4 && $number < 21) || $number == 0) {
                                            $ending = $five;
                                        } else {
                                            $last_digit = substr($number, -1);

                                            if ($last_digit > 1 && $last_digit < 5)
                                                $ending = $two;
                                            elseif ($last_digit == 1)
                                                $ending = $one;
                                            else
                                                $ending = $five;
                                        }

                                        return $ending;
                                    }

                                    echo $cart_num . ' товар' . ending($cart_num, '', 'а', 'ов');

                                    ?> / <?= number_format($cart_sum, 2, '.', ' ') ?> руб.


                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </nav>
        </div>
    </div>
    <div class="section-header__crumbs">
        <div class="section-header__container container">
            <div class="crumbs"><a href="#">Главная</a><span>//</span><a href="/configurator.html">Конфигуратор</a>
            </div>
        </div>
    </div>
</header>
<main class="page__wrapper">







    
