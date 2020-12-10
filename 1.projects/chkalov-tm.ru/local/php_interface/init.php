<?
if (file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/constants.php'))
    require_once $_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/constants.php';
if (file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/functions.php'))
    require_once $_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/functions.php';
if (file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/eventHendlers.php'))
    require_once $_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/eventHendlers.php';



?>
<?
// регистрация обработчика в /bitrix/php_interface/init.php
AddEventHandler("main", "OnAfterUserRegister", "MyOnAfterUserRegister");
function MyOnAfterUserRegister($arFields)
{

    $arFields["LAST_NAME"] = 'sdsdsd';

    $user = new CUser;
    $fields = Array(
        "UF_FAV" => array(0),
    );
    $user->Update($arFields["USER_ID"], $fields);
}


















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
/*function getResizedImgOrPlaceholder($imgId, $width, $height = "auto", $proportional = true){
    if (!$width)
        throw new \Exception( "File dimensions can not be a null" );
    $resizeType = BX_RESIZE_IMAGE_EXACT;
    $autoHeightMax = 9999;
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
/*    $watermark = $_SERVER['DOCUMENT_ROOT'] . "/upload/watermark/watermark_original.png";
    if (is_readable($watermark)) {
        $bNeedCreatePicture = $arSourceSize = $arDestinationSize = false;
        $imgSize = \CFile::GetImageSize( $_SERVER["DOCUMENT_ROOT"] .  \CFile::GetPath($imgId) );
        \CFile::ScaleImage($imgSize["0"], $imgSize["1"], array("width" => $width, "height" => $height), $resizeType, $bNeedCreatePicture, $arSourceSize, $arDestinationSize);
        $koef = 0.95;
        $watermarkResized = $_SERVER['DOCUMENT_ROOT'] . "/upload/watermark/watermark_" . $arDestinationSize["width"] * $koef . ".png";
        if (!is_readable($watermarkResized))
            \CFile::ResizeImageFile($watermark, $watermarkResized, [ "width" => $arDestinationSize["width"] * $koef, "height" => $arDestinationSize["height"] * $koef ], BX_RESIZE_IMAGE_PROPORTIONAL, false, 95, []);
        if (is_readable($watermarkResized))
            $arFilters[] = [
                "name"     => "watermark",
                "position" => "center",
                "size"     => "real",
                "file"     => $watermarkResized
            ];
    }
    /*
     * </watermark>
     * */
/*    $resizedImg = \CFile::ResizeImageGet($imgId, [ "width" => $width, "height" => $height ], $resizeType, false, $arFilters, false, 100);
    // если файл по каким-то причинам не создался - вернем заглушку
/*    if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $resizedImg['src'])) {
        if ($height == $autoHeightMax)
            $height = $width;
        return self::getResizedImgOrPlaceholder(false, $width, $height, $proportional);
    }*/
/*    return $resizedImg['src'];
}*/
?>