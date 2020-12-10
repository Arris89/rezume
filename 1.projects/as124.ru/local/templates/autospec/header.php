<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">


    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,700i" rel="stylesheet">


    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <? use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/libs/jquery.fancybox.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/libs/slick.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/libs/select2.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.css?4");
    ?>

</head>
<body>
<? $APPLICATION->ShowPanel() ?>
<div class="conteiner">

    <!-- header -->

    <? if ($APPLICATION->GetCurPage(false) == '/') { ?>
    <header class="header header_pagehome">

        <? } else { ?>
        <header class="header">
            <? } ?>

            <div class="wrapper">


                <a href="/" class="header__logo">


                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "sect",
                            "AREA_FILE_SUFFIX" => "inc",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "standard.php"
                        )
                    ); ?>
                </a>
                <div class="header__mobile">
                    <a href="tel:+73912729279" class="header__number header__number_icons">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="35" viewBox="0 0 24 35">
                            <g opacity=".2" fill="#fff" transform="translate(-508 -53)">
                                <path id="rov2a"
                                      d="M524.273 75.66c1.975-1.278 4.506-.544 5.611 1.613l1.302 2.508c1.085 2.14.425 4.828-1.507 6.1l-2.274 1.473-.145.082a6.364 6.364 0 0 0-.142.073c-.099.068-.177.126-.292.21-3.328 2.153-10.113-4.793-14.477-13.247-4.316-8.391-5.85-16.4-2.62-18.503l2.865-1.86c1.975-1.254 4.498-.516 5.6 1.635l1.309 2.521c1.08 2.13.417 4.824-1.511 6.071l-2.166 1.959a54.287 54.287 0 0 0 2.33 5.121c.866 1.685 3.106 4.683 4.05 6.132z"/>
                            </g>
                        </svg>
                    </a>
                    <div class="header__burger header__burger--js">
                        <span></span>
                    </div>
                </div>
                <div class="header__menu">
                    <div class="header__menu-close header__menu-close--js"><span></span><span></span></div>
                    <div class="header__row flex flex-align-center">
                        <div class="header__first flex">
                            <div class="header__box">
                                <div class="header__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="35" viewBox="0 0 24 35">
                                        <g opacity=".2" fill="#fff" transform="translate(-508 -53)">
                                            <path id="rov2a"
                                                  d="M524.273 75.66c1.975-1.278 4.506-.544 5.611 1.613l1.302 2.508c1.085 2.14.425 4.828-1.507 6.1l-2.274 1.473-.145.082a6.364 6.364 0 0 0-.142.073c-.099.068-.177.126-.292.21-3.328 2.153-10.113-4.793-14.477-13.247-4.316-8.391-5.85-16.4-2.62-18.503l2.865-1.86c1.975-1.254 4.498-.516 5.6 1.635l1.309 2.521c1.08 2.13.417 4.824-1.511 6.071l-2.166 1.959a54.287 54.287 0 0 0 2.33 5.121c.866 1.685 3.106 4.683 4.05 6.132z"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="header__block">
                                    <a href="tel:+73912729279" class="header__caption header__number">+7 391
                                        27-29-279</a>
                                    <a href="#" class="header__link header__btn btn-callback">заказать звонок</a>
                                </div>
                            </div>
                            <div class="header__box">
                                <div class="header__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="26" height="35" viewBox="0 0 26 35">
                                        <g fill="#fff" opacity=".2" transform="translate(-731 -51)">
                                            <path id="6bs4a"
                                                  d="M738.42 64.318c0-2.954 2.373-5.35 5.3-5.35 2.927 0 5.3 2.396 5.3 5.35 0 2.955-2.373 5.35-5.3 5.35-2.927 0-5.3-2.395-5.3-5.35zm-4.162 8.582l9.35 12.898 9.526-12.846a12.877 12.877 0 0 0 1.457-1.964l.083-.112h-.016a12.87 12.87 0 0 0 1.782-6.558c0-7.09-5.695-12.84-12.72-12.84S731 57.229 731 64.319a12.86 12.86 0 0 0 3.258 8.582z"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="header__block">
                                    <div class="header__caption header__address">Красноярск, Линейная 89, оф. 304</div>
                                    <a href="/contacts/" class="header__link header__location" target="_blank">смотреть
                                        на карте</a>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="menu">

                        <? $APPLICATION->IncludeComponent("bitrix:menu", "top", Array(
                            "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
                            "MAX_LEVEL" => "1",    // Уровень вложенности меню
                            "CHILD_MENU_TYPE" => "top",    // Тип меню для остальных уровней
                            "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                            "DELAY" => "N",    // Откладывать выполнение шаблона меню
                            "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                            "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                            "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                            "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                            "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                            "COMPONENT_TEMPLATE" => ".default"
                        ),
                            false
                        ); ?>


                    </div>
                </div>
            </div>
        </header>
        <!-- header END -->


        <? if ($APPLICATION->GetCurPage(false) !== '/'): ?>
            <!-- page__top -->
            <div class="page__top">
                <div class="wrapper">
                    <div class="breadcrumbs">
                        <ul>
                            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "autospec", Array(
                                "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                                "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                                "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                            ),
                                false
                            ); ?></ul>
                    </div>


                    <h1><? $APPLICATION->ShowTitle() ?></h1>


                </div>
            </div>
            <!-- page__top END -->
        <? endif; ?>





	
