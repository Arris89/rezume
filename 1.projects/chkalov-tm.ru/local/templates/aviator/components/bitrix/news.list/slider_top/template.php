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


use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs($templateFolder . "/owl.carousel.min.js");
Asset::getInstance()->addCss($templateFolder . "/owl.carousel.min.css");

?>

<div class="main-top-offer owl-carousel owl-theme owl-loaded owl-drag">

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <div class="item">
            <a rel="nofollow" href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>" target="_blank">
                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_TEXT"] ?>">
            </a>
        </div>
    <? endforeach; ?>

</div>





