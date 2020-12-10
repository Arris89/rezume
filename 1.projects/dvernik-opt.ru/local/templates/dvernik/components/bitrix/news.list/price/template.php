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


foreach ($arResult["ITEMS"] as $arItem):

    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <li class="price__item price-item">


        <p class="price-item__name"><? echo $arItem["NAME"] ?></p>

        <div class="price-item__content">
                       <span
                               class="price-item__value price-item__value_10"><?= $arItem["PROPERTIES"]["PRICE10"]["VALUE"] ?>
                           руб</span>
            <span
                    class="price-item__value price-item__value_100"><?= $arItem["PROPERTIES"]["PRICE100"]["VALUE"] ?>
                руб</span>
            <span
                    class="price-item__value price-item__value_1000"><?= $arItem["PROPERTIES"]["PRICE1000"]["VALUE"] ?>
                руб</span>
        </div>

    </li>
<? endforeach; ?>
