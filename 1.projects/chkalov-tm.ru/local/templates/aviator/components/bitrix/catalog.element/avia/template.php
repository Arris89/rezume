<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

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
$this->setFrameMode(true);

Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/fav-element.js");

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'] : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'] : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]) ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] : reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}
?>


    <div class="container">
        <?
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", "avia", Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );
        ?>

        <?

        $str = $arResult['DETAIL_PAGE_URL'];

        $lasturl = dirname($str);

        ?>

        <div class="prod-go-back">
            Вернуться в категорию
            <nobr>
                <a href="<?= $lasturl; ?>/">назад</a>
            </nobr>
        </div>
    </div>


    <div class="product-wrap">
        <div class="container">
            <div id="overview" class="product-top">

                <?
                $resultImg = count($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']);

                if ($resultImg > 1) {
                    ?>

                    <div class="left">

                        <div class="thumbnails more-images">

                            <div class="prod-slide-prev inactive" data-jcarouselcontrol="true">
                                <a href="#">
                                    <img src="/local/templates/aviator/images/prod-slide-prev.png" alt="">
                                </a>
                            </div>

                            <div class="jcarousel carousel-navigation jcarousel-vertical" id="product-gallery"
                                 data-jcarousel="true" data-jcarouselautoscroll="true">

                                <ul class="" style="left: 0px; top: 0px;">


                                    <?
                                    $nI = 1;

                                    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $value) {

                                        $rsFileF = CFile::GetByID($value);
                                        $arFileF = $rsFileF->Fetch();
                                        $hrefF = "upload/" . $arFileF['SUBDIR'] . "/" . $arFileF['FILE_NAME'] . ""; // выстраиваем ссылку
                                        $linkim = getResizedImgOrPlaceholder($value, $width = 1200, $height = 1200, $proportional = true);

                                        if ($nI == 1) {
                                            $oneSlide = $linkim;

                                            ?>

                                            <li class="selected">
                                                <a class="selected" rel="zoom-id:zoom"
                                                   rev="<?= $linkim ?>"
                                                   href="<?= $linkim ?>"
                                                   style="outline: currentcolor none 0px; display: inline-block;">
                                                    <!--    <img src="/<? /*= $hrefF */ ?>">-->
                                                    <img src="<?= $linkim ?>"/>
                                                </a>
                                            </li>


                                        <? } else {
                                            ?>

                                            <li>
                                                <a rel="zoom-id:zoom"
                                                   rev="<?= $linkim ?>"
                                                   href="<?= $linkim ?>"
                                                   style="outline: currentcolor none 0px; display: inline-block;">
                                                    <!-- <img src="/<?/*= $hrefF */ ?>">-->
                                                    <img src="<?= $linkim ?>"/>
                                                </a>
                                            </li>
                                            <?
                                        }
                                        $nI++;
                                    }
                                    ?>


                                </ul>

                            </div>
                            <div class="prod-slide-next inactive" data-jcarouselcontrol="true">
                                <a href="#">
                                    <img src="/local/templates/aviator/images/prod-slide-next.png" alt="">
                                </a>
                            </div>
                        </div>

                        <!--БОЛЬШАЯ КАРТИНКА-->
                        <div class="image" id="product-core-image">


                            <? /*Вывод значка скидки*/
                            foreach ($arResult['OFFERS'] as $key) {
                                $discS[] = $key['ITEM_PRICES']['0']['DISCOUNT'];
                            }

                            ?>
                            <?php if (max($discS) > 0): ?>
                                <div class="badge low-price"><span>Скидка!</span></div>
                            <?php endif ?>


                            <a rel="zoom-width: 400;zoom-height: 400;" class="MagicZoom" id="zoom"
                               href="<?= $oneSlide ?>"
                               style="-moz-user-select: none; position: relative; display: inline-block; text-decoration: none; outline: currentcolor none 0px; overflow: hidden; margin: auto; cursor: pointer; width: auto; height: auto;"
                               title="">

                                <img src="<?= $oneSlide ?>" style="opacity: 1; visibility: visible;" class=""
                                     height="637"/>
         

                            </a>
                            <div id="switching-image" style="display: none;"></div>
                        </div>
                        <!--БОЛЬШАЯ КАРТИНКА-->

                    </div>

                    <!-- Вывод одной картинки из Галлереи-->
                <? } elseif (!$arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] == "") {


                    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $value1) {

                        $rsFilem = CFile::GetByID($value1);
                        $arFilem = $rsFilem->Fetch();
                        $hrefm = "upload/" . $arFilem['SUBDIR'] . "/" . $arFilem['FILE_NAME'] . ""; // выстраиваем ссылку
                        $linkim1 = getResizedImgOrPlaceholder($value1, $width = 1200, $height = 1200, $proportional = true);
                    }
                    ?>


                    <div class="left">
                        <div class="image" id="product-core-image" style="left: 10%; width: 599px;">
                            <?
                            foreach ($arResult['OFFERS'] as $key) {
                                $discS[] = $key['ITEM_PRICES']['0']['DISCOUNT'];
                            }

                            ?>
                            <?php if (max($discS) > 0): ?>
                                <div class="badge low-price"><span>Скидка!</span></div>
                            <?php endif ?>

                            <img itemprop="image" id="product-image"
                                 src="<?= $linkim1 ?>"
                                 style="opacity: 1; visibility: visible; max-width: 484px;">
                            <div id="switching-image" style="display: none;"></div>
                        </div>
                    </div>


                    <!-- Вывод картинки анонса-->
                <? } elseif ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] == "" && !$arResult['PREVIEW_PICTURE']['SRC'] == "") {

                    ?>

                    <div class="left">
                        <div class="image" id="product-core-image" style="left: 10%; width: 599px;">
                            <?
                            foreach ($arResult['OFFERS'] as $key) {
                                $discS[] = $key['ITEM_PRICES']['0']['DISCOUNT'];
                            }

                            $prewId = $arResult['PREVIEW_PICTURE']['ID'];
                            $linkim2 = getResizedImgOrPlaceholder($prewId, $width = 1200, $height = 1200, $proportional = true);

                            ?>
                            <?php if (max($discS) > 0): ?>
                                <div class="badge low-price"><span>Скидка!</span></div>
                            <?php endif ?>
                            <img itemprop="image" id="product-image"
                                 src="<?=$linkim2?>"
                                 style="opacity: 1; visibility: visible; max-width: 484px;">
                            <div id="switching-image" style="display: none;"></div>
                        </div>
                    </div>

                <? } else {

                    ?>

                    <!-- Заглушка если нет изображений-->

                    <div class="left">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/empty.png" alt="" height="637" width="599">
                    </div>

                <? }; ?>


                <div class="right">
                    <div class="product-name"><h1><?= $arResult['NAME']; ?></h1></div>


                    <?php if ($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']) { ?>
                        <div class="number"><strong>Артикул:</strong>
                            <?= $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']; ?>
                        </div>
                    <? } ?>

                    <?php
                    if ($arResult['PROPERTIES']['NEW']['VALUE'] == 'да') {
                        ?>
                        <div><strong>Скоро в продаже</strong></div>
                    <? } ?>


                    <? /* НЕТ НИ ТОВАРА НИ SKU*/
                    if (($arResult['PRODUCT']['AVAILABLE'] == 'N') && (empty($arResult['OFFERS']))) {
                        ?>
                        <? echo '111111'; ?>
                        <div class="lcol">
                            <div class="availability">Товара нет в наличии</div>
                        </div>
                        <div class="rcol">
                            <div class="message"><a href="#" id="buy-in-click-button4">Уведомить о появлении</a></div>
                        </div>

                        <?
                    } /* ВАРИАНТ ДЛЯ ТОВАРА*/
                    elseif ($arResult['PRODUCT']['AVAILABLE'] == 'Y' && (empty($arResult['OFFERS'])) && ($arResult['CATALOG_QUANTITY'] <= $arResult['CATALOG_QUANTITY_RESERVED'])) {
                        ?>
                        <? echo '111112'; ?>

                        <div class="lcol">
                            <div class="availability">Товара нет в наличии</div>
                        </div>
                        <div class="rcol">
                            <div class="message"><a href="#" id="buy-in-click-button4">Уведомить о появлении</a></div>
                        </div>


                    <? } else {
                        /* ВАРИАНТ ДЛЯ SKU*/
                        $tnal = 0;
                        foreach ($arResult['OFFERS'] as $ofSum) {
                            if ($ofSum['PRODUCT']['AVAILABLE'] == 'N' or $ofSum['CATALOG_QUANTITY'] <= $ofSum['CATALOG_QUANTITY_RESERVED']) {
                            } else {

                                $tnal++;
                            }
                        }
                        ?>

                        <? if ($tnal == 0 && (!empty($arResult['OFFERS']))) {
                            ?>
                            <? echo '111113'; ?>
                            <div class="lcol">
                                <div class="availability">Товара нет в наличии</div>
                            </div>
                            <div class="rcol">
                                <div class="message"><a href="#" id="buy-in-click-button4">Уведомить о появлении</a>
                                </div>
                            </div>

                            <?
                        }
                    }
                    ?>


                    <div class="separate-line"></div>

                    <!--Блок вывода цвета-->
                    <?php if (!$arResult["COLORS_ITEM"] == "") { ?>
                        <div class="lcol">
                            <p><strong>Цвет:</strong></p>
                            <div class="color-list">
                                <?
                                foreach ($arResult["COLORS_ITEM"] as $key) {
                                    if (!$key["COLORS_SRC"] == "") { ?>
                                        <a href="<?= $key["COLORS_CODE"] ?>">
                                            <img height="101" width="75" src="<?= $key["COLORS_SRC"] ?>">
                                        </a>
                                    <? } else { ?>
                                        <a href="<?= $key["COLORS_CODE"] ?>">
                                            <img height="101" width="75"
                                                 src="<?= SITE_TEMPLATE_PATH ?>/images/empty.png">
                                        </a>
                                    <? }
                                } ?>
                            </div>
                        </div>
                    <? } ?>


                    <div class="clear"></div>
                    <?php
            

                    if (!empty($arResult['OFFERS'])) {
                        ?>

                        <div class="lcol">
                            <p><strong>Размер:</strong></p>
                            <div class="size-choose">
                                <select>
                                    <?
                                    $ip = 1;
                                    foreach ($arResult['OFFERS'] as $kk) {
                                        if ($kk['PRODUCT']['AVAILABLE'] == 'Y' && ($kk['CATALOG_QUANTITY'] > $kk['CATALOG_QUANTITY_RESERVED'])) {
                                            if ($ip == 1) {
                                                $priceCartF = $kk['ITEM_PRICES']['0']['PRICE'];
                                                $oldpriceCartF = $kk['ITEM_PRICES']['0']['BASE_PRICE'];
                                            }


                                            echo '<option value="' . $kk['PROPERTIES']['RAZMER']['VALUE'] . '" data-pric="' . $kk['ITEM_PRICES']['0']['PRICE'] . '" data-oldpric="' . $kk['ITEM_PRICES']['0']['BASE_PRICE'] . '" data-id="' . $kk['ID'] . '" class="size">' . $kk['PROPERTIES']['RAZMER']['VALUE'] . '</option>';


                                            $ip++;
                                        }
                                    }

                                    ?>

                                </select>
                            </div>
                        </div>
                    <? } ?>


                    <div class="rcol">
                        <? if (!empty($arResult['OFFERS'])) { ?>
                            <div class="message"><p><a href="#" id="buy-in-click-button1">Таблица размеров</a></p></div>
                        <?
                        } ?>

                        <div class="quantity">
                            <strong>Кол-во:</strong>
                            <div class="wrap">


                                <a href="javascript:void(0)" class="minus"><img
                                            src="<?= SITE_TEMPLATE_PATH ?>/images/arrow-basket-left.png" alt=""
                                            height="23" width="12"></a>
                                <input class="kolvo" type="text" value="1" data-numb="1"
                                       data-max="<?= $arResult['CATALOG_QUANTITY']; ?>">
                                <a href="javascript:void(0)" class="plus"><img
                                            src="<?= SITE_TEMPLATE_PATH ?>/images/arrow-basket-right.png" alt=""
                                            height="23" width="12"></a>

                            </div>
                        </div>
                    </div>
                    <div class="separate-line"></div>

                    <?
                    if (empty($arResult['OFFERS'])) {
                        ?>
                        <div class="lcol">
                            <p>
                                <strong class='price-name'>Цена:</strong>
                                <? if ($arResult['ITEM_PRICES']['0']['BASE_PRICE'] !== $arResult['ITEM_PRICES']['0']['PRICE']) { ?>
                                    <span class='old-price'><?= $arResult['ITEM_PRICES']['0']['BASE_PRICE']; ?>
                                        р.</span>
                                <? } ?>
                                <? $discIT = $arResult['ITEM_PRICES']['0']['BASE_PRICE'] - $arResult['ITEM_PRICES']['0']['PRICE']; ?>
                                <span class='price' data-disc="<?= $discIT ?>">
                         <strong><?= $arResult['ITEM_PRICES']['0']['PRICE']; ?></strong> р.
                        </span>
                            </p>
                        </div>


                        <div class="rcol">
                            <p class="sum"><strong>Сумма:</strong>
                                <strong data-allpric="<?= $arResult['ITEM_PRICES']['0']['PRICE']; ?>" class="allpric">
                                    <?= $arResult['ITEM_PRICES']['0']['PRICE']; ?>
                                </strong>
                                р.</p>
                        </div>

                        <?
                    } else {

                        foreach ($arResult['OFFERS'] as $ofSum) {

                            ?>
                            <? if ($ofSum['ITEM_PRICES']['0']['BASE_PRICE'] > 0) { ?>
                                <div class="lcol">
                                    <p>
                                        <strong class='price-name'>Цена:</strong>
                                        <? if ($oldpriceCartF !== $priceCartF) { ?>
                                            <span class='old-price'><?= $oldpriceCartF ?>
                                                р.</span>
                                        <?
                                        } ?>
                                        <? $discIT2 = $oldpriceCartF - $priceCartF; ?>
                                        <span class='price' data-disc="<?= $discIT2 ?>">
                         <strong><?= $priceCartF ?></strong> р.
                        </span>
                                    </p>
                                </div>
                                <div class="rcol">
                                    <p class="sum"><strong>Сумма:</strong>
                                        <strong data-allpric="<?= $priceCartF ?>"
                                                class="allpric">
                                            <?= $priceCartF ?>
                                        </strong>
                                        р.</p>
                                </div>
                                <? break;
                            }
                        }
                    } ?>


                    <div class="btn-wrap">
                        <div class="lcol">


                            <?
                            if ($USER->IsAuthorized()) {


                                $uid = $USER->GetID();
                                $rsUser = CUser::GetByID($uid);

                                echo "<script>
                            window.idfav =" . $uid . ";
                                //alert(idfav);
                                        </script>";


                                $arUser = $rsUser->Fetch();


                                $resFav = array_search($arResult['ID'], $arUser['UF_FAV']);


                                if ($resFav === false) {
                                    ?>
                                    <div class="shop_favorites" data-item="<?= $arResult['ID'] ?>" data-wish="0">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/main-recommend-heart.png" height="27"
                                             width="30">
                                    </div>
                                    <?
                                } else {
                                    ?>
                                    <div class="shop_favorites" data-item="<?= $arResult['ID'] ?>" data-wish="1">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/fav.png" height="27" width="30">
                                    </div>
                                    <?
                                }
                            } else {
                                ?>
                                <div class="shop_favorites_not" data-item="<?= $arResult['ID'] ?>" data-wish="0">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/main-recommend-heart.png" height="27"
                                         width="30">
                                </div>
                                <?
                            }
                            ?>


                            <span> Добавить в избранное</span>
                        </div>


                        <div class="rcol social-share">


                            <noindex>

                                <a onclick="Share.vkontakte({url: 'https://toster.ru/q/294480', description: 'Ответ на вопрос', title: 'Как правильно создать кнопку «поделиться» в facebook?'})">
                                <span class="st_vkontakte_large" displaytext="Vkontakte" st_processed="yes"><span
                                            style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;"
                                            class="stButton"><span class="stLarge"
                                                                   style="background-image: url(&quot;https://ws.sharethis.com/images/2017/vkontakte_32.png&quot;);"></span></span></span></a>

                                <a onclick="Share.facebook({url: 'https://toster.ru/q/294480'})"> <span
                                            class="st_facebook_large" displaytext="Facebook" st_processed="yes"><span
                                                style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;"
                                                class="stButton"><span class="stLarge"
                                                                       style="background-image: url(&quot;https://ws.sharethis.com/images/2017/facebook_32.png&quot;);"></span></span></span></a>

                                <a onclick="Share.twitter({description: 'Hello world!'})"> <span
                                            class="st_twitter_large" displaytext="Tweet" st_processed="yes"><span
                                                style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;"
                                                class="stButton"><span class="stLarge"
                                                                       style="background-image: url(&quot;https://ws.sharethis.com/images/2017/twitter_32.png&quot;);"></span></span></span></a>

                                <script type="text/javascript" id="st_insights_js"
                                        src="https://ws.sharethis.com/button/buttons.js?publisher=f37a70e3-b883-4fef-9c4a-28f48efb0605"></script>

                            </noindex>


                            <!-- поделиться в одноклассниках-->
                            <div id="ok_shareWidget"></div>
                            <script>
                                !function (d, id, did, st, title, description, image) {
                                    var js = d.createElement("script");
                                    js.src = "https://connect.ok.ru/connect.js";
                                    js.onload = js.onreadystatechange = function () {
                                        if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                                            if (!this.executed) {
                                                this.executed = true;
                                                setTimeout(function () {
                                                    OK.CONNECT.insertShareWidget(id, did, st, title, description, image);
                                                }, 0);
                                            }
                                        }
                                    };
                                    d.documentElement.appendChild(js);
                                }(document, "ok_shareWidget", document.URL, '{"sz":30,"st":"oval","ck":1}', "", "", "");

                            </script>

                            <!-- поделиться в других соц сетях-->
                            <script>
                                Share = {
                                    getParams: function (params) {
                                        params = params || {};
                                        params.url = params.url || window.location.href;
                                        params.title = params.title || document.title;
                                        params.description = params.description || '';
                                        params.img = params.img || '';
                                        return params;
                                    },
                                    vkontakte: function (params) {
                                        params = Share.getParams(params);
                                        url = 'http://vkontakte.ru/share.php?';
                                        url += 'url=' + encodeURIComponent(params.url);
                                        url += '&title=' + encodeURIComponent(params.title);
                                        url += '&description=' + encodeURIComponent(params.description);
                                        url += '&image=' + encodeURIComponent(params.img);
                                        url += '&noparse=true';
                                        Share.popup(url);
                                    },
                                    facebook: function (params) {
                                        params = Share.getParams(params);
                                        url = 'http://www.facebook.com/sharer.php?s=100';
                                        url += '&p[title]=' + encodeURIComponent(params.title);
                                        url += '&p[summary]=' + encodeURIComponent(params.description);
                                        url += '&p[url]=' + encodeURIComponent(params.url);
                                        url += '&p[images][0]=' + encodeURIComponent(params.img);
                                        Share.popup(url);
                                    },
                                    twitter: function (params) {
                                        params = Share.getParams(params);
                                        url = 'http://twitter.com/share?';
                                        url += 'text=' + encodeURIComponent(params.description);
                                        url += '&url=' + encodeURIComponent(params.img);
                                        url += '&counturl=' + encodeURIComponent(params.img);
                                        Share.popup(url);
                                    },
                                    popup: function (url) {
                                        window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
                                    }
                                };

                            </script>


                        </div>
                        <div class="clear"></div>


                        <?
                        if (($arResult['PRODUCT']['AVAILABLE'] == 'Y') && $arResult['CATALOG_QUANTITY'] > $arResult['CATALOG_QUANTITY_RESERVED']) {
                            ?>

                            <div class="lcol">
                                <a rel="nofollow" href="javascript:void(0)" class="add-to-cart">
                                    <span>В корзину</span>
                                </a>
                            </div>
                            <div class="rcol">
                                <a rel="nofollow" href="javascript:void(0)" class="buy-in-click"
                                   id="buy-in-click-button" value="<?= $arResult['ID'] ?>">
                                    <span>Купить в 1 клик</span>
                                </a>
                            </div>

                            <?
                        } else {
                            foreach ($arResult['OFFERS'] as $ofSum) {
                                if ($ofSum['PRODUCT']['AVAILABLE'] == 'Y' && $ofSum['CATALOG_QUANTITY'] > $ofSum['CATALOG_QUANTITY_RESERVED']) {
                                    ?>

                                    <div class="lcol">
                                        <a rel="nofollow" href="javascript:void(0)" class="add-to-cart">
                                            <span>В корзину</span>
                                        </a>
                                    </div>
                                    <div class="rcol">
                                        <a rel="nofollow" href="javascript:void(0)" class="buy-in-click"
                                           id="buy-in-click-button" value="<?= $arResult['ID'] ?>">
                                            <span>Купить в 1 клик</span>
                                        </a>
                                    </div>


                                    <? break;
                                }
                            }
                        } ?>


                        <div id="subscribe-wrap">
                            <p>Будьте в курсе всех акций и скидок! Подписывайтесь!</p>

                            <div class="lcol">

                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:sender.subscribe", "aviator", array(
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "USE_PERSONALIZATION" => "Y",
                                    "CONFIRMATION" => "N",
                                    "SHOW_HIDDEN" => "N",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "N",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                    "SET_TITLE" => "N",
                                    "HIDE_MAILINGS" => "N",
                                    "USER_CONSENT" => "N",
                                    "USER_CONSENT_ID" => "0",
                                    "USER_CONSENT_IS_CHECKED" => "N",
                                    "USER_CONSENT_IS_LOADED" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => ""
                                ), false
                                );
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-content ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs">
                <ul class="tabs-menu ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                    <li class="ui-state-default ui-corner-top ui-state-hover ui-tabs-active ui-state-active active">
                        <a href="#product-description" class="ui-tabs-anchor" id="ui-id-1">Описание</a>
                    </li>
                    <li class="ui-state-default ui-corner-top">
                        <a href="#product-shipping" class="ui-tabs-anchor" role="presentation" tabindex="-1"
                           id="ui-id-2">Доставка</a>
                    </li>
                </ul>


                <div class="description tabs-content ui-tabs-panel ui-widget-content ui-corner-bottom"
                     id="product-description" style="display: block;">
                    <p>

                        <?
                        /*ВЫВОД СОСТАВА*/
                        $ID = 2; /* ID справочника */
                        $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

                        $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                        $entity_data_class = $hlentity->getDataClass();

                        $result = $entity_data_class::getList(array(
                            "select" => array("UF_NAME"), /* Поля для выборки */
                            "order" => array(),
                            "filter" => array("UF_XML_ID" => $arResult['PROPERTIES']['SOSTAV']['VALUE']),
                        ));

                        $resds = $result->fetch();
                        ?>

                        <? if (!$arResult['PROPERTIES']['SOSTAV']['VALUE'] == "") { ?>
                            <strong><?= $arResult['PROPERTIES']['SOSTAV']['NAME'] ?>:</strong>
                            <span class="redactor-invisible-space">
                           <?= $resds["UF_NAME"] ?>
                        </span>
                            <br>
                            <?
                        } ?>

                        <?
                        /*ВЫВОД ЦВЕТА*/
                        $ID = 5; /* ID справочника */
                        $hldata2 = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

                        $hlentity2 = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata2);
                        $entity_data_class2 = $hlentity2->getDataClass();

                        $result2 = $entity_data_class2::getList(array(
                            "select" => array("UF_NAME"), /* Поля для выборки */
                            "order" => array(),
                            "filter" => array("UF_XML_ID" => $arResult['PROPERTIES']['TSVET']['VALUE']),
                        ));

                        $resds2 = $result2->fetch();
                        ?>
                        <? if (!$arResult['PROPERTIES']['TSVET']['VALUE'] == "") { ?>
                            <strong><?= $arResult['PROPERTIES']['TSVET']['NAME'] ?>:</strong>
                            <span class="redactor-invisible-space">
                                <?= $resds2["UF_NAME"] ?>
                            </span>
                            <br>
                            <?
                        } ?>


                        <?
                        /*ВЫВОД ПРОИЗВОДИТЕЛЯ*/
                        $ID = 3; /* ID справочника */
                        $hldata3 = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

                        $hlentity3 = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata3);
                        $entity_data_class3 = $hlentity3->getDataClass();

                        $result3 = $entity_data_class3::getList(array(
                            "select" => array("UF_NAME"), /* Поля для выборки */
                            "order" => array(),
                            "filter" => array("UF_XML_ID" => $arResult['PROPERTIES']['PROIZVODITEL']['VALUE']),
                        ));

                        $resds3 = $result3->fetch();
                        ?>
                        <? if (!$arResult['PROPERTIES']['PROIZVODITEL']['VALUE'] == "") { ?>
                            <strong><?= $arResult['PROPERTIES']['PROIZVODITEL']['NAME'] ?>:</strong>
                            <span class="redactor-invisible-space">
                             <?= $resds3["UF_NAME"] ?>
                            </span>
                            <br>
                            <?
                        } ?>


                    </p>
                    <p>
                        <?= $arResult['DETAIL_TEXT'] ?>
                    </p>
                </div>
                <noindex>
                    <div class="description tabs-content ui-tabs-panel ui-widget-content ui-corner-bottom"
                         id="product-shipping" style="display: none;">

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "dostavka_cart",
                            array(
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "N",
                                "DISPLAY_PICTURE" => "N",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "N",
                                "IBLOCK_TYPE" => "content",
                                "IBLOCK_ID" => "13",
                                "NEWS_COUNT" => "1",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_ORDER1" => "DESC",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "",
                                "FIELD_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "PROPERTY_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "SET_TITLE" => "N",
                                "SET_BROWSER_TITLE" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "N",
                                "DISPLAY_TOP_PAGER" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "PAGER_TITLE" => "Новости",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "Y",
                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                "SET_STATUS_404" => "N",
                                "SHOW_404" => "N",
                                "MESSAGE_404" => "",
                                "PAGER_BASE_LINK" => "",
                                "PAGER_PARAMS_NAME" => "arrPager",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "COMPONENT_TEMPLATE" => "dostavka_cart",
                                "STRICT_SECTION_CHECK" => "N"
                            ),
                            false
                        ); ?>


                    </div>
                </noindex>
            </div>


            <div class="reviews-box">
                <div class="title-review">
                    <span><?= $arResult['NAME'] ?> Отзывы:</span>
                    <a href="#" class="add-review" id="buy-in-click-button2" value="<?= $arResult['ID'] ?>">Добавить
                        отзыв</a>
                    <div class="clear"></div>
                </div>
                <div class="reviews-list">

                    <?
                    $GLOBALS['rews'] = array('ID' => $arResult['REWS_LIST']);

                    if ($arResult['REWS_LIST']) {

                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list", "rew", array(
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "-",
                            "IBLOCK_ID" => IBLOCK_REW,
                            "NEWS_COUNT" => "20",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "rews",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "DESCRIPTION",
                                2 => "",
                            ),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => "",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "Y",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK" => "",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "COMPONENT_TEMPLATE" => "rew",
                            "STRICT_SECTION_CHECK" => "N"
                        ), false
                        );
                    } else {
                        echo 'Оставьте отзыв об этом товаре первым';
                    }
                    ?>

                </div>
            </div>


            <div class="title">
                <p>Вы можете посмотреть этот товар вживую</p>
            </div>


            <div class="map-wrap">
                <div id="map">

                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:map.yandex.view", ".default", array(
                        "INIT_MAP_TYPE" => "MAP",
                        "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.6998381828127;s:10:\"yandex_lon\";d:37.58304754888849;s:12:\"yandex_scale\";i:9;s:10:\"PLACEMARKS\";a:4:{i:0;a:3:{s:3:\"LON\";d:37.720376650451;s:3:\"LAT\";d:55.588777184748;s:4:\"TEXT\";s:189:\"Магазин Чкалов###RN###ТРК Vegas: г. Москва, 24-й км МКАД х Каширское ш.###RN######RN###ВC-ЧТ: с 10:00 до 23:00; ПТ-СБ: с 10:00 до 00:00\";}i:1;a:3:{s:3:\"LON\";d:37.379215757011;s:3:\"LAT\";d:55.766701695189;s:4:\"TEXT\";s:129:\"Магазин Чкалов###RN###МТК \"Европарк\", Рублевское шоссе, 62###RN######RN###+7 495 782-36-20\";}i:2;a:3:{s:3:\"LON\";d:37.386878579291;s:3:\"LAT\";d:55.819782307886;s:4:\"TEXT\";s:159:\"Магазин Чкалов###RN###Магазин в Box city, Крокус Сити, м. Мякинино, 66-й км МКАД###RN######RN###+7 495 782-36-20\";}i:3;a:3:{s:3:\"LON\";d:37.709241313574;s:3:\"LAT\";d:55.920548857773;s:4:\"TEXT\";s:131:\"Магазин Чкалов###RN###ТЦ Июнь, Россия, г. Мытищи, ул. Мира 51###RN######RN###+7 495 782-36-20\";}}}",
                        "MAP_WIDTH" => "1200",
                        "MAP_HEIGHT" => "480",
                        "CONTROLS" => array(
                            0 => "ZOOM",
                            1 => "SMALLZOOM",
                        ),
                        "OPTIONS" => array(
                            0 => "ENABLE_SCROLL_ZOOM",
                            1 => "ENABLE_DRAGGING",
                        ),
                        "MAP_ID" => "yam_1",
                        "COMPONENT_TEMPLATE" => ".default",
                        "API_KEY" => ""
                    ), false
                    );
                    ?>

                </div>

            </div>


            <div class="main-recommended-wrap in-product" data-listname="Рекомендуемые товары в карточке товара">

                <div class="title">
                    <h2> Рекомендуемые товары </h2>
                </div>

                <?
                $APPLICATION->IncludeComponent(
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
                        "OFFER_ADD_PICT_PROP" => "-",
                        "OFFER_TREE_PROPS" => array(
                            0 => "COLOR_REF",
                            1 => "SIZES_SHOES",
                            2 => "SIZES_CLOTHES",
                        ),
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
                        "SECTION_CODE" => "",
                        "SECTION_ID" => "340",
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
                        "OFFERS_CART_PROPERTIES" => array(),
                        "PROPERTY_CODE_MOBILE" => array()
                    ),
                    false
                );
                ?>


            </div>
        </div>
    </div>


    <div class="popup" id="buy-in-click-modal" style="display: none;">
        <div class="close"><a href="#"><img class="popup-close" src="/local/templates/aviator/images/popup-close.jpg"
                                            alt="" height="23" width="23"></a></div>
        <div class="title">Купить в 1 клик</div>
        <div class="review-form">

            <script>
                /*передаем id товара в форму 1 клик*/
                $('body').on('click', '.buy-in-click', function () {
                    var clickID = $(this).attr('value');

                    /*чтобы при клике и открытии новой формы удалялись предыдушие невидимые теги, если они были*/
                    $('.formindcl').remove();

                    $('.review-form-fields').prepend('<input class="formindcl" name="clickID" style="display:none" value="' + clickID + '">');
                    /* ставим невидимый тег передаваемый при отправке формы*/
                })

            </script>


            <script>
                /*передаем id товара в форму добавления отзывов*/
                $('body').on('click', '.add-review', function () {
                    var rewID = $(this).attr('value');
                    $('.formind').remove();
                    $('.review-form-fields').prepend('<input class="formind" name="rewID" style="display:none" value="' + rewID + '">');
                })

            </script>

            <?
            $APPLICATION->IncludeComponent(
                "avia:main.feedback",
                "click",
                array(
                    "USE_CAPTCHA" => "Y",
                    "AJAX_MODE" => "Y",
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                    "EMAIL_TO" => "vixodtam@mail.ru",
                    "REQUIRED_FIELDS" => array(
                        0 => "NAME",
                        1 => "EMAIL",
                        2 => "AUTHOR_TELL",
                    ),
                    "EVENT_MESSAGE_ID" => array(
                        0 => "7",
                    ),
                    "COMPONENT_TEMPLATE" => "click",
                    "USER_CONSENT" => "Y",
                    "USER_CONSENT_ID" => "1",
                    "USER_CONSENT_IS_CHECKED" => "Y",
                    "USER_CONSENT_IS_LOADED" => "N"
                ),
                false
            );
            ?>
        </div>
    </div>

    <div class="popup" id="buy-in-click-modal2" style="display: none;">
        <div class="close"><a href="#"><img class="popup-close" src="/local/templates/aviator/images/popup-close.jpg"
                                            alt="" height="23" width="23"></a></div>
        <div class="title">Добавить отзыв</div>
        <br> <br>
        <div class="review-form">

            <?
            $APPLICATION->IncludeComponent(
                "rew:main.feedback", "rew", array(
                "AJAX_MODE" => "Y",
                "USE_CAPTCHA" => "N",
                "OK_TEXT" => "Спасибо, ваш отзыв принят и будет опубликован после проверки.",
                "EMAIL_TO" => "my@email.com",
                "REQUIRED_FIELDS" => array(
                    0 => "NAME",
                    1 => "MESSAGE",
                ),
                "EVENT_MESSAGE_ID" => array(
                    0 => "83",
                ),
                "COMPONENT_TEMPLATE" => "rew"
            ), false
            );
            ?>


        </div>
    </div>


    <div class="popup" id="buy-in-click-modal4" style="display: none;">
        <div class="plugin_arrived-box" data-action="/arrivedAdd/" style="">
            <div class="close">
                <a href="#">
                    <img class="popup-close" src="/local/templates/aviator/images/popup-close.jpg" alt="" height="23"
                         width="23">
                </a>
            </div>
            <div class="title">Сообщить о появлении товара</div>
            <div class="plugin_arrived-body">
                <div class="plugin_arrived-request">
                    <div class="plugin_arrived-field">
                        <div class="plugin_arrived-value">
                            <input type="text" placeholder="E-mail" name="email" value="" id="submail">
                        </div>
                    </div>
                    <div class="plugin_arrived-field">
                        <p class="">
                            Актуальность
                        </p>
                        <div class="plugin_arrived-value">
                            <div class="fancy-select"><select name="expiration" class="customSelect1 fancified"
                                                              style="width: 1px; height: 1px; display: block; position: absolute; top: 0px; left: 0px; opacity: 0;">
                                    <option value="7">7 дней</option>
                                    <option value="30">30 дней</option>
                                    <option value="60">60 дней</option>
                                    <option value="90">90 дней</option>
                                    <option value="360">360 дней</option>
                                </select>
                                <div class="trigger">7 дней</div>
                                <ul class="options">
                                    <li data-raw-value="7" class="selected">7 дней</li>
                                    <li data-raw-value="30">30 дней</li>
                                    <li data-raw-value="60">60 дней</li>
                                    <li data-raw-value="90">90 дней</li>
                                    <li data-raw-value="360">360 дней</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="plugin_arrived-field">
                    </div>
                    <input type="hidden" name="plugin_arrived_pid" value="684">
                    <input type="hidden" name="plugin_arrived_skuid" value="4251">
                    <div class="msg_errors"></div>
                    <div class="plugin_arrived-value submit wa-submit">
                        <input type="submit" value="Уведомить меня" id="sub" data-sub="<?= $arResult['ID'] ?>">
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>


    <script>
        /*Подписка на товар*/
        $(document).ready(function () {
            $('#sub').on('click', function (e) {
                /* ID ТОВАРА*/
                window.itemid = $('#sub').attr('data-sub');
                /* Email пользователя*/
                window.submail = $('#submail').val();
                /* Период подписки*/
                window.time = $('select[name=expiration]').val();

                Subscribeitem(us_id, itemid, submail, time);
            });

            function Subscribeitem(IDbask) {
                $.post('/ajax/subscribe-item.php', {us_id, itemid, submail, time}, function (datasub) {

                    if (datasub == 'no') {
                        $(".plugin_arrived-body").before("<br><div style='font-size: 20px; color: red;'>Вы уже подписаны.</div>");
                    }
                    else {
                        $(".plugin_arrived-body").empty();
                        $(".plugin_arrived-body").html("<div class='plugin_arrived-success' style='display: block;'><strong>Ваша просьба принята!</strong><br><br>Вы получите уведомление о появлении товара в продажу на указанные Вами контакты</div>");

                    }

                })
            }

        });
    </script>


    <div class="popup-size" id="buy-in-click-modal1" style="display: none;">
        <div class="close"><a href="#"><img class="popup-close" src="/local/templates/aviator/images/popup-close.jpg"
                                            alt="" height="23" width="23"></a></div>
        <div class="title">Таблица размеров</div>


        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "razmer_table",
            array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "14",
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "EU_SIZE",
                    1 => "BEDRA",
                    2 => "TALIYA",
                    3 => "RF_SIZE",
                    4 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "COMPONENT_TEMPLATE" => "razmer_table",
                "STRICT_SECTION_CHECK" => "N"
            ),
            false
        ); ?>



        <?
        $APPLICATION->IncludeFile(SITE_DIR . "include/razmer-table.php", array(),
            array(
                "MODE" => "html",
                "NAME" => "E-mail",
            )
        ); ?>

    </div>


<?
global $USER;
$USER = new CUser;
$us = $USER->GetID();
$rsUser = CUser::GetByID($us);
$arUser = $rsUser->Fetch();
$us_id = $arUser['ID'];
echo "<script>
window.us_id = $us_id;
</script>";
?>

    <script>

        /* id дефолтного товарного предложения для первого показываемого размера при загрузке карточки*/
        window.id = $('select option:selected').attr('data-id');
        /*это вариант если нет SKU*/
        if (window.id == undefined) {
            window.id = $('#buy-in-click-button').attr('value');
        }
        /*дефолтная цена для первого показываемого размера при загрузке карточки*/
        window.pric = $('select option:selected').attr('data-pric');
        /*это вариант для цены если нет SKU*/
        if (window.pric == undefined) {
            window.pric = $('.allpric').attr('data-allpric');
        }


        window.oldpric = $('.old-price').text();
        if (oldpric == 0) {
            window.oldpric = $('.allpric').attr('data-allpric');
        }



        /*Нажатие на плюс*/
        $('.plus').on('click', function (e) {
            var basks = $('.kolvo').attr('data-numb');
            var bask = +basks + 1;
            alert(bask);

            var max = $('.kolvo').attr('data-max');
            alert(max);
            if(bask>max)
            {
                alert('Превышено количество товара на складе');
                $('.kolvo').attr('data-numb', '' + max + '');
                $('.kolvo').attr('value', '' + max + '');
                $('.kolvo').val('' + max + '');

            }
else {
              
                var allSum = Math.ceil(bask * pric);
                $('.allpric').text('' + allSum + '');
                $('.kolvo').attr('data-numb', '' + bask + '');
                $('.kolvo').attr('value', '' + bask + '');
                $('.kolvo').val('' + bask + '');
            }

            $('.kolvo').on('keyup', function (e) {
                window.kolvoIn = $('.kolvo').val();
                var allSum = Math.ceil(kolvoIn * pric);
                $('.allpric').text('' + allSum + '');
                $('.kolvo').attr('data-numb', '' + kolvoIn + '');
                $('.kolvo').attr('value', '' + kolvoIn + '');
            });

        });
        $('.minus').on('click', function (e) {
            var basks = $('.kolvo').attr('data-numb');
            var bask = +basks;
            if (bask > 1) {
                var bask = +basks - 1;
                var allSum = Math.ceil(bask * pric);
                $('.allpric').text('' + allSum + '');
                $('.kolvo').attr('data-numb', '' + bask + '');
                $('.kolvo').attr('value', '' + bask + '');
                $('.kolvo').val('' + bask + '');
            } else {
                $('.kolvo').remove();
                var str1 = '<input class="kolvo" type="text" value="' + bask + '" data-numb="' + bask + '">';
                $('.minus').after(str1);
            }
            $('.kolvo').on('keyup', function (e) {
                window.kolvoIn = $('.kolvo').val();
                var allSum = Math.ceil(kolvoIn * pric);
                $('.allpric').text('' + allSum + '');
                $('.kolvo').attr('data-numb', '' + kolvoIn + '');
                $('.kolvo').attr('value', '' + kolvoIn + '');
            });

        });


    </script>
    <script>


        $('.kolvo').on('keyup', function (e) {
            window.kolvoIn = $('.kolvo').val();
            var allSum = Math.ceil(kolvoIn * pric);
            $('.allpric').text('' + allSum + '');
            $('.kolvo').attr('data-numb', '' + kolvoIn + '');
            $('.kolvo').attr('value', '' + kolvoIn + '');
        });


    </script>
    <script>

        $(document).ready(function () {
            $("select").change(function () {
                window.id = $('select option:selected').attr('data-id');
                var oldpric = $('select option:selected').attr('data-oldpric');
                window.pric = $('select option:selected').attr('data-pric');
                $(".old-price").remove();
                $(".price").remove();
                /*подмена старой цены*/
                var str1 = '<span class="old-price">' + oldpric + 'р.</span>';
                $('.price-name').after(str1);
                /*подмена новой цены*/
                var str2 = '<span class="price"><strong></strong>' + pric + ' р.</span>';
                $('.old-price').after(str2);
                /*подмена общей суммы набранных товаров*/

                var kolvoIn = $('.kolvo').attr('data-numb');
                var allSum = Math.ceil(pric * kolvoIn);
                $('.allpric').text('' + allSum + '');
                $('.allpric').attr('data-allpric', '' + pric + '');

            });
        });

    </script>

    <script>
        $(document).ready(function () {

            $('.add-to-cart').on('click', function (e) {
          
                window.allpric = $('.allpric').attr('data-allpric');

                window.numb = $('.kolvo').attr('data-numb');
                window.itemName = $('h1').text();

                addВasketcustom(allpric);
            });
            function addВasketcustom(IDbask) {
                var paramid = id;
                var parampric = allpric; //цена
                var numbic = numb;    //количество

                var paramoldpric = oldpric;
                var discount = $('.price').attr('data-disc');

                if (discount == 0) {
                    discount = 'net';
                }
                //var name = itemName;
                $.post('/ajax/addbasket.php', {paramid, parampric, numbic, paramoldpric, discount}, function (datab) {
                    $('.basQuan').text(datab);
                })
            }
        });

    </script>


    <script>
        /* Скрипт выпадающего списка (длительность подписки) в уведомлении о появлении товара*/
        $(document).on('click', '.plugin_arrived-value .fancy-select .trigger', function () {
            $(this).toggleClass('open');
            $(this).next().toggleClass('open');
        });
        $(document).on('mouseover', '.plugin_arrived-value  .fancy-select .options li', function () {
            $(this).addClass('hover');
        });
        $(document).on('mouseleave', '.plugin_arrived-value  .fancy-select .options li', function () {
            $(this).removeClass('hover');
        });
        $(document).on('click', '.plugin_arrived-value  .fancy-select .options li', function () {

            $(this).siblings().removeClass('selected');
            $(this).addClass('selected');
            var value = $(this).data('raw-value');
            var t = $(this).text();
            $('.plugin_arrived-value select option:selected').removeAttr('selected');
            $('.plugin_arrived-value select option[value="' + value + '"]').attr('selected', true);

            $('.plugin_arrived-value .fancy-select .trigger').text(t);
            $('.plugin_arrived-value .fancy-select .trigger').toggleClass('open');
            $('.plugin_arrived-value .fancy-select .options').toggleClass('open');

        });
        $(document).ready(function () {
            $('.customSelect1').fancySelect();
        });

    </script>


<?
if ($haveOffers) {
    $offerIds = array();
    $offerCodes = array();

    $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

    foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
        $offerIds[] = (int)$jsOffer['ID'];
        $offerCodes[] = $jsOffer['CODE'];

        $fullOffer = $arResult['OFFERS'][$ind];
        $measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

        $strAllProps = '';
        $strMainProps = '';
        $strPriceRangesRatio = '';
        $strPriceRanges = '';

        if ($arResult['SHOW_OFFERS_PROPS']) {
            if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
                    $current = '<dt>' . $property['NAME'] . '</dt><dd>' . (
                        is_array($property['VALUE']) ? implode(' / ', $property['VALUE']) : $property['VALUE']
                        ) . '</dd>';
                    $strAllProps .= $current;

                    if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
                        $strMainProps .= $current;
                    }
                }

                unset($current);
            }
        }

        if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
            $strPriceRangesRatio = '(' . Loc::getMessage(
                    'CT_BCE_CATALOG_RATIO_PRICE', array('#RATIO#' => ($useRatio ? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'] : '1'
                        ) . ' ' . $measureName)
                ) . ')';

            foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
                if ($range['HASH'] !== 'ZERO-INF') {
                    $itemPrice = false;

                    foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
                        if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
                            break;
                        }
                    }

                    if ($itemPrice) {
                        $strPriceRanges .= '<dt>' . Loc::getMessage(
                                'CT_BCE_CATALOG_RANGE_FROM', array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
                            ) . ' ';

                        if (is_infinite($range['SORT_TO'])) {
                            $strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                        } else {
                            $strPriceRanges .= Loc::getMessage(
                                'CT_BCE_CATALOG_RANGE_TO', array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
                            );
                        }

                        $strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
                    }
                }
            }

            unset($range, $itemPrice);
        }

        $jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
        $jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
        $jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
        $jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
    }

    $templateData['OFFER_IDS'] = $offerIds;
    $templateData['OFFER_CODES'] = $offerCodes;
    unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

    $jsParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => true,
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP' => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS' => true,
            'USE_SUBSCRIBE' => $showSubscribe,
            'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
            'ALT' => $alt,
            'TITLE' => $title,
            'MAGNIFIER_ZOOM_PERCENT' => 200,
            'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]) ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE'] : null
        ),
        'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
        'VISUAL' => $itemIds,
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
        ),
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'ACTIVE' => $arResult['ACTIVE'],
            'NAME' => $arResult['~NAME'],
            'CATEGORY' => $arResult['CATEGORY_PATH']
        ),
        'BASKET' => array(
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL' => $arParams['BASKET_URL'],
            'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        ),
        'OFFERS' => $arResult['JS_OFFERS'],
        'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS' => $skuProps
    );
} else {
    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
        ?>
        <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
            <?
            if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
                    ?>
                    <input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                           value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                    <?
                    unset($arResult['PRODUCT_PROPERTIES'][$propId]);
                }
            }

            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if (!$emptyProductProperties) {
                ?>
                <table>
                    <?
                    foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
                        ?>
                        <tr>
                            <td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
                            <td>
                                <?
                                if (
                                    $arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L' && $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
                                ) {
                                    foreach ($propInfo['VALUES'] as $valueId => $value) {
                                        ?>
                                        <label>
                                            <input type="radio"
                                                   name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                                                   value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
                                            <?= $value ?>
                                        </label>
                                        <br>
                                        <?
                                    }
                                } else {
                                    ?>
                                    <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
                                        <?
                                        foreach ($propInfo['VALUES'] as $valueId => $value) {
                                            ?>
                                            <option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
                                                <?= $value ?>
                                            </option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                    <?
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                </table>
                <?
            }
            ?>
        </div>
        <?
    }

    ?>


    <?
    $jsParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS' => true,
            'USE_SUBSCRIBE' => $showSubscribe,
            'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
            'ALT' => $alt,
            'TITLE' => $title,
            'MAGNIFIER_ZOOM_PERCENT' => 200,
            'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]) ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE'] : null
        ),
        'VISUAL' => $itemIds,
        'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'ACTIVE' => $arResult['ACTIVE'],
            'PICT' => reset($arResult['MORE_PHOTO']),
            'NAME' => $arResult['~NAME'],
            'SUBSCRIPTION' => true,
            'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
            'ITEM_PRICES' => $arResult['ITEM_PRICES'],
            'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
            'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
            'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
            'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
            'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
            'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER' => $arResult['MORE_PHOTO'],
            'CAN_BUY' => $arResult['CAN_BUY'],
            'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
            'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
            'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
            'CATEGORY' => $arResult['CATEGORY_PATH']
        ),
        'BASKET' => array(
            'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS' => $emptyProductProperties,
            'BASKET_URL' => $arParams['BASKET_URL'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        )
    );
    unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE']) {
    $jsParams['COMPARE'] = array(
        'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
        'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
        'COMPARE_PATH' => $arParams['COMPARE_PATH']
    );
}
?>
    <script>
        BX.message({
            ECONOMY_INFO_MESSAGE: '<?= GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2') ?>',
            TITLE_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
            BASKET_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_SEND_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS') ?>',
            BTN_MESSAGE_BASKET_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
            BTN_MESSAGE_CLOSE: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
            BTN_MESSAGE_CLOSE_POPUP: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
            TITLE_SUCCESSFUL: '<?= GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK') ?>',
            COMPARE_MESSAGE_OK: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
            COMPARE_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
            COMPARE_TITLE: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
            PRODUCT_GIFT_LABEL: '<?= GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL') ?>',
            PRICE_TOTAL_PREFIX: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX') ?>',
            RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
            RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
            SITE_ID: '<?= CUtil::JSEscape($component->getSiteId()) ?>'
        });

        var <?= $obName ?> =
        new JCCatalogElement(<?= CUtil::PhpToJSObject($jsParams, false, true) ?>);

    </script>
<?
unset($actualItem, $itemIds, $jsParams);
