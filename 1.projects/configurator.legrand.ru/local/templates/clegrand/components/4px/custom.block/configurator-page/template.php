<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
    <div class="popup popup_config zoom-anim-dialog mfp-hide" id="popup-config">
        <div class="popup__content">
            <div class="config-popup">
                <div class="config-popup__title">Ваша конфигурация комплекта сохранена
                </div>


                <div class="config-popup__kit">
                    <div class="config-popup__kit-left"><!-- Комплект Антрацит 51 постов -->
                    </div>
                    <div class="config-popup__kit-right">
                        <div class="config-popup__kit-blocks">
                            <div class="config-popup__kit-block">
                                <div class="config-popup__kit-name">Помещение
                                </div>
                                <div class="config-popup__kit-value">
                                    <select class="clear" id="modalroom">
                                        <option value="Не выбрано">Не выбрано</option>
                                        <?foreach ($arResult['LISTS']['rooms'] as $arItem){?>
                                            <option value="<?=$arItem['NAME']?>" data-name="<?=$arItem['NAME']?>">
                                                <?=$arItem['NAME']?>
                                            </option>
                                        <?}
                                        unset($arItem);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="config-popup__kit-block">
                                <div class="config-popup__kit-name">Тип стен
                                </div>
                                <div class="config-popup__kit-value">
                                    <select class="clear" id="modalwall">
                                        <option value="Не выбрано">Не выбрано</option>
                                        <?foreach ($arResult['LISTS']['walls'] as $arItem){?>
                                            <option value="<?=$arItem['NAME']?>" data-name="<?=$arItem['NAME']?>">
                                                <?=$arItem['NAME']?>
                                            </option>
                                        <?}
                                        unset($arItem);
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="config-popup__table">
                    <div class="m-table m-table_config">
                        <div class="m-table__head">
                            <div class="m-table__head-item m-table-column-1">СОСТАВ КОМПЛЕКТУЮЩИХ
                            </div>
                            <div class="m-table__head-item m-table-column-2">КОЛ-ВО
                            </div>
                            <div class="m-table__head-item m-table-column-3">СТОИМОСТЬ
                            </div>
                        </div>
                        <div class="m-table__content">
                    </div>
                </div>


                        </div>
                    </div>
                    <div class="config-popup__settings">
                        <div class="config-popup__settings-blocks">
                            <div class="settings-block">
                                <div class="settings-block__item">
                                    <div class="icon-text icon-text_hover">
                                        <div class="icon-text__icon">
                                            <svg class="icon icon_trash">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#trash"></use>
                                            </svg>
                                        </div>
                                        <div class="icon-text__text delmod" data-name="">Удалить комплект
                                        </div>
                                    </div>
                                </div>
                                <div class="settings-block__item">
                                    <div class="icon-text icon-text_hover js-change-kit">
                                        <div class="icon-text__icon">
                                            <svg class="icon icon_gear">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#gear"></use>
                                            </svg>
                                        </div>
                                        <div class="icon-text__text">Изменить комплект
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="config-popup__settings-right">
                            <div class="kit-number">
                                <div class="kit-number__text" id="compNum">количество комплектов:
                                </div>
                                <div class="kit-number__btn kit-number__btn_min configminus">-
                                </div>
                                <div class="kit-number__value" id="modNum">1
                                </div>
                                <div class="kit-number__btn kit-number__btn_plus configplus">+
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="config-popup__bottom">
                    <div class="config-popup-bottom">
                        <div class="config-popup-bottom__left">
                            <div class="config-popup-bottom__btns">
                               <a href="/configurator/"> <div class="config-popup-bottom__button my-btn my-btn_stroked">Новый комплект
                                </div></a>
                                <a href="/personal/cart/"><div class="config-popup-bottom__button my-btn">Перейти в корзину
                                </div></a>
                            </div>
                        </div>
                        <div class="config-popup-bottom__right">
                            <div class="p-price">
                                <div class="p-price__text">стоимость комплекта
                                </div>
                                <div class="p-price__value"><span id="Sum"> 5 310,20 </span> руб.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    <div class="popup popup_setbg zoom-anim-dialog mfp-hide" id="popup-setbg">
        <div class="popup__content">
            <div class="setbg">
                <div class="setbg__title popup-title">установить фон
                </div>
                <div class="setbg-upload setbg__upload">
                    <div class="setbg-upload__text setbg-subtitle">загрузите фото своих обоев
                    </div>
                    <div class="setbg-upload__upload">
                        <label>
                            <input class="js-input-bg" type="file">
                            <div class="my-btn my-btn_stroked my-btn_fsm my-btn_ttn">Загрузить файл
                            </div>
                        </label>
                    </div>
                    <div class="setbg-upload__delete">
                        <div class="icon-text icon-text_hover js-delete-bg">
                            <div class="icon-text__icon">
                                <svg class="icon icon_trash">
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#trash"></use>
                                </svg>
                            </div>
                            <div class="icon-text__text">Удалить
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setbg__collection setbg__collection_bg">
                    <div class="setbg__collection-title setbg-subtitle">Фон из нашей коллекции:
                    </div>


                    <ul class="setbg__list">
                        <?foreach ($arResult['LISTS']['fon'] as $arItem){?>
                            <li class="setbg__item">
                                <div
                                        class="setbg__block js-set-bg"
                                        data-id="<?=$arItem['ID']?>"
                                        style="background: url(<?=$arResult['FILES'][ $arItem["PREVIEW_PICTURE"] ]?>)">
                                </div>
                            </li>
                        <?}
                        unset($arItem);
                        ?>
                    </ul>
                </div>
                <div class="setbg__collection">
                    <div class="setbg__collection-title setbg-subtitle">Цвет покраски стен:
                    </div>
                    <ul class="setbg__colors">
                        <?foreach ($arResult['LISTS']['color'] as $arItem){?>
                            <li class="setbg__color js-set-bg" style="background-color: rgba(<?=$arItem['COLOR']?>);" data-color="rgba(<?=$arItem['COLOR']?>)"></li>
                        <?}
                        unset($arItem);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <?$APPLICATION->IncludeComponent(
        "4px:configurator-main",
        "",
        Array(
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => 3600
        )
    );?>