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

<?
$i = 0;
foreach ($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>


    <?

    if ($i < 1) { ?>

        <div class="masonry-grid-sizer col-xs-6 col-sm-6 col-md-6"></div>
        <div class="masonry-grid-item col-xs-12 col-sm-6 col-md-6">
            <!-- Work -->
            <div class="work">
                <div class="work-overlay">

                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                            <img
                                        class="full-width img-responsive"
                                        border="0"
                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                />
                        <?
                        else: ?>
                            <img
                                    class="full-width img-responsive"
                                    border="0"
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                            />
                        <?endif; ?>
                    <?endif ?>

                </div>
                <div class="work-content">


                    <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                        <? echo $arItem["DISPLAY_ACTIVE_FROM"] ?>
                    <?endif ?>
                    <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                            <h3 class="color-white margin-b-5"><? echo $arItem["NAME"] ?></h3>
                        <?
                        else: ?>
                            <h3 class="color-white margin-b-5"><? echo $arItem["NAME"] ?></h3>
                        <?endif; ?>
                    <?endif; ?>
                    <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                        <p class="color-white margin-b-0"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                    <?endif; ?>

                </div>
                <!--<a class="content-wrapper-link" href="#"></a>-->

                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>

                <?endif ?>
                <? foreach ($arItem["FIELDS"] as $code => $value): ?>

                    <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>

                <?endforeach; ?>
                <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>

                    <?= $arProperty["NAME"] ?>:&nbsp;
                    <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                        <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
                    <?
                    else: ?>
                        <?= $arProperty["DISPLAY_VALUE"]; ?>
                    <?endif ?>
<
                <?endforeach; ?>

            </div>
            <!-- End Work -->
        </div>


        <?

    } else { ?>

        <div class="masonry-grid-item col-xs-6 col-sm-6 col-md-6">
            <!-- Work -->
            <div class="work">
                <div class="work-overlay">

                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                            ><img
                                        class="full-width img-responsive"
                                        border="0"
                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                                />
                        <?
                        else: ?>
                            <img
                                    class="full-width img-responsive"
                                    border="0"
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                            />
                        <?endif; ?>
                    <?endif ?>

                </div>
                <div class="work-content">


                    <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                        <? echo $arItem["DISPLAY_ACTIVE_FROM"] ?>
                    <?endif ?>
                    <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                            <h3 class="color-white margin-b-5"><? echo $arItem["NAME"] ?></h3>
                        <?
                        else: ?>
                            <h3 class="color-white margin-b-5"><? echo $arItem["NAME"] ?></h3>
                        <?endif; ?>
                    <?endif; ?>
                    <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                        <p class="color-white margin-b-0"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                    <?endif; ?>

                </div>
               <!--<a class="content-wrapper-link" href="#"></a>-->


                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>

                <?endif ?>
                <? foreach ($arItem["FIELDS"] as $code => $value): ?>

                    <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>

                <?endforeach; ?>
                <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>

                    <?= $arProperty["NAME"] ?>:&nbsp;
                    <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                        <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
                    <?
                    else: ?>
                        <?= $arProperty["DISPLAY_VALUE"]; ?>
                    <?endif ?>

                <?endforeach; ?>

            </div>
            <!-- End Work -->
        </div>


    <? }

    $i++;


endforeach; ?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>

