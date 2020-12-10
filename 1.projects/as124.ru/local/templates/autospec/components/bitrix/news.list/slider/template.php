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
$is = 0;
foreach ($arResult["ITEMS"] as $arItem):?>

    <? if ($is < 1) { ?>
        <div class="promo__row promo__left promo__active">
            <div class="promo__flex">

                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <div class="promo__coll">


                    <div class="promo__caption"><? echo $arItem["NAME"] ?></div>

                    <div class="promo__desc"><? echo $arItem["PREVIEW_TEXT"]; ?></div>


                    <a href="#" class="btn btn_while btn-special">Арендовать</a>
                </div>


                <div class="promo__items promo__items_left">
                    <div class="promo__img">

                        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                    <img


                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                    /></a>
                            <?
                            else: ?>
                                <img

                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                />
                            <?endif; ?>
                        <?endif ?>

                    </div>
                    <div class="promo__title">Cпецтехника</div>
                </div>
            </div>
        </div>

    <?
    } else { ?>


        <div class="promo__row promo__right">
            <div class="promo__flex">

                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <div class="promo__coll">


                    <div class="promo__caption"><? echo $arItem["NAME"] ?></div>

                    <div class="promo__desc"><? echo $arItem["PREVIEW_TEXT"]; ?></div>


                    <a href="#" class="btn btn_while btn-truck">Заказать</a>
                </div>


                <div class="promo__items  promo__items_right">
                    <div class="promo__img promo__img_right">

                        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                    <img


                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                    /></a>
                            <?
                            else: ?>
                                <img

                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                />
                            <?endif; ?>
                        <?endif ?>

                    </div>
                    <div class="promo__title">Грузоперевозки</div>
                </div>
            </div>
        </div>


    <?
    }


    $is++;
    ?>
<? endforeach; ?>

