<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
use Bitrix\Sale;
if ($USER->IsAuthorized()) {


echo '<script>
window.delivery = "'.$_SESSION["delivery"].'";
window.address = "'.$_SESSION["address"].'";
window.message = "'.$_SESSION["message"].'";
</script>';



    ?>
    <div class="columns-container">
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


                    <h1 class="page-heading">Сводка по заказу</h1>


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
                            <input type="hidden" name="confirm" value="1">
                            <h3 class="page-subheading">Оплата наличными при получении</h3>
                            <p>
                                - Вы выбрали оплату наличными при получении.
                                <br>
                                - Общая сумма вашего заказа
<?
/*стоимость доставки*/
$db_dtype = CSaleDelivery::GetList(
    array(
            "SORT" => "ASC",
        ),
    array(
            "LID" => SITE_ID,
            "ACTIVE" => "Y",
            "ID" => $_SESSION["delivery"]
        ),
    false,
    false,
    array()
);
if ($ar_dtype = $db_dtype->Fetch())
{

do
{    
    $delivPrice = $ar_dtype['PRICE'];
}
   while ($ar_dtype = $db_dtype->Fetch());
}


                                /*получаем сумму заказа (корзины)*/

                                $user = $USER->GetID();
                                $res = CSaleBasket::GetList(array(), array(
                                    "USER_ID" => $user,
                                    'LID' => SITE_ID,
                                    'ORDER_ID' => 'null',
                                    'DELAY' => 'N'
                                ));
									$i = 0;
                                while ($arItems = $res->Fetch()) {


                                    $allProductPrices = \Bitrix\Catalog\PriceTable::getList([
                                        "select" => ["*"],
                                        "filter" => [
                                            "=PRODUCT_ID" => $arItems['PRODUCT_ID'],
                                        ],
                                        "order" => ["CATALOG_GROUP_ID" => "ASC"]
                                    ])->fetchAll();

                                    /*получаем величину всех скидок на D7*/
                                    $arDiscounts = \CCatalogDiscount::GetDiscountByProduct(
                                        $arItems['PRODUCT_ID'],
                                        $USER->GetUserGroupArray(),
                                        "N",
                                        1,
                                        SITE_ID
                                    );

                                    if ($arDiscounts !== false) {
                                        $price = \CCatalogProduct::CountPriceWithDiscount(
                                            $allProductPrices[0]['PRICE'],
                                            $allProductPrices[0]['CURRENCY'],
                                            $arDiscounts
                                        );
                                    }

                                    $price = (integer)$price;
                                    $arItems['QUANTITY'] = (integer)$arItems['QUANTITY'];
                                    $allProductPrices[0]['PRICE'] = (integer)$allProductPrices[0]['PRICE'];
                                    $pr = $allProductPrices[0]['PRICE'] - $price;


                                    if ($pr > 0) {

                                        $cart_sum += $pr * $arItems['QUANTITY'];
                                        $ResPrice = $pr;
                                    } else { 	

                                        $cart_sum[$i] = $price * $arItems['QUANTITY'];

                                       $ResPrice = $price;

                                    }

                                        $resIT[$i] = [
                                            'PRODUCT_ID' => $arItems['PRODUCT_ID'],
                                            'PRODUCT_PROVIDER_CLASS' => '\Bitrix\Catalog\Product\CatalogProvider',
                                            'NAME' => $arItems['NAME'],
                                            'PRICE' => $ResPrice,
                                            'CURRENCY' => 'RUB',
                                            'QUANTITY' => $arItems['QUANTITY'],
                                        ];


										$i++;
                                }

                                $allSum = $delivPrice+$cart_sum; /*сумма заказа с учетом доставки*/
								echo $allSum.' руб (В том числе стоимость доставки: '.$delivPrice.' руб)';

                                ?>

                            </p>
                            <p>
                                <b>Пожалуйста, подтвердите ваш заказ, нажав на "Я подтверждаю заказ"..</b>
                            </p>
                        </div>

<? 
/*получаем свойства для передачи в заказ*/
$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

foreach ($basket as $basketItem) {

    $basketPropertyCollection = $basketItem->getPropertyCollection();
    $bas[] = $basketPropertyCollection->getPropertyValues();

}


$js_obj = json_encode($resIT);
print "<script language='javascript'>var obj=$js_obj;</script>";

$js_propord = json_encode($bas);
print "<script language='javascript'>var propord=$js_propord;</script>";
?>




                        <p class="cart_navigation" id="cart_navigation">
                            <a href="/personal/cart/step3/" class="button-exclusive btn btn-default"><i
                                        class="icon-chevron-left"></i>Другие способы оплаты</a>
                            <button type="submit" class="button btn btn-default button-medium">
                                <span class="endorder">Я подтверждаю заказ</span></button>
                        </p>
                   <!--  </form> -->
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>
<? } ?>

    <script>

         $(document).on('click', '.endorder', function () {

        	$.post('/local/templates/style-spb/ajax/order.php', {obj, delivery, message, address, propord}, function (data) {

            	location.replace('/personal/cart/step5/');
        	})

    	});
    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>