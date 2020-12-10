<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;


if (empty($arResult))
    return "";

$strReturn = '';

$css = $APPLICATION->GetCSSArray();
if (!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css)) {
    $strReturn .= '<a class="home" href="/" title="На главную">Магазин пальто</a>
		<span class="navigation-pipe">&gt;</span>' . "\n";
}


$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $arrow = ($index > 0 ? '<i class="fa fa-angle-right"></i>' : '');

    if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {

        $strReturn .= '<span class="navigation_page">
				<span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a itemprop="url" href="' . $arResult[$index]["LINK"] . '" title="Женские пальто">
						<span itemprop="title">' . $title . '</span>
					</a>
				</span>';
    } else {

        $strReturn .= '
		<span class="navigation-pipe">&gt;</span>' . $title . '</span> ';

    }
}

return $strReturn;

?>
