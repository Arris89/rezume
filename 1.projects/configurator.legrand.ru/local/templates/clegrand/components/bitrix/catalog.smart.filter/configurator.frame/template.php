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

$iblockPropsReference = $arResult['IBLOCK_PROPS_REFERENCE'];
?>

<div class="config-panel__column select-col-frame-js">
    <div class="config-panel__title">
        выбор рамки
    </div>

    <div class="config-panel__select-row">
        <div class="config-panel__select select-frame-collection air-select air-select_frame">
            <select name="collection" class="select style style-2 select-js js-scroll-select" id="collect">
                <option value="all" data-name="all">
                    Коллекция
                </option>

                <?
                $collectionId = $iblockPropsReference['COLLECTION']['ID'];
                foreach ($arResult['ITEMS'][ $collectionId ]['VALUES'] as $idCollection => $arCollection):?>
                    <option value="<?= $arCollection['VALUE']?>"
                            data-query="<?= $arCollection['CONTROL_NAME_ALT'].'='.$arCollection['HTML_VALUE_ALT']?>"
                            data-filter="<?= $arCollection['CONTROL_NAME_ALT']?>"
                            data-filter-value="<?= $idCollection?>"
                            data-type-all="frame"
                            <?//= ($arCollection['DISABLED'] == 1) ? 'disabled' : ''?>
                            <?= ($arCollection['CHECKED'] == 1) ? 'selected' : ''?>
                    >
                        <?= $arCollection['VALUE']?>
                    </option>
                <?endforeach?>
            </select>
        </div>
    </div>

    <div class="config-panel__select-row config-panel__select-row_2">
        <div class="config-panel__select config-panel__select_color select-frame-color air-select air-select_frame">
            <select name="frame-color" class="select style style-2 select-js js-scroll-select" id="color">
                <option value="all" data-name="all" class="color-opt">
                    Цвет
                </option>

                <?
                $colorId = $iblockPropsReference['FRAME_COLOR']['ID'];
                foreach ($arResult['ITEMS'][ $colorId ]['VALUES'] as $idColorRam => $arColorRam):?>
                    <option class="color-opt"
                            value="<?= $arColorRam['VALUE']?>"
                            data-query="<?= $arColorRam['CONTROL_NAME_ALT'].'='.$arColorRam['HTML_VALUE_ALT']?>"
                            data-filter="<?= $arColorRam['CONTROL_NAME_ALT']?>"
                            data-filter-value="<?= $arColorRam['VALUE']?>"
                            <?= ($arColorRam['DISABLED'] == 1) ? 'disabled' : ''?>
                            <?= ($arColorRam['CHECKED'] == 1) ? 'selected' : ''?>
                    >
                        <?= $arColorRam['VALUE']?>
                    </option>
                <?endforeach?>
            </select>
        </div>

        <div class="config-panel__select config-panel__select_flex select-frame-material air-select air-select_frame">
            <select name="frame-material" class="select style style-2 select-js js-scroll-select" id="material">
                <option value="all" data-name="all">
                    Материал
                </option>

                <?
                $materialId = $iblockPropsReference['FRAME_MATERIAL']['ID'];
                foreach ($arResult['ITEMS'][ $materialId ]['VALUES'] as $idMaterial => $arMaterial):?>
                    <option class="mat-opt"
                            value="<?= $arMaterial['VALUE']?>"
                            data-query="<?= $arMaterial['CONTROL_NAME_ALT'].'='.$arMaterial['HTML_VALUE_ALT']?>"
                            data-filter="<?= $arMaterial['CONTROL_NAME_ALT']?>"
                            data-filter-value="<?= $arMaterial['VALUE']?>"
                            <?= ($arMaterial['DISABLED'] == 1) ? 'disabled' : ''?>
                            <?= ($arMaterial['CHECKED'] == 1) ? 'selected' : ''?>
                    >
                        <?= $arMaterial['VALUE']?>
                    </option>
                <?endforeach?>
            </select>
        </div>
    </div>
</div>