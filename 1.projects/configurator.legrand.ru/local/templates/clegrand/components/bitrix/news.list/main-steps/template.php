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


<?foreach($arResult["ITEMS"] as $index => $arItem):?>
  <div class="main-configurator__item">
  	<div class="configurator-item">
  		<div class="configurator-item__top">
  			<?php switch($index): 
				case 0: ?>
					<div class="image-list">
		  				<div class="image-list__track">
		  					<?foreach([1,2,3,4,5,6] as $index => $it):?>
				  				<div class="image-list__item">
				  					<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/animation/1/<?php echo $index + 1 ?>.png" alt="">
								</div>
			  				<?endforeach;?>
			  				<div class="image-list__item">
			  					<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/animation/1/1.png" alt="">
							</div>
		  				</div>
		  			</div>
				<?php break; ?>
				<?php case 1: ?>
					<div class="image-animator">
		  				<?foreach([1,2,3,4,5,6] as $index => $it):?>
			  				<div class="image-animator__item">
			  					<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/animation/2/<?php echo $index + 1 ?>.png" alt="">
							</div>
		  				<?endforeach;?>
		  				<div class="image-animator__item">
		  					<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/animation/2/1.png" alt="">
						</div>
		  			</div>
				<?php break; ?>
				<?php case 2: ?>
					<div class="image-animator-bg">
						<div class="image-animator-bg__switch">
							<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/animation/3/1.png" alt="">
						</div>
						<div class="image-animator-bg__items">
							<?foreach([1,2,3] as $index => $it):?>
				  				<div class="image-animator-bg__item">
				  					<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/animation/3/bg<?php echo $index + 1 ?>.png" alt="">
								</div>
		  					<?endforeach;?>
						</div>
		  			</div>
				<?php break; ?>
				<?php case 3: ?>
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/animation/4/1.png" alt="">
				<?php break; ?>
			<?php endswitch; ?>
  		</div>
  		<div class="configurator-item__bottom">
  			<div class="configurator-item__arrow">
  				<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/main/list/arrow.png" alt="">
  			</div>
  			<div class="configurator-item__content">
  				<div class="configurator-item__num"><?echo $arItem["NAME"]?></div>
  				<div class="configurator-item__desc">
  					<?echo $arItem["PREVIEW_TEXT"];?>
  				</div>
  			</div>
  		</div>
  	</div>
  	<!--   <div class="configurator-item">

 <div class="configurator-item__num"><?echo $arItem["NAME"]?>
                  </div>

    <div class="configurator-item__image">
    	<img src="<?= SITE_TEMPLATE_PATH ?>/img/configurator/animation/<?php echo $index + 1 ?>.gif" alt="" role="presentation"/>
     </div>

  <div class="configurator-item__text">		<?echo $arItem["PREVIEW_TEXT"];?>
                  </div>
				
				<img
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					/>

 	</div> -->
 </div>
<?endforeach;?>


