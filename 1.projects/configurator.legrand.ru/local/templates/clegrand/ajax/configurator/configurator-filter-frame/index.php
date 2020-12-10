<?
if (stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) return;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Context;
$filterRequest = Context::getCurrent()->getRequest();
?>
<?if ($filterRequest->isAjaxRequest()):?>
    <?
    global $smartPreFilterFrame;

    $iblockPropsReference = \FourPx\Helper::getIBlockPropsReference('CATALOG');

    $collectionId = $iblockPropsReference['COLLECTION']['ID'];
    $frameCountFunctionId = $iblockPropsReference['FRAME_COUNT_FUNCTION']['ID'];

    $smartPreFilterFrame = array(
        array(
            'LOGIC' => 'OR',
            array(
                '=PROPERTY_'.$frameCountFunctionId.'_VALUE' => 1
            ),
            array(
                '=PROPERTY_'.$frameCountFunctionId.'_VALUE' => 2,
                '=PROPERTY_'.$collectionId.'_VALUE' => \FourPx\Helper::getOriginalCollections()
            )
        )
    );
    ?>

    <?$APPLICATION->IncludeComponent(
        "bitrix:catalog.smart.filter",
        "configurator.frame",
        Array(
            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
            "CURRENCY_ID" => "RUB",	// Валюта, в которую будут сконвертированы цены
            "DISPLAY_ELEMENT_COUNT" => "Y",	// Показывать количество
            "FILTER_NAME" => "arrFilter",	// Имя выходящего массива для фильтрации
            "FILTER_VIEW_MODE" => "horizontal",	// Вид отображения
            "HIDE_NOT_AVAILABLE" => "N",	// Не отображать недоступные товары
            "IBLOCK_ID" => "25",	// Инфоблок
            "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
            "PAGER_PARAMS_NAME" => "arrPager",	// Имя массива с переменными для построения ссылок в постраничной навигации
            "POPUP_POSITION" => "left",
            "PREFILTER_NAME" => "smartPreFilterFrame",	// Имя входящего массива для дополнительной фильтрации элементов
            "PRICE_CODE" => array(	// Тип цены
                0 => "BASE",
            ),
            "SAVE_IN_SESSION" => "N",	// Сохранять установки фильтра в сессии пользователя
            "SECTION_CODE" => "FRAME",	// Код раздела
            "SECTION_CODE_PATH" => "",
            "SECTION_DESCRIPTION" => "DESCRIPTION",	// Описание
            "SECTION_ID" => "",	// ID раздела инфоблока
            "SECTION_TITLE" => "NAME",	// Заголовок
            "SEF_MODE" => "N",	// Включить поддержку ЧПУ
            "SEF_RULE" => "",	// Правило для обработки
            "SMART_FILTER_PATH" => "",
            "TEMPLATE_THEME" => "blue",	// Цветовая тема
            "XML_EXPORT" => "N",	// Включить поддержку Яндекс Островов
        ),
        false
    );?>
<?endif?>