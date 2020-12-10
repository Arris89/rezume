<?
namespace FourPx;

use \Bitrix\Main\Application;

class Helper {

    /*
     * @param null $data Переменная для вывода
     * @param bool $onlyForAdmin Выводить только для админов true/false
     */
    public static function print_r($data = null, $onlyForAdmin = true)
    {
        global $USER;

        $isAdmin = $USER->IsAdmin();

        if ($onlyForAdmin && $isAdmin || ! $onlyForAdmin) {
            $sender = debug_backtrace()[0];

            echo "<pre style='font-size: 12px'><span style='font-size: 12px; color: #AAA;'>" . $sender["file"] . " <span style='color: #666;'>[строка: " . $sender["line"] . "]</span></span><br>";
            print_r($data);
            echo "</pre>";
        }
    }

    /*
     * Получение ID инфоблока по его коду
     */
    public static function getIblockIdByCodes($arIblockCodes)
    {
        $arIblocks = [];
        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            if ($rsIblocks = \CIBlock::GetList([], ['CODE' => $arIblockCodes])) {
                while ($iblock = $rsIblocks->Fetch()) {
                    $arIblocks[ $iblock['CODE'] ] = $iblock['ID'];
                }
            }
        }
        return $arIblocks;
    }

    /*
     * Получение справочника свойств инфоблока где ключём явлется код свойства
     *
     * @param null $iblockCode
     * @throws \Bitrix\Main\Db\SqlQueryException
     * @throws \Bitrix\Main\LoaderException
     */
    public static function getIBlockPropsReference($iblockCode = null)
    {
        $arRef = [];

        if (\Bitrix\Main\Loader::includeModule('iblock')) {

            $connection = Application::getConnection();
            $sqlHelper = $connection->getSqlHelper();

            if ($rsRef = $connection
                ->query("
                        SELECT
                          `bip`.`ID`,
                          `bip`.`CODE`,
                          `bip`.`NAME`,
                          `bip`.`PROPERTY_TYPE`,
                          `bipe`.`ID` `ENUM_ID`,
                          `bipe`.`XML_ID` `ENUM_XML_ID`,
                          `bipe`.`DEF` `ENUM_DEFAULT`,
                          `bipe`.`VALUE` `ENUM_VALUE`
                        FROM `b_iblock` `bi`
                          INNER JOIN `b_iblock_property` `bip`
                            ON `bi`.`ID` = `bip`.`IBLOCK_ID`
                          LEFT JOIN `b_iblock_property_enum` `bipe`
                            ON `bipe`.`PROPERTY_ID` = `bip`.`ID`
                        WHERE `bi`.`CODE` = '" . $sqlHelper->forSql($iblockCode) . "';
                    ")
            ) {
                while ($item = $rsRef->fetch()) {
                    $arRef[$item['CODE']]['ID'] = $item['ID'];
                    $arRef[$item['CODE']]['CODE'] = $item['CODE'];
                    $arRef[$item['CODE']]['NAME'] = $item['NAME'];
                    $arRef[$item['CODE']]['PROPERTY_TYPE'] = $item['PROPERTY_TYPE'];

                    if ($enumId = $item['ENUM_XML_ID'] ? $item['ENUM_XML_ID'] : $item['ENUM_ID']) {
                        $arRef[$item['CODE']]['ENUMS'][ $enumId ]['ID'] = $item['ENUM_ID'];
                        $arRef[$item['CODE']]['ENUMS'][ $enumId ]['XML_ID'] = $item['ENUM_XML_ID'];
                        $arRef[$item['CODE']]['ENUMS'][ $enumId ]['DEFAULT'] = $item['ENUM_DEFAULT'];
                        $arRef[$item['CODE']]['ENUMS'][ $enumId ]['VALUE'] = $item['ENUM_VALUE'];
                    }
                }
            }
        }

        return $arRef;
    }

    /*
     * Получение массива нестандартых коллекций
     * (Используется для фильтрации smart.filter frame)
     *
     * @return array
     */
    public static function getOriginalCollections()
    {

        $arOriginalCollections = array();

        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $arFilter = Array(
                'IBLOCK_ID' => 24,
                'ACTIVE' => 'Y',
                'ACTIVE_DATE' => 'Y',
                'PROPERTY_ORIGINAL_COLLECTION_VALUE' => 'Y' //это свойство отмечает настандартные коллекции
            );

            $arSelect = Array(
                'ID',
                'IBLOCK_ID',
                'IBLOCK_CODE',
                'NAME'
            );

            $rsOriginalCollection = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($arOriginalCollection = $rsOriginalCollection->GetNext()) {

                $collectionId = $arOriginalCollection['ID'];

                $arOriginalCollections[ $collectionId ] = $collectionId;
            }
            unset($rsOriginalCollection);
        }

        return $arOriginalCollections;
    }

    /*
     * Получение всех коллекций
     *
     * @return array
     */
    public static function getCollections() {

        $arCollections = array();

        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $arFilter = Array(
                'IBLOCK_ID' => 24,
                'ACTIVE' => 'Y',
                'ACTIVE_DATE' => 'Y'
            );

            $arSelect = Array(
                'ID',
                'IBLOCK_ID',
                'IBLOCK_CODE',
                'CODE',
                'NAME',
                'SORT'
            );

            $rsCollection = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($arCollection = $rsCollection->GetNext()) {

                $collectionId = $arCollection['ID'];

                $arCollections[ $collectionId ]['ID'] = $collectionId;
                $arCollections[ $collectionId ]['NAME'] = $arCollection['NAME'];
                $arCollections[ $collectionId ]['CODE'] = $arCollection['CODE'];
                $arCollections[ $collectionId ]['SORT'] = $arCollection['SORT'];
            }
            unset($rsCollection);
        }

        return $arCollections;
    }

    /**
     * Получение строки из ключей массива
     *
     * @param array
     *
     * @return string
     */
    public static function contentArrayKeysToString($arr, $slotNameCoefficient = 1)
    {
        $startKey = min($arr) / $slotNameCoefficient;
        $stopKey = $startKey;
        $string = $startKey;
        $j = 0;

        foreach ($arr as $key => $value) {
            if ($key / $slotNameCoefficient == $startKey + $j) {
                $j++;
                continue;

            } else {
                if ($j > 1) {
                    $string .= ' &ndash; ' . ($startKey + $j - 1);
                } else {
                    $string .= ', ' . $key / $slotNameCoefficient;
                }
                $j = 0;
                $startKey = $key / $slotNameCoefficient;
            }
        }

        if ($key / $slotNameCoefficient == $startKey + $j - 1) {
            $string .= ' &ndash; ' . $key / $slotNameCoefficient;
        } else {
            $string .= ', ' . $key / $slotNameCoefficient;
        }

        return $string;
    }
}