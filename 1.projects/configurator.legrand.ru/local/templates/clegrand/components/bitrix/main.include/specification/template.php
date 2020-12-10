<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
?>
<div class="basket__content">
    <div class="basket-content">
        <div class="basket-content__left">
            <div class="basket-kit">
                <ul class="basket-kit__list">
                    <li class="basket-kit__item">
                        <div class="basket-kit__kit">
                            <div class="basket-kit__kit-left">
                                Добавленные товары (без комплекта)
                            </div>

                            <div class="basket-kit__kit-mid"></div>

                            <div class="basket-kit__kit-right">
                                <div class="basket-kit__params"></div>
                            </div>

                            <div class="basket-kit__kit-btns">
                                <div class="settings-block"></div>
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

                                <div class="m-table__content">
                                    <!-- element begin -->
                                    <div class="m-table__body">
                                        <div class="m-table__body-item m-table-column-1">
                                            <div class="m-table__desktop">
                                                <div class="kit-good">
                                                    <div class="kit-good__image window-holder">
                                                        <img src="/upload/iblock/e66/legrand_etika_672300.png"
                                                             role="presentation"
                                                        >

                                                        <div class="p-window">
                                                            <div class="p-window__close">
                                                                <div class="close-icon js-close-p-window"></div>
                                                            </div>

                                                            <!-- Всплывающее окно begin -->
                                                            <div class="p-window__wrap">
                                                                <div class="breaker breaker_2">
                                                                    <div class="breaker__top">
                                                                        <div class="breaker__top-left">
                                                                            <img src="/upload/iblock/e66/legrand_etika_672300.png"
                                                                                 alt="Переключатель IP44"
                                                                                 title=""
                                                                            >
                                                                        </div>

                                                                        <div class="breaker__top-right">
                                                                            <div class="breaker__title">
                                                                                Переключатель IP44
                                                                            </div>

                                                                            <div class="breaker__price">
                                                                                Цена
                                                                                368.24 руб.
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <p class="breaker__desc"></p>
                                                                </div>
                                                            </div>
                                                            <!-- Всплывающее окно end -->
                                                        </div>
                                                    </div>

                                                    <div class="kit-good__content">
                                                        <div class="kit-good__name">
                                                            672202
                                                        </div>

                                                        <div class="kit-good__text">
                                                            Переключатель IP44
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-table__mob">
                                                <strong>672300</strong> Переключатель IP44
                                            </div>
                                        </div>

                                        <div class="m-table__body-item m-table-column-2">
                                            <div class="m-table__desktop">
                                                <div class="kit-number kit-number_centered">
                                                    <div class="kit-number__btn kit-number__btn_min desc"
                                                         update="368.24" data-id="94246">-
                                                    </div>

                                                    <div class="kit-number__value">
                                                        1
                                                    </div>

                                                    <div class="kit-number__btn kit-number__btn_plus"
                                                         data-pric="368.24"
                                                         data-id="94246"
                                                    >
                                                        +
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-table__mob">
                                                <div class="m-table__row">
                                                    <div class="m-table__row-left">
                                                        <div class="kit-mob">
                                                            <div class="kit-mob__image">
                                                                <img src="/upload/iblock/e66/legrand_etika_672300.png"
                                                                     role="presentation"
                                                                >
                                                            </div>

                                                            <div class="kit-mob__price">
                                                                ЦЕНА:
                                                            </div>

                                                            <div class="kit-mob__price-val">
                                                                368.24 руб.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="m-table__row-right">
                                                        <div class="kit-number kit-number_centered">
                                                            <div class="kit-number__btn kit-number__btn_min">
                                                                -
                                                            </div>

                                                            <div class="kit-number__value">
                                                                1
                                                            </div>

                                                            <div class="kit-number__btn kit-number__btn_plus">
                                                                +
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="m-table__body-item m-table-column-3">
                                            <strong class="itemprice" data-ids="94246">368.24 руб.</strong>
                                        </div>

                                        <div class="icon-text icon-text_hover">
                                            <div class="icon-text__icon">
                                                <div class="close-icon"></div>
                                            </div>

                                            <div class="icon-text__text">
                                                Удалить
                                            </div>
                                        </div>
                                    </div>
                                    <!-- element end -->
                                </div>

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
                                            <span id="pricespec">942.55</span> руб.
                                        </div>
                                    </div>
                                </div>

                                <div class="basket-kit-bottom__later">
                                    <div class="basket-kit-bottom__button my-btn my-btn_gray my-btn_sm">
                                        купить позже
                                    </div>
                                </div>
                            </div>
                            <div class="basket-panel__bottom">
                                <a href="#popup-specification"
                                   class="basket-panel__button my-btn popup-with-move-anim"
                                   id="basket"
                                >
                                    Добавить в заказ
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>