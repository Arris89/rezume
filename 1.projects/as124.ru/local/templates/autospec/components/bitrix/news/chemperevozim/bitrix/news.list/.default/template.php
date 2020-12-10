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
	<!-- service -->	
		<section class="service section">
			<div class="wrapper">
				<div class="service__row flex">
					<div class="sidebar">
						<ul>
							<li>
                                 <? if($APPLICATION->GetCurPage(false) == 'http://autospec/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=16&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y'){?>
                                 	<a href="/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=16&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y" class="active">Бортовые</a>
                                 <? } else { ?>

								<a href="/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=16&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y">Бортовые</a>
                                 <? } ?>

							</li>
							<li>
     <? if($APPLICATION->GetCurPage(false) !== '/'):?>
                             
                                 <? endif; ?>

								<a href="/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=17&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y">Изотермические</a>


							</li>
							<li>
     <? if($APPLICATION->GetCurPage(false) !== '/'):?>
                            
                                 <? endif; ?>

								<a href="/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=18&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y">Рефрижераторы</a>


							</li>
						<li>
     <? if($APPLICATION->GetCurPage(false) !== '/'):?>
                        
                                 <? endif; ?>

								<a href="/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=19&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y">Тентовые</a>


							</li>
						</ul>
					</div>

<script>





if (location.href=='http://autospec/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=16&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y')

	{
$("a[href^='/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=16&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y']").addClass("active");
	}

	if (location.href=='http://autospec/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=17&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y')
	{
$("a[href^='/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=17&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y']").addClass("active");
	}


	if (location.href=='http://autospec/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=18&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y')
	{
$("a[href^='/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=18&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y']").addClass("active");
	}

	if (location.href=='http://autospec/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=19&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y')
	{
$("a[href^='/chem-perevozim/?bitrix_include_areas=N&arrFilter_pf%5BRAZDEL%5D=19&set_filter=%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80&set_filter=Y']").addClass("active");
	}




</script>



<div class="service__coll">
		<div class="service__card">



<?foreach($arResult["ITEMS"] as $arItem):?>

	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

		<div class="card card_block fadeInUp-scroll">
                               <div class="card__caption">
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span>	<?echo $arItem["NAME"]?></span></a>
								</div>
                 <div class="card__row card__row_items">


		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>


				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card__img card__img_items">
					<img
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					
						/></a>
			<?else:?>
				<img
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
			
					/>
			<?endif;?>
		<?endif?>

	<div class="card__coll card__coll_items">
										<div class="chars">

											    <?php if ($arItem['PROPERTIES']['GRUZ']['VALUE']) { ?>
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

										        <? $res = CIBlockElement::GetByID($arItem['ID']); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("GRUZ");
                                 
  	                             echo $ar_res['VALUE'];
                               
                                  }?> т</div>
										    </div>
                                             <?php } ?>
                                               <?php if ($arItem['PROPERTIES']['OBEM']['VALUE']) { ?>
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
										        <div class="chars__value">			        <? $res = CIBlockElement::GetByID($arItem['ID']); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("OBEM");
                                 
  	                             echo $ar_res['VALUE'];
                               
                                  }?> 


										        м3</div>
										    </div>
										<?php } ?>
								         </div>

										<div class="card__items">
											<a href="#" id="perevoz_list" value="<?=$arItem['NAME']?>" class="btn btn-truck">Заказать</a>
											<div class="card__price">от <? $res = CIBlockElement::GetByID($arItem['ID']); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("STOIMOST");
                                 
  	                             echo $ar_res['VALUE'];
                               
                                  }?>  руб./ч</div>
										</div>
										<div class="card__desc">Точную стоимость уточняйте у менеджера.<br> Возможны скидки и индивидуальные условия.</div>
									</div>
								</div>
							</div>





		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
		<?endforeach;?>









<?endforeach;?>






			<div class="pagination fadeInUp-scroll">
							<div class="pagination-list">




								<?=$arResult["NAV_STRING"]?>
								


								
							</div>
						</div>


</div>
			</div>
			</div>
		</section>