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


<ul class="main-features__list">

    <? foreach ($arResult["ITEMS"] as $arItem): ?>


        <li class="main-features__item">
            <div class="main-features__img-area">

                <?= htmlspecialchars_decode($arItem['PROPERTIES']['ICON']['VALUE']['TEXT']) ?>
            </div>

            <div class="main-features__content">
                <h4 class="main-features__title title title_h4">
                    <? echo $arItem["NAME"] ?>
                </h4>
                <p class="main-features__text">
                    <? echo $arItem["PREVIEW_TEXT"]; ?>
                </p>
            </div>


        </li>
    <? endforeach; ?>


</ul>