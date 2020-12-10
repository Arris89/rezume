<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul class="navigation__list">

        <?
        foreach ($arResult as $arItem):
            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
            <? if ($arItem["SELECTED"]):?>
            <li class="navigation__item"><a href="<?= $arItem["LINK"] ?>"
                                            class="navigation__link"><?= $arItem["TEXT"] ?></a></li>
        <? else:?>
            <li class="navigation__item"><a href="<?= $arItem["LINK"] ?>"
                                            class="navigation__link"><?= $arItem["TEXT"] ?></a></li>
        <? endif ?>

        <? endforeach ?>

    </ul>
<? endif ?>