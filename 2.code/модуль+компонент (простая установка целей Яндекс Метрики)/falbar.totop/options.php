<?

use Bitrix\Main\Localization\Loc;
use	Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Bitrix\CAllIBlock;



Loc::loadMessages(__FILE__);

$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);

Loader::includeModule($module_id);




//Задаем параметры панели ввода данных в инфоблок


$aTabs = array(

	array(
		"DIV" 	  => "edit",
		"TAB" 	  => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_NAME"),
		"TITLE"   => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_NAME"),
		"OPTIONS" => array(


               //Блок данных счетчика Метрики

		    Loc::getMessage("GOALMETRIKA"),
	      
	        array(
				"goalnum",
				Loc::getMessage("GOALNUMBER"),
				"",
				array("text", 5)
			),


             array(
				"goaltoken",
				Loc::getMessage("GOALTOKEN"),
				"",
				array("text", 5)
			),


             //Блок Цели

		    Loc::getMessage("GOALDATA"),

			array(
				"goalname",
				Loc::getMessage("GOALNAME"),
				"",
				array("text", 5)
			),

				array(
				"goalid",
				Loc::getMessage("GOALID"),
				"",
				array("text", 5)
			),
		)
	)
);



// Считываем и сохраняем введенные в настройках модуля данные

if($request->isPost() && check_bitrix_sessid()){

	foreach($aTabs as $aTab){

		foreach($aTab["OPTIONS"] as $arOption){

			if(!is_array($arOption)){

				continue;
			}

// сохранение настроек модуля

			if($request["apply"]){

				$optionValue = $request->getPost($arOption[0]);

				Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue); 
			}elseif($request["default"]){

				Option::set($module_id, $arOption[0], $arOption[2]);
			}
		}
	}







// Получение данных из опций модуля для работы с API Метрики и инфоблоком

//Данные Метрики
$GLNum = Option::get("falbar.totop", "goalnum");  // номер счетчика метрики
$GLtoken = Option::get("falbar.totop", "goaltoken"); //токен для работы с API метрики

//Данные создаваемой цели
$GLName = Option::get("falbar.totop", "goalname"); // название цели
$GLiD = Option::get("falbar.totop", "goalid");    // идентификатор создаваемой цели



/*ЗАПИСЬ ЦЕЛИ В ИНФОБЛОК

1.Получаем ID инфоблока для записи в него целей*/

$res = CIBlock::GetList(
    Array(), 
    Array(
        "CODE"=>'metriks_goals'
    ), true
);
$ar_res = $res->Fetch();


// 2. Записываем название цели в инфоблок

$el = new CIBlockElement;

$arLoadProductArray = Array(
  "IBLOCK_ID"      => $ar_res['ID'],
  "NAME"           => "$GLName",
  "ACTIVE"         => "Y",            
  );

$PRODUCT_ID = $el->Add($arLoadProductArray);



// 3. Запрос в API Метрики. Документация: https://tech.yandex.ru/metrika/doc/api2/management/goals/addgoal-docpage/

$headers = array
   (
	"Authorization: OAuth $GLtoken",
    "Content-Type: application/json"
   );

$js = '{"goal":{"name":"'.$GLName.'","type":"action","is_retargeting":"0","conditions":[{"type":"exact","url":"'.$GLiD.'"}]}}';

$ch = curl_init('https://api-metrika.yandex.net/management/v1/counter/'.$GLNum.'/goals'); 

curl_setopt($ch, CURLOPT_POST, true); //переключаем запрос в POST
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $js); // POST данные
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Отключим проверку сертификата https
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_exec($ch);
curl_close($ch);




	LocalRedirect($APPLICATION->GetCurPage()."?mid=".$module_id."&lang=".LANG);
}

$tabControl = new CAdminTabControl(
	"tabControl",
	$aTabs
);

$tabControl->Begin();
?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">

	<?
	foreach($aTabs as $aTab){

		if($aTab["OPTIONS"]){

			$tabControl->BeginNextTab();

			__AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
		}
	}

	$tabControl->Buttons();
	?>

	<input type="submit" name="apply" value="<? echo(Loc::GetMessage("FALBAR_TOTOP_OPTIONS_INPUT_APPLY")); ?>" class="adm-btn-save" />
	<input type="submit" name="default" value="<? echo(Loc::GetMessage("FALBAR_TOTOP_OPTIONS_INPUT_DEFAULT")); ?>" />

	<?
	echo(bitrix_sessid_post());
	?>

</form>

<?
$tabControl->End();
?>