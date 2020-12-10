<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<style>
    table {
        border-collapse: collapse;
        line-height: 1.1; }
    table td, table th {
        border: 1px solid #9da7b1;
        padding: 10px;
        text-align: center; }

    .text-light {
        color: #9da7b1; }
</style>
<div class="container">
    <h2>Заказ № <?= $arResult['ID'] ?> от <?= $arResult['DATE_INSERT_FORMATED'] ?></h2>
    <br>
    <table>
        <thead>
        <tr>
            <th>Кат.&nbsp;№</th>
            <th>Название</th>
            <th>Цена с НДС</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
        </thead>

        <tbody>

        <? foreach ($arResult['BASKET'] as $arComp) { ?>

            <tr>
                <td colspan="5" style="text-align: left; background-color: rgba(149, 184, 255, 0.35);">
                    <strong>
                        <?= $arComp['NAME'] ?>
                    </strong>
                </td>
            </tr>
            <? foreach ($arComp['ITEMS'] as $arItem) { ?>
                <tr>
                    <td><?= $arItem['PROPS']['ARTICUL']['VALUE']?></td>
                    <td style="text-align: left;"><?= $arItem['NAME_FULL'] ?></td>
                    <td><?= $arItem['PRICE'] ?></td>
                    <td><?= $arItem['QUANTITY']?></td>
                    <td><?= $arItem['SUM_FORMATED']?> руб</td>
                </tr>
                <?if($arItem['PROPS']['MEX']){?>
                    <tr class="text-light">
                        <td colspan="5" style="text-align: left;">
                            <strong>
                                Состав:
                            </strong>
                        </td>
                    </tr>
                    <?foreach ($arItem['PROPS']['MEX']['VALUE'] as $arMex){?>
                        <tr class="text-light">
                            <td><?=$arMex['ARTICUL']?></td>
                            <td style="text-align: left;"><?= $arMex['NAME']?></td>
                            <td><?= $arMex['PRICE_FORMATED']?> руб.</td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?}?>
                <?}?>
            <?}?>
            <tr>
                <td colspan="5" style="text-align: right;">
                    <strong>
                        Сумма за комплект: <?= $arComp['SUM_FORMATED'] ?> руб
                    </strong>
                </td>
            </tr>
        <?}?>
        <tr>
            <td colspan="5" style="font-size: 30px; font-weight: bold; text-align: right;">
                Сумма заказа: <?= $arResult['PRICE_FORMATED']?>
                <div style="font-size: 12px; font-weight: normal;">
                    <br>
                    Стоимость продукции носит исключительно справочный характер,
                    <br>конечная цена в магазине партнера может
                    отличаться.
                </div>
            </td>
        </tr>

        </tbody>
    </table>
</div>