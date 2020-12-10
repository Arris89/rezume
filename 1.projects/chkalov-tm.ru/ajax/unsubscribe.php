
<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


if(CModule::IncludeModule("sender")){


if (isset($_POST['emailsub'])) {

   
    $contact_id = \Bitrix\Sender\ContactTable::addIfNotExist(array('EMAIL' => $_POST['emailsub']));
    $contact = new \Bitrix\Sender\Entity\Contact($contact_id);


    //Отписываемся от рассылок
    $subList = $contact->loadData($contact_id);
    $subList = $subList['SUB_LIST'];
    foreach ($subList as $item){
        $contact->unsubscribe($item);
    }

    die(true);
}
}

?>