<?
use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $APPLICATION;

$arComponentParameters = array(
    "GROUPS" => array(
        "DATA_SOURCE" => array("NAME" => Loc::getMessage('PROPERTY_NAME_SOURCE'), "SORT" => 200),
        "CACHE" => array("NAME" => Loc::getMessage('PROPERTY_NAME_CACHE'), "SORT" => 900)
    ),
	"PARAMETERS" => array(
		"IBLOCK_CODE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => Loc::getMessage('PROPERTY_NAME_CODE'),
			"TYPE" => "STRING",
			"DEFAULT" => "",
            "REFRESH" => "N"
		),
		"ACTIVE_TYPE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => Loc::getMessage('PROPERTY_NAME_TYPE'),
			"TYPE" => "LIST",
			"DEFAULT" => "A",
            "REFRESH" => "N",
			"VALUES" => array(
				"A" => Loc::getMessage('VALUE_ALL'), 
				"Y" => Loc::getMessage('VALUE_ACTIVE'), 
				"N" => Loc::getMessage('VALUE_INACTIVE')
			)
		),
		"CACHE_TYPE" => array("PARENT" => "CACHE", "DEFAULT" => "A"),
		"CACHE_TIME" => array("PARENT" => "CACHE", "DEFAULT" => "3600")
	)
);
?>