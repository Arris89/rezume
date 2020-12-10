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
$this->setFrameMode(true); ?>

<form action="<?= $arResult["FORM_ACTION"] ?>" class="search-area__form">


    <? if ($arParams["USE_SUGGEST"] === "Y"): ?><? $APPLICATION->IncludeComponent(
        "bitrix:search.suggest.input",
        "",
        array(
            "NAME" => "q",
            "VALUE" => "",
            "INPUT_SIZE" => 15,
            "DROPDOWN_SIZE" => 10,
        ),
        $component, array("HIDE_ICONS" => "Y")
    ); ?>
    <? else: ?>
        <input type="text" name="q" value="" size="15" maxlength="50" class="search-area__field"
               placeholder="Поиск по сайту"/>
    <? endif; ?>
    
    <button class="search-area__button" type="submit">
        <svg class="search-area__icon icon icon_theme_white">
            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                 xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-search"></use>
        </svg>
    </button>

</form>
