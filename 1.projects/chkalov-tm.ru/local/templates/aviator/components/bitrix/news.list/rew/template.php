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


<?php if ($arResult["ITEMS"]) { ?>

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <div class="item">
            <?
           // $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
           // $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>

            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>

                    <div class="avatar">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img

                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    height="115" width="114"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                            /></a>

                    </div>
                <? else: ?>
                    <div class="avatar">
                        <img

                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                height="115" width="114"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                        />
                    </div>
                <? endif; ?>
            <? endif ?>

            <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                    <div class="name"><? echo $arItem["NAME"] ?></div>
                <? else: ?>
                    <div class="name"><? echo $arItem["NAME"] ?></div>
                <? endif; ?>
            <? endif; ?>

            <div class="text">
                <div class="date">
                    <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                        <? echo $arItem["DISPLAY_ACTIVE_FROM"] ?>
                    <? endif ?>

                </div>

                <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                    <span style="word-break: break-all;"><? echo $arItem["PREVIEW_TEXT"]; ?></span>
                <? endif; ?>

            </div>
        </div>

    <? endforeach; ?>


<? } else { ?>

    <p>Оставьте отзыв об этом товаре первым</p>

<? } ?>