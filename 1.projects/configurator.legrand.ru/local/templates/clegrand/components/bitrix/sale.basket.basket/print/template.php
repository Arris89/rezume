<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Grid\Declension;
$postDeclension = new Declension('пост', 'поста', 'постов');
?>
<style>
    table {
        width: 100%;
        font-size: 16px;
        border-collapse: collapse;
        line-height: 1.1; }
    table td, table th {
        border: 1px solid #9da7b1;
        padding: 10px;
        text-align: center; }
    .text-light {
        font-size: 14px;
        color: #9da7b1; }
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

    <h2>Состав проекта</h2>
    <br>
    <table>
        <thead>
            <tr>
                <th width="15%">Кат.&nbsp;№</th>
                <th width="45%">Название</th>
                <th width="15%">Цена</th>
                <th width="10%">Кол-во</th>
                <th width="15%">Сумма</th>
            </tr>
        </thead>

        <tbody>
        <?
        $allSum = 0;
        foreach ($arResult['COMPLECTATIONS_ITEMS'] as $complectName => $arProduct):
            if (stripos($complectName, 'comptimelab') !== false) {
                $complectName = strstr($complectName, 'comptimelab', true);
                $complectName = 'Комплект ' . $complectName;
            }
            $allSumComplect = 0;
            ?>

            <tr>
                <td colspan="5" style="text-align: left; background-color: rgba(149, 184, 255, 0.35);">
                    <strong>
                        <?= $complectName?>
                    </strong>
                </td>
            </tr>

            <?
            foreach ($arProduct as $product):
                $productName = $product['NAME'].', цвет '. $product['PROPERTY_FUNCTION_COLOR_VALUE'];
                if ($product['PROPERTY_SECTION_CODE_VALUE'] === 'FRAME') {
                    $productName = 'Рамка ('.$product['PROPERTY_COLLECTION_VALUE'].'), цвет '.$product['PROPERTY_FRAME_COLOR_VALUE'].', '.$product['PROPERTY_FRAME_COUNT_FUNCTION_VALUE'].' '.$postDeclension->get($product['PROPERTY_FRAME_COUNT_FUNCTION_VALUE']);
                }

                $allSumComplect += $product['SUM_BASE_CUSTOM_PRICE'];
                $allSum += $product['SUM_BASE_CUSTOM_PRICE'];
                ?>
                <tr>
                    <td>
                        <strong>
                            <?= $product['PROPERTY_ARTICUL_VALUE']?>
                        </strong>
                    </td>
                    <td style="text-align: left;">
                        <strong>
                            <?= $productName?>
                        </strong>
                    </td>
                    <td>
                        <?= number_format($product['BASE_CUSTOM_PRICE'], 2, ',', ' ')?>
                    </td>
                    <td>
                        <?= $product['QUANTITY']?>
                    </td>
                    <td>
                        <?= number_format($product['SUM_BASE_CUSTOM_PRICE'], 2, ',', ' ')?>
                    </td>
                </tr>
                <?if ($product['PROPERTY_SECTION_CODE_VALUE'] === 'FUNCTION' && count($product['MECHANISM_FOR_FUNCTION']) > 0):?>
                    <tr class="text-light">
                        <td colspan="5" style="text-align: left;">
                            <strong>
                                Состав:
                            </strong>
                        </td>
                    </tr>

                    <?foreach ($product['MECHANISM_FOR_FUNCTION'] as $arAccessories):?>
                        <tr class="text-light">
                            <td>
                                <?= $arAccessories['ARTICUL']?>
                            </td>

                            <td style="text-align: left;">
                                <?= $arAccessories['NAME']?>
                            </td>

                            <td>
                                <?= number_format($arAccessories['BASE_PRICE'], 2, ',', ' ')?>
                            </td>

                            <td>
                                <?= $arAccessories['QUANTITY']?>
                            </td>

                            <td>
                                <?= number_format($arAccessories['SUM_BASE_PRICE'], 2, ',', ' ')?>
                            </td>
                        </tr>
                    <?endforeach?>
                <?endif?>

                <?if ($complectName === 'Товары без комплекта'):?>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                <?endif?>
            <?endforeach?>

            <?if ($complectName !== 'Товары без комплекта'):?>
                <tr>
                    <td colspan="5" style="text-align: right;">
                        <strong>
                            Сумма за комплект: <?= number_format($allSumComplect, 2, ',', ' ')?> руб
                        </strong>
                    </td>
                </tr>
            <?endif?>
        <?endforeach?>

        <tr>
            <td colspan="5" style="font-size: 30px; font-weight: bold; text-align: right;">
                Сумма заказа: <?= number_format($allSum, 2, ',', ' ')?> руб
                <div style="font-size: 12px; font-weight: normal; padding-top: 5px;">
                    Стоимость продукции носит исключительно справочный характер,
                    <br>конечная цена в магазине партнера может
                    отличаться.
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>