<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

/*удаление адреса*/

CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');

CModule::IncludeModule('highloadblock');
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

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
$idForDelete = $_POST['id'];
$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$result = $entity_data_class::delete($idForDelete);

?>