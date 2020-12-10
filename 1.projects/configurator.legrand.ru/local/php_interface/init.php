<?
use \Bitrix\Main\Loader,
    \Bitrix\Main\EventManager;

Loader::registerAutoLoadClasses(
    null,
    array(
        'FourPx\Helper' => '/local/php_interface/FourPx/Helper.php',
        'FourPx\CEvent' => '/local/php_interface/FourPx/Event.php',
        'FourPx\ShopsUpdate' => '/local/php_interface/FourPx/ShopsUpdate.php',
    )
);

// события
$eventManager = EventManager::getInstance();

$eventManager->addEventHandler("search", "BeforeIndex", array("\FourPx\CEvent", "BeforeIndexHandler"));

$eventManager->addEventHandler("sale", "OnSaleOrderSaved", array("\FourPx\CEvent", "OnSaleOrderSavedUserUpdate"));
$eventManager->addEventHandler("sale", "OnOrderNewSendEmail", array("\FourPx\CEvent", "OnOrderNewSendEmailCustomize"));

// редирект в ЛК после авторизации
$eventManager->addEventHandler("main", "OnAfterUserAuthorize", array("\FourPx\CEvent", "OnAfterUserAuthHandler"));