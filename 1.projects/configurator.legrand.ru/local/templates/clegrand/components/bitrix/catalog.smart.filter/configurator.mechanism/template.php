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

$iblockPropsReference = \FourPx\Helper::getIBlockPropsReference('CATALOG');
?>

<div class="config-panel__column select-col-mechanism-js">
    <div class="config-panel__title">
        выбор механизма
    </div>

    <div class="config-panel__select-row">
        <div class="config-panel__select select-mech-collection air-select air-select_mechanism">
            <select name="mechanism" class="select style style-2 select-js js-scroll-select" id="function">
                <option value="all" data-name="all">
                    Группа функций
                </option>

                <?
                $functionGroupId = $iblockPropsReference['FUNCTION_GROUP']['ID'];
                foreach ($arResult['ITEMS'][ $functionGroupId ]['VALUES'] as $idFunction => $arFunction):?>
                    <option class="func-opt"
                            value="<?= $arFunction['VALUE']?>"
                            data-query="<?= $arFunction['CONTROL_NAME_ALT'].'='.$arFunction['HTML_VALUE_ALT']?>"
                            data-filter="<?= $arFunction['CONTROL_NAME_ALT']?>"
                            data-type-all="mechanism"
                            data-filter-value="<?= $arFunction['VALUE']?>"
                            <?= ($arFunction['DISABLED'] == 1) ? 'disabled' : ''?>
                            <?= ($arFunction['CHECKED'] == 1) ? 'selected' : ''?>
                    >
                        <?= $arFunction['VALUE']?>
                    </option>
                <?endforeach?>
            </select>
        </div>
    </div>

    <div class="config-panel__select-row">
        <div class="config-panel__select config-panel__select_color select-mech-color air-select air-select_mechanism">
            <select name="mechanism-color" class="select style style-2 select-js js-scroll-select" id="color-func">
                <option value="all" data-name="all">
                    Цвет
                </option>

                <?
                $colorId = $iblockPropsReference['FUNCTION_COLOR']['ID'];
                foreach ($arResult['ITEMS'][ $colorId ]['VALUES'] as $idColorMex => $arColorMex):?>
                    <option class="colf-opt"
                            value="<?= $arColorMex['VALUE']?>"
                            data-query="<?= $arColorMex['CONTROL_NAME_ALT'].'='.$arColorMex['HTML_VALUE_ALT']?>"
                            data-filter="<?= $arColorMex['CONTROL_NAME_ALT']?>"
                            data-filter-value="<?= $arColorMex['VALUE']?>"
                            <?= ($arColorMex['DISABLED'] == 1) ? 'disabled' : ''?>
                            <?= ($arColorMex['CHECKED'] == 1) ? 'selected' : ''?>
                    >
                        <?= $arColorMex['VALUE']?>
                    </option>
                <?endforeach?>
            </select>
        </div>
    </div>
</div>