<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Application;
$arRequest = Application::getInstance()->getContext()->getRequest();
$ORDER_ID = $arRequest->get('ID');
$format = $arRequest->get('format');
if((int)$ORDER_ID == 0 || !in_array($format, ['pdf', 'xls'])) return;

$fileName = 'order_N'.$ORDER_ID;
switch ($format){
    case 'xls':?>
        <?
        $attachment = $fileName.'.xls';
        header('Content-type: application/xls');
        header(sprintf('Content-Disposition: attachment; filename="%s"', $attachment));
        ?>
        <html lang="<?= LANGUAGE_ID?>">
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        </head>
        <body>
        <?$APPLICATION->IncludeComponent(
            "bitrix:sale.personal.order.detail",
            "print",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CUSTOM_SELECT_PROPS" => array("", ""),
                "DISALLOW_CANCEL" => "N",
                "ID" => $ORDER_ID,
                "PATH_TO_CANCEL" => "",
                "PATH_TO_COPY" => "",
                "PATH_TO_LIST" => "/personal/order/",
                "PATH_TO_PAYMENT" => "payment.php",
                "PICTURE_HEIGHT" => "110",
                "PICTURE_RESAMPLE_TYPE" => "1",
                "PICTURE_WIDTH" => "110",
                "PROP_1" => array(),
                "REFRESH_PRICES" => "N",
                "RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
                "SET_TITLE" => "N"
            )
        );?>
        </body>
        </html>
        <?break;
    case 'pdf':?>
        <?
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="<?= LANGUAGE_ID?>">
        <head>
            <title>Состав проекта</title>
            <meta charset="utf-8"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>

            <link href="/local/templates/clegrand/css/style.css" type="text/css" rel="stylesheet" />
        </head>
        <body>
        <?$APPLICATION->IncludeComponent(
            "bitrix:sale.personal.order.detail",
            "print",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CUSTOM_SELECT_PROPS" => array("", ""),
                "DISALLOW_CANCEL" => "N",
                "ID" => $ORDER_ID,
                "PATH_TO_CANCEL" => "",
                "PATH_TO_COPY" => "",
                "PATH_TO_LIST" => "/personal/order/",
                "PATH_TO_PAYMENT" => "payment.php",
                "PICTURE_HEIGHT" => "110",
                "PICTURE_RESAMPLE_TYPE" => "1",
                "PICTURE_WIDTH" => "110",
                "PROP_1" => array(),
                "REFRESH_PRICES" => "N",
                "RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
                "SET_TITLE" => "N"
            )
        );?>
        </body>
        </html>
        <?$html = ob_get_contents();
        ob_end_clean();
        //Создание временной html страницы
        $tmpFileName = md5(bitrix_sessid());
        $fileHtml = new \Bitrix\Main\IO\File($_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/html/' . $tmpFileName . '.html');
        $fileHtml->putContents($html);

        if ($fileHtml->isExists()) {

            $protocol = (CMain::IsHTTPS()) ? 'https://' : 'http://';

            $url = $protocol . $_SERVER['HTTP_HOST']. '/upload/tmp/html/' . $tmpFileName . '.html';
            $filePdf = $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/pdf/' . $tmpFileName . '.pdf';

            \Bitrix\Main\IO\Directory::createDirectory($_SERVER["DOCUMENT_ROOT"].'/upload/tmp/pdf/');

            $date = date($DB->DateFormatToPHP(CSite::GetDateFormat('FULL')), time());
            $footerText = $protocol . $_SERVER["HTTP_HOST"];

            //Выполнение консольной команды создания pdf
            $command = 'wkhtmltopdf --encoding utf8 --background --margin-top 15 --margin-bottom 15 --header-spacing 5 --header-font-size 10 --header-left [date] --footer-spacing 5 --footer-font-size 10 --footer-left ' . $footerText . ' --footer-right [page] --page-offset 0 --print-media-type --disable-external-links --exclude-from-outline --disable-javascript ' . $url . ' ' . $filePdf;
            exec($command, $output, $result);

            if (file_exists($filePdf)) {
                $attachment = $fileName.'.pdf';
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
        break;
}