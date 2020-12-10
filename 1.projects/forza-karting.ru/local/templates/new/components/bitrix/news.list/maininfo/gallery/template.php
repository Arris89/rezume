<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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


<?
$i = 1;
foreach($arResult["ITEMS"] as $arItem):?>


    <div class="gallery-slide col-lg-6" id="gallery-slide-<?=$i?>" data-title="<?=$arItem['NAME']?>" data-date="2 февраля 2019 года" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/<?=$arItem;?>);">
    </div>


<?
$i++;
endforeach;?>


