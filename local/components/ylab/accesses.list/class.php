<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class AccessesListComponent extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        $arParams = &$this->arParams;
        $arResult = &$this->arResult;
        $arResult = ['ITEMS' => []];

        CModule::IncludeModule('iblock');

        if ($this->startResultCache()) {
            $currentDate = ConvertTimeStamp(time(), 'FULL');
            $arFilter = [
                'IBLOCK_CODE' => $arParams['IBLOCK_CODE'],
                'ACTIVE' => 'Y'
            ];
            if ($arParams['ACTIVE_TYPE'] == "Y") {
                $arFilter['>=DATE_ACTIVE_TO'] = $currentDate;
            } elseif ($arParams['ACTIVE_TYPE'] == "N") {
                $arFilter['<DATE_ACTIVE_TO'] = $currentDate;
            }

            $arSelect = ['IBLOCK_ID', 'ID', 'NAME', 'ACTIVE_FROM', 'ACTIVE_TO'];

            $rsItems = CIBlockElement::GetList(
                [],
                $arFilter,
                false,
                false,
                $arSelect
            );

            while ($arItem = $rsItems->fetch()) {
                $arResult['ITEMS'][] = $arItem;
            }

            $this->includeComponentTemplate();
        } else {
            $this->abortResultCache();
        }
    }
}