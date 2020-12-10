<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Поиск по номеру или названию товара");
$APPLICATION->SetTitle("Собрать спецификацию");
?>
<div class="section-specification section-style">
    <div class="section-specification__container container">

        <div class="popup popup_specification zoom-anim-dialog mfp-hide" id="popup-specification">
            <div class="popup__content">
                <div class="specification-popup">
                    <div class="specification-popup__title popup-title">
                        Собранная вами спецификация добавлена в
                        корзину
                    </div>

                    <div class="specification-popup__buttons">
                        <div class="specification-popup__button">
                            <div class="my-btn my-btn_stroked js-close-popup">
                                Новая спецификация
                            </div>
                        </div>

                        <div class="specification-popup__button">
                            <a class="my-btn" href="/personal/cart/">
                                Перейти в
                                корзину
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


     <div class="popup popup_specification zoom-anim-dialog mfp-hide" id="popup-deferred">
            <div class="popup__content">
                <div class="specification-popup">
                    <div class="specification-popup__title popup-title">
                        Собранный вами список добавлен в избранное
                    </div>

                    <div class="specification-popup__buttons">
                        <div class="specification-popup__button">
                            <div class="my-btn my-btn_stroked js-close-popup">
                                Собрать новый список
                            </div>
                        </div>

                        <div class="specification-popup__button">
                            <a class="my-btn" href="/deferred/">
                                Перейти в избранное
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.search",
            ".default",
            array(
                "ACTION_VARIABLE" => "action",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BASKET_URL" => "/personal/cart/",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "N",
                "CONVERT_CURRENCY" => "N",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_COMPARE" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "25",
                "IBLOCK_TYPE" => "catalog",
                "LINE_ELEMENT_COUNT" => "3",
                "NO_WORD_LOGIC" => "N",
                "OFFERS_LIMIT" => "0",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Товары",
                "PAGE_ELEMENT_COUNT" => "100",
                "PRICE_CODE" => array(
                    0 => "DEFAULT",
                ),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPERTIES" => array(
                    0 => "COLLECTION",
                    1 => "FRAME_COUNT_FUNCTION",
                    2 => "FUNCTION_GROUP",
                    3 => "PACKAGE_ARTICUL",
                ),
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PROPERTY_CODE" => array(
                    0 => "ARTICUL",
                    1 => "NAME",
                    2 => "COLLECTION",
                    3 => "FRAME_COLOR",
                    4 => "FRAME_MATERIAL",
                    5 => "FRAME_COUNT_FUNCTION",
                    6 => "FRAME_NAME",
                    7 => "TYPE_INSTALATION",
                    8 => "FUNCTION_GROUP",
                    9 => "FUNCTION_COLOR",
                    10 => "PACKAGE_ARTICUL",
                    11 => "DESCRIPTION",
                    12 => "FRAME_IMG_HORIZONTAL'",
                    13 => "FUNCTION_IMG",
                ),
                "RESTART" => "N",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SHOW_PRICE_COUNT" => "1",
                "USE_LANGUAGE_GUESS" => "Y",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N",
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        );?>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>