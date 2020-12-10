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


<?foreach($arResult["ITEMS"] as $arItem):?>

     <div class="main-novelty__item">
                <div class="novelty-item">
                  <div class="novelty-item__image">
                  	<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" role="presentation"/>
                  </div>
                  <a class="novelty-item__title" href="#">
                  	<?echo $arItem["NAME"]?>
                  	</a>
                  <div class="novelty-item__text">
                  	<?echo $arItem["PREVIEW_TEXT"];?>
                  </div>
                </div>
              </div>


<?endforeach;?>


