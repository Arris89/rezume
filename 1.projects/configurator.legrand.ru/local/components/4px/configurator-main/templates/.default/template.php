<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="section-config section-style">
    <div class="section-config__container container">
        <div class="config">
            <div class="config__top">
                <div class="config__top-left">
                    <div class="config__title js-call-popup" data-target="popup-config" style="text-transform:uppercase;">
                        КОНФИГУРАТОР РАМОК И МЕХАНИЗМОВ
                    </div>

                    <div class="config-settings config__settings">
                        <div class="config-settings__blocks">
                            <div class="config-settings__block">
                                <div class="config-settings__title">
                                    ОРИЕНТАЦИЯ РАМКИ
                                </div>
                                <div class="config-settings__content">
                                    <div class="frame-orientation my-radio" data-type="orientation">
                                        <div class="frame-orientation__block my-radio__item my-radio__item_active" data-value="horiz">
                                            <div class="frame-orientation__horiz"></div>
                                        </div>
                                        <div class="frame-orientation__block my-radio__item" data-value="vert">
                                            <div class="frame-orientation__vert"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="config-settings__block">
                                <div class="config-settings__title">
                                    КОЛИЧЕСТВО ПОСТОВ
                                </div>
                                <div class="config-settings__content">
                                    <div class="posts-number my-radio" data-type="posts">
                                        <div class="posts-number__block my-radio__item" data-value="1">
                                            1
                                        </div>
                                        <div class="posts-number__block my-radio__item" data-value="2">
                                            2
                                        </div>
                                        <div class="posts-number__block my-radio__item" data-value="3">
                                            3
                                        </div>
                                        <div class="posts-number__block my-radio__item" data-value="4">
                                            4
                                        </div>
                                        <div class="posts-number__block my-radio__item" data-value="5">
                                            5
                                        </div>
                                        <div class="posts-number__block my-radio__item" data-value="6">
                                            6
                                        </div>
                                        <div class="posts-number__block my-radio__item" data-value="7">
                                            7
                                        </div>
                                        <div class="posts-number__block my-radio__item" data-value="8">
                                            8
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="config-settings__block">
                                <div class="config-settings__title">
                                    МАСШТАБ
                                </div>
                                <div class="config-settings__content">
                                    <div class="conf-zoom my-radio" data-type="zoom">
                                        <div class="conf-zoom__block my-radio__item" data-value="minus">
                                            -
                                        </div>
                                        <div class="conf-zoom__block my-radio__item" data-value="plus">
                                            +
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="config-settings__block config-settings__block_bg">
                                <div class="config-settings__title"></div>
                                <div class="config-settings__content">
                                    <a class="conf-setbg popup-with-move-anim" href="#popup-setbg">
                                        <img src="<?= SITE_TEMPLATE_PATH?>/img/configurator/bg.png"
                                             alt=""
                                             role="presentation"
                                        />
                                        <span class="conf-setbg__text">
                                            Установить фон
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="config__view config-main deleted layout">
                        <div class="config__sizing js-grid-sizing">
                            <span>0 мм</span>
                            <div class="config__sizing-line"></div>
                        </div>

                        <div class="config-delete config__delete js-frame-delete">
                            <div class="close-icon"></div>
                            <div class="config-delete__text">
                                удалить рамку
                            </div>
                        </div>

                        <div class="config__wrap">
                            <div class="config-grid config__grid">
                                <div class="config-grid__frame frame horizontal">
                                    <div class="config-grid__places">
                                        <div class="place place1">
                                            <div class="slot"></div>
                                            <div class="bg-white"></div>
                                            <div class="place__remove js-remove-frame">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>

                                        <div class="place place2">
                                            <div class="slot"></div>
                                            <div class="bg-white"></div>
                                            <div class="place__remove js-remove-frame">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>

                                        <div class="place place3">
                                            <div class="slot"></div>
                                            <div class="bg-white"></div>
                                            <div class="place__remove js-remove-frame">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>

                                        <div class="place place4">
                                            <div class="slot"></div>
                                            <div class="bg-white"></div>
                                            <div class="place__remove js-remove-frame">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>

                                        <div class="place place5">
                                            <div class="slot"></div>
                                            <div class="bg-white"></div>
                                            <div class="place__remove js-remove-frame">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>

                                        <div class="place place6">
                                            <div class="slot"></div>
                                            <div class="bg-white"></div>
                                            <div class="place__remove js-remove-frame">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>

                                        <div class="place place7">
                                            <div class="slot"></div>
                                            <div class="bg-white"></div>
                                            <div class="place__remove js-remove-frame">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>

                                        <div class="place place8">
                                            <div class="slot"></div>
                                            <div class="bg-white"></div>
                                            <div class="place__remove js-remove-frame">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <img class="js-frame-image"
                                         src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                         alt=""
                                         role="presentation"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="config__preloader">
                            <div class="sk-circle-bounce">
                                <div class="sk-child sk-circle-1"></div>
                                <div class="sk-child sk-circle-2"></div>
                                <div class="sk-child sk-circle-3"></div>
                                <div class="sk-child sk-circle-4"></div>
                                <div class="sk-child sk-circle-5"></div>
                                <div class="sk-child sk-circle-6"></div>
                                <div class="sk-child sk-circle-7"></div>
                                <div class="sk-child sk-circle-8"></div>
                                <div class="sk-child sk-circle-9"></div>
                                <div class="sk-child sk-circle-10"></div>
                                <div class="sk-child sk-circle-11"></div>
                                <div class="sk-child sk-circle-12"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="config__top-right">
                    <div class="config-panel">

                        <div class="config-panel__row config-panel__row_desktop config-panel-js">

                            <div class="config-panel__preloader preloader preloader-js">
                                <div class="sk-circle-bounce">
                                    <div class="sk-child sk-circle-1"></div>
                                    <div class="sk-child sk-circle-2"></div>
                                    <div class="sk-child sk-circle-3"></div>
                                    <div class="sk-child sk-circle-4"></div>
                                    <div class="sk-child sk-circle-5"></div>
                                    <div class="sk-child sk-circle-6"></div>
                                    <div class="sk-child sk-circle-7"></div>
                                    <div class="sk-child sk-circle-8"></div>
                                    <div class="sk-child sk-circle-9"></div>
                                    <div class="sk-child sk-circle-10"></div>
                                    <div class="sk-child sk-circle-11"></div>
                                    <div class="sk-child sk-circle-12"></div>
                                </div>
                            </div>

                            <?
                            global $arrFilter;
                            global $smartPreFilterFrame;
                            $smartPreFilterFrame = array(
                                array(
                                    'LOGIC' => 'OR',
                                    array(
                                        '=PROPERTY_'.$arResult['FILTER_PROPS_CODE']['FRAME_COUNT_FUNCTION'].'_VALUE' => 1
                                    ),
                                    array(
                                        '=PROPERTY_'.$arResult['FILTER_PROPS_CODE']['FRAME_COUNT_FUNCTION'].'_VALUE' => 2,
                                        '=PROPERTY_'.$arResult['FILTER_PROPS_CODE']['COLLECTION'].'_VALUE' => \FourPx\Helper::getOriginalCollections()
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
                                $component
                            );?>

                            <?$APPLICATION->IncludeComponent(
                                "bitrix:catalog.smart.filter",
                                "configurator.mechanism",
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
                                    "PREFILTER_NAME" => "smartPreFilterFunction",	// Имя входящего массива для дополнительной фильтрации элементов
                                    "PRICE_CODE" => array(	// Тип цены
                                        0 => "BASE",
                                    ),
                                    "SAVE_IN_SESSION" => "N",	// Сохранять установки фильтра в сессии пользователя
                                    "SECTION_CODE" => "FUNCTION",	// Код раздела
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
                                $component
                            );?>
                        </div>

                        <div class="config-panel__row config-panel__row_second">
                            <?
                            $arrFilterFunction = array();
                            foreach ($arResult['FILTER_FUNCTION'] as $filterCode) {
                                if (count($arrFilter[ $filterCode ]) > 0) {
                                    $arrFilterFunction[ $filterCode ] = $arrFilter[ $filterCode ];

                                }
                            }

                            $arrFilterFrame = array();
                            foreach ($arResult['FILTER_FRAME'] as $filterCode) {
                                if (count($arrFilter[ $filterCode ]) > 0) {
                                    $arrFilterFrame[ $filterCode ] = $arrFilter[ $filterCode ];
                                }
                            }
                            ?>

                            <div class="config-panel__column shadow configurator-catalog-frame-js">
                                <?$APPLICATION->IncludeComponent(
                                    "4px:configurator-main.frame-catalog",
                                    "",
                                    Array(
                                        "CACHE_TYPE" => "Y",
                                        "CACHE_TIME" => 3600,
                                        "CATALOG_IBLOCK_TYPE" => "catalog",
                                        "CATALOG_IBLOCK_ID" => 25,
                                        "SECTION_CODE" => "FRAME",
                                        "CATALOG_FILTER" => $arrFilterFrame,
                                        "arOrder" => array(
                                            "PROPERTY_COLLECTION.SORT" => "ASC",
                                            "NAME" => "ASC",
                                            "ID" => "DESC"
                                        )
                                    ),
                                    $component
                                );?>
                            </div>

                            <div class="config-panel__column shadow configurator-catalog-mechanism-js">
                                <?$APPLICATION->IncludeComponent(
                                    "4px:configurator-main.mechanism-catalog",
                                    "",
                                    Array(
                                        "CACHE_TYPE" => "Y",
                                        "CACHE_TIME" => 3600,
                                        "CATALOG_IBLOCK_TYPE" => "catalog",
                                        "CATALOG_IBLOCK_ID" => 25,
                                        "SECTION_CODE" => "FUNCTION",
                                        "CATALOG_FILTER" => $arrFilterFunction,
                                        "arOrder" => array(
                                            "PROPERTY_COLLECTION.SORT" => "ASC",
                                            "propertysort_FUNCTION_GROUP" => "ASC",
                                            "NAME" => "ASC",
                                            "ID" => "DESC"
                                        )
                                    ),
                                    $component
                                );?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Отображение товаров в мобильной версии -->
            <div class="config__bottom">
                <div class="config__bottom-left">
                    <div class="config-bottom-settings">
                        <div class="config-bottom-settings__blocks">
                            <div class="config-bottom-settings__block config-bottom-settings__block_choice">
                                <div class="my-btn my-btn_gray filled js-call-window" data-target="frames">
                                    выбор рамки
                                </div>
                            </div>

                            <div class="config-bottom-settings__block config-bottom-settings__block_choice">
                                <div class="my-btn my-btn_gray filled js-call-window" data-target="mechanisms">
                                    выбор механизма
                                </div>
                            </div>

                            <div class="config-bottom-settings__block config-bottom-settings__block_promise">
                                <select class="select style style-2 changer" data-target="#modalroom" id="room">
                                    <option value="Не выбрано">
                                        Помещение
                                    </option>
                                    <?
                                    $IDRooms = \FourPx\Helper::getIblockIdByCodes('rooms')["rooms"];
                                    $arSelect = Array("ID", "NAME");
                                    $arFilter = Array("IBLOCK_ID"=> $IDRooms, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                                    while($ob = $res->GetNextElement())
                                    {
                                        $arFields = $ob->GetFields();?>
                                        <option value="<?=$arFields['NAME']?>" data-name="<?=$arFields['NAME']?>">
                                            <?=$arFields['NAME']?>
                                        </option>;
                                    <?}
                                    ?>
                                </select>
                            </div>

                            <div class="config-bottom-settings__block config-bottom-settings__block_walls">
                                <select class="select style style-2 changer" data-target="#modalwall" id="wall">
                                    <option value="Не выбрано">
                                        Стены
                                    </option>

                                    <?
                                    $IDWalls = \FourPx\Helper::getIblockIdByCodes('walls')["walls"];
                                    $arSelect = Array("ID", "NAME");
                                    $arFilter = Array("IBLOCK_ID"=> $IDWalls, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                                    while($ob = $res->GetNextElement())
                                    {
                                        $arFields = $ob->GetFields();?>
                                        <option value="<?=$arFields['NAME']?>" data-name="<?=$arFields['NAME']?>">
                                            <?=$arFields['NAME']?>
                                        </option>;
                                    <?}
                                    ?>
                                </select>
                            </div>

                            <div class="config-bottom-settings__block config-bottom-settings__block_add">
                                <div class="config-bottom-settings__element">
                                    <div class="config-bottom-settings__element-bg">
                                        <a class="conf-setbg popup-with-move-anim" href="#popup-setbg">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/img/configurator/bg.png"
                                                 alt=""
                                                 role="presentation"
                                            />
                                            <span class="conf-setbg__text">Установить фон</span>
                                        </a>
                                    </div>

                                    <div class="config-bottom-settings__element-add">
                                    <a class="icon-text icon-text_hover popup-with-move-anim" href="" id="hrefdef">
                                            <span class="icon-text__icon">
                                                <svg class="icon icon_star">
                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#heart"></use>
                                                </svg>
                                            </span>

                                            <span class="icon-text__text deferred">
                                                Добавить в Избранное
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="config-bottom-settings__result">
                            <div class="config-result">
                                <div class="config-result__top">
                                    <div class="config-result__top-left">
                                        <div class="config-result__price">
                                            <div class="config-result__price-text">
                                                Стоимость комплекта
                                            </div>
                                            <div class="config-result__price-pos">
                                                (<span id="itnum"><span>0 позиций<span><span>)
                                            </div>
                                        </div>
                                    </div>

                                    <div class="config-result__top-right">
                                        <div class="config-result__rub">
                                            <span id="fullPrice">0</span> руб.
                                        </div>
                                    </div>
                                </div>

                                <div class="config-result__bottom">
                                    <div class="config-result__basket">
                                        <a class="config-result__button my-btn my-btn_stroked" href="#">
                                            перейти в корзину
                                        </a>
                                    </div>

                                    <div class="config-result__add">
                                        <a class="config-result__button button my-btn popup-with-move-anim js-add-to-order"
                                           href="#popup-config"
                                        >
                                            Добавить в корзину
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="config-warning config__warning">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "incs",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "PATH" => "/include/text-config.php"
                            ),
                            $component
                        );?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




     <div class="popup popup_specification zoom-anim-dialog mfp-hide" id="popup-deferred">
            <div class="popup__content">
                <div class="specification-popup">
                    <div class="specification-popup__title popup-title">
                        Выбранные вами товары добавлены в
                        избранное
                    </div>

                    <div class="specification-popup__buttons">
                        <div class="specification-popup__button">
                            <div class="my-btn my-btn_stroked js-close-popup">
                                Продолжить
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