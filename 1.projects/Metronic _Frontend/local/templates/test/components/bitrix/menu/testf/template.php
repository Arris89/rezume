<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>


    <? $i = 0;
    $mas = count($arResult);
    foreach ($arResult as $arItem):
        if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;


        if ($i % 4 == 0) { ?>
            <div class="col-sm-2 sm-margin-b-30">
            <!-- List -->
            <ul class="list-unstyled footer-list">
            <li class="footer-list-item"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>

        <?
        } elseif ((($i + 1) % 4 == 0)) { ?>
            <li class="footer-list-item"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
            </ul>
            <!-- End List -->
            </div>
        <?
        } elseif ($i == ($mas - 1)) { ?>
            <li class="footer-list-item"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
            </ul>
            <!-- End List -->
            </div>

        <?
        } else { ?>
            <li class="footer-list-item"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
        <?
        }


        $i++;
    endforeach;


endif; ?>