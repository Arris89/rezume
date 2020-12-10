<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="config-goods config-goods_mechanisms">

    <?if (! empty($arResult['FUNCTION']['ITEMS'])):?>
        <div class="config-goods__wrap">
            <div class="config-frame config-goods__top" data-simplebar="data-simplebar" data-simplebar-auto-hide="false">
                <div class="config-frame__list" id="mex-list">

                    <?foreach($arResult['FUNCTION']['ITEMS'] as $arFunction):
                        $fullPriceMechanism = array_sum($arFunction['XML_ID_PRICE']);
                        $classCollection = explode(' ', $arFunction['COLLECTION']);
                        $classCollection = $classCollection[0];
                        ?>

                        <div class="config-frame__item"
                             data-kollect="<?= $arFunction['COLLECTION']?>"
                             data-funct="<?= $arFunction['FUNCTION_GROUP']?>"
                             data-functcolor="<?= $arFunction['COLOR']?>"
                        >
                            <div class="config-frame__left">
                                <img class="config-frame__preview js-draggable js-set-breaker lazy <?= $classCollection?>"
                                     data-id="<?= $arFunction['ID']?>"
                                     draggable="false"
                                     data-src="<?= $arFunction['PICTURE']?>"
                                     data-posts="<?= $arFunction['COUNT_FUNCTION']?>"
                                />
                            </div>

                            <div class="config-frame__right">
                                <div class="config-frame__title">
                                    <?= $arFunction['COLLECTION']?>
                                </div>
                                <div class="config-frame__color">
                                    <?= $arFunction['NAME']?>
                                </div>
                                <div class="config-frame__price">
                                    <?if ((int)$fullPriceMechanism > 0):?>
                                    <!--      <?= $fullPriceMechanism?> руб. -->
                                        <?= number_format($fullPriceMechanism, 2, '.', ' ');?> руб.
                                    <?endif?>
                                </div>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
        </div>

        <div class="config-goods__close js-close-panel">
            <svg class="icon icon_angle-right">
                <use xlink:href="<?= SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#angle-right"></use>
            </svg>
        </div>
    <?else:?>
        <p>Механизмы не найдены</p>
    <?endif?>
</div>