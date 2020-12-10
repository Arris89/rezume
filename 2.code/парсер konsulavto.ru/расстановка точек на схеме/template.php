<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

CModule::IncludeModule('iblock');


/*Получаем раздел для привязки точек*/


$sect = $arResult['PROPERTIES']['CATALOG_RAZDEL']['VALUE'];

echo '<script>
window.sect = ' . $sect . ';
</script>';

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script type="text/javascript">

    /*Устанока точки при клике на картинку*/
    $(document).ready(function () {
        var j = 1;
        $(".img-thumbnail").on('click', function (e) {
            e.preventDefault();
            var $img = $(e.target);
            var offset = $img.offset();
            var x = e.clientX - offset.left;
            var y = e.clientY - offset.top;

            var img = $('<span>' + j + '<span>');
            img.css('top', y);
            img.css('left', x);
            img.css('width', 15);
            img.css('height', 15);
            img.css('background-color', 'grey');
            img.css('position', 'absolute');
            img.appendTo('#container');


            $("#hidX").val(x);
            $("#hidY").val(y);
            j++;
            $.post('/ajax/img.php', {x, y, sect}, function (datad) {
            })
        });

        /*Удаление картинки*/
        $(".rmall").on('click', function (e) {
            var rm = 1;
            $.post('/ajax/img.php', {rm, sect}, function (datad) {
                location.reload();
            })
        });


    });
</script>
<style>
    #container {
        background: green;
        position: relative;
    }

    #container img {
        position: absolute;
    }
</style>

<div id="container">
    <img id="" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" alt="mainphoto" class="img-thumbnail"
         style="cursor: crosshair; border: none; border-radius: 0px; padding: 0px;"/>
</div>


<div style="position: relative; left: 70%;" class="rmall">
    <a href="javascript:void(0)">Удалить все</a>
</div>

<?
$iblockID = \IbHelp\Helper::getIblockIdByCodes('img')["img"];
$arSelect = Array("ID", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID" => IntVal($iblockID), "PROPERTY_RAZDEL" => $sect, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while ($ob = $res->GetNextElement()) {
    $arProps = $ob->GetProperties();
    $mas[] = [$arProps['X_COORD']['VALUE'], $arProps['Y_COORD']['VALUE']];
}

echo '<script>
var mas=' . json_encode($mas) . ';
</script>';
?>


<script>

    /*отрисовка точек на картинке*/

    $(document).ready(function () {
        var i = 1;
        for (var key in mas) {
            var xx = mas[key][0];
            var yy = mas[key][1];
            var pet = $("#container").after("<span id=" + i + " style='left:" + xx + ", top:" + yy + "'>" + i + "</span>");
            $('#' + i + '').css('position', 'absolute');
            $("#" + i + "").css("left", xx);
            $("#" + i + "").css("top", yy);
            $("#" + i + "").css("width", 15);
            $("#" + i + "").css("height", 15);
            $("#" + i + "").css('background-color', 'grey');
            i++;
        }
    });

</script>

