<?php
use Bitrix\Iblock\ElementTable;
use Ylab\Mix\Helper\Iblock;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

class AccessesListComponent extends \CBitrixComponent
{
	public function executeComponent()
	{
        if ($this->startResultCache()) {
            $arParams = &$this->arParams;
            $arResult = &$this->arResult;
            $arResult = ['ITEMS' => []];
            $currentDate = ConvertTimeStamp(false, 'FULL');
            
            $blockId = Iblock::getBlockIdByBlockCode($arParams['IBLOCK_CODE']);
            $arFilter = ['IBLOCK_ID' => $blockId, 'ACTIVE' => 'Y'];
            if ($arParams['ACTIVE_TYPE'] == "Y") {
                $arFilter['>=ACTIVE_TO'] = $currentDate;
            } elseif ($arParams['ACTIVE_TYPE'] == "N") {
                $arFilter['<ACTIVE_TO'] = $currentDate;
            }

            $arSelect = ['ID', 'NAME', 'ACTIVE_FROM', 'ACTIVE_TO'];

            $items = ElementTable::query()->setFilter($arFilter)->setSelect($arSelect)->fetchAll();

            $arResult['ITEMS'] = $items;

            $this->includeComponentTemplate();
        } else {
            $this->abortResultCache();
        }
	}
}