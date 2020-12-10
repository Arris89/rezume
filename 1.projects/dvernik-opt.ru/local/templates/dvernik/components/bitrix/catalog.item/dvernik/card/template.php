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

<div class="doors__item item-thumb">

    <a class="item-thumb__link" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>"
       data-entity="image-wrapper">
        <div class="item-thumb__img-area badge badge_new">
            <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="Дверь межкомнатная">
        </div>
        <p class="item-thumb__name"><?= $productTitle ?></p></a>
    <div class="item-thumb__btn-area">
        <button class="item-thumb__btn btn" type="button">Получить прайс</button>
    </div>

<?
    if ($item['LABEL'])
    {
    ?>
    <div class="product-item-label-text <?= $labelPositionClass ?>" id="<?= $itemIds['STICKER_ID'] ?>">
        <?
        if (!empty($item['LABEL_ARRAY_VALUE'])) {
            foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value) {
                ?>
                <div<?= (!isset($item['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '') ?>>
                    <span title="<?= $value ?>"><?= $value ?></span>
                </div>
                <?
            }
        }
        ?>
    </div>


    <? } ?>

</div>

