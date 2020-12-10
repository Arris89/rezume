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

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>



<? if ($arResult["bDescPageNumbering"] === true): ?>

<?= $arResult["NavFirstRecordShow"] ?> <?= GetMessage("nav_to") ?> <?= $arResult["NavLastRecordShow"] ?> <?= GetMessage("nav_of") ?> <?= $arResult["NavRecordCount"] ?>



<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
    <? if ($arResult["bSavePage"]): ?>


        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"
           class="pagination-link pagination-link_prev">
									<span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M10.634.292a1.063 1.063 0 0 0-1.464 0L.607 8.556a1.95 1.95 0 0 0 0 2.827l8.625 8.325c.4.385 1.048.39 1.454.01a.976.976 0 0 0 .01-1.425l-7.893-7.617a.975.975 0 0 1 0-1.414l7.83-7.557a.974.974 0 0 0 0-1.413"/>
										</svg>
									</span>Назад
        </a>


    <? else: ?>
        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
           class="pagination-link pagination-link_prev">
									<span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M10.634.292a1.063 1.063 0 0 0-1.464 0L.607 8.556a1.95 1.95 0 0 0 0 2.827l8.625 8.325c.4.385 1.048.39 1.454.01a.976.976 0 0 0 .01-1.425l-7.893-7.617a.975.975 0 0 1 0-1.414l7.83-7.557a.974.974 0 0 0 0-1.413"/>
										</svg>
									</span>Назад
        </a>

        <? if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)): ?>

        <? else: ?>


        <? endif ?>
    <? endif ?>
<? else: ?>

<? endif ?>

<? while ($arResult["nStartPage"] >= $arResult["nEndPage"]): ?>
<? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
<a href="#" class="pagination-item active"><?= $NavRecordGroupPrint ?></b>
    <? elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false): ?>
        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
           class="pagination-item"><?= $NavRecordGroupPrint ?></a>
    <? else: ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"
           class="pagination-item"><?= $NavRecordGroupPrint ?></a>
    <? endif ?>

    <? $arResult["nStartPage"]-- ?>
    <? endwhile ?>



    <? if ($arResult["NavPageNomer"] > 1): ?>

        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"
           class="pagination-link pagination-link_next">
            Вперед
            <span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M.366 19.708c.405.39 1.06.39 1.464 0l8.563-8.264a1.95 1.95 0 0 0 0-2.827L1.768.292A1.063 1.063 0 0 0 .314.282a.976.976 0 0 0-.01 1.425l7.893 7.617a.975.975 0 0 1 0 1.414l-7.83 7.557a.974.974 0 0 0 0 1.413"/>
										</svg>
									</span>
        </a>
    <? else: ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"
           class="pagination-link pagination-link_next">
            Вперед
            <span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M.366 19.708c.405.39 1.06.39 1.464 0l8.563-8.264a1.95 1.95 0 0 0 0-2.827L1.768.292A1.063 1.063 0 0 0 .314.282a.976.976 0 0 0-.01 1.425l7.893 7.617a.975.975 0 0 1 0 1.414l-7.83 7.557a.974.974 0 0 0 0 1.413"/>
										</svg>
									</span>
        </a>
    <? endif ?>

    <? else: ?>


        <? if ($arResult["NavPageNomer"] > 1): ?>

            <? if ($arResult["bSavePage"]): ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                   class="pagination-link pagination-link_prev">
									<span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M10.634.292a1.063 1.063 0 0 0-1.464 0L.607 8.556a1.95 1.95 0 0 0 0 2.827l8.625 8.325c.4.385 1.048.39 1.454.01a.976.976 0 0 0 .01-1.425l-7.893-7.617a.975.975 0 0 1 0-1.414l7.83-7.557a.974.974 0 0 0 0-1.413"/>
										</svg>
									</span>
                    Назад</a>


            <? else: ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                   class="pagination-link pagination-link_prev">
									<span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M10.634.292a1.063 1.063 0 0 0-1.464 0L.607 8.556a1.95 1.95 0 0 0 0 2.827l8.625 8.325c.4.385 1.048.39 1.454.01a.976.976 0 0 0 .01-1.425l-7.893-7.617a.975.975 0 0 1 0-1.414l7.83-7.557a.974.974 0 0 0 0-1.413"/>
										</svg>
									</span>
                    Назад</a>

                <? if ($arResult["NavPageNomer"] > 2): ?>

                <? else: ?>

                <? endif ?>

            <? endif ?>

        <? else: ?>
            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
               class="pagination-link pagination-link_prev">
									<span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M10.634.292a1.063 1.063 0 0 0-1.464 0L.607 8.556a1.95 1.95 0 0 0 0 2.827l8.625 8.325c.4.385 1.048.39 1.454.01a.976.976 0 0 0 .01-1.425l-7.893-7.617a.975.975 0 0 1 0-1.414l7.83-7.557a.974.974 0 0 0 0-1.413"/>
										</svg>
									</span>
                Назад</a>
        <? endif ?>

        <? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

            <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                <a href="#" class="pagination-item active"><?= $arResult["nStartPage"] ?></a>
            <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                   class="pagination-item"><?= $arResult["nStartPage"] ?></a>
            <? else: ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"
                   class="pagination-item"><?= $arResult["nStartPage"] ?></a>
            <? endif ?>
            <? $arResult["nStartPage"]++ ?>
        <? endwhile ?>


        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>

            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"
               class="pagination-link pagination-link_next">
                Вперед
                <span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M.366 19.708c.405.39 1.06.39 1.464 0l8.563-8.264a1.95 1.95 0 0 0 0-2.827L1.768.292A1.063 1.063 0 0 0 .314.282a.976.976 0 0 0-.01 1.425l7.893 7.617a.975.975 0 0 1 0 1.414l-7.83 7.557a.974.974 0 0 0 0 1.413"/>
										</svg>
									</span>
            </a>
        <? else: ?>
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"
               class="pagination-link pagination-link_next">
                Вперед
                <span class="pagination__icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="20"
                                             viewBox="0 0 11 20">
										    <path fill="#9E0000" fill-rule="evenodd"
                                                  d="M.366 19.708c.405.39 1.06.39 1.464 0l8.563-8.264a1.95 1.95 0 0 0 0-2.827L1.768.292A1.063 1.063 0 0 0 .314.282a.976.976 0 0 0-.01 1.425l7.893 7.617a.975.975 0 0 1 0 1.414l-7.83 7.557a.974.974 0 0 0 0 1.413"/>
										</svg>
									</span>
            </a>
        <? endif ?>

    <? endif ?>

