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

if (! $arResult['ITEMS']) return;
?>

<?foreach($arResult['ITEMS'] as $arCollection):?>

    <div class="main-collection__item">
        <div class="collection-item">
            <div class="collection-item__image">
                <img src="<?= $arCollection['PREVIEW_PICTURE']['SRC']?>" role="presentation"/>

                <div class="collection-item__head">
                    <div class="collection-item__title">
                        <?= $arCollection['PROPERTIES']['TEXT']['VALUE']?>
                    </div>
                </div>
            </div>

            <a class="collection-item__name" href="<?= $arCollection['DETAIL_PAGE_URL']?>">
                Коллекция <?= $arCollection['NAME']?>
            </a>

            <?= $arCollection['PREVIEW_TEXT']?>

            <div class="collection-item__bottom">
                <a class="btn-readmore"
                   href="<?= $arCollection['DETAIL_PAGE_URL']?>"
                >
                    <span class="btn-readmore__icon">
                        <span class="angle-right"></span>
                    </span>
                    Узнать подробнее
                </a>
            </div>
        </div>
    </div>
<?endforeach?>


