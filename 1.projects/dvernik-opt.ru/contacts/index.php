<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

    <section class="contact">
        <div class="contact__wrapper"><h1 class="contact__title title title_h1">Контакты</h1>
            <div class="contact__map map">
                <div class="map__info contact-info">
                    <ul class="contact-info__list">

                        <?
                        $APPLICATION->IncludeFile(SITE_DIR . "include/contacts.php", array(),
                            array(
                                "MODE" => "html",
                                "NAME" => "Block",
                            )
                        ); ?>

                    </ul>
                </div>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:map.yandex.view",
                    ".default",
                    array(
                        "INIT_MAP_TYPE" => "MAP",
                        "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.852575331569014;s:10:\"yandex_lon\";d:37.39070181835063;s:12:\"yandex_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.390970039252096;s:3:\"LAT\";d:55.85266887618622;s:4:\"TEXT\";s:0:\"\";}}}",
                        "MAP_WIDTH" => "1140px",
                        "MAP_HEIGHT" => "465px",
                        "CONTROLS" => array(
                            0 => "ZOOM",
                        ),
                        "OPTIONS" => array(
                            0 => "ENABLE_SCROLL_ZOOM",
                        ),
                        "MAP_ID" => "yam_1",
                        "COMPONENT_TEMPLATE" => ".default",
                        "API_KEY" => "3d625650-3435-41ba-b29a-642573046647"
                    ),
                    false
                ); ?>

            </div>
        </div>
    </section>
    <section class="call-back">
        <div class="call-back__wrapper"><h2 class="call-back__title title title_h3">Заказать звонок</h2>
            <p class="call-back__notice">Заполните указанные поля и мы с Вами свяжемся!</p>

            <? $APPLICATION->IncludeComponent(
                "dvernik:main.feedback",
                "contact",
                array(
                    "USE_CAPTCHA" => "N",
                    "AJAX_MODE" => "Y",
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                    "EMAIL_TO" => "my@email.com",
                    "REQUIRED_FIELDS" => array(
                        0 => "NONE",
                    ),
                    "EVENT_MESSAGE_ID" => array(
                        0 => "7",
                    ),
                    "COMPONENT_TEMPLATE" => "contact"
                ),
                false
            ); ?>
        </div>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>