<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Страница не найдена"); ?>


    <div class="about-us error-page">
        <div class="container">
            <div class="title"><h2>404</h2></div>
            <div class="tabs-content" id="page" role="main" itemprop="description">
                Product not found<br>
                Запрошенный ресурс недоступен.
                <div class="img-error"><img src="<?= SITE_TEMPLATE_PATH ?>/images/404.jpg" alt=""></div>
                <a href="/catalog/" class="continue"><span>Вернуться в каталог</span></a>
            </div>
        </div>
    </div>

    <div class="clear-both"></div>


    <div class="clear-both"></div>

    <div id="dialog" class="dialog">
        <div class="dialog-background"></div>
        <div class="dialog-window">

            <div class="cart">

            </div>


        </div>
    </div>

    <aside id="compare-leash">

    </aside>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>