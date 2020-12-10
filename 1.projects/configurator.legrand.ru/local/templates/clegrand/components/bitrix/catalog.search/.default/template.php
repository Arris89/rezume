<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;
$this->setFrameMode(true);
?>
<div class="specification">
    <h1 class="specification__title page-title">
        поиск по номеру или названию товара
    </h1>

    <div class="specification__content">
        <div class="specification__left">
            <div class="specification__head">
                <div class="specification__search-block">
                 <!--    <div class="specification__search-label">
                     Поиск по номеру или названию товара
                 </div> -->

                    <div class="specification__search">
                        <div class="search">
                            <?
                            global $preFilterSearch;

                            $preFilterSearch = array(
                                'PARAMS' => array(
                                    'iblock_section' => array(86, 87)
                                )
                            );
                            if (Loader::includeModule('search')) {
                                $arElements = $APPLICATION->IncludeComponent(
                                    "bitrix:search.page",
                                    ".default",
                                    Array(
                                        "RESTART" => $arParams["RESTART"],
                                        "NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
                                        "USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
                                        "CHECK_DATES" => "N",
                                        "arrFILTER" => array("iblock_" . $arParams["IBLOCK_TYPE"]),
                                        "arrFILTER_iblock_" . $arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
                                        "USE_TITLE_RANK" => "N",
                                        "DEFAULT_SORT" => "rank",
                                        "FILTER_NAME" => "preFilterSearch",
                                        "SHOW_WHERE" => "N",
                                        "arrWHERE" => array(),
                                        "SHOW_WHEN" => "N",
                                        "PAGE_RESULT_COUNT" => (isset($arParams["PAGE_RESULT_COUNT"]) ? $arParams["PAGE_RESULT_COUNT"] : 50),
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "N",
                                        "PAGER_TITLE" => "",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => "N",
                                    ),
                                    $component,
                                    array('HIDE_ICONS' => 'Y')
                                );
                            }
                            ?>
                            <div class="search__result search-result-js">
                                <div class="search__loader">
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
                                <ul class="search__list"></ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="specification__refresh" style="display: none;">
                    <div class="js-clear-spec icon-text icon-text_hover">
                        <div class="icon-text__icon">
                            <div class="close-icon"></div>
                        </div>

                        <div class="icon-text__text" id="alldel">
                            Очистить список
                        </div>
                    </div>
                </div>
            </div>

            <div class="basket__content">
                <div class="basket-content">
                    <div class="basket-content__left">
                        <div class="basket-kit">
                            <ul class="basket-kit__list">
                                <li class="basket-kit__item">
                                    <div class="basket-kit__kit basket-kit__kit_spec">
                                        <div class="basket-kit__kit-left">
                                            Добавленные товары (без комплекта)
                                        </div>
                                    </div>

                                    <div class="basket-kit__table">
                                        <div class="m-table m-table_basket" id="speclist">
                                            <div class="m-table__head">
                                                <div class="m-table__head-item m-table-column-1">
                                                    СОСТАВ КОМПЛЕКТУЮЩИХ
                                                </div>

                                                <div class="m-table__head-item m-table-column-2">
                                                    КОЛ-ВО (шт.)
                                                </div>

                                                <div class="m-table__head-item m-table-column-3">
                                                    СТОИМОСТЬ
                                                </div>
                                            </div>

                                            <div class="m-table__content"></div>
                                        </div>
                                    </div>
                                    <div class="basket-kit__bottom">
                                        <div class="basket-kit-bottom basket-kit-bottom_basket">
                                            <div class="basket-kit-bottom__btns"></div>
                                            <div class="basket-kit-bottom__price">
                                                <div class="p-price p-price_inline">
                                                    <div class="p-price__text">
                                                        Сумма:
                                                    </div>

                                                    <div class="p-price__value">
                                                        <span id="pricespec">0</span> руб.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="basket-kit-bottom__later">
                                                 <a href=""
                                                class="popup-with-move-anim" id="popdef">
                                                 <div class="basket-kit-bottom__button my-btn my-btn_gray my-btn_sm">
                                                    в избранное
                                                </div> 
                                                </a>
                                            </div>
                                        </div>
                                        <div class="basket-kit__add">
                                            <a href=""
                                               class="basket-panel__button my-btn popup-with-move-anim btn-add-order-js"  id="popbask">
                                                Добавить в корзину
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="specification__right">

<!-- 
            <div class="basket-panel">
                <div class="basket-panel__top">
                    <div class="basket-panel__download">
                        <div class="basket-panel__download-text">
                            скачать спецификацию в
                        </div>

                        <span class="basket-panel__download-link download-js"
                              data-print="xls"
                              style="cursor: pointer;"
                        >
                            xls
                        </span>

                        <span class="basket-panel__download-link download-js"
                              data-print="pdf"
                              style="cursor: pointer;"
                        >
                            pdf
                        </span>
                    </div>
                </div>

                <div class="basket-panel__main">
                    <div class="basket-panel__main-top">
                        <div class="basket-panel__block">
                            <div class="basket-panel__title basket-panel__title_input">
                                Введите название проекта
                            </div>

                            <div class="basket-panel__input">
                                <input class="input input-style"
                                       name="text"
                                       type="text"
                                       tabindex="0"
                                />
                            </div>
                        </div>

                        <div class="basket-panel__block">
                            <div class="basket-panel__title">
                                количество товаров
                            </div>

                            <div class="basket-panel__value" id="numitem">
                                0 позиций
                            </div>
                        </div>

                        <div class="basket-panel__title">
                            получение заказа
                        </div>

                        <div class="basket-panel__value">
                            В магазине партнера
                        </div>
                    </div>

                    <div class="basket-panel__main-mid">
                        <div class="basket-panel__title">
                            итоговая стоимость
                        </div>

                        <div class="basket-panel__price" id="priceitem">
                            <span> 0 </span> руб.
                        </div>

                        <div class="basket-panel__hint">
                            Стоимость продукции носит исключительно справочный характер, конечная цена в магазине партнера может отличаться.
                        </div>
                    </div>
                </div>

                <div class="basket-panel__bottom">
                    <div class="basket-panel__button my-btn">
                        оформить заказ
                    </div>
                </div>
            </div> -->


        </div>


    </div>
</div>