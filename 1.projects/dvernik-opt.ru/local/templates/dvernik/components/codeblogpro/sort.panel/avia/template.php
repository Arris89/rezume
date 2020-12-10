<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

if (!empty($arResult['SORT']['PROPERTIES'])) { ?>

<div style="display: none;"><? foreach ($arResult['SORT']['PROPERTIES'] as $property) { ?>
        <? if ($property['ACTIVE']) { ?>
            <a class="active" href="<?= $property['URL']; ?>">
                <strong><?= $property['NAME'] ?></strong><?
                /**
                 * Show sorting direction
                 */
                if ($property['CODE'] != 'rand') {
                    if (strpos($property['ORDER'], 'asc') !== false) {
                        echo '&darr;';
                    } elseif (strpos($property['ORDER'], 'desc') !== false) {
                        echo '&uarr;';
                    }
                }
                ?></a>&nbsp
        <? } else { ?>
            <a href="<?= $property['URL']; ?>"><?= $property['NAME'] ?></a>&nbsp
        <? }
    }
    } ?></div>