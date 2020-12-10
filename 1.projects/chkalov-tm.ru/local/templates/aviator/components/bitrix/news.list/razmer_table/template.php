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

$IBLOCK_ID = 14;
    $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y');

    $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);

    while($ar_result = $db_list->GetNext())
    {?>



<div class="sub-title">	<?=$ar_result['NAME']?></div>
<table cellspacing="0" cellpadding="0" class="size-table">
    <tbody>
    <tr>
        <th>Российский</th>
        <th>Европейский</th>
        <th>Обхват талии,см</th>
        <th>Обхват бедер, см</th>
    </tr>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	//$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	//$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>


<?//print_r($arItem);?>
    
<?if   ($arItem['IBLOCK_SECTION_ID']==$ar_result['ID']){?>
    <tr>
        <td><?=$arItem['PROPERTIES']['RF_SIZE']['VALUE']?></td>
        <td><?=$arItem['PROPERTIES']['EU_SIZE']['VALUE']?></td>
        <td><?=$arItem['PROPERTIES']['TALIYA']['VALUE']?></td>
        <td><?=$arItem['PROPERTIES']['BEDRA']['VALUE']?></td>
    </tr>
<?}?>





<?endforeach;?>

</tbody>
</table>

<?}?>