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


<section class="mainslider section fadeInUp-scroll">
    <div class="wrapper">
        <h2>Нам доверяют</h2>
        <div class="mainslider__row">
            <div class="mainslider__slick">


                <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
                    <?= $arResult["NAV_STRING"] ?>
                <? endif; ?>
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>


                    <div class="mainslider__slide">


                        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="mainslider__img">
                                    <img
                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                    /></a>
                            <? else: ?>
                                <a href="#" class="mainslider__img">
                                    <img
                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                    /></a>
                            <? endif; ?>
                        <? endif ?>
                        <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                            <? echo $arItem["DISPLAY_ACTIVE_FROM"] ?>
                        <? endif ?>
                        <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                        <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?>
                            <? else: ?>
                                <? echo $arItem["NAME"] ?>
                            <? endif; ?>
                            <? endif; ?>
                            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                <? echo $arItem["PREVIEW_TEXT"]; ?>
                            <? endif; ?>
                            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>

                            <? endif ?>
                            <? foreach ($arItem["FIELDS"] as $code => $value): ?>

                                <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>

                            <? endforeach; ?>
                            <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>

                                <?= $arProperty["NAME"] ?>:&nbsp;
                                <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                                    <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
                                <? else: ?>
                                    <?= $arProperty["DISPLAY_VALUE"]; ?>
                                <? endif ?>

                            <? endforeach; ?>
                    </div>
                <? endforeach; ?>

                <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                    <?= $arResult["NAV_STRING"] ?>
                <? endif; ?>


            </div>
            <div class="slick__arrow slick__arrow_left"></div>
            <div class="slick__arrow slick__arrow_right"></div>
        </div>
    </div>
</section>