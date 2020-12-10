<?php
$eventManager = Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("catalog", "OnSuccessCatalogImport1C", Array("EventsClass", "SuccessCatalogImport1CHendler"));

class EventsClass{
    function SuccessCatalogImport1CHendler() {
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/log.txt')) {
            unlink($_SERVER["DOCUMENT_ROOT"] . '/log.txt');
        }
        AddMessage2Log("AgentAdd", "EventHendlerTest");
        $timeStart = new DateTime();
        $timeStart->add(new DateInterval('PT10S'));
        $res = CAgent::GetList(["ID" => "ASC"], ["NAME" => "SuccessCatalogImport1CAgent();"]);
        while ($arRes = $res->Fetch()) {
            CAgent::Update($arRes["ID"], ["NEXT_EXEC" => $timeStart->format('d.m.Y H:i:s')]);
        }
        CAgent::CheckAgents();
    }
}
