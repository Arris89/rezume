<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */


?>


<div class="row">
    <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
        <div itemscope="" itemtype="https://schema.org/Product" style="margin-left: 20px;
    margin-right: 20px;">
            <div class="primary_block row">
                <div class="container">
                    <div class="top-hr"></div>
                </div>

                <!-- left infos-->
                <div class="pb-left-column col-xs-12 col-sm-4 col-md-5">
                    <div id="image-block" class="clearfix">
                  <span class="new-box">
                    <span class="new-label">Новое</span>
                </span>
                        <span id="view_full_size" class="single-slide">
                <? foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $value) {
                    $rsFile = CFile::GetByID($value);
                    $arFile = $rsFile->Fetch();
                    $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . "";
                    ?>
                    <img itemprop="image" src="/<?= $href ?>"/>
                <? } ?>
            </span>
                    </div>
                    <div id="views_block" class="clearfix ">
                        <div id="thumbs_list">
                            <ul class="multiple-items">
                                <? $i = 0;
                                foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $value) {
                                    $rsFile = CFile::GetByID($value);
                                    $arFile = $rsFile->Fetch();
                                    $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . "";
                                    if ($i == 0) {
                                        $modImg = $href;
                                    }
                                    ?>
                                    <li>
                                        <a>
                                            <img class="img-responsive" src="/<?= $href ?>" height="80" width="80"
                                                 itemprop="image"/>
                                        </a>
                                    </li>
                                    <? $i++;
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- center infos -->
                <div class="pb-center-column col-xs-12 col-sm-4">
                    <h1 itemprop="name"><?= $arResult['NAME'] ?></h1>

                    <? if ($arResult['PROPERTIES']['ARTNUMBER']['VALUE']) { ?>
                        <p id="product_reference">
                            <label>Артикул </label>
                            <span class="editable" itemprop="sku">
                                <?= $arResult['PROPERTIES']['ARTNUMBER']['VALUE'] ?>
                            </span>
                        </p>
                    <? } ?>

                    <div id="short_description_block">
                        <div id="short_description_content" class="rte align_justify" itemprop="description">

                            <? if ($arResult['PROPERTIES']['COLOR']['VALUE']) { ?>
                                <p>
                                    <?
                                    if (CModule::IncludeModule('highloadblock')) {

                                        $ID = 4; /* ID справочника*/

                                        $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

                                        $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                                        $entity_data_class = $hlentity->getDataClass();

                                        $result = $entity_data_class::getList(array(
                                            "select" => array("UF_NAME", "UF_LINK"), // Поля для выборки
                                            "order" => array(),
                                            "filter" => array("UF_XML_ID" => $arResult['PROPERTIES']['COLOR']['VALUE']),
                                        ));

                                        while ($resds = $result->fetch()) {
                                            $itemColor = $resds["UF_NAME"];
                                            $itemColorCode = $resds["UF_LINK"];
                                        }
                                    } ?>

                                    Цвет:<?= $itemColor ?>
                                </p>
                            <? } ?>

                            <? if ($arResult['PROPERTIES']['SOSTAV']['VALUE']) { ?>
                                <p>Состав:<?= $arResult['PROPERTIES']['SOSTAV']['VALUE'] ?></p>
                            <? } ?>
                        </div>


                        <p class="buttons_bottom_block">
                            <a href="javascript:{}" class="button">
                                Подробнее
                            </a>
                        </p>
                        <!---->
                    </div> <!-- end short_description_block -->
                    <!-- availability or doesntExist -->
                    <? if ($arResult['CATALOG_QUANTITY'] > 10) { ?>
                        <p id="availability_statut" style="">
                            <span id="availability_value" class="label label-success">в наличии</span>
                        </p>
                        <?
                    } elseif (($arResult['CATALOG_QUANTITY'] < 10) && ($arResult['CATALOG_QUANTITY'] > 0)) {
                        ?>
                        <p class="warning_inline" id="last_quantities" style="">Внимание: ограниченное количество товара
                            в наличии!</p>
                    <? } elseif (!empty($arResult['PROPERTIES']['SKLAD']['VALUE'])) { ?>
                        <p id="availability_date">
                            <span id="availability_date_label">Будет доступен:</span>
                            <span id="availability_date_value">
                           <?= $arResult['PROPERTIES']['SKLAD']['VALUE']; ?>
                        </span>
                        </p>
                    <? } elseif ($arResult['CATALOG_QUANTITY'] == 0) { ?>

                        <p id="availability_statut">

                            <span id="availability_value" class="label label-danger label-warning">Данная модификация отсутствует. Пожалуйста, выберите другую.</span>
                        </p>
                    <?
                    }
                    ?>

                    <p class="warning_inline" id="last_quantities" style="display: none;">Внимание: ограниченное
                        количество товара в наличии!</p>
                    <p id="availability_date" style="display: none;">
                        <span id="availability_date_label">Будет доступен:</span>
                        <span id="availability_date_value"></span>
                    </p>
                    <!-- Out of stock hook -->
                    <div id="oosHook" style="display: none;">
                        <!-- MODULE MailAlerts -->
                        <p class="form-group">
                            <input type="text" id="oos_customer_email" name="customer_email" size="20"
                                   value="your@email.com" class="mailalerts_oos_email form-control">
                        </p>
                        <a href="#" title="Notify me when available" id="mailalert_link" rel="nofollow">Notify me
                            when available</a>
                        <span id="oos_customer_email_result" style="display:none; display: block;"></span>

                        <!-- END : MODULE MailAlerts -->
                    </div>
                    <!-- More info -->
                    <section class="page-product-box">
                        <div class="h3 page-product-heading">Описание</div>
                        <!-- full description -->
                        <div class="rte">
                            <?= $arResult['DETAIL_TEXT']; ?>
                        </div>
                    </section>
                    <!--end  More info -->
                    <!-- usefull links-->
                    <ul id="usefull_link_block" class="clearfix no-print">
                    </ul>
                </div>
                <!-- end center infos-->
                <!-- pb-right-column-->
                <div class="pb-right-column col-xs-12 col-sm-4 col-md-3">
                    <!-- add to cart form-->

                    <div class="box-info-product">
                        <div class="content_prices clearfix">
                            <!-- prices -->
                            <div>
                                <p class="our_price_display" itemprop="offers" itemscope=""
                                   itemtype="https://schema.org/Offer">
                                    <link itemprop="availability" href="https://schema.org/InStock">
                                    <span id="our_price_display" class="price" itemprop="price">
                                            <span class="pricval"><?= $arResult['ITEM_PRICES']['0']['BASE_PRICE'] ?></span> руб
                                        </span>
                                    <meta itemprop="priceCurrency" content="RUB">
                                </p>
                                <p id="reduction_percent" style="display:none;"><span
                                            id="reduction_percent_display"></span></p>
                                <p id="reduction_amount" style="display:none"><span
                                            id="reduction_amount_display"></span></p>
                                <p id="old_price" class="hidden" style="display: none;"><span
                                            id="old_price_display" style="display: none;"><span
                                                class="price"></span></span></p>
                            </div> <!-- end prices -->


                            <div class="clear"></div>
                        </div> <!-- end content_prices -->
                        <div class="product_attributes clearfix">
                            <!-- quantity wanted -->
                            <p id="quantity_wanted_p">
                                <label for="quantity_wanted">Количество</label>
                                <input type="number" min="1" name="qty" id="quantity_wanted" class="text"
                                       value="1">
                                <a href="#" data-field-qty="qty"
                                   class="btn btn-default button-minus product_quantity_down">
                                    <span class="itminus" data-minus="1"><i class="icon-minus"
                                                                            data-minus="1"></i></span>
                                </a>
                                <a href="#" data-field-qty="qty"
                                   class="btn btn-default button-plus product_quantity_up">
                                    <span class="itplus" data-plus="1"><i class="icon-plus" data-plus="1"></i></span>
                                </a>
                                <span class="clearfix"></span>
                            </p>
                            <!-- minimal quantity wanted -->
                            <p id="minimal_quantity_wanted_p" style="display: none;">
                                Минимальный заказ для товара <b id="minimal_quantity_label">1</b>
                            </p>
                            <!-- attributes -->
                            <div id="attributes">
                                <div class="clearfix"></div>
                                <? if ($arResult['PROPERTIES']['RAZMER']['VALUE']) { ?>
                                    <fieldset class="attribute_fieldset razmerblock" id="razmerblock">
                                        <label class="attribute_label">Размер&nbsp;</label>
                                        <div class="attribute_list">
                                            <ul>
                                                <?
                                                $keys = array_keys($arResult['PROPERTIES']['RAZMER']['VALUE']);
                                                foreach ($arResult['PROPERTIES']['RAZMER']['VALUE'] as $key => $value) {
                                                    if ($keys[0] === $key) { ?>
                                                        <li>
                                                            <div class="radio">
                            <span class="razm checked">
                            <input type="radio" class="attribute_radio razmer" name="group_1" data-raz="<?= $value ?>"
                                   value="<?= $value ?>"
                                   checked="checked">
                              </span>

                                                                <?
                                                                $us_rm = $value;
                                                                echo "<script>
window.razmer = $us_rm;
</script>";
                                                                ?>

                                                            </div>
                                                            <span><?= $value ?></span>
                                                        </li>
                                                    <? } else { ?>
                                                        <li>
                                                            <div class="radio">
                            <span class="razm">
                                 <input type="radio" class="attribute_radio razmer" name="group_1"
                                        data-raz="<?= $value ?>" value="<?= $value ?>">
                              </span>
                                                            </div>
                                                            <span><?= $value ?></span>
                                                        </li>
                                                    <? }
                                                } ?>
                                            </ul>
                                        </div> <!-- end attribute_list -->
                                    </fieldset>
                                <? } ?>
                                <? if ($itemColorCode) { ?>
                                    <fieldset class="attribute_fieldset">
                                        <label class="attribute_label">Цвет&nbsp;</label>
                                        <div class="attribute_list">
                                            <ul id="color_to_pick_list" class="clearfix">

                                                <li class="selected">
                                                    <a href="#"
                                                       name="зеленый" class="color_pick selected"
                                                       style="background:#<?= $itemColorCode ?>;" title="зеленый">
                                                    </a>
                                                </li>

                                            </ul>
                                            <input type="hidden" class="color_pick_hidden" name="group_3"
                                                   value="89">
                                        </div>
                                    </fieldset>
                                <? } ?>

                                <? if ($arResult['PROPERTIES']['ROST']['VALUE']) { ?>
                                    <fieldset class="attribute_fieldset rostblock" id="rostblock">
                                        <label class="attribute_label">Рост&nbsp;</label>
                                        <div class="attribute_list">
                                            <ul>
                                                <?
                                                $keys = array_keys($arResult['PROPERTIES']['ROST']['VALUE']);
                                                foreach ($arResult['PROPERTIES']['ROST']['VALUE'] as $key => $value) {
                                                    if ($keys[0] === $key) { ?>
                                                        <li>
                                                            <div class="radio">
                                        <span class="checked">
           <input type="radio" class="attribute_radio rost" name="group_4" value="<?= $value ?>"
                  data-rost="<?= $value ?>" checked="checked">
                                        </span>
                                                                <?
                                                                $us_id = $value;
                                                                echo "<script>
window.rost = $us_id;
</script>";
                                                                ?>
                                                            </div>
                                                            <span><?= $value ?></span>
                                                        </li>
                                                    <? } else { ?>
                                                        <li>
                                                            <div class="radio">
                                        <span>
           <input type="radio" class="attribute_radio rost" name="group_4" value="<?= $value ?>"
                  data-rost="<?= $value ?>">
                                        </span>
                                                            </div>
                                                            <span><?= $value ?></span>
                                                        </li>
                                                    <? }
                                                } ?>
                                            </ul>
                                        </div> <!-- end attribute_list -->
                                    </fieldset>
                                <? } ?>
                            </div> <!-- end attributes -->
                        </div> <!-- end product_attributes -->
                        <div class="box-cart-bottom">
                            <div>

                                <p class="buttons_bottom_block no-print" data-id="<?= $arResult['ID'] ?>">
                                    <button type="submit" class="exclusive">
                                        <span>В корзину</span>
                                    </button>
                                </p>
                            </div>

                            <!-- Productpaymentlogos module -->
                            <div id="product_payment_logos">
                                <div class="box-security">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/oplata.jpg"
                                         alt="" class="img-responsive">
                                </div>
                            </div>
                            <!-- /Productpaymentlogos module -->
                        </div> <!-- end box-cart-bottom -->

                    </div> <!-- end box-info-product -->

                </div>


            </div> <!-- end primary_block -->
            <!--HOOK_PRODUCT_TAB -->
            <section class="page-product-box">

            </section>
            <!--end HOOK_PRODUCT_TAB -->
            <!-- description & features -->
        </div> <!-- itemscope product wrapper -->

    </div>

    <section class="page-product-box">

    </section>

    <div id="layer_cart" style="top: 100px; display: none;">
        <div class="clearfix">
            <div class="layer_cart_product col-xs-12 col-md-6">
                <span class="cross" title="Закрыть окно"></span>
                <span class="title">
                    <i class="icon-check"></i>Товар добавлен в корзину
                </span>
                <div class="product-image-container layer_cart_img">
                    <img class="layer_cart_img img-responsive" src="/<?= $modImg ?>" alt="<?= $arResult['NAME']; ?>"
                         title="<?= $arResult['NAME']; ?>">
                </div>
                <div class="layer_cart_product_info">
                    <span id="layer_cart_product_title" class="product-name"><?= $arResult['NAME']; ?></span>
                    <span id="layer_cart_product_attributes">
                <span id="razmod"></span>, <? if (!empty($itemColor)) {
                            echo $itemColor . ', ';
                        } ?> <span id="rostmod"></span>
            </span>
                    <div>
                        <strong class="dark">Количество</strong>
                        <span id="layer_cart_product_quantity">1</span>
                    </div>
                    <div>
                        <strong class="dark">Итого, к оплате:</strong>
                        <span id="layer_cart_product_price"></span>
                    </div>
                </div>
            </div>
            <div class="layer_cart_cart col-xs-12 col-md-6">
                <span class="title">
                    <!-- Plural Case [both cases are needed because page may be updated in Javascript] -->
                    <span class="ajax_cart_product_txt_s  unvisible" style="display: none;">
                        Товаров в корзине: <span class="ajax_cart_quantity">1</span>.
                    </span>
                    <!-- Singular Case [both cases are needed because page may be updated in Javascript] -->
                    <span class="ajax_cart_product_txt ">
                        Сейчас в корзине <span id="moditem"></span> товар.
                    </span>
                </span>
                <div class="layer_cart_row">
                    <strong class="dark">
                        Итого, к оплате:
                    </strong>
                    <span class="ajax_block_cart_total"><span id="modprice"></span>  руб</span>
                </div>
                <div class="button-container">
                    <span class="continue btn btn-default button exclusive-medium" title="Продолжить покупки">
                        <span class="moresale">
                            <i class="icon-chevron-left left"></i>Продолжить покупки
                        </span>
                    </span>
                    <a class="btn btn-default button button-medium" href="/personal/cart/" title="Перейти к оформлению"
                       rel="nofollow">
                        <span>
                            Перейти к оформлению<i class="icon-chevron-right right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="crossseling"></div>
    </div>
</div>
<script>
    /*Слайдер*/
    $(function () {
        $('.single-slide').slick({
            slidesToShow: 1, //сколько слайдов показывать в карусели
            slidesToScroll: 1, // сколько слайдов прокручивать за раз
            arrows: false,
            fade: true,
            asNavFor: '.multiple-items'
        });

        $('.multiple-items').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            asNavFor: '.single-slide',
            dots: false,
            draggable: true,
            focusOnSelect: true,
        });
    });


    /*плюс-минус для карточки*/
    $(document).on('click', '.itplus', function () {

        var plus = $(this).attr('data-plus');
        var plus = parseInt(plus);
        var newplus = plus + 1;
        $('#quantity_wanted').val(newplus);

        $('body').find('.itplus').each(function () {
            $(this).attr('data-plus', newplus);
        });

        $('body').find('.itminus').each(function () {
            $(this).attr('data-minus', newplus);
        });

    });

    $(document).on('click', '.itminus', function () {

        var minus = $(this).attr('data-minus');
        var minus = parseInt(minus);
        if (minus > 1) {
            var newminus = minus - 1;
            $('#quantity_wanted').val(newminus);

            $('body').find('.itminus').each(function () {
                $(this).attr('data-minus', newminus);
            });

            $('body').find('.itplus').each(function () {
                $(this).attr('data-plus', newminus);
            });
        }
    });

    /*смена чекбоксов размеров при клике*/
    $(document).on('click', '.attribute_radio.razmer', function () {
        $(".attribute_fieldset.razmerblock").find('.checked').removeClass('checked');
        $(this).parent().addClass('checked');
    });

    /*смена чекбоксов роста при клике*/
    $(document).on('click', '.attribute_radio.rost', function () {
        $(".attribute_fieldset.rostblock").find('.checked').removeClass('checked');
        $(this).parent().addClass('checked');
    });


    /*Добавление в корзину основного товара*/
    $(document).on('click', '.buttons_bottom_block.no-print', function () {

        var id = $(this).attr('data-id');
        /*id товара*/
        var quan = $('#quantity_wanted').val();
        /*количество*/
        var pric = $('.pricval').html();
        var razmer = $("#razmerblock").find('.checked').children().attr('data-raz');
        var rost = $("#rostblock").find('.checked').children().attr('data-rost');
        $('#razmod').append(razmer);
        $('#rostmod').append(rost);

        $.post('/local/templates/style-spb/ajax/basket.php', {id, quan, pric, razmer, rost}, function (data) {


            var datad = JSON.parse(data);
            $('#moditem').text('' + datad[0] + '');
            $('#modprice').text('' + datad[1] + '');
            var kol = $('#quantity_wanted').val();

            var sum = kol * pric;
            $('#layer_cart_product_quantity').text('' + kol + '');
            $('#layer_cart_product_price').text('' + sum + '');

            $('#layer_cart').css('display', 'block');
            $('.layer_cart_overlay').css('display', 'block');

        })

    });


    /*Добавление в корзину сопутствующих товаров*/
    $(document).on('click', '.recomendcart', function () {

        var id = $(this).attr('data-id');
        /*id товара*/
        var quan = 1;
        /*количество*/

        $.post('/local/templates/style-spb/ajax/basket.php', {id, quan}, function (data) {

            $('#layer_cart').css('display', 'block');
            $('.layer_cart_overlay').css('display', 'block');

        })

    });


    /*Закрыть модальное окно*/
    $(document).on('click', '.cross', function () {
        $('#layer_cart').css('display', 'none');
        $('.layer_cart_overlay').css('display', 'none');
    });

    /*кнопка продолжить покупки*/
    $(document).on('click', '.moresale', function () {
        $('#layer_cart').css('display', 'none');
        $('.layer_cart_overlay').css('display', 'none');
    });

    $('#thumbs_list').css('overflow', 'visible');
</script>

<?
unset($actualItem, $itemIds, $jsParams);
?>
