<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<form class="b-where__search" action="" method="get">
    <input class="b-where__search-text"
           type="text"
           placeholder="Введите номер артикула или название товара"
           name="q"
           autocomplete="off"
           value="<?= $arResult["REQUEST"]["QUERY"]?>"
    >

    <button type="button" class="b-where__search-submit search-js">
        <svg class="icon icon_loop">
            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#loop"></use>
        </svg>
    </button>

    <input type="hidden" name="how" value="<?= $arResult["REQUEST"]["HOW"] == "d" ? "d" : "r"?>" />
</form>