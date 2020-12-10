<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>

<?


foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
if($arItem['PARAMS']['color']=='new')
{?>	

		<div class="nav__item nav__item_active">
		 	<a href="<?=$arItem["LINK"]?>">
		 		<span><?=$arItem["TEXT"]?></span>
		 	</a>  
		 </div>

<?}

else

{?>

		 <div class="nav__item">
		 	<a href="<?=$arItem["LINK"]?>">
		 		<?=$arItem["TEXT"]?>
		 		</a>  
		 	</div>

	<?
}

	?>
<?endforeach?>
<?endif?>