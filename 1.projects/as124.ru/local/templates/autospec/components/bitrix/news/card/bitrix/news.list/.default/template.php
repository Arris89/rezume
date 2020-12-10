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
		<section class="page-card section">

			<div class="wrapper">

				<div class="page-card__row">

<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="card fadeInUp-scroll">

<div class="card__caption"><?echo $arItem["NAME"]?>	</div>
	<div class="card__row">


	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>





				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card__img">
					<img
				
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
			
						/>
					</a>
		
		
<div class="card__coll">


                              <div class="chars">
                                 <div class="chars__item">
								        <div class="chars__title chars__title_items">
								            <div class="chars__name">Масса</div>
								        </div>
								        <div class="chars__value">
										        <? $res = CIBlockElement::GetByID($arItem['ID']); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("ARMASSA");
                                 
  	                             echo $ar_res['VALUE'];
                               
                                  }?> т</div>
								    </div>
                                   <div class="chars__item">
								        <div class="chars__title chars__title_items">
								            <div class="chars__name">Объем ковша</div>
								        </div>
								        <div class="chars__value"><? $res = CIBlockElement::GetByID($arItem['ID']); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("ARKOVSH");
                                 
  	                             echo $ar_res['VALUE'];
                               
                                  }?> м3</div>
								    </div>
	                                <div class="chars__item">
								        <div class="chars__title chars__title_items">
								            <div class="chars__name">Скорость вращения поворотного мотора</div>
								        </div>
								        <div class="chars__value"><? $res = CIBlockElement::GetByID($arItem['ID']); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("ARSPEEDPOV");
                                 
  	                             echo $ar_res['VALUE'];
                               
                                  }?> м</div>
								    </div>
	                             </div>

	                             		<div class="card__items">
									<a href="#" class="btn btn-special">Заказать</a>
									<div class="card__price">от <?echo $arItem["PREVIEW_TEXT"];?> руб./ч</div>
								</div>
								<div class="card__desc">Точную стоимость уточняйте у менеджера.<br> Возможны скидки и индивидуальные условия.</div>

	


	

<!-- 
		<?foreach($arItem["FIELDS"] as $code=>$value):?>

			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>

		<?endforeach;?>

		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
	
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>

		<?endforeach;?> -->



	       </div>
		</div>
	</div>
<?endforeach;?>


		</div>


			</div>
		</section>
