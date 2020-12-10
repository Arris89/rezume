
<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');



/*2 очистка всей корзины*/
   if (isset($_POST['deleteAll'])) 
   {

       if(!$USER->IsAuthorized())

       {

           $res = CSaleBasket::GetList(array(), array(
               'FUSER_ID' => CSaleBasket::GetBasketUserID(),
               'LID' => SITE_ID,
               'ORDER_ID' => 'null',
               'DELAY' => 'N'
           ));

       }

       else

       {

           $user = $USER->GetID();

           $res = CSaleBasket::GetList(array(), array(
               'USER_ID' => $user,
               'LID' => SITE_ID,
               'ORDER_ID' => 'null',
               'DELAY' => 'N'
           ));

       }


while ($row = $res->fetch()) {
   CSaleBasket::Delete($row['ID']);
}


    }
