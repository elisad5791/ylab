<?
namespace Ylab\Mix\Helper;

use Ylab\Mix\Orm\ColorTable;

class Color
{
    static public function getColorIdByColorCode($code)
    {
        $arColors = ColorTable::query()->setSelect(['ID', 'CODE'])->fetchAll();
        $codes = array_column($arColors, 'ID', 'CODE');
        return $codes[$code] ?? null;
    }
}