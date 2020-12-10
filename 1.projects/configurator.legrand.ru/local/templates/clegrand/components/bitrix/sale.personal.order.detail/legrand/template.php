<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="section-basket section-style">
    <div class="section-basket__container container">
        <div class="basket basket-real">
            <div class="basket__head">
                <h1 class="basket__title page-title">
                    <? if ($arResult['ORDER_PROPS']['PROJECT_NAME']) { ?>
                        <?= $arResult['ORDER_PROPS']['PROJECT_NAME'] ?>
                        <small>(заказ № <?= $arResult['ID'] ?> от <?= $arResult['DATE_INSERT_FORMATED'] ?>)</small>
                    <? } else { ?>
                        Заказ № <?= $arResult['ID'] ?> от <?= $arResult['DATE_INSERT_FORMATED'] ?>
                    <? } ?>
                </h1>
            </div>
            <div class="basket-content">
                <div class="basket-content__left">
                    <div class="basket-kit basket-kit_order-detail">
                        <ul class="basket-kit__list">
                            <? foreach ($arResult['BASKET'] as $arComp) { ?>
                                <li class="basket-kit__item">
                                    <div class="basket-kit__kit">
                                        <div class="basket-kit__kit-left"><?= $arComp['NAME'] ?></div>
                                        <div class="basket-kit__kit-right">
                                            <div class="basket-kit__params">
                                                <div class="basket-kit__param">
                                                    <div class="param">
                                                        <div class="param__name">помещение:</div>
                                                        <div class="param__value"><?= $arComp['WALLS'] ?></div>
                                                    </div>
                                                </div>
                                                <div class="basket-kit__param">
                                                    <div class="param">
                                                        <div class="param__name">тип стен:</div>
                                                        <div class="param__value"><?= $arComp['ROOM'] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basket-kit__table">
                                        <div class="m-table m-table_basket">
                                            <div class="m-table__head">
                                                <div class="m-table__head-item m-table-column-1">СОСТАВ
                                                    КОМПЛЕКТУЮЩИХ
                                                </div>
                                                <div class="m-table__head-item m-table-column-2">КОЛ-ВО (шт.)
                                                </div>
                                                <div class="m-table__head-item m-table-column-3">СТОИМОСТЬ
                                                </div>
                                            </div>
                                            <div class="m-table__content">

                                                <? foreach ($arComp['ITEMS'] as $arItem) { ?>
                                                    <div class="m-table__body">
                                                        <div class="m-table__body-item m-table-column-1">
                                                            <div class="m-table__desktop">
                                                                <? if ($arItem['PROPS']['MEX']){ ?>
                                                                <div class="kit-good-block"><? } ?>
                                                                    <div class="kit-good">
                                                                        <div class="kit-good__image window-holder">
                                                                            <? if ($arItem['IB_PROPS']['PICTURE']) { ?>
                                                                                <img src="<?= $arItem['IB_PROPS']['PICTURE'] ?>"
                                                                                     alt="" role="presentation"/>
                                                                            <? } ?>
                                                                            <div class="p-window">
                                                                                <div class="p-window__close">
                                                                                    <div class="close-icon js-close-p-window"></div>
                                                                                </div>
                                                                                <div class="p-window__wrap">
                                                                                    <div class="breaker">
                                                                                        <div class="breaker__image">
                                                                                            <? if ($arItem['IB_PROPS']['PICTURE']) { ?>
                                                                                                <img
                                                                                                        class="breaker__preview"
                                                                                                        src="<?= $arItem['IB_PROPS']['PICTURE'] ?>"
                                                                                                        alt="<?= $arItem['NAME_FULL'] ?>"
                                                                                                        title="<?= $arItem['NAME_FULL'] ?>"
                                                                                                />
                                                                                            <? } ?>
                                                                                        </div>
                                                                                        <div class="breaker__title"><?= $arItem['NAME_FORMATED'] ?></div>
                                                                                        <div class="breaker__color"><?= $arItem['IB_PROPS']['COLOR'] ?></div>
                                                                                        <? if ($arItem['IB_PROPS']['COUNT_FUNCTION']) { ?>
                                                                                            <div class="breaker__posts">
                                                                                                Постов: <?= $arItem['IB_PROPS']['COUNT_FUNCTION'] ?></div>
                                                                                        <? } ?>
                                                                                        <div class="breaker__price">
                                                                                            Цена <?= $arItem['PRICE_FORMATED'] ?>
                                                                                            руб.
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kit-good__content">
                                                                            <? if ($arItem['PROPS']['MEX']) { ?>
                                                                                <div class="kit-good__head">
                                                                                    <div class="kit-good__name"><?= $arItem['PROPS']['ARTICUL']['VALUE'] ?></div>
                                                                                    <div class="kit-good__details"><a
                                                                                                class="js-toggle-composition"
                                                                                                href="#">Посмотреть
                                                                                            состав</a></div>
                                                                                </div>
                                                                            <? } else { ?>
                                                                                <div class="kit-good__name"><?= $arItem['PROPS']['ARTICUL']['VALUE'] ?></div>
                                                                            <? } ?>
                                                                            <div class="kit-good__text"><?= $arItem['NAME_FULL'] ?></div>
                                                                        </div>
                                                                    </div>
                                                                    <? if ($arItem['PROPS']['MEX']){ ?>
                                                                    <div class="kit-good-block__details">
                                                                        <? foreach ($arItem['PROPS']['MEX']['VALUE'] as $arMex) { ?>
                                                                            <div class="kit-good-block__detail">
                                                                                <div class="kit-good-detail">
                                                                                    <div class="kit-good-detail__articul"><?= $arMex['ARTICUL'] ?></div>
                                                                                    <div class="kit-good-detail__text"><?= $arMex['NAME'] ?></div>
                                                                                    <div class="kit-good-detail__price"><?= $arMex['PRICE_FORMATED'] ?>
                                                                                        руб.
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <? } ?>
                                                                    </div>
                                                                </div> <? /* CLOSE .kit-good-block*/ ?>
                                                            <? } ?>
                                                            </div>
                                                            <div class="m-table__mob">
                                                                <strong><?= $arItem['PROPS']['ARTICUL']['VALUE'] ?></strong>
                                                                <?= $arItem['NAME_FULL'] ?>
                                                            </div>
                                                        </div>
                                                        <div class="m-table__body-item m-table-column-2">
                                                            <div class="m-table__desktop">
                                                                <div class="kit-number kit-number_centered">
                                                                    <div class="kit-number__value"><?= $arItem['QUANTITY'] ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="m-table__mob">
                                                                <div class="m-table__row">
                                                                    <div class="m-table__row-left">
                                                                        <div class="kit-mob">
                                                                            <div class="kit-mob__image">
                                                                                <? if ($arItem['IB_PROPS']['PICTURE']) { ?>
                                                                                    <img
                                                                                            src="<?= $arItem['IB_PROPS']['PICTURE'] ?>"
                                                                                            alt="<?= $arItem['NAME_FULL'] ?>"
                                                                                            title="<?= $arItem['NAME_FULL'] ?>"
                                                                                            role="presentation"
                                                                                    />
                                                                                <? } ?>
                                                                            </div>
                                                                            <div class="kit-mob__price">ЦЕНА:</div>
                                                                            <div class="kit-mob__price-val"><?= $arItem['SUM_FORMATED'] ?>
                                                                                руб.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="m-table__row-right">
                                                                        <div class="kit-number kit-number_centered">
                                                                            <div class="kit-number__value"><?= $arItem['QUANTITY'] ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-table__body-item m-table-column-3">
                                                            <strong><?= $arItem['SUM_FORMATED'] ?> руб.</strong>
                                                        </div>
                                                    </div>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basket-kit__bottom">
                                        <div class="basket-kit-bottom basket-kit-bottom_basket">
                                            <div class="basket-kit-bottom__btns"></div>
                                            <div class="basket-kit-bottom__price">
                                                <div class="p-price p-price_inline">
                                                    <div class="p-price__text">стоимость <br> комплекта
                                                    </div>
                                                    <div class="p-price__value">
                                                        <span> <?= $arComp['SUM_FORMATED'] ?> </span> руб.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
                <div class="basket-content__right">
                    
                </div>
            </div>
        </div>
        <div>
            <a class="legrand-link legrand-link_blue" href="<?= $arResult['URL_TO_LIST'] ?>">Вернуться к списку заказов</a>
        </div>
    </div>
</div>
