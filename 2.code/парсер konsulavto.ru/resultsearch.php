<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
CModule::IncludeModule('iblock');


if (isset($_GET['q']))
{


$NAME = $_GET['q'];
$IDcat = \IbHelp\Helper::getIblockIdByCodes('aspro_next_catalog')["aspro_next_catalog"];
$arSelect = Array();
$arFilter = Array("IBLOCK_ID" => $IDcat, "ACTIVE" => "Y", "%NAME" => $NAME);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();


    $res1 = CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID']);
    if ($ar_res1 = $res1->GetNext())

        $zapros[$arFields['ID']]['NAME'] = $arFields['NAME'];
    $zapros[$arFields['ID']]['SECTION'] = $arFields['IBLOCK_SECTION_ID'];
    $zapros[$arFields['ID']]['ID'] = $arFields['ID'];
    $zapros[$arFields['ID']]['URL'] = $ar_res1['SECTION_PAGE_URL'];
    $zapros[$arFields['ID']]['DETAIL'] = $arProps['NUM_DETAIL']['VALUE'];

    $arSelectpath = array('ID');

    $nav = CIBlockSection::GetNavChain(false, $arFields['IBLOCK_SECTION_ID'], $arSelectpath);

    while ($arSectionPath = $nav->GetNext()) {

        $pathEnd[] = $arSectionPath['ID'];

    }
}


$list = $res->SelectedRowsCount();

$pathEnd = array_unique($pathEnd);


$pathEnd1 = json_encode($pathEnd);
$zapros = json_encode($zapros, JSON_UNESCAPED_SLASHES);

echo '<script>
var zapros = ' . $zapros . ';
</script>';

echo '<script>
var pathEnd = ' . $pathEnd1 . ';
</script>';


?>
<div class="search-page-wrap">

    <form action="/resultsearch.php" method="get">
        <div class="form-control">
            <input type="text" name="q" value="<?= $_GET['q'] ?>" size="40">
        </div>
        <input type="submit" class="btn btn-default" value="Найти">
        <input type="hidden" name="how" value="r">
    </form>
    <br>

    <?

    if ($list == 0) {
        echo 'Сожалеем, но ничего не найдено.';
    }
    ?>

    <div class="cat">
        <?

        $arFilter1 = Array('IBLOCK_ID' => $IDcat, 'GLOBAL_ACTIVE' => 'Y', 'ID' => $pathEnd);
        $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter1, true);
        while ($ar_result = $db_list->GetNext()) {

            if ($ar_result['IBLOCK_SECTION_ID'] == '') {
                $ar_result['IBLOCK_SECTION_ID'] = 0;
            }

            $region[] = $ar_result;
        }


        function form_tree($mess)
        {
            if (!is_array($mess)) {
                return false;
            }
            $tree = array();
            foreach ($mess as $value) {
                $tree[$value['IBLOCK_SECTION_ID']][] = $value;
            }
            return $tree;
        }


        function build_tree($cats, $parent_id, $depth)
        {
            if (is_array($cats) && isset($cats[$parent_id])) {
                $tree = '<div class="pl">';
                foreach ($cats[$parent_id] as $cat) {

                    if ($depth < 4) {
                        $tree .= '<div class="h' . $depth . '" data-id=' . $cat['ID'] . '>' . $cat['NAME'] . '</div>';
                    } else {
                        $tree .= '<div class="h3" data-id=' . $cat['ID'] . '>' . $cat['NAME'] . '</div>';
                    }

                    $tree .= build_tree($cats, $cat['ID'], $depth + 1);

                }
                $tree .= '</div>';
            } else {
                return false;
            }
            return $tree;
        }


        if ($list !== 0) {

            $tree = form_tree($region);
            echo build_tree($tree, 0, 1);
        }


        }

        ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        var zapros1 = JSON.parse(JSON.stringify(zapros));

        for (var key in zapros1) {
            $('[data-id=' + zapros1[key].SECTION + ']').append('<li id=' + zapros1[key].ID + ' style="font-size: 15px;" data-li-id=' + zapros1[key].SECTION + '></li>');
            $('#' + zapros1[key].ID + '').append('<a href=' + zapros1[key].URL + '?point=' + zapros1[key].DETAIL + ' target="blank">' + zapros1[key].NAME + '</a>');
        }


        var pathEnd1 = JSON.parse(JSON.stringify(pathEnd));

        for (var key in pathEnd1) {
            $('[data-li-id=' + pathEnd1[key] + ']').wrapAll('<ul style="padding-left: 10px;"></ul>');
        }

    });

</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>