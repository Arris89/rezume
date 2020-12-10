<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


if (CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")) {


    if (
        isset($_POST['us_id']) && (isset($_POST['itemid'])) && (isset($_POST['submail']))
        && (isset($_POST['time']))
    ) {
        /*Проверка ввода уже подписанного Email*/

        $queryObjectm = \Bitrix\Catalog\SubscribeTable::getList(array(
            'filter' => array('USER_CONTACT' => $_POST['submail'])
        ));

        $subscribem = $queryObjectm->fetch();

        if ($subscribem) {
            echo 'no';
        } else {


            /*Добавление подписки*/

            $subscribeData = array(
                'USER_CONTACT' => $_POST['submail'],
                'CONTACT_TYPE' => 1,
                'NEED_SENDING' => 1,
                'SITE_ID' => 's1',
                'ITEM_ID' => $_POST['itemid'],
                'USER_ID' => $_POST['us_id']
            );

            $subscribeManager = new \Bitrix\Catalog\Product\SubscribeManager;
            $subscribeManager->addSubscribe($subscribeData);


            /*Перевод времени в секунды*/
            $LongTime = 86400 * $_POST['time'];

            /*ВЫВОД СПИСКА ВСЕХ ПОДПИСОК (чтобы получить ID новой подписки)*/

            $queryObject = new \Bitrix\Catalog\SubscribeTable;
            $queryObject = \Bitrix\Catalog\SubscribeTable::getList(array(
                'select' => array('ID'), 'order' => array('ID' => 'DESC'), 'limit' => 1
            ));
            $subscribe = $queryObject->fetch();

            /*Добавление даты окончания подписки*/
            $listSubscribeId = array($subscribe['ID']);
            $subscribeManager->activateSubscription($listSubscribeId, $LongTime);


        }


    }

}
?>