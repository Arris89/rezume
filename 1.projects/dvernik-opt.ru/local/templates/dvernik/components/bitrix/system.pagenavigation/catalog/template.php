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


<div class="view-controls__pagination pagination">

    <?

    if (!$arResult["NavShowAlways"]) {
        if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
            return;
    }

    $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
    $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
    ?>

    <? if ($arResult["bDescPageNumbering"] === true): ?>
        <br/>
        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
            <? if ($arResult["bSavePage"]): ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><?= GetMessage("nav_begin") ?></a>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("nav_prev") ?></a>
            <? else: ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("nav_begin") ?></a>
                <? if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)): ?>
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("nav_prev") ?></a>
                <? else: ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("nav_prev") ?></a>
                <? endif ?>
            <? endif ?>
        <? else: ?>
            <?= GetMessage("nav_begin") ?>&nbsp;|&nbsp;<?= GetMessage("nav_prev") ?>&nbsp;|
        <? endif ?>

        <? while ($arResult["nStartPage"] >= $arResult["nEndPage"]): ?>
            <? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

            <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                <b>ц1<?= $NavRecordGroupPrint ?></b>
            <? elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false): ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>
            <? else: ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
            <? endif ?>

            <? $arResult["nStartPage"]-- ?>
        <? endwhile ?>

        <? if ($arResult["NavPageNomer"] > 1): ?>
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_next") ?></a>

            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= GetMessage("nav_end") ?></a>
        <? else: ?>
            <?= GetMessage("nav_next") ?>&nbsp;|&nbsp;<?= GetMessage("nav_end") ?>
        <? endif ?>

    <? else: ?>

        <? if ($arResult["NavPageNomer"] > 1): ?>

            <? if ($arResult["bSavePage"]): ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= GetMessage("nav_begin") ?></a>

                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_prev") ?></a>

            <? else: ?>

                <? if ($arResult["NavPageNomer"] > 2): ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">
                        <button class="pagination__btn pagination__btn_prev"
                                type="button"><?= GetMessage("nav_prev") ?></button>
                    </a>
                <? else: ?>
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">
                        <button class="pagination__btn pagination__btn_prev"
                                type="button"><?= GetMessage("nav_prev") ?></button>
                    </a>
                <? endif ?>

            <? endif ?>

        <? else: ?>
            <button class="pagination__btn pagination__btn_prev" type="button">
                <?= GetMessage("nav_begin") ?>&nbsp;|&nbsp;

                <?= GetMessage("nav_prev") ?>&nbsp;|
            </button>
        <? endif ?>

        <ul class="pagination__list">
            <? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

                <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                    <li class="pagination__item"><a class="pagination__link pagination__link_active"
                                                    href="javascript:void(0)"><?= $arResult["nStartPage"] ?></a></li>
                <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                    <li class="pagination__item"><a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                                                    class="pagination__link"><?= $arResult["nStartPage"] ?></a></li>
                <? else: ?>
                    <li class="pagination__item"><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"
                                class="pagination__link"><?= $arResult["nStartPage"] ?></a></li>
                <? endif ?>
                <? $arResult["nStartPage"]++ ?>
            <? endwhile ?>
        </ul>

        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
                <button class="pagination__btn pagination__btn_next"
                        type="button"><?= GetMessage("nav_next") ?></button>
            </a>
        <? else: ?>
            <button class="pagination__btn pagination__btn_next" type="button"><?= GetMessage("nav_next") ?>&nbsp;|
                &nbsp;<?= GetMessage("nav_end") ?></button>
        <? endif ?>
    <? endif ?>

    <? if ($arResult["bShowAll"]): ?>
        <noindex>
            <? if ($arResult["NavShowAll"]): ?>
                |&nbsp;<a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=0"
                        rel="nofollow"><?= GetMessage("nav_paged") ?></a>
            <? else: ?>
                |&nbsp;<a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=1"
                        rel="nofollow"><?= GetMessage("nav_all") ?></a>
            <? endif ?>
        </noindex>
    <? endif ?>
</div>