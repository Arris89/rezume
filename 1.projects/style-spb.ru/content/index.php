<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
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

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news",
                        "stati",
                        array(
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "SEF_MODE" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "news",
                            "IBLOCK_ID" => \IbHelp\Helper::getIblockIdByCodes("stati")["stati"],
                            "NEWS_COUNT" => "200",
                            "USE_SEARCH" => "N",
                            "USE_RSS" => "N",
                            "USE_RATING" => "N",
                            "USE_CATEGORIES" => "N",
                            "USE_REVIEW" => "N",
                            "USE_FILTER" => "N",
                            "SORT_BY1" => "ID",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "CHECK_DATES" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "LIST_FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "LIST_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "META_KEYWORDS" => "-",
                            "META_DESCRIPTION" => "-",
                            "BROWSER_TITLE" => "-",
                            "DETAIL_SET_CANONICAL_URL" => "Y",
                            "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "DETAIL_FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "DETAIL_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "DETAIL_DISPLAY_TOP_PAGER" => "N",
                            "DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
                            "DETAIL_PAGER_TITLE" => "Страница",
                            "DETAIL_PAGER_TEMPLATE" => "",
                            "DETAIL_PAGER_SHOW_ALL" => "N",
                            "STRICT_SECTION_CHECK" => "Y",
                            "SET_TITLE" => "Y",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "ADD_ELEMENT_CHAIN" => "Y",
                            "SET_LAST_MODIFIED" => "Y",
                            "PAGER_BASE_LINK_ENABLE" => "Y",
                            "SET_STATUS_404" => "Y",
                            "SHOW_404" => "Y",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK" => "",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "USE_PERMISSIONS" => "N",
                            "GROUP_PERMISSIONS" => array(
                                0 => "1",
                            ),
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
                            "FILTER_NAME" => "",
                            "FILTER_FIELD_CODE" => "",
                            "FILTER_PROPERTY_CODE" => "",
                            "NUM_NEWS" => "20",
                            "NUM_DAYS" => "30",
                            "YANDEX" => "Y",
                            "MAX_VOTE" => "5",
                            "VOTE_NAMES" => array(
                                0 => "0",
                                1 => "1",
                                2 => "2",
                                3 => "3",
                                4 => "4",
                            ),
                            "CATEGORY_IBLOCK" => "",
                            "CATEGORY_CODE" => "CATEGORY",
                            "CATEGORY_ITEMS_COUNT" => "5",
                            "MESSAGES_PER_PAGE" => "10",
                            "USE_CAPTCHA" => "Y",
                            "REVIEW_AJAX_POST" => "Y",
                            "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
                            "FORUM_ID" => "1",
                            "URL_TEMPLATES_READ" => "",
                            "SHOW_LINK_TO_FORUM" => "Y",
                            "POST_FIRST_MESSAGE" => "Y",
                            "SEF_FOLDER" => "/content/",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "USE_SHARE" => "N",
                            "SHARE_HIDE" => "Y",
                            "SHARE_TEMPLATE" => "",
                            "SHARE_HANDLERS" => array(
                                0 => "delicious",
                                1 => "facebook",
                                2 => "lj",
                                3 => "twitter",
                            ),
                            "SHARE_SHORTEN_URL_LOGIN" => "",
                            "SHARE_SHORTEN_URL_KEY" => "",
                            "COMPONENT_TEMPLATE" => "stati",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "FILE_404" => "",
                            "SEF_URL_TEMPLATES" => array(
                                "news" => "",
                                "section" => "",
                                "detail" => "#ELEMENT_CODE#/",
                            )
                        ),
                        false
                    ); ?>
                    <br>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>