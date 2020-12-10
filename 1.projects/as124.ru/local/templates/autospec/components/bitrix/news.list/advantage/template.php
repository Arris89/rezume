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



<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>

<? $iss = 0; ?>
<? foreach ($arResult["ITEMS"] as $arItem): ?>


    <? if ($iss == 2) { ?>

        <div class="mainblock__sector mainblock__sector_big">


            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>


            <div class="mainblock__items">
                <div class="mainblock__caption"><? echo $arItem["NAME"] ?></div>
                <a href="#" class="btn btn_gray btn-callback">Узнать</a>
            </div>


            <div class="mainblock__img mainblock__img_big">

                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                    <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>


                        <? echo htmlspecialcharsBack($arItem['PROPERTIES']['ICON']['VALUE']['TEXT']); ?>
                    <?
                    else: ?>

                        <? echo htmlspecialcharsBack($arItem['PROPERTIES']['ICON']['VALUE']['TEXT']); ?>
                    <?endif; ?>
                <?endif ?>
            </div>
        </div>


    <?
    } else {
        ?>

        <div class="mainblock__sector">
            <div class="mainblock__img">

                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                    <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>

                        <? echo htmlspecialcharsBack($arItem['PROPERTIES']['ICON']['VALUE']['TEXT']); ?>
                    <?
                    else: ?>

                        <? echo htmlspecialcharsBack($arItem['PROPERTIES']['ICON']['VALUE']['TEXT']); ?>
                    <?endif; ?>
                <?endif ?>

            </div>
            <div class="mainblock__desc"><? echo $arItem["NAME"] ?></div>
        </div>
        <?
    }

    $iss++ ?>
<? endforeach; ?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>

