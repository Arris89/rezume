<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use Bitrix\Main\Loader;
use \Bitrix\Main\Data\Cache;

$cache = Cache::createInstance();

$cachePath = str_replace([':', '/'], ['_', '_'], $this->getComponent()->getName()) . '-' . $this->getName();

if ($arParams['CACHE_TYPE'] != 'N' && $cache->initCache($arParams['CACHE_TIME'], serialize($arParams), $cachePath)) {
    $arResult = $cache->getVars();
} elseif($cache->startDataCache()) {
    $arMapItems = [];
    $ibRefProps = [];
    $hlRefProps = [];

    $ob = \CIBlockElement::GetList([], ['IBLOCK_ID' => $arParams['IBLOCK_ID']], false, false, ['NAME', 'ID', 'IBLOCK_ID']);
    while ($res = $ob->GetNextElement()) {
        $arFields = $res->GetFields();
        $arItemProps = $res->GetProperties();

        foreach ($arItemProps as $arProp) {
            if ($arProp['VALUE']) {
                $arProps[$arProp['CODE']] = [
                    'VALUE' => $arProp['~VALUE'],
                    'PROPERTY_TYPE' => $arProp['PROPERTY_TYPE'],
                ];
                switch ($arProp['PROPERTY_TYPE']) {
                    case 'E': // привязка к ИБ-элементу
                        if (is_array($arProp['VALUE'])) {
                            $ibRefProps = array_merge($ibRefProps, $arProp['VALUE']);
                        } elseif ($arProp['VALUE'] != '') {
                            array_push($ibRefProps, $arProp['VALUE']);
                        }
                        break;
                    case 'S':
                        // HL справочник
                        if (isset($arProp['USER_TYPE_SETTINGS']['TABLE_NAME'])) {
                            $arProps[$arProp['CODE']]['PROPERTY_TYPE'] = 'HL';
                            $arProps[$arProp['CODE']]['TABLE_NAME'] = $arProp['USER_TYPE_SETTINGS']['TABLE_NAME'];
                            if (!is_array($hlRefProps[$arProp['USER_TYPE_SETTINGS']['TABLE_NAME']])) {
                                $hlRefProps[$arProp['USER_TYPE_SETTINGS']['TABLE_NAME']] = [];
                            }
                            if (is_array($arProp['VALUE'])) {
                                $hlRefProps[$arProp['USER_TYPE_SETTINGS']['TABLE_NAME']] = array_merge($hlRefProps[$arProp['USER_TYPE_SETTINGS']['TABLE_NAME']], $arProp['VALUE']);
                            } else {
                                $hlRefProps[$arProp['USER_TYPE_SETTINGS']['TABLE_NAME']][] = $arProp['VALUE'];
                            }
                        }
                        break;
                }
            } else {
                $arProps[$arProp['CODE']] = null;
            }
        }
        $arMapItems[$arFields['ID']] = [
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'PROPERTIES' => $arProps,
        ];

    }
    unset($arProp, $arProps, $arFields);

// получаем значения свойств-справочников
    $ibRefProps = array_unique($ibRefProps);
    if (!empty($ibRefProps)) {
        $ob = \CIBlockElement::GetList([], ['ID' => $ibRefProps], false, false, ['NAME', 'ID']);
        $ibRefProps = [];
        while ($res = $ob->GetNext()) {
            $ibRefProps[$res['ID']] = $res['NAME'];
        }
    }
// получаем ХЛ-спавочники
    Loader::includeModule('highloadblock');
    $hlRefProps = array_unique($hlRefProps);
    foreach ($hlRefProps as $hlTable => &$hlRefs) {
        $hlRefs = array_unique($hlRefs);
        $hlblockId = HL::getList(
            ['filter' =>
                ['TABLE_NAME' => $hlTable]
            ]
        )->fetch();
        $entity = HL::compileEntity($hlblockId);

        $entity_data_class = $entity->getDataClass();
        $rsData = $entity_data_class::getList(
            [
                "select" => ['UF_XML_ID', 'UF_NAME'],
                "filter" => ['UF_XML_ID' => $hlRefs]
            ]
        );
        $hlRefs = array_flip($hlRefs);

        while ($arData = $rsData->Fetch()) {
            $hlRefs[$arData['UF_XML_ID']] = $arData['UF_NAME'];
        }
    }


// обновляем свойства элементов
    foreach ($arMapItems as &$arItem) {
        foreach ($arItem['PROPERTIES'] as $propCode => &$arProp) {
            if ($arProp) {
                switch ($arProp['PROPERTY_TYPE']) {
                    case 'E': // привязка к ИБ-элементу
                        if (is_array($arProp['VALUE'])) {
                            foreach ($arProp['VALUE'] as $_prop) {
                                $arProp['DISPLAY_VALUE'][] = $ibRefProps[$_prop];
                            }
                        } elseif ($arProp['VALUE'] != '') {
                            $arProp['DISPLAY_VALUE'] = $ibRefProps[$arProp['VALUE']];
                        }
                        break;
                    case 'S':
                        if (isset($arProp['VALUE']['TEXT'])) {
                            $arProp['DISPLAY_VALUE'] = $arProp['VALUE']['TEXT'];
                        } else {
                            $arProp['DISPLAY_VALUE'] = $arProp['VALUE'];
                        }
                        break;
                    case 'HL':
                        if (is_array($arProp['VALUE'])) {
                            foreach ($arProp['VALUE'] as $_prop) {
                                $arProp['DISPLAY_VALUE'][] = $hlRefProps[$arProp['TABLE_NAME']][$_prop];
                            }
                        } elseif ($arProp['VALUE'] != '') {
                            $arProp['DISPLAY_VALUE'] = $hlRefProps[$arProp['TABLE_NAME']][$arProp['VALUE']];
                        }
                        break;
                    default:
                        $arProp['DISPLAY_VALUE'] = $arProp['VALUE'];
                        break;
                }

                switch ($propCode) {
                    case 'PHONE':
                        $phoneFormated = '';
                        if (strpos($arProp['VALUE'], ',') !== false) {
                            $phones = explode(',', $arProp['VALUE']);
                            foreach ($phones as &$_phone) {
                                $_phone = '<a href="tel:' . preg_replace('/[^+0-9]/', '', $_phone) . '">' . trim($_phone) . '</a>';
                            }
                            $phoneFormated = implode(', ', $phones);
                        } else {
                            $phoneFormated .= '<a href="tel:' . preg_replace('/[^+0-9]/', '', $arProp['VALUE']) . '">' . trim($arProp['VALUE']) . '</a>';
                        }
                        $arProp['DISPLAY_VALUE'] = $phoneFormated;
                        break;
                    case 'SITE':
                        $arProp['DISPLAY_VALUE'] = $arProp['VALUE'];
                        if(strpos($arProp['VALUE'], '//') === false){
                            $arProp['VALUE_HREF'] = '//'.$arProp['VALUE'];
                        }
                        else{
                            $arProp['VALUE_HREF'] = $arProp['VALUE'];
                        }
                        break;
                }

                if (is_array($arProp['DISPLAY_VALUE'])) {
                    $arProp['DISPLAY_VALUE'] = implode(', ', $arProp['DISPLAY_VALUE']);
                }
            }
        }
    }
    unset($arProp, $arItem);

// формируем данные для карты
    $jsData = [];
    $_mapSizes = [];
    foreach ($arMapItems as $arItem) {
        if ($arItem['PROPERTIES']['CONFIGURATOR_MAP']) {
            $coords = explode(',', $arItem['PROPERTIES']['CONFIGURATOR_MAP']['DISPLAY_VALUE']);
            $jsData['items'][] = [
                'id' => $arItem['ID'],
                'name' => $arItem['NAME'],
                'coords' => $coords,
                'address' => $arItem['PROPERTIES']['ADRESS']['DISPLAY_VALUE'],
                'phone' => $arItem['PROPERTIES']['PHONE']['DISPLAY_VALUE'],
                'metro' => $arItem['PROPERTIES']['CONFIGURATOR_METRO']['DISPLAY_VALUE'],
                'site' => $arItem['PROPERTIES']['SITE']['DISPLAY_VALUE'],
                'site_href' => $arItem['PROPERTIES']['SITE']['VALUE_HREF'],
                'collections' => $arItem['PROPERTIES']['CONFIGURATOR_COLLECTIONS_REF']['DISPLAY_VALUE'],
                'working' => $arItem['PROPERTIES']['CONFIGURATOR_WH']['DISPLAY_VALUE'],
                'delivery' => $arItem['PROPERTIES']['CONFIGURATOR_DELIVERY']['DISPLAY_VALUE'] === 'Да',
                'pay_card' => $arItem['PROPERTIES']['CONFIGURATOR_PAY_CARD']['DISPLAY_VALUE'] === 'Да',
            ];
        }
    }

    $arResult['JS_DATA'] = $jsData;
    $cache->endDataCache($arResult);
}
