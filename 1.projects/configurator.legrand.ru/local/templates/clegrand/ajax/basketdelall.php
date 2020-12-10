<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');


/* очистка всей корзины*/
   if (isset($_POST['deleteAll'])) 
   {

if(!$USER->IsAuthorized())

{
$res = CSaleBasket::GetList(array(), array(
                              'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                              'LID' => SITE_ID,
                              'ORDER_ID' => 'null',
                              'DELAY' => 'N',
                              'CAN_BUY' => 'Y'));
while ($row = $res->fetch()) {
   CSaleBasket::Delete($row['ID']);
}

}

else

{

$user = $USER->GetID();

$res = CSaleBasket::GetList(array(), array(
                              'USER_ID' => $user,
                              'LID' => SITE_ID,
                              'ORDER_ID' => 'null',
                              'DELAY' => 'N',
                              'CAN_BUY' => 'Y'));
while ($row = $res->fetch()) {
   CSaleBasket::Delete($row['ID']);
}


}


    }