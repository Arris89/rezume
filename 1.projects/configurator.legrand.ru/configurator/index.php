<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Конфигуратор рамок и механизмов");
?>
<?$APPLICATION->IncludeComponent(
    "4px:custom.block",
    "configurator-page",
    Array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "GET_PARAMS" => "",
        "PARAMS_JSON" => ""
    )
);?>

<?if (isset($_POST['res'])):?>
    <script>
        var edit = <?= json_encode($_POST['res'])?>;
        window.config = edit;
        window.comp = edit.comp;
        window.mech = edit.mech;
        window.postmodframe = edit.postmodframe;
        window.postfcollection = edit.postfcollection;
        window.postcolor = edit.postcolor;
    </script>
<?endif?>

<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>