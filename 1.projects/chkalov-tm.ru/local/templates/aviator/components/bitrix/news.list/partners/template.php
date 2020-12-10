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

<noindex>
    <div class="partner-wrap">
        <div class="title">
            <h2><?= $arResult["NAME"] ?></h2>
        </div>
        <ul class="partner-list">

            <? foreach ($arResult["ITEMS"] as $arItem): ?>

                <li>
                    <a rel="nofollow" target="_blank" href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>">
                        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>"
                             style="max-width: 100%;"></a>
                </li>


            <? endforeach; ?>

        </ul>
    </div>
</noindex>



