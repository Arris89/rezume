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
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/display.css" type="text/css" media="all"/>
<div id="productlookbooks-slider-wrapper">
    <div id="productlookbooks-slider">

<div id="productlookbooks-slider-presentation" style="width: 990px;"> 
<div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">

    <style type="text/css">
    	.center {
  width: 900px;
  margin: 30px auto;
  overflow: hidden;
  margin-bottom: 45px;
}
.center-item {
  background: #aaa;
  border: 1px solid #fff;
}
.slick-prev {
     top: 530px;
}
.slick-next {
left: 100 px;
}

.sldbtn.prev{

    background: rgba(255,255,255,0.3);
    border: 1px solid;
    border-color: inherit;
    width: 40px;
    height: 40px;
    line-height: 40px;
    color: black;
    position: absolute;
    top: 505px;
}
.sldbtn.next{

    background: rgba(255,255,255,0.3);
    border: 1px solid;
    border-color: inherit;
    width: 40px;
    height: 40px;
    line-height: 40px;
    color: black;
    position: absolute;
    left: 100px;
    top: 505px;
}

.slick-track {display: flex;} /*одинаковая высота слайдов*/

 </style>

<div class="center">
<?

foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $value) {

		$rsFile = CFile::GetByID($value);
        $arFile = $rsFile->Fetch();      
       	$href = "upload/".$arFile['SUBDIR']."/".$arFile['FILE_NAME']."";

	?>
	<img src="/<?=$href?>" alt="" class="slide" height="500" width="auto">
<?}?>

</div>
</div>
</div>

</div></div>

<div id="productlookbooks-slider-products" style="width: 180px; height: 260px; bottom: 530px;">
                                    <div class="productlookbooks-slider-product-wrap" data-id="1" style="transition: opacity 250ms ease 0s, visibility 250ms ease 0s; visibility: visible; opacity: 1; z-index: 10;">

					<? $j = 0;
								$IDcat = \IbHelp\Helper::getIblockIdByCodes('clothes')["clothes"];
                                    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "CATALOG_PRICE_1");
                                    $arFilter = Array("IBLOCK_ID"=> $IDcat, "ACTIVE"=>"Y", "ID"=> $arResult['PROPERTIES']['ITEMS']['VALUE']);
                                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                                    while($ob = $res->GetNextElement())
                                    {
                                        $arFields = $ob->GetFields();

						$arProps1 = $ob->GetProperties();

						$rsFile1 = CFile::GetByID($arProps1['MORE_PHOTO']['VALUE'][0]);
        				$arFile1 = $rsFile1->Fetch();      
       					$href1 = "upload/".$arFile1['SUBDIR']."/".$arFile1['FILE_NAME']."";

       					$mas[$j]['NAME'] = $arFields['NAME'];
       					$mas[$j]['PRICE'] = $arFields['CATALOG_PRICE_1'];
       					$mas[$j]['PICTURE'] = $href1;
       					$mas[$j]['URL'] = $arFields['DETAIL_PAGE_URL'];
                                 $j++;   }

foreach ($mas as $key2 => $value2) {?>
	                   <div class="productlookbooks-slider-product ">
                                <div class="productlookbooks-slider-product-image-wrap">
  				<img class="productlookbooks-slider-product-image" src="/<?=$value2['PICTURE']?>" alt="<?=$value2['NAME']?>" title="<?=$value2['NAME']?>" itemprop="image">
                                </div>

                                <div class="productlookbooks-slider-product-name"><?=$value2['NAME']?></div>

                                    <div class="productlookbooks-slider-product-price-wrap">
                                        <div class="productlookbooks-slider-product-price"><?=$value2['PRICE']?> руб</div>
                                    </div>
               
     			<a class="productlookbooks-slider-product-overlay" href="<?=$value2['URL']?>" rel="<?=$value2['URL']?>" target="_blank">
                                    <span class="productlookbooks-slider-product-overlay-button">Посмотреть</span>
                                </a>
                            </div>
					<?}?>
                        </div>
                 </div>

  <script>
  	$(document).ready(function () {
$('.center').slick({
  centerMode: true,
  centerPadding: '60px',
  variableWidth: true,
  slidesToShow: 1,
  prevArrow: '<button type="button" data-direction="prev" class="sldbtn prev"><i class="icon-chevron-left"></i></button>',
  nextArrow: '<button type="button" data-direction="next" class="sldbtn next"><i class="icon-chevron-right"></i></button>',
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
});
  </script>