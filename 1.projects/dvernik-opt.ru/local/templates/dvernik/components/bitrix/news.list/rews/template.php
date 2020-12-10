<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


foreach ($arResult["ITEMS"] as $arItem):?>

    <div class="reviews__item review">
        <div class="review__img-area">
            <img
                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                    width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
            />
        </div>
        <div class="review__content">
            <div class="review__name-area"><a class="review__inner" href="#">
                    <span class="review__social"><svg class="review__icon icon icon_insta icon_theme_red">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-insta"></use>
                        </svg>
                    </span>
                    <span class="review__name">	<? echo $arItem["NAME"] ?></span></a></div>
            <div class="review__rating rating">
                <?
                $j = $arItem['PROPERTIES']['OCENKA']['VALUE'];
                for ($i = 0; $i < $j; $i++) {
                ?>

                    <div class="rating__item">
                        <svg class="rating__icon icon icon_star icon_theme_red">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-star"></use>
                        </svg>
                    </div>
                <? } ?>
            </div>
            <div class="review__text-area"><p class="review__text">    <? echo $arItem["PREVIEW_TEXT"]; ?></p></div>
        </div>
    </div>

<? endforeach; ?>


