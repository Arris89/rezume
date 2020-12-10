<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");

$colorSchemes = array(
    "green" => "bx-green",
    "yellow" => "bx-yellow",
    "red" => "bx-red",
    "blue" => "bx-blue",
);
if (isset($colorSchemes[$arParams["TEMPLATE_THEME"]])) {
    $colorScheme = $colorSchemes[$arParams["TEMPLATE_THEME"]];
} else {
    $colorScheme = "";
}
?>


<ul class="pagination">
    <? if ($arResult["bDescPageNumbering"] === true): ?>

        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
            <? if ($arResult["bSavePage"]): ?>
                <li class="bx-pag-prev">1<a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><span><? echo GetMessage("round_nav_back") ?></span></a>
                </li>
                <li class="">21<a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><span>1</span></a>
                </li>
            <? else: ?>
                <? if (($arResult["NavPageNomer"] + 1) == $arResult["NavPageCount"]): ?>
                    <li class="bx-pag-prev">8<a
                                href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><span><? echo GetMessage("round_nav_back") ?></span></a>
                    </li>
                <? else: ?>
                    <li class="bx-pag-prev">2<a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><span><? echo GetMessage("round_nav_back") ?></span></a>
                    </li>
                <? endif ?>
                <li class="">22<a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><span>1</span></a>
                </li>
            <? endif ?>
        <? else: ?>
            <li class="bx-pag-prev">3<span><? echo GetMessage("round_nav_back") ?></span></li>
            <li class="bx-active"><span>1</span></li>13
        <? endif ?>

        <?
        $arResult["nStartPage"]--;
        while ($arResult["nStartPage"] >= $arResult["nEndPage"] + 1):
            ?>
            <? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

            <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
            <li class="bx-active"><span><?= $NavRecordGroupPrint ?></span></li>14
        <? else:?>
            <li class="">23<a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><span><?= $NavRecordGroupPrint ?></span></a>
            </li>
        <? endif ?>

            <? $arResult["nStartPage"]-- ?>
        <? endwhile ?>

        <? if ($arResult["NavPageNomer"] > 1): ?>
            <? if ($arResult["NavPageCount"] > 1): ?>
                <li class="">24<a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><span><?= $arResult["NavPageCount"] ?></span></a>
                </li>
            <? endif ?>
            <li class="bx-pag-next">33<a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><span><? echo GetMessage("round_nav_forward") ?></span></a>
            </li>
        <? else: ?>
            <? if ($arResult["NavPageCount"] > 1): ?>
                <li class="bx-active"><span><?= $arResult["NavPageCount"] ?></span></li>15
            <? endif ?>
            <li class="bx-pag-next">34<span><? echo GetMessage("round_nav_forward") ?></span></li>
        <? endif ?>

    <? else: ?>

        <? if ($arResult["NavPageNomer"] > 1): ?>
            <? if ($arResult["bSavePage"]): ?>
                <li class="bx-pag-prev">4<a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><span><? echo GetMessage("round_nav_back") ?></span></a>
                </li>
                <li class="">25<a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><span>1</span></a>
                </li>
            <? else: ?>
                <? if ($arResult["NavPageNomer"] > 2): ?>

                    <li id="pagination_previous_bottom" class="pagination_previous">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">
                            <i class="icon-chevron-left"></i> <b>Назад</b>
                        </a>
                    </li>
                <? else: ?>

                    <li id="pagination_previous_bottom" class="pagination_previous">
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">
                        <span>
                            <i class="icon-chevron-left"></i> <b>Назад</b>
                        </span>
                        </a>
                    </li>
                <? endif ?>
                <li class=""><a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><span>1</span></a></li>
            <? endif ?>
        <? else: ?>

            <li id="pagination_previous_bottom" class="disabled pagination_previous"> <span>
                            <i class="icon-chevron-left"></i> <b>Назад</b>
                        </span></li>

            <li class="active current"><span>
                                <span>1</span>
                            </span></li>
        <? endif ?>

        <?
        $arResult["nStartPage"]++;
        while ($arResult["nStartPage"] <= $arResult["nEndPage"] - 1):
            ?>
            <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>

            <li class="active current">
                            <span>
                                <span><?= $arResult["nStartPage"] ?></span>
                            </span>
            </li>

        <? else:?>
            <li>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><span><?= $arResult["nStartPage"] ?></span></a>
            </li>
        <? endif ?>
            <? $arResult["nStartPage"]++ ?>
        <? endwhile ?>

        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
            <? if ($arResult["NavPageCount"] > 1): ?>
                <li>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><span><?= $arResult["NavPageCount"] ?></span></a>
                </li>
            <? endif ?>

            <li id="pagination_next_bottom" class="pagination_next"><a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                        rel="next"> <b>Вперед</b> <i class="icon-chevron-right"></i></a></li>

        <? else: ?>
            <? if ($arResult["NavPageCount"] > 1): ?>


                <li class="active current">
                            <span>
                                <span><?= $arResult["NavPageCount"] ?></span>
                            </span>
                </li>
            <? endif ?>

            <li id="pagination_next_bottom" class="pagination_next disabled">
                   <span>
                        <b>Вперед</b> <i class="icon-chevron-right"></i>
                  </span>
            </li>

        <? endif ?>
    <? endif ?>

    <? if ($arResult["bShowAll"]): ?>
        <? if ($arResult["NavShowAll"]): ?>
            <li class="bx-pag-all"><a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=0"
                        rel="nofollow"><span><? echo GetMessage("round_nav_pages") ?></span></a></li>
        <? else: ?>
            <li class="bx-pag-all"><a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=1"
                        rel="nofollow"><span><? echo GetMessage("round_nav_all") ?></span></a></li>
        <? endif ?>
    <? endif ?>
</ul>
