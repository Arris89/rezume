<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');
	 

    if (isset($_POST['id'])) 

   {


CSaleOrder::Delete($_POST['id']);

}

