<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<?php
require 'phpQuery.php';

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('main');
CModule::IncludeModule('iblock');

$iblockPars = \IbHelp\Helper::getIblockIdByCodes('parsing')["parsing"];

$id = $_POST['id'];


$bs = new CIBlockElement;

$arFields = array(
    "IBLOCK_ID" => $iblockPars,
    "NAME" => $_POST['name'],
    "ACTIVE" => "N",
    "SORT" => 500,
);


$res = $bs->Update($id, $arFields);


$ch1 = curl_init($_POST['href']);


/*Установка нужных опций*/
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); /*позволяет сохранять запрос в переменную*/
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true); /*Если есть редирект curl идет по нему*/

/*Если страница работает с https то ставим еще 2 опции*/
curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, true);


$html = curl_exec($ch1); /*Выполнение запроса*/

curl_close($ch1);  /*Закрываем curl дескриптор для данного сайта*/

$pq = phpQuery::newDocument($html);

echo '<pre>';
print_r($pq);
echo '<pre>';

echo '<pre>';
print_r($html);
echo '<pre>';


?>

<script>
    $(document).ready(function () {

        var mass = {};
        for (var key in labels) {
            mass[key] = new Array();
            mass[key] = [labels[key].top, labels[key].left, labels[key].label]; //top и left метки
        }
        console.log(mass);
        $.post('/load/page.php', {mass}, function (datad) {
            window.location.replace('/load/');
        })
    });
</script>










