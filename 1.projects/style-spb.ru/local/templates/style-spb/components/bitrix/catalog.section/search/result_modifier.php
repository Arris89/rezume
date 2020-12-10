<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


foreach ($arResult['ITEMS'] as $key => $value) {
    
    $pos = stripos($value['NAME'], $_GET['q']);

    if ($pos === false) {
        unset($arResult['ITEMS'][$key]);
    }

}