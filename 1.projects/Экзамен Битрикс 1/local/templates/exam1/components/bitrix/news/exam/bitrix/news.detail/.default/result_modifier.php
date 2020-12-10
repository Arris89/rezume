<?

//Вывод должности и компании
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (CModule::IncludeModule('iblock')) {

    $res = CIBlockElement::GetByID($arResult['ID']);
    while ($obRes = $res->GetNextElement()) {
        $ar_res = $obRes->GetProperty("POSITION");
        $arResult["POSTN"] = $ar_res;
        $ar_res2 = $obRes->GetProperty("COMPANY");
        $arResult["COMP"] = $ar_res2;
    }
//Вывод документов
    $VALUES = array();
    $res = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $arParams['ELEMENT_ID'], "sort", "asc", array("CODE" => "DOCS"));
    while ($ob = $res->GetNext()) {
        $VALUES[] = $ob['VALUE'];
    }
    foreach ($VALUES as $key => $valuedocs) {
        $rsFile = CFile::GetByID($valuedocs);
        $arFile = $rsFile->Fetch();
        if ($arFile['SUBDIR'] && $arFile['FILE_NAME']) {
            $href = "upload/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'] . "";
            $orname = "$arFile[ORIGINAL_NAME]";
            $orname2 = substr($orname, 0, -4);
            $arResult["DOCPDF"][] = array("PDF" => $orname2, "HREF" => $href);

        }
    }
}
?>