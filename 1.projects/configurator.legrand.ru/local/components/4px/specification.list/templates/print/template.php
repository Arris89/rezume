<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<style>
    table {
        border-collapse: collapse;
        line-height: 1.1; }
    table td, table th {
        border: 1px solid #9da7b1;
        padding: 10px;
        text-align: center; }
</style>

<div class="container">

    <?if ($_REQUEST['print'] == 'pdf'):?>
        <div style="margin: 50px 0;">
            <img alt="Legrand" src="/local/templates/clegrand/img/logo/logo@2x.png">
        </div>
    <?endif?>

    <?if (count($arResult['CURRENT_USER']) > 0):?>
        <h2>Контактная информация</h2>
        <br>
        <p><strong>Имя:</strong> <?= $arResult['CURRENT_USER']['NAME']?></p>
        <p><strong>Email:</strong> <?= $arResult['CURRENT_USER']['EMAIL']?></p>
        <br>
    <?endif?>

    <h2>Спецификация</h2>
    <br>
    <table width="100%">
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
            <?foreach ($arResult['ITEMS_RESPONSE'] as $arItem):
                $sumPrice += $arItem['countPrice'];
                $sumPrice = round($sumPrice, 2);
                ?>
                <tr>
                    <td>
                        <?= $arItem['articul']?>
                    </td>
                    <td>
                        <?= $arItem['title']?>
                    </td>
                    <td>
                        <?= $arItem['price']?>
                    </td>
                    <td>
                        <?= $arItem['count']?>
                    </td>
                    <td>
                        <?= $arItem['countPrice']?>
                    </td>
                </tr>
            <?endforeach?>

            <tr>
                <td colspan="5" style="font-size: 30px; font-weight: bold; text-align: right;">
                    Сумма заказа: <?= $sumPrice?> руб
                    <div style="font-size: 12px; font-weight: normal;">
                        Стоимость продукции носит исключительно справочный характер,
                        <br>конечная цена в магазине партнера может
                        отличаться.
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>