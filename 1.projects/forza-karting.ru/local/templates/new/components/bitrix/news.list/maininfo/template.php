<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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


<div class="row align-items-stretch">
    <div class="col-md-6 col-12">
        <div class="main-academy-item">
            <div class="main-academy-icon">
                <svg>
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#main-academy-1"></use>
                </svg>
            </div>
            <div class="main-academy-text"><span>Записаться в школу можно на любом этапе. Группы сформированы таким образом, чтобы дети попадали на обучение со своими сверстниками и схожими навыками.</span>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-12">
        <div class="main-academy-item">
            <div class="main-academy-icon">
                <svg>
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#main-academy-2"></use>
                </svg>
            </div>
            <div class="main-academy-text"><span>Минимальный возраст принимаемых учеников от 6 лет при росте выше 123 см. и до 15 лет. Для учеников старше 15 лет действует вечерняя школа по будням*.</span>
            </div>
        </div>
    </div>
</div>


<? foreach ($arResult["ITEMS"] as $arItem): ?>

    <div class="col-md-6 col-12">
        <div class="main-academy-item">
            <div class="main-academy-icon">
                <svg>

                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#main-academy-2"></use>

                </svg>
            </div>
            <div class="main-academy-text"><span><? echo $arItem["PREVIEW_TEXT"]; ?></span></div>
        </div>
    </div>


    <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>

        <?= $arProperty["NAME"] ?>:&nbsp;
        <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
            <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
        <? else: ?>
            <?= $arProperty["DISPLAY_VALUE"]; ?>
        <? endif ?>

    <? endforeach; ?>


<? endforeach; ?>


