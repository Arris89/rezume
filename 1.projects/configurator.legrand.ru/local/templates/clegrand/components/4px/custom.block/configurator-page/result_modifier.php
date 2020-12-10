<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$iblockIds = \FourPx\Helper::getIblockIdByCodes(['rooms', 'walls', 'fon', 'fon-color']);

// Списки справочников
$arLists = [];

// Файлы
$arFiles = [];

// Помещения
$ob = \CIBlockElement::GetList([],
    ['IBLOCK_ID' => $iblockIds['rooms'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"],
    false, false,
    ['NAME']
);
while($res = $ob->GetNext()){
    $arLists['rooms'][] = [
        'NAME' => $res['NAME']
    ];
}

// Стены
$ob = \CIBlockElement::GetList([],
    ['IBLOCK_ID' => $iblockIds['walls'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"],
    false, false,
    ['NAME']
);
while($res = $ob->GetNext()){
    $arLists['walls'][] = [
        'NAME' => $res['NAME']
    ];
}

// Обои для фона
$ob = \CIBlockElement::GetList([],
    ['IBLOCK_ID' => $iblockIds['fon'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"],
    false, false,
    ['ID', 'PREVIEW_PICTURE']
);
while($res = $ob->GetNext()){
    $arLists['fon'][] = [
        'ID' => $res['ID'],
        'PREVIEW_PICTURE' => $res['PREVIEW_PICTURE'],
    ];
    $arFiles[] = $res['PREVIEW_PICTURE'];

}

// Цвет покраски
$ob = \CIBlockElement::GetList([],
    ['IBLOCK_ID' => $iblockIds['fon-color'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"],
    false, false,
    ['PROPERTY_CODE_COLOR']
);
while($res = $ob->GetNext()){
    $arLists['color'][] = [
        'COLOR' => $res['PROPERTY_CODE_COLOR_VALUE'],
    ];
}



// получение сcылок на файлы
if ($rsFiles = \CFile::GetList(
    array(),
    array(
        '@ID' => implode(',', $arFiles),
    )
)
) {
    while ($file = $rsFiles->Fetch()) {
        $arResult['FILES'][ $file['ID'] ] = '/upload/' . $file['SUBDIR'] . '/' . $file['FILE_NAME'];
    }
}


$arResult['LISTS'] = $arLists;
