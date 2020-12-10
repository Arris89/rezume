<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Lookbooks");
?>
    <style>
        .slick-slide {
            filter: brightness(40%);
        }

        .slick-active {
            filter: brightness(100%);
        }

    </style>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/list.css" type="text/css"
          media="all"/>
    <div class="columns-container">
        <div id="columns" class="container">

            <div class="breadcrumb clearfix">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "style", Array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "s1"
                    )
                ); ?>
            </div>

            <div id="slider_row" class="row"></div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news",
                        "lookbook",
                        array(
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "SEF_MODE" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "news",
                            "IBLOCK_ID" => "8",
                            "NEWS_COUNT" => "20",
                            "USE_SEARCH" => "N",
                            "USE_RSS" => "N",
                            "USE_RATING" => "N",
                            "USE_CATEGORIES" => "N",
                            "USE_REVIEW" => "N",
                            "USE_FILTER" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
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
                                0 => "ITEMS",
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
                                0 => "ITEMS",
                                1 => "MORE_PHOTO",
                                2 => "",
                            ),
                            "DETAIL_DISPLAY_TOP_PAGER" => "N",
                            "DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
                            "DETAIL_PAGER_TITLE" => "Страница",
                            "DETAIL_PAGER_TEMPLATE" => "",
                            "DETAIL_PAGER_SHOW_ALL" => "N",
                            "STRICT_SECTION_CHECK" => "Y",
                            "SET_TITLE" => "Y",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "ADD_ELEMENT_CHAIN" => "N",
                            "SET_LAST_MODIFIED" => "Y",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "Y",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK" => "",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "USE_PERMISSIONS" => "Y",
                            "GROUP_PERMISSIONS" => array(
                                0 => "1",
                                1 => "2",
                                2 => "3",
                                3 => "4",
                                4 => "5",
                                5 => "6",
                                6 => "7",
                                7 => "8",
                            ),
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "N",
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
                            "SEF_FOLDER" => "/productlookbooks/",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "USE_SHARE" => "Y",
                            "SHARE_HIDE" => "Y",
                            "SHARE_TEMPLATE" => "",
                            "SHARE_HANDLERS" => array(
                                0 => "facebook",
                                1 => "lj",
                                2 => "twitter",
                                3 => "delicious",
                            ),
                            "SHARE_SHORTEN_URL_LOGIN" => "",
                            "SHARE_SHORTEN_URL_KEY" => "",
                            "COMPONENT_TEMPLATE" => "lookbook",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "SEF_URL_TEMPLATES" => array(
                                "news" => "",
                                "section" => "",
                                "detail" => "#ELEMENT_CODE#/",
                            )
                        ),
                        false
                    ); ?>


                </div>
            </div>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>