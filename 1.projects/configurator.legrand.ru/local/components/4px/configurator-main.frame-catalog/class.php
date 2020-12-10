<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Loader;

class CConfiguratorMainCatalogFrame extends CBitrixComponent
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

        return $arParams;
    }

    public function executeComponent()
    {
        Loader::includeModule('iblock');

        $arrFilter = is_array($this->arParams['CATALOG_FILTER']) ? $this->arParams['CATALOG_FILTER'] : array();

        if ($this->StartResultCache()) {

            $this->arResult['FRAME'] = $this->getFrame($arrFilter);

            $this->IncludeComponentTemplate();

            return $this->arResult;
        }
    }

    private function getFrame(array $arrFilter = array()) {

        Loader::includeModule('iblock');

        $arCollections = $this->getCollection();
        
        $arFilterFrameConfigurator = array(
            'IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'],
            'IBLOCK_TYPE' => $this->arParams['CATALOG_IBLOCK_TYPE'],
            'SECTION_CODE' => $this->arParams['SECTION_CODE'],
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y',

            array(
                'LOGIC' => 'OR',
                array(
                    'PROPERTY_FRAME_COUNT_FUNCTION_VALUE' => 1
                ),
                array(
                    'PROPERTY_FRAME_COUNT_FUNCTION_VALUE' => 2,
                    'PROPERTY_TYPE_INSTALATION' => 'M'
                ),
                array(
                    'PROPERTY_FRAME_COUNT_FUNCTION_VALUE' => 2,
                    'PROPERTY_TYPE_INSTALATION' => 'P'
                ),
            )
        );

        $arFilterFrameConfigurator = array_merge($arFilterFrameConfigurator, $arrFilter);

        $arSelectFrameConfigurator = array(
            'ID',
            'NAME',
            'CODE',
            'IBLOCK_ID',
            'CATALOG_GROUP_1',
        );

        $arFrames = array();
        $arImagesId = array();
        $arFramesCode = array();
        $rsFrameConfigurator = \CIBlockElement::GetList($this->arParams['arOrder'], $arFilterFrameConfigurator, false, $this->arParams['arNavStartParams'], $arSelectFrameConfigurator);
        while ($arFrameConfigurator = $rsFrameConfigurator->GetNextElement()) {
            $arFrameConfiguratorFields = $arFrameConfigurator->GetFields();
            $arFrameConfiguratorProps = $arFrameConfigurator->GetProperties();

            $configuratorId = $arFrameConfiguratorFields['ID'];

            $arFrames['ITEMS'][ $configuratorId ]['ID'] = $configuratorId;
            $arFrames['ITEMS'][ $configuratorId ]['NAME'] = $arFrameConfiguratorFields['NAME'];
            $arFrames['ITEMS'][ $configuratorId ]['CODE'] = $arFrameConfiguratorFields['CODE'];
            $arFrames['ITEMS'][ $configuratorId ]['CATALOG_PRICE_1'] = $arFrameConfiguratorFields['CATALOG_PRICE_1'];
            $arFrames['ITEMS'][ $configuratorId ]['CATALOG_CURRENCY_1'] = $arFrameConfiguratorFields['CATALOG_CURRENCY_1'];
            $arFrames['ITEMS'][ $configuratorId ]['PROPERTIES'] = $arFrameConfiguratorProps;

            $arFramesCode[ $arFrameConfiguratorFields['CODE'] ] = $arFrameConfiguratorFields['CODE'];

            /*
             * Формирование массива изображений
             */
            if (! empty($arFrameConfiguratorProps['FRAME_IMG_HORIZONTAL']['VALUE'])) {
                $arImagesId[ $arFrameConfiguratorProps['FRAME_IMG_HORIZONTAL']['VALUE'] ] = $arFrameConfiguratorProps['FRAME_IMG_HORIZONTAL']['VALUE'];
            }
        }
        unset($rsFrameConfigurator);

        $arFrames['IMAGES'] = $this->getImages($arImagesId);

        $arFrames['COLLECTIONS'] = $arCollections['COLLECTIONS'];

        $arFrames['FRAME_COUNT_FUNCTION'] = $this->getFramesByCode($arFramesCode);

        return $arFrames;
    }

    private function getFramesByCode(array $arFramesCode = array()) {

        $rsCollectionsCode = \CIBlockElement::GetList(
            array(
                'PROPERTY_FRAME_COUNT_FUNCTION' => 'ASC'
            ),
            array(
                'IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'],
                'ACTIVE' => 'Y',
                'ACTIVE_DATE' => 'Y',
                'CODE' => $arFramesCode
            ),
            false,
            false,
            array(
                'ID',
                'CODE',
                'NAME',
                'PROPERTY_XML_ID',
                'PROPERTY_ARTICUL',
                'PROPERTY_FRAME_COUNT_FUNCTION'
            )
        );

        $arCollectionsCode = array();
        while ($arCollectionCode = $rsCollectionsCode->GetNext()) {
            
            $collectionCode = $arCollectionCode['CODE'];
            $frameCountFunction = $arCollectionCode['PROPERTY_FRAME_COUNT_FUNCTION_VALUE'];

            $arCollectionsCode[ $collectionCode ][ $frameCountFunction ]['ID'] = $arCollectionCode['ID'];
            $arCollectionsCode[ $collectionCode ][ $frameCountFunction ]['CODE'] = $collectionCode;
            $arCollectionsCode[ $collectionCode ][ $frameCountFunction ]['NAME'] = $arCollectionCode['NAME'];
            $arCollectionsCode[ $collectionCode ][ $frameCountFunction ]['XML_ID'] = $arCollectionCode['PROPERTY_XML_ID_VALUE'];
            $arCollectionsCode[ $collectionCode ][ $frameCountFunction ]['ARTICUL'] = $arCollectionCode['PROPERTY_ARTICUL_VALUE'];
            $arCollectionsCode[ $collectionCode ][ $frameCountFunction ]['FRAME_COUNT_FUNCTION'] = $frameCountFunction;
        }

        return $arCollectionsCode;
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
        );

        $arSelect = Array(
            'ID',
            'CODE',
            'IBLOCK_ID',
            'IBLOCK_CODE',
            'NAME',
            'PROPERTY_ORIGINAL_COLLECTION',
            'SORT'
        );

        $arCollections = array();
        $rsCollection = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while($arCollection = $rsCollection->GetNext()) {
            $collectionId = $arCollection['ID'];

            $arCollections['COLLECTIONS'][ $collectionId ]['ID'] = $collectionId;
            $arCollections['COLLECTIONS'][ $collectionId ]['CODE'] = $arCollection['CODE'];
            $arCollections['COLLECTIONS'][ $collectionId ]['NAME'] = $arCollection['NAME'];
            $arCollections['COLLECTIONS'][ $collectionId ]['SORT'] = $arCollection['SORT'];

            if ($arCollection['PROPERTY_ORIGINAL_COLLECTION_VALUE'] === 'Y') {
                $arCollections['ORIGINAL_COLLECTIONS'][ $collectionId ] = $collectionId;
            }

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