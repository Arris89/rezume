<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |    Attention!
 * |    The following comments are for system use
 * |    and are required for the component to work correctly in ajax mode:
 * |    <!-- items-container -->
 * |    <!-- pagination-container -->
 * |    <!-- component-end -->
 */

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT'])) {
    $navParams = array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
} else {
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
    $showTopPager = $arParams['DISPLAY_TOP_PAGER'];
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
    $showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$arParams['~MESS_BTN_BUY'] = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');

$generalParams = array(
    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
    'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
    'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
    'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
    'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
    'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
    'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
    'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
    'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
    'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
    'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
    'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
    'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
    'COMPARE_PATH' => $arParams['COMPARE_PATH'],
    'COMPARE_NAME' => $arParams['COMPARE_NAME'],
    'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
    'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
    'LABEL_POSITION_CLASS' => $labelPositionClass,
    'DISCOUNT_POSITION_CLASS' => $discountPositionClass,
    'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
    'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
    '~BASKET_URL' => $arParams['~BASKET_URL'],
    '~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
    '~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
    '~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
    '~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
    'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
    'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY'],
    'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
    'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
    'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
    'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
    'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
    'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE']
);

$obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-' . $navParams['NavNum'];

?>

    <div class="catalog-main__inner catalog-main__inner_content catalog-list">

        <div class="catalog-list__sorting-area sorting-area">
            <div class="sorting-area__item">
                <select class="sorting-area__select" name="sorting">
                    <option value="factory">По производителю</option>
                    <option value="color">По цвету</option>
                </select>
            </div>


            <script>

                /*Сортировка по производителю и цвету*/
                $(document).ready(function () {
                    $("select").change(function () {

                        var url = window.location.href;

                        if ($(this).val() == 'factory') {

                            var sor = '?sort=property_PROIZVODITEL&order=desc';
                            setTimeout(function () {
                                document.location.href = "" + sor + "";
                            }, 500);
                        }

                        if ($(this).val() == 'color') {
                            var sor = '?sort=property_COLOR&order=desc';
                            setTimeout(function () {
                                document.location.href = "" + sor + "";
                            }, 500);

                        }

                    });
                });

            </script>


            <div class="sorting-area__item sorting-area__item_display display"><label
                        class="display__label display__label_active display__label_table" for="display-table">Отображать
                    таблицей</label> <label class="display__label display__label_list" for="display-list">Отображать
                    списком</label></div>
        </div>

        <div class="catalog-list__products products">

            <input class="products__display-trigger"
                   id="display-table" type="radio"
                   name="display-options" value="table" checked="">
            <input class="products__display-trigger" id="display-list" name="display-options" value="list"
                   type="radio">

            <ul class="products__list">

                <?

                if ($arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y') {
                    ?>

                    <?
                }
                ?>


                <?
                if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])) {
                    $areaIds = array();

                    foreach ($arResult['ITEMS'] as $item) {
                        $uniqueId = $item['ID'] . '_' . md5($this->randString() . $component->getAction());
                        $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
                        $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
                        $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                    }
                    ?>
                    <!-- items-container -->
                    <?
                    foreach ($arResult['ITEM_ROWS'] as $rowData) {
                        $rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);
                        ?>
                        <?
                        switch ($rowData['VARIANT']) {
                            case 0:
                                ?>
                                <div class="col-xs-12 product-item-small-card">
                                    <div class="row">
                                        <div class="col-xs-12 product-item-big-card">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?
                                                    $item = reset($rowItems);
                                                    $APPLICATION->IncludeComponent(
                                                        'bitrix:catalog.item',
                                                        '',
                                                        array(
                                                            'RESULT' => array(
                                                                'ITEM' => $item,
                                                                'AREA_ID' => $areaIds[$item['ID']],
                                                                'TYPE' => $rowData['TYPE'],
                                                                'BIG_LABEL' => 'N',
                                                                'BIG_DISCOUNT_PERCENT' => 'N',
                                                                'BIG_BUTTONS' => 'N',
                                                                'SCALABLE' => 'N'
                                                            ),
                                                            'PARAMS' => $generalParams
                                                                + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                        ),
                                                        $component,
                                                        array('HIDE_ICONS' => 'Y')
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?
                                break;

                            case 1:
                                ?>
                                <div class="col-xs-12 product-item-small-card">
                                    <div class="row">
                                        <?
                                        foreach ($rowItems as $item) {
                                            ?>
                                            <div class="col-xs-6 product-item-big-card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?
                                                        $APPLICATION->IncludeComponent(
                                                            'bitrix:catalog.item',
                                                            '',
                                                            array(
                                                                'RESULT' => array(
                                                                    'ITEM' => $item,
                                                                    'AREA_ID' => $areaIds[$item['ID']],
                                                                    'TYPE' => $rowData['TYPE'],
                                                                    'BIG_LABEL' => 'N',
                                                                    'BIG_DISCOUNT_PERCENT' => 'N',
                                                                    'BIG_BUTTONS' => 'N',
                                                                    'SCALABLE' => 'N'
                                                                ),
                                                                'PARAMS' => $generalParams
                                                                    + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                            ),
                                                            $component,
                                                            array('HIDE_ICONS' => 'Y')
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?
                                break;

                            case 2:
                                ?>
                                <div class="col-xs-12 product-item-small-card">
                                    <div class="row">
                                        <?
                                        foreach ($rowItems as $item) {
                                            ?>
                                            <div class="col-sm-4 product-item-big-card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?
                                                        $APPLICATION->IncludeComponent(
                                                            'bitrix:catalog.item',
                                                            '',
                                                            array(
                                                                'RESULT' => array(
                                                                    'ITEM' => $item,
                                                                    'AREA_ID' => $areaIds[$item['ID']],
                                                                    'TYPE' => $rowData['TYPE'],
                                                                    'BIG_LABEL' => 'N',
                                                                    'BIG_DISCOUNT_PERCENT' => 'N',
                                                                    'BIG_BUTTONS' => 'Y',
                                                                    'SCALABLE' => 'N'
                                                                ),
                                                                'PARAMS' => $generalParams
                                                                    + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                            ),
                                                            $component,
                                                            array('HIDE_ICONS' => 'Y')
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?
                                break;

                            case 3:
                                ?>

                                <?
                                foreach ($rowItems as $item) {
                                    ?>
                                    <li class="products__item product">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:catalog.item',
                                        'catalog',
                                        array(
                                            'RESULT' => array(
                                                'ITEM' => $item,
                                                'AREA_ID' => $areaIds[$item['ID']],
                                                'TYPE' => $rowData['TYPE'],
                                                'BIG_LABEL' => 'N',
                                                'BIG_DISCOUNT_PERCENT' => 'N',
                                                'BIG_BUTTONS' => 'N',
                                                'SCALABLE' => 'N'
                                            ),
                                            'PARAMS' => $generalParams
                                                + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                        ),
                                        $component,
                                        array('HIDE_ICONS' => 'Y')
                                    );
                                    ?>

                                    <?
                                }
                                ?>
                                </li>
                                <?
                                break;

                            case 4:
                                $rowItemsCount = count($rowItems);
                                ?>
                                <div class="col-sm-6 product-item-big-card">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?
                                            $item = array_shift($rowItems);
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:catalog.item',
                                                '',
                                                array(
                                                    'RESULT' => array(
                                                        'ITEM' => $item,
                                                        'AREA_ID' => $areaIds[$item['ID']],
                                                        'TYPE' => $rowData['TYPE'],
                                                        'BIG_LABEL' => 'N',
                                                        'BIG_DISCOUNT_PERCENT' => 'N',
                                                        'BIG_BUTTONS' => 'Y',
                                                        'SCALABLE' => 'Y'
                                                    ),
                                                    'PARAMS' => $generalParams
                                                        + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                ),
                                                $component,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                            unset($item);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 product-item-small-card">
                                    <div class="row">
                                        <?
                                        for ($i = 0; $i < $rowItemsCount - 1; $i++) {
                                            ?>
                                            <div class="col-xs-6">
                                                <?
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.item',
                                                    '',
                                                    array(
                                                        'RESULT' => array(
                                                            'ITEM' => $rowItems[$i],
                                                            'AREA_ID' => $areaIds[$rowItems[$i]['ID']],
                                                            'TYPE' => $rowData['TYPE'],
                                                            'BIG_LABEL' => 'N',
                                                            'BIG_DISCOUNT_PERCENT' => 'N',
                                                            'BIG_BUTTONS' => 'N',
                                                            'SCALABLE' => 'N'
                                                        ),
                                                        'PARAMS' => $generalParams
                                                            + array('SKU_PROPS' => $arResult['SKU_PROPS'][$rowItems[$i]['IBLOCK_ID']])
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                                ?>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?
                                break;

                            case 5:
                                $rowItemsCount = count($rowItems);
                                ?>
                                <div class="col-sm-6 product-item-small-card">
                                    <div class="row">
                                        <?
                                        for ($i = 0; $i < $rowItemsCount - 1; $i++) {
                                            ?>
                                            <div class="col-xs-6">
                                                <?
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.item',
                                                    '',
                                                    array(
                                                        'RESULT' => array(
                                                            'ITEM' => $rowItems[$i],
                                                            'AREA_ID' => $areaIds[$rowItems[$i]['ID']],
                                                            'TYPE' => $rowData['TYPE'],
                                                            'BIG_LABEL' => 'N',
                                                            'BIG_DISCOUNT_PERCENT' => 'N',
                                                            'BIG_BUTTONS' => 'N',
                                                            'SCALABLE' => 'N'
                                                        ),
                                                        'PARAMS' => $generalParams
                                                            + array('SKU_PROPS' => $arResult['SKU_PROPS'][$rowItems[$i]['IBLOCK_ID']])
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                                ?>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 product-item-big-card">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?
                                            $item = end($rowItems);
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:catalog.item',
                                                '',
                                                array(
                                                    'RESULT' => array(
                                                        'ITEM' => $item,
                                                        'AREA_ID' => $areaIds[$item['ID']],
                                                        'TYPE' => $rowData['TYPE'],
                                                        'BIG_LABEL' => 'N',
                                                        'BIG_DISCOUNT_PERCENT' => 'N',
                                                        'BIG_BUTTONS' => 'Y',
                                                        'SCALABLE' => 'Y'
                                                    ),
                                                    'PARAMS' => $generalParams
                                                        + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                ),
                                                $component,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                            unset($item);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?
                                break;

                            case 6:
                                ?>
                                <div class="col-xs-12 product-item-small-card">
                                    <div class="row">
                                        <?
                                        foreach ($rowItems as $item) {
                                            ?>
                                            <div class="col-xs-6 col-sm-4 col-md-2">
                                                <?
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.item',
                                                    '',
                                                    array(
                                                        'RESULT' => array(
                                                            'ITEM' => $item,
                                                            'AREA_ID' => $areaIds[$item['ID']],
                                                            'TYPE' => $rowData['TYPE'],
                                                            'BIG_LABEL' => 'N',
                                                            'BIG_DISCOUNT_PERCENT' => 'N',
                                                            'BIG_BUTTONS' => 'N',
                                                            'SCALABLE' => 'N'
                                                        ),
                                                        'PARAMS' => $generalParams
                                                            + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                                ?>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?
                                break;

                            case 7:
                                $rowItemsCount = count($rowItems);
                                ?>
                                <div class="col-sm-6 product-item-big-card">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?
                                            $item = array_shift($rowItems);
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:catalog.item',
                                                '',
                                                array(
                                                    'RESULT' => array(
                                                        'ITEM' => $item,
                                                        'AREA_ID' => $areaIds[$item['ID']],
                                                        'TYPE' => $rowData['TYPE'],
                                                        'BIG_LABEL' => 'N',
                                                        'BIG_DISCOUNT_PERCENT' => 'N',
                                                        'BIG_BUTTONS' => 'Y',
                                                        'SCALABLE' => 'Y'
                                                    ),
                                                    'PARAMS' => $generalParams
                                                        + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                ),
                                                $component,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                            unset($item);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 product-item-small-card">
                                    <div class="row">
                                        <?
                                        for ($i = 0; $i < $rowItemsCount - 1; $i++) {
                                            ?>
                                            <div class="col-xs-6 col-md-4">
                                                <?
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.item',
                                                    '',
                                                    array(
                                                        'RESULT' => array(
                                                            'ITEM' => $rowItems[$i],
                                                            'AREA_ID' => $areaIds[$rowItems[$i]['ID']],
                                                            'TYPE' => $rowData['TYPE'],
                                                            'BIG_LABEL' => 'N',
                                                            'BIG_DISCOUNT_PERCENT' => 'N',
                                                            'BIG_BUTTONS' => 'N',
                                                            'SCALABLE' => 'N'
                                                        ),
                                                        'PARAMS' => $generalParams
                                                            + array('SKU_PROPS' => $arResult['SKU_PROPS'][$rowItems[$i]['IBLOCK_ID']])
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                                ?>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?
                                break;

                            case 8:
                                $rowItemsCount = count($rowItems);
                                ?>
                                <div class="col-sm-6 product-item-small-card">
                                    <div class="row">
                                        <?
                                        for ($i = 0; $i < $rowItemsCount - 1; $i++) {
                                            ?>
                                            <div class="col-xs-6 col-md-4">
                                                <?
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.item',
                                                    '',
                                                    array(
                                                        'RESULT' => array(
                                                            'ITEM' => $rowItems[$i],
                                                            'AREA_ID' => $areaIds[$rowItems[$i]['ID']],
                                                            'TYPE' => $rowData['TYPE'],
                                                            'BIG_LABEL' => 'N',
                                                            'BIG_DISCOUNT_PERCENT' => 'N',
                                                            'BIG_BUTTONS' => 'N',
                                                            'SCALABLE' => 'N'
                                                        ),
                                                        'PARAMS' => $generalParams
                                                            + array('SKU_PROPS' => $arResult['SKU_PROPS'][$rowItems[$i]['IBLOCK_ID']])
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                                ?>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 product-item-big-card">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?
                                            $item = end($rowItems);
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:catalog.item',
                                                '',
                                                array(
                                                    'RESULT' => array(
                                                        'ITEM' => $item,
                                                        'AREA_ID' => $areaIds[$item['ID']],
                                                        'TYPE' => $rowData['TYPE'],
                                                        'BIG_LABEL' => 'N',
                                                        'BIG_DISCOUNT_PERCENT' => 'N',
                                                        'BIG_BUTTONS' => 'Y',
                                                        'SCALABLE' => 'Y'
                                                    ),
                                                    'PARAMS' => $generalParams
                                                        + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                ),
                                                $component,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                            unset($item);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?
                                break;

                            case 9:
                                ?>
                                <div class="col-xs-12">
                                    <div class="row">
                                        <?
                                        foreach ($rowItems as $item) {
                                            ?>
                                            <div class="col-xs-12 product-item-line-card">
                                                <?
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.item',
                                                    '',
                                                    array(
                                                        'RESULT' => array(
                                                            'ITEM' => $item,
                                                            'AREA_ID' => $areaIds[$item['ID']],
                                                            'TYPE' => $rowData['TYPE'],
                                                            'BIG_LABEL' => 'N',
                                                            'BIG_DISCOUNT_PERCENT' => 'N',
                                                            'BIG_BUTTONS' => 'N'
                                                        ),
                                                        'PARAMS' => $generalParams
                                                            + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                                ?>
                                            </div>
                                            <?
                                        }
                                        ?>

                                    </div>
                                </div>
                                <?
                                break;
                        }
                        ?>

                        <?
                    }
                    unset($generalParams, $rowItems);
                    ?>
                    <!-- items-container -->
                    <?
                } else {
                    // load css for bigData/deferred load
                    $APPLICATION->IncludeComponent(
                        'bitrix:catalog.item',
                        '',
                        array(),
                        $component,
                        array('HIDE_ICONS' => 'Y')
                    );
                }
                ?>


            </ul>
        </div>
    </div>


    <div class="catalog-main__inner catalog-main__inner_controls view-controls">
        <div class="view-controls__count">

            <span class="view-controls__name">Показывать по:</span> <select
                    class="view-controls__select" name="view-count">


                <?

                $variable = [16, 32, 64];
                if (isset($_SESSION['list'])) {

                    foreach ($variable as $key) {

                        if ($key == $_SESSION['list']) {
                            ?>
                            <option value="<?= $key ?>" selected=""><?= $key ?></option>
                        <?
                        } else {
                            ?>

                            <option value="<?= $key ?>"><?= $key ?></option>
                        <?
                        }

                    }

                } else {
                    ?>
                    <option value="16">16</option>
                    <option value="32">32</option>
                    <option value="64">64</option>
                <?
                }
                ?>

            </select></div>


        <!--Вывод кнопки Показать еще-->
        <?= $arResult['NAV_STRING_LAZY'] ?>

        <!--Вывод пагинации-->
        <?= $arResult['NAV_STRING_CATALOG'] ?>

    </div>


    </div>


    </div>
    </section>


    <section class="about-us">
        <?= $arResult['DESCRIPTION'] ?>
    </section>


<?
if ($showLazyLoad) {
    ?>
    <div class="row bx-<?= $arParams['TEMPLATE_THEME'] ?>">
        <div class="btn btn-default btn-lg center-block" style="margin: 15px;"
             data-use="show-more-<?= $navParams['NavNum'] ?>">
            <?= $arParams['MESS_BTN_LAZY_LOAD'] ?>
        </div>
    </div>
    <?
}


$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign($templateName, 'catalog.section');
$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>
    <script>
        BX.message({
            BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
            BASKET_URL: '<?=$arParams['BASKET_URL']?>',
            ADD_TO_BASKET_OK: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
            TITLE_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR')?>',
            TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS')?>',
            TITLE_SUCCESSFUL: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
            BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR')?>',
            BTN_MESSAGE_SEND_PROPS: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS')?>',
            BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE')?>',
            BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
            COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK')?>',
            COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
            COMPARE_TITLE: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE')?>',
            PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX')?>',
            RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
            RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
            BTN_MESSAGE_LAZY_LOAD: '<?=CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD'])?>',
            BTN_MESSAGE_LAZY_LOAD_WAITER: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER')?>',
            SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
        });
        var <?=$obName?> =
        new JCCatalogSectionComponent({
            siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
            componentPath: '<?=CUtil::JSEscape($componentPath)?>',
            navParams: <?=CUtil::PhpToJSObject($navParams)?>,
            deferredLoad: false, // enable it for deferred load
            initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
            bigData: <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
            lazyLoad: !!'<?=$showLazyLoad?>',
            loadOnScroll: !!'<?=($arParams['LOAD_ON_SCROLL'] === 'Y')?>',
            template: '<?=CUtil::JSEscape($signedTemplate)?>',
            ajaxId: '<?=CUtil::JSEscape($arParams['AJAX_ID'])?>',
            parameters: '<?=CUtil::JSEscape($signedParams)?>',
            container: '<?=$containerName?>'
        });
    </script>
    <!-- component-end -->


<? $textrazdel = $arResult['DESCRIPTION']; ?>