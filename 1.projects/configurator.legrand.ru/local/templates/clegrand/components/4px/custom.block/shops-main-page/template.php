<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?if($arResult['JS_DATA']){?>
    <div class="section-main">
        <h3 class="section-main__title main-title title">Магазины партнеров</h3>
        <div id="shops-map" class="r-order__map js-type-map" style="height: 500px; margin-bottom: 30px"></div>
        <div><a href="/receiving-order/" class="my-btn">Все магазины партнеров</a></div>
    </div>

    <script>
        document.shops = <?= json_encode($arResult['JS_DATA'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)?>;
    </script>
<?}?>