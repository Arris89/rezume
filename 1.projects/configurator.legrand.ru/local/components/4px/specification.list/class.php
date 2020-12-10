<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Loader;

class CSpecification extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        Loader::includeModule('iblock');

        $arrFilter = is_array($this->arParams['FILTER']) ? $this->arParams['FILTER'] : array();

        if ($this->StartResultCache()) {

            $this->arResult['SECTIONS'] = $this->getSectionList();
            $this->arResult['ITEMS'] = $this->getElementsList($arrFilter);

            if (is_array($this->arParams['ITEMS_REQUEST'])
                && ! empty($this->arParams['ITEMS_REQUEST'])
            ) {
                $this->arResult['ITEMS_RESPONSE'] = $this->getElementsListResponse();
            }

            $this->IncludeComponentTemplate();

            return $this->arResult;
        }
    }

    /*
     * Получение id, code разделов
     *
     * @return array
     */
    private function getSectionList() {

        Loader::includeModule('iblock');

        $arSections = array();

        $rsSections = \CIBlockSection::GetList(
            array(
                'SORT' => 'ASC'
            ),
            array(
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
                'ACTIVE' => 'Y',
                'ACTIVE_DATE' => 'Y'
            ),
            false,
            array(
                'IBLOCK_ID',
                'CODE',
                'ID'
            ),
            false
        );

        while ($arSection = $rsSections->GetNext()) {
            $sectionId = $arSection['ID'];
            $arSections[ $sectionId ] = $arSection['CODE'];
        }

        return $arSections;
    }

    /*
     * Получение товаров
     *
     * @var array $arrFilter
     * @return array
     */
    private function getElementsList(array $arrFilter = array()) {

        Loader::includeModule('iblock');

        $arSpecificationList = array();

        $arFilterSpecification = array(
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y',
        );

        $arFilterSpecification = array_merge($arFilterSpecification, $arrFilter);

        $rsSpecification = \CIBlockElement::GetList(
            array(),
            $arFilterSpecification,
            false,
            false,
            array(
                'ID',
                'NAME',
                'IBLOCK_ID',
                'CATALOG_GROUP_1',
                'IBLOCK_SECTION_ID'
            )
        );

        $arXmlId = array();
        while ($arSpecification = $rsSpecification->GetNextElement()) {
            $arSpecificationFields = $arSpecification->GetFields();
            $arSpecificationProps = $arSpecification->GetProperties();

            $elementId = $arSpecificationFields['ID'];
            $sectionId = $arSpecificationFields['IBLOCK_SECTION_ID'];

            $arSpecificationList[ $elementId ]['ID'] = $elementId;
            $arSpecificationList[ $elementId ]['NAME'] = $arSpecificationFields['NAME'];
            $arSpecificationList[ $elementId ]['IBLOCK_SECTION_CODE'] = $this->arResult['SECTIONS'][ $sectionId ];

            if ($arSpecificationList[ $elementId ]['IBLOCK_SECTION_CODE'] === 'FUNCTION') {
                $arSpecificationList[ $elementId ]['PACKAGE_ARTICUL'] = $arSpecificationProps['PACKAGE_ARTICUL']['VALUE'];

                foreach ($arSpecificationProps['PACKAGE_ARTICUL']['VALUE'] as $xmlId) {
                    $arXmlId[ $xmlId ] = $xmlId;
                }
            }

            if ($arSpecificationList[ $elementId ]['IBLOCK_SECTION_CODE'] === 'FRAME') {
                $arSpecificationList[ $elementId ]['PRICE'] = $arSpecificationFields['CATALOG_PRICE_1'];
            }
        }

        if (count($arXmlId) > 0) {
            $arXmlIdPrices = $this->getPriceFunctions($arXmlId, $arSpecificationList);

            foreach ($arSpecificationList as $arItem) {

                if ($arItem['IBLOCK_SECTION_CODE'] === 'FUNCTION') {
                    foreach ($arItem['PACKAGE_ARTICUL'] as $xmlId) {
                        $arSpecificationList[ $arItem['ID'] ]['PRICE'] += $arXmlIdPrices[ $xmlId ];
                    }
                }
            }
        }

        return $arSpecificationList;
    }

    /*
     * Получение цен механизмов
     *
     * @var array $arXmlId
     * @return array || false
     */
    private function getPriceFunctions(array $arXmlId = array()) {
        
        if (empty($arXmlId)) return false;

        Loader::includeModule('iblock');

        $arXmlIdPrices = array();
        
        $rsCatalog = \CIBlockElement::GetList(
            array(),
            array(
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
                'SECTION_CODE' => array(
                    'ACCESSORY',
                    'MECHANISM'
                ),
                'ACTIVE' => 'Y',
                'PROPERTY_XML_ID' => $arXmlId
            ),
            false,
            false,
            array(
                'ID',
                'NAME',
                'IBLOCK_ID',
                'CATALOG_GROUP_1',
                'PROPERTY_XML_ID'
            )
        );

        while ($arCatalog = $rsCatalog->Fetch()) {

            $xmlId = $arCatalog['PROPERTY_XML_ID_VALUE'];
            $price = $arCatalog['CATALOG_PRICE_1'];

            $arXmlIdPrices[ $xmlId ] = $price;
        }

        return $arXmlIdPrices;
    }

    /*
     * Если необходимые параметры товаров
     * посланы в запросе, тогда
     * идет получение ответа
     * с обновленной ценой
     *
     * Все остальные параметры остаются без изменений
     *
     * @return array
     */
    private function getElementsListResponse() {
        $arElementsList = array();

        $i = 0;
        foreach ($this->arParams['ITEMS_REQUEST'] as $arElement) {
            $elementId = $arElement['id'];

            $arElementsList[ $i ]['id'] = $arElement['id'];
            $arElementsList[ $i ]['articul'] = $arElement['articul'];
            $arElementsList[ $i ]['picture'] = $arElement['picture'];
            $arElementsList[ $i ]['title'] = $arElement['title'];
            $arElementsList[ $i ]['count'] = $arElement['count'];
            $arElementsList[ $i ]['price'] = $this->arResult['ITEMS'][ $elementId ]['PRICE'];
            $arElementsList[ $i ]['countPrice'] = $arElement['count'] * $this->arResult['ITEMS'][ $elementId ]['PRICE'];
            $arElementsList[ $i ]['collectionCode'] = $arElement['collectionCode'];

            $i++;
        }

        return $arElementsList;
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