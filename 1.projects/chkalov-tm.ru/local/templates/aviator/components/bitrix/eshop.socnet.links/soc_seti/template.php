<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);

if (is_array($arResult["SOCSERV"]) && !empty($arResult["SOCSERV"])) {
    ?>

    <ul class="foot-menu">
        <li class="title">Социальные сети</li>
    </ul>

    <div class="socials-list">
        <? foreach ($arResult["SOCSERV"] as $socserv):?>
            <noindex>
                <a rel="nofollow" target="_blank" href="<?= htmlspecialcharsbx($socserv["LINK"]) ?>"><img width="36"
                                                                                                          height="37"
                                                                                                          alt=""
                                                                                                          src="<?= $templateFolder ?>/images/soc-icon-<?= htmlspecialcharsbx($socserv["CLASS"]) ?>.png"></a>
            </noindex>

        <?endforeach ?>
    </div>

    <?
}
?>

