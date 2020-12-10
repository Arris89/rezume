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

if (! $arResult['ITEMS']) {
    return;
}
?>

<div class="section-collections">
    <div class="section-collections__container container">
        <div class="collections">
            <h1 class="collections__title page-title">
                Коллекции
            </h1>
            
            <ul class="collections__list">
                <?foreach($arResult["ITEMS"] as $arCollection):
                    $this->AddEditAction($arCollection['ID'], $arCollection['EDIT_LINK'], CIBlock::GetArrayByID($arCollection['IBLOCK_ID'], 'ELEMENT_EDIT'));
                    $this->AddDeleteAction($arCollection['ID'], $arCollection['DELETE_LINK'], CIBlock::GetArrayByID($arCollection['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>

                    <li class="collections__item" id="<?= $this->GetEditAreaId($arCollection['ID'])?>">
                        <div class="collections__block">
                            <div class="collections__left">
                                <img src="<?= $arCollection["PREVIEW_PICTURE"]["SRC"]?>" 
                                     alt="<?= $arCollection["PREVIEW_PICTURE"]["ALT"]?>"
                                     title="<?= $arCollection["PREVIEW_PICTURE"]["TITLE"]?>"
                                     role="presentation"
                                />
                            </div>
                            
                            <div class="collections__content">
                                <div class="collections__name">
                                    <a href="<?= $arCollection['DETAIL_PAGE_URL']?>">
                                        <?= $arCollection["NAME"]?>
                                    </a>
                                </div>
                                
                                <div class="collections__item-title">
                                    <?= $arCollection['PROPERTIES']['TEXT']['VALUE']?>
                                </div>
                                
                                <p class="collections__desc">
                                    <?= $arCollection["PREVIEW_TEXT"]?>
                                </p>
                            </div>
                            
                            <a class="collections__right" href="<?= $arCollection['DETAIL_PAGE_URL']?>">
                                <span class="collections__more">
                                    <span class="collections__more-icon">
                                        <span class="icon-circle">
                                            <svg class="icon icon_angle-right">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH?>/svg/sprite/sprite.svg#angle-right"></use>
                                            </svg>
                                        </span>
                                    </span>
                                    
                                    <span class="collections__more-text">
                                        подробнее
                                    </span>
                                </span>
                            </a>
                        </div>
                    </li>
                <?endforeach?>
            </ul>

            <?if ($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                <?= $arResult["NAV_STRING"]?>
            <?endif;?>
        </div>
    </div>
</div>