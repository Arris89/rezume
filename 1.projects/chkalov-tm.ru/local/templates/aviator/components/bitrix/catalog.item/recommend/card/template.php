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


<a href="<?= $item['DETAIL_PAGE_URL'] ?>">

    <?php

    if (!$item['PROPERTIES']['MORE_PHOTO']['VALUE'] == "") {
        $rsFile = CFile::GetByID($item['PROPERTIES']['MORE_PHOTO']['VALUE'][0]);
        $arFile = $rsFile->Fetch();
        $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . ""; // выстраиваем ссылку
        ?>
        <img class="card-slide-item-img" height="359" width="268"
             src="<?= getResizedImgOrPlaceholder($item['PROPERTIES']['MORE_PHOTO']['VALUE'][0], $width = 1200, $height = 1200, $proportional = true) ?>"/>
    <? } elseif ($item['PREVIEW_PICTURE']['SRC'] == '/local/templates/aviator/components/bitrix/catalog.section/aviator/images/no_photo.png') { ?>
        <img itemprop="image" class="card-slide-item-img" height="359" width="268"
             src="<?= SITE_TEMPLATE_PATH ?>/components/bitrix/catalog.section/aviator/images/no_photo.png">
        <?
    } else {
        ?>
        <img itemprop="image" class="card-slide-item-img" height="359" width="268"
             src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>">

    <? }
    ?>


</a>
<div class="card-slide-item-info">
    <a class="item-info-name" href="<?= $item['DETAIL_PAGE_URL'] ?>">
        <?= $productTitle ?> <br>
    </a>
    <div class="item-info-price"><span><?= $price['PRINT_RATIO_PRICE']; ?></span><span class="ruble">&#8381;</span>
    </div>
</div>




