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


    <div class="col-6">
        <div class="about-academy-item">
            <svg>
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/<? echo $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>"></use>
            </svg>
            <span><? echo $arItem["PREVIEW_TEXT"]; ?></span>
        </div>
    </div>


<? endforeach; ?>


