<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Data\Cache,
    \Bitrix\Main\Loader;

class CSNCCustomBlock extends CBitrixComponent
{

    const REFS_CACHE_TIME = 600;

    public function onPrepareComponentParams($arParams)
    {
        $request = Application::getInstance()->getContext()->getRequest();

        if ($pageN = $request->getQuery( $arParams['PAGEN_PARAM_NAME'] )) {
            $arParams['PAGEN'] = intval($pageN);
        } else {
            $arParams['PAGEN'] = 1;
        }

        $arParams['PARAMS_JSON'] = json_decode($arParams['PARAMS_JSON'], true);

        if (! is_array($arParams['PARAMS_JSON']['FILTER'])) {
            $arParams['PARAMS_JSON']['FILTER'] = array();
        }


        # учёт параметров при кешировании
        $arGetParams = explode(',', $arParams['GET_PARAMS']);
        $arParams['GET_PARAMS'] = array();
        foreach ($arGetParams as $paramName) {
            $arParams['GET_PARAMS'][ $paramName ] = $request->getQuery($paramName);
        }

        return $arParams;
    }


    public function executeComponent()
    {
        global $APPLICATION;

        if ($this->initComponentTemplate()) {
            $this->AddIncludeAreaIcons(
                array(
                    array(
                        "TEXT" => 'Редактировать содержимое',
                        "TITLE" => 'Редактировать содержимое',
                        "URL" => 'javascript:' . $APPLICATION->GetPopupLink(array(
                                    "URL"=> "/bitrix/admin/public_file_edit.php?lang=" . LANGUAGE_ID . "&path=" . $this->getTemplate()->GetFile() . "&site=" . SITE_ID,
                                    "PARAMS"=>array(
                                        "width"=>780,
                                        "height"=>470,
                                        "resizable"=>true,
                                        "min_width"=> 780,
                                        "min_height"=> 400,
                                        'dialog_type' => 'EDITOR'
                                    ),
                                )
                            ),
                        "ICON" => "bx-context-toolbar-edit-icon",
                        "ID" => "bx-context-toolbar-edit-chapter",
                    ),
                )
            );
        }

        $this->IncludeComponentTemplate();

        return $this->arResult;
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