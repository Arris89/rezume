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

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
          $img = CFile::GetFileArray($arItem['PROPERTIES']['LOGO']['VALUE']);  ?>

<tr class="store-small" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<td class="logo">
						<div class="store-image">
							<img src="<?=$img['SRC']?>" alt="<?=$arItem["NAME"]?>" width="125" height="125">
						</div>
					</td>
					<td class="name">
						<?=$arItem["NAME"]?>
					</td>
		            <td class="address">
		         		<?=htmlspecialcharsBack($arItem['PROPERTIES']['ADRESS']['VALUE']['TEXT'])?>								
					</td>
		            <td class="store-hours">		
						<?=htmlspecialcharsBack($arItem['PROPERTIES']['TIME']['VALUE']['TEXT'])?>	
		            </td>
				</tr>

<?endforeach;?>




