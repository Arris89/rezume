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


<li class="item product-box ajax_block_product first_item product_accessories_description"
    style="float: left; list-style: none; position: relative; margin-right: 20px; width: 178px;">
    <div class="product_desc">
        <a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>"
           class="product-image product_image">
            <img class="lazyOwl" src="<?= $morePhoto[0]['SRC'] ?>"
                 alt="<?= $productTitle ?>" width="250" height="320">
        </a>
    </div>
    <div class="s_title_block">
        <h5 itemprop="name" class="product-name">
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                <?= $productTitle ?>
            </a>
        </h5>
        <span class="price">
                                           <?= $price['PRINT_RATIO_PRICE'] ?>
                                         </span>
    </div>
    <div class="clearfix" style="margin-top:5px">
        <div class="no-print">
            <a class="exclusive button ajax_add_to_cart_button"
               href="javascript:void(0)"
               title="В корзину">
                <span class="recomendcart" data-id="<?= $arResult['ITEM']['ID'] ?>">В корзину</span>
            </a>
        </div>
    </div>
</li>
