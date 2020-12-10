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
    <!--<?= $arResult["NAV_STRING"] ?>-->
<? endif; ?>
<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="review-block" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="review-text">
            <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
            <div class="review-block-title">
                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                    <span class="review-block-name">	<a
                                href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a></span>
                <? else: ?>
                    <span class="review-block-name">	<? echo $arItem["NAME"] ?></span>
                <? endif; ?>
                <? endif; ?>
                <span class="review-block-description">
			<?
            if ($arItem["DISPLAY_ACTIVE_FROM"]) {
                echo $arItem["DISPLAY_ACTIVE_FROM"] . '.,';
            } ?>

            <? $res = CIBlockElement::GetByID($arItem['ID']);
            while ($obRes = $res->GetNextElement()) {
                $ar_res = $obRes->GetProperty("POSITION");
                if ($ar_res['VALUE']) {
                    echo $ar_res['VALUE'] . ',';
                }
                $ar_res2 = $obRes->GetProperty("COMPANY");
            } ?>

            <? echo $ar_res2['VALUE']; ?>  </span></div>
            <div class="review-text-cont">
                <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                    <? echo $arItem["PREVIEW_TEXT"]; ?>
                <? endif; ?>
            </div>
        </div>
        <div class="review-img-wrap">

            <? if ($arItem["PREVIEW_PICTURE"]) { ?>
                <img
                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                />
            <? } else { ?>
                <img
                        src="<?= SITE_TEMPLATE_PATH ?>/img/rew/no_photo.jpg"
                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                />
            <? } ?>

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
    </div>
<? endforeach; ?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>





           
                 