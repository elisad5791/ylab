<?
namespace Ylab\Mix\Helper;

use Bitrix\Iblock\IblockTable;

class Iblock
{
    static public function getBlockIdByBlockCode($code)
    {
        $arBlocks = IblockTable::query()->setSelect(['ID', 'CODE'])->setFilter(['ACTIVE' => 'Y'])->fetchAll();
        $codes = array_column($arBlocks, 'ID', 'CODE');
        return $codes[$code] ?? null;
    }
}