<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

CModule::IncludeModule('highloadblock');

function GetEntityDataClass($HlBlockId)
{
    if (empty($HlBlockId) || $HlBlockId < 1) {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}

const MY_HL_BLOCK_ID = 5;
$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$result = $entity_data_class::add(array(
    'UF_COMPANY' => $_POST['comp'],
    'UF_FIO' => $_POST['fio'],
    'UF_STREET' => $_POST['street'],
    'UF_COUNTRY' => $_POST['country'],
    'UF_PHONE' => $_POST['phone'],
    'UF_INDEX' => $_POST['index'],
    'UF_CITY' => $_POST['city'],
    'UF_USER' => $_POST['user'],
    'UF_ALIAS' => $_POST['alias']
));
