<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<form action="" class="" method="get" name="shopsFilter">
    <div class="r-order__mob">
        <div class="r-order-mob">
            <div class="r-order-mob__left">
                <div class="my-btn my-btn_gray my-btn_stroked my-btn_fsm my-btn_sp my-btn_ttn js-order-filter filled">Фильтр</div>
            </div>
            <div class="r-order-mob__right">
                <div class="my-btn my-btn_gray my-btn_stroked my-btn_fsm my-btn_sp my-btn_ttn js-filter-reset">Сбросить</div>
            </div>
        </div>
    </div>
    <div class="r-order__head">
        <div class="r-order__head-top-wrap">
            <div class="r-order__close js-order-filter-close"><div class="close-icon"></div></i>
            </div>
            <div class="r-order__head-top">
                <div class="r-order__head-item r-order__head-switch">
                    <div class="b-where__types js-tab-btn">
                        <a class="b-where__type-list active" href="#" data-target=".js-type-list">
                            <div class="b-where__type-list__wrap">
                                <svg class="icon icon_setup">
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#setup"></use>
                                </svg><span>&Scy;&pcy;&icy;&scy;&ocy;&kcy;</span>
                            </div>
                        </a>
                        <a class="b-where__type-map" href="#" data-target=".js-type-map">
                            <div class="b-where__type-list__wrap">
                                <svg class="icon icon_placeholder">
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#placeholder"></use>
                                </svg><span>&Kcy;&acy;&rcy;&tcy;&acy;</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="r-order__head-item r-order__head-apply">
                    <div class="my-btn my-btn_gray my-btn_stroked my-btn_fsm my-btn_ttn">Применить
                    </div>
                </div>
                <div class="r-order__head-item r-order__head-search">
                    <div class="b-where__search">
                        <input class="b-where__search-text js-search-name-field" type="text" placeholder="Поиск" name="search" value="<?=$arResult['CUR_FILTER']['%NAME']?>">
                        <button class="b-where__search-submit js-search-name-btn">
                            <svg class="icon icon_loop">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite/sprite.svg#loop"></use>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="r-order__head-item r-order__head-city">
                     <select class="style style-2 js-form-city basic" name="city" >
                         <option value="">Город</option>
                         <?
                         $cities = $arResult['ITEMS'][$arResult['FILTER_PROPS']['CONFIGURATOR_CITY']['ID']];
                         ?>
                         <?foreach ($cities['VALUES'] as $id => $item){?>
                             <option value="<?=$id?>" data-id="<?=$id?>" <?if($arResult['CUR_FILTER']['PROPERTY_CONFIGURATOR_CITY'] == $id){echo ' selected';}?>><?=$item['VALUE']?></option>
                         <?}
                         unset($cities, $id, $item)?>
                    </select>
                </div>
                <?/*?>
                <div class="r-order__head-item r-order__head-metro">
                    <select class="style style-2 js-form-metro basic" name="<?=$arResult['FILTER_NAME'].'_'.$arResult['FILTER_PROPS']['CONFIGURATOR_METRO']['ID']?>">
                        <option value="">Метро</option>
                        <?
                        $metros = $arResult['ITEMS'][$arResult['FILTER_PROPS']['CONFIGURATOR_METRO']['ID']];
                        ?>
                        <?foreach ($metros['VALUES'] as $item){?>
                            <option value="<?=$item['HTML_VALUE_ALT']?>" class="f-metro-<?=$item['CITY']?>"><?=$item['VALUE']?></option>
                        <?}
                        unset($metros, $item)?>
                    </select>
                </div>
                <?*/?>
                <div class="r-order__head-item r-order__head-nearest">
                    <? /*
                    <div class="my-btn my-btn_stroked my-btn_fsm my-btn_ttn">Показать ближайшие
                    </div>
                    */?>
                </div>

                <div class="r-order__head-reset">
                    <div class="my-btn my-btn_gray my-btn_fsm my-btn_ttn js-filter-reset">Сбросить
                    </div>
                </div>
            </div>
        </div>
        <div class="r-order__head-bottom">
            <div class="r-order__checkboxes">
                <?
                $shopTypes = $arResult['ITEMS'][$arResult['FILTER_PROPS']['TYPE']['ID']];
                ?>
                <?foreach ($shopTypes['VALUES'] as $id => $item){?>
                    <div class="r-order__checkbox">
                        <div class="checker">
                            <label class="checker__label">
                                <input
                                        class="input checker__checkbox js-form-checkbox"
                                        name="type" value="<?=$id?>" type="checkbox" tabindex="0"
                                    <?if($arResult['CUR_FILTER']['PROPERTY_TYPE'] == $id){echo ' checked';}?>
                                />
                                <span class="checker__box checker__box_2 checker__box_lg"><span class="check-icon"></span></span>
                                <span class="checker__text"><?=$item['VALUE']?></span>
                            </label>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</form>