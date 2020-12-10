<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


$APPLICATION->SetTitle("Загрузка интернет-страниц");

?>
Выберите раздел, в который будет произвдено сохранение результатов парсинга
<br><br>
<select class="razdel">
    <?
    /*Получаем список разделов каталога для сохранения картинки*/
    $iblockID = \IbHelp\Helper::getIblockIdByCodes('aspro_next_catalog')["aspro_next_catalog"];
    $arFilter = Array("IBLOCK_ID" => $iblockID, 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1);
    $db_list = CIBlockSection::GetList(Array(), $arFilter, false, Array(), Array());
    while ($ar_result = $db_list->GetNext()) {
        echo '<option value=' . $ar_result['ID'] . '>' . $ar_result['NAME'] . '/<option>';
        $mas[] = $ar_result['ID'];
    }
    ?>
</select>
<br><br><br>
<form action="post.php" method="POST">
    <input type="text" name="url">
    <input type="submit" value="Начать парсинг">
    <input type="hidden" name="section" class='sect' value="<?= $mas[0] ?>">
</form>


<script>
    $(document).ready(function () {
        $(".razdel").change(function () {
            var dap = $('select option:selected').val();
            $('.sect').val(dap);
        });
    });

</script>