<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>

    <div class="cat-title">Меню</div>
    <ul class="sf-menu clearfix menu-content sf-js-enabled sf-arrows">

        <?

        foreach ($arResult as $arItem) {

            if ($arItem["ADDITIONAL_LINKS"]["DEPTH_LEVEL"] == 1) {

                if ($arItem['TEXT'] == 'Пальто') {
                    ?>

                    <li class="ther palto" data-block="<?= $arItem["TEXT"] ?>">
                        <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                        <ul class="submenu-container palto" style="display: none;">
                            <li data-ccat="test123" class=""><a href="/catalog/dempalto/" data-ccat="">демисезонные
                                    пальто</a></li>
                            <li data-ccat="test123"><a href="/catalog/uteplennye-palto/" data-ccat="">утепленные
                                    пальто</a></li>
                            <li data-ccat="test123"><a href="/catalog/dlinnye-palto/" data-ccat="">длинные пальто</a>
                            </li>
                            <li data-ccat="test123"><a href="/catalog/korotkie-palto/" data-ccat="">короткие пальто</a>
                            </li>
                            <li data-ccat="test123"><a href="/catalog/klassicheskie-palto/" data-ccat="">Женское
                                    классическое пальто</a></li>
                        </ul>
                    </li>

                <? } elseif ($arItem['TEXT'] == 'Женская одежда') { ?>
                    <li class="ther women" data-block="<?= $arItem["TEXT"] ?>">
                        <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                        <ul class="submenu-container women" style="display: none;">
                            <li data-ccat="test123" class=""><a href="/catalog/bryuki/" data-ccat="">брюки</a></li>
                            <li data-ccat="test123"><a href="/catalog/zhakety/" data-ccat="">жакеты</a></li>
                            <li data-ccat="test123"><a href="/catalog/platya/" data-ccat="">платья</a></li>
                            <li data-ccat="test123"><a href="/catalog/yubki/" data-ccat="">юбки</a></li>
                            <li data-ccat="test123"><a href="/catalog/bluzy/" data-ccat="">блузы</a></li>
                        </ul>
                    </li>
                <?
                } else {
                    ?>
                    <li class="ther" data-block="<?= $arItem["TEXT"] ?>">
                        <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    </li>
            
                <?
                } ?>

            <?
            }
        }
        ?>
    </ul>
<? } ?>

