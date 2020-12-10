</main>
<footer class="main-footer">
    <div class="main-footer__wrapper">
        <div class="main-footer__items">
            <div class="main-footer__item main-footer__item_logo"><a class="main-footer__logo logo-area"
                                                                     href="index.html">


                    <?
                    $APPLICATION->IncludeFile(SITE_DIR . "include/logo_footer.php", array(),
                        array(
                            "MODE" => "html",
                            "NAME" => "E-mail",
                        )
                    ); ?>

                    <?
                    $APPLICATION->IncludeFile(SITE_DIR . "include/text_footer.php", array(),
                        array(
                            "MODE" => "html",
                            "NAME" => "E-mail",
                        )
                    ); ?>


            </div>
            <div class="main-footer__item main-footer__item_links">


                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    array(
                        "ROOT_MENU_TYPE" => "left",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "top",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "MENU_CACHE_GET_VARS" => array(),
                        "COMPONENT_TEMPLATE" => "footer"
                    ),
                    false
                ); ?>

            </div>
            <div class="main-footer__item main-footer__item_contacts">
                <div class="main-footer__contacts contacts contacts_footer">

                    <div class="contacts__inner">

                        <?
                        $APPLICATION->IncludeFile(SITE_DIR . "include/tel1_footer.php", array(),
                            array(
                                "MODE" => "html",
                                "NAME" => "E-mail",
                            )
                        ); ?>

                        <?
                        $APPLICATION->IncludeFile(SITE_DIR . "include/tel2_footer.php", array(),
                            array(
                                "MODE" => "html",
                                "NAME" => "E-mail",
                            )
                        ); ?>

                        <button class="contacts__link contacts__link_call btn_get-call" type="button">Перезвоните мне
                        </button>
                    </div>
                </div>
                <div class="main-footer__info">


                    <?
                    $APPLICATION->IncludeFile(SITE_DIR . "include/company_footer.php", array(),
                        array(
                            "MODE" => "html",
                            "NAME" => "E-mail",
                        )
                    ); ?>

                </div>
            </div>
        </div>
        <div class="main-footer__copyright">

            <?
            $APPLICATION->IncludeFile(SITE_DIR . "include/copyright.php", array(),
                array(
                    "MODE" => "html",
                    "NAME" => "E-mail",
                )
            ); ?>

        </div>
    </div>
</footer>

<section class="popup">
    <div class="popup__item popup__item_call">
        <div class="popup__body"><h3 class="popup__title title title_h3">Заказать звонок</h3>
            <p class="popup__text">Заполните указанные поля и мы с Вами свяжемся в ближайшее время!</p>


            <? $APPLICATION->IncludeComponent(
                "dvernik:main.feedback",
                "call_main",
                array(
                    "USE_CAPTCHA" => "N",
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                    "EMAIL_TO" => "my@email.com",
                    "REQUIRED_FIELDS" => array(
                        0 => "NAME",
                    ),
                    "EVENT_MESSAGE_ID" => array(
                        0 => "7",
                    ),
                    "COMPONENT_TEMPLATE" => ".default",
                    "AJAX_MODE" => "Y"
                ),
                false
            ); ?>

            <button class="popup__close-btn" type="button">Закрыть</button>
        </div>
    </div>
    <div class="popup__item popup__item_call-success">
        <div class="popup__body"><h3 class="popup__title title title_h3">Заявка отправлена!</h3>
            <div class="popup__image">
                <svg class="popup__icon icon icon_theme_red">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                         xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-succes"></use>
                </svg>
            </div>
            <p class="popup__text">В ближайшее время с Вами свяжется наш менеджер и ответит на все Ваши вопросы!</p>
            <button class="popup__close-btn" type="button">Закрыть</button>
        </div>
    </div>

    <div class="popup__item popup__item_price">
        <div class="popup__body"><h3 class="popup__title title title_h3">Заказать прайс</h3>
            <p class="popup__text">Заполните форму и мы вышлем Вам полный оптовый прайс нашей продукции!</p>

            <? $APPLICATION->IncludeComponent(
                "dvernik:main.feedback",
                "price",
                array(
                    "USE_CAPTCHA" => "N",
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                    "EMAIL_TO" => "my@email.com",
                    "REQUIRED_FIELDS" => array(
                        0 => "NONE",
                    ),
                    "EVENT_MESSAGE_ID" => array(
                        0 => "7",
                    ),
                    "COMPONENT_TEMPLATE" => "price"
                ),
                false
            ); ?>


            <button class="popup__close-btn" type="button">Закрыть</button>
        </div>
    </div>

    <div class="popup__item popup__item_price-success">
        <div class="popup__body"><h3 class="popup__title title title_h3">Запрос принят!</h3>
            <div class="popup__image">
                <svg class="popup__icon icon icon_theme_red">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                         xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-succes"></use>
                </svg>
            </div>
            <p class="popup__text">Мы отправили Вам на почту полный оптовый прайс нашей продукции!</p>
            <button class="popup__close-btn" type="button">Закрыть</button>
        </div>
    </div>
</section>

<script>

    $("body").on('click', '.product__btn.btn.btn_get-price', function () {
        var Fid = $(this).attr('data-url');
        /*alert(Fid);*/
        $('.newinp').remove();
        $('input[name=user_tell]').after('<input type=hidden value=' + Fid + ' class="newinp" name="newinp">');
    });

    $("body").on('click', '.item-thumb__btn.btn.btn_get-price', function () {
        var Fid = $(this).attr('data-url');
        /*alert(Fid);*/
        $('.newinp').remove();
        $('input[name=user_tell]').after('<input type=hidden value=' + Fid + ' class="newinp" name="newinp">');
    });

    /*Получить прайс в карточке товара*/
    $("body").on('click', '.item-content__btn.item-content__btn_price.btn.btn_get-price', function () {
        if (itempage == 1) {
            var Fid = $(this).attr('data-url');
            /*alert(Fid);*/
            $('.newinp').remove();
            $('input[name=user_tell]').after('<input type=hidden value=' + Fid + ' class="newinp" name="newinp">');
        }
    });


    /*Бесплатная консультация в карточке товара*/
    $("body").on('click', '.item-content__btn.btn.btn_type_link.btn_get-call', function () {
        if (itempage == 1) {
            var Fid = $(this).attr('data-url');
            /*alert(Fid);*/
            $('.newinp').remove();
            $('input[name=user_tell]').after('<input type=hidden value=' + Fid + ' class="newinp" name="newinp">');
        }
    });
</script>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<?
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/plugins/jquery/jquery-3.4.1.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/plugins/OverlayScrollbars/jquery.overlayScrollbars.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/plugins/slickslider/slick.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/plugins/jquery.validate/jquery.validate.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/plugins/ofi/ofi.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/script.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/plugins/sumoselect/jquery.sumoselect.min.js');

?>


</body>
</html>