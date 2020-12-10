<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Для взрослых");
?>



    <main class="content-child">
        <div class="fixed-contacts" data-aos="fade-left" data-aos-anchor-placement="center-bottom">
            <div class="fixed-contacts__close"></div>
            <div class="fixed-contacts__item"><a class="fixed-contacts__phone" href="tel:+79255504535"><span
                            class="is-mobile">
										<svg>
											<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#fixed-phone"></use>
										</svg></span><span class="is-desktop">+7 (925) 550 45 35</span></a></div>
            <div class="fixed-contacts__item"><a class="fixed-contacts__address js-anchor" href="#contacts"><span
                            class="is-mobile">
										<svg>
											<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#fixed-address"></use>
										</svg></span><span class="is-desktop">г. Москва, Шарикоподшипниковская,&nbsp;13&nbsp;стр.46</span></a>
            </div>
        </div>
        <div class="container">
            <section class="section section-header" data-aos="zoom-in-up" data-aos-anchor-placement="center-bottom"
                     style="background-image: url(<?= SITE_TEMPLATE_PATH ?>/images/pic/carting/bg_scool_carting_adult.jpg)">
                <div class="section-header__inner">
                    <h1>Обучение для взрослых</h1>
                    <div class="section-header__sub-menu is-big">
                        <ul>
                            <li><a href="/children/">Детская школа<br><span class="section-header__light">MAZDA KARTING ACADEMY</span></a>
                            </li>
                            <li class="is-active"><span>Обучение для<br> взрослых</span></li>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="section section_booking">


                <div class="row align-items-stretch">

                    <div class="col-lg-4 col-12">
                        <div class="booking booking_info booking_carting-adult">

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "incs",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "PATH" => "/include/adult/bron.php"
                                ),
                                false
                            ); ?>


                        </div>

                    </div>

                    <div class="col-lg-8 col-12">
                        <div class="about-academy">


                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "incs",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "PATH" => "/include/adult/info.php"
                                ),
                                false
                            ); ?>


                            <div class="about-academy-list">
                                <div class="row justify-content-center justify-content-md-start">


                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:news.list",
                                        "advantages",
                                        array(
                                            "DISPLAY_DATE" => "N",
                                            "DISPLAY_NAME" => "N",
                                            "DISPLAY_PICTURE" => "N",
                                            "DISPLAY_PREVIEW_TEXT" => "N",
                                            "AJAX_MODE" => "N",
                                            "IBLOCK_TYPE" => "content",
                                            "IBLOCK_ID" => "17",
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
                                                0 => "LINK",
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
                                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                            "PARENT_SECTION" => "",
                                            "PARENT_SECTION_CODE" => "",
                                            "INCLUDE_SUBSECTIONS" => "N",
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
                                            "COMPONENT_TEMPLATE" => "advantages",
                                            "STRICT_SECTION_CHECK" => "N",
                                            "FILE_404" => ""
                                        ),
                                        false
                                    ); ?>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </section>


            <section class="section section-main-academy">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "incs",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "PATH" => "/include/adult/main.php"
                    ),
                    false
                ); ?>
            </section>


            <section class="section section_grey section_slider-light-columns">
                <h2 class="section__title">Виды занятий</h2>
                <div class="slider-light-columns js-slides-blocks-name">


                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "adult-slider",
                        array(
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => "19",
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
                                0 => "START",
                                1 => "DAY",
                                2 => "LONG",
                                3 => "PROG",
                                4 => "TIME",
                                5 => "PRICE",
                                6 => "ABON",
                                7 => "TRENER",
                                8 => "",
                                9 => "",
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
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "N",
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
                            "COMPONENT_TEMPLATE" => "adult-slider",
                            "STRICT_SECTION_CHECK" => "N",
                            "FILE_404" => ""
                        ),
                        false
                    ); ?>


                </div>
            </section>
        </div>
        <section class="section section-gallery">
            <div class="grid grid-collapse">
                <div class="row">
                    <div class="col-lg-7 col-md-9">
                        <div class="gallery" active="1">
                            <div class="gallery-image"
                                 style="background-image: url(<?= SITE_TEMPLATE_PATH ?>/images/pic/adult/1.jpg);"></div>
                            <div class="gallery-footer">
                                <div class="gallery-arrow gallery-arrow-prev"></div>
                                <div class="gallery-description">
                                    <div class="gallery-title">Фотогалерея | Наше юные гонщики!</div>
                                    <p class="gallery-date">2 февраля 2019 года</p>
                                </div>
                                <div class="gallery-arrow gallery-arrow-next"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-3">
                        <div class="gallery-slides grid grid-collapse">
                            <div class="row">

                            <?
                                $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM");
                                $arFilter = Array("IBLOCK_ID" => 9, "SECTION_ID" => 12, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                                $i = 1;
                                while ($ob = $res->GetNextElement()) {

                                    $arFields = $ob->GetFields();

                                    $arProps = $ob->GetProperties();

                                    $rsFile = CFile::GetByID($arProps['image']['VALUE']);
                                    $arFile = $rsFile->Fetch();

                                    $href = "/upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . "";
                                    ?>
                                    <div class="gallery-slide col-lg-6" id="gallery-slide-<?= $i ?>"
                                         data-title="<?= $arFields['NAME'] ?>"
                                         data-date="<?= $arFields['DATE_ACTIVE_FROM'] ?>"
                                         style="background-image: url(<?= $href ?>);">
                                    </div>

                                    <? $i++;
                                } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="popup__hidden">
        <div id="popup-registration">
            <div class="popup__title">Регистрация</div>
            <div class="popup__descr">
                <p>Просто заполните данные формы и приходите к нам, как только мы откроемся. <br> Мы сообщим Вам об этом
                    по телефону!</p>
            </div>
            <form class="popup-form js-form-ajax" action="index.html" method="post">
                <div class="popup-form__input">
                    <input class="input-text" type="text" name="name" required placeholder="Ваше имя*">
                </div>
                <div class="popup-form__input">
                    <input class="input-text" type="text" name="lastName" required placeholder="Ваша фамилия*">
                </div>
                <div class="popup-form__input">
                    <input class="input-text" type="text" name="phone" required placeholder="Телефон*">
                </div>
                <div class="popup-form__input">
                    <input class="input-text" type="email" name="email" placeholder="E-mail">
                </div>
                <div class="popup-form__input popup-form__input_submit">
                    <button class="btn btn_small" type="submit" name="sendRegistration" value="send">
                        Зарегистрироваться
                    </button>
                </div>
            </form>
            <div class="popup__descr-bottom">
                <p>Скидка предоставляется на&nbsp;заезды на&nbsp;прокатном или детском карте и&nbsp;не&nbsp;суммируется
                    с&nbsp;другими скидками и&nbsp;специальными предложениями. Скидка действует на&nbsp;один заезд на&nbsp;одного
                    гостя.</p>
            </div>
        </div>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>