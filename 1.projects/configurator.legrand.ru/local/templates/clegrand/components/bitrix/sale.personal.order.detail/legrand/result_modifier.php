<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Grid\Declension;
$basket = [];
$productsId = [];
$mexElementsId = [];

// сотритуем товары по комплектам
foreach ($arResult['BASKET'] as &$arItem){
    $productsId[] = $arItem['PRODUCT_ID'];
    $props = [];
    foreach ($arItem['PROPS'] as $arProp){
        switch ($arProp['NAME']){
            case 'KOMP':
                $_value = explode(' comptimelab', $arProp['VALUE']);
                $arProp['~VALUE'] = $arProp['VALUE'];
                $arProp['VALUE'] = $_value[0];
                $arProp['KOMP_ID'] = $_value[1];
                break;
            case 'MEX':
                $_value = json_decode($arProp['VALUE'],  JSON_OBJECT_AS_ARRAY);
                $arProp['~VALUE'] = $arProp['VALUE'];
                $arProp['VALUE'] = $_value;
                $mexElementsId = array_merge($mexElementsId, array_keys($_value));
                break;
        }

        $props[$arProp['NAME']] = $arProp;
    }
    $arItem['PROPS'] = $props;
    $arItem['PRICE_FORMATED'] = number_format($arItem['PRICE'], 2, '.', ' ');
    $arItem['SUM_FORMATED'] = number_format($arItem['PRICE'] * $arItem['QUANTITY'], 2, '.', ' ');

    $kompId = $props['KOMP']['KOMP_ID'];
    if(!isset($basket[$kompId])){
        $basket[$kompId] = [
            'NAME' => $props['KOMP']['VALUE'],
            'PRICE' => 0,
            'ITEMS' => [],
            'WALLS' => $arItem['PROPS']['WALLS']['VALUE'],
            'ROOM' => $arItem['PROPS']['ROOM']['VALUE']
        ];
    }

    $basket[$kompId]['ITEMS'][] = $arItem;
    $basket[$kompId]['SUM'] += $arItem['PRICE'] * $arItem['QUANTITY'];
}

// получаем доп данные для товаров
$products = [];
$mexXmlId = [];
$ibCatalogId = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
$arSelect = ['ID', 'NAME', 'IBLOCK_SECTION_ID',
    'PROPERTY_FRAME_IMG_VERTICAL',
    'PROPERTY_FRAME_IMG_HORIZONTAL',
    'PROPERTY_FUNCTION_IMG',
    'PROPERTY_FUNCTION_COLOR',
    'PROPERTY_FRAME_COLOR',
    'PROPERTY_FRAME_MATERIAL',
    'PROPERTY_FRAME_COUNT_FUNCTION',
    'PROPERTY_COLLECTION_SEARCH',
    'PROPERTY_PACKAGE_ARTICUL',
    ];
$ob = \CIBlockElement::GetList([], ['IBLOCK_ID' => $ibCatalogId, 'ID' => $productsId], false, false, $arSelect);
while($res = $ob->GetNext()){
    $pics = [];
    if($res['PROPERTY_FRAME_IMG_VERTICAL_VALUE'] > 0){
        $pics['FRAME_VERTICAL'] = $res['PROPERTY_FRAME_IMG_VERTICAL_VALUE'];
    }
    if($res['PROPERTY_FRAME_IMG_HORIZONTAL_VALUE'] > 0){
        $pics['FRAME_HORIZONTAL'] = $res['PROPERTY_FRAME_IMG_HORIZONTAL_VALUE'];
    }
    if($res['PROPERTY_FUNCTION_IMG_VALUE'] > 0){
        $pics['FUNCTION'] = $res['PROPERTY_FUNCTION_IMG_VALUE'];
    }

    // Доп поля товаров
    if(!isset($products[$res['ID']])){
        $products[$res['ID']] = [
            'COLOR' => $res['PROPERTY_FUNCTION_COLOR_VALUE'] ?: $res['PROPERTY_FRAME_COLOR_VALUE'] ?: null,
            'MATERIAL' => $res['PROPERTY_FRAME_MATERIAL_VALUE'] ?: null,
            'COUNT_FUNCTION' => $res['PROPERTY_FRAME_COUNT_FUNCTION_VALUE'] ?: null,
            'COLLECTION' => $res['PROPERTY_COLLECTION_SEARCH_VALUE'] ? [$res['PROPERTY_COLLECTION_SEARCH_VALUE']] : [],
            'PICTURE' => $pics,
            'SECTION' => $res['IBLOCK_SECTION_ID'],
        ];
    }else{
        if($res['PROPERTY_COLLECTION_SEARCH_VALUE'] && !in_array($res['PROPERTY_COLLECTION_SEARCH_VALUE'], $products[$res['ID']]['COLLECTION'])){
            $products[$res['ID']]['COLLECTION'][] = $res['PROPERTY_COLLECTION_SEARCH_VALUE'];
        }
        if($res['PROPERTY_PACKAGE_ARTICUL_VALUE'] && !in_array($res['PROPERTY_PACKAGE_ARTICUL_VALUE'], $products[$res['ID']]['MEX'])){
            $products[$res['ID']]['MEX'][] = $res['PROPERTY_PACKAGE_ARTICUL_VALUE'];
        }
    }
}

// ИБ разделы товара
$sections = [];
$rsSect = \CIBlockSection::GetList([],['IBLOCK_ID' => $ibCatalogId], false, ['ID', 'NAME', 'CODE']);
while ($arSect = $rsSect->GetNext())
{
    $sections[$arSect['ID']] = $arSect;
}


// механизмы, связанные с функцией
$mexElementsId = array_unique($mexElementsId);
$arMexs = [];
$arSelect = Array("NAME", 'ID');
$ob = \CIBlockElement::GetList([], ['IBLOCK_ID' => $ibCatalogId, 'ID' => $mexElementsId], false, false, $arSelect);
while($res = $ob->GetNext()) {
    $arMexs[$res['ID']] = $res;
}

// собираем все данные
foreach ($basket as &$comp){
    $countFunc = '';
    foreach ($comp['ITEMS'] as &$item){
        $product = $products[$item['PRODUCT_ID']];
        $section = $sections[$product['SECTION']]['CODE'];

        $name = ($section === 'FRAME') ? 'Рамка' : $item['NAME'];
        $item['NAME_FORMATED'] = $name;

        if(!empty($product['COLLECTION'])){
            $product['COLLECTION'] = implode(', ', $product['COLLECTION']);
        }

        if($section === 'FRAME' && $product['COLLECTION']){
            $name .= ' ['.$product['COLLECTION'].']';
        }
        if($product['COLOR']){
            $name .= ', цвет '.$product['COLOR'];
        }
        if($product['COUNT_FUNCTION']){
            $countFunc = $product['COUNT_FUNCTION'].' '.(new Declension('пост','поста','постов'))->get( $product['COUNT_FUNCTION'] );
            $name .= ', ' . $countFunc;
        }
        $item['NAME_FULL'] = $name;

        if($item['PROPS']['MEX']){
            foreach ($item['PROPS']['MEX']['VALUE'] as $id => &$mex){
                $mex['PRICE_FORMATED'] = number_format($mex['PRICE'], 2, '.', ' ');
                $mex['NAME'] = $arMexs[$id]['NAME'];
            }
        }

        // ресайз картинки
        if($section === 'FRAME' && $item['PROPS']['ORIENTATION']['VALUE'] === 'vertical'){
            $imgType = 'FRAME_VERTICAL';
        }elseif($section === 'FRAME' && $item['PROPS']['ORIENTATION']['VALUE'] === 'horizontal'){
            $imgType = 'FRAME_HORIZONTAL';
        }elseif($section === 'FUNCTION'){
            $imgType = 'FUNCTION';
        }

        if(isset($product['PICTURE'][$imgType])){
            $product['PICTURE'] = \CFile::ResizeImageGet($product['PICTURE'][$imgType], array('width'=>168, 'height'=>168), BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true)['src'];
        }

        $item['IB_PROPS'] = $product;
    }
    $comp['NAME'] = 'Комплект '.$comp['NAME']. ' '. $countFunc;
    $comp['SUM_FORMATED'] = number_format($comp['SUM'], 2, '.', ' ');
}

$arResult['BASKET'] = $basket;

// свойства заказа в удобном виде
$orderProps = [];
foreach ($arResult['ORDER_PROPS'] as $arItem){
    $orderProps[$arItem['CODE']] = $arItem['VALUE'];
}
$arResult['ORDER_PROPS'] = $orderProps;

