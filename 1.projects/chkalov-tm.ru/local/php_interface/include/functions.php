<?php
function SuccessCatalogImport1CAgent() {
    AddMessage2Log("AgentStart", "EventHendlerTest");
    CModule::IncludeModule('iblock');

    for ($level = 1; $level <= 3; $level++) {

        $arParentChildSections = [];

        $resSections = CIBlockSection::GetList(["ID" => "ASC"], ["IBLOCK_ID" => IBLOCK_ID__CATALOG, "ACTIVE" => "Y", "DEPTH_LEVEL" => $level], false, ["ID", "CODE", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME"]);
        while ($arSection = $resSections->Fetch()) {
            $keyName = strtolower(trim($arSection["NAME"]));
            $arParentChildSections[$arSection["IBLOCK_SECTION_ID"]][$keyName][] = $arSection["ID"];
        }
        
        $obSect = new CIBlockSection;
        $el = new CIBlockElement;
        foreach ($arParentChildSections as $mainSection) {
            foreach ($mainSection as $name => $subsections) {
                if (count($subsections) > 1) {
                    $mainSubsection = array_shift($subsections);
                    foreach ($subsections as $subsection) {
                        /* перенести подразделы */
                        $resSub2Section = CIBlockSection::GetList(["ID" => "ASC"], ["IBLOCK_ID" => IBLOCK_ID__CATALOG, "ACTIVE" => "Y", "IBLOCK_ID" => $subsection], false, ["ID", "IBLOCK_SECTION_ID"]);
                        if ($arSub2Section = $resSub2Section->Fetch()) {
                            $obSect->Update($arSub2Section["ID"], ["IBLOCK_SECTION_ID" => $mainSubsection], true, true);
                        }
                        /* перенести элементы */
                        $resElements = CIBlockElement::GetList(["ID" => "ASC"], ["IBLOCK_ID" => IBLOCK_ID__CATALOG, "ACTIVE" => "Y", "IBLOCK_SECTION_ID" => $subsection], false, false, ["ID", "IBLOCK_SECTION_ID"]);
                        while ($arResElements = $resElements->Fetch()) {
                            //Bitrix\Main\Diag\Debug::dump($arResElements["ID"]);
                            $el->Update($arResElements["ID"], ["IBLOCK_SECTION_ID" => $mainSubsection]);
                            Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(IBLOCK_ID__CATALOG, $arResElements["ID"]);
                        }
                        $obSect->Update($subsection, ["ACTIVE" => "N"]);
                    }
                }
            }
        }
    }

    CIBlockSection::ReSort(IBLOCK_ID__CATALOG);
    AddMessage2Log("AgentStoped", "EventHendlerTest");
    return "SuccessCatalogImport1CAgent();";
}




/*Водяной знак на картинки*/



/**
 * Масштабирует фото, сохраняет копию файла и возвращает путь к нему
 * либо возвращает ссылку на картинку-заглушку
 *
 * ---
 *
 * Водяной знак - если существует файл /upload/watermark/watermark_original.png - он будет
 * смасштабирован под фото и нанесен на всю поверхность с небольшим отступом от края.
 * watermark_original.png - должен быть большого размера, чтобы не терялось качество.
 *
 * @param $imgId
 * @param $width int
 * @param $height int Если не задано, будет пропорционально ширине
 * @param $proportional bool false - Обрезать жестко по заданному размеру (удобно для мини картинок). true - пропорционально (для больших)
 *
 * @throws Exception File dimensions can not be a null
 *
 *
 * @return string Путь к измененному файлу
 *
 * @see https://dermanov.ru/exp/bitrix-resize-image-and-watermark/ - Примеры работы функции
 */
function getResizedImgOrPlaceholder($imgId, $width, $height = "auto", $proportional = true){
    if (!$width)
        throw new \Exception( "File dimensions can not be a null" );
    $resizeType = BX_RESIZE_IMAGE_EXACT;
    $autoHeightMax = 380;
    //
    if ($height == "auto") {
        $height = $autoHeightMax;
        $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL;
    }
    if (!$height)
        $height = $width;
    if ($proportional)
        $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL;
    // если картинка не существует (например, пустое значение некотрого св-ва) - вернем заглушку нужного размера
    if (!$imgId) {
        // тут можно положить собственную заглушку под стиль сайта
        $customNoImg = SITE_TEMPLATE_PATH . "/upload/img_placeholder.jpg";
        // есть ограничение на размер заглушки на сайте dummyimage.com. можно еще задать цвет фона и текста.
        $height = $height == $autoHeightMax ? $width : $height;
        return file_exists($_SERVER["DOCUMENT_ROOT"] . $customNoImg) ? $customNoImg : "http://dummyimage.com/{$width}x{$height}/5C7BA4/fff";
    }
    $arFilters = [];
    /*
     * <watermark>
     * 1) получаем размер ($arDestinationSize) итоговой картинки (фото товара) после ресайза, с учетом типа ресайза ($resizeType)
     * 2) создаем водяной знак под этот размер фото (он должен быть чуть меньше самого фото)
     * 3) формируем фильтр для наложения знака
     * */
    $watermark = $_SERVER['DOCUMENT_ROOT'] . "/upload/watermark/watermark_original2.png";
    if (is_readable($watermark)) {
        $bNeedCreatePicture = $arSourceSize = $arDestinationSize = false;
        $imgSize = \CFile::GetImageSize( $_SERVER["DOCUMENT_ROOT"] .  \CFile::GetPath($imgId) );
        \CFile::ScaleImage($imgSize["0"], $imgSize["1"], array("width" => $width, "height" => $height), $resizeType, $bNeedCreatePicture, $arSourceSize, $arDestinationSize);
        $koef = 0.95;
        $watermarkResized = $_SERVER['DOCUMENT_ROOT'] . "/upload/watermark/watermark_original2.png" . $arDestinationSize["width"] * $koef . ".png";
        if (!is_readable($watermarkResized))
            \CFile::ResizeImageFile($watermark, $watermarkResized, [ "width" => $arDestinationSize["width"] * $koef, "height" => $arDestinationSize["height"] * $koef ], BX_RESIZE_IMAGE_PROPORTIONAL, false, 100, []);
        if (is_readable($watermarkResized))
            $arFilters[] = [
                "name"     => "watermark",
                "position" => "topleft",
                "size"     => "small",
                "file"     => $watermarkResized
            ];
    }
    /*
     * </watermark>
     * */
    $resizedImg = \CFile::ResizeImageGet($imgId, [ "width" => $width, "height" => $height ], $resizeType, false, $arFilters, false, 100);
    // если файл по каким-то причинам не создался - вернем заглушку
 /*   if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $resizedImg['src'])) {
        if ($height == $autoHeightMax)
            $height = $width;
        return self::getResizedImgOrPlaceholder(false, $width, $height, $proportional);
    }*/
    return $resizedImg['src'];
}