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
$ig = 0;
foreach ($arResult["ITEMS"] as $arItem):

    if ($ig < 2) {
        ?>

        <div class="maintrucks__coll maintrucks__coll_left">
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="maintrucks__box">

                <div class="maintrucks__caption"><? echo $arItem["NAME"] ?></div>
                <div class="maintrucks__img">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="">
                </div>

                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

            </a>
        </div>


        <?
    } elseif ($ig == 2) { ?>

        <div class="maintrucks__coll">
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="maintrucks__box">

                <div class="maintrucks__caption"><? echo $arItem["NAME"] ?></div>
                <div class="maintrucks__img maintrucks__img_items">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="">
                </div>

                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>


            </a>
        </div>

    <?
    } elseif ($ig == 4) { ?>

        <div class="maintrucks__coll">
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="maintrucks__box">

                <div class="maintrucks__caption"><? echo $arItem["NAME"] ?></div>
                <div class="maintrucks__img">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="">
                </div>

                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>


            </a>
        </div>

    <?
    } else { ?>


        <div class="maintrucks__coll">


            <?php
            if ($arItem['NAME'] == 'Чем перевозим') { ?>
            <a href="/chem-perevozim/" class="maintrucks__box">
                <? } else { ?>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="maintrucks__box">
                    <?
                    } ?>

                    <div class="maintrucks__caption"><? echo $arItem["NAME"] ?></div>
                    <div class="maintrucks__img maintrucks__img_items">
                        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="">
                    </div>

                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>


                </a>
        </div>


    <? }


    $ig++;
endforeach; ?>


