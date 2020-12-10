<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $USER;
?>

</main>

<div class="separate-line"></div>

<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="top">
            <div class="box">
                <!-- Магазин-->
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "top",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "store_footer",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "footer_menu",
                        "MENU_THEME" => "site"
                    ),
                    false
                ); ?>
            </div>

            <div class="box">
                <!-- Покупателям-->

                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "top",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "buy_footer",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "footer_menu",
                        "MENU_THEME" => "site"
                    ),
                    false
                ); ?>
            </div>

            <div class="box">

                <!--  О компании-->

                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "top",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "Info_footer",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "footer_menu",
                        "MENU_THEME" => "site"
                    ),
                    false
                ); ?>
            </div>


            <div class="box contact">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_DIR . "local/include/contacts.php"
                    )
                ); ?>
            </div>
            <noindex>
                <div class="box last-box">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:eshop.socnet.links",
                        "soc_seti",
                        Array(
                            "COMPONENT_TEMPLATE" => "soc_seti",
                            "FACEBOOK" => "https://www.facebook.com/ChkalovTM",
                            "GOOGLE" => "",
                            "INSTAGRAM" => "https://instagram.com/chkalov_",
                            "TWITTER" => "",
                            "VKONTAKTE" => "http://vk.com/chkalov_tm"
                        )
                    ); ?>

                </div>
            </noindex>
        </div>
    </div>
    <noindex>
        <div class="payment-wrap">
            <div class="container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_DIR . "local/include/payment-wrap.php"
                    )
                ); ?>
                <div class="clear"></div>
            </div>
        </div>
    </noindex>
    <div class="bottom">
        <div class="container">
            <noindex>
                <div class="copyrights">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_DIR . "local/include/copyrights.php"
                        )
                    ); ?>
                </div>
                <div class="dev">
                    <a href="https://d-partners.ru" style="display: none;">
                        d-partners.ru - разрaботка сайта
                    </a>
                </div>
                <div class="clear"></div>
            </noindex>
        </div>
    </div>
</footer>


<div class="fade-screen" style="display: none;"></div>

<div class="sb-slidebar sb-left">
    <div id="cssmenu">
        <ul>
            <li>
                <a href="/auth/" class="login">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/vhod.png" alt="">
                            Вход
                        </span>
                </a>
                <a href="/register/" class="signup">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/register.png" alt="">
                            Регистрация
                        </span>
                </a>
            </li>
            <li class="has-sub">

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


            <li>
                <a href="/personal/cart/">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/cart.png" alt="">
                            Корзина
                        </span>
                </a>
            </li>

            <li class="has-sub">
                <a href="/o-nas/">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/about.png" alt="">
                            О нас
                        </span>
                </a>
                <span class="js-catclose">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/prod-slide-next.png" alt="">
                    </span>
                <ul class="menu">
                    <li>
                        <a href="/o-brende/">О бренде</a>
                    </li>
                    <li>
                        <a href="/rekvizity/">Реквизиты</a>
                    </li>
                    <li>
                        <a href="/dogovor-publichnoy-oferty/">Договор публичной оферты</a>
                    </li>
                    <li>
                        <a href="/publichnye-skidki/">Накопительные скидки</a>
                    </li>
                    <li>
                        <a href="/zashchita-informatsii/">Защита информации</a>
                    </li>
                    <li>
                        <a href="/blog/">Блог</a>
                    </li>
                    <li>
                        <a href="/smi/">СМИ</a>
                    </li>
                </ul>
                <div class="drop-menu">
                    <div class="container">
                        <div class="menu-list">
                            <ul class="menu">
                            </ul>
                        </div>
                    </div>
                </div>
            </li>


            <li class="has-sub">
                <a href="/catalog/marina_militare/">
                        <span>

                            Marina Militare

                        </span>
                </a>
                <span class="js-catclose">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/prod-slide-next.png" alt="">
                    </span>
                <ul>
                    <li>
                        <a href="/catalog/marina_militare/muzhskoe/">
                                <span>


                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/marina_militare/zhenskoe/">
                                <span>


                                </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="has-sub">
                <a href="/catalog/muzhskaya_kollektsiya/">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/muj.png" alt="">
                            Мужская

                        </span>
                </a>
                <span class="js-catclose">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/prod-slide-next.png" alt="">
                    </span>
                <ul>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/bryuki_1/">
                                <span>
                                    Брюки

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/dzhempery_1/">
                                <span>
                                    Джемперы

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/dzhinsy_1/">
                                <span>
                                    Джинсы

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/zhilety_1/">
                                <span>
                                    Жилеты

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/futbolki/">
                                <span>
                                    Футболки

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/kurtki_1/">
                                <span>
                                    Куртка-пилот

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/polo_1/">
                                <span>
                                    Поло

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/pukhoviki-parki/">
                                <span>
                                    Пуховики

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/tolstovki_1/">
                                <span>
                                    Толстовки

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/muzhskaya_kollektsiya/shorty_1/">
                                <span>
                                    Шорты

                                </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="has-sub">
                <a href="/catalog/zhenskaya_kollektsiya/">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/jen.png" alt="">
                            Женская

                        </span>
                </a>
                <span class="js-catclose">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/prod-slide-next.png" alt="">
                    </span>
                <ul>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/limited-edition/">
                                <span>
                                    Limited edition

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/bryuki/">
                                <span>
                                    Брюки

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/dzhinsy/">
                                <span>
                                    Джинсы

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/dzhempery/">
                                <span>
                                    Джемперы

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/kombinezony/">
                                <span>
                                    Комбинезоны

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/mayki_futbolki/">
                                <span>
                                    Майки,Футболки

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/platya/">
                                <span>
                                    Платья

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/kurtki_vetrovki/">
                                <span>
                                    Куртки, ветровки

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/pukhoviki_1/">
                                <span>
                                    Пуховики

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/tolstovki/">
                                <span>
                                    Толстовки

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/shorty/">
                                <span>
                                    Шорты

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="/catalog/zhenskaya_kollektsiya/yubki/">
                                <span>
                                    Юбки

                                </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="has-sub">
                <a href="/catalog/aksessuary/">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/acses.png" alt="">
                            Аксессуары

                        </span>
                </a>
                <span class="js-catclose">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/prod-slide-next.png" alt="">
                    </span>
                <ul>
                    <li>
                        <a href="/catalog/aksessuary/watch/">
                                <span>
                                    Часы-авиатор

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://chkalov-tm.ru/aksessuary/golovnye-ubory/">
                                <span>
                                    Головные уборы

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://chkalov-tm.ru/aksessuary/sharfy/">
                                <span>
                                    Шарфы

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://chkalov-tm.ru/aksessuary/podarochnye-sertifikaty/">
                                <span>
                                    Подарочные сертификаты

                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://chkalov-tm.ru/aksessuary/suveniry/">
                                <span>
                                    Сувениры

                                </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="has-sub">
                <a href="/catalog/mebel/">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/avia.png" alt="">
                            Авиационная мебель

                        </span>
                </a>
                <span class="js-catclose">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/prod-slide-next.png" alt="">
                    </span>
                <ul>
                    <li>
                        <a href="/catalog/mebel/kresla/">
                                <span>
                                    Кресла

                                </span>
                        </a>
                    </li>

                </ul>
            </li>


            <li>
                <a href="/dostavka-i-oplata/">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/oplata.png" alt="">
                            Доставка и оплата
                        </span>
                </a>
            </li>
            <li>
                <a href="/kontakty/">
                        <span>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/contact.png" alt="">
                            Контакты
                        </span>
                </a>
            </li>
        </ul>
        <div class="mobmenu-footer">

            <div class="phone">
                <a href="tel: +7 495 642-34-26">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/tel-white.png" alt="">
                    <span>
                            +7 495 642-34-26
                        </span>
                </a>
            </div>

            <div class="socials-list">
                <noindex><a rel="nofollow" target="_blank" href="https://www.facebook.com/ChkalovTM"><img width="36"
                                                                                                          height="37"
                                                                                                          alt=""
                                                                                                          src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/soc-icon.jpg"></a>
                </noindex>
                <noindex><a rel="nofollow" target="_blank" href="http://vk.com/chkalov_tm"><img width="36"
                                                                                                height="37" alt=""
                                                                                                src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/logo_vkontakte.png"></a>
                </noindex>
                <noindex><a rel="nofollow" target="_blank" href="https://instagram.com/chkalov_"><img width="36"
                                                                                                      height="37" alt=""
                                                                                                      src="<?= SITE_TEMPLATE_PATH ?>/images/mobile_menu/soc-icon6.png"></a>
                </noindex>
            </div>
        </div>
    </div>
</div>


<div class="fade-screen" style="display: none;"></div>

<div class="popup enter" id="popup-auth" style="display: none;">
    <div class="close"><a href="https://chkalov-tm.ru/#"><img class="popup-close"
                                                              src="<?= SITE_TEMPLATE_PATH ?>/images/popup-close.jpg"
                                                              alt="" height="23" width="23"></a></div>
    <div class="title"><?= ($USER->IsAuthorized() ? 'Профиль' : 'Вход') ?></div>
    <div class="wrap">
        <? $APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "auth_popup",
            array(
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_SHADOW" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "FORGOT_PASSWORD_URL" => "/auth/?forgot_password=yes",
                "PROFILE_URL" => "",
                "REGISTER_URL" => "",
                "SHOW_ERRORS" => "Y",
                "COMPONENT_TEMPLATE" => "auth_popup"
            ),
            false
        ); ?>
    </div>
</div>


<div id="callback-button">
    <div class="round">
    </div>
</div>

<div class="popup" id="callback-modal" style="display: none;">
    <div class="close"><a href="#"><img class="popup-close" src="<?= SITE_TEMPLATE_PATH ?>/images/popup-close.jpg"
                                        alt="" height="23" width="23"></a></div>
    <div class="title" style="font-size: 57px; line-height: 57px"> Заказать обратный звонок</div>
    <div class="review-form">


        <form method="post" class="contact-us" id="callback-form" action="">

            <?
            $APPLICATION->IncludeComponent(
                "avia:main.feedback",
                "callback",
                array(
                    "AJAX_MODE" => "Y",
                    "USE_CAPTCHA" => "N",
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                    "EMAIL_TO" => "my@email.com",
                    "REQUIRED_FIELDS" => array(
                        0 => "AUTHOR_TELL",
                    ),
                    "EVENT_MESSAGE_ID" => array(
                        0 => "7",
                    ),
                    "COMPONENT_TEMPLATE" => "callback"
                ),
                false
            );
            ?>

        </form>
    </div>
</div>


<div class="popup registration" style="display: none;">
    <div class="close"><a href="/"><img class="popup-close" src="<?= SITE_TEMPLATE_PATH ?>/images/popup-close.jpg"
                                        alt="" height="23" width="23"></a></div>
    <div class="title">Регистрация</div>

    <? $APPLICATION->IncludeComponent(
        "avia:main.register",
        "register",
        array(
            "COMPONENT_TEMPLATE" => "register",
            "SHOW_FIELDS" => array(
                0 => "EMAIL",
                1 => "NAME",
                2 => "LAST_NAME",
                3 => "PERSONAL_GENDER",
            ),
            "REQUIRED_FIELDS" => array(),
            "AUTH" => "N",
            "USE_BACKURL" => "Y",
            "SUCCESS_PAGE" => "/signup/",
            "SET_TITLE" => "N",
            "USER_PROPERTY" => array(),
            "USER_PROPERTY_NAME" => "",
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_SHADOW" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "USER_CONSENT" => "Y",
            "USER_CONSENT_ID" => "1",
            "USER_CONSENT_IS_CHECKED" => "Y",
            "USER_CONSENT_IS_LOADED" => "N"
        ),
        false
    );

    ?>
</div>


<div class="popup town" id="buy-in-click-city-modal" style="display: none;">
    <div class="close"><a href="#"><img class="popup-close" src="<?= SITE_TEMPLATE_PATH ?>/images/popup-close.jpg"
                                        alt="" height="23" width="23"></a></div>
    <div class="title">Ваш город:</div>
    <ul class="town-list">


        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "city",
            array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => IBLOCK_ID__CITY,
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "ACTIVE_FROM",
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
                "INCLUDE_SUBSECTIONS" => "Y",
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
                "COMPONENT_TEMPLATE" => "city",
                "STRICT_SECTION_CHECK" => "N",
                "FILE_404" => ""
            ),
            false
        ); ?>

    </ul>
    <div class="clear"></div>
    <div class="separate-line"></div>
    <div class="wrap">
        <a href="#" class="submit" id="hcity"><span>Выбрать город</span></a>
    </div>
</div>

<script>
    /*ВЫБОР ГОРОДА*/
    $("body").on('click', '#hcity', function () {

        var city = $('input.cityin:radio:checked').next().text();

        $.post('/ajax/city.php', {city}, function (data) {

        })

        $('#buy-in-click-city').text('' + city + '');
        $(".fade-screen").hide();
        $(".popup").hide();
    });
</script>


<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/Inputmask-4.x/dist/jquery.inputmask.bundle.js');
?>


<script>
    $(document).ready(function () {
        $('.telnum').inputmask({"mask": "+9(999) 999-99-99"});
    });
</script>


<script>
    /*Подключение слайдера Big Data*/

    $(document).ready(function () {
        setTimeout(function () {
            $.getScript("/local/templates/aviator/js/newmain.js", function () {
            });
        }, 1500);
    });
</script>


</body>

</html>