<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="config-goods config-goods_frames">

    <?if (! empty($arResult['FRAME']['ITEMS'])):?>
        <div class="config-goods__wrap">
            <div class="config-frame config-goods__top" data-simplebar="data-simplebar" data-simplebar-auto-hide="false">
                <div class="config-frame__list" id="koll-list">

                    <?foreach($arResult['FRAME']['ITEMS'] as $arFrame):?>

                        <div class="config-frame__item"
                             data-kollect="<?= $arFrame['COLLECTION']?>"
                             data-color="<?= $arFrame['COLOR']?>"
                             data-mat="<?= $arFrame['MATERIAL']?>"
                             data-posts="<?= $arFrame['COUNT_FUNCTION']?>"
                        >
                            <div class="config-frame__left btn-collection-js">
                                <img class="js-draggable js-set-frame lazy"
                                     data-form="radial"
                                     data-frame="<?= $arFrame['ID']?>"
                                     data-type="frame"
                                     data-coll="<?= $arFrame['COLLECTION']?>"
                                     draggable="false"
                                     data-src="<?= $arFrame['PICTURE']?>"
                                />
                            </div>

                            <div class="config-frame__right">
                                <div class="config-frame__title">
                                    <?= $arFrame['COLLECTION']?>
                                </div>

                                <div class="config-frame__color">
                                    <?= $arFrame['NAME']?>
                                </div>

                                <?if(count($arFrame['COLLECTION_POSTS']) > 0):

                                    $slotNameCoefficient = 1;
                                    if ($arFrame['COLLECTION_CODE'] == 'livinglight-germany') {
                                        $slotNameCoefficient = 2;
                                    }

                                    $frameCountFunction = \FourPx\Helper::contentArrayKeysToString($arFrame['COLLECTION_POSTS'], $slotNameCoefficient);
                                    ?>

                                    <div class="config-frame__posts">
                                        <?if (strlen($frameCountFunction) > 0):?>
                                            Пост: <?= $frameCountFunction?>
                                        <?endif?>
                                    </div>
                                <?endif?>

                                <div class="config-frame__price">
                                    <?if ((int)$arFrame['PRICE'] > 0):?>
                                     <!--    <?= $arFrame['PRICE']?> руб. -->
                                         <?=number_format($arFrame['PRICE'], 2, '.', ' ');?> руб.
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
        <p>Рамки не найдены</p>
    <?endif?>
</div>