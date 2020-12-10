<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");

if ($USER->IsAuthorized()) {

session_start ();

 $_SESSION['delivery'] = $_POST['delivery'];
 
/*    echo $_SESSION["message"].' *****коммент <br>';
    echo $_SESSION["address"].' *****адрес <br>';
    echo $_SESSION["delivery"].' *****доставка  <br>';*/

    ?>
    <div id="columns" class="container">

        <!-- Breadcrumb -->
        <div class="breadcrumb clearfix">
                 <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","style",Array(
                    "START_FROM" => "0", 
                    "PATH" => "", 
                    "SITE_ID" => "s1" 
                    )
                    );?>
        </div>
        <!-- /Breadcrumb -->

        <div id="slider_row" class="row">
        </div>
        <div class="row">
            <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">


                <h1 class="page-heading">Выберите способ оплаты
           <!--          <span class="heading-counter">Ваша корзина содержит:
				<span id="summary_products_quantity">1 товар</span>
			</span> -->
                </h1>


                <!-- Steps -->
                <ul class="step clearfix" id="order_step">
                    <li class="step_done first">
                        <a href="/personal/cart/">
                            <em>01.</em> Сводка
                        </a>
                    </li>
                    <li class="step_done second">
                        <a href="javascript:void(0)">
                            <em>02.</em> Войти
                        </a>
                    </li>
                    <li class="step_done third">
                        <a href="/personal/cart/step/">
                            <em>03.</em> Адрес
                        </a>
                    </li>
                    <li class="step_done step_done_last four">
                        <a href="/personal/cart/step2/">
                            <em>04.</em> Доставка
                        </a>
                    </li>
                    <li id="step_end" class="step_current last">
                        <span><em>05.</em> Оплата</span>
                    </li>
                </ul>
                <!-- /Steps -->


                <div class="paiement_block">
                    <div id="HOOK_TOP_PAYMENT"></div>
                    <div id="order-detail-content" class="table_block table-responsive">

                    </div> <!-- end order-detail-content -->
                    <div id="HOOK_PAYMENT">
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="payment_module">
                                    <a class="cash" href="/personal/cart/step4/"
                                       title="Оплата наличными при получении" rel="nofollow">
                                        Оплата наличными при получении
                                        <span>(Вы оплачиваете покупку при получении (курьеру, или на пункте выдачи))</span>
                                    </a>
                                </p>
                            </div>
                        </div>
<!--                         <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="payment_module" id="paykeeper_payment_module">
                                    <a href="javascript:{}" onclick="document.getElementById('payment_form').submit();"
                                       title="Оплата картами Visa и MasterCard на сайте" class="paykeeper">
                                        Оплата картами Visa и MasterCard на сайте
                                        <br><br>
                                        <p><img src="/modules/paykeeper/logo.png"
                                                alt="Оплата картами Visa и MasterCard на сайте"></p>
                                    </a>
                                    <form id="payment_form" method="post"
                                          action="https://style-spb.server.paykeeper.ru/create/" accept_charset="utf-8">
                                    </form>
                                </div>
                            </div>

                        </div> -->
                        <p class="cart_navigation clearfix">
                            <a href="/" title="Назад"
                               class="button-exclusive btn btn-default">
                                <i class="icon-chevron-left"></i>
                                Продолжить покупки
                            </a>
                        </p>
                    </div> <!-- end HOOK_TOP_PAYMENT -->

                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>

<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>