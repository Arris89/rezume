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

use \Bitrix\Main\Application;

$this->setFrameMode(true);

$request = Application::getInstance()->getContext()->getRequest();
?>
<div class="js-shops-ajax">
    <?
    # AJAX
    if ($request->getQuery('shops-ajax') == 'y') {
        $APPLICATION->RestartBuffer();
    }
    ?>
    <? if (count($arResult["ITEMS"]) > 0) { ?>
        <div class="r-order__map js-type-list">
            <div class="shops shops_cards">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <div class="shops__item">
                        <div class="shops__block">
                            <div class="shops__head">
                                <div class="shops__title"><?= $arItem['NAME'] ?></div>
                                <? if ($arItem['PROPERTIES']['SITE']) { ?>
                                    <div class="shops__link">
                                        <a href="<?= $arItem['PROPERTIES']['SITE']['VALUE_HREF'] ?>"><?= $arItem['PROPERTIES']['SITE']['DISPLAY_VALUE'] ?></a>
                                    </div>
                                <? } ?>
                            </div>
                            <div class="shops__content">
                                <div class="shops__visible">
                                    <? if ($arItem['PROPERTIES']['ADRESS']) { ?>
                                        <div class="shops__place"> <?= $arItem['PROPERTIES']['ADRESS']['DISPLAY_VALUE'] ?></div>
                                    <? } ?>

                                    <div class="shops__info">
                                        <? if ($arItem['PROPERTIES']['CONFIGURATOR_METRO']) { ?>
                                            <div class="shops__metro"> <?= $arItem['PROPERTIES']['CONFIGURATOR_METRO']['DISPLAY_VALUE'] ?></div>
                                        <? } ?>
                                        <? if ($arItem['PROPERTIES']['PHONE']) { ?>
                                            <div class="shops__phone"><?= $arItem['PROPERTIES']['PHONE']['DISPLAY_VALUE'] ?></div>
                                        <? } ?>
                                    </div>
                                    <? if ($arItem['PROPERTIES']['CONFIGURATOR_COLLECTIONS_REF']) { ?>
                                        <div class="shops__collections">
                                            Коллекции: <?= $arItem['PROPERTIES']['CONFIGURATOR_COLLECTIONS_REF']['DISPLAY_VALUE'] ?>
                                        </div>
                                    <? } ?>
                                    <? if ($arItem['PROPERTIES']['CONFIGURATOR_WH']) { ?>
                                        <div class="shops__time">
                                            <div class="shops__time-item"> <?= $arItem['PROPERTIES']['CONFIGURATOR_WH']['DISPLAY_VALUE'] ?></div>
                                        </div>
                                    <? } ?>
                                    <? if ($arItem['PROPERTIES']['CONFIGURATOR_DELIVERY']['DISPLAY_VALUE'] === 'Да') { ?>
                                        <div class="shops__delivery">
                                            <div class="payment-method">
                                                <div class="payment-method__icon">
                                                    <svg>
                                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#icon_delivery_lorry_mkad"/>
                                                    </svg>
                                                </div>
                                                <div class="payment-method__text">
                                                    Есть доставка
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                    <? if ($arItem['PROPERTIES']['CONFIGURATOR_PAY_CARD']['DISPLAY_VALUE'] === 'Да') { ?>
                                        <div class="shops__pay-card">
                                            <div class="payment-method payment-method_card">
                                                <div class="payment-method__icon">
                                                    <svg>
                                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#credit-card"/>
                                                    </svg>
                                                </div>
                                                <div class="payment-method__text">
                                                    Есть оплата картой
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                                <div class="shops__invisible">
                                    <div class="shops__invisible-top">

                                    </div>
                                    <div class="shops__invisible-bottom">
                                        <? if ($arItem['PROPERTIES']['CONFIGURATOR_MAP']) { ?>
                                            <div class="shops__show-on-map" style="">
                                                <button class="js-show-shop my-btn my-btn_sm pull-right" data-id="<?= $arItem['ID'] ?>">Показать на карте</button>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="shops__show">
                                <div class="my-btn balloon-btn">
                                    <a href="#" class="my-btn__text" onclick="selectShop('<?= $arItem['ID'] ?>');return false;">
                                        <span class="pc-show">Выбрать магазин</span>
                                        <span class="laptop-show">Выбрать</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <?= $arResult["NAV_STRING"] ?>
            <? endif; ?>
        </div>
        <div id="shops-map" class="r-order__map js-type-map" style="height: 500px; display: none"></div>

        <script>
            document.shops = <?= json_encode($arResult['JS_DATA'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)?>;
        </script>
    <? }else{ ?>
        <div class="r-order__map">По запросу ничего не найдено.</div>
    <? } ?>
    <?
    # AJAX
    if ($request->getQuery('shops-ajax') == 'y') {
        die();
    }
    ?>
</div>
