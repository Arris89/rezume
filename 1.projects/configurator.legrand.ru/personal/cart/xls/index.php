<?
if (stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) return;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Main\Loader;

$request = Context::getCurrent()->getRequest();

if ($request->isAjaxRequest()) {

    if (Loader::includeModule('iblock')) {

        $attachment = 'project.xls';
        header('Content-type: application/xls');
        header(sprintf('Content-Disposition: attachment; filename="%s"', $attachment));
        ?>
        <html lang="<?= LANGUAGE_ID?>">
            <head>
                <title>Состав проекта</title>
                <meta charset="utf-8"/>
                <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
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
    }
}
?>