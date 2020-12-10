<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>


	<div class="basket-wrap basket-order signup">
	<div class="title"><h2>Регистрация</h2></div>
	<div class="container">
	<div class="separate-line"></div>
	<div class="container-small registration">


<?$APPLICATION->IncludeComponent(
	"avia:main.register",
	"registerpage",
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AUTH" => "Y",
		"COMPONENT_TEMPLATE" => "register",
		"REQUIRED_FIELDS" => array(
		),
		"SET_TITLE" => "N",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "LAST_NAME",
			3 => "PERSONAL_GENDER",
		),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y"
	),
	false
);?>

	</div>
	</div>
	</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>