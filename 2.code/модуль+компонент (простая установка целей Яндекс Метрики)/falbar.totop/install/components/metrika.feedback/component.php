<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */


$arResult["GOAL"] = $arParams["USE_GOAL"];


$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_name"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME");		
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_email"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_EMAIL");
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["MESSAGE"]) <= 3)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_MESSAGE");

 		if((empty($arParams["REQUIRED_FIELDS"]) || in_array("AUTHOR_TELL", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_tell"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_TELL");

		}
		if(strlen($_POST["user_email"]) > 1 && !check_email($_POST["user_email"]))
			$arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
		if($arParams["USE_CAPTCHA"] == "Y")
		{
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");

		}			
		if(empty($arResult["ERROR_MESSAGE"]))
		{
					$arFields = Array(
				   "AUTHOR" => $_POST["user_name"],
				   "EMAIL_TO" => $arParams["EMAIL_TO"],

					"AUTHOR_EMAIL" => $_POST["user_email"],
					"TEXT" => $_POST["MESSAGE"],		
					"AUTHOR_TELL" => $_POST["user_tell"],	
					"TEXT" => $_POST["MESSAGE"],
					"MESTO" => $_POST["mestoo"],	
					"MESTOP" => $_POST["mestop"],		
					"SHIR" => $_POST["shir"],		
					"DLIN" => $_POST["dlin"],			
					"VISOTA" => $_POST["visota"],
					"MASSA" => $_POST["massa"],	
					"OBIEM" => $_POST["obiem"],	
					"TIPP" => $_POST["tipp"],
					"COMMENT" => $_POST["comment"],
					"ARENDA_TOVAR_LIST" => $_POST["arenda_tovar_list"],
					"ARENDA_TOVAR_DETAIL" => $_POST["arenda_tovar_detail"],
					"ARENDA_TOVAR_INTERES" => $_POST["arenda_tovar_interes"],
					"PEREVOZ_TOVAR_LIST" => $_POST["chem_tovar_list"],
					"GRUZ_TOVAR_INTERES" => $_POST["gruz_tovar_interes"],		
					"CHEM_TOVAR_DETAIL" => $_POST["chem_tovar_detail"],
					"CHEM_TOVAR_DETAIL" => $_POST["chem_tovar_interes"],
					"GRUZ_URL" => $_POST["gruz"],
					"DOP_URL" => $_POST["dop"],
					"CONT_URL" => $_POST["cont"],
					"BIG_URL" => $_POST["big_form"],


                    "BAS" => $_POST["bas"],
                    "CHASHA" => $_POST["chasha"],
                     "CHASHA2" => $_POST["chasha2"],
                    "BAS2" => $_POST["bas2"],

                     "DLINA" => $_POST["dlina"],

                     "SHIRINA" => $_POST["shirina"],

                      "GLUBINA" => $_POST["glubina"],

			);

			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(IntVal($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
			$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
			$_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
			echo "<script>window.location.replace('http://start/razdel-dlya-formy/');</script>";
		}
		
		$arResult["MESSAGE"] = htmlspecialcharsbx($_POST["MESSAGE"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);



		$arResult["AUTHOR_TELL"] = htmlspecialcharsbx($_POST["user_tell"]);
        $arResult["MESTO"] = htmlspecialcharsbx($_POST["mestoo"]);
	    $arResult["MESTOP"] = htmlspecialcharsbx($_POST["mestop"]);
		$arResult["SHIR"] = htmlspecialcharsbx($_POST["shir"]);
		$arResult["DLIN"] = htmlspecialcharsbx($_POST["dlin"]);
		$arResult["VISOTA"] = htmlspecialcharsbx($_POST["visota"]);
		$arResult["MASSA"] = htmlspecialcharsbx($_POST["massa"]);
		$arResult["OBIEM"] = htmlspecialcharsbx($_POST["obiem"]);
		$arResult["TIPP"] = htmlspecialcharsbx($_POST["tipp"]);
		$arResult["COMMENT"] = htmlspecialcharsbx($_POST["comment"]);
	    $arResult["ARENDA_TOVAR_LIST"] = htmlspecialcharsbx($_POST["arenda_tovar_list"]);
	    $arResult["ARENDA_TOVAR_DETAIL"] = htmlspecialcharsbx($_POST["arenda_tovar_detail"]);
	    $arResult["ARENDA_TOVAR_INTERES"] = htmlspecialcharsbx($_POST["arenda_tovar_interes"]);
	    $arResult["PEREVOZ_TOVAR_LIST"] = htmlspecialcharsbx($_POST["chem_tovar_list"]);
	    $arResult["GRUZ_TOVAR_INTERES"] = htmlspecialcharsbx($_POST["gruz_tovar_interes"]);
        $arResult["CHEM_TOVAR_DETAIL"] = htmlspecialcharsbx($_POST["chem_tovar_detail"]);
        $arResult["CHEM_TOVAR_INTERES"] = htmlspecialcharsbx($_POST["chem_tovar_interes"]);
        $arResult["GRUZ_URL"] = htmlspecialcharsbx($_POST["gruz"]);
         $arResult["DOP_URL"] = htmlspecialcharsbx($_POST["dop"]);
         $arResult["CONT_URL"] = htmlspecialcharsbx($_POST["cont"]);
         $arResult["BIG_URL"] = htmlspecialcharsbx($_POST["big_form"]);


          $arResult["BAS"] = htmlspecialcharsbx($_POST["bas"]);
             $arResult["CHASHA"] = htmlspecialcharsbx($_POST["chasha"]);      
          $arResult["CHASHA2"] = htmlspecialcharsbx($_POST["chasha2"]);



   				$arResult["BAS2"] = htmlspecialcharsbx($_POST["bas2"]);
        		 $arResult["DLINA"] = htmlspecialcharsbx($_POST["dlina"]);
            	$arResult["SHIRINA"] = htmlspecialcharsbx($_POST["shirina"]);
               $arResult["GLUBINA"] = htmlspecialcharsbx($_POST["glubina"]);


	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if($USER->IsAuthorized())
	{
		$arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
	}
	else
	{
		if(strlen($_SESSION["MF_NAME"]) > 0)
			$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
		if(strlen($_SESSION["MF_EMAIL"]) > 0)
			$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_SESSION["MF_EMAIL"]);
	}
}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
