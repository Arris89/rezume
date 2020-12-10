<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Каталог книг");
?>

<? if ($APPLICATION->GetCurPage(false) == '/'): ?>


    <!-- promo -->
    <section class="promo">
        <div class="wrapper">
            <div class="promo__inner">


                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "slider",
                    array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "slider",
                        "IBLOCK_ID" => "26",
                        "NEWS_COUNT" => "2",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(
                            0 => "NAME",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
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
                        "CACHE_GROUPS" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => "",
                        "PAGER_BASE_LINK" => "",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "COMPONENT_TEMPLATE" => "slider",
                        "STRICT_SECTION_CHECK" => "N",
                        "FILE_404" => ""
                    ),
                    false
                ); ?>

            </div>
        </div>
    </section>
    <!-- promo END -->


<? endif; ?>


    <!-- maincatalog -->
    <section class="maincatalog fadeInUp-scroll">
        <div class="wrapper">
            <? if ($APPLICATION->GetCurPage(false) == '/'): ?>

                <h2>Аренда</h2>
            <? endif; ?>

            <div class="maincatalog__row">


                <? if ($APPLICATION->GetCurPage(false) == '/'): ?>

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news",
                        "main",
                        array(
                            "ADD_ELEMENT_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BROWSER_TITLE" => "-",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "N",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                            "DETAIL_DISPLAY_TOP_PAGER" => "N",
                            "DETAIL_FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "DETAIL_PAGER_SHOW_ALL" => "N",
                            "DETAIL_PAGER_TEMPLATE" => "",
                            "DETAIL_PAGER_TITLE" => "Страница",
                            "DETAIL_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "DETAIL_SET_CANONICAL_URL" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "32",
                            "IBLOCK_TYPE" => "specrazdels",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "LIST_FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "LIST_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "MESSAGE_404" => "",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "NEWS_COUNT" => "20",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "SEF_MODE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N",
                            "USE_CATEGORIES" => "N",
                            "USE_FILTER" => "N",
                            "USE_PERMISSIONS" => "N",
                            "USE_RATING" => "N",
                            "USE_REVIEW" => "N",
                            "USE_RSS" => "N",
                            "USE_SEARCH" => "N",
                            "USE_SHARE" => "N",
                            "COMPONENT_TEMPLATE" => "main",
                            "VARIABLE_ALIASES" => array(
                                "SECTION_ID" => "SECTION_ID",
                                "ELEMENT_ID" => "ELEMENT_ID",
                            )
                        ),
                        false
                    ); ?>
                <? endif; ?>

            </div>
        </div>
    </section>
    <!-- maincatalog END -->


<? if ($APPLICATION->GetCurPage(false) == '/'): ?>

    <!-- mainblock -->
    <section class="mainblock fadeInUp-scroll">
        <div class="wrapper">
            <div class="mainblock__row">

                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "advantage",
                    array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "advantages",
                        "IBLOCK_ID" => "23",
                        "NEWS_COUNT" => "5",
                        "SORT_BY1" => "ID",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "ICON",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "Y",
                        "SET_BROWSER_TITLE" => "Y",
                        "SET_META_KEYWORDS" => "Y",
                        "SET_META_DESCRIPTION" => "Y",
                        "SET_LAST_MODIFIED" => "Y",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
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
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => "",
                        "PAGER_BASE_LINK" => "",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "COMPONENT_TEMPLATE" => "advantage",
                        "STRICT_SECTION_CHECK" => "N",
                        "FILE_404" => ""
                    ),
                    false
                ); ?>

            </div>

        </div>
    </section>
    <!-- mainblock END -->


    <!-- maintrucks -->
    <section class="maintrucks fadeInUp-scroll">
        <div class="wrapper">
            <h2 class="maintrucks__title">
                <span>Грузоперевозки</span>
                <span class="maintrucks__icons">
						<svg width="43px" height="18px" viewBox="0 0 43 18" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
						    <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                               opacity="0.317354911">
						        <g id="1920-/-шапка" transform="translate(-397.000000, -152.000000)" fill="#243762"
                                   fill-rule="nonzero">
						            <path d="M434.684082,165.649512 C435.798328,165.649512 436.745437,166.540909 436.745437,167.710867 C436.745437,168.825113 435.798328,169.772222 434.684082,169.772222 C433.569836,169.772222 432.622727,168.825113 432.622727,167.710867 C432.622727,166.596621 433.569836,165.649512 434.684082,165.649512 Z M439.141066,166.485197 L439.141066,168.156566 L437.588888,168.156566 C437.588888,167.599443 437.588888,167.76658 437.588888,167.655155 C437.588888,167.265169 437.829515,166.485197 437.421751,166.485197 L439.141066,166.485197 Z M397,152 L422.148816,152 L422.148816,163.811007 L397,163.811007 L397,152 Z M419.084639,165.649512 C420.254598,165.649512 421.145994,166.540909 421.145994,167.710867 C421.145994,168.825113 420.198885,169.772222 419.084639,169.772222 C417.970394,169.772222 417.023285,168.825113 417.023285,167.710867 C417.023285,166.596621 417.970394,165.649512 419.084639,165.649512 Z M426.438662,165.370951 L426.438662,167.599443 L422.148816,167.599443 C422.148816,167.599443 422.148816,167.488018 422.148816,167.432306 C422.148816,166.596621 421.814542,165.928074 421.257419,165.370951 L426.438662,165.370951 Z M407.752473,165.649512 C408.866719,165.649512 409.813828,166.540909 409.813828,167.710867 C409.813828,168.825113 408.866719,169.772222 407.752473,169.772222 C406.638227,169.772222 405.691118,168.825113 405.691118,167.710867 C405.691118,166.596621 406.638227,165.649512 407.752473,165.649512 Z M401.456984,165.649512 C402.57123,165.649512 403.518339,166.540909 403.518339,167.710867 C403.518339,168.825113 402.57123,169.772222 401.456984,169.772222 C400.342738,169.772222 399.395629,168.825113 399.395629,167.710867 C399.395629,166.596621 400.342738,165.649512 401.456984,165.649512 Z M399.284204,165.538088 C398.727081,166.095211 398.392807,166.875183 398.392807,167.655155 C398.392807,167.710867 398.392807,167.822292 398.392807,167.878004 L397,167.878004 L397,165.538088 L399.284204,165.538088 Z M409.758116,165.538088 L410.538088,165.538088 C411.373772,165.538088 412.04232,166.206635 412.04232,167.04232 L412.04232,167.878004 L410.649512,167.878004 C410.649512,167.822292 410.649512,167.710867 410.649512,167.655155 C410.649512,166.875183 410.315239,166.095211 409.758116,165.538088 Z M405.579693,165.370951 C405.022571,165.928074 404.688297,166.596621 404.688297,167.432306 C404.688297,167.54373 404.688297,167.599443 404.688297,167.599443 L404.465448,167.599443 C404.465448,167.599443 404.465448,167.488018 404.465448,167.432306 C404.465448,166.596621 404.131174,165.928074 403.574051,165.370951 L405.579693,165.370951 Z M423.541623,154.67419 C424.098746,154.67419 427.441484,154.228492 430.282811,156.456984 C427.441484,156.456984 426.438662,156.456984 426.438662,156.456984 L426.438662,163.811007 L423.541623,163.811007 L423.541623,154.67419 Z M438.472518,164.646691 C438.583943,164.980965 438.918217,164.813828 439.029641,165.370951 L437.803971,165.370951 L436.856862,165.370951 L436.801149,165.370951 C436.244026,164.813828 435.519767,164.646691 434.684082,164.646691 C433.068426,164.646691 431.787043,166.095211 431.787043,167.710867 C431.787043,167.878004 431.842755,167.599443 431.842755,168.156566 L428.054319,168.156566 L428.054319,157.57123 C428.054319,157.57123 431.22992,157.57123 432.232741,157.57123 C433.235563,157.57123 433.291275,158.685475 433.291275,158.685475 L432.901289,158.685475 C432.901289,158.685475 433.068426,159.298311 434.126959,160.96968 C438.305381,160.96968 438.02682,163.365308 438.472518,164.646691 Z M429.669976,160.691118 C430.227099,161.192529 432.734152,161.025392 432.734152,161.025392 L431.452769,158.685475 L429.669976,158.685475 C429.669976,158.685475 429.669976,160.133995 429.669976,160.691118 Z"
                                          id="Combined-Shape-Copy"></path>
						        </g>
						    </g>
						</svg>
					</span>
            </h2>
            <div class="maintrucks__row">


                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "gruzoperevozki",
                    array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "gruzoperevozki",
                        "IBLOCK_ID" => "25",
                        "NEWS_COUNT" => "9",
                        "SORT_BY1" => "ID",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "Y",
                        "SET_BROWSER_TITLE" => "Y",
                        "SET_META_KEYWORDS" => "Y",
                        "SET_META_DESCRIPTION" => "Y",
                        "SET_LAST_MODIFIED" => "Y",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => "",
                        "PAGER_BASE_LINK" => "",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "COMPONENT_TEMPLATE" => "gruzoperevozki",
                        "STRICT_SECTION_CHECK" => "N",
                        "FILE_404" => ""
                    ),
                    false
                ); ?>
            </div>
        </div>
    </section>
    <!-- maintrucks END -->


    <!-- mainform -->
    <section class="mainform section fadeInUp-scroll">
        <div class="wrapper">
            <div class="mainform__row flex">
                <div class="mainform__card">

                    <? $APPLICATION->IncludeFile(SITE_DIR . "include/dostavka.php", Array(), Array(
                            "MODE" => "html",
                            "NAME" => "Text in title",
                        )
                    ); ?>


                    <div class="mainform__phone">
                        <a href="tel:+73912729279" class="mainform__number">+7 391 27-29-279</a>
                        <a href="#" class="mainform__callback btn-callback">заказать звонок</a>
                    </div>
                </div>
                <div class="mainform__content">
                    <div class="mainform__top">
                        <div class="mainform__coll mainform__coll_active" data-tab="1">
                            <div class="mainform__numeral">1</div>
                            <div class="mainform__desc">Маршрут<br> движения</div>
                        </div>
                        <div class="mainform__coll" data-tab="2">
                            <div class="mainform__numeral">2</div>
                            <div class="mainform__desc">Информация<br> о грузе</div>
                        </div>
                        <div class="mainform__coll" data-tab="3">
                            <div class="mainform__numeral">3</div>
                            <div class="mainform__desc">Личные<br> данные</div>
                        </div>
                    </div>


                    <? $APPLICATION->IncludeComponent(
                        "autospec:main.feedback",
                        "ocenka",
                        array(
                            "USE_CAPTCHA" => "N",
                            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                            "EMAIL_TO" => "leads@as124.ru",
                            "REQUIRED_FIELDS" => array(
                                0 => "NONE",
                            ),
                            "EVENT_MESSAGE_ID" => array(
                                0 => "7",
                            ),
                            "COMPONENT_TEMPLATE" => "ocenka",
                            "USER_CONSENT" => "Y",
                            "USER_CONSENT_ID" => "1",
                            "USER_CONSENT_IS_CHECKED" => "Y",
                            "USER_CONSENT_IS_LOADED" => "Y"
                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- mainform END -->


    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "logo",
        array(
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "N",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "logo",
            "IBLOCK_ID" => "22",
            "NEWS_COUNT" => "10",
            "SORT_BY1" => "TIMESTAMP_X",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "Y",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "SET_LAST_MODIFIED" => "Y",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
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
            "PAGER_SHOW_ALL" => "Y",
            "PAGER_BASE_LINK_ENABLE" => "Y",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "arrPager",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "COMPONENT_TEMPLATE" => "logo",
            "STRICT_SECTION_CHECK" => "N",
            "FILE_404" => ""
        ),
        false
    ); ?>
    <!-- mainslider END -->


<? endif; ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>