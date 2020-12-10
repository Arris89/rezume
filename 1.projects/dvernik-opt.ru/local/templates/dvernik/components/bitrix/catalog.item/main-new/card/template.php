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


<a class="item-thumb__link" href="<?= $item['DETAIL_PAGE_URL'] ?>">
    <div class="item-thumb__img-area badge badge_new">
        <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $productTitle ?>"></div>
    <p class="item-thumb__name"><?= $productTitle ?></p></a>
<div class="item-thumb__btn-area">
    <button class="item-thumb__btn btn btn_get-price" type="button" data-url="<?=$item['DETAIL_PAGE_URL']?>">Получить прайс</button>
</div>
