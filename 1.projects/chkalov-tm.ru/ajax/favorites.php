<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('main');


$rsUser = CUser::GetByID($_POST['idfav']);
$arUser = $rsUser->Fetch();


$resFav = array_search($_POST['param'], $arUser['UF_FAV']);

if ($resFav === false) {

    $arUser['UF_FAV'][] = $_POST['param'];

} else {


    unset($arUser['UF_FAV'][$resFav]);

}


$rsUser = new CUser;
$fields = Array(
    "UF_FAV" => $arUser['UF_FAV'],
);
$rsUser->Update($_POST['idfav'], $fields);





?>

