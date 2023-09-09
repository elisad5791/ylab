<?
namespace Ylab\Mix;

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Security\Random;
use Ylab\Mix\Helper\Iblock;

class Access
{
    static public function codeHandler(&$arFields) 
    {
        $block = 'accesses';
        $accessesId = Iblock::getBlockIdByBlockCode($block);

        if ($accessesId != $arFields['IBLOCK_ID']) {
            return;
        }
        if (strlen($arFields["CODE"]) > 0) {
            return;
        }
    
        $codes = self::getCodes();
        do {
            $code = Random::getString(10);
        } while (in_array($code, $codes));
        $arFields["CODE"] =  $code;
    
        return;
    }

    static public function getCodes()
    {
        $block = 'accesses';
        $codes = ElementTable::query()
            ->setFilter(['IBLOCK_ID' => Iblock::getBlockIdByBlockCode($block)])
            ->setSelect(['CODE'])
            ->fetchCollection()
            ->getCodeList();

        return $codes;
    }

    static public function clearAccesses()
    {
        $block = 'accesses';
        $currentDate = ConvertTimeStamp(false, 'FULL');

        $items = ElementTable::query()
            ->setFilter(['IBLOCK_ID' => Iblock::getBlockIdByBlockCode($block), '<ACTIVE_TO' => $currentDate])
            ->setSelect(['ID'])
            ->fetchAll();

        foreach ($items as $item) {
            \CIBlockElement::Delete($item['ID']);
        }
        
        return 'Ylab\Mix\Access::clearAccesses();';
    }
}
?>