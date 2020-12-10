<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?><div class="contacts">
	<div class="container">
		<div class="title">
			<h1>Контакты</h1>
		</div>
		<div class="tabs-content" id="page" role="main" itemprop="description">
			<div class="contacts-left">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
Array()
);?>
			</div>
			<p>
 <br>
			</p>
			<div class="contacts-right">
				<div class="title">
					<h2>Написать нам</h2>
				</div>
				<div class="contact-us">
					 <?$APPLICATION->IncludeComponent(
	"avia:main.feedback",
	"kontakty",
	Array(
		"AJAX_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "kontakty",
		"EMAIL_TO" => "vixodtam@mail.ru",
		"EVENT_MESSAGE_ID" => array(0=>"7",),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(0=>"NAME",1=>"EMAIL",),
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_CAPTCHA" => "Y"
	)
);?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="map-wrap">
	<div id="map" style="position: relative; overflow: hidden;">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	".default",
	Array(
		"API_KEY" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"CONTROLS" => array(0=>"ZOOM",),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:5:{s:10:
            \"yandex_lat\";d:54.707337846253914;s:10:
            \"yandex_lon\";d:20.578642461221364;s:12:
            \"yandex_scale\";i:16;s:10:
            \"PLACEMARKS\";a:1:{i:0;a:3:{s:3:
            \"LON\";d:20.5829274251;s:3:
            \"LAT\";d:54.7078476116;s:4:
            \"TEXT\";s:100:\"ООО \"1С-Битрикс\", г. Калининград, Московский проспект, 261.\";}}s:9:
            \"POLYLINES\";a:1:{i:0;a:3:{s:6:
            \"POINTS\";a:2:{i:0;a:2:{s:3:
            \"LAT\";d:54.707748780049165;s:3:
            \"LON\";d:20.577995674216798;}i:1;a:2:{s:3:
            \"LAT\";d:54.70704134712057;s:3:
            \"LON\";d:20.583708959423795;}}s:5:
            \"TITLE\";s:37:\"Московский проспект\";s:5:
            \"STYLE\";a:1:{s:9:
            \"lineStyle\";a:2:{s:11:
            \"strokeColor\";s:8:
            \"FFFF007F\";s:11:
            \"strokeWidth\";i:3;}}}}}",
		"MAP_HEIGHT" => "480",
		"MAP_ID" => "yam_1",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",)
	)
);?>
	</div>
</div>
 &nbsp;<br>
<div class="product-wrap">
	<div class="container">
		<div class="main-recommended-wrap in-product" data-listname="Рекомендуемые товары в карточке товара">
		</div>
	</div>
</div>
 


<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>