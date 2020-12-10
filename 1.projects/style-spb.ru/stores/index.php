<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Наш магазин");
?>

    <div class="columns-container">
        <div id="columns" class="container">

            <!-- Breadcrumb -->
            <div class="breadcrumb clearfix">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "style", Array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "s1"
                    )
                ); ?>
            </div>
            <!-- /Breadcrumb -->
            <div id="slider_row" class="row"></div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
                    <h1 class="page-heading">
                        Наш магазин
                    </h1>
                    <p class="store-title">
                        <strong class="dark">
                            Информация о расположении наших магазинов:
                        </strong>
                    </p>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="logo">Логотип</th>
                            <th class="name">Название магазина</th>
                            <th class="address">Адрес магазина</th>
                            <th class="store-hours">Часы работы:</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "stores",
                            array(
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "N",
                                "DISPLAY_PREVIEW_TEXT" => "N",
                                "AJAX_MODE" => "N",
                                "IBLOCK_TYPE" => "stores",
                                "IBLOCK_ID" => \IbHelp\Helper::getIblockIdByCodes("stores")["stores"],
                                "NEWS_COUNT" => "20",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_ORDER1" => "DESC",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "",
                                "FIELD_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "PROPERTY_CODE" => array(
                                    0 => "ADRESS",
                                    1 => "TIME",
                                    2 => "LOGO",
                                    3 => "",
                                ),
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "SET_TITLE" => "N",
                                "SET_BROWSER_TITLE" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "PAGER_TITLE" => "Новости",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                "SET_STATUS_404" => "Y",
                                "SHOW_404" => "Y",
                                "MESSAGE_404" => "",
                                "PAGER_BASE_LINK" => "",
                                "PAGER_PARAMS_NAME" => "arrPager",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "COMPONENT_TEMPLATE" => "stores",
                                "STRICT_SECTION_CHECK" => "N",
                                "FILE_404" => ""
                            ),
                            false
                        ); ?>

                        </tbody>
                    </table>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>