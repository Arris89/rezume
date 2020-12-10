<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");

?>


<!-- contacts -->   
        <section class="contacts section">
            <div class="wrapper">
                <div class="contacts__row flex">
                    <div class="contacts__column">

                         <?$APPLICATION->IncludeFile(SITE_DIR."include/contacts.php", Array(), Array(
                                                    "MODE" => "html",
                                                    "NAME" => "Text in title",
                                                )
                                            );?>

                        <h2 class="contacts__caption contacts__caption_top">Реквизиты</h2>

                         <?$APPLICATION->IncludeFile(SITE_DIR."include/rekvizit.php", Array(), Array(
                                                    "MODE" => "html",
                                                    "NAME" => "Text in title",
                                                )
                                            );?>

                        <a href="/upload/rec.pdf" target="_blank" class="mainlink mainlink_top" download="Реквизиты Автоспец.pdf">
                            <div class="mainlink__icons">
                                <svg width="16px" height="20px" viewBox="0 0 16 20" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="от-1920-о-компании-автоспец" transform="translate(-827.000000, -1120.000000)" fill="#9E0000">
                                            <g id="Stacked-Group">
                                                <g id="доки" transform="translate(0.000000, 1032.000000)">
                                                    <path d="M829,88 C827.9,88 827,88.9 827,90 L827,106 C827,107.1 827.9,108 829,108 L841,108 C842.1,108 843,107.1 843,106 L843,94 L837,88 L829,88 L829,88 Z M836,96 L836,90 L842,96 L836,96 L836,96 Z" id="Shape-Copy-3"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                           <div class="mainlink__title">Реквизиты</div>
                            <div class="mainlink__value">pdf, 
                                <? 
                                $rec = filesize($_SERVER['DOCUMENT_ROOT'].'/upload/rec.pdf');
                                $rec1 = $rec/1024;
                                echo  ceil($rec1);
                                ?> 

                            kb</div>
                                            

                        </a>  

                    </div>


                    
                    <div class="contacts__form">

                        <?$APPLICATION->IncludeComponent(
	"autospec:main.feedback", 
	"contacts", 
	array(
		"USE_CAPTCHA" => "N",
         "AJAX_MODE"=>"Y",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "leads@as124.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"COMPONENT_TEMPLATE" => "contacts",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y"
	),
	false
);?>
                    </div>
                </div>
            </div>
        </section>
    <!-- contacts END -->





    <!-- map -->

    <section class="map fadeInUp-scroll">
 <div class="map__items">

        <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:56.03166912343455;s:10:\"yandex_lon\";d:92.87919257539332;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:92.879675373016;s:3:\"LAT\";d:56.03236595049;s:4:\"TEXT\";s:0:\"\";}}}",
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "450",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "SMALLZOOM",
			2 => "SCALELINE",
		),
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "yam_1",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

      </div>
 </section> 
    <!-- map END -->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>