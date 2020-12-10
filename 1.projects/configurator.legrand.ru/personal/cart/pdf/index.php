<?
if (stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) return;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Main\Loader;

$request = Context::getCurrent()->getRequest();

if ($request->isAjaxRequest()) {

    if (Loader::includeModule('iblock')) {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="<?= LANGUAGE_ID ?>">
            <head>
                <title>Состав проекта</title>
                <meta charset="utf-8"/>
                <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>

                <link href="/local/templates/clegrand/css/style.css" type="text/css" rel="stylesheet"/>
            </head>
            <body>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket",
                    "print",
                    Array(
                        "ACTION_VARIABLE" => "basketAction",
                        "ADDITIONAL_PICT_PROP_25" => "-",
                        "AUTO_CALCULATION" => "Y",
                        "BASKET_IMAGES_SCALING" => "adaptive",
                        "COLUMNS_LIST" => array(
                            0 => "NAME",
                            1 => "PRICE",
                            2 => "QUANTITY",
                            3 => "DELETE",
                            4 => "DISCOUNT",
                        ),
                        "COLUMNS_LIST_EXT" => array(
                            0 => "DELETE",
                            1 => "TYPE",
                            2 => "SUM",
                            3 => "PROPERTY_COLLECTION",
                            4 => "PROPERTY_ARTICUL",
                            5 => "PROPERTY_PACKAGE_ARTICUL",
                            6 => "PROPERTY_FRAME_COLOR",
                            7 => "PROPERTY_FUNCTION_COLOR",
                            8 => "PROPERTY_FRAME_COUNT_FUNCTION",
                            9 => "PROPERTY_SECTION_CODE"
                        ),
                        "COLUMNS_LIST_MOBILE" => array(
                            0 => "DELETE",
                            1 => "TYPE",
                            2 => "SUM",
                            3 => "PROPERTY_COLLECTION",
                            4 => "PROPERTY_ARTICUL",
                            5 => "PROPERTY_PACKAGE_ARTICUL",
                            6 => "PROPERTY_FRAME_COLOR",
                            7 => "PROPERTY_FUNCTION_COLOR",
                            8 => "PROPERTY_FRAME_COUNT_FUNCTION",
                            9 => "PROPERTY_SECTION_CODE"
                        ),
                        "COMPATIBLE_MODE" => "Y",
                        "CORRECT_RATIO" => "Y",
                        "DEFERRED_REFRESH" => "N",
                        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                        "DISPLAY_MODE" => "extended",
                        "EMPTY_BASKET_HINT_PATH" => "/",
                        "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
                        "GIFTS_CONVERT_CURRENCY" => "N",
                        "GIFTS_HIDE_BLOCK_TITLE" => "N",
                        "GIFTS_HIDE_NOT_AVAILABLE" => "N",
                        "GIFTS_MESS_BTN_BUY" => "Выбрать",
                        "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
                        "GIFTS_PAGE_ELEMENT_COUNT" => "4",
                        "GIFTS_PLACE" => "BOTTOM",
                        "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
                        "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
                        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                        "GIFTS_SHOW_OLD_PRICE" => "N",
                        "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
                        "HIDE_COUPON" => "N",
                        "LABEL_PROP" => array(),
                        "PATH_TO_ORDER" => "/personal/order/make/",
                        "PRICE_DISPLAY_MODE" => "Y",
                        "PRICE_VAT_SHOW_VALUE" => "N",
                        "PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
                        "QUANTITY_FLOAT" => "Y",
                        "SET_TITLE" => "N",
                        "SHOW_DISCOUNT_PERCENT" => "Y",
                        "SHOW_FILTER" => "N",
                        "SHOW_RESTORE" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "TOTAL_BLOCK_DISPLAY" => array("top"),
                        "USE_DYNAMIC_SCROLL" => "N",
                        "USE_ENHANCED_ECOMMERCE" => "N",
                        "USE_GIFTS" => "N",
                        "USE_PREPAYMENT" => "N",
                        "USE_PRICE_ANIMATION" => "N"
                    )
                );?>
            </body>
        </html>
        <?
        $html = ob_get_contents();
        ob_end_clean();

        //Создание временной html страницы
        $tmpFileName = md5(bitrix_sessid());
        $fileHtml = new Bitrix\Main\IO\File($_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/html/' . $tmpFileName . '.html');
        $fileHtml->putContents($html);

        if ($fileHtml->isExists()) {

            $protocol = (CMain::IsHTTPS()) ? 'https://' : 'http://';

            $url = $protocol . $_SERVER['HTTP_HOST'] . '/upload/tmp/html/' . $tmpFileName . '.html';
            $filePdf = $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/pdf/' . $tmpFileName . '.pdf';

            \Bitrix\Main\IO\Directory::createDirectory($_SERVER["DOCUMENT_ROOT"] . '/upload/tmp/pdf/');

            $date = date($DB->DateFormatToPHP(CSite::GetDateFormat('FULL')), time());
            $footerText = $protocol . $_SERVER["HTTP_HOST"];

            //Выполнение консольной команды создания pdf
            $command = 'wkhtmltopdf --encoding utf8 --background --margin-top 15 --margin-bottom 15 --header-spacing 5 --header-font-size 10 --header-left [date] --footer-spacing 5 --footer-font-size 10 --footer-left ' . $footerText . ' --footer-right [page] --page-offset 0 --print-media-type --disable-external-links --exclude-from-outline --disable-javascript ' . $url . ' ' . $filePdf;
            exec($command, $output, $result);

            if (file_exists($filePdf)) {
                $attachment = 'project.pdf';
                header('Content-type: application/pdf');
                header(sprintf('Content-Disposition: attachment; filename="%s"', $attachment));
                header(sprintf('Last-Modified: %s', date('D, d M Y H:i:s T', filemtime($filePdf))));
                header(sprintf('Content-Length: %s', filesize($filePdf)));
                readfile($filePdf);
            }

            //Удаление временных файлов
            $fileHtml->delete();
            unlink($filePdf);
        }
    }
}