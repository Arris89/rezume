<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Loader;

class CConfiguratorMain extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        Loader::includeModule('iblock');

        if ($this->StartResultCache()) {
            $this->IncludeComponentTemplate();
        }
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