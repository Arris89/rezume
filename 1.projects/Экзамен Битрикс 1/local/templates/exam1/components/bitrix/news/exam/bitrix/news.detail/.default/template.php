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

<header>
    <h1>
        <? $APPLICATION->ShowTitle(false); ?>
    </h1>
</header>
<hr>
<div class="review-block">
    <div class="review-text">
        <div class="review-text-cont">
            <? echo $arResult["DETAIL_TEXT"]; ?>
        </div>
        <div class="review-autor">

            <?
            echo $arResult["NAME"];
            if ($arResult["DISPLAY_ACTIVE_FROM"]) {
                echo ',&nbsp' . $arResult["DISPLAY_ACTIVE_FROM"] . 'г.';
            }
            echo $arResult["POSTN"]["VALUE"] . ',';
            echo ',&nbsp' . $arResult["COMP"]["VALUE"] . '.';
            ?>

        </div>
    </div>
    <div style="clear: both;" class="review-img-wrap">
        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) { ?>
            <img
                    src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                    width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                    height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"
                    alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                    title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
            />
            <?
        } else { ?>
            <img
                    src="<?= SITE_TEMPLATE_PATH ?>/img/rew/no_photo.jpg"
                    width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                    height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"
                    alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                    title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
            />
        <? } ?>
    </div>
</div>
<? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
<? endif; ?>
<? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
<? endif; ?>
<? if ($arResult["NAV_RESULT"]): ?>
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><? endif; ?>
    <? echo $arResult["NAV_TEXT"]; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><? endif; ?>
<? elseif (strlen($arResult["DETAIL_TEXT"]) > 0): ?>
<? else: ?>
    <? echo $arResult["PREVIEW_TEXT"]; ?>
<? endif ?>

<div class="exam-review-doc">
    <p>Документы:</p>
    <?
    foreach ($arResult["DOCPDF"] as $key => $valuedocs) {
        ?>
        <div class="exam-review-item-doc">
            <img class="rew-doc-ico" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/pdf_ico_40.png">
            <a href="/<?= $valuedocs["HREF"] ?>" download><?= $valuedocs["PDF"] ?></a>
        </div>
    <? } ?>
</div>

<hr>
<? if (array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y") {
    ?>
    <div class="news-detail-share">
        <noindex>
            <?
            $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                "HANDLERS" => $arParams["SHARE_HANDLERS"],
                "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                "PAGE_TITLE" => $arResult["~NAME"],
                "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                "HIDE" => $arParams["SHARE_HIDE"],
            ),
                $component,
                array("HIDE_ICONS" => "Y")
            );
            ?>
        </noindex>
    </div>
    <?
}
?>
