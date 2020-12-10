<!DOCTYPE html>
<!-- ==============================
    Project:        Metronic "Acidus" Frontend Freebie - Responsive HTML Template Based On Twitter Bootstrap 3.3.4
    Version:        1.0
    Author:         KeenThemes
    Primary use:    Corporate, Business Themes.
    Email:          support@keenthemes.com
    Follow:         http://www.twitter.com/keenthemes
    Like:           http://www.facebook.com/keenthemes
    Website:        http://www.keenthemes.com
    Premium:        Premium Metronic Admin Theme: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
================================== -->
<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <? use Bitrix\Main\Page\Asset; ?>
    <!-- GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet" type="text/css">

    <? Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/vendor/simple-line-icons/simple-line-icons.min.css"); // для скриптов путь через SITE_TEMPLATE_PATH.
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/vendor/bootstrap/css/bootstrap.min.css"); // для скриптов путь через SITE_TEMPLATE_PATH.
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/animate.css"); // для скриптов путь через SITE_TEMPLATE_PATH.
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/vendor/swiper/css/swiper.min.css"); // для скриптов путь через SITE_TEMPLATE_PATH.
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/layout.min.css"); // для скриптов путь через SITE_TEMPLATE_PATH.?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico"/>


</head>
<!-- END HEAD -->

<!-- BODY -->
<body>
<? $APPLICATION->ShowPanel() ?>

<!--========== HEADER ==========-->
<header class="header">
    <!-- Navbar -->
    <nav class="navbar" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>
                <div class="navbar-logo">
                    <a class="navbar-logo-wrap" href="/">
                        <!-- Logo -->
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "sect",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "standard.php"
                            )
                        ); ?>
                    </a>
                </div>
                <!-- End Logo -->


            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-collapse">
                 <div class="menu-container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "test",
                    array(
                        "ROOT_MENU_TYPE" => "top",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "top",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "COMPONENT_TEMPLATE" => "test"
                    ),
                    false
                ); ?>
               </div>
            </div>
            <!-- End Navbar Collapse -->
        </div>
    </nav>
    <!-- Navbar -->
</header>
<!--========== END HEADER ==========-->

       