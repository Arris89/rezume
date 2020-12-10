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

<li class="ajax_block_product col-xs-12 col-sm-6 col-md-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line">
    <div class="left-block">
        <div class="product-image-container" style="border: 1px solid #d6d4d4;
    padding: 9px;
    margin-bottom: 13px;
    position: relative;
}">
            <a class="product_img_link"
               href="<?= $item['DETAIL_PAGE_URL'] ?>"
               title="Пальто женское демисезонное" itemprop="url">
                <img class="replace-2x img-responsive rollover-images"
                     data-rollover="https://style-spb.ru/790-home_default/palto-zhenskoe-demisezonnoe.jpg"
                     src="https://style-spb.ru/893-home_default/palto-zhenskoe-demisezonnoe.jpg"
                     alt="Пальто женское демисезонное" title="Пальто женское демисезонное"
                     width="250" height="320" itemprop="image">
            </a>
            <div class="content_price" itemprop="offers" itemscope=""
                 itemtype="https://schema.org/Offer">
                  <span itemprop="price" class="price product-price">
                                        4 200 руб
                  </span>
                <meta itemprop="priceCurrency" content="RUB">
                <span class="unvisible">
                     <link itemprop="availability" href="https://schema.org/InStock">
                    в наличии
                </span>
            </div>
        </div>
    </div>
    <div class="right-block">
        <div class="h5" itemprop="name">
            <a class="product-name"
               href="<?= $item['DETAIL_PAGE_URL'] ?>"
               title="Пальто женское демисезонное" itemprop="url">
                Пальто женское демисезонное (1493)
            </a>
        </div>
        <p class="product-desc" itemprop="description">
            Цвет:зеленое яблоко
            Состав:74% полиэстер, 23% вискоза, 3% эластан.
        </p>
        <div class="content_price">
                            <span class="price product-price">
                                4 200 руб
                            </span>
        </div>
        <div class="button-container" style="display: none;">
            <a class="button ajax_add_to_cart_button btn btn-default"
               href="<?= $item['DETAIL_PAGE_URL'] ?>"
               rel="nofollow" title="В корзину" data-id-product-attribute="1612"
               data-id-product="161" data-minimal_quantity="1">
                <span>В корзину</span>
            </a>
            <a class="button lnk_view btn btn-default"
               href="<?= $item['DETAIL_PAGE_URL'] ?>"
               title="См.">
                <span>Еще</span>
            </a>
        </div>
        <div class="color-list-container">
            <ul class="color_to_pick_list clearfix">
                <li>
                    <a href=""
                       id="color_1612" class="color_pick" style="background:#55e200;">
                    </a>
                </li>
            </ul>
        </div>
        <div class="product-flags">
        </div>
        <span class="availability">
             <span class=" label-success">
                   в наличии
             </span>
       </span>
    </div>
</li>