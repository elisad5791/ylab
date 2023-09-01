<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $APPLICATION;

$arComponentParameters = array(
    "GROUPS" => array(
        "DATA_SOURCE" => array("NAME" => "Данные", "SORT" => 200),
        "CACHE" => array("NAME" => "Настройки кеширования", "SORT" => 900)
    ),
	"PARAMETERS" => array(
		"IBLOCK_CODE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Код ИБ",
			"TYPE" => "STRING",
			"DEFAULT" => "",
            "REFRESH" => "N"
		),
		"ACTIVE_TYPE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Активность",
			"TYPE" => "LIST",
			"DEFAULT" => "A",
            "REFRESH" => "N",
			"VALUES" => array("A" => "Все доступы", "Y" => "Только открытые доступы", "N" => "Только просроченные доступы")
		),
		"CACHE_TYPE" => array("PARENT" => "CACHE", "DEFAULT" => "A"),
		"CACHE_TIME" => array("PARENT" => "CACHE", "DEFAULT" => "3600")
	)
);
?>