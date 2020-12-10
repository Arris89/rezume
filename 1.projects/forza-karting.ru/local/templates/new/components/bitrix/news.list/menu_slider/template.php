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


<? if (isset($arResult["ITEMS"])) { ?>
    <section class="section section-restaurant-menu">
        <div class="restaurant-menu-slides">

            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <div class="restaurant-menu-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <h3><? echo $arItem['NAME']; ?></h3>
                    <div class="restaurant-menu">
                        <div class="restaurant-menu-image">
                            <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>">
                        </div>
                        <div class="restaurant-menu-info">
                            <? if (isset($arItem['PROPERTIES']['TEXT_NAME']['VALUE'])) { ?><span
                                    class="restaurant-menu-category"><?= $arItem['PROPERTIES']['TEXT_NAME']['VALUE'] ?></span><? } ?>
                            <div class="restaurant-menu-name"><span
                                        class="js-arrow-name"><?= $arItem['PROPERTIES']['PRODUCT_NAME']['VALUE'] ?></span>
                            </div>
                            <hr>
                            <? if (isset($arItem['PREVIEW_TEXT'])) { ?>
                                <p class="restaurant-menu-desc">
                                    <? echo $arItem['PREVIEW_TEXT']; ?>
                                </p>
                            <? } ?>
                            <? if (isset($arItem['PROPERTIES']['PRICE']['VALUE'])) { ?>
                                <div class="restaurant-menu-price"><?= $arItem['PROPERTIES']['PRICE']['VALUE'] ?>
                                руб.</div><? } ?>
                            <a class="restaurant-menu-pdf-menu"
                               href="/upload/ALL-IN-ONE%20forza-karting-restaurant-main-menu-2019.pdf" target="_blank"
                               tabindex="0">Скачать меню в PDF &gt;&gt;</a>
                        </div>
                    </div>
                </div>

            <? endforeach; ?>

        </div>
    </section>
<? } ?>