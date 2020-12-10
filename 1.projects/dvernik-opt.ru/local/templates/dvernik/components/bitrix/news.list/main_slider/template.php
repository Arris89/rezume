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


foreach ($arResult["ITEMS"] as $arItem):?>
    <div class="promo__item promo__item_position_1">
        <div class="promo__inner">


            <h2 class="promo__title title title_h2"><? echo $arItem["NAME"] ?></h2>
            <? echo $arItem["PREVIEW_TEXT"]; ?>
            <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"] ?>" style="color: #fff; text-decoration: none;"> <button class="promo__btn btn" type="button">Подобрать</button></a>


        </div>
    </div>
<? endforeach; ?>


