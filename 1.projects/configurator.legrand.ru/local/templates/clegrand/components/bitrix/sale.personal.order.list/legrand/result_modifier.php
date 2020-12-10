<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Loader;
use Bitrix\Sale;

if(!empty($arResult['ORDERS'])){
    $shopsId = [];

    foreach ($arResult['ORDERS'] as &$arOrder){
        $order = \Bitrix\Sale\Order::load($arOrder['ORDER']['ID']);
        $_props = $order->getPropertyCollection()->getArray()['properties'];
        $props = [];
        foreach ($_props as $prop){
            $props[$prop['CODE']] = $prop['VALUE'][0];
        }
        $arOrder['ORDER']['PROPS'] = $props;
        $shopsId[] = $props['SHOP_ID'];
        $arOrder['ORDER']['FORMATED_PRICE'] = number_format($arOrder['ORDER']['PRICE'], 2, '.', ' ');

        // сортировка товаров корзин по комплектам
        $compList = [];
        $basketPropRes = Sale\Internals\BasketPropertyTable::getList(array(
            'filter' => array(
                'BASKET_ID' => array_keys($arOrder['BASKET_ITEMS']),
                'NAME' => 'KOMP'
            ),
        ));
        while ($property = $basketPropRes->fetch()) {
            $_value = explode(' comptimelab', $property['VALUE']);
            $compList[$property['BASKET_ID']] = [
                'NAME' => $_value[0],
                'CODE' => $_value[1],
            ];
        }
        $basketComplects = [];

        foreach ($arOrder['BASKET_ITEMS'] as $basketItem){
            $compCode = $compList[ $basketItem['ID'] ]['CODE'];
            if(!isset($basketComplects[ $compCode ])){
                $basketComplects[ $compCode ] = [
                    'NAME' => 'Комплект '.$compList[ $basketItem['ID'] ]['NAME'],
                    'PRICE' => 0,
//                    '_ITEMS' => []
                ];
            }
            $basketComplects[ $compCode ]['PRICE'] += $basketItem['PRICE'];
//            $basket[ $compCode ]['_ITEMS'][] = $basketItem;
        }

        $arOrder['BASKET_ITEMS'] = $basketComplects;
    }

    Loader::includeModule('iblock');
    $shopsId = array_unique($shopsId);

    $ob = \CIBlockElement::GetList([], ['ID' => $shopsId], false, false, ['ID', 'NAME', 'PROPERTY_PHONE']);
    $shops = [];
    while($res = $ob->GetNext()){
        $shops[ $res['ID'] ] = [
            'NAME' => $res['NAME'],
            'PHONE' => $res['PROPERTY_PHONE_VALUE']
        ];
    }

    $arResult['SHOPS'] = $shops;
}
