<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$templateFolder = $component->getTemplate()->GetFolder();
$pathImg = $templateFolder . '/images/';

if (! $arResult['ID']) {
    return;
}
?>

<div class="section-collection">
    <div class="section-collection__container container">
        <div class="collection">
            <h1 class="collection__title page-title">
                <?= $arResult['NAME']?>
            </h1>

            <div class="collection__main">
                <div class="collection__main-left">
                    <div class="collection__preview">
                        <div class="category">
                            <div class="category__container">
                                <div class="category__prooject">
                                    <div class="category__list-box">
                                        <?if (! empty($arResult['PROPERTIES']['DETAIL_PICTURE']['VALUE'])):?>
                                            <?foreach ($arResult['PROPERTIES']['DETAIL_PICTURE']['VALUE'] as $keyImage => $imageId):
                                                $arImage['IMAGES']['SMALL'] = \CFile::ResizeImageGet($imageId, array('width' => 300, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, true, 80);
                                                $arImage['IMAGES']['LARGE'] = \CFile::ResizeImageGet($imageId, array('width' => 1024, 'height' => 1024), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, true, 95);
                                                ?>

                                                <div class="category__item js-cat-item" data-project-item="<?= $keyImage?>">
                                                    <a href="<?= $arImage['IMAGES']['LARGE']['src']?>">
                                                        <img src="<?= $arImage['IMAGES']['SMALL']['src']?>" alt="">
                                                    </a>
                                                </div>
                                            <?endforeach?>
                                        <?endif?>
                                    </div>

                                    <div class="category__del-ver category__del-ver_1"></div>
                                    <div class="category__del-hor category__del-hor_2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collection__main-right">
                    <div class="collection-desc">
                        <?if (! empty($arResult['PROPERTIES']['DESCRIPTION1']['~VALUE']['TEXT'])):?>
                            <?= $arResult['PROPERTIES']['DESCRIPTION1']['~VALUE']['TEXT']?>
                        <?endif?>

                        <div class="collection-desc__posts">
                            <div class="collection-posts">

                                <?if (is_array($arResult['COLLECTIONS']) && count($arResult['COLLECTIONS']) > 0):?>

                                    <?foreach ($arResult['COLLECTIONS'] as $arCollection):?>
                                        <h3 class="collection-posts__name">
                                            Посты «<?= $arCollection['NAME']?>»
                                        </h3>

                                        <div class="collection-posts__items">
                                            <?foreach ($arCollection['SLOTS'] as $countSlot):?>
                                                <div class="collection-posts__item">
                                                    <img src="<?= $pathImg?>posts/<?= $arCollection['CODE']?>/<?= $countSlot?>.png">
                                                </div>
                                            <?endforeach?>
                                        </div>
                                    <?endforeach?>
                                <?else:?>
                                    <div class="collection-posts__name">
                                        Посты «<?= $arResult['NAME']?>»
                                    </div>

                                    <div class="collection-posts__items">
                                        <?foreach ($arResult['PROPERTIES']['SLOTS']['VALUE'] as $countSlot):?>
                                            <div class="collection-posts__item">
                                                <img src="<?= $pathImg?>posts/<?= $arResult['CODE']?>/<?= $countSlot?>.png">
                                            </div>
                                        <?endforeach?>
                                    </div>
                                <?endif?>
                            </div>
                        </div>

                        <?if (! empty($arResult['PROPERTIES']['DESCRIPTION2']['~VALUE']['TEXT'])):?>
                            <?= $arResult['PROPERTIES']['DESCRIPTION2']['~VALUE']['TEXT']?>
                        <?endif?>

                        <?if (! empty($arResult['PROPERTIES']['BROCHURE']['VALUE'])):
                            $arBrochure = \CFile::GetFileArray($arResult['PROPERTIES']['BROCHURE']['VALUE']);
                            $fileSize = round($arBrochure['FILE_SIZE'] * 0.000001, 1);
                            ?>

                            <div class="brochure">
                                <div class="brochure__icon">
                                    <svg class="icon icon_pdf-file">
                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#pdf-file"></use>
                                    </svg>
                                </div>

                                <div class="brochure__text">
                                    <a download href="<?= $arBrochure['SRC']?>">
                                        Скачать брошюру «Коллекция <?= $arResult['NAME']?>»
                                    </a>

                                    PDF, <?= $fileSize?> Mb
                                </div>
                            </div>
                        <?endif?>
                    </div>
                </div>
            </div>

            <div class="collection__params">
                <div class="collection-params">
                    <div class="collection-params__left">
                        <?if ($arResult['PROPERTIES']['PRICES']['~VALUE'] || (int)$arResult['MIN_PRICE'] > 0):?>
                            <div class="collection-params__item">
                                <div class="collection-params__head">
                                    <div class="collection-params__icon">
                                        <svg class="icon icon_money">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#money"></use>
                                        </svg>
                                    </div>

                                    <div class="collection-params__name">
                                        цены
                                    </div>
                                </div>

                                <div class="collection-params__text">
                                    от
                                    <?= ((int)$arResult['MIN_PRICE'] > 0) ? $arResult['MIN_PRICE'] : $arResult['PROPERTIES']['PRICES']['~VALUE']?>
                                    за выключатель в сборе с рамкой
                                </div>
                            </div>
                        <?endif?>

                        <?if (! empty($arResult['PROPERTIES']['CONFIGURATIONS']['VALUE'])):?>
                            <div class="collection-params__item">
                                <div class="collection-params__head">
                                    <div class="collection-params__icon">
                                        <svg class="icon icon_gear">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#gear"></use>
                                        </svg>
                                    </div>

                                    <div class="collection-params__name">
                                        КОНФИГУРАЦИИ
                                    </div>
                                </div>

                                <div class="collection-params__text">
                                    <?= $arResult['PROPERTIES']['CONFIGURATIONS']['VALUE']?>
                                </div>
                            </div>
                        <?endif?>
                    </div>

                    <div class="collection-params__right">
                        <a href="<?= $arResult['PROPERTIES']['LINK_USE_IN_PROJECT']['VALUE'];?>" class="my-btn">
                            использовать в проекте
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?if (! empty($arResult['DETAIL_TEXT'])):?>
    <div class="section-switch">
        <div class="section-switch__container container">
            <?= $arResult['DETAIL_TEXT']?>
        </div>
    </div>
<?endif?>

<?if (! empty($arResult['PROPERTIES']['VIDEO']['VALUE'])):?>
    <div class="section-video">
        <div class="section-video__container container">
            <div class="section-video__block">
                <?foreach ($arResult['PROPERTIES']['VIDEO']['VALUE'] as $video):?>
                    <div class="videoWrapper">
                        <iframe width="1195"
                                height="672"
                                src="https://www.youtube.com/embed/<?= $video?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                        >
                        </iframe>
                    </div>
                    <br>
                <?endforeach?>
            </div>
        </div>
    </div>
<?endif?>