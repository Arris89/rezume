<?
if (stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) return;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Main\Loader;

$request = Context::getCurrent()->getRequest();

if ($request->isAjaxRequest()) {

    if (Loader::includeModule('iblock')) {

        $arElements = $request->getPost('items');

        foreach ($arElements as $arElement) {
            $elementId = $arElement['id'];

            $arElementsId[$elementId] = $elementId;
        }

        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="<?= LANGUAGE_ID ?>">
        <head>
            <title>Спецификация</title>
            <meta charset="utf-8"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>

            <link href="/local/templates/clegrand/css/style.css" type="text/css" rel="stylesheet"/>
        </head>
        <body>
        <? $APPLICATION->IncludeComponent(
            "4px:specification.list",
            "print",
            Array(
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => 3600,
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => 25,
                "FILTER" => array(
                    "SECTION_CODE" => array(
                        "FUNCTION",
                        "FRAME"
                    ),
                    "ID" => $arElementsId,
                ),
                "ITEMS_REQUEST" => $arElements
            ),
            false
        ); ?>
        </body>
        </html>
        <?
        $html = ob_get_contents();
        ob_end_clean();

        //Создание временной html страницы
        $tmpFileName = md5(bitrix_sessid());
        $fileHtml = new \Bitrix\Main\IO\File($_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/html/' . $tmpFileName . '.html');
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
                $attachment = 'specification.pdf';
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