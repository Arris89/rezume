<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!DOCTYPE html>
<html lang="ru">
<head class="sb-init sb-scroll-lock">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?
    $APPLICATION->SetAdditionalCSS('https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic&subset=latin,cyrillic');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/slick.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/slick-theme.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/font.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/prettyCheckable.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/chkalov_custom.css');
    $APPLICATION->AddHeadScript('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/fonts/ruble/arial/fontface.css');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.sticky.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-ui.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/newmain.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/slick.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.js');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.fancybox.css');

    CJSCore::Init(array('ajax'));

    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/magiczoomplus/magiczoomplus.js');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/magiczoomplus/magiczoomplus.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/fancySelect.css');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/4kalov/fancySelect.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/4kalov/slidebars.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/4kalov/owl/owl.carousel.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/4kalov/jcarousel/jquery.jcarousel.min.js');
    ?>
    <title><? $APPLICATION->ShowTitle() ?></title>


    <? $APPLICATION->ShowHead(); ?>


</head>

<body>
<? $APPLICATION->ShowPanel() ?>


<!--HEADER-->
<header class="header">
    <div class="container">
        <div class="top">
            <div class="btn_mobile-menu sb-toggle-left">

            </div>
            <ul class="reg-box">
                <? if ($USER->IsAuthorized()): ?>
                    <li class="enter"><a href="/personal/profile/" rel="enter" class="">
                            <?= (CUser::GetFirstName()) ? CUser::GetFirstName() : CUser::GetLogin() ?>
                        </a>|
                    </li>
                    <li><a href="<? echo $APPLICATION->GetCurPageParam("logout=yes", array(
                            "login",
                            "logout",
                            "register",
                            "forgot_password",
                            "change_password")); ?>"
                           class="not-visited">Выйти</a></li>
                <? else: ?>
                    <li class="enter"><a href="#" rel="enter" class="not-visited login">Вход</a>|</li>

                    <li><a href="#" rel="signup" class="not-visited" id="signup">Регистрация</a></li>
                <? endif; ?>

                <? if ($_SESSION['city']) {
                    ?>
                    <li class="city">
                        <a href="#" id="buy-in-click-city">
                            <?= $_SESSION['city'] ?>
                        </a>
                    </li>
                    <?
                } else {
                    ?>
                    <li class="city">
                        <a href="#" id="buy-in-click-city">Москва</a>
                    </li>

                <? } ?>


                <li class="help-search">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:search.form",
                        "search",
                        array(
                            "PAGE" => "#SITE_DIR#search/index.php",
                            "USE_SUGGEST" => "N",
                            "COMPONENT_TEMPLATE" => "search"
                        ),
                        false
                    ); ?>

                </li>
            </ul>


            <div class="logo">
                <a href="<?= SITE_DIR ?>">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo.jpg" alt="">
                </a>
            </div>
            <ul class="help-box">


                <li class="favourite">
                    <a href="/personal/favorites/" target="_blank">Избранное:
                        <span class="favhead">



                                        <?php


                                        if ($USER->IsAuthorized()) {
                                            $uid = CUser::GetID();
                                            $rsUser = CUser::GetByID($uid);
                                            $arUser = $rsUser->Fetch();
                                            $headFavold = count($arUser['UF_FAV']);
                                            $headFav = $headFavold - 1;

                                            if ($headFav > 0 && ($arUser['UF_FAV'][1] > 0)) { ?>
                                                <span id="favourite-count" data-count="<?= $headFav; ?>"
                                                      data-user="<?= $uid ?>"><?= $headFav; ?></span>
                                                <?
                                            } else { ?>
                                                <span id="favourite-count" data-count="0"
                                                      data-user="<?= $uid ?>">0</span>
                                            <? }
                                        } else { ?>
                                            <span id="favourite-count" data-count="0">0</span>
                                        <? } ?>


                                    </span>
                    </a>
                </li>


                <li class="basket">
                    <div id="cart" class="cart cart-total" style="display: block; width: auto;"><!--отличие-->
                        <a href="/test/shop/cart/" class="cart-summary">
                            <strong class="cart-total"><span class="ruble"></span></strong>
                        </a>
                        <div id="cart-content">
                        </div>
                        <span>
<?
CModule::IncludeModule("sale");
$cntBasketItems = CSaleBasket::GetList(
    array(),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    ),
    array()
); ?>

                            <a href="/personal/cart/" class="cart-to-checkout">Корзина:<span
                                        class="basQuan"><? echo $cntBasketItems; ?></span></a>

                              </span>
                    </div>
                </li>
                <li class="header-contacts">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "local/include/header_contacts.php"
                        )
                    ); ?>

                </li>
            </ul>
            <div class="clear"></div>
            <div class="shadow-line"></div>


        </div>

        <div class="clear"></div>

        <div class="top-menu-wrap" id="header-container">

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "horizontal_multilevel_top",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "",
                    "COMPONENT_TEMPLATE" => "horizontal_multilevel_top",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "4",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_THEME" => "site",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N"
                ),
                false
            ); ?>

        </div>

</header>

<main class='main'>


    <?
    //раздел каталога
    $bredUrl = $APPLICATION->GetCurPage(false);

    $resBread = strpos($bredUrl, '/catalog/');


    if ($resBread !== false) {

    } else {
        ?>

        <div class="container">
            <?
            $APPLICATION->IncludeComponent("bitrix:breadcrumb", "avia", Array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => "s1"
                )
            );
            ?>

        </div>


    <? } ?>
