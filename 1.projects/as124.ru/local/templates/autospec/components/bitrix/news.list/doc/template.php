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

    <div class="about__row flex fadeInUp-scroll">
        <div class="about__caption">Документация</div>
        <div class="about__list">


            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <?
                $VALUES = array();
                $res = CIBlockElement::GetProperty('27', $arItem['ID'], "sort", "asc", array("CODE" => "DOCUMENT"));
                while ($ob = $res->GetNext()) {
                    $VALUES[] = $ob['VALUE'];
                }
                foreach ($VALUES as $key => $valuedocs) {
                    $rsFile = CFile::GetByID($valuedocs);
                    $arFile = $rsFile->Fetch();
                    $href = "/upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . ""; // выстраиваем ссылку
                    ?>

                <? } ?>


                <a href="<?= $href ?>" class="mainlink">
                    <div class="mainlink__icons">

                        <svg width="16px" height="20px" viewBox="0 0 16 20" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
                            <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="от-1920-о-компании-автоспец" transform="translate(-827.000000, -1120.000000)"
                                   fill="#9E0000">
                                    <g id="Stacked-Group">
                                        <g id="доки" transform="translate(0.000000, 1032.000000)">
                                            <path d="M829,88 C827.9,88 827,88.9 827,90 L827,106 C827,107.1 827.9,108 829,108 L841,108 C842.1,108 843,107.1 843,106 L843,94 L837,88 L829,88 L829,88 Z M836,96 L836,90 L842,96 L836,96 L836,96 Z"
                                                  id="Shape-Copy-3"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>


                    <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                            <div class="mainlink__title"><? echo $arItem["NAME"] ?></div>
                        <? else: ?>
                            <div class="mainlink__title"><? echo $arItem["NAME"] ?></div>
                        <? endif; ?>
                    <? endif; ?>

                    <? foreach ($arItem["FIELDS"] as $code => $value): ?>

                        <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>

                    <? endforeach; ?>


                    <? $fz = $arFile['FILE_SIZE'] / 1024; ?>

                    <div class="mainlink__value">pdf, <?= ceil($fz) ?> kb</div>
                </a>
            <? endforeach; ?>


        </div>
    </div>

<? } ?>