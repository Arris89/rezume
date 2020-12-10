<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Loader;

class CConfiguratorMainCatalogMechanism extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        if (empty($arParams['arNavStartParams'])) {
            $arParams['arNavStartParams'] = false;
        }

        if (empty($arParams['arOrder'])) {
            $arParams['arOrder'] = array();
        }

        if (empty($arParams['SECTION_CODE'])) {
            $arParams['SECTION_CODE'] = '';
        }

        $this->arResult['CATALOG_QUERY_FILTER'] = $arParams['CATALOG_QUERY_FILTER'];

        return $arParams;
    }

    public function executeComponent()
    {
        Loader::includeModule('iblock');

        $arrFilter = is_array($this->arParams['CATALOG_FILTER']) ? $this->arParams['CATALOG_FILTER'] : array();

        if ($this->StartResultCache()) {

            $this->arResult['FUNCTION'] = $this->getMechanism($arrFilter);

            $this->IncludeComponentTemplate();

            return $this->arResult;
        }
    }

    private function getMechanism(array $arrFilter = array()) {

        Loader::includeModule('iblock');

        $arFilterMechanismConfigurator = array(
            'IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'],
            'IBLOCK_TYPE' => $this->arParams['CATALOG_IBLOCK_TYPE'],
            'SECTION_CODE' => $this->arParams['SECTION_CODE'],
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y'
        );

        $arFilterMechanismConfigurator = array_merge($arFilterMechanismConfigurator, $arrFilter);

        $arSelectMechanismConfigurator = array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'CATALOG_GROUP_1',
        );

        $arMechanisms = array();
        $arImagesId = array();
        $xmlIdPrice = array();
        $rsMechanismConfigurator = \CIBlockElement::GetList($this->arParams['arOrder'], $arFilterMechanismConfigurator, false, $this->arParams['arNavStartParams'], $arSelectMechanismConfigurator);
        while ($arMechanismConfigurator = $rsMechanismConfigurator->GetNextElement()) {
            $arMechanismConfiguratorFields = $arMechanismConfigurator->GetFields();
            $arMechanismConfiguratorProps = $arMechanismConfigurator->GetProperties();

            $configuratorId = $arMechanismConfiguratorFields['ID'];

            $arMechanisms['ITEMS'][ $configuratorId ]['ID'] = $configuratorId;
            $arMechanisms['ITEMS'][ $configuratorId ]['NAME'] = $arMechanismConfiguratorFields['NAME'];
            $arMechanisms['ITEMS'][ $configuratorId ]['CATALOG_PRICE_1'] = $arMechanismConfiguratorFields['CATALOG_PRICE_1'];
            $arMechanisms['ITEMS'][ $configuratorId ]['CATALOG_CURRENCY_1'] = $arMechanismConfiguratorFields['CATALOG_CURRENCY_1'];
            $arMechanisms['ITEMS'][ $configuratorId ]['PROPERTIES'] = $arMechanismConfiguratorProps;

            /*
             * Формирование массива изображений
             */
            if (! empty($arMechanismConfiguratorProps['FUNCTION_IMG']['VALUE'])) {
                $arImagesId[ $arMechanismConfiguratorProps['FUNCTION_IMG']['VALUE'] ] = $arMechanismConfiguratorProps['FUNCTION_IMG']['VALUE'];
            }

            foreach ($arMechanismConfiguratorProps['PACKAGE_ARTICUL']['VALUE'] as $xmlId) {
                $xmlIdPrice[ $xmlId ] = $xmlId;
            }
        }
        unset($rsMechanismConfigurator);

        $arMechanisms['IMAGES'] = $this->getImages($arImagesId);
        $arMechanisms['COLLECTIONS'] = $this->getCollection();
        $arMechanisms['XML_ID_PRICE'] = $this->getXmlIdPrice($xmlIdPrice);

        return $arMechanisms;
    }

    private function getXmlIdPrice(array $xmlIdPrice = array()) {

        $result = array();

        $arFilter = array(
            'IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'],
            'IBLOCK_TYPE' => $this->arParams['CATALOG_IBLOCK_TYPE'],
            'ACTIVE' => 'Y',
            'SECTION_CODE' => array(
                'ACCESSORY',
                'MECHANISM'
            ),
            'PROPERTY_XML_ID' => $xmlIdPrice
        );

        $arSelect = array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'CATALOG_GROUP_1',
            'PROPERTY_XML_ID'
        );

        $rsMechanism = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($arMechanism = $rsMechanism->Fetch()) {

            $xmlId = $arMechanism['PROPERTY_XML_ID_VALUE'];
            $price = $arMechanism['CATALOG_PRICE_1'];

            $result[ $xmlId ] = $price;
        }

        return $result;
    }

    private function getImages(array $arImagesId = array()) {

        $arImagesString = implode(',', $arImagesId);

        $arImageList = array();
        $rsImage = \CFile::GetList(array(), array('@ID' => $arImagesString));

        while($arImage = $rsImage->GetNext()) {
            $imageID = $arImage['ID'];
            $arImageList[ $imageID ] = '/upload/'.$arImage['SUBDIR'].'/'.$arImage['FILE_NAME'];
        }

        return $arImageList;
    }

    private function getCollection() {

        Loader::includeModule('iblock');

        $arFilter = Array(
            'IBLOCK_ID' => 24,
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y'
        );

        $arSelect = Array(
            'ID',
            'IBLOCK_ID',
            'IBLOCK_CODE',
            'NAME',
            'SORT'
        );

        $arCollections = array();
        $rsCollection = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while($arCollection = $rsCollection->GetNext()) {
            $collectionId = $arCollection['ID'];

            $arCollections[ $collectionId ]['ID'] = $collectionId;
            $arCollections[ $collectionId ]['NAME'] = $arCollection['NAME'];
            $arCollections[ $collectionId ]['SORT'] = $arCollection['SORT'];
        }
        unset($rsCollection);

        return $arCollections;
    }

    public static function set404Status()
    {
        \CHTTP::SetStatus("404 Not Found");
        if (! defined('ERROR_404')) {
            define('ERROR_404', 'Y');
        }
        include(Application::getDocumentRoot() . '/404.php');
        return false;
    }
}