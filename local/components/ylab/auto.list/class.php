<?php
use Ylab\Mix\Orm\AutoTable;
use Ylab\Mix\Orm\ColorTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

class AutoListComponent extends \CBitrixComponent
{
	public function executeComponent()
	{
        if ($this->startResultCache()) {
            $arParams = &$this->arParams;
            $arResult = &$this->arResult;
            $arResult = ['ITEMS' => []];

            $query = AutoTable::query();

            if ($arParams['COMMERCIAL']) {
                $query->addFilter('COMMERCIAL', 'Y');
            }
            if ($arParams['COLOR']) {
                $query->addFilter('COLOR_ID', $arParams['COLOR']);
            }
            if ($arParams['AGE']) {
                $query->addFilter('>PRODUCTION_DATE', ConvertTimeStamp(time() - 2 * 365 * 24 * 60 *60));
            }
            
            $arSelect = ['MARK', 'MODEL', 'PRODUCTION_DATE', 'CAPACITY', 'COMMERCIAL', 'COLOR_NAME' => 'COLOR.NAME'];
            $items = $query->setSelect($arSelect)->setOrder('ID')->fetchAll();
            $arResult['ITEMS'] = $items;

            $collColors = ColorTable::query()->setSelect(['ID', 'NAME'])->fetchCollection();
            $colorNames = $collColors->getNameList();
            $arResult['COLOR_NAMES'] = implode(', ', $colorNames);
            $arColors = [];
            foreach ($collColors as $item) {
                $color = ['ID' => $item->getID(), 'NAME' => $item->get('NAME')];
                $arColors[] = $color;
            }
            $arResult['COLOR_FILTER'] = $arColors;

            $this->includeComponentTemplate();
        } else {
            $this->abortResultCache();
        }
	}
}