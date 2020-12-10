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

<a class="product__img-area badge badge_catalog badge_new" href="<?= $item['DETAIL_PAGE_URL'] ?>">
    <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $productTitle ?>">

    <? if ($arResult['ITEM']['PROPERTIES']['NEW']) { ?>
        <span class="badge__item badge__item_new">Новинка</span>
    <? } ?>
    <? if ($arResult['ITEM']['PROPERTIES']['HIT']) { ?>
        <span class="badge__item badge__item_hit">Хит продаж</span>
    <? } ?>

</a>
<div class="product__information">
    <a class="product__name" href="<?= $item['DETAIL_PAGE_URL'] ?>">
        <?= $productTitle ?>
    </a>
    <p class="product__description"><?= $arResult['ITEM']['PROPERTIES']['RAZMER']['NAME'] ?>
        : <?= $arResult['ITEM']['PROPERTIES']['RAZMER']['VALUE'] ?>
        ; <?= $arResult['ITEM']['PROPERTIES']['POLOTNO']['NAME'] ?>
        : <?= $arResult['ITEM']['PROPERTIES']['POLOTNO']['VALUE'] ?>,
        <?= $arResult['ITEM']['PROPERTIES']['KOROB']['NAME'] ?>
        : <?= $arResult['ITEM']['PROPERTIES']['KOROB']['VALUE'] ?>
        ; <?= $arResult['ITEM']['PROPERTIES']['KRASKA']['NAME'] ?>
        : <?= $arResult['ITEM']['PROPERTIES']['RAZMER']['VALUE'] ?>
        , <?= $arResult['ITEM']['PROPERTIES']['COLOR']['NAME'] ?> <?= $arResult['ITEM']['PROPERTIES']['RAZMER']['VALUE'] ?>
        ; <?= $arResult['ITEM']['PROPERTIES']['MEPOLOTNO']['NAME'] ?>:
        <?= $arResult['ITEM']['PROPERTIES']['RAZMER']['VALUE'] ?>
        ; <?= $arResult['ITEM']['PROPERTIES']['METALLKOROB']['NAME'] ?>
        : <?= $arResult['ITEM']['PROPERTIES']['RAZMER']['VALUE'] ?>;
        <?= $arResult['ITEM']['PROPERTIES']['OTDELKASN']['NAME'] ?>
        : <?= $arResult['ITEM']['PROPERTIES']['OTDELKASN']['VALUE'] ?>,
        <?= $arResult['ITEM']['PROPERTIES']['OTDELKAVN']['NAME'] ?>
        : <?= $arResult['ITEM']['PROPERTIES']['OTDELKAVN']['VALUE'] ?></p>
    <div class="product__btn-area">
        <button class="product__btn btn btn_get-price" type="button" data-url="<?=$item['DETAIL_PAGE_URL']?>">Получить прайс
        </button>
    </div>
</div>



