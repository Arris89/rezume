<?
namespace FourPx;

use Bitrix\Main\Loader;
use Bitrix\Sale;
use Bitrix\Main\Grid\Declension;


class CEvent
{
    public function BeforeIndexHandler($arFields)
    {

        if ($arFields["MODULE_ID"] == "iblock"
            && $arFields["PARAM2"] == 25
            && substr($arFields["ITEM_ID"], 0, 1) != "S"
        ) {
            if (Loader::includeModule('iblock')) {
                /*
                 * Индексация разделов
                 * для возможности фильтрации поиска
                 * по конкретному разделу
                 */
                $arFields["PARAMS"]["iblock_section"] = array();
                $rsSections = \CIBlockElement::GetElementGroups($arFields["ITEM_ID"], true);

                while ($arSection = $rsSections->Fetch()) {
                    //Сохранение в поисковый индекс
                    $arFields["PARAMS"]["iblock_section"][] = $arSection["ID"];
                }
            }
        }

        return $arFields;
    }



    /**
     * Обновление ФИО покупателя при оформлении заказа
     */
    function OnSaleOrderSavedUserUpdate($event)
    {
        $isNew = $event->getParameter("IS_NEW");

        if($isNew){

            $order = $event->getParameter("ENTITY");
            $fields = $order->getPropertyCollection()->getArray();
            $userId = $order->getUserId();

            $rsUser = \CUser::GetByID($userId);
            $arUser = $rsUser->Fetch();

            $updFields = [];
            foreach ($fields['properties'] as $prop){
                switch ($prop['CODE']){
                    case 'FIRST_NAME':
                        $updFields['NAME'] = $prop['VALUE'][0];
                        break;
                    case 'LAST_NAME':
                        $updFields['LAST_NAME'] = $prop['VALUE'][0];
                        break;
                    case 'EMAIL':
                        if(strpos($arUser['LOGIN'], '@') === false){
                            $updFields['LOGIN'] = $prop['VALUE'][0];
                        }
                        break;
                    case 'PHONE':
                        $updFields['PERSONAL_PHONE'] = $prop['VALUE'][0];
                        break;
                }
            }

            $user = new \CUser;
            $user->Update($userId, $updFields);
        }
    }


    /**
     * Изменение полей в письме "О новом заказе"
     *
     */
    function OnOrderNewSendEmailCustomize($orderId, $eventName, &$arFields)
    {
        if (Loader::includeModule('sale') && Loader::includeModule('iblock')) {
            $order = Sale\Order::load($orderId);
            $basketItems = $order->getBasket()->getBasketItems();
            $basket = [];
            $productsId = [];

            // сотритуем товары по комплектам
            foreach ($basketItems as $item) {
                $productsId[] = $item->getProductId();
                $basketPropertyCollection = $item->getPropertyCollection()->getPropertyValues();

                $props = [];
                foreach ($basketPropertyCollection as $arProp) {
                    switch ($arProp['NAME']) {
                        case 'KOMP':
                            $_value = explode(' comptimelab', $arProp['VALUE']);
                            $arProp['~VALUE'] = $arProp['VALUE'];
                            $arProp['VALUE'] = $_value[0];
                            $arProp['KOMP_ID'] = $_value[1];
                            break;
                    }

                    $props[$arProp['NAME']] = $arProp;
                }
                $arItem = [
                    'PRODUCT_ID' => $item->getProductId(),
                    'QUANTITY' => $item->getQuantity(),
                    'PRICE' => $item->getPrice(),
                    'SUM' => $item->getFinalPrice(),
                    'NAME' => $item->getField('NAME'),
                    'PROPS' => $props,
                    'PRICE_FORMATED' => number_format($item->getPrice(), 2, '.', ' '),
                    'SUM_FORMATED' => number_format($item->getFinalPrice(), 2, '.', ' '),
                ];

                $kompId = $props['KOMP']['KOMP_ID'];
                if (!isset($basket[$kompId])) {
                    $basket[$kompId] = [
                        'NAME' => $props['KOMP']['VALUE'],
                        'SUM' => 0,
                        'ITEMS' => [],
                    ];
                }

                $basket[$kompId]['ITEMS'][] = $arItem;
                $basket[$kompId]['SUM'] += $arItem['SUM'];
            }

            // получаем доп данные для товаров
            $products = [];
            $ibCatalogId = \FourPx\Helper::getIblockIdByCodes('CATALOG')["CATALOG"];
            $arSelect = ['ID', 'NAME', 'IBLOCK_SECTION_ID',
                'PROPERTY_FUNCTION_COLOR',
                'PROPERTY_FRAME_COLOR',
                'PROPERTY_FRAME_MATERIAL',
                'PROPERTY_FRAME_COUNT_FUNCTION',
                'PROPERTY_COLLECTION_SEARCH',
                'PROPERTY_PACKAGE_ARTICUL',
            ];
            $ob = \CIBlockElement::GetList([], ['IBLOCK_ID' => $ibCatalogId, 'ID' => $productsId], false, false, $arSelect);
            while ($res = $ob->GetNext()) {

                // Доп поля товаров
                if (!isset($products[$res['ID']])) {
                    $products[$res['ID']] = [
                        'COLOR' => $res['PROPERTY_FUNCTION_COLOR_VALUE'] ?: $res['PROPERTY_FRAME_COLOR_VALUE'] ?: null,
                        'MATERIAL' => $res['PROPERTY_FRAME_MATERIAL_VALUE'] ?: null,
                        'COUNT_FUNCTION' => $res['PROPERTY_FRAME_COUNT_FUNCTION_VALUE'] ?: null,
                        'COLLECTION' => $res['PROPERTY_COLLECTION_SEARCH_VALUE'] ? [$res['PROPERTY_COLLECTION_SEARCH_VALUE']] : [],
                        'SECTION' => $res['IBLOCK_SECTION_ID'],
                    ];
                } else {
                    if ($res['PROPERTY_COLLECTION_SEARCH_VALUE'] && !in_array($res['PROPERTY_COLLECTION_SEARCH_VALUE'], $products[$res['ID']]['COLLECTION'])) {
                        $products[$res['ID']]['COLLECTION'][] = $res['PROPERTY_COLLECTION_SEARCH_VALUE'];
                    }
                }
            }

            // ИБ разделы товара
            $sections = [];
            $rsSect = \CIBlockSection::GetList([], ['IBLOCK_ID' => $ibCatalogId], false, ['ID', 'NAME', 'CODE']);
            while ($arSect = $rsSect->GetNext()) {
                $sections[$arSect['ID']] = $arSect;
            }

            // собираем все данные
            foreach ($basket as &$comp) {
                $countFunc = '';
                foreach ($comp['ITEMS'] as &$item) {
                    $product = $products[$item['PRODUCT_ID']];
                    $section = $sections[$product['SECTION']]['CODE'];

                    $name = ($section === 'FRAME') ? 'Рамка' : $item['NAME'];
                    $item['NAME_FORMATED'] = $name;

                    if (!empty($product['COLLECTION'])) {
                        $product['COLLECTION'] = implode(', ', $product['COLLECTION']);
                    }

                    if ($section === 'FRAME' && $product['COLLECTION']) {
                        $name .= ' [' . $product['COLLECTION'] . ']';
                    }
                    if ($product['COLOR']) {
                        $name .= ', цвет ' . $product['COLOR'];
                    }
                    if ($product['COUNT_FUNCTION']) {
                        $countFunc = $product['COUNT_FUNCTION'] . ' ' . (new Declension('пост', 'поста', 'постов'))->get($product['COUNT_FUNCTION']);
                        $name .= ', ' . $countFunc;
                    }
                    $item['NAME_FULL'] = $name;
                }
                $comp['NAME'] = 'Комплект ' . $comp['NAME'] . ' ' . $countFunc;
                $comp['SUM_FORMATED'] = number_format($comp['SUM'], 2, '.', ' ');
            }
            // список товаров для письма
            $strBasketTable = '    
            <table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#eaf3f5"><thead>
            <tr bgcolor="#bad3df">
                <th style="text-align: left;">Состав комплектующих</th>
                <th>Количество</th>
                <th>Cтоимость</th>
            </tr>
            </thead><tbody>';
            foreach ($basket as $arComp) {
                $strBasketTable .= '
                <tr><td colspan="5" style="text-align: left;" bgcolor="#eaf3f5">
                    <strong>'.$arComp['NAME'].'</strong>
                </td></tr>';
                foreach ($arComp['ITEMS'] as $arItem) {
                    $strBasketTable .= '
                    <tr>
                        <td style="text-align: left;">'.$arItem['PROPS']['ARTICUL']['VALUE'].'<br>'. $arItem['NAME_FULL'] .'</td>
                        <td style="text-align: center">'.$arItem['QUANTITY'].'</td>
                        <td style="text-align: right">'.$arItem['SUM_FORMATED'].' руб</td>
                    </tr>';
                }
                $strBasketTable .= '    
                <tr><td colspan="5" style="text-align: right;">
                    <b>Сумма за комплект: '.$arComp['SUM_FORMATED'].' руб</b>
                </td></tr>';
            }
            $strBasketTable .= '</tbody></table>';

            // свойства заказа
            $orderProps = [];
            foreach ($order->getPropertyCollection()->getArray()['properties'] as $prop){
                $orderProps[$prop['CODE']] = $prop['VALUE'][0];
            }

            // email магазина
            $shopEmail = '';
            $ob = \CIBlockElement::GetList([], ['ID' => $orderProps['SHOP_ID']], false, false, ['PROPERTY_EMAIL']);
            if ($res = $ob->GetNext()) {
                $shopEmail = $res['PROPERTY_EMAIL_VALUE'];
            }

            $arFields = array_merge($arFields,
                [
                    'ORDER_LIST' => $strBasketTable,
                    'ORDER_DESCRIPTION' => $order->getField('USER_DESCRIPTION') ? 'Комментарий к заказу: '.$order->getField('USER_DESCRIPTION') : '',
                    'ORDER_SHOP' => $orderProps['SHOP'],
                    'ORDER_USER_NAME' => $orderProps['FIRST_NAME'].' '.$orderProps['LAST_NAME'],
                    'SHOP_EMAIL' => $shopEmail,
                ]
            );
        }
    }

    /**
     * редирект в ЛК после авторизации
     */
    function OnAfterUserAuthHandler($arUser)
    {
        global $APPLICATION;
      if($APPLICATION->GetCurPage(false) !== '/local/templates/clegrand/components/bitrix/sale.order.ajax/configurator/ajax_auth.php'){
            LocalRedirect('/personal/order/');
        };
    }
}