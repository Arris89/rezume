<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<ul class="top-menu">
    <?php
    $previousLevel = 1;
    foreach ($arResult as $key)
    {
    if ($key['DEPTH_LEVEL'] == 1 && $previousLevel == 1) {
    $y = 0;
    ?>
    <li>
        <a href="<?= $key['LINK'] ?>"><?= $key['TEXT'] ?></a>
        <?
        $wr = $key['PARAMS']["IMAGE"];
        }
        if ($key['DEPTH_LEVEL'] == 1 && $previousLevel == 2) {
        if ($y > 6){
        ?>
</ul>
</div>


<? if ($wr) {
    ?>
    <div class="wrapper">
        <div class="img-wrap">
            <div class="discount">
            </div>
            <img src="<?= SITE_TEMPLATE_PATH ?><?= $wr; ?>" alt="" height="317" width="600">
        </div>
    </div>
<?
} ?>


</div>
</div>
</li>
<li>
    <a href="<?= $key['LINK'] ?>"><?= $key['TEXT'] ?></a>
    <? $y = 0;
    $wr = $key['PARAMS']["IMAGE"];
    }
    else {
    ?>
    </ul>
    </div>

    <? if ($wr) { ?>
        <div class="wrapper">
            <div class="img-wrap">
                <div class="discount">
                </div>
                <img src="<?= SITE_TEMPLATE_PATH ?><?= $wr; ?>" alt="" height="317" width="600">
            </div>
        </div>
    <?
    } ?>

    </div>
    </div>
</li>
<li>
    <a href="<?= $key['LINK'] ?>"><?= $key['TEXT'] ?></a>
    <?
    $y = 0;
    $wr = $key['PARAMS']["IMAGE"];
    }
    }
    if ($key['DEPTH_LEVEL'] == 2){
    if ($key['DEPTH_LEVEL'] == 2 && $previousLevel == 1) {
    ?>
    <div class="drop-menu">
        <div class="container">
            <div class="menu-list">
                <ul class="menu">
                    <li>
                        <a href="<?= $key['LINK'] ?>"><?= $key['TEXT'] ?></a>
                        <?
                        }
                        if ($key['DEPTH_LEVEL'] == 2 && $previousLevel == 2) {
                        if ($y % 6 == 0) {
                        ?>
                    </li>
                </ul>
                <ul class="menu">
                    <li>
                        <a href="<?= $key['LINK'] ?>"><?= $key['TEXT'] ?></a>

                        <?
                        }
                        else{
                        ?>
                    </li>
                    <li>
                        <a href="<?= $key['LINK'] ?>"><?= $key['TEXT'] ?></a>
                        <?
                        }
                        }
                        $y++;
                        }
                        $previousLevel = $key['PARAMS']["DEPTH_LEVEL"];

                        }
                        ?>
                </ul>