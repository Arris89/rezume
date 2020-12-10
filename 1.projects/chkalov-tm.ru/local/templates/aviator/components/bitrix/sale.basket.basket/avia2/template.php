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


foreach ($arResult['GRID']['ROWS'] as $quanitem) {
    if ($quanitem['PRODUCT_ID'] == 9285) {
        echo $quanitem['AVAILABLE_QUANTITY'];
    }
}


$documentRoot = Main\Application::getDocumentRoot();


$cntBasketItem = CSaleBasket::GetList(
    array(),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    ),
    array()
);


if ($cntBasketItem == 0) { ?>
    <main class='main'>
        <div class="basket-wrap">
            <div class="title">
                <h2> Корзина </h2>
            </div>
            <div class="container" id="basket-container">
                <div class="cart your-cart-is-empty">
                    <p>Ваша корзина пуста.</p>
                </div>
                <div style="height: 50px">
                </div>
            </div>
        </div>
    </main>
<? } else { ?>

<div class="basket-wrap basket-order">
    <div class="title">
        <h2> Корзина </h2>
    </div>
    <div class="container" id="basket-container">

        <form action="" method="post" id="cart-form">
            <div class="basket-list cart">

                <div class="head">
                    <div class="product">Товар</div>
                    <div class="price">Цена</div>
                    <div class="quantity">Количество</div>
                    <div class="delete">Удалить</div>
                    <div class="cost">Сумма</div>
                </div>


                <?
                $basket = \Bitrix\Sale\Basket::loadItemsForFUser(
                    \Bitrix\Sale\Fuser::getId(),
                    \Bitrix\Main\Context::getCurrent()->getSite()
                ); /* текущая корзина */
                $fuser = new \Bitrix\Sale\Discount\Context\Fuser($basket->getFUserId(true));
                $discounts = \Bitrix\Sale\Discount::buildFromBasket($basket, $fuser);
                $discounts->calculate();
                $result = $discounts->getApplyResult(true);
                $prices = $result['PRICES']['BASKET']; /* цены товаров с учетом скидки */
                foreach ($prices as $key2 => $value) {

                    $BasPrice['BASE'][$key2] = $value['BASE_PRICE'];
                    $BasPrice['PRICE'][$key2] = $value['PRICE'];

                }

                ?>

                <?php

                foreach ($arResult['GRID']['ROWS'] as $key => $value) {

                    $res2 = CIBlockElement::GetByID($value['PRODUCT_ID']);
                    if ($ar_res2 = $res2->GetNext()) {
                        ?>

                        <div class="item row" id="<?= $key ?>">
                        <div class="product">
                        <div class="img-wrap item-thumb">
                            <? if ($value['PREVIEW_PICTURE_SRC']) { ?>
                                <img src="<?= $value['PREVIEW_PICTURE_SRC'] ?>" alt="" height="162" width="121">
                            <? } else /*картинка-заглушка*/ {
                                ?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/images/empty.png" alt="" height="162" width="121">

                            <? } ?>
                        </div>
                        <div class="text">
                        <strong>Название:</strong>
                        <a href="<?= $ar_res2['DETAIL_PAGE_URL'] ?>" class="bold"><?= $ar_res2['NAME']; ?></a>    <br>


                        <?
                    } ?>


                    <?
                    if (CModule::IncludeModule('highloadblock')) {

                        $ID = 5; /* ID справочника*/

                        $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

                        $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                        $entity_data_class = $hlentity->getDataClass();

                        $result = $entity_data_class::getList(array(
                            "select" => array("UF_NAME"), // Поля для выборки
                            "order" => array(),
                            "filter" => array("UF_XML_ID" => $value['PROPERTY_TSVET_VALUE']),
                        ));

                        $resds = $result->fetch();

                    } ?>

                    <strong>Артикул:</strong> <?= $value['PROPERTY_CML2_ARTICLE_VALUE'] ?><br>
                    <strong>Цвет:</strong> <?= $resds['UF_NAME'] ?><br>
                    <strong>Размер:</strong> <?= $value['PROPERTY_RAZMER_VALUE'] ?>
                    </div>
                    </div>


                    <div class="price">

                        <? if (!$BasPrice['PRICE'][$key] == $BasPrice['BASE'][$key]) {
                            ?>
                            <span class='old'> <?= $BasPrice['PRICE'][$key]; ?> р.</span>
                            <?
                        } ?>
                        <strong data-price="<?= $BasPrice['BASE'][$key]; ?>">
                            <?= $BasPrice['BASE'][$key]; ?>
                        </strong> р.

                    </div>


                    <div class="quantity">
                        <a href="javascript:void(0)" class="cart_minus" data-id="<?= $key ?>">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/arrow-basket-left.png" alt="" height="23"
                                 width="12">
                        </a>

                        <input type="text" value="<?= $value['QUANTITY']; ?>" data-val="<?= $value['QUANTITY']; ?>"
                               data-number="<?= $key ?>" data-price-input="<?= $value['PRICE']; ?>" class="sdasd"
                               data-max="<?= $value['AVAILABLE_QUANTITY']; ?>">

                        <a href="javascript:void(0)" class="cart_plus" data-id="<?= $key ?>">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/arrow-basket-right.png" alt="" height="23"
                                 width="12">
                        </a>
                    </div>


                    <div class="delete" data-num="<?= $key ?>">
                        <a href="javascript:void(0)"><img src="<?= SITE_TEMPLATE_PATH ?>/images/basket-delete.jpg"
                                                          alt="" height="48" width="46">
                        </a>
                    </div>
                    <? $Sall = $value['QUANTITY'] * $BasPrice['BASE'][$key]; ?>
                    <div class="cost"><strong data-all="<?= $key ?>"
                                              data-all-price="<?= $Sall ?>"><?= $Sall ?></strong>
                        р.
                    </div>
                    </div>

                    <?
                    $All += $value['QUANTITY']; /*общее количество товаров в корзине*/
                    $AllCost += $Sall;  /* общая цена */
                }
                ?>

            </div>
            <div class="basket-total">
                Товаров в корзине: <strong id="basket-total" data-total="<?= $All ?>"><?= $All ?></strong> <br>
                Итого: <strong id="basket-all"
                               data-basket-all="<?= $AllCost ?>"><?= $AllCost ?></strong>
                р.<br>
            </div>
            <div class="basket-promo">
                <form>

                    <script> /* По нажатию на кнопку с классом apply-button будет делаться ajax-запрос вот сюда /include/oneclick_addcoupon.php */
                        $('#apply-button').click(function () {
                            var coupon = $('#buy_coupon').val();
                            $.ajax({
                                url: "/ajax/coupon.php",
                                type: "post",
                                dataType: "json",
                                data: {
                                    "coupon": coupon
                                },
                                /* после получения ответа сервера*/
                                success: function (data) {
                                    $('.basket-promo').html('');
                                    $('.basket-promo').html(data.result);
                                }
                            });
                        })
                    </script>

                    <?

                    if (empty($arParams['TEMPLATE_THEME'])) {
                        $arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
                    }

                    if ($arParams['TEMPLATE_THEME'] === 'site') {
                        $templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
                        $templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
                        $arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_' . $templateId . '_theme_id', 'blue', $component->getSiteId());
                    }

                    if (!empty($arParams['TEMPLATE_THEME'])) {
                        if (!is_file($documentRoot . '/bitrix/css/main/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css')) {
                            $arParams['TEMPLATE_THEME'] = 'blue';
                        }
                    }

                    if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact'))) {
                        $arParams['DISPLAY_MODE'] = 'extended';
                    }

                    $arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
                    $arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

                    $arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

                    if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY'])) {
                        $arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
                    }

                    if (empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
                        $arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
                    }

                    if (is_string($arParams['PRODUCT_BLOCKS_ORDER'])) {
                        $arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
                    }

                    $arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
                    $arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
                    $arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
                    $arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
                    $arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

                    if ($arParams['USE_GIFTS'] === 'Y') {
                        CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

                        $giftParameters = array(
                            'SHOW_PRICE_COUNT' => 1,
                            'PRODUCT_SUBSCRIPTION' => 'N',
                            'PRODUCT_ID_VARIABLE' => 'id',
                            'USE_PRODUCT_QUANTITY' => 'N',
                            'ACTION_VARIABLE' => 'actionGift',
                            'ADD_PROPERTIES_TO_BASKET' => 'Y',
                            'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

                            'BASKET_URL' => $APPLICATION->GetCurPage(),
                            'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
                            'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

                            'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
                            'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
                            'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

                            'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
                            'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
                            'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],

                            'DETAIL_URL' => isset($arParams['GIFTS_DETAIL_URL']) ? $arParams['GIFTS_DETAIL_URL'] : null,
                            'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
                            'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
                            'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
                            'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
                            'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                            'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
                            'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
                            'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
                            'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

                            'PRODUCT_ROW_VARIANTS' => '',
                            'PAGE_ELEMENT_COUNT' => 0,
                            'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
                                SaleProductsGiftBasketComponent::predictRowVariants(
                                    $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
                                    $arParams['GIFTS_PAGE_ELEMENT_COUNT']
                                )
                            ),
                            'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

                            'ADD_TO_BASKET_ACTION' => 'BUY',
                            'PRODUCT_DISPLAY_MODE' => 'Y',
                            'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
                            'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
                            'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
                            'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
                            'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

                            'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
                            'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
                            'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
                        );
                    }

                    \CJSCore::Init(array('fx', 'popup', 'ajax'));

                    $this->addExternalCss('/bitrix/css/main/bootstrap.css');
                    $this->addExternalCss($templateFolder . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css');
                    $this->addExternalJs($templateFolder . '/js/mustache.js');
                    $this->addExternalJs($templateFolder . '/js/action-pool.js');
                    $this->addExternalJs($templateFolder . '/js/filter.js');
                    $this->addExternalJs($templateFolder . '/js/component.js');

                    $mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
                        ? $arParams['COLUMNS_LIST_MOBILE']
                        : $arParams['COLUMNS_LIST'];
                    $mobileColumns = array_fill_keys($mobileColumns, true);

                    $jsTemplates = new Main\IO\Directory($documentRoot . $templateFolder . '/js-templates');
                    /** @var Main\IO\File $jsTemplate */
                    foreach ($jsTemplates->getChildren() as $jsTemplate) {
                        include($jsTemplate->getPath());
                    }

                    $displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';

                    if (empty($arResult['ERROR_MESSAGE'])) {
                        if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'TOP') {
                            $APPLICATION->IncludeComponent(
                                'bitrix:sale.products.gift.basket',
                                '.default',
                                $giftParameters,
                                $component
                            );
                        }

                    if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED'])
                    {
                        ?>
                        <div id="basket-item-message">
                            <?= Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET'])) ?>
                        </div>
                    <?
                    }
                    ?>
                        <div id="basket-root" class="" style="opacity: 0;">
                            <?
                            if (
                                $arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
                                && in_array('top', $arParams['TOTAL_BLOCK_DISPLAY'])
                            ) {
                                ?>
                                <div class="row">
                                    <div class="col-xs-12" data-entity="basket-total-block"></div>
                                </div>
                                <?
                            }
                            ?>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning alert-dismissable" id="basket-warning"
                                         style="display: none;">
                                        <span class="close" data-entity="basket-items-warning-notification-close">&times;</span>
                                        <div data-entity="basket-general-warnings"></div>
                                        <div data-entity="basket-item-warnings">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="basket-items-list-wrapper basket-items-list-wrapper-height-fixed basket-items-list-wrapper-light<? /*=$displayModeClass*/
                                    ?>"
                                         id="basket-items-list-wrapper">
                                        <div class="basket-items-list-header" data-entity="basket-items-list-header"
                                             style="display: none">
                                            <div class="basket-items-search-field" data-entity="basket-filter">
                                                <div class="form has-feedback">
                                                    <input type="text" class=""
                                                           placeholder="<? /*=Loc::getMessage('SBB_BASKET_FILTER')*/
                                                           ?>"
                                                           data-entity="basket-filter-input">
                                                    <span class="form-control-feedback basket-clear"
                                                          data-entity="basket-filter-clear-btn"></span>
                                                </div>
                                            </div>
                                            <div class="basket-items-list-header-filter">
                                                <a href="javascript:void(0)"
                                                   class="basket-items-list-header-filter-item active"
                                                   data-entity="basket-items-count" data-filter="all"
                                                   style="display: none;"></a>
                                                <a href="javascript:void(0)"
                                                   class="basket-items-list-header-filter-item"
                                                   data-entity="basket-items-count" data-filter="similar"
                                                   style="display: none;"></a>
                                                <a href="javascript:void(0)"
                                                   class="basket-items-list-header-filter-item"
                                                   data-entity="basket-items-count" data-filter="warning"
                                                   style="display: none;"></a>
                                                <a href="javascript:void(0)"
                                                   class="basket-items-list-header-filter-item"
                                                   data-entity="basket-items-count" data-filter="delayed"
                                                   style="display: none;"></a>
                                                <a href="javascript:void(0)"
                                                   class="basket-items-list-header-filter-item"
                                                   data-entity="basket-items-count" data-filter="not-available"
                                                   style="display: none;"></a>
                                            </div>
                                        </div>
                                        <div class="basket-items-list-container" id="basket-items-list-container">
                                            <div class="basket-items-list-overlay" id="basket-items-list-overlay"
                                                 style="display: none;"></div>
                                            <div class="basket-items-list" id="basket-item-list">
                                                <div class="basket-search-not-found" id="basket-item-list-empty-result"
                                                     style="display: none;">
                                                    <div class="basket-search-not-found-icon"></div>
                                                    <div class="basket-search-not-found-text">
                                                        <?= Loc::getMessage('SBB_FILTER_EMPTY_RESULT') ?>
                                                    </div>
                                                </div>
                                                <table class="basket-items-list-table" id="basket-item-table"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?
                            if (
                                $arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
                                && in_array('bottom', $arParams['TOTAL_BLOCK_DISPLAY'])
                            ) {
                                ?>
                                <div class="row">
                                    <div class="col-xs-12" data-entity="basket-total-block"></div>
                                </div>
                                <?
                            }
                            ?>
                        </div>
                    <?
                    if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency'))
                    {
                    CJSCore::Init('currency');

                    ?>
                        <script>
                            BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)?>);
                        </script>
                    <?
                    }

                    $signer = new \Bitrix\Main\Security\Sign\Signer;
                    $signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
                    $signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
                    $messages = Loc::loadLanguageFile(__FILE__);
                    ?>
                        <script>
                            BX.message(<?=CUtil::PhpToJSObject($messages)?>);
                            BX.Sale.BasketComponent.init({
                                result: <?=CUtil::PhpToJSObject($arResult, false, false, true)?>,
                                params: <?=CUtil::PhpToJSObject($arParams)?>,
                                template: '<?=CUtil::JSEscape($signedTemplate)?>',
                                signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
                                siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
                                templateFolder: '<?=CUtil::JSEscape($templateFolder)?>'
                            });
                        </script>
                        <?
                        if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'BOTTOM') {
                            $APPLICATION->IncludeComponent(
                                'bitrix:sale.products.gift.basket',
                                '.default',
                                $giftParameters,
                                $component
                            );
                        }
                    } elseif ($arResult['EMPTY_BASKET']) {
                        include(Main\Application::getDocumentRoot() . $templateFolder . '/empty.php');
                    } else {
                        ShowError($arResult['ERROR_MESSAGE']);
                    }
                    ?>
                </form>
            </div>
            <div class="basket-total-sum">Общая сумма заказа: <strong
                        id="basket-full"><?= $AllCost ?></strong>р.
            </div>

            <?php
            if ($USER->IsAuthorized()) { ?>
                <a href="/personal/order/make/" class="submit" style="    margin-top: 10px;
    margin-right: 3px;
    padding: 0 33px 0 39px;
    line-height: 52px;
    cursor: pointer;
    background: #88003d;
    border-radius: 3px;
    display: inline-block;
    border: 2px solid #88003d;
    border-radius: 2px;
    font-size: 20px;
    color: #fff;
    font-family: 'Open Sans', Arial, sans-serif;"><span style="    padding: 0 20px 0 0;
                            background: url(<?= SITE_TEMPLATE_PATH ?>/images/top-offer-more-bg.png) 100% 4px no-repeat;">Оформить заказ</span></a>
            <? } else { ?>

                <div class="container with-btn">
                    <div class="btn-wrap">
                        <a href="/personal/order/make/"
                           class="submit"><span>Оформить заказ для новых клиентов</span></a>
                        <a href="#" class="submit" id="orbasket"><span>Войти и оформить заказ</span></a>
                    </div>
                </div>
                <?
            } ?>
    </div>
</div>
</form>
</div>


<script>
    /*Ввод купона*/
    $('#coup').delay(3000).change(function () {
        setTimeout(function () {

            if ($(".basket-coupon-alert.text-danger").length) {
                /*ошибка при вводе купона*/
            }

            else {

                var rubdel = $('#basket-full').get(0).nextSibling;
                rubdel.parentNode.removeChild(rubdel);

                var bb = $('.basket-coupon-block-total-price-current').text();
                bb.substr(-20, 2);
                var oldpr = $('#basket-full').text();
                oldpr.substr(-20, 2);
                $('#basket-full').text('');

                $('#basket-full').html('<strike>' + oldpr + 'р.</strike>&nbsp' + bb + '');

            }

        }, 3000)
    });


    $("body").on('click', '.close-link', function () {
        setTimeout(function () {
            location.reload();
        }, 1000)
    });


</script>


<div class="container" id="recomend-cart">
    <div class="main-recommended-wrap in-product">
        <div class="title">
            <h2>Рекомендуемые товары</h2>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "recommends",
            array(
                "ACTION_VARIABLE" => "action",
                "ADD_PICT_PROP" => "-",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BACKGROUND_IMAGE" => "-",
                "BASKET_URL" => "/personal/basket.php",
                "BROWSER_TITLE" => "-",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COMPATIBLE_MODE" => "Y",
                "CONVERT_CURRENCY" => "N",
                "CUSTOM_FILTER" => "",
                "DETAIL_URL" => "",
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_COMPARE" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "ENLARGE_PRODUCT" => "STRICT",
                "FILTER_NAME" => "arrFilter",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "11",
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_SUBSECTIONS" => "Y",
                "LABEL_PROP" => array(),
                "LAZY_LOAD" => "N",
                "LINE_ELEMENT_COUNT" => "3",
                "LOAD_ON_SCROLL" => "N",
                "MESSAGE_404" => "",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "OFFERS_FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "OFFERS_LIMIT" => "15",
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_ORDER2" => "desc",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Товары",
                "PAGE_ELEMENT_COUNT" => "0",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(
                    0 => "РРЦ",
                ),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_DISPLAY_MODE" => "N",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':true},{'VARIANT':'6','BIG_DATA':true}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                "RCM_TYPE" => "personal",
                "SECTION_CODE" => "muzhskaya_kollektsiya",
                "SECTION_ID" => "",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SEF_MODE" => "N",
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "Y",
                "SHOW_404" => "N",
                "SHOW_ALL_WO_SECTION" => "N",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_FROM_SECTION" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N",
                "COMPONENT_TEMPLATE" => "recommends",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "OFFERS_PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PRODUCT_PROPERTIES" => array(),
                "OFFERS_CART_PROPERTIES" => array()
            ),
            false
        ); ?>

    </div>
</div>

<div class="btn-wrap">
    <? } ?>

    <script>
        /*удаление товара из корзины*/
        $("body").on('click', '.delete', function () {
            var NumItem = $(this).attr('data-num');
            $('#' + NumItem + '').remove();
            $.post('/ajax/delbasket.php', {NumItem}, function (data) {

                $('.basQuan').text(data);
                $('#basket-total').text(data);


                /*Пересчет итога корзины*/
                var result = 0;

                $('[data-all]').each(function () {
                    var firstValue = $(this).attr('data-all-price');
                    typeof(parseInt(firstValue));
                    result = +firstValue + result;

                    $('#basket-all').empty();
                    $('#basket-all').text(result);
                    $('#basket-all').attr('data-basket-all', '' + result + '');
                    $('#basket-full').empty();
                    $('#basket-full').text(result);
                });

                if (data == 0) {
                    $('.basket-list').remove();
                    $('.basket-total').remove();
                    $('.basket-promo').remove();
                    $('.basket-total-sum').remove();
                    $('.btn-wrap').remove();
                    $('#recomend-cart').remove();
                    $('.submit').remove();

                    $('#basket-container').prepend('<div class="cart your-cart-is-empty"><p>Ваша корзина пуста.</p></div><div style="height: 50px"></div>');
                }
            })
        });


        /*Изменение количества товаров при вводе в поле*/

        $('.sdasd').on('input keyup', function (e) {

            var ItemNumb3 = $(this).val();
            $(this).attr('data-val', '' + ItemNumb3 + '');
            $(this).attr('value', '' + ItemNumb3 + '');


            var resultt = 0;
            $('.sdasd').each(function () {
                var firstValuet = $(this).attr('data-val');
                typeof(parseInt(firstValuet));
                resultt = +firstValuet + resultt;
                $('#basket-total').empty();
                $('#basket-total').text(resultt);
                $('#basket-total').attr('data-total', '' + resultt + '');
            });


            var PriceIt = $(this).attr('data-price-input');

            var IdNumb2 = $(this).attr('data-number'); //id товара (?? может надо записи в корзине)
            var PriceOld = $('[data-all = ' + IdNumb2 + ']').attr('data-all-price');

            $.post('/ajax/basket.php', {ItemNumb3, IdNumb2}, function (data) {

                var NewPrice = ItemNumb3 * PriceIt;

                /*пересчет кол-ва товаров в карточке*/
                $('[data-all = ' + IdNumb2 + ']').empty();
                $('[data-all = ' + IdNumb2 + ']').text('' + NewPrice + '');
                $('[data-all = ' + IdNumb2 + ']').attr('data-all-price', '' + NewPrice + '');


                /*Пересчет итога корзины*/
                var result = 0;

                $('[data-all]').each(function () {
                    var firstValue = $(this).attr('data-all-price');
                    typeof(parseInt(firstValue));
                    result = +firstValue + result;

                    $('#basket-all').empty();
                    $('#basket-all').text(result);
                    $('#basket-all').attr('data-basket-all', '' + result + '');
                    $('#basket-full').empty();
                    $('#basket-full').text(result);
                });

            })
        });


        /*нажатие на плюс*/
        $('.cart_plus').on('click', function () {

            $(this).prev().val(+$(this).prev().val() + 1);

            var ItemNumb2 = $(this).prev().val();
            typeof(parseInt(ItemNumb2));
            alert(ItemNumb2);
            var gg = $(this).prev().attr('data-max');
            typeof(parseInt(gg));
            alert(gg);
            if (ItemNumb2 > gg) {
                alert('превышено максимальное количество товара на складе');
            }


            var IdNumb = $(this).attr('data-id');
            var PriceIt = $(this).prev().attr('data-price-input');


            $.post('/ajax/basket.php', {ItemNumb2, IdNumb}, function (data) {

                var oldtot = $('#basket-total').attr('data-total');
                typeof(parseInt(oldtot));
                var newtot = +oldtot + 1;
                $('#basket-total').empty();
                $('#basket-total').text(newtot);
                $('#basket-total').attr('data-total', '' + newtot + '');

                /*пересчет кол-ва товаров в карточке*/

                $('[data-all = ' + IdNumb + ']').empty();

                var itemsum = ItemNumb2 * PriceIt;
                $('[data-all = ' + IdNumb + ']').text(itemsum);
                $('[data-all = ' + IdNumb + ']').attr('data-all-price', '' + itemsum + '');


                /*Пересчет итога корзины*/
                var result = 0;

                $('[data-all]').each(function () {
                    var firstValue = $(this).attr('data-all-price');
                    typeof(parseInt(firstValue));
                    result = +firstValue + result;

                    $('#basket-all').empty();
                    $('#basket-all').text(result);
                    $('#basket-all').attr('data-basket-all', '' + result + '');
                    $('#basket-full').empty();
                    $('#basket-full').text(result);
                });

            })

        });


        /*нажатие на минус*/

        $('.cart_minus').on('click', function () {
            if ($(this).next().val() > 1) {

                $(this).next().val(+$(this).next().val() - 1);
                var ItemNumb2 = $(this).next().val();
                var IdNumb = $(this).attr('data-id');
                var PriceIt = $(this).next().attr('data-price-input');

                $.post('/ajax/basket.php', {ItemNumb2, IdNumb}, function (data) {

                    var oldtot = $('#basket-total').attr('data-total');
                    typeof(parseInt(oldtot));

                    var newtot = +oldtot - 1;

                    $('#basket-total').empty();
                    $('#basket-total').text(newtot);
                    $('#basket-total').attr('data-total', '' + newtot + '');


                    /*пересчет кол-ва товаров в карточке*/

                    $('[data-all = ' + IdNumb + ']').empty();
                    var itemsum = ItemNumb2 * PriceIt;
                    $('[data-all = ' + IdNumb + ']').text(itemsum);
                    $('[data-all = ' + IdNumb + ']').attr('data-all-price', '' + itemsum + '');

                    /*Пересчет итога корзины*/
                    var result = 0;

                    $('[data-all]').each(function () {
                        var firstValue = $(this).attr('data-all-price');
                        typeof(parseInt(firstValue));
                        result = +firstValue + result;

                        $('#basket-all').empty();
                        $('#basket-all').text(result);
                        $('#basket-all').attr('data-basket-all', '' + result + '');
                        $('#basket-full').empty();
                        $('#basket-full').text(result);
                    });
                })
            }
            ;
        });
    </script>

