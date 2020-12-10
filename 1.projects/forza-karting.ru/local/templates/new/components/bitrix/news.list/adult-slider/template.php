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
?>




<? foreach ($arResult["ITEMS"] as $arItem): ?>


    <div class="slider-light-columns__slide">
        <div class="slider-light-columns__slide-inner">
            <div class="slider-light-columns__column slider-light-columns__column_img"
                 style="background-image: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></div>
            <div class="slider-light-columns__column slider-light-columns__column_text">
                <div class="slider-light-columns__sub-title"><?= $arItem['PROPERTIES']['DAY']['VALUE'] ?></div>
                <div class="slider-light-columns__title">         <? echo $arItem["NAME"] ?> <span
                            class="slider-light-columns__title-accent"><?= $arItem['PROPERTIES']['LONG']['VALUE'] ?></span>
                </div>
                <div class="slider-light-columns__base-info">
                    <div class="properties">

                        <? if ($arItem['PROPERTIES']['START']['VALUE']) { ?>
                            <div class="properties__row"><span class="properties__name">Время</span><span
                                        class="properties__line"></span><span
                                        class="properties__value"><?= $arItem['PROPERTIES']['START']['VALUE'] ?></span>
                            </div>
                        <? } ?>
                        <? if ($arItem['PROPERTIES']['TIME']['VALUE']) { ?>
                            <div class="properties__row"><span class="properties__name">Продолжительность</span><span
                                        class="properties__line"></span><span
                                        class="properties__value"><?= $arItem['PROPERTIES']['TIME']['VALUE'] ?></span>
                            </div>
                        <? } ?>

                        <? if ($arItem['PROPERTIES']['PROG']['VALUE']) { ?>
                            <div class="properties__row"><span class="properties__name">Занятие включает</span><span
                                        class="properties__line"></span><span
                                        class="properties__value"><?= $arItem['PROPERTIES']['PROG']['VALUE'] ?></span>
                            </div>
                        <? } ?>

                        <? if ($arItem['PROPERTIES']['TRENER']['VALUE']) { ?>
                            <div class="properties__row"><span class="properties__name">Тренеры</span><span
                                        class="properties__line"></span><span
                                        class="properties__value"><?= $arItem['PROPERTIES']['TRENER']['VALUE'] ?></span>
                            </div>
                        <? } ?>

                        <? if ($arItem['PROPERTIES']['PRICE']['VALUE']) { ?>
                            <div class="properties__row"><span class="properties__name">Стоимость 1 занятия</span><span
                                        class="properties__line"></span><span class="properties__value"><b
                                            class="text-accent"><?= $arItem['PROPERTIES']['PRICE']['VALUE'] ?></b></span>
                            </div>
                        <? } ?>

                        <? if ($arItem['PROPERTIES']['ABON']['VALUE']) { ?>
                            <div class="properties__row"><span class="properties__name">Стоимость абонемента</span><span
                                        class="properties__line"></span><span
                                        class="properties__value"><?= $arItem['PROPERTIES']['ABON']['VALUE'] ?></span>
                            </div>
                        <? } ?>


                    </div>
                </div>
                <div class="slider-light-columns__descr">
                    <? echo $arItem["PREVIEW_TEXT"]; ?>
                </div>
            </div>
        </div>
    </div>


<? endforeach; ?>


