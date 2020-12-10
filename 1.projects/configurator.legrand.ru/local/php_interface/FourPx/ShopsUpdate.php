<?namespace FourPx;

use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock\HighloadBlockTable as HL;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Web\HttpClient;
use \Bitrix\Main\IO;
use \Bitrix\Main\Application;

class ShopsUpdate
{
    const URL = 'https://legrand.ru/local/tools/get_shops.php';
    const TOKEN = 'x_Qi3PaaP0nLgz';
    const TIMESTAMP_PARAM_NAME = 'shopsLastUpdateTime';


    public static function init(){
        $timestamp = Option::get('main', self::TIMESTAMP_PARAM_NAME, 0);

        $updateData = self::getModifiedData($timestamp);
        if(!$updateData){
            return;
        }

        if($updateData['HL']){
            self::updateHlElements($updateData['HL']);
        }

        if($updateData['IBLOCK']){
            self::updateIblocks($updateData['IBLOCK']);
        }

        $path = Application::getDocumentRoot() . "/local/.log/shops_update/".date('Y-m-d__H-i-s').".json";
        $updateData['IBLOCK_CNT'] = count($updateData['IBLOCK']['ELEMENTS']);
        IO\File::putFileContents($path, json_encode($updateData, JSON_UNESCAPED_UNICODE));

        Option::set('main', self::TIMESTAMP_PARAM_NAME, $updateData['TIME']);
    }


    /** Получаем данные с основного сайта
     *
     * @param integer $timestamp - время (с основого сайта) последнего обновления
     * @throws
     * @return array | boolean
     */
    private static function getModifiedData($timestamp){

        $httpClient = new HttpClient();
        $modElementsJson = $httpClient->post(self::URL, ['token'=>self::TOKEN, 'timestamp'=>$timestamp]);

        if($modElementsJson){
            $arModElements = json_decode($modElementsJson, true);
        }

        return is_array($arModElements) ? $arModElements : false;
    }


    /** Обновление HL-блоков
     *
     * @param array $hlBlocks - список HL-блоков с эементами
     * @throws
     */
    private static function updateHlElements($hlBlocks){
        Loader::includeModule('highloadblock');

        foreach($hlBlocks as $hlTable => &$arElements){
            $hlblockId = HL::getList(
                ['filter' =>
                    [ 'TABLE_NAME' => $hlTable ]
                ]
            )->fetch();
            $entity = HL::compileEntity($hlblockId);

            $entity_data_class = $entity->getDataClass();
            $rsData = $entity_data_class::getList(
                [
                    "select" => ['UF_XML_ID', 'ID'],
                    "filter" => ['UF_XML_ID' => array_keys($arElements)]
                ]
            );
            $existElements = [];
            while ($arData = $rsData->Fetch()) {
                $existElements[$arData['ID']] = $arElements[$arData['UF_XML_ID']];
                unset($arElements[$arData['UF_XML_ID']]);
            }

            // создание новых
            foreach ($arElements as $arItem){
                $entity_data_class::add($arItem);
            }

            // update существующих
            foreach ($existElements as $id => $arItem){
                $entity_data_class::update($id, $arItem);
            }
        }
    }

    /** Обновление ИБ
     *
     * @param array $ibData - элементы и разделы ИБ
     * @throws
     */
    private static function updateIblocks($ibData){
        Loader::includeModule('iblock');
        $arElements = $ibData['ELEMENTS'];
        $arSections = $ibData['SECTIONS'];

        $elXmlIds = array_keys($arElements);
        $enumPropsList = [];
        $iblockCodes = [];
        foreach ($arElements as $arItem){
            $iblockCodes[] = $arItem['IBLOCK_CODE'];
            foreach ($arItem['PROPS'] as $code => $prop){
                switch ($prop['PROPERTY_TYPE']) {
                    case 'E': // привязка к ИБ-элементу
                        $elXmlIds[] = $prop['VALUE'];
                        break;
                    case 'L': // свойство-список
                        if(is_array($prop['VALUE'])){
                            foreach ($prop['VALUE'] as $k => $enumValue){
                                if(!isset($enumPropsList[ $arItem['IBLOCK_CODE'] ][ $code ][$enumValue])){
                                    $enumPropsList[ $arItem['IBLOCK_CODE'] ][ $code ][$enumValue] = [
                                        'VALUE' => $enumValue,
                                        'XML_ID' => $prop['VALUE_XML_ID'][$k],
                                        'SORT' => $prop['VALUE_SORT'][$k],
                                    ];
                                }
                            }
                        }else{
                            if(!isset($enumPropsList[ $arItem['IBLOCK_CODE'] ][ $code ][$prop['VALUE']])){
                                $enumPropsList[ $arItem['IBLOCK_CODE'] ][ $code ][$prop['VALUE']] = [
                                    'VALUE' => $prop['VALUE'],
                                    'XML_ID' => $prop['VALUE_XML_ID'],
                                    'SORT' => $prop['VALUE_SORT'],
                                ];
                            }
                        }
                        break;
                }
            }
        }

        // используемые ИБ
        $iblockCodes = array_unique($iblockCodes);
        $iblockIds = \FourPx\Helper::getIblockIdByCodes($iblockCodes);


        // >>> обновление разделов
        $sectXmlIds = array_keys($arSections);

        // получаем существующие разделы
        $oSect = \CIBlockSection::GetList([],
            ['XML_ID' => $sectXmlIds], false,
            ['ID', 'XML_ID', 'NAME']
        );
        $sectXmlIdEqId = [];
        while($res = $oSect->GetNext()){
            $sectXmlIdEqId[$res['XML_ID']] = $res['ID'];
        }
        $ibSect = new \CIBlockSection;
        foreach ($arSections as $section){
            $arFields = [
                'NAME' => $section['NAME'],
                'CODE' => $section['CODE'],
                'ACTIVE' => $section['ACTIVE'],
                'SORT' => $section['SORT'],
            ];
            unset($arFields['IBLOCK_CODE']);
            $arFields['IBLOCK_ID'] = $iblockIds[$section['IBLOCK_CODE']];

            if(isset($sectXmlIdEqId[$section['XML_ID']])){
                $ibSect->Update($sectXmlIdEqId[$section['XML_ID']], $arFields);
            }else{
                $arFields['XML_ID'] = $section['XML_ID'];
                $arFields['IBLOCK_ID'] = $iblockIds[$section['IBLOCK_CODE']];
                $newSectId = $ibSect->Add($arFields);
                $sectXmlIdEqId[$arFields['XML_ID']] = $newSectId;
            }
        }
        // <<< обновление разделов


        // получаем соответствия xml_id (id на основном сайте) => id элемента(на конфигураторе)
        $elXmlIds = array_unique($elXmlIds);
        $xmlIdEqId = [];
        $ob = \CIBlockElement::GetList([],
            ['XML_ID' => $elXmlIds], false, false,
            ['ID', 'XML_ID']
        );
        while($res = $ob->Fetch()){
            $xmlIdEqId[$res['XML_ID']] = $res['ID'];
        }


        // >> обновление значений свойств-списков
        if(!empty($enumPropsList)){
            $enumCodeEqId = []; // соответствие код_свойства - id
            // выбираем существующие списки. ключ - КОД_ИБ__КОД_СВОЙСТВА
            $arEnumProps = [];
            foreach ($enumPropsList as $ibCode => $enumProps){
                foreach ($enumProps as $propCode => $enumValues){
                    $obEnumField = \CIBlockPropertyEnum::GetList([],
                        ['IBLOCK_ID' => $iblockIds[$ibCode], 'CODE' => $propCode]
                    );
                    while($arEnumFields = $obEnumField->GetNext()) {
                        $arEnumProps[$ibCode.'__'.$propCode][$arEnumFields['ID']] = $arEnumFields['VALUE'];
                    }

                    // получаем id свойтв-списков
                    $obProps = \CIBlockProperty::GetList([], ["IBLOCK_ID"=>$iblockIds[$ibCode], 'CODE' => $propCode]);
                    if ($propFields = $obProps->Fetch()) {
                        $enumCodeEqId[$ibCode.'__'.$propCode] = $propFields['ID'];
                    }
                }
            }

            // добавляем недостающие
            $ibEnum = new \CIBlockPropertyEnum;
            foreach ($enumPropsList as $ibCode => $enumProps){
                foreach ($enumProps as $propCode => $enumValues){
                    foreach ($enumValues as $value => $arValue){
                        if(!in_array($value, $arEnumProps[$ibCode.'__'.$propCode]) && isset($enumCodeEqId[$ibCode.'__'.$propCode])){
                            $propOpt = array_merge([ 'PROPERTY_ID'=> $enumCodeEqId[$ibCode.'__'.$propCode] ], $arValue);
                            $newEnumId = $ibEnum->Add($propOpt);
                            $arEnumProps[$ibCode.'__'.$propCode][$newEnumId] = $arValue['VALUE'];
                        }
                    }
                }
            }
        }
        // << обновление значений свойств-списков


        // >> обновление элементов ИБ
        $ibElement = new \CIBlockElement;
        foreach ($arElements as $xmlId => $arItem){
            if(!empty($arItem['PROPS'])){

                $arElemProps = [];
                foreach ($arItem['PROPS'] as $propName => $arProp){
                    switch ($arProp['PROPERTY_TYPE']){
                        case 'E': // привязка
                            if(is_array($arProp['VALUE'])){
                                $arValues = [];
                                foreach ($arProp['VALUE'] as $value){
                                    $arValues[] = $xmlIdEqId[$value];
                                }
                                $arElemProps[$propName] = $arValues;
                            }else{
                                $arElemProps[$propName] = $xmlIdEqId[$arProp['VALUE']];
                            }
                            break;
                        case 'L': // список
                            $refKey = $arItem['IBLOCK_CODE'].'__'.$propName;
                            $curEnumPropId = array_flip($arEnumProps[$refKey]);

                            if(is_array($arProp['VALUE'])){
                                foreach ($arProp['VALUE'] as $value){
                                    $arValues[] = $curEnumPropId[$value];
                                }
                                $arElemProps[$propName] = $arValues;
                            }else{
                                $arElemProps[$propName] = $curEnumPropId[$arProp['VALUE']];
                            }
                            break;
                        case 'S': // строка
                            if(isset($arProp['VALUE']['TEXT'])){
                                $arElemProps[$propName] = $arProp['VALUE'];
                                $arElemProps[$propName]['TEXT'] = htmlspecialchars_decode($arElemProps[$propName]['TEXT']);
                            }
                            else{
                                $arElemProps[$propName] = htmlspecialchars_decode($arProp['VALUE']);
                            }
                            break;
                        default:
                            $arElemProps[$propName] = $arProp['VALUE'];
                            break;
                    }
                }
            }

            $arFields = [
                'NAME' => htmlspecialchars_decode($arItem['NAME']),
                'CODE' => $arItem['CODE'],
                'ACTIVE' => $arItem['ACTIVE'],
                'SORT' => $arItem['SORT'],
                'IBLOCK_SECTION_ID' => $sectXmlIdEqId[$arItem['IBLOCK_SECTION_ID']],
            ];

            // обновляем, если элемент существует
            if(isset($xmlIdEqId[$xmlId])){
                $ibElement->Update($xmlIdEqId[$xmlId], $arFields);

                if(isset($arElemProps)){
                    \CIBlockElement::SetPropertyValuesEx($xmlIdEqId[$xmlId], false, $arElemProps);
                }
            }
            // создаем новый, если элемента нет
            else{
                $arFields['IBLOCK_ID'] = $iblockIds[$arItem['IBLOCK_CODE']];
                $arFields['XML_ID'] = $arItem['XML_ID'];

                if(isset($arElemProps)){
                    $arFields['PROPERTY_VALUES'] = $arElemProps;
                }

                if($newElementId = $ibElement->Add($arFields)){
                    // добавляем соответствие XML_ID->ID для связанных элементов
                    $xmlIdEqId[ $arFields['XML_ID'] ] = $newElementId;
                }
            }
        }
        // << обновление элементов ИБ

    }


    /** Функция для агента
     *
     * @return string - название функции
     */
    public static function shopsUpdateForAgent(){
        try{
            self::init();
        }catch ( \Exception $e){
            print 'Error: ' . $e->getMessage() . PHP_EOL;
        }
        return '\\'.__CLASS__.'::'.__FUNCTION__.'();';
    }
}
