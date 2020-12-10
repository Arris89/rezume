<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>


 <? 
if($APPLICATION->GetCurPage(false) == '/search/'):

$sea=$arResult['REQUEST']['QUERY'];
$APPLICATION->SetTitle("Результаты по запросу \"".$sea."\"");

$APPLICATION->AddChainItem("Результаты по запросу \"".$sea."\"");

endif; 
?>



