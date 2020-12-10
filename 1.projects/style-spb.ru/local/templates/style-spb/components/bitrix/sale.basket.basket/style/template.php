<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

?>
<?
/*echo '<pre>'; 
print_r($arResult);
echo '<pre>';
*/

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


                <h1 id="cart_title" class="page-heading">Состояние корзины
                    <?if($arResult['GRID']['ROWS']){?>
                        <span class="heading-counter">Ваша корзина содержит:
			             <span id="summary_products_quantity">


<? echo $arResult['BASKET_ITEMS_COUNT'];
echo ' Товар' . ending($arResult['BASKET_ITEMS_COUNT'], '', 'а', 'ов');
?>
                            </span>
		          </span>
                    <?}?>
                </h1>


                <!-- Steps -->
                <ul class="step clearfix" id="order_step">
                    <li class="step_current  first">
                        <span><em>01.</em> Сводка</span>
                    </li>
                    <li class="step_todo second">
                        <span><em>02.</em> Войти</span>
                    </li>
                    <li class="step_todo third">
                        <span><em>03.</em> Адрес</span>
                    </li>
                    <li class="step_todo four">
                        <span><em>04.</em> Доставка</span>
                    </li>
                    <li id="step_end" class="step_todo last">
                        <span><em>05.</em> Оплата</span>
                    </li>
                </ul>
                <!-- /Steps -->

                <? if ($arResult['BASKET_ITEMS_COUNT'] == 0) { ?>

                    <p class="alert alert-warning">Корзина пуста.</p>

                <? } else { ?>


                    <div class="cart_last_product">
                        <div class="cart_last_product_header">
                            <div class="left">Последний добавленный товар</div>
                        </div>
                        <a class="cart_last_product_img"
                           href="https://style-spb.ru/home/152-palto-zhenskoe-demisezonnoe-1496.html">
                            <img src="https://style-spb.ru/895-small_default/palto-zhenskoe-demisezonnoe-1496.jpg"
                                 alt="Пальто женское демисезонное">
                        </a>
                        <div class="cart_last_product_content">
                            <p class="product-name">
                                <a href="">
                                    Пальто женское демисезонное
                                </a>
                            </p>
                            <small>
                                <a href="https://style-spb.ru/home/152-palto-zhenskoe-demisezonnoe-1496.html#/cvet-bezhevyj/razmer-44/rost-170">
                                    Размер : 44, Цвет : бежевый, Рост : 170
                                </a>
                            </small>
                        </div>
                    </div>


                    <div id="order-detail-content" class="table_block table-responsive">
                        <table id="cart_summary" class="table table-bordered stock-management-on">
                            <thead>
                            <tr>
                                <th class="cart_product first_item">Товар</th>
                                <th class="cart_description item">Описание</th>
                                <th class="cart_avail item text-center">Наличие</th>
                                <th class="cart_unit item text-right">Цена</th>
                                <th class="cart_quantity item text-center">Кол-во</th>
                                <th class="cart_delete last_item">&nbsp;</th>
                                <th class="cart_total item text-right">Итого, к оплате:</th>
                            </tr>
                            </thead>
                            <tfoot>


                            <tr class="cart_total_price precoup">
                                <td rowspan="3" colspan="2" id="cart_voucher" class="cart_voucher">
                                    <!--      <form action="https://style-spb.ru/order" method="post" id="voucher"> -->
                                    <fieldset>
                                        <h4>Купоны</h4>
                                        <input type="text" class="discount_name form-control" id="discount_name"
                                               name="discount_name" value="">
                                        <input type="hidden" name="submitDiscount">
                                        <button type="submit" name="submitAddDiscount"
                                                class="button btn btn-default button-small">
                                            <span class="coupon">ОК</span>
                                        </button>
                                    </fieldset>
                                    <!--   </form> -->
                                </td>
                                <td colspan="3" class="text-right">Стоимость:</td>
                                <td colspan="2" class="price" id="total_product"><?=$arResult["allSum_FORMATED"]?></td>
                            </tr>

                            <? if(!empty($arResult['DISCOUNT_PRICE_ALL'])) {?>
                                <tr class="cart_total_voucher">
                                    <td colspan="3" class="text-right">
                                        Итого скидка:
                                    </td>
                                    <td colspan="2" class="price-discount price" id="total_discount">
                                        <?=$arResult['DISCOUNT_PRICE_ALL'];?> руб.
                                    </td>
                                </tr>
                            <?}?>

                            <tr style="display: none;">
                                <td colspan="3" class="text-right">
                                    Итого за подарочную упаковку
                                </td>
                                <td colspan="2" class="price-discount price" id="total_wrapping">0 руб</td>
                            </tr>
                            <tr class="cart_total_delivery unvisible" style="display: none;">
                                <td colspan="3" class="text-right">Стоимость доставки</td>
                                <td colspan="2" class="price" id="total_shipping">Бесплатная доставка!</td>
                            </tr>

                            <tr class="cart_total_price">
                                <td colspan="3" class="total_price_container text-right">
                                    <span>Итого, к оплате:</span>
                                    <div class="hookDisplayProductPriceBlock-price">

                                    </div>
                                </td>
                                <td colspan="2" class="price" id="total_price_container">
                                    <span id="total_price"><?=$arResult["allSum_FORMATED"]?></span>
                                </td>
                            </tr>
                            </tfoot>
                            <tbody>

                            <?
                            foreach ($arResult['GRID']['ROWS'] as $key => $value) {

                                $IDcat = \IbHelp\Helper::getIblockIdByCodes('clothes')["clothes"];
                                $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
                                $arFilter = Array("IBLOCK_ID"=> $IDcat, "ACTIVE"=>"Y", "ID"=> $value['PRODUCT_ID']);
                                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                                while($ob = $res->GetNextElement())
                                {
                                    $arFields = $ob->GetFields();
                                    $arProps = $ob->GetProperties();
                                    $rsFile = CFile::GetByID($arProps['MORE_PHOTO']['VALUE'][0]);
                                    $arFile = $rsFile->Fetch();
                                    $href = "upload/".$arFile['SUBDIR']."/".$arFile['FILE_NAME']."";

                                } ?>
                                <tr id="<?=$value['ID']?>" class="cart_item last_item address_0 even first_item">
                                    <td class="cart_product">
                                        <a href="<?=$arFields['DETAIL_PAGE_URL']?>">
                                            <img
                                                    src="/<?=$href?>"
                                                    alt=" <?=$value['NAME']?> " width="78" height="98"></a>
                                    </td>
                                    <td class="cart_description">
                                        <p class="product-name">
                                            <a href="<?=$arFields['DETAIL_PAGE_URL']?>">
                                                <?=$value['NAME']?>
                                            </a>
                                        </p>
                                        <small class="cart_ref">
                                            Артикул : <?=$value['PROPERTY_ARTNUMBER_VALUE']?>
                                        </small>
                                        <small>
                                            <a href="<?=$arFields['DETAIL_PAGE_URL']?>">Размер
                                                : <?=$value['PROPS'][0]['VALUE']?>, <!-- Цвет : <?=$value['PROPERTY_COLOR_VALUE']?> -->, Рост : <?=$value['PROPS'][1]['VALUE']?></a></small>
                                    </td>
                                    <td class="cart_avail">
                                        <span class="label label-success">в наличии</span>
                                    </td>
                                    <td class="cart_unit" data-title="Цена">
                                        <ul class="price text-right" id="product_price_152_1714_0">
                                            <li class="price"><?=$value['PRICE']?> руб</li>
                                        </ul>
                                    </td>

                                    <td class="cart_quantity text-center" data-title="Количество">

                                        <input type="hidden" value="1" name="quantity_152_1714_0_0_hidden">
                                        <input size="2" type="text" autocomplete="off"
                                               class="cart_quantity_input form-control grey"
                                               value="<?=$value['QUANTITY']?>"
                                               name="quantity" id="k<?=$value['PRODUCT_ID']?>">
                                        <div class="cart_quantity_button clearfix">
                                            <a rel="nofollow" class="cart_quantity_down btn btn-default button-minus"
                                               id="cart_quantity_down_152_1714_0_0"
                                               href="javascript:void(0)"
                                               title="Убрать">
                                                <?



                                                ?>
                                                <span><i class="icon-minus" data-id="<?=$value['PRODUCT_ID']?>" data-price="<?=$value['PRICE']?>" data-val="<?=$value['QUANTITY']?>" data-sum="<?=$value['SUM_VALUE']?>" basket_id="<?=$value['ID']?>"></i></span>
                                            </a>
                                            <a rel="nofollow" class="cart_quantity_up btn btn-default button-plus"
                                               id="cart_quantity_up_152_1714_0_0"
                                               href="javascript:void(0)"
                                               title="Добавить">
                                         <span>
                                            <i class="icon-plus" data-id="<?=$value['PRODUCT_ID']?>" data-price="<?=$value['PRICE']?>" data-val="<?=$value['QUANTITY']?>" data-sum="<?=$value['SUM_VALUE']?>" basket_id="<?=$value['ID']?>">
                                            </i>
                                        </span>
                                            </a>
                                        </div>
                                    </td>

                                    <td class="cart_delete text-center" data-title="Удалить">
                                        <div>
                                            <a rel="nofollow" title="Удалить" class="cart_quantity_delete" data-id="<?=$value['ID']?>">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="cart_total" data-title="Итого, к оплате:">
                                    <span class="price full" data-s="<?=$value['SUM_VALUE']?>" id="s<?=$value['PRODUCT_ID']?>">
                                        <?=$value['SUM']?>
                                    </span>
                                    </td>

                                </tr>
                            <?}?>

                            </tbody>

                        </table>
                    </div> <!-- end order-detail-content -->


                    <?if($USER->IsAuthorized()){

                        $us = $USER->GetID();
                        $rsUser = CUser::GetByID($us);
                        $arUser = $rsUser->Fetch();


                        if (CModule::IncludeModule('highloadblock')) {

                            $ID = 5; // ИД справочника

                            $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

                            $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                            $entity_data_class = $hlentity->getDataClass();

                            $result = $entity_data_class::getList(array(
                                "select" => array("UF_USER","UF_CITY","UF_INDEX","UF_PHONE","UF_COUNTRY","UF_STREET","UF_COMPANY","UF_FIO"), // Поля для выборки
                                "order" => array(),
                                "filter" => array("UF_USER"=>$arUser['ID']),
                            ));
                            $i = 0;
                            while ($resds = $result->fetch()) {
                                if($i==0){
                                    ?>

                                    <div class="order_delivery clearfix row">
                                        <div class="col-xs-12 col-sm-6">
                                            <ul class="address first_item item box">
                                                <li>
                                                    <h3 class="page-subheading">
                                                        Адрес доставки
                                                    </h3>
                                                </li>
                                                <li><span class="address_name"><?=$resds["UF_FIO"]?></span>
                                                </li>
                                                <li><span class="address_address1"><?=$resds["UF_STREET"]?></span>
                                                </li>
                                                <li><span class=""><?=$resds["UF_INDEX"]?> <?=$resds["UF_CITY"]?></span>
                                                </li>
                                                <li><span class=""><?=$resds["UF_COUNTRY"]?></span>
                                                </li>
                                                <li><span class="address_phone"><?=$resds["UF_PHONE"]?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                <? }

                                $i++;}

                        }

                        ?>



                    <?}?>

                    <div id="HOOK_SHOPPING_CART"></div>
                    <p class="cart_navigation clearfix">
                        <a href="/personal/cart/step/"
                           class="button btn btn-default standard-checkout button-medium" title="Перейти к оформлению"
                           style="">
                            <span>Перейти к оформлению<i class="icon-chevron-right right"></i></span>
                        </a>
                        <a href="/" class="button-exclusive btn btn-default" title="Продолжить покупки">
                            <i class="icon-chevron-left"></i>Продолжить покупки
                        </a>
                    </p>
                    <div class="clear"></div>
                    <div class="cart_navigation_extra">
                        <div id="HOOK_SHOPPING_CART_EXTRA"></div>
                    </div>
                <? } ?>
            </div><!-- #center_column -->
            <!-- .row -->
        </div>
    </div><!-- #columns -->
</div>

<script>

    /*удаление товара*/
    $(document).on('click', '.cart_quantity_delete', function () {
        var del = $(this).attr('data-id');
        $('#'+del+'').remove(); /*удаление товара в корзине*/
        $('[it-id='+del+']').remove(); /*удаление товара в хедере*/
        $.post('/local/templates/style-spb/ajax/basketdel.php', {del}, function (data) {
            var datad = JSON.parse(data);


            var itemsum;
            $('body').find('.price.full').each(function(){

                var itemcount = $(this).attr('data-s');
                /*        alert(itemcount);*/
                itemcount = parseFloat(itemcount);
                itemsum =+ itemcount;


                $('#total_product').text(''+itemsum+' руб.');
                $('#total_price').text(''+itemsum+' руб.');

            });


            /*alert(datad.num);*/
            if(datad.num == 0)
            {
                $('.table_block.table-responsive').remove();
                $('.order_delivery').remove();
                $('.cart_navigation.clearfix').remove();
                $('.heading-counter').remove();
                $('.step.clearfix').after('<p class="alert alert-warning">Корзина пуста.</p>');
                $('.cart_block.block.exclusive').remove(); /*удаление блока в хедере*/
                $('.ajax_cart_no_product').text('(пусто)');
            }
        })
    });



    /*Нажатие на плюс для товара*/
    $(document).on('click', '.icon-plus', function () {


        var id = $(this).attr('data-id');
        var basket_id = $(this).attr('basket_id');
        var price = $(this).attr('data-price');
        var price = parseInt(price);
        var val = $(this).attr('data-val');
        var val = parseInt(val);
        var sum = $(this).attr('data-sum');
        var sum = parseInt(sum);

        console.log(price, 'цена');
        console.log(val, 'число');
        console.log(sum, 'общая сумма');

        var newval = val+1;
        var newsum = sum+price;
        console.log(newval, 'новое число');
        console.log(newsum, 'новая общая сумма');


        $.post('/local/templates/style-spb/ajax/basketupdate.php', {id, newval, basket_id}, function (data) {

        });


        $(".icon-minus[data-id="+id+"]").attr('data-val', newval);
        $(".icon-minus[data-id="+id+"]").attr('data-sum', newsum);

        var val = $(this).attr('data-val');

        $(this).attr('data-sum', newsum);
        $(this).attr('data-val', newval);


        $('#s'+id+'').text(''+newsum+' руб.');
        $('#s'+id+'').attr('data-s', newsum);



        $('#k'+id+'').val(newval); //смена количества


        var itemsum = 0;
        $('body').find('.price.full').each(function(){

            var itemcount = $(this).attr('data-s');
            /*        alert(itemcount);*/
            itemcount = parseFloat(itemcount);
            itemsum += itemcount;

            $('#total_product').text(''+itemsum+' руб.');
            $('#total_price').text(''+itemsum+' руб.');

        });
        console.log(itemsum, 'новая сумма всей корзины');

    });




    /*Нажатие на минус для товара*/
    $(document).on('click', '.icon-minus', function () {
        var val = $(this).attr('data-val');
        var val = parseInt(val);
        if(val>1){

            var id = $(this).attr('data-id');
            var basket_id = $(this).attr('basket_id');
            var price = $(this).attr('data-price');
            var price = parseInt(price);

            var sum = $(this).attr('data-sum');
            var sum = parseInt(sum);

            console.log(price);
            console.log(val);
            console.log(sum);

            var newval = val-1;
            var newsum = sum-price;
            console.log(newval);
            console.log(newsum);

            $.post('/local/templates/style-spb/ajax/basketupdate.php', {id, newval, basket_id}, function (data) {

            });


            $(".icon-plus[data-id="+id+"]").attr('data-val', newval);
            $(".icon-plus[data-id="+id+"]").attr('data-sum', newsum);

            var val = $(this).attr('data-val');

            $(this).attr('data-sum', newsum);
            $(this).attr('data-val', newval);


            $('#s'+id+'').text(''+newsum+' руб.');
            $('#s'+id+'').attr('data-s', newsum);



            $('#k'+id+'').val(newval); //смена количества


            var itemsum = 0;
            $('body').find('.price.full').each(function(){

                var itemcount = $(this).attr('data-s');
                /*        alert(itemcount);*/
                itemcount = parseFloat(itemcount);
                itemsum += itemcount;

                console.log(itemsum);

                $('#total_product').text(''+itemsum+' руб.');
                $('#total_price').text(''+itemsum+' руб.');

            });

        }
    });


    /*применение купона*/
    $(document).on('click', '.coupon', function () {

        var code = $('#discount_name').val();
        /*       alert(code);*/

        $.post('/local/templates/style-spb/ajax/coupon.php', {code}, function (data) {
            /*                var datad = JSON.parse(data);
             alert(datad);
             var htmlcopon =  `<tr class="cart_total_voucher">
             <td colspan="3" class="text-right">
             Итого купонов:
             </td>
             <td colspan="2" class="price-discount price" id="total_discount">
             ${datad[0]}
             </td>
             </tr>`;
             $('.cart_total_price.precoup').after(htmlcopon);


             $('#total_price').text(''+datad[1]+' руб.');*/
            location.reload();
        })

    });
</script>
