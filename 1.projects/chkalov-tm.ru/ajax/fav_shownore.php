<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('main');


if (isset($_POST['idfav'])) {


    $rsUser = CUser::GetByID($_POST['idfav']);
    $arUser = $rsUser->Fetch();


    foreach ($arUser['UF_FAV'] as $key1) {
        $newmass1[$key1] = $key1;
    }

    
    echo json_encode($newmass1);

}


?>

