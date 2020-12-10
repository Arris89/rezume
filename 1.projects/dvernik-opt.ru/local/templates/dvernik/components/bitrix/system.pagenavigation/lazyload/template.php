<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->createFrame()->begin("Загрузка навигации");
?>
<? if ($arResult["NavPageCount"] > 1): ?>
    <? if ($arResult["NavPageNomer"] + 1 <= $arResult["nEndPage"]): ?>
        <?
        $plus = $arResult["NavPageNomer"] + 1;
        $url = $arResult["sUrlPathParams"] . "PAGEN_" . $arResult["NavNum"] . "=" . $plus;
        ?>
        <div class="view-controls__more-btn">
            <button class="btn btn_type_link" id="doplist" type="button" data-url="<?= $url ?>">Показать еще</button>
        </div>
    <? endif ?>
<? endif ?>


 


         