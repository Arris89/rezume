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

    <div class="carting-class-info__prices-item">
        <div class="carting-class-info__prices-title"><? echo $arItem["NAME"] ?></div>

        <div class="carting-class-info__prices-descr">
           <? if($arItem["PROPERTIES"]["PERENOS"]["VALUE"]){?>
            (<? echo $arItem["PROPERTIES"]["PERENOS"]["VALUE"] ?>)
        <?}?>
        </div>

        <div class="carting-class-info__prices-price"><? echo $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?> руб.</div>
    </div>
    
<? endforeach; ?>


