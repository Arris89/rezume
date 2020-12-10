<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>


    <div class="checkout">
        <div class="basket-wrap basket-order">
            <div class="title"><h2>Оформление заказа</h2></div>
            <div class="separate-line-order"></div>

            <div id="checkout-result" style="">
                <div class="container">
                    <div class="buy-success-box">
                        <strong>Ваш заказ № <span id="ordernum"></span> успешно оформлен</strong>
                        <p>Менеджер свяжется с вами в ближайшее время.</p>
                        <p>Вы можете отслеживать статус заказа<br>
                            в <a href="/personal/orders/">личном кабинете</a>.</p>
                        <a href="/catalog/" class="return">Вернуться в каталог<span></span></a>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#ordernum').append(''+name+'');
    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>