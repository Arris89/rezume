</main>

<footer class="page__footer">
    <div class="page__container container">
        <div class="footer">
            <div class="footer__left">
                <div class="footer__logo">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "incs",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "PATH" => "/include/footer-logo.php"
                        ),
                        false
                    ); ?>
                </div>
                <div class="footer__agreement">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "incs",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "PATH" => "/include/footer-agreement.php"
                        ),
                        false
                    ); ?>
                </div>
                <div class="footer__copyright">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "incs",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "PATH" => "/include/footer-text.php"
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <div class="footer__right">
                <div class="site-lang"><img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/lang/eng.png" alt="Страна"
                                            title=""/>
                    <div class="site-lang__text">Россия
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<? $APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "legrand",
    array(
        "AJAX_MODE" => "N",
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
<? $APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd", "popup", Array()); ?>

<div class="popup popup_register zoom-anim-dialog mfp-hide" id="popup-register">
    <div class="popup__content">
        <div class="register-popup">
            <div class="register-popup__title popup-title">регистрация на сайте
            </div>

            <? $APPLICATION->IncludeComponent(
                "bitrix:main.register",
                "legrand",
                array(
                    "COMPONENT_TEMPLATE" => "register",
                    "SHOW_FIELDS" => array(
                        0 => "EMAIL",
                        1 => "NAME",
                        2 => "LAST_NAME",
                        2 => "PHONE",
                    ),
                    "REQUIRED_FIELDS" => array(),
                    "AUTH" => "Y",
                    "USE_BACKURL" => "Y",
                    "SUCCESS_PAGE" => "/personal/order/",
                    "SET_TITLE" => "N",
                    "USER_PROPERTY" => array(),
                    "USER_PROPERTY_NAME" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_SHADOW" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "AJAX_OPTION_HISTORY" => "N",
                    "USER_CONSENT" => "N",
                    "USER_CONSENT_ID" => "2",
                    "USER_CONSENT_IS_CHECKED" => "Y",
                    "USER_CONSENT_IS_LOADED" => "N"
                ),
                false
            ); ?>


            <div class="register-popup__bottom">Если вы ранее регистрировались на сайте, то воспользуйтесь
                входом в <a class="legrand-link legrand-link_blue popup-with-move-anim" href="#popup-enter">Личный
                    кабинет</a>
            </div>
        </div>
    </div>
</div>


<div class="popup popup_review zoom-anim-dialog mfp-hide" id="popup-review">
    <div class="popup__content">
        <div class="review-popup">
            <div class="review-popup__title popup-title">оставить отзыв
            </div>

            <? $APPLICATION->IncludeComponent(
                "4px:main.feedback",
                "review",
                array(
                    "USE_CAPTCHA" => "N",
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_JUMP" => "N",
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                    "EMAIL_TO" => "alex@4px.ru",
                    "REQUIRED_FIELDS" => array(
                        0 => "NAME",
                        1 => "MESSAGE",
                    ),
                    "EVENT_MESSAGE_ID" => array(
                        0 => "7",
                    ),
                    "COMPONENT_TEMPLATE" => "review"
                ),
                false
            ); ?>
        </div>
    </div>
</div>


<script>
    window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.3.1.min.js", integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=", crossorigin="anonymous"><\/script>')
</script>
<script>svg4everybody();</script>
<script src="https://api-maps.yandex.ru/2.1/?&amp;lang=ru_RU"></script>

<?
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/jquery/jquery-3.3.1.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/svg4everybody/svg4everybody.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/picturefill/picturefill.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/phone-mask/jquery.mask.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/simplebar/simplebar.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/jquery-ui.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/magnific-popup/jquery.magnific-popup.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/selectric/jquery.selectric.min.js');

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/lazyload/jquery.lazy.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/lazyload/jquery.lazy.plugins.min.js');

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/module/iziToast/iziToast.min.js');

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/app.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/configurator.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/magnific.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/map.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/mask.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/menu.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/category.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/popup.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/form/initValidate.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/part/form/sendForm.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/script.js');
?>
</body>
</html>
