<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);

$sSeoCanonical = '';
$can_url = '';
$page_can = strripos($_SERVER["REQUEST_URI"], '?PAGEN');
if ($page_can === false) {
} else {
    $canon_url = explode('?PAGEN', $_SERVER["REQUEST_URI"]);
    $can_url = $canon_url[0];
}

if ($can_url != '') {
    $sSeoCanonical = '<link rel="canonical" href="https://style-spb.ru' . $can_url . '"/>';
}
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID; ?>">
<head>
    <meta name="yandex-verification" content="071d97fd301498ef">
    <? $APPLICATION->ShowHead(); ?>
    <?= $sSeoCanonical; ?>
    <title data-http="<?= http_response_code(); ?>"><?
        if ('404' == http_response_code()) {
            echo 'Страница не найдена';
        } else {
            $APPLICATION->ShowTitle();
        }
        ?></title>
    <?
    use Bitrix\Main\Page\Asset;

    ?>

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/global.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/global.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/autoload/highdpi.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/autoload/responsive-tables.css"
          tкорype="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/autoload/uniform.default.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/product_list.css" type="text/css"
          media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockbestsellers/blockbestsellers.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockcart/blockcart.css"
          type="text/css" media="all"/>

    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery-3.5.1.min.js'); ?>

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/js/jquery/plugins/bxslider/jquery.bxslider.css"
          type="text/css" media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockcategories/blockcategories.css"
          type="text/css" media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockcurrencies/blockcurrencies.css"
          type="text/css" media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blocklanguages/blocklanguages.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockcontact/blockcontact.css"
          type="text/css" media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockmyaccountfooter/blockmyaccount.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blocksearch/blocksearch.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/js/jquery/plugins/autocomplete/jquery.autocomplete.css"
          type="text/css" media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockspecials/blockspecials.css" type="text/css"
          media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blocktopmenu/css/blocktopmenu.css"
          type="text/css" media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blocktopmenu/css/superfish-modified.css"
          type="text/css" media="all"/>
    <link rel="stylesheet"
          href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockuserinfo/blockuserinfo.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/blockviewed/blockviewed.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/homeslider/homeslider.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/default-bootstrap/css/modules/homefeatured/homefeatured.css"
          type="text/css" media="all"/>

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/product.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/hooks.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/nivo-slider.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/style.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/sitemap.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/contact-form.css" type="text/css" media="all"/>


    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,600&amp;subset=latin,latin-ext"
          type="text/css" media="all"/>

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/js/global.js" type="text/css" media="all"/>


    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/jquery.autocomplete.css" type="text/css" media="all"/>

    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/product.js"); ?>

    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.autocomplete.js"></script>


    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/js/slick/slick-theme.css" type="text/css" media="all"/>

    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/slick/slick.min.js"></script>
</head>
<body id="index" class="index hide-left-column hide-right-column lang_ru" style="">
<? $APPLICATION->ShowPanel() ?>
<div id="page">
    <div class="header-container">
        <div class="layer_cart_overlay" style="display: none; width: 100%;height: 100%;"></div>
        <header id="header">
            <div class="nav">
                <div class="container hide-mobile">
                    <div class="row d1">
                        <nav>
                            <? if ($USER->IsAuthorized()) {
                                $rsUser = CUser::GetByID($USER);
                                $arUser = $rsUser->Fetch();
                                ?>
                                <div class="header_user_info">
                                    <a href="/personal/" title="Просмотреть мою учетную запись" class="account"
                                       rel="nofollow">
                                        <span><?= $arUser['LOGIN'] ?></span></a>
                                </div>
                                <div class="header_user_info">
                                    <a class="logout" href="/?logout=yes" rel="nofollow" title="Выйти">Выход</a>
                                </div>
                            <? } else { ?>
                                <div class="header_user_info">
                                    <a class="login" href="/authentication/" rel="nofollow"
                                       title="Войти в учетную запись">
                                        Войти
                                    </a>
                                </div>
                            <? } ?>

                            <div id="contact-link">
                                <a href="/contact-us/" title="Свяжитесь с нами">Свяжитесь с нами</a>
                            </div>
                            <span class="shop-phone"></span>
                        </nav>
                    </div>
                </div>
            </div>
            <div>
                <div class="container">
                    <div class="row">
                        <div id="header_logo">

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "incs",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "PATH" => "/include/logo.php"
                                ),
                                false
                            ); ?>

                        </div>
                        <div id="search_block_top" class="col-sm-4 clearfix">

                            <?

                            $APPLICATION->IncludeComponent(
                                "bitrix:search.title",
                                "style",
                                array(
                                    "NUM_CATEGORIES" => "1",
                                    "TOP_COUNT" => "5",
                                    "CHECK_DATES" => "N",
                                    "SHOW_OTHERS" => "N",
                                    "PAGE" => SITE_DIR . "catalog/",
                                    "CATEGORY_0_TITLE" => "Товары",
                                    "CATEGORY_0" => array(
                                        0 => "iblock_catalog",
                                    ),
                                    "CATEGORY_0_iblock_catalog" => array(
                                        0 => "2",
                                    ),
                                    "CATEGORY_OTHERS_TITLE" => "Прочее",
                                    "SHOW_INPUT" => "Y",
                                    "INPUT_ID" => "title-search-input",
                                    "CONTAINER_ID" => "search",
                                    "PRICE_CODE" => array(
                                        0 => "BASE",
                                    ),
                                    "SHOW_PREVIEW" => "Y",
                                    "PREVIEW_WIDTH" => "75",
                                    "PREVIEW_HEIGHT" => "75",
                                    "CONVERT_CURRENCY" => "Y",
                                    "COMPONENT_TEMPLATE" => "bootstrap_v4",
                                    "ORDER" => "date",
                                    "USE_LANGUAGE_GUESS" => "Y",
                                    "TEMPLATE_THEME" => "blue",
                                    "PRICE_VAT_INCLUDE" => "Y",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "CURRENCY_ID" => "RUB"
                                ),
                                false
                            ); ?>

                        </div>
                        <div class="col-sm-4 clearfix header_user_catalog">

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "incs",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "PATH" => "/include/tel.php"
                                ),
                                false
                            ); ?>

                            <div class="shopping_cart" style="padding-top:55px">

                                <?
                                use Bitrix\Sale;

                                Bitrix\Main\Loader::includeModule("sale");
                                Bitrix\Main\Loader::includeModule("catalog");
                                /*получаем свойства для передачи в заказ*/
                                $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

                                foreach ($basket as $basketItem) {

                                    $basketPropertyCollection = $basketItem->getPropertyCollection();
                                    $bas[] = $basketPropertyCollection->getPropertyValues();

                                }

                                if (CModule::IncludeModule("sale")) {
                                    $g = 0;
                                    $dbBasketItems = CSaleBasket::GetList(
                                        array("NAME" => "ASC", "ID" => "ASC"),
                                        array("FUSER_ID" => CSaleBasket::GetBasketUserID(),
                                            "LID" => SITE_ID,
                                            "ORDER_ID" => "NULL",
                                            "DELAY" => "N"),
                                        false,
                                        false,
                                        array());

                                    $cartlist = $dbBasketItems->SelectedRowsCount();

                                } ?>

                                <a href="/personal/cart/" title="Просмотр корзины" rel="nofollow">
                                    <b>Корзина</b>
                                    <span class="ajax_cart_quantity unvisible" style="display: none;">0</span>
                                    <span class="ajax_cart_product_txt unvisible" style="display: none;">Товар</span>
                                    <span class="ajax_cart_product_txt_s unvisible" style="display: none;">Товары</span>
                                    <span class="ajax_cart_total unvisible" style="display: none;">0 руб</span>

                                    <?

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

                                    if ($cartlist > 0) {
                                        ?>
                                        <span class="ajax_cart_no_product"
                                              style="display: inline-block;"><?= $cartlist ?><? echo ' Товар' . ending($cartlist, '', 'а', 'ов'); ?> </span>
                                    <? } else {
                                        ?>
                                        <span class="ajax_cart_no_product" style="display: inline-block;">(пусто)</span>
                                    <? } ?>
                                </a>
                                <div class="cart_block block exclusive">
                                    <div class="block_content">

                                        <!-- block list of products -->
                                        <? if ($cartlist) { ?>
                                            <div class="cart_block_list">
                                                <dl class="products">
                                                    <? while ($arItems = $dbBasketItems->Fetch()) {

                                                        $cart_sum += $arItems['PRICE'] * $arItems['QUANTITY'];

                                                        $res = CIBlockElement::GetProperty(
                                                            2,
                                                            $arItems['PRODUCT_ID'],
                                                            "sort",
                                                            "asc",
                                                            array("CODE" => "COLOR")
                                                        );
                                                        while ($ob = $res->GetNext()) {

                                                            if (CModule::IncludeModule('highloadblock')) {

                                                                $ID = 4;
                                                                $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
                                                                $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                                                                $entity_data_class = $hlentity->getDataClass();

                                                                $result = $entity_data_class::getList(array(
                                                                    "select" => array("UF_NAME", "UF_LINK"),
                                                                    "order" => array(),
                                                                    "filter" => array("UF_XML_ID" => $ob['VALUE']),
                                                                ));

                                                                while ($resds = $result->fetch()) {
                                                                    $itemColor = $resds["UF_NAME"];

                                                                }
                                                            }
                                                        }

                                                        $IDcat = \IbHelp\Helper::getIblockIdByCodes('clothes')["clothes"];

                                                        $arSelect = Array("ID", "IBLOCK_ID", "NAME");
                                                        $arFilter = Array("IBLOCK_ID" => $IDcat, "ID" => $arItems['PRODUCT_ID'], "ACTIVE" => "Y");
                                                        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                                                        while ($ob = $res->GetNextElement()) {
                                                            $arFields = $ob->GetFields();
                                                            $arProps = $ob->GetProperties();

                                                            $rsFile = CFile::GetByID($arProps["MORE_PHOTO"]['VALUE'][0]);
                                                            $arFile = $rsFile->Fetch();
                                                            $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . "";

                                                        } ?>

                                                        <dt class="first_item" it-id="<?= $arItems['ID'] ?>">
                                                            <a class="cart-images"
                                                               href="<?= $arItems['DETAIL_PAGE_URL'] ?>">
                                                                <img src="/<?= $href ?>"
                                                                     alt="<?= $arItems['NAME'] ?>" width="" height="80">
                                                            </a>
                                                        <div class="cart-info">
                                                            <div class="product-name">
                           <span class="quantity-formated">
                            <span class="quantity" style="opacity: 1;">
                            <?= $arItems['QUANTITY'] ?>
                          </span>&nbsp;x&nbsp;</span>
                                                                <a class="cart_block_product_name"
                                                                   href="<?= $arItems['DETAIL_PAGE_URL'] ?>"
                                                                   title="<?= $arItems['NAME'] ?>"><?= $arItems['NAME'] ?></a>
                                                            </div>

                                                            <div class="product-atributes">
                                                                <a href="<?= $arItems['DETAIL_PAGE_URL'] ?>"
                                                                   title="<?= $arItems['NAME'] ?>"><?= $bas[$g]['razmer']['VALUE'] ?>
                                                                    , <?= $itemColor ?>
                                                                    , <?= $bas[$g]['rost']['VALUE'] ?></a>
                                                            </div>

                                                            <span class="price"><?= round($arItems['PRICE']) ?>
                                                                руб</span>
                                                        </div>
                                                        <span class="remove_link" hc-id="<?= $arItems['ID'] ?>">
                            <a class="ajax_cart_block_remove_link" href="javascript:void(0)" rel="nofollow"
                               title="удалить товар из корзины">&nbsp;</a>
                          </span>
                                                        </dt>

                                                        <? $g++;
                                                    } ?>


                                                    <dd data-id="cart_block_combination_of_152_1714_0" class=""
                                                        style="display: block;"></dd>
                                                </dl>
                                                <div class="cart-prices">

                                                    <div class="cart-prices-line last-line">
                                                        <span class="price cart_block_total ajax_block_cart_total"><?= $cart_sum ?>
                                                            руб</span>
                                                        <span>Итого, к оплате:</span>
                                                    </div>

                                                </div>

                                                <p class="cart-buttons">
                                                    <a id="button_order_cart"
                                                       class="btn btn-default button button-small"
                                                       href="/personal/cart/" title="Оформить заказ"
                                                       rel="nofollow">
                                          <span>
                                             Оформить заказ<i class="icon-chevron-right right"></i>
                                          </span>
                                                    </a>
                                                </p>

                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="block_top_menu" class="sf-contener clearfix col-lg-12">

                            <? $APPLICATION->IncludeComponent("bitrix:menu", "mainmenu", Array(
                                    "ROOT_MENU_TYPE" => "top",
                                    "MAX_LEVEL" => "1",
                                    "CHILD_MENU_TYPE" => "top",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "Y",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => ""
                                )
                            ); ?>

                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>


    
