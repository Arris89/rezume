<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>
<ul class="menu-h pagination js-pagination">
    <? if ($arResult["bDescPageNumbering"] === true): ?>
        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
            <? if ($arResult["bSavePage"]): ?>

                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("nav_prev") ?></a>
            <? else: ?>
                <? if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)): ?>
                <? else: ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
                        <?= GetMessage("nav_prev") ?></a>
                <? endif ?>
            <? endif ?>
        <? endif ?>
        <? if ($arResult["NavPageNomer"] > 1): ?>
        <? else: ?>
            <?= GetMessage("nav_next") ?>&nbsp;&nbsp;<?= GetMessage("nav_end") ?>
        <? endif ?>
    <? else: ?>
        <? if ($arResult["NavPageNomer"] > 1): ?>
            <? if ($arResult["bSavePage"]): ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_prev") ?></a>
            <? else: ?>
                <? if ($arResult["NavPageNomer"] > 2): ?>
                <? else: ?>
                    <li><a class="inline-link" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">←</a>
                    </li>
                <? endif ?>
            <? endif ?>
        <? endif ?>
        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
            <li><a class="inline-link"
                   href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">→</a>
            </li>
        <? endif ?>
    <? endif ?>
</ul>
