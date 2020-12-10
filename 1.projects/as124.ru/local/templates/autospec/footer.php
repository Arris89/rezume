<? if ($APPLICATION->GetCurPage(false) !== '/search/'): ?>
<span style="display:none;">
<? endif; ?>


<? if ($APPLICATION->GetCurPage(false) !== '/search/'): ?>
</span>
<? endif; ?>


<!-- footer -->
<footer class="footer fadeInUp-scroll">
    <div class="footer__row">
        <div class="wrapper">
            <div class="footer__coll footer__coll_min">
                <div class="footer__caption">Грузоперевозки</div>
                <nav class="footer__items footer__items_min">


                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer1",
                        array(
                            "ROOT_MENU_TYPE" => "footer1",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "COMPONENT_TEMPLATE" => "footer1"
                        ),
                        false
                    ); ?>


                </nav>
            </div>


            <div class="footer__coll footer__coll_average">
                <div class="footer__caption">Аренда спецтехники</div>
                <nav class="footer__items footer__items_average">


                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer2",
                        array(
                            "ROOT_MENU_TYPE" => "footer2",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "COMPONENT_TEMPLATE" => "footer2"
                        ),
                        false
                    ); ?>
                </nav>
            </div>


            <div class="footer__coll footer__coll_right">
                <nav class="footer__items footer__items_right">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer3",
                        array(
                            "ROOT_MENU_TYPE" => "footer3",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "COMPONENT_TEMPLATE" => "footer3"
                        ),
                        false
                    ); ?>

                </nav>
            </div>

            <div class="footer__coll footer__coll_big">
                <div class="footer__caption">Дополнительные услуги</div>
                <nav class="footer__items footer__items_big">


                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer4",
                        array(
                            "ROOT_MENU_TYPE" => "footer4",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "COMPONENT_TEMPLATE" => "footer4"
                        ),
                        false
                    ); ?>
                </nav>
            </div>


        </div>
    </div>
    <div class="footer__row">
        <div class="wrapper flex">


            <? $APPLICATION->IncludeFile(SITE_DIR . "include/footer1.php", Array(), Array(
                    "MODE" => "html",
                    "NAME" => "Text in title",
                )
            ); ?>


            <div class="footer__payment">


                <? $APPLICATION->IncludeFile(SITE_DIR . "include/footer3.php", Array(), Array(
                        "MODE" => "html",
                        "NAME" => "Text in title",
                    )
                ); ?>
            </div>


        </div>
    </div>
    <div class="footer__bottom">
        <div class="wrapper">


            <? $APPLICATION->IncludeFile(SITE_DIR . "include/footer2.php", Array(), Array(
                    "MODE" => "html",
                    "NAME" => "Text in title",
                )
            ); ?>

        </div>
        <a href="javascript:void(0)" class="footer__up footer__up--js"></a>
    </div>
</footer>
<!-- footer END -->

</div>

<div class="modal" style="display: none;">
    <div class="box-modal" id="modal-callback">
        <div class="modal-content">
            <div class="arcticmodal__window">
                <div class="modal__title">Заказать звонок</div>
                <div class="modal__row">
                    <div class="modal__img">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/main-face.png" alt="">
                    </div>
                    <div class="modal__desc">Оставьте заявку и наш менеджер свяжется с вами для уточнения деталей</div>
                </div>


                <?


                $APPLICATION->IncludeComponent(
                    "autospec:main.feedback",
                    "header",
                    array(
                        "USE_CAPTCHA" => "N",
                        "AJAX_MODE" => "Y",
                        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                        "EMAIL_TO" => "leads@as124.ru",
                        "USER_CONSENT" => "",
                        "REQUIRED_FIELDS" => array(
                            0 => "NONE",
                        ),
                        "EVENT_MESSAGE_ID" => array(
                            0 => "7",
                        ),
                        "COMPONENT_TEMPLATE" => "header"
                    ),
                    false
                ); ?>


                <div class="box-modal_close arcticmodal-close"></div>
            </div>
        </div>
    </div><!-- end box-modal -->
</div><!-- end modal-discount -->

<div class="modal" style="display: none;">
    <div class="box-modal" id="modal-special-equipment">
        <div class="modal-content">
            <div class="arcticmodal__window">
                <div class="modal__title">Заказ спецтехники</div>
                <div class="modal__row">
                    <div class="modal__img">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/main-face.png" alt="">
                    </div>
                    <div class="modal__desc">Оставьте заявку и наш менеджер свяжется с вами для уточнения деталей</div>
                </div>


                <? $APPLICATION->IncludeComponent(
                    "autospec:main.feedback",
                    "header",
                    array(
                        "USE_CAPTCHA" => "N",
                        "AJAX_MODE" => "Y",
                        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                        "EMAIL_TO" => "leads@as124.ru",
                        "USER_CONSENT" => "",
                        "REQUIRED_FIELDS" => array(
                            0 => "NONE",
                        ),
                        "EVENT_MESSAGE_ID" => array(
                            0 => "7",
                        ),
                        "COMPONENT_TEMPLATE" => "header"
                    ),
                    false
                ); ?>


                <div class="box-modal_close arcticmodal-close"></div>
            </div>
        </div>
    </div><!-- end box-modal -->
</div><!-- end modal-discount -->

<div class="modal" style="display: none;">
    <div class="box-modal" id="modal-truck">
        <div class="modal-content">
            <div class="arcticmodal__window">
                <div class="modal__title">Заказ грузоперевозки</div>
                <div class="modal__row">
                    <div class="modal__img">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/main-face.png" alt="">
                    </div>
                    <div class="modal__desc">Оставьте заявку и наш менеджер свяжется с вами для уточнения деталей</div>
                </div>


                <? $APPLICATION->IncludeComponent(
                    "autospec:main.feedback",
                    "header",
                    array(
                        "USE_CAPTCHA" => "N",
                        "AJAX_MODE" => "Y",
                        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                        "EMAIL_TO" => "leads@as124.ru",
                        "USER_CONSENT" => "",
                        "REQUIRED_FIELDS" => array(
                            0 => "NONE",
                        ),
                        "EVENT_MESSAGE_ID" => array(
                            0 => "7",
                        ),
                        "COMPONENT_TEMPLATE" => "header"
                    ),
                    false
                ); ?>

                <div class="box-modal_close arcticmodal-close"></div>
            </div>
        </div>
    </div><!-- end box-modal -->
</div><!-- end modal-discount -->

<div class="modal" style="display: none;">
    <div class="box-modal" id="modal-thanks">
        <div class="modal-content">
            <div class="arcticmodal__window">
                <div class="modal__title">Заказ спецтехники</div>
                <div class="modal__row">
                    <div class="modal__img">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/main-face.png" alt="">
                    </div>
                    <div class="modal__desc">Оставьте заявку и наш менеджер свяжется с вами для уточнения деталей</div>
                    <div class="modal__img-thanks"></div>
                </div>
                <div class="box-modal_close arcticmodal-close"></div>
            </div>
        </div>
    </div><!-- end box-modal -->
</div><!-- end modal-thanks -->


<? use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/jquery-1.11.0.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/slick.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/query.maskedinput.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/jquery.fancybox.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/jquery.arcticmodal-0.3.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/select2/select2.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/script.js?4");

?>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;amp;"></script>
</body>
</html>