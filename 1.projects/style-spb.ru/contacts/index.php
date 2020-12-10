<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
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

            <div id="slider_row" class="row">
            </div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
                    <div class="rte">

                        <h1>Контакты</h1>
                        <p><b><br>Телефон бесплатный по России:&nbsp;</b><a href="tel:88005050517">8 800 505 05 17</a>
                        </p>
                        <p><strong>Телефоны в Санкт-Петербурге:&nbsp;</strong><a href="tel:88126771386">8 (812)
                                677-13-86</a>, <a href="tel:88126770730">8 (812)&nbsp;677-07-30</a></p>
                        <p><strong>Время работы:</strong> Пн-Пт с 10:00 до 18:00</p>
                        <p><strong>Адрес:</strong> 197110, г. Санкт-Петербург, Левашовский пр., д. 13 лит. А офис 131
                        </p>
                        <p><strong>Email: <a href="mailto:info@style-spb.ru">info@style-spb.ru</a></strong></p>
                        <h3><span style="text-decoration: underline; color: #2445a2;"><a href="/contact-us/"><span
                                            style="color: #2445a2; text-decoration: underline;">Напишите нам</span></a></span>
                        </h3>


                        <? $APPLICATION->IncludeComponent(
                            "bitrix:map.yandex.view",
                            ".default",
                            array(
                                "INIT_MAP_TYPE" => "MAP",
                                "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:59.96672632865569;s:10:\"yandex_lon\";d:30.286268010139455;s:12:\"yandex_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:30.286268010139455;s:3:\"LAT\";d:59.966726328664684;s:4:\"TEXT\";s:0:\"\";}}}",
                                "MAP_WIDTH" => "100%",
                                "MAP_HEIGHT" => "400",
                                "CONTROLS" => array(
                                    0 => "ZOOM",
                                    1 => "SMALLZOOM",
                                ),
                                "OPTIONS" => array(
                                    0 => "ENABLE_SCROLL_ZOOM",
                                    1 => "ENABLE_DBLCLICK_ZOOM",
                                    2 => "ENABLE_DRAGGING",
                                ),
                                "MAP_ID" => "yam_1",
                                "COMPONENT_TEMPLATE" => ".default",
                                "API_KEY" => ""
                            ),
                            false
                        ); ?>


                        <p></p>
                        <table style="width: 100%; margin-left: auto; margin-right: auto;" cellspacing="2"
                               cellpadding="2">
                            <tbody>
                            <tr>
                                <td>
                                    <h3><strong>Оптовые продажи (пальто):</strong></h3>
                                </td>
                                <td>
                                    <h3><strong>Отдел розницы:</strong></h3>
                                </td>
                                <td>
                                    <h3><strong>Интернет-магазин:&nbsp;</strong></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>8 (999) 534-92-53, 8 (812) 677-13-86</p>
                                    <p>e-mail: <a href="mailto:info@style-spb.ru">info@style-spb.ru</a></p>
                                </td>
                                <td>
                                    <p>8 (812)&nbsp;677-13-86&nbsp;</p>
                                    <p>e-mail: <a href="mailto:info@style-spb.ru">info@style-spb.ru</a></p>
                                </td>
                                <td>
                                    <p>8 (800) 505-05-17 (бесплатный звонок по России)</p>
                                    <p>8 (812) 677-13-86, 8 (911) 949-82-73</p>
                                    <p><a href="https://style-spb.ru/" title="Интернет-магазин одежды Style National"
                                          target="_blank"><span style="color: #2445a2; text-decoration: underline;">http://style-spb.ru</span></a>
                                    </p>
                                    <p>e-mail: <a href="mailto:info@style-spb.ru">info@style-spb.ru</a></p>
                                    <p>Осуществляем поставки&nbsp;по всей России.</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p></p>
                        <h3><a href="/upload/SoleTrader.pdf"><span style="color: #2445a2; text-decoration: underline;">Скачать реквизиты</span></a>
                        </h3>
                        <p></p>
                        <h3>ОПТОВИКАМ</h3>
                        <p>Хотите продавать стильную деловую одежду в своем магазине? Мы открыты к сотрудничеству!
                            <strong>«Style&nbsp;Natstyle-sional»</strong> станет не только стабильным источником
                            качественного и востребованного товара, но и экспертом, транслирующим классическую моду
                            через ваш бизнес. Непревзойденная классика быстро найдет своего покупателя – того, кто ценит
                            красоту, практичность и элегантность. В ассортименте пальто, платья, брюки и блузы, жакеты,
                            изделия из трикотажа для любого возраста и типа фигуры.</p>
                        <p>Мы предлагаем сотрудничество коммерческим организациям из любого региона России – налаженная
                            логистика гарантирует своевременные поставки. Условия сотрудничества формируются
                            индивидуально, с учетом потребностей конкретного магазина. Для партнеров действует система
                            лояльности: скидки, возможность участия в заказе новых коллекций. Мы предлагаем надежное
                            партнерство, внимание и заботу о представителях бренда. Доставка по Санкт-Петербургу и
                            Москве, а также фирменная упаковка - бесплатно!</p>
                        <h3><a href="/contact-us/"><span style="color: #2445a2; text-decoration: underline;">Форма заявки для обратной связи</span></a>
                        </h3>
                        <p></p>
                        <p><strong>Контакты:</strong></p>
                        <p>197110, Санкт-Петербург, Левашовский пр. д. 13, лит. А</p>
                        <p><b>Оптовые продажи:</b></p>
                        <p>+7 (812) 677-13-86, +7 (999) 534-92-53</p>
                        <p><a href="mailto:info@style-spb.ru">Оптовый отдел</a></p>
                        <p><b>Вопросы по сотрудничеству:</b></p>
                        <p>+7 (812) 677-13-86, +7 (911) 949-82-73</p>
                        <p><a href="mailto:tanya-style-spb@bk.ru">Вопросы по сотрудничеству</a></p>
                        <p></p>

                        <h3>ПРИГЛАШАЕМ ВАС К СОТРУДНИЧЕСТВУ</h3>
                        <p>Для того, чтобы стать нашим <strong>партнером</strong> — Вам необходимо отправить заявку.</p>
                        <p>Наш менеджер обязательно с Вами свяжется и обсудит все условия сотрудничества.</p>


                        <? $APPLICATION->IncludeComponent("style:main.feedback", "contacts", Array(
                                "USE_CAPTCHA" => "N",
                                "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                                "EMAIL_TO" => "my@email.com",
                                "REQUIRED_FIELDS" => Array("NAME"),
                                "EVENT_MESSAGE_ID" => Array("5")
                            )
                        ); ?>

                    </div>
                    <br>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>