<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<?if (! empty($arResult['ITEMS'])):
    $areaIds = array();
    ?>
    <div class="specification__result">
        <div class="specification-result">
            <div class="specification-result__title title title_set">
                результат поиска
            </div>

            <div class="m-table m-table_basket m-table_result">
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

                    <?foreach ($arResult['ITEMS'] as $item):
                        $image = $item['PROPERTIES']['GORIZ_IMG']['VALUE'];
                        if ((int)$item['PROPERTIES']['FUNCTION_IMG']['VALUE'] > 0) {
                            $image = $item['PROPERTIES']['FUNCTION_IMG']['VALUE'];
                        }
                        $image = \CFile::GetPath($image);
                        if (empty($image)) {
                            $image = SITE_TEMPLATE_PATH.'/img/configurator/frames/1.png';
                        }
                        ?>

                        <div class="m-table__body">
                            <div class="m-table__body-item m-table-column-1">
                                <div class="m-table__desktop">
                                    <div class="kit-good">
                                        <div class="kit-good__image">

                                            <img src="<?= $image?>"
                                                 alt="<?= $item['NAME']?>"
                                                 role="presentation"
                                            />
                                        </div>
                                        <div class="kit-good__content">
                                            <div class="kit-good__name">
                                                <?= $item['PROPERTIES']['ARTICUL']['VALUE']?>
                                            </div>

                                            <div class="kit-good__text">
                                                <?= $item['NAME']?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-table__mob">
                                    <strong>
                                        <?= $item['PROPERTIES']['ARTICUL']['VALUE']?>
                                    </strong>
                                    <?= $item['CATALOG_PRICE_1']?> руб.
                                </div>
                            </div>

                            <div class="m-table__body-item m-table-column-2">
                                <div class="m-table__desktop">
                                    <div class="m-table__body-flex">
                                        <div class="icon-text icon-text_hover icon-text_plus">
                                            <div class="icon-text__icon">
                                                +
                                            </div>
                                            <div class="icon-text__text">
                                                Добавить
                                            </div>
                                        </div>

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

                                <div class="m-table__mob">
                                    <div class="m-table__row">
                                        <div class="m-table__row-left">
                                            <div class="kit-mob">
                                                <div class="kit-mob__image">
                                                    <img src="<?= $image?>"
                                                         alt=""
                                                         role="presentation"
                                                    />
                                                </div>
                                                <div class="kit-mob__price">
                                                    ЦЕНА:
                                                </div>
                                                <div class="kit-mob__price-val">
                                                    <?= $item['CATALOG_PRICE_1']?> руб.
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
                                <strong>
                        <?=number_format($item['CATALOG_PRICE_1'], 2, '.', ' ');?> руб. 
                                </strong>
                            </div>
                        </div>

                    <?endforeach?>
                </div>
            </div>
        </div>
    </div>
<?endif?>