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


	<section class="additional-services">
			<div class="wrapper">
				<div class="additional-services__row flex">

<div class="additional-services__box">
  <div class="additional-services__text">

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

</div>

                             
	<div class="additional-services__table">
		<table>
	<thead>
									<tr>
									    <th>До 10м3</th>
									    <th>от    <? $res = CIBlockElement::GetByID($arResult["ID"]); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("dop1");
  	                             echo $ar_res['VALUE'];
                                  }?> руб.</th>
									</tr>
								</thead>
								<tbody>
								    <tr>
								      	<td>До 50м3</td>
								      	<td>от    <? $res = CIBlockElement::GetByID($arResult["ID"]); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("dop2");
  	                             echo $ar_res['VALUE'];
                                  }?> руб.</td>
								    </tr>
								    <tr>
								      	<td>До 300 м3</td>
								      	<td>от    <? $res = CIBlockElement::GetByID($arResult["ID"]); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("dop3");
  	                             echo $ar_res['VALUE'];
                                  }?> руб.</td>
								    </tr>
								    <tr>
								      	<td>До 1000 м3</td>
								      	<td>от    <? $res = CIBlockElement::GetByID($arResult["ID"]); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("dop4");
  	                             echo $ar_res['VALUE'];
                                  }?> руб.</td>
								    </tr>
								</tbody>
								<tfoot>
								    <tr>
								      	<td>Щебень известняковый<br> 5-20 фракции</td>
								      	<td>   <? $res = CIBlockElement::GetByID($arResult["ID"]); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("dop5");
  	                             echo $ar_res['VALUE'];
                                  }?></td>
								    </tr>
								  </tfoot>


	</table>
	</div>



	
	</div>

	<div class="additional-services__img">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
		
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
		
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	</div>

		</div>
			</div>
		</section>

				<section class="mainform mainform__bottom-space fadeInUp-scroll">
			<div class="wrapper">
				<div class="mainform__row flex">
					<div class="mainform__card">
						<div class="title">Оценка доставки</div>
						<div class="mainform__information">Заполните форму и наш менеджер оперативно свяжется с вами для просчета стоимости работ</div>
					</div>
					<div class="mainform__content">


		

						<?$APPLICATION->IncludeComponent("autospec:main.feedback","dopuslugi",Array(
        "USE_CAPTCHA" => "N",
        "AJAX_MODE"=>"Y",
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "EMAIL_TO" => "leads@as124.ru",
        "REQUIRED_FIELDS" => Array("NAME"),
        "EVENT_MESSAGE_ID" => Array("5")
    )
);?>
					</div>
				</div>
			</div>
		</section>