<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('main');
CModule::IncludeModule('iblock');


$APPLICATION->SetTitle("Загрузка интернет-страниц");

?>
Выберите раздел, в который будет произвдено сохранение результатов парсинга
<br><br>
<br><br>

<select class="razdel">
    <?


    /*Получаем список разделов каталога для сохранения картинки*/
    $iblockPars = \IbHelp\Helper::getIblockIdByCodes('parsing')["parsing"];
    $arSelect = Array("ID", "IBLOCK_ID", "NAME");
    $arFilter = Array("IBLOCK_ID" => 30, "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        echo '<option value=' . $arFields['ID'] . '>' . $arFields['NAME'] . '/<option>';
        $mas[] = $arFields['ID'];
        $namemas[] = $arFields['NAME'];

        $arProps = $ob->GetProperties();
        $href[] = $arProps['HREF']['VALUE'];
        $razd[] = $arProps['RAZDEL']['VALUE'];

    }

    echo '<script>
var jj;
</script>';

    $result = count($mas);

    if ($result > 0) {
        echo '<script>
var jj = 1;
</script>';
    }

    ?>
</select>


<?

echo '<script>
var jj;
</script>';

$result = count($mas);

if ($result > 0) {
    echo '<script>
var jj = 1;
</script>';
}


?>

<br><br><br>

<form action="post.php" method="POST">
    <input type="text" name="url">
    <input type="submit" value="Начать парсинг" id="butform">
    <input type="hidden" name="id" class='sect' value="<?= $mas[0] ?>">
    <input type="hidden" name="name" class='sect1' value="<?= $namemas[0] ?>">
    <input type="hidden" name="href" class='sect2' value="<?= $href[0] ?>">
    <input type="hidden" name="razdel" class='sect3' value="<?= $razd[0] ?>">
</form>


<script>
    $(document).ready(function () {

        if (jj == 1) {
            $('#butform').click();
        }

    });
</script>