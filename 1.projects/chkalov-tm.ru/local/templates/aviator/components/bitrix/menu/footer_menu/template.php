<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<? if (!empty($arResult)): ?>
    <ul class="foot-menu">

        <?
        foreach ($arResult as $arItem):
            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>

            <? if ($arItem["SELECTED"]):?>
            <? if (isset($arItem["PARAMS"]["MENU_NAME"])):?>
                <li class="title"><?= $arItem["PARAMS"]["MENU_NAME"] ?></li>
            <? endif ?>

            <li><a rel="nofollow" href="<?= $arItem["LINK"] ?>" class="selected"><?= $arItem["TEXT"] ?></a></li>
        <? else:?>
            <? if (isset($arItem["PARAMS"]["MENU_NAME"])):?>
                <li class="title"><?= $arItem["PARAMS"]["MENU_NAME"] ?></li>
            <? endif ?>
            <li><a rel="nofollow" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
        <? endif ?>

        <? endforeach ?>

    </ul>
<? endif ?>
