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
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>
<? foreach ($arResult["ITEMS"] as $arItem): ?>

    <div class="col-sm-4 sm-margin-b-50">


        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                <img

                        border="0"
                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                        style="float:left"
                />
            <? else: ?>
                <img

                        border="0"
                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                        style="float:left"
                />
            <? endif; ?>
        <? endif ?>

        <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
            <? echo $arItem["DISPLAY_ACTIVE_FROM"] ?>
        <? endif ?>

            <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
            <h4><? echo $arItem["NAME"] ?>
                <? else: ?>
                <h4><? echo $arItem["NAME"] ?>
                    <? endif; ?>
                    <? endif; ?>
                    <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                        <span class="text-uppercase margin-l-20"><? echo $arItem["PREVIEW_TEXT"]; ?></span>
                    <? endif; ?>
               
                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>

                <? endif ?>
            </h4>
            <? foreach ($arItem["FIELDS"] as $code => $value): ?>
                <p>
                    <?= $value; ?>
                </p>
            <? endforeach; ?>
            <ul class="list-unstyled contact-list">

                <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty):
                    if ($arProperty['CODE'] == 'CPHONE') { ?>
                        <li><i class="margin-r-10 color-base icon-call-out"></i> <?= $arProperty["DISPLAY_VALUE"]; ?>
                        </li>
                    <?
                    } else { ?>
                        <li><i class="margin-r-10 color-base icon-envelope"></i> <?= $arProperty["DISPLAY_VALUE"]; ?>
                        </li>
                    <?}?>
                <? endforeach; ?>
            </ul>

    </div>
<? endforeach; ?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>

