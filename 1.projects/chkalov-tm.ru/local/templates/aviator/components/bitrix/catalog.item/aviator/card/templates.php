<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */

?>

<?
Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/fav.js");
?>

<?
/*echo '<pre>';
print_r( $arResult);
echo '<pre>';*/
?>

<? if ($itemHasDetailUrl): ?>

    <!--ниже карточка товара и избранное-->

<div class="img-wrap">
    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>"
       data-entity="image-wrapper">
        <? else: ?>

        <? endif; ?>

        <?php

        if (!$item['PROPERTIES']['MORE_PHOTO']['VALUE'] == "") {
            $rsFile = CFile::GetByID($item['PROPERTIES']['MORE_PHOTO']['VALUE'][0]);
            $arFile = $rsFile->Fetch();
            $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . ""; // выстраиваем ссылку
            ?>
            <img src="<?= getResizedImgOrPlaceholder($item['PROPERTIES']['MORE_PHOTO']['VALUE'][0], $width = 1200, $height = 1200, $proportional = true) ?>"/>
        <? } elseif ($item['PREVIEW_PICTURE']['SRC'] == '/local/templates/aviator/components/bitrix/catalog.section/aviator/images/no_photo.png') { ?>
            <img itemprop="image" class="js-gallery-container"
                 src="<?= SITE_TEMPLATE_PATH ?>/components/bitrix/catalog.section/aviator/images/no_photo.png">
            <?
        } else {
            ?>
            <img itemprop="image" class="js-gallery-container" src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>">

        <? }
        ?>


    </a>


    <div class="shadow">

        <?php

        if ($USER->IsAuthorized()) { ?>


            <div class="leftfav" data-wish="0" data-item="<?= $item['ID'] ?>">
                <img src="<?= $templateFolder ?>/images/main-recommend-heart.png" alt="Добавить в избранное" height="27"
                     width="30">
            </div>


        <? } else { ?>


            <div class="leftfavnot" data-wish="0" data-item="<?= $item['ID'] ?>">
                <img src="<?= $templateFolder ?>/images/main-recommend-heart.png" alt="Добавить в избранное" height="27"
                     width="30">
            </div>
        <? } ?>


        <div class="right">

            <? if (!$item['PROPERTIES']['MORE_PHOTO']['VALUE'] == "")
            {

            $rsFile = CFile::GetByID($item['PROPERTIES']['MORE_PHOTO']['VALUE'][0]);
            $arFile = $rsFile->Fetch();
            $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . ""; // выстраиваем ссылку
            ?>

            <a href="/<?= $href ?>" id="<?= $item['ID'] ?>" class="fancybox">

                <?
                }
                else
                {
                ?>

                <a href="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" id="<?= $item['ID'] ?>" class="fancybox">

                    <? } ?>
                    <img src="<?= $templateFolder ?>/images/main-recommend-zoom.png" alt="" height="28" width="30">
                </a>
        </div>


        <div class="clear"></div>
    </div>

</div>

<div class="name">
    <? if ($itemHasDetailUrl): ?>
    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>">
        <? endif; ?>
        <?= $productTitle ?>
        <? if ($itemHasDetailUrl): ?>
    </a>
<? endif; ?>
</div>

<!--выше карточка товара и избранное-->

<?
if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
    foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
        switch ($blockName) {
            case 'price': ?>
                <div class="price" data-entity="price-block">
                    <?
                    if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
                        ?>
                        <span class="product-item-price-old" id="<?= $itemIds['PRICE_OLD'] ?>"


                            <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>>


								<?= $price['PRINT_RATIO_BASE_PRICE'] . '<span class="ruble">Р</span>'; ?>


							</span>&nbsp;
                        <?
                    }
                    ?>
                    <span id="<?= $itemIds['PRICE'] ?>">
							<?
                            if (!empty($price)) {
                                if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {


                                    echo preg_replace('/[^0-9]/', '', $price['PRINT_RATIO_PRICE']) . '<span class="ruble">Р</span>';

                                } else {

                                    $PriceEnd = substr($price['PRINT_RATIO_PRICE'], 1);

                                    if ($arParams['NEWS_TITLE']) {
                                        echo $arParams['NEWS_TITLE'];
                                    } else {

                                        /*Цены для товаров*/

                                        echo preg_replace('/[^0-9]/', '', $price['PRINT_RATIO_PRICE']) . '<span class="ruble">Р</span>';
                                    }
                                }
                            }
                            ?>
						</span>
                </div>
                <?
                break;

            case 'quantityLimit':
                if ($arParams['SHOW_MAX_QUANTITY'] !== 'N') {
                    if ($haveOffers) {
                        if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                            ?>

                            <?
                        }
                    } else {
                        if (
                            $measureRatio
                            && (float)$actualItem['CATALOG_QUANTITY'] > 0
                            && $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
                            && $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
                        ) {
                            ?>

                            <?
                        }
                    }
                }

                break;

            case 'quantity':
                if (!$haveOffers) {
                    if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY']) {
                        ?>

                        <?
                    }
                } elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                    if ($arParams['USE_PRODUCT_QUANTITY']) {
                        ?>

                        <?
                    }
                }

                break;

                //case 'buttons':
                ?>

                <?
                break;

            case 'props':
                if (!$haveOffers) {
                    if (!empty($item['DISPLAY_PROPERTIES'])) {
                        ?>

                        <?
                    }

                    if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES'])) {
                        ?>
                        <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
                            <?
                            if (!empty($item['PRODUCT_PROPERTIES_FILL'])) {
                                foreach ($item['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                                    ?>
                                    <input type="hidden"
                                           name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
                                           value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                                    <?
                                    unset($item['PRODUCT_PROPERTIES'][$propID]);
                                }
                            }

                            if (!empty($item['PRODUCT_PROPERTIES'])) {
                                ?>
                                <table>
                                    <?
                                    foreach ($item['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                                        ?>
                                        <tr>
                                            <td><?= $item['PROPERTIES'][$propID]['NAME'] ?></td>
                                            <td>
                                                <?
                                                if (
                                                    $item['PROPERTIES'][$propID]['PROPERTY_TYPE'] === 'L'
                                                    && $item['PROPERTIES'][$propID]['LIST_TYPE'] === 'C'
                                                ) {
                                                    foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                        ?>
                                                        <label>
                                                            <? $checked = $valueID === $propInfo['SELECTED'] ? 'checked' : ''; ?>
                                                            <input type="radio"
                                                                   name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
                                                                   value="<?= $valueID ?>" <?= $checked ?>>
                                                            <?= $value ?>
                                                        </label>
                                                        <br/>
                                                        <?
                                                    }
                                                } else {
                                                    ?>
                                                    <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]">
                                                        <?
                                                        foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                            $selected = $valueID === $propInfo['SELECTED'] ? 'selected' : '';
                                                            ?>
                                                            <option value="<?= $valueID ?>" <?= $selected ?>>
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
                } else {
                    $showProductProps = !empty($item['DISPLAY_PROPERTIES']);
                    $showOfferProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];

                    if ($showProductProps || $showOfferProps) {
                        ?>

                        <?
                    }
                }

                break;

            case 'sku':
                if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP'])) {
                    ?>
                    <div id="<?= $itemIds['PROP_DIV'] ?>">
                        <?
                        foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                            $propertyId = $skuProperty['ID'];
                            $skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
                            if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
                                continue;
                            ?>

                            <?
                        }
                        ?>
                    </div>
                    <?
                    foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                        if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']]))
                            continue;

                        $skuProps[] = array(
                            'ID' => $skuProperty['ID'],
                            'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                            'VALUES' => $skuProperty['VALUES'],
                            'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                        );
                    }

                    unset($skuProperty, $value);

                    if ($item['OFFERS_PROPS_DISPLAY']) {
                        foreach ($item['JS_OFFERS'] as $keyOffer => $jsOffer) {
                            $strProps = '';

                            if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                                foreach ($jsOffer['DISPLAY_PROPERTIES'] as $displayProperty) {
                                    $strProps .= '<dt>' . $displayProperty['NAME'] . '</dt><dd>'
                                        . (is_array($displayProperty['VALUE'])
                                            ? implode(' / ', $displayProperty['VALUE'])
                                            : $displayProperty['VALUE'])
                                        . '</dd>';
                                }
                            }

                            $item['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
                        }
                        unset($jsOffer, $strProps);
                    }
                }

                break;
        }
    }
}

if (
    $arParams['DISPLAY_COMPARE']
    && (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
) {
    ?>
    <div class="product-item-compare-container">
        <div class="product-item-compare">
            <div class="checkbox">
                <label id="<?= $itemIds['COMPARE_LINK'] ?>">
                    <input type="checkbox" data-entity="compare-checkbox">
                    <span data-entity="compare-title"><?= $arParams['MESS_BTN_COMPARE'] ?></span>
                </label>
            </div>
        </div>
    </div>
    <?
}
?>


<div class="col-select">
    <div class="aval-colors2 owl-carousel owl-theme owl-loaded owl-drag">
        <? if (isset($morePhotoLinks)) {
            foreach ($morePhotoLinks as $link) {
                ?>
                <div class="item">
                    <a data-id="<?= $item['ID'] ?>" class="js-gallery-image" rev="<?= $link ?>" href="<?= $link ?>">
                        <img src="<?= $link ?>" width="100px">
                    </a>
                </div>
                <?
            }
        }
        ?>
    </div>
</div>
