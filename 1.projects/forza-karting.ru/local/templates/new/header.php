<?php use Bitrix\Main\Page\Asset; ?>
<!DOCTYPE html>
<html class="page-index" lang="ru">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">

    <title><?php $APPLICATION->ShowTitle() ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>


    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
            var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);

        })(window, document, 'script', 'dataLayer', 'GTM-P2KP52T');
    </script>
    <!-- End Google Tag Manager -->
    <script type="text/javascript">
        var site_template_path = "<?= SITE_TEMPLATE_PATH ?>";
    </script>


    <?php $APPLICATION->ShowHead(); ?>
    <?php $APPLICATION->ShowPanel() ?>

    <?php IncludeTemplateLangFile(__FILE__); ?>

    <?php
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery-2.2.4.min.js');

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/modal.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/indexEngine.js");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/fonts.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/form/form.css"); ?>

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/main.css?v=1566200325959">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/fix.css?v=1556615604865">
    <?php if (false !== strpos($_SERVER['REQUEST_URI'], '/carting/')) { ?>
        <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/carting.css?v=1553170880442">
    <?php } ?>
    <?php if (false !== strpos($_SERVER['REQUEST_URI'], '/lasertag/')
        || false !== strpos($_SERVER['REQUEST_URI'], '/activity/')
        || false !== strpos($_SERVER['REQUEST_URI'], '/restaurant/')
        || false !== strpos($_SERVER['REQUEST_URI'], '/child/')
        || false !== strpos($_SERVER['REQUEST_URI'], '/feast/')
        || false !== strpos($_SERVER['REQUEST_URI'], '/holiday/')
        || false !== strpos($_SERVER['REQUEST_URI'], '/party/')
        || false !== strpos($_SERVER['REQUEST_URI'], '/presentations/')
        || false !== strpos($_SERVER['REQUEST_URI'], '/gallery_')
        || false !== strpos($_SERVER['REQUEST_URI'], '/children/')
    ) { ?>
        <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/additional.css?v=1553170880442">
        <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/main.css">
        <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/main.css?v=1565178888539">

    <?php } ?>
    <script>
        if (window.location.hash) {
            var hash = window.location.hash;
            window.location.hash = '';
        }
    </script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P2KP52T"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<noscript>
    <div class="noscript">
        <div class="container"><strong>Возможно, JavaScript отключен в вашем браузере.</strong><br> Для полноценного
            использования функций этого веб-сайта в вашем браузере должен быть включен JavaScript.
        </div>
    </div>
</noscript>
<div class="all-wrap">
    <div class="main-wrap">
        <header class="header js-fixed-header">
            <? if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/carting/') { ?>
                <div class="header__top">
                    <div class="container">
                        <div class="header__top-inner js-header-top"><a href="/aviapark/">>> Перейти в "Картинг-центр
                                АВИАПАРК Forza на Ходынке"</a>
                        </div>
                    </div>
                </div>
            <? } ?>

            <div class="header__base">
                <div class="container">
                    <div class="header__inner">
                        <div class="header__column">
                            <div class="header-menu js-header-menu">
                                <ul>
                                    <li<?= (false !== strpos(
                                            $_SERVER['REQUEST_URI'],
                                            '/carting/'
                                        )) ? ' class="is-active"' : '' ?>><a href="/carting/">Картинг</a></li>
                                    <li<?= (false !== strpos(
                                            $_SERVER['REQUEST_URI'],
                                            '/lasertag/'
                                        )) ? ' class="is-active"' : '' ?>><a href="/lasertag/">Лазертаг</a></li>
                                    <li<?= (false !== strpos(
                                            $_SERVER['REQUEST_URI'],
                                            '/restaurant/'
                                        )) ? ' class="is-active"' : '' ?>><a href="/restaurant/">Ресторан</a></li>
                                </ul>
                            </div>
                        </div>
                        <a class="header__logo" href="/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/new_logo.svg" alt="FORZA MIKS. Дубровка">
                        </a>
                        <div class="header__hamburger">
                            <button class="header-hamburger js-header-hamburger" type="button">
                                <span></span><span></span><span></span></button>
                        </div>
                        <div class="header__column">
                            <div class="header-menu js-header-menu">
                                <ul>
                                    <li<?= (false !== strpos(
                                            $_SERVER['REQUEST_URI'],
                                            '/activity/'
                                        )) ? ' class="is-active"' : '' ?>><a href="/activity/">Праздники</a></li>
                                    <li<?= (false !== strpos(
                                            $_SERVER['REQUEST_URI'],
                                            '/children/'
                                        )) ? ' class="is-active"' : '' ?>><a href="/children/">Школа&nbsp;картинга</a>
                                    </li>
                                    <li><a href="/preparation/">Соревнования</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__bottom">
                <div class="container">
                    <div class="header-small-menu js-header-small-menu">
                        <ul>
                            <li<?= (false !== strpos(
                                    $_SERVER['REQUEST_URI'],
                                    '/partners/'
                                )) ? ' class="is-active"' : '' ?>><a href="/partners/">Партнеры</a></li>
                            <li<?= (false !== strpos(
                                    $_SERVER['REQUEST_URI'],
                                    '/massmedia/'
                                )) ? ' class="is-active"' : '' ?>><a href="/massmedia/">СМИ о нас</a></li>
                            <li<?= (false !== strpos(
                                    $_SERVER['REQUEST_URI'],
                                    '/news/'
                                )) ? ' class="is-active"' : '' ?>><a href="/news/">Новости</a></li>
                            <?php if (false !== strpos($_SERVER['REQUEST_URI'], '/carting/') ||
                                false !== strpos($_SERVER['REQUEST_URI'], '/lasertag/') ||
                                false !== strpos($_SERVER['REQUEST_URI'], '/restaurant/') ||
                                false !== strpos($_SERVER['REQUEST_URI'], '/children/') ||
                                false !== strpos($_SERVER['REQUEST_URI'], '/child/') ||
                                false !== strpos($_SERVER['REQUEST_URI'], '/activity/')
                            ) { ?>
                                <li><a href="/#contacts">Контакты</a></li>
                            <?php } else { ?>
                                <li><a href="#contacts">Контакты</a></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <?php if (false !== strpos($_SERVER['REQUEST_URI'], '/carting/')) { ?>
        <div class="content-wrap content-carting">
            <?php } else { ?>
            <div class="content-wrap">
                <?php } ?>
