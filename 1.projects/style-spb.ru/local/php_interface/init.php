<?php
/*класс и объявленна функция*/

namespace IbHelp;

use \Bitrix\Main\Application,
    \Bitrix\Main\Config\Option,
    \Bitrix\Main\DB\Exception;

class Helper
{
    /*  Получение ID инфоблока по его коду */
    public static function getIblockIdByCodes($arIblockCodes)
    {
        $arIblocks = [];
        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            if ($rsIblocks = \CIBlock::GetList([], ['CODE' => $arIblockCodes])) {
                while ($iblock = $rsIblocks->Fetch()) {
                    $arIblocks[$iblock['CODE']] = $iblock['ID'];
                }
            }
        }
        return $arIblocks;
    }


    /*  Получение ID свойства инфоблока по его коду */
    public static function getPropByCodes($arPropCodes, $Iblock)
    {
        $arProps = [];
        $ID = \IbHelp\Helper::getIblockIdByCodes($Iblock)[$Iblock]; //ID инфоблока, можно получить функцией выше 

        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            if ($rsProps = \CIBlock::GetProperties($ID, ['CODE' => $arPropCodes])) {
                while ($prop = $rsProps->Fetch()) {
                    $arProps[$prop['CODE']] = $prop['ID'];
                }
            }
        }
        return $arProps;
    }


}
