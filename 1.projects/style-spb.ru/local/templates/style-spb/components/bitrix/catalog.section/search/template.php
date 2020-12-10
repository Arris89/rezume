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

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-' . $arParams['TEMPLATE_THEME'] : '';

?>


<div class="page-heading product-listing">
    <h1 style="float: left"><?= $arResult['NAME'] ?>&nbsp;</h1>
    <?
   $numItems = $arResult['NAV_RESULT']->NavRecordCount;
    ?>
    <span class="heading-counter" style="margin-top: 30px;">Найдено: <?=$numItems?>.</span>
</div>


<div class="subcategories">
</div>


<div class="content_sortPagiBar clearfix">
    <div class="sortPagiBar clearfix">
        <ul class="display hidden-xs">
            <li class="display-title">Вид:</li>
            <li id="grid" class="selected"><a rel="nofollow" href="#" title="Сетка">
                    <i class="icon-th-large"></i>Сетка</a></li>
            <li id="list"><a rel="nofollow" href="#" title="Список">
                    <i class="icon-th-list"></i>Список</a>
            </li>
        </ul>

<?

    $sortList = [
                    ['NAME' => 'По названию товара, от А до Я', 'VALUE' => 'nameasc', 'CODE'=>'NAMEasc'],
                    ['NAME' => 'По названию товара, от Я до А', 'VALUE' => 'namedesc', 'CODE'=>'NAMEdesc'],
                    ['NAME' => 'Артикул, по возрастанию', 'VALUE' => 'artasc', 'CODE'=>'ARTNUMBERasc'],
                    ['NAME' => 'Артикул, по убыванию', 'VALUE' => 'artdesc', 'CODE'=>'ARTNUMBERdesc']
                ];
?>
                                 
        <?
 if (isset($_SESSION['sortcat'])) {


foreach ($sortList as $key1 => $value1) {
    if ($value1['CODE']== $_SESSION['sortcat'].$_SESSION['ordercat']) {
      $poll = $value1['NAME'];
    }
}
    ?>
       <form id="productsSortForm" action="https://style-spb.ru/12-coats" class="productsSortForm">
            <div class="select selector1">
                <label for="selectProductSort">Сортировка по</label>
                <div class="selector" id="uniform-selectProductSort" style="width: 190px;">
                    <span style="width: 180px; user-select: none;"><?=$poll?></span>
        <select id="selectProductSort" class="selectProductSort form-control" name="sortcat">
<?foreach ($sortList as $key => $value) {
   if ($value['CODE']== $_SESSION['sortcat'].$_SESSION['ordercat']) {?>
        <option value="<?=$value['VALUE']?>" selected="selected"><?=$value['NAME']?></option>
   <?}
   else
   {?>
        <option value="<?=$value['VALUE']?>"><?=$value['NAME']?></option>
   <?}?>
        
<?}?></select>
              </div>
            </div>
        </form>
<?}
else
{?>
      <form id="productsSortForm" action="https://style-spb.ru/12-coats" class="productsSortForm">
            <div class="select selector1">
                <label for="selectProductSort">Сортировка по</label>
                <div class="selector" id="uniform-selectProductSort" style="width: 190px;">
                    <span style="width: 180px; user-select: none;">--</span>
                    <select id="selectProductSort" class="selectProductSort form-control" name="sortcat">
                        <option value="date_add:desc" selected="selected">--</option>
                        <option value="nameasc">По названию товара, от А до Я</option>
                        <option value="namedesc">По названию товара, от Я до А</option>
                        <option value="artasc">Артикул, по возрастанию</option>
                        <option value="artdesc">Артикул, по убыванию</option>
                    </select>
                    </div>
            </div>
        </form>

<?}?>


        <?
$variable = [1,2,3];
        ?>
        <form action="" method="get" class="nbrItemPage">
            <div class="clearfix selector1">
        </form>
    </div>
</div>

    <div class="top-pagination-content clearfix">
        <form method="post" action="https://style-spb.ru/products-comparison" class="compare-form">

            <input type="hidden" name="compare_product_count" class="compare_product_count"
                   value="0">
            <input type="hidden" name="compare_product_list" class="compare_product_list" value="">
        </form>


        <!-- Pagination -->
        <div id="pagination" class="pagination clearfix">
            <form class="showall" action="https://style-spb.ru/12-coats" method="get">
                <div>
                    <button type="submit" class="btn btn-default button exclusive-medium">
                        <span>Показать все</span>
                    </button>
                    <input type="hidden" name="id_category" value="12">
                    <input name="n" id="nb_item" class="hidden" value="58">
                </div>
            </form>


    <?

    if ($showTopPager) {
        ?>
                <!-- pagination-container -->
                <?= $arResult['NAV_STRING'] ?>
                <!-- pagination-container -->
        <?
    }?>
 
    </div>
</div>


<ul class="product_list grid row">

    <!-- items-container -->
    <?
    if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])) {
        $areaIds = array();

        foreach ($arResult['ITEMS'] as $item) {
            $uniqueId = $item['ID'] . '_' . md5($this->randString() . $component->getAction());
            $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
            $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
            $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
        }

        foreach ($arResult['ITEM_ROWS'] as $rowData) {
            $rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);
            ?>
            <!-- <div class="row <?= $rowData['CLASS'] ?>" data-entity="items-row"> -->
            <?
            switch ($rowData['VARIANT']) {
                case 0:
                    ?>
                    <div class="col product-item-big-card">
                        <?
                        $item = reset($rowItems);
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.item',
                            'bootstrap_v4',
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
                    break;

                case 1:
                    foreach ($rowItems as $item) {
                        ?>
                        <div class="col-6 product-item-big-card">
                            <?
                            $APPLICATION->IncludeComponent(
                                'bitrix:catalog.item',
                                'bootstrap_v4',
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
                    break;

                case 2:
                    foreach ($rowItems as $item) {
                        ?>
                        <li class="ajax_block_product col-xs-12 col-sm-6 col-md-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line"
                            style="height: auto; margin-bottom: 0px;">
                            <div class="product-container" itemscope="" itemtype="https://schema.org/Product">
                                <?
                                $APPLICATION->IncludeComponent(
                                    'bitrix:catalog.item',
                                    'style',
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
                        </li>
                        <?
                    }
                    break;

                case 3:
                    foreach ($rowItems as $item) {
                        ?>
                        <div class="col-6 col-md-3 product-item-small-card">
                            <?
                            $APPLICATION->IncludeComponent(
                                'bitrix:catalog.item',
                                'bootstrap_v4',
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
                    break;

                case 4:
                    $rowItemsCount = count($rowItems);
                    ?>
                    <div class="col-sm-6 product-item-big-card">
                        <?
                        $item = array_shift($rowItems);
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.item',
                            'bootstrap_v4',
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
                    <div class="col-sm-6 product-item-small-card">
                        <div class="row">
                            <?
                            for ($i = 0; $i < $rowItemsCount - 1; $i++) {
                                ?>
                                <div class="col-6">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:catalog.item',
                                        'bootstrap_v4',
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
                    <div class="col-sm-6 col-12 product-item-small-card">
                        <div class="row">
                            <?
                            for ($i = 0; $i < $rowItemsCount - 1; $i++) {
                                ?>
                                <div class="col-6">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:catalog.item',
                                        'bootstrap_v4',
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
                        <?
                        $item = end($rowItems);
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.item',
                            'bootstrap_v4',
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
                    <?
                    break;

                case 6:
                    foreach ($rowItems as $item) {
                        ?>
                        <div class="col-6 col-sm-4 col-md-4 col-lg-2 product-item-small-card">
                            <?
                            $APPLICATION->IncludeComponent(
                                'bitrix:catalog.item',
                                'bootstrap_v4',
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

                    break;

                case 7:
                    $rowItemsCount = count($rowItems);
                    ?>
                    <div class="col-sm-6 col-12 product-item-big-card">
                        <?
                        $item = array_shift($rowItems);
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.item',
                            'bootstrap_v4',
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
                    <div class="col-sm-6 col-12 product-item-small-card">
                        <div class="row">
                            <?
                            for ($i = 0; $i < $rowItemsCount - 1; $i++) {
                                ?>
                                <div class="col-6 col-md-4">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:catalog.item',
                                        'bootstrap_v4',
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
                    <div class="col-sm-6 col-12 product-item-small-card">
                        <div class="row">
                            <?
                            for ($i = 0; $i < $rowItemsCount - 1; $i++) {
                                ?>
                                <div class="col-6 col-md-4">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:catalog.item',
                                        'bootstrap_v4',
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
                    <div class="col-sm-6 col-12 product-item-big-card">
                        <?
                        $item = end($rowItems);
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.item',
                            'bootstrap_v4',
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
                    <?
                    break;

                case 9:
                    foreach ($rowItems as $item) {
                        ?>
                        <div class="col product-item-line-card">
                            <? $APPLICATION->IncludeComponent('bitrix:catalog.item', 'bootstrap_v4', array(
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

                    break;
            }
            ?>
            <!-- 	</div> -->
            <?
        }
        unset($generalParams, $rowItems);

    } else {
        // load css for bigData/deferred load
        $APPLICATION->IncludeComponent(
            'bitrix:catalog.item',
            'bootstrap_v4',
            array(),
            $component,
            array('HIDE_ICONS' => 'Y')
        );
    }
    ?>


    <?

    //region LazyLoad Button
    if ($showLazyLoad) {
        ?>
        <div class="text-center mb-4" data-entity="lazy-<?= $containerName ?>">
            <button type="button"
                    class="btn btn-primary btn-md"
                    style="margin: 15px;"
                    data-use="show-more-<?= $navParams['NavNum'] ?>">
                <?= $arParams['MESS_BTN_LAZY_LOAD'] ?>
            </button>
        </div>
        <?
    }
    //endregion

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



</ul> <? //end wrapper?>
<!-- component-end -->
<div class="content_sortPagiBar">
    <div class="bottom-pagination-content clearfix">
        <form method="post" action="https://style-spb.ru/products-comparison" class="compare-form">
            <input type="hidden" name="compare_product_count" class="compare_product_count" value="0">
            <input type="hidden" name="compare_product_list" class="compare_product_list" value="">
        </form>


        <!-- Pagination -->
        <div id="pagination_bottom" class="pagination clearfix">
            <form class="showall" action="https://style-spb.ru/12-coats" method="get">
                <div>
                    <button type="submit" class="btn btn-default button exclusive-medium">
                        <span>Показать все</span>
                    </button>
                    <input type="hidden" name="id_category" value="12">
                    <input name="n" id="nb_item" class="hidden" value="58">
                </div>
            </form>




        <!-- /Pagination -->

<?
    //region Pagination
    if ($showBottomPager) {
        ?>
        


                <!-- pagination-container -->
                <?=$arResult['NAV_STRING'] ?>
                <!-- pagination-container -->
       
        <?
    }
    //endregion?>

        </div>
    </div>
</div>

<div class="cat_desc">
    <div class="rte">
       <?=$arResult['DESCRIPTION'];?>
    </div>
</div>


<script>
    function accordionFooter(status)
{
    if(status == 'enable')
    {
        $('#footer .footer-block h4').on('click', function(e){
            $(this).toggleClass('active').parent().find('.toggle-footer').stop().slideToggle('medium');
            e.preventDefault();
        })
        $('#footer').addClass('accordion').find('.toggle-footer').slideUp('fast');
    }
    else
    {
        $('.footer-block h4').removeClass('active').off().parent().find('.toggle-footer').removeAttr('style').slideDown('fast');
        $('#footer').removeClass('accordion');
    }
}

function accordion(status)
{
    if(status == 'enable')
    {
        var accordion_selector = '#right_column .block .title_block, #left_column .block .title_block, #left_column #newsletter_block_left h4,' +
                                '#left_column .shopping_cart > a:first-child, #right_column .shopping_cart > a:first-child';

        $(accordion_selector).on('click', function(e){
            $(this).toggleClass('active').parent().find('.block_content').stop().slideToggle('medium');
        });
        $('#right_column, #left_column').addClass('accordion').find('.block .block_content').slideUp('fast');
        if (typeof(ajaxCart) !== 'undefined')
            ajaxCart.collapse();
    }
    else
    {
        $('#right_column .block .title_block, #left_column .block .title_block, #left_column #newsletter_block_left h4').removeClass('active').off().parent().find('.block_content').removeAttr('style').slideDown('fast');
        $('#left_column, #right_column').removeClass('accordion');
    }
}
function blockHover(status)
{
    var screenLg = $('body').find('.container').width() == 1170;

    if ($('.product_list').is('.grid'))
        if (screenLg)
            $('.product_list .button-container').hide();
        else
            $('.product_list .button-container').show();

    $(document).off('mouseenter').on('mouseenter', '.product_list.grid li.ajax_block_product .product-container', function(e){
        if (screenLg)
        {
            var pcHeight = $(this).parent().outerHeight();
            var pcPHeight = $(this).parent().find('.button-container').outerHeight() + $(this).parent().find('.comments_note').outerHeight() + $(this).parent().find('.functional-buttons').outerHeight();
            $(this).parent().addClass('hovered').css({'height':pcHeight + pcPHeight, 'margin-bottom':pcPHeight * (-1)});
            $(this).find('.button-container').show();
            
            var $this = $(this).find('img.rollover-images');
            var newSource = $this.data('rollover');
            if(newSource!=0){
            $this.data('rollover', $this.attr('src'));
            $this.attr('src', newSource);
            }
        }
    });

    $(document).off('mouseleave').on('mouseleave', '.product_list.grid li.ajax_block_product .product-container', function(e){
        if (screenLg)
        {
            $(this).parent().removeClass('hovered').css({'height':'auto', 'margin-bottom':'0'});
            $(this).find('.button-container').hide();
        
            var $this = $(this).find('img.rollover-images');
            var newSource = $this.data('rollover');
            if(newSource!=0){
            $this.data('rollover', $this.attr('src'));
            $this.attr('src', newSource);
            }
        }
    });
}
function scrollCompensate()
{
    var inner = document.createElement('p');
    inner.style.width = "100%";
    inner.style.height = "200px";

    var outer = document.createElement('div');
    outer.style.position = "absolute";
    outer.style.top = "0px";
    outer.style.left = "0px";
    outer.style.visibility = "hidden";
    outer.style.width = "200px";
    outer.style.height = "150px";
    outer.style.overflow = "hidden";
    outer.appendChild(inner);

    document.body.appendChild(outer);
    var w1 = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var w2 = inner.offsetWidth;
    if (w1 == w2) w2 = outer.clientWidth;

    document.body.removeChild(outer);

    return (w1 - w2);
}
function responsiveResize()
{
    compensante = scrollCompensate();
    if (($(window).width()+scrollCompensate()) <= 767 && responsiveflag == false)
    {
        accordion('enable');
        accordionFooter('enable');
        responsiveflag = true;
    }
    else if (($(window).width()+scrollCompensate()) >= 768)
    {
        accordion('disable');
        accordionFooter('disable');
        responsiveflag = false;
        if (typeof bindUniform !=='undefined')
            bindUniform();
    }
    blockHover();
}

    responsiveResize();
    $(window).resize(responsiveResize);
    if (navigator.userAgent.match(/Android/i))
    {
        var viewport = document.querySelector('meta[name="viewport"]');
        viewport.setAttribute('content', 'initial-scale=1.0,maximum-scale=1.0,user-scalable=0,width=device-width,height=device-height');
        window.scrollTo(0, 1);
    }
    if (typeof quickView !== 'undefined' && quickView)
        quick_view();
    dropDown();

    if (typeof page_name != 'undefined' && !in_array(page_name, ['index', 'product']))
    {
        bindGrid();

        $(document).on('change', '.selectProductSort', function(e){
            if (typeof request != 'undefined' && request)
                var requestSortProducts = request;
            var splitData = $(this).val().split(':');
            var url = '';
            if (typeof requestSortProducts != 'undefined' && requestSortProducts)
            {
                url += requestSortProducts ;
                if (typeof splitData[0] !== 'undefined' && splitData[0])
                {
                    url += ( requestSortProducts.indexOf('?') < 0 ? '?' : '&') + 'orderby=' + splitData[0] + (splitData[1] ? '&orderway=' + splitData[1] : '');
                    if (typeof splitData[1] !== 'undefined' && splitData[1])
                        url += '&orderway=' + splitData[1];
                }
                document.location.href = url;
            }
        });

        $(document).on('change', 'select[name="n"]', function(){
            $(this.form).submit();
        });

        $(document).on('change', 'select[name="currency_payment"]', function(){
            setCurrency($(this).val());
        });
    }
</script>

            <script>
                /* Выбор количества выводимых товаров 16-32-64 */

                $(document).ready(function () {
                    $("select[name=catpo]").change(function () {

                        var list = $(this).val();

                        $.post('/local/templates/style-spb/ajax/list.php', {list}, function (data) {

                        })
                        location.reload();

                    });
                });



                $(document).ready(function () {
                    $("select[name=sortcat]").change(function () {

                        var sort = $(this).val();

if(sort=='nameasc')
{
    var sortcat = 'NAME';
    var ordercat = 'asc';
}

if(sort=='namedesc')
{
    var sortcat = 'NAME';
    var ordercat = 'desc';
}

if(sort=='artasc')
{
    var sortcat = 'ARTNUMBER';
    var ordercat = 'asc';
}

if(sort=='artdesc')
{
    var sortcat = 'ARTNUMBER';
    var ordercat = 'desc';
}

                        $.post('/local/templates/style-spb/ajax/sort.php', {sortcat, ordercat}, function (data) {
                            if(data)
                            {
                               location.reload();  
                            }
                        })
                    });
                });
            </script>