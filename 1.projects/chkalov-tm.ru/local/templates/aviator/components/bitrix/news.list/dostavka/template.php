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
//var_dump($arResult);
?>
<div class="tabs-content" id="tabs" role="main" itemprop="description">

    <ul class="tabs-menu">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <li><a href="#<?= $arItem['ID'] ?>"><?= $arItem['NAME'] ?></a></li>
        <? endforeach; ?>
    </ul>


    <? foreach ($arResult["ITEMS"] as $arItem): ?>

        <div class="accordion-header"><?= $arItem['NAME'] ?></div>
        <div class="description   accordion-content" id="<?= $arItem['ID'] ?>">
            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                <p><img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt=""
                        style="float: left; margin: 0px 10px 10px 0px;"></p>
            <? endif ?>

            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                <? echo $arItem["PREVIEW_TEXT"]; ?>
            <? endif; ?>

        </div>
    <? endforeach; ?>


</div>

