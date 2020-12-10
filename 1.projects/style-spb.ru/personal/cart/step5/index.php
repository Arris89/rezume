<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");

if ($USER->IsAuthorized()) {
    ?>
<div class="columns-container">
                <div id="columns" class="container">
                                            
<!-- Breadcrumb -->
<div class="breadcrumb clearfix">
    <a class="home" href="https://style-spb.ru/" title="На главную">Магазин пальто</a>
            <span class="navigation-pipe">&gt;</span>
                    Подтверждение заказа
            </div>
<!-- /Breadcrumb -->

                                        <div id="slider_row" class="row">
                                                                    </div>
                    <div class="row">
                                                                        <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
    

<h1 class="page-heading">Подтверждение заказа</h1>




    
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





<div class="box">
    <p>Ваш заказ в <span class="bold">STYLE NATIONAL CLUB</span> выполнен.
        <br>
        Вы выбрали оплату наличными при получении
        <br><span class="bold">Ваш заказ скоро будет отправлен.</span>
        <br>По любым вопросам или за дополнительной информацией обратитесь к нашей <a href="https://style-spb.ru/index.php?controller=contact-form">службе поддержки клиентов</a>.
    </p>
</div>
<p class="cart_navigation exclusive">
    <a class="button-exclusive btn btn-default" href="/personal/orders/" title="Перейти на страницу истории заказов"><i class="icon-chevron-left"></i>Просмотреть историю заказов</a>
</p>
                    </div><!-- #center_column -->
                                        </div><!-- .row -->
                </div><!-- #columns -->
            </div>

<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>