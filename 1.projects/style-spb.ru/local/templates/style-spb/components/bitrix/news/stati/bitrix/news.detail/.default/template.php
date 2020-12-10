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


<div class="rte">
		
		<h1><?=$arResult["NAME"]?></h1>

<?echo $arResult["DETAIL_TEXT"];?>

<br><br>
<p>

<!-- 	← <a href="">предыдущая статья</a><span style="float: right;"><a href="">следующая статья</a> →</span> -->
		

<?$rs=CIBlockElement::GetList(
	array("ID" => "acs"), 
	array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"]), 
	false, 
	array("nElementID"=>$arResult["ID"], "nPageSize"=>1), 
	array("ID","CODE")
							);
while($ar=$rs->GetNext())
{ 
	$page[] = $ar["CODE"]; 
}?>

<?if (count($page) == 2 && $arResult["ID"] == $page[0]):?>
← <a href="/content/<?=$page[1]?>/">Предыдущая</a>

<?elseif (count($page) == 3):?>

← <a href="/content/<?=$page[2]?>/">Предыдущая</a>

<span style="float: right;"><a href=""><a href="/content/<?=$page[0]?>/">Следующая</a> →</span>

<?elseif (count($page) == 2 && $arResult["ID"] == $page[1]):?>
<span style="float: right;"><a href=""><a href="/content/<?=$page[0]?>/">Следующая</a> →</span>
<?endif;?>  

	</p></div>