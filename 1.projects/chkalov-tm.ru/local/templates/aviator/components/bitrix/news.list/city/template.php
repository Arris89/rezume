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
<?
$cc = 0;
foreach ($arResult["ITEMS"] as $arItem):
    if ($cc == 0) { ?>
        <li>

            <input type="radio" checked name="city" id="<?= $arItem['CODE'] ?>" class="cityin">
            <label for="moscow"><? echo $arItem["NAME"] ?></label>
            <?

            ?>

        </li>
    <? } else { ?>
        <li>
            <input type="radio" name="city" id="<?= $arItem['CODE'] ?>" class="cityin">
            <label for="moscow"><? echo $arItem["NAME"] ?></label>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
        </li>
    <?
    }
    $cc++;
endforeach; ?>



