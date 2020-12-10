<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string


if (empty($arResult))
    return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();


$strReturn .= '';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $arrow = ($index > 0 ? '//' : '');

    if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {

        if ($index == 2) {


            $arFilter = Array('GLOBAL_ACTIVE' => 'Y', 'SECTION_ID' => 'false');
            $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, true);
            while ($ar_result = $db_list->GetNext()) {
                if ($ar_result['NAME'] !== $title) //текущий каталог не выводим
                {
                    $breadList .= "<li>$ar_result[NAME]<li>";   //записываем в html навигации цепочек разделы каталога
                }
            }

            $strReturn .= '
			<li><a href="#">
				' . $arrow . '
				<a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemprop="url">
					<span itemprop="name">' . $title . '</span>

				<div id="lor" style="display: none;
    						position: absolute;
    						z-index: 1007;
    						background-color: white;
    						box-shadow: 1px 1px 1px 1px #b7b7b7;">
                               <ul>
                                   <li>'
                . $breadList . '
                                    </li>
                    </ul>
                </div>

				</a>
				<meta itemprop="position" content="' . ($index + 1) . '" />
			</a></li>';


        } else {

            $strReturn .= '
			<li><a href="#">
				' . $arrow . '
				<a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemprop="url">
					<span itemprop="name">' . $title . '</span>
				</a>
				<meta itemprop="position" content="' . ($index + 1) . '" />
			</a></li>';


        }


    } else {
        $strReturn .= '
			<li><a href="#">
				' . $arrow . '
				<span itemprop="name">' . $title . '</span>
				<meta itemprop="position" content="' . ($index + 1) . '" />
			</a></li>';
    }
}

$strReturn .= '';

return '<ul class="breadcrumbs">' . $strReturn . '</ul>';


?>
