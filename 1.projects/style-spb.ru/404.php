<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->SetPageProperty("description", 'Ошибка 404 – страница не найдена');
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/404.css");

$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");

?>

    <div class="columns-container">
        <div id="columns" class="container">
            <div id="slider_row" class="row">
            </div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
                    <div class="pagenotfound">
                        <h1>Страница не найдена</h1>
                        <p>
                            Извините, запрошеной вами страницы не существует
                        </p>
                        <div class="h3">Для поиска товара введите его наименование в следующее поле</div>
                        

<?$APPLICATION->IncludeComponent("bitrix:search.title","404",Array(
        "SHOW_INPUT" => "Y",
        "INPUT_ID" => "title-search-input",
        "CONTAINER_ID" => "title-search",
        "PRICE_CODE" => array("BASE","RETAIL"),
        "PRICE_VAT_INCLUDE" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "150",
        "SHOW_PREVIEW" => "Y",
        "PREVIEW_WIDTH" => "75",
        "PREVIEW_HEIGHT" => "75",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "PAGE" => "#SITE_DIR#search/index.php",
        "NUM_CATEGORIES" => "3",
        "TOP_COUNT" => "10",
        "ORDER" => "date",
        "USE_LANGUAGE_GUESS" => "Y",
        "CHECK_DATES" => "Y",
        "SHOW_OTHERS" => "Y",
        "CATEGORY_0_TITLE" => "Новости",
        "CATEGORY_0" => array("iblock_news"),
        "CATEGORY_0_iblock_news" => array("all"),
        "CATEGORY_1_TITLE" => "Форумы",
        "CATEGORY_1" => array("forum"),
        "CATEGORY_1_forum" => array("all"),
        "CATEGORY_2_TITLE" => "Каталоги",
        "CATEGORY_2" => array("iblock_books"),
        "CATEGORY_2_iblock_books" => "all",
        "CATEGORY_OTHERS_TITLE" => "Прочее"
    )
);?>

                        <div class="buttons"><a class="btn btn-default button button-medium" href="/" title="Главная"><span><i class="icon-chevron-left left"></i>Главная</span></a></div>
                    </div>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>