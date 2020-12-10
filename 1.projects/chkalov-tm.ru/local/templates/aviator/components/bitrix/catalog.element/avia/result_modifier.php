<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

//1 Поиск и добавление товаров с другим цветом
//выделяем из артикула часть до точки
$art = explode('.', $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']);
$arFilter = Array
(

    "IBLOCK_ID" => IBLOCK_ID__CATALOG,
   "SECTION_CODE" => $arResult["SECTION"]["CODE"],
    "!ID" => $arResult["ID"],
    //исключаем текущий товар из выборки
    "PROPERTY_CML2_ARTICLE" => "" . $art['0'] . "%"
);

$arSelect = Array("DETAIL_PAGE_URL", "PREVIEW_PICTURE");
$res = CIBlockElement::GetList($arOrder, $arFilter, false, Array(), $arSelect);


$ic = 1;
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();

    $ImgSrc = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);

    $arResult["COLORS_ITEM"][$ic]["COLORS_CODE"] = $arFields["DETAIL_PAGE_URL"];
    $arResult["COLORS_ITEM"][$ic]["COLORS_SRC"] = $ImgSrc["SRC"];

    $ic++;
}

//2 Список отзывов
$res2 = CIBlockElement::GetByID($arResult['ID']);
while ($obRes2 = $res2->GetNextElement()) {
    $ar_res2 = $obRes2->GetProperty("REWS");
    foreach ($ar_res2['VALUE'] as $key2 => $recc2) {
        $arResult['REWS_LIST'][] = $recc2;
    }
}

