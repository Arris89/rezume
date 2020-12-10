<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>



<div class="basket-wrap basket-order">
    <div class="title"><h2>Вход</h2></div>
    <div class="container">
        <div class="separate-line"></div>
        <div class="container-small">


             <?
             $APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"login", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"FORGOT_PASSWORD_URL" => "/auth/?forgot_password=yes",
		"PROFILE_URL" => "",
		"REGISTER_URL" => "",
		"SHOW_ERRORS" => "Y",
		"COMPONENT_TEMPLATE" => "auth_popup"
	),
	false
);
?>

        </div>
    </div>
</div>



<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>