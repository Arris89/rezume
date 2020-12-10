<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?
//echo '<pre>'; 
//print_r($arResult['PROPERTIES']['GRUZ']['VALUE']);
//echo '<pre>'; 
?>
		<section class="page-services section fadeInUp-scroll">
			<div class="wrapper">
				<div class="page-services__row">
	<div class="page-services__coll">
						<div class="page-services__box">
							<div class="page-services__box-items">
								<div class="chars">

                        <?php if ($arResult['PROPERTIES']['GRUZ']['VALUE']) { ?>
								    <div class="chars__item">
								        <div class="chars__title">
								            <div class="chars__img">
								            	<svg width="23px" height="23px" viewBox="0 0 23 23" version="1.1" xmlns="http://www.w3.org/2000/svg">
												    <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												        <g id="от-1920-деталка-чем-перевозим-автоспец" transform="translate(-110.000000, -448.000000)" fill="#818181" fill-rule="nonzero">
												            <g id="Stacked-Group" transform="translate(-1.000000, 0.000000)">
												                <g id="верх" transform="translate(0.000000, 448.000000)">
												                    <g id="описание" transform="translate(111.000000, 0.000000)">
												                        <path d="M20.355,6.92346939 L15.41,6.92346939 C15.755,6.21938776 15.985,5.51530612 15.985,4.57653061 C15.985,1.99489796 13.915,0 11.5,0 C9.085,0 7.015,1.99489796 7.015,4.57653061 C7.015,5.39795918 7.245,6.21938776 7.59,6.92346939 L2.645,6.92346939 L0,23 L23,23 L20.355,6.92346939 Z M9.2,4.57653061 C9.2,3.28571429 10.235,2.22959184 11.5,2.22959184 C12.765,2.22959184 13.8,3.28571429 13.8,4.57653061 C13.8,5.86734694 12.765,6.92346939 11.5,6.92346939 C10.235,6.92346939 9.2,5.86734694 9.2,4.57653061 Z M2.645,20.7704082 L4.6,9.15306122 L18.4,9.15306122 L20.24,20.6530612 L2.645,20.6530612 L2.645,20.7704082 Z" id="op1"></path>
												                    </g>
												                </g>
												            </g>
												        </g>
												    </g>
												</svg>
								            </div>
								            <div class="chars__name">Грузоподъемность</div>
								        </div>
								        <div class="chars__value">

								        	<? $res = CIBlockElement::GetByID($arResult['ID']); 
                                            while($obRes = $res->GetNextElement())
                                            {
                                            $ar_res = $obRes->GetProperty("GRUZ");
  	                                        echo $ar_res['VALUE'];
                                            }?> 
                              т</div>
								    </div>
                            <? } ?>
                            <?php if ($arResult['PROPERTIES']['OBEM']['VALUE']) { ?>
								    <div class="chars__item">
								        <div class="chars__title">
								            <div class="chars__img">
								            	<svg width="22px" height="24px" viewBox="0 0 22 24" version="1.1" xmlns="http://www.w3.org/2000/svg">
												    <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												        <g id="от-1920-деталка-чем-перевозим-автоспец" transform="translate(-111.000000, -494.000000)" fill="#818181" fill-rule="nonzero">
												            <g id="Stacked-Group" transform="translate(-1.000000, 0.000000)">
												                <g id="верх" transform="translate(0.000000, 448.000000)">
												                    <g id="описание" transform="translate(111.000000, 0.000000)">
												                        <path d="M1.58666667,64.4 L11.472,69.8690909 C11.7946667,70.0436364 12.2053333,70.0436364 12.528,69.8690909 L22.4426667,64.4 C22.7946667,64.1963636 23,63.8472727 23,63.4690909 L23,52.5309091 C23,52.1527273 22.7946667,51.7745455 22.4426667,51.6 L12.5573333,46.1309091 C12.2346667,45.9563636 11.824,45.9563636 11.5013333,46.1309091 L1.58666667,51.6 C1.23466667,51.7745455 1,52.1527273 1,52.5309091 L1,63.44 C1,63.8472727 1.23466667,64.2254545 1.58666667,64.4 Z M20.8293333,62.8 L13.1146667,67.0472727 L13.1146667,58.64 L20.8,54.4218182 L20.8293333,62.8 Z M12.0293333,48.3418182 L19.6853333,52.56 L12.0293333,56.7490909 L4.37333333,52.56 L12.0293333,48.3418182 Z M3.22933333,54.3927273 L10.9146667,58.64 L10.9146667,67.0472727 L3.2,62.8290909 L3.22933333,54.3927273 Z" id="op2"></path>
												                    </g>
												                </g>
												            </g>
												        </g>
												    </g>
												</svg>
								            </div>
								            <div class="chars__name">Объем</div>
								        </div>
								        <div class="chars__value"> 	<? $res = CIBlockElement::GetByID($arResult['ID']); 
                                            while($obRes = $res->GetNextElement())
                                            {
                                            $ar_res = $obRes->GetProperty("OBEM");
  	                                        echo $ar_res['VALUE'];
                                            }?>  м3</div>
								    </div>


                               <? } ?>
                              <?php if ($arResult['PROPERTIES']['DLINA']['VALUE']) { ?>
								    <div class="chars__item">
								        <div class="chars__title">
								            <div class="chars__img">
								            	<svg width="22px" height="15px" viewBox="0 0 22 15" version="1.1" xmlns="http://www.w3.org/2000/svg">
												    <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												        <g id="от-1920-деталка-чем-перевозим-автоспец" transform="translate(-111.000000, -545.000000)" fill="#818181" fill-rule="nonzero">
												            <g id="Stacked-Group" transform="translate(-1.000000, 0.000000)">
												                <g id="верх" transform="translate(0.000000, 448.000000)">
												                    <g id="описание" transform="translate(111.000000, 0.000000)">
												                        <path d="M1,97 L3,97 L3,112 L1,112 L1,97 Z M9,97 L11,97 L11,112 L9,112 L9,97 Z M17,97 L19,97 L19,112 L17,112 L17,97 Z M5,107 L7,107 L7,112 L5,112 L5,107 Z M13,107 L15,107 L15,112 L13,112 L13,107 Z M21,107 L23,107 L23,112 L21,112 L21,107 Z" id="op3"></path>
												                    </g>
												                </g>
												            </g>
												        </g>
												    </g>
												</svg>
								            </div>
								            <div class="chars__name">Длина кузова</div>
								        </div>
								        <div class="chars__value"> 	<? $res = CIBlockElement::GetByID($arResult['ID']); 
                                            while($obRes = $res->GetNextElement())
                                            {
                                            $ar_res = $obRes->GetProperty("DLINA");
  	                                        echo $ar_res['VALUE'];
                                            }?>  м</div>
								    </div>



                            <? } ?>
                            <?php if ($arResult['PROPERTIES']['SHIRINA']['VALUE']) { ?>
								    <div class="chars__item">
								        <div class="chars__title">
								            <div class="chars__img">
								            	<svg width="20px" height="15px" viewBox="0 0 20 15" version="1.1" xmlns="http://www.w3.org/2000/svg">
												    <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												        <g id="от-1920-деталка-чем-перевозим-автоспец" transform="translate(-112.000000, -589.000000)" fill="#818181" fill-rule="nonzero">
												            <g id="Stacked-Group" transform="translate(-1.000000, 0.000000)">
												                <g id="верх" transform="translate(0.000000, 448.000000)">
												                    <g id="описание" transform="translate(111.000000, 0.000000)">
												                        <path d="M3,151 L2,151 L2,149 L2,141 L4,141 L4,149 L20,149 L20,141 L22,141 L22,149 L22,151 L21,151 L21,154 L21,156 L16,156 L16,154 L16,151 L8,151 L8,154 L8,156 L3,156 L3,154 L3,151 Z M5,151 L5,154 L6,154 L6,151 L5,151 Z M18,151 L18,154 L19,154 L19,151 L18,151 Z" id="op4"></path>
												                    </g>
												                </g>
												            </g>
												        </g>
												    </g>
												</svg>
								            </div>
								            <div class="chars__name">Ширина кузова</div>
								        </div>
								        <div class="chars__value"> 	<? $res = CIBlockElement::GetByID($arResult['ID']); 
                                            while($obRes = $res->GetNextElement())
                                            {
                                            $ar_res = $obRes->GetProperty("SHIRINA");
  	                                        echo $ar_res['VALUE'];
                                            }?>    м</div>
								    </div>


                             <? } ?>
                             <?php if ($arResult['PROPERTIES']['VISOTA']['VALUE']) { ?>
								    <div class="chars__item">
								        <div class="chars__title">
								            <div class="chars__img">
								            	<svg width="15px" height="18px" viewBox="0 0 15 18" version="1.1" xmlns="http://www.w3.org/2000/svg">
												    <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												        <g id="от-1920-деталка-чем-перевозим-автоспец" transform="translate(-115.000000, -634.000000)" fill="#818181" fill-rule="nonzero">
												            <g id="Stacked-Group" transform="translate(-1.000000, 0.000000)">
												                <g id="верх" transform="translate(0.000000, 448.000000)">
												                    <g id="описание" transform="translate(111.000000, 0.000000)">
												                        <path d="M9.5,189.5 L11.5,189.5 L11.5,204.5 L9.5,204.5 L9.5,189.5 Z M17.5,189.5 L19.5,189.5 L19.5,204.5 L17.5,204.5 L17.5,189.5 Z M5.5,199.5 L7.5,199.5 L7.5,204.5 L5.5,204.5 L5.5,199.5 Z M13.5,199.5 L15.5,199.5 L15.5,204.5 L13.5,204.5 L13.5,199.5 Z M21.5,199.5 L23.5,199.5 L23.5,204.5 L21.5,204.5 L21.5,199.5 Z" id="op5" transform="translate(12.500000, 197.000000) scale(1, -1) rotate(-270.000000) translate(-12.500000, -197.000000) "></path>
												                    </g>
												                </g>
												            </g>
												        </g>
												    </g>
												</svg>
								            </div>
								            <div class="chars__name">Высота кузова</div>
								        </div>
								        <div class="chars__value"> 	<? $res = CIBlockElement::GetByID($arResult['ID']); 
                                            while($obRes = $res->GetNextElement())
                                            {
                                            $ar_res = $obRes->GetProperty("VISOTA");
  	                                        echo $ar_res['VALUE'];
                                            }?>  м</div>
								    </div>


                               <? } ?>
                              <?php if ($arResult['PROPERTIES']['VMESTIMOST']['VALUE']) { ?>
								    <div class="chars__item">
								        <div class="chars__title">
								            <div class="chars__img"><svg width="22px" height="15px" viewBox="0 0 22 15" version="1.1" xmlns="http://www.w3.org/2000/svg">
											    <g id="1920" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <g id="от-1920-деталка-чем-перевозим-автоспец" transform="translate(-112.000000, -683.000000)" fill="#818181" fill-rule="nonzero">
											            <g id="Stacked-Group" transform="translate(-1.000000, 0.000000)">
											                <g id="верх" transform="translate(0.000000, 448.000000)">
											                    <g id="описание" transform="translate(111.000000, 0.000000)">
											                        <path d="M24,248 L24,250 L14,250 L14,248 L14,247 L16,247 L16,248 L22,248 L22,247 L24,247 L24,248 Z M24,244 L24,246 L14,246 L14,244 L14,243 L16,243 L16,244 L22,244 L22,243 L24,243 L24,244 Z M24,240 L24,242 L14,242 L14,240 L14,239 L16,239 L16,240 L22,240 L22,239 L24,239 L24,240 Z M24,236 L24,238 L14,238 L14,236 L14,235 L16,235 L16,236 L22,236 L22,235 L24,235 L24,236 Z M12,248 L12,250 L2,250 L2,248 L2,247 L4,247 L4,248 L10,248 L10,247 L12,247 L12,248 Z M12,244 L12,246 L2,246 L2,244 L2,243 L4,243 L4,244 L10,244 L10,243 L12,243 L12,244 Z M12,240 L12,242 L2,242 L2,240 L2,239 L4,239 L4,240 L10,240 L10,239 L12,239 L12,240 Z M12,236 L12,238 L2,238 L2,236 L2,235 L4,235 L4,236 L10,236 L10,235 L12,235 L12,236 Z" id="op6" transform="translate(13.000000, 242.500000) rotate(-180.000000) translate(-13.000000, -242.500000) "></path>
											                    </g>
											                </g>
											            </g>
											        </g>
											    </g>
											</svg>
								            </div>
								            <div class="chars__name">Вместимость кузова</div>
								        </div>
								        <div class="chars__value">до  	<? $res = CIBlockElement::GetByID($arResult['ID']); 
                                            while($obRes = $res->GetNextElement())
                                            {
                                            $ar_res = $obRes->GetProperty("VMESTIMOST");
  	                                        echo $ar_res['VALUE'];
                                            }?>  европалет</div>
								    </div>
                                     <? } ?>


								</div>
							</div>
							<div class="page-services__desc">
					

								      <?
                                      $textc = "$arResult[DETAIL_TEXT]";
                                      $kol = mb_strlen($textc);
                                      if ($kol > 180)
                                      {
                                      $tc = substr("$textc", 0, 180);
                                      $tc2 = substr("$textc", 180);
                                  	  echo '<div class="page-services__text">'.$tc. '<span class="page-services__hidden">';
                                      echo $tc2.'</span> </div>
                                      <a href="javascript:void(0)" class="page-services__link">раскрыть полностью</a>';
                                      }
                                      else
	                                  {  echo '<div class="page-services__text">'.$textc.'</div>'; }
                                      ?>
							</div>
						</div>
					</div>






	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
	<?=$arResult["NAME"]?>
	<?endif;?>

	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?>
	<?endif;?>

	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>



	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?>
	<?endforeach;

	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>

	<?endforeach;?>

			<div class="page-services__content">
						<div class="page-services__column">
							<div class="page-services__gallery">
								<div class="block-img block-img_items">
									

	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
	
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>





								</div>

								<div class="page-services__gallery-row">


<?

    $VALUES = array();
    $res = CIBlockElement::GetProperty('31', $arResult['ID'], "sort", "asc", array("CODE" => "DOPFOTO"));
    while ($ob = $res->GetNext())

    {
        $VALUES[] = $ob['VALUE'];  
    }

   foreach ($VALUES as $key => $valuedocs) 
  {
    $rsFile = CFile::GetByID($valuedocs);
        $arFile = $rsFile->Fetch();

      $href = "upload/".$arFile['SUBDIR']."/".$arFile['FILE_NAME'].""; 


   ?>
   

	<a href="/<?=$href?>" class="page-services__img" data-fancybox="gallery">
										<img src="/<?=$href?>" alt="">
									</a>


       <?}?>

								</div>
								
							</div>
							<div class="page-services__card">
								<div class="card__items">
									<a href="#" class="btn btn-special" id="chem_detail" value="<?=$arResult['NAME']?>">Заказать</a>
									<div class="card__price">от <? $res = CIBlockElement::GetByID($arResult['ID']); 
                                            while($obRes = $res->GetNextElement())
                                            {
                                            $ar_res = $obRes->GetProperty("STOIMOST");
  	                                        echo $ar_res['VALUE'];
                                            }?> руб./ч</div>
								</div>
								<div class="card__desc">Точную стоимость уточняйте у менеджера.<br> Возможны скидки и индивидуальные условия.</div>
							</div>
						</div>
						<div class="page-services__column">
							<div class="page-services__item">
								<ul>

   	                          <? $res = CIBlockElement::GetByID($arResult['ID']);
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("PREM");
                                 foreach ($ar_res['VALUE'] as $key => $value) {
  	                             echo '<li>'.$value.'</li>';
                                  }
                                  }?>

								
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</section>


<!-- mainform -->	
		<section class="mainform section fadeInUp-scroll">
			<div class="wrapper">
				<div class="mainform__row flex">
					<div class="mainform__card">

   <?$APPLICATION->IncludeFile(SITE_DIR."include/dostavka.php", Array(), Array(
													"MODE" => "html",
													"NAME" => "Text in title",
												)
											);?>


						<div class="mainform__phone">
							<a href="tel:+73912729279" class="mainform__number">+7 391 27-29-279</a>
							<a href="#" class="mainform__callback btn-callback">заказать звонок</a>
						</div>
					</div>
					<div class="mainform__content">
						<div class="mainform__top">
							<div class="mainform__coll mainform__coll_active" data-tab="1">
								<div class="mainform__numeral">1</div>
								<div class="mainform__desc">Маршрут<br> движения</div>
							</div>
							<div class="mainform__coll" data-tab="2">
								<div class="mainform__numeral">2</div>
								<div class="mainform__desc">Информация<br> о грузе</div>
							</div>
							<div class="mainform__coll" data-tab="3">
								<div class="mainform__numeral">3</div>
								<div class="mainform__desc">Личные<br> данные</div>
							</div>
						</div>

						<?$APPLICATION->IncludeComponent(
	"autospec:main.feedback", 
	"ocenka", 
	array(
		"USE_CAPTCHA" => "N",
		"AJAX_MODE"=>"Y",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "my@email.com",
		"REQUIRED_FIELDS" => array(
			0 => "NONE",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"COMPONENT_TEMPLATE" => "ocenka"
	),
	false
);?>
					</div>
				</div>
			</div>
		</section>
	<!-- mainform END -->





                 <? $res = CIBlockElement::GetByID($arResult['ID']); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("INTERES"); 
                                 foreach ($ar_res['VALUE'] as $key => $int) {
                                 	$filteint2[] = $int;
                                 }
                                  }?>
	                           
		
<?


$GLOBALS['interes'] = array('ID' => $filteint2);

if ($filteint2) {


$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"interes", 
	array(
		"USE_FILTER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "chemperevozim",
		"IBLOCK_ID" => "31",
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "TIMESTAMP_X",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "interes",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "logo",
		"STRICT_SECTION_CHECK" => "N",
		"FILE_404" => ""
	),
	false
);

}

?>
	