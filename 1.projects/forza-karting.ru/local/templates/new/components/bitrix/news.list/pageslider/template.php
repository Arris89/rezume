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


    <div class="sports-hall-slide">
        <h3><? echo $arItem["NAME"] ?></h3>
        <div class="sports-hall">
            <div class="sports-hall-image"><img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"></div>
            <div class="sports-hall-info">
                <p class="sports-hall-desc"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
            </div>
        </div>
    </div>


<? endforeach; ?>


