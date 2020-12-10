<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('main');
CModule::IncludeModule('iblock');

$iblockID = \IbHelp\Helper::getIblockIdByCodes('img')["img"];

$iblockImgCat = \IbHelp\Helper::getIblockIdByCodes('imgcat')["imgcat"];

$iblockCat = \IbHelp\Helper::getIblockIdByCodes('aspro_next_catalog')["aspro_next_catalog"];


require 'phpQuery.php';

$name = $_POST['url'];


/*Получаем название домена из ссылки $domen[1]*/
preg_match('/(.*\.[a-z]+\/)/', $_POST['url'], $domen);//Выделяем домен


set_time_limit(0); // безлимитное время исполнения скрипта

$start = microtime(true);


$ch = curl_init($_POST['url']);


$proxy_ip = '193.233.149.113:45786';
$loginpassw = 'Sela022:L0s5JzW';

/*Установка нужных опций*/
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); /*позволяет сохранять запрос в переменную*/
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); /*Если есть редирект curl идет по нему*/

/*Если страница работает с https то ставим еще 2 опции*/
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);


//Указываем к какому прокси подключаемся и передаем логин-пароль
curl_setopt($ch, CURLOPT_PROXY, $proxy_ip);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $loginpassw);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);


$html = curl_exec($ch); /*Выполнение запроса*/

curl_close($ch);  /*Закрываем curl дескриптор для данного сайта*/

$pq = phpQuery::newDocument($html);

$titleMAIN = $pq->find('h2')->text();

$str = $pq->find('.acat-groups .level-0;');

/*1 получаем первый уровень*/
$k = 0;
$n = 0;
$z = 0;
foreach ($str as $key) {
    $pq = pq($key);
    $href0 = $pq->next();
    $href1 = $pq->find('.js-action;')->text();
    $href[$href1] = $href1;


    foreach ($href0 as $key1) {
        $pq1 = pq($key1);
        $href3 = $pq1->find('.level-1;');

        foreach ($href3 as $key2 => $value) {
            $pq2 = pq($value);
            $href2 = $pq2->text();
            $href['level1'][$href1][$href2] = $href2; /*записываем уровень 2*/
            $z++;


            $href5 = $pq2->next()->find('.level-2;');

            foreach ($href5 as $key5 => $value5) {
                $pq5 = pq($value5);
                $href5 = $pq5->text();
                $hrefLink5 = $pq5->find('a')->attr('href');
                $href['level2'][$href1][$href2][$hrefLink5] = $href5; /*записываем уровень 3*/
            }

        }
        $n++;
    }
    $k++;
}


/*создаем раздел нулевого уровня*/

/*генерация символьного кода*/
$arParams = array("replace_space" => "-", "replace_other" => "-");
$trans = Cutil::translit($titleMAIN, "ru", $arParams);


$bs = new CIBlockSection;

$arFields = Array(
    "ACTIVE" => 'Y',
    "IBLOCK_SECTION_ID" => $_POST['section'],
    "IBLOCK_ID" => $iblockCat,
    "NAME" => $titleMAIN,
    "CODE" => $trans,
);


$IDpodrazdel0 = $bs->Add($arFields);
$res = ($ID > 0);
if (!$res)
    echo $bs->LAST_ERROR;


$kr = 0;

foreach ($href['level2'] as $key => $value) {

    /*генерация символьного кода*/
    $arParams = array("replace_space" => "-", "replace_other" => "-");
    $trans = Cutil::translit($key, "ru", $arParams);

    $bs0 = new CIBlockSection;

    $arFields0 = Array(
        "ACTIVE" => 'Y',
        "IBLOCK_SECTION_ID" => $IDpodrazdel0,
        "IBLOCK_ID" => $iblockCat,
        "NAME" => $key,
        "CODE" => $trans,
    );


    $IDpodrazdel1 = $bs->Add($arFields0);
    $res0 = ($ID > 0);
    if (!$res0)
        echo $bs0->LAST_ERROR;


    foreach ($value as $key1 => $value1) {


        /*генерация символьного кода*/
        $arParams1 = array("replace_space" => "-", "replace_other" => "-");
        $trans1 = Cutil::translit($key1, "ru", $arParams1);

        $bs1 = new CIBlockSection;

        $arFields1 = Array(
            "ACTIVE" => 'Y',
            "IBLOCK_SECTION_ID" => $IDpodrazdel1,
            "IBLOCK_ID" => $iblockCat,
            "NAME" => $key1,
            "CODE" => $trans1,
        );


        $IDpodrazdel2 = $bs1->Add($arFields1);
        $res1 = ($ID > 0);
        if (!$res1)
            echo $bs1->LAST_ERROR;


        foreach ($value1 as $key2 => $value2) {


            /*генерация символьного кода*/
            $arParams2 = array("replace_space" => "-", "replace_other" => "-");
            $trans2 = Cutil::translit($value2, "ru", $arParams2);


            $bs2 = new CIBlockSection;

            $arFields2 = Array(
                "ACTIVE" => 'Y',
                "IBLOCK_SECTION_ID" => $IDpodrazdel2,
                "IBLOCK_ID" => $iblockCat,
                "NAME" => $value2,
                "CODE" => $trans2,
            );


            $IDpodrazdel3 = $bs2->Add($arFields2);
            $res2 = ($ID > 0);
            if (!$res2)
                echo $bs2->LAST_ERROR;


            $result[$kr]['RAZDEL'] = $IDpodrazdel3;
            $result[$kr]['RAZDELNAME'] = $value2;


            $ch1 = curl_init('https://www.konsulavto.ru' . $key2 . '');


            /*Установка нужных опций*/
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); /*позволяет сохранять запрос в переменную*/
            curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true); /*Если есть редирект curl идет по нему*/

            /*Если страница работает с https то ставим еще 2 опции*/
            curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, true);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, true);

            //Указываем к какому прокси подключаемся и передаем логин-пароль
            curl_setopt($ch1, CURLOPT_PROXY, $proxy_ip);
            curl_setopt($ch1, CURLOPT_PROXYUSERPWD, $loginpassw);
            curl_setopt($ch1, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);

            $html = curl_exec($ch1); /*Выполнение запроса*/

            curl_close($ch1);  /*Закрываем curl дескриптор для данного сайта*/

            $pq = phpQuery::newDocument($html);


            /*Получаем картинку со схемой*/

            $pic = $pq->find('#iPic_ac img;')->attr('src');
            $result[$kr]['PICTURE'] = $pic;


            /*Получаем детали*/

            $grin = $pq->find('.partsTable_ac tr;')->next();

            $i = 0;
            foreach ($grin as $key5) {

                $key5 = pq($key5);
                $number = $key5->find('td:eq(2);')->text();
                $name = $key5->find('td:eq(3);')->text();
                $kol700 = $key5->find('td:eq(3) .acat-added tr td:eq(1);')->text();
                $two = $key5->find('td:eq(3) .acat-added tr:eq(1) td:eq(1);')->text();
                $img = $key5->find('td img;')->attr('src');

                $name = strstr($name, 'Подробнее', true);

                if ($number) {
                    $result[$kr]['ITEMS'][$i]['NUMBER'] = $number;
                }
                if ($number) {
                    $result[$kr]['ITEMS'][$i]['NAME'] = $name;
                }
                if ($number) {
                    $result[$kr]['ITEMS'][$i]['kol700'] = $kol700;
                }
                if ($number) {
                    $result[$kr]['ITEMS'][$i]['two'] = $two;
                }

                if ($number) {
                    $result[$kr]['ITEMS'][$i]['IMG'] = $img;
                }

                if (!$result[$kr]['ITEMS'][$i] == '') {
                    $i++;
                }


                unset($number);
                unset($name);
                unset($kol700);
                unset($two);
                unset($img);


            }


            $kr++;

        }
    }
}


/*2. создание подраздела для изображения*/

/*генерация символьного кода*/
$arParams = array("replace_space" => "-", "replace_other" => "-");
$transImg = Cutil::translit($titleMAIN, "ru", $arParams);


$bs1 = new CIBlockSection;

$arFields = Array(
    "ACTIVE" => 'Y',
    "IBLOCK_ID" => $iblockImgCat,
    "NAME" => $titleMAIN,
    "CODE" => $transImg,
);


$IMGpodrazdel = $bs1->Add($arFields);
$res = ($ID > 0);
if (!$res)
    echo $bs1->LAST_ERROR;


foreach ($result as $key => $value) {


    /*3 добавление изображения*/


    $imgurl = $domen[1] . $value['PICTURE'];


    $arFile = CFile::MakeFileArray($imgurl);
    $arFile["MODULE_ID"] = "main";
    $fid = CFile::SaveFile($arFile, "main");

    $el = new CIBlockElement;

    $PROP = array();
    $PROP[318] = $value['RAZDEL'];

    /*имя прописываем как кол-во элементов в разделе +1*/


    $arLoadProductArray = Array(

        "IBLOCK_ID" => $iblockImgCat,
        "IBLOCK_SECTION_ID" => $IMGpodrazdel,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $value['RAZDELNAME'],
        "ACTIVE" => "Y",
        "PREVIEW_PICTURE" => CFile::MakeFileArray($fid)
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);


    /*4 добавление товаров*/

    if (isset($value['ITEMS'])) {

        $j = 1;


        foreach ($value['ITEMS'] as $key => $value1) {

            $products1[$key] = $value1;

            $zz = trim($value1['NAME']);
            if (isset($zz)) {


                $el = new CIBlockElement;

                $PROP = array();
                $PROP[317] = $j; /*добавляем номер товара*/
                $PROP[320] = $value1['kol700']; /*добавляем свойство 'Кол-во на'*/
                /*добавляем прочие свойства'*/
                $PROP[321] = $value1['two'];
                $PROP[322] = $value1['model'];
                $PROP[323] = $value1['grup'];
                $PROP[324] = $value1['podgrup'];
                $PROP[325] = $value1['num'];
                $PROP[326] = $value1['dop'];

                /*Сохраняем картинку для товара*/

                $arFile = CFile::MakeFileArray($value1['IMG']);
                $arFile["MODULE_ID"] = "main";
                $fid1 = CFile::SaveFile($arFile, "main");


                $arLoadProductArray = Array(
                    "IBLOCK_SECTION_ID" => $value['RAZDEL'],
                    "IBLOCK_ID" => $iblockCat,
                    "NAME" => $value1['NAME'],
                    "ACTIVE" => "Y",
                    "PROPERTY_VALUES" => $PROP,
                    "PREVIEW_PICTURE" => CFile::MakeFileArray($fid1),
                );

                $PRODUCT_ID = $el->Add($arLoadProductArray);

            }

            $j++;


        }


    }


}

?>








