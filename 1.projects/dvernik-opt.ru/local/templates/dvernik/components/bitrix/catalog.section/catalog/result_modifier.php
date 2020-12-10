<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();



$arResult['NAV_STRING_LAZY'] = $arResult['NAV_RESULT']->GetPageNavStringEx(
    $navComponentObject,
    $arParams['PAGER_TITLE'],
    "lazyload",
    $arParams['PAGER_SHOW_ALWAYS'],
    $this->__component,
    $arResult['NAV_PARAM']
);


$arResult['NAV_STRING_CATALOG'] = $arResult['NAV_RESULT']->GetPageNavStringEx(
    $navComponentObject,
    $arParams['PAGER_TITLE'],
    "catalog",
    $arParams['PAGER_SHOW_ALWAYS'],
    $this->__component,
    $arResult['NAV_PARAM']
);