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

       <li class="setbg__item">
         <div 
           class="setbg__block js-set-bg" 
           data-id="<?=$arItem['ID']?>" 
           style="background: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)">
         </div>
        </li>

<?
$i++;
endforeach;?>


