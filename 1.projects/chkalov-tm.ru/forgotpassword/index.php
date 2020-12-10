<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
?>

<div class="about-us">
    <div class="container">
                    <div class="title"><h1>Восстановление пароля</h1></div>
            <div class="tabs-content" id="page" role="main" itemprop="description">
                            <div class="enter-order">


<?$APPLICATION->IncludeComponent(
	"bitrix:main.auth.forgotpasswd",
	"avia",
	Array(
		"AUTH_AUTH_URL" => "",
		"AUTH_REGISTER_URL" => ""
	)
);?>


            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>