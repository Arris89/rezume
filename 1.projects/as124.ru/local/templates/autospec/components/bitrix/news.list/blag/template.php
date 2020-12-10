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

<?php
if ($arResult["ITEMS"]) {
    ?>

    <div class="about__row about__row_items flex fadeInUp-scroll">
        <div class="about__caption">Благодарности</div>
        <div class="about__content">
            <div class="about__slick">


                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>


                    <a href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" data-fancybox="gallery" class="about__img">

                        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>

                                <img
                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                />
                            <? else: ?>
                                <img
                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                />
                            <? endif; ?>
                        <? endif ?>

                    </a>


                <? endforeach; ?>

            </div>
            <div class="slick__arrow slick__arrow_left"></div>
            <div class="slick__arrow slick__arrow_right"></div>
        </div>
    </div>


<? } ?>