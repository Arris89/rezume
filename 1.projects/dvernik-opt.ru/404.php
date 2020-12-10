<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found"); ?>

    <section class="not-found">
        <div class="not-found__wrapper"><p class="not-found__decor"><span>4</span><span>0</span><span>4</span></p>
            <h1 class="not-found__title title title_h1">Страница не найдена...</h1>
            <p class="not-found__text">Вы находитесь здесь, потому что запрашиваемая страница не существует или была
                перемещена по другому адресу.</p>
            <div class="not-found__links">
                <a class="not-found__link not-found__link_main btn" href="/">На главную</a>
                <a class="not-found__link not-found__link_catalog" href="/catalog/">В каталог</a>
            </div>
        </div>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>