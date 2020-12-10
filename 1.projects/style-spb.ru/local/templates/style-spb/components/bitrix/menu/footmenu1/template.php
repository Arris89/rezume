<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>

<ul class="bullet">
    <?
    foreach ($arResult as $arItem):
        if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;
        ?>
        <? if ($arItem["SELECTED"]):?>
        <li><a href="<?= $arItem["LINK"] ?>" rel="nofollow" title="<?= $arItem["TEXT"] ?>"><?= $arItem["TEXT"] ?></a>
        </li>
    <? else:?>
        <li><a href="<?= $arItem["LINK"] ?>" rel="nofollow" title="<?= $arItem["TEXT"] ?>"><?= $arItem["TEXT"] ?></a>
        </li>
    <? endif ?>

    <? endforeach ?>

    <? endif ?>

    <? if ($USER->IsAuthorized()) { ?>
        <li>
            <a href="/?logout=yes" title="Выход" rel="nofollow">Выход</a>
        </li>
    <? } ?>
</ul>