<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Как купить");
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

                        <h1>Как купить</h1>
                        <h3>1. Оформление заказа</h3>
                        <p>Выбранный вами товар отображается в корзине. Там же вы можете внести изменения в заказ:
                            увеличить или уменьшить количество позиций, отложить товар на будущее или удалить его из
                            списка.</p>
                        <p>Для оформления заказа, пожалуйста, заполните все необходимые поля - это нужно для того, чтобы
                            наш менеджер смог с вами связаться и проговорить детали, а также для отправки копии заказа
                            на вашу электронную почту.</p>
                        <p>Постоянным клиентам мы предлагаем зарегистрироваться на сайте, чтобы отслеживать и
                            контролировать статистику заказа товаров, подписаться на новостную рассылку, повторить заказ
                            или отказаться от него.</p>
                        <h3>2. Оплата</h3>
                        <p>Вы можете оплатить заказ наличными, в случае если забираете товар самостоятельно из
                            магазина.</p>
                        <p>В случае, если у вас нет возможности забрать его самостоятельно, вам доступно несколько опций
                            оплаты: банковской картой на сайте или наложенным платежом при получении.</p>
                        <p><img src="<?= SITE_TEMPLATE_PATH ?>/images/pay_logo.png" alt="" width="406" height="39"></p>
                        <h3>3.&nbsp;Возврат товара</h3>
                        <p>Процедура возврата товара регламентируется статьёй 26.1 федерального закона «О защите прав
                            потребителей» и выполняется в полном соответствии с ней.</p>
                        <h3>4.&nbsp;Отказ от услуги</h3>
                        <p>Право потребителя на расторжение договора об оказании услуги регламентируется статьей 32
                            федерального закона «О защите прав потребителей»</p>
                        <p>Возврат денежных средств при оплате банковской картой осуществляется в срок от 1 до 30
                            рабочих дней.</p>
                        <h3>5.&nbsp;Доставка</h3>
                        <p>Забрать заказ в Санкт-Петербурге после подтверждения менеджера интернет-магазина вы можете
                            самостоятельно, по адресу:</p>
                        <p>Санкт-Петербург, Левашовский проспект, д. 13А, м. «Чкаловская», тел.&nbsp;677-13-86</p>
                        <p><b>Время работы:</b> с 10:00 до 18:00 с пн-пт</p>
                        <p>Доставка заказа в другие города и регионы осуществляется транспортной компанией СДЭК, с
                            тарифами которой вы можете ознакомиться на соответствующем сайте.</p>
                        <p></p>
                        <h4>Правила</h4>
                        <p>При доставке Вам будут переданы все необходимые документы на покупку: товарный, кассовый
                            чеки, а также гарантийный талон.&nbsp;</p>
                        <p>При оформлении покупки на организацию, вам будут переданы счет-фактура, а также накладная, в
                            которой необходимо поставить печать Вашей организации.</p>
                        <p>Цена, указанная в переданных Вам транспортной компанией документах, является окончательной.&nbsp;Стоимость
                            доставки выделяется в документах на покупку отдельной графой.</p>
                        <p>Контакты</p>
                        <p></p>
                        <p><b>Режим работы:</b>&nbsp;с 10&nbsp;до 18 часов</p>
                        <p><b>Телефоны:</b>&nbsp; +7(812)677-13-86</p>
                        <p><b>E-mail:</b>&nbsp;tanya-style-spb@bk.ru</p>


                    </div>
                    <br>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>